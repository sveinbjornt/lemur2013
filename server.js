var http = require('http');
var path = require('path');
var util = require('util');
var url = require('url');
var fs = require('fs');
var mu = require('mu2');
var less = require('less');
var express = require('express');
var mootools = require('mootools');

var port = process.env.PORT || 8080;
var folder = '/templates';
var lessFolder = __dirname + '/less';
var sitemap = { sitename: 'unknown', routes: {} };
var compressCss = false;
var lastError = null;

var app = express();
var server = http.createServer(app).listen(port);

var auth = function(user, pass){
	return user === sitemap.auth.username && pass === sitemap.auth.password;
};

var compileLessFile = function(url, callback){
	
	var fileRead = function(exists){
		if(!exists){
			callback(new Error('File does not exists'));
			return;
		}

		fs.readFile(url, 'utf-8', function (err, str) {
			if(err){
				callback(err);
			}

			compileLess(str);
		});
	};

	var compileLess = function(str){
		var parser = new(less.Parser)({
			paths: [path.dirname(url)],
			optimization: 0
		});

		parser.parse(str, function (err, tree) {
			if (err) {
				callback(err);
				return;
			}

			try {
				callback(null, tree.toCSS({ compress: compressCss }));
			} catch (e) {
				callback(e);
			}
		});
	};

	fs.exists(url, fileRead);
};

var compileTemplate = function(route, callback){
	var templatePath;
	var layoutPath = null;
	var templateObj = {
		sitemap: sitemap
	};

	templatePath = route.view;
	
	templateObj.data = route.data;
	templateObj.site = sitemap.site;
	templateObj.page = {};
	templateObj.page.name = route.name;
	templateObj.page.view = route.view;
	templateObj.page.rule = route.rule;

	if(route.body){
		templateObj.body = route.body;
	}

	mu.compile(templatePath, function (err, template){
		if(err){
			callback(err);
			return;
		}

		var stream = mu.render(template, templateObj);

		callback(err, stream);
	});
};

var findRoute = function(url){
	url = url.replace(/\\/gi,'/');

	for(var i = 0; i < sitemap.routes.length; i++){
		if(sitemap.routes[i].rule === url){
			return sitemap.routes[i];
		}
	}

	return null;
};

var getLayoutForRoute = function(route){
	if(!route){
		return null;
	}

	if(route.layout === "false"){
		return null;
	}

	if(route.layout === undefined && sitemap.site.layout === undefined){
		return null;
	}

	if(route.layout !== undefined){
		return route.layout;
	}

	if(route.layout === undefined && sitemap.site.layout){
		return sitemap.site.layout;
	}

	return null;
};

var getContentByUrl = function(url, callback){
	var route = findRoute(url);
	var templateContent;
	var layout = getLayoutForRoute(route);

	// TODO: ugly!
	if(route === null){
		compileTemplate({
			rule: '/',
			name: 'main',
			view: 'main.html'
		}, function(err, stream){
			var html = '';

			if(err){
				res.send(err);
				return;
			}

			stream.on('data', function(chunk){
				html += chunk;
			});

			stream.on('end', function(){
				callback(null, html);
			});
		});
		//callback(null, url);
		return;
	}

	var addLayout = function(content){
		var temp = Object.clone(route);
		temp.body = content;
		temp.view = layout;

		compileTemplate(temp, function(err, stream){
			var html = '';

			if(err){
				res.send(err);
				return;
			}

			stream.on('data', function(chunk){
				html += chunk;
			});

			stream.on('end', function(){
				callback(null, html);
			});
		});
	};

	compileTemplate(route, function(err, stream){
		var html = '';

		if(err){
			res.send(err);
			return;
		}

		stream.on('data', function(chunk){
			html += chunk;
		});

		stream.on('end', function(){
			if(layout !== null){
				addLayout(html);
			} else {
				callback(null, html);
			}
		});
	});
};

var auth = function(req, res, next){
	var url = path.normalize(req.url);
	var route = findRoute(url);

	if(!route || sitemap.auth.enabled === false){
		next();
		return;
	}

	if (req.headers.authorization && req.headers.authorization.search('Basic ') === 0) {
        
        // fetch login and password
        if (new Buffer(req.headers.authorization.split(' ')[1], 'base64').toString() == sitemap.auth.username+':'+sitemap.auth.password) {
            next();
            return;
        }
    }

    console.log('Unable to authenticate user', req.headers.authorization);

    res.header('WWW-Authenticate', 'Basic realm="Admin Area"');

    if (req.headers.authorization) {
        setTimeout(function () {
            res.send('Authentication required', 401);
        }, 3000);
    } else {
        res.send('Authentication required', 401);
    }
};

mu.root = __dirname + folder;

app.configure(function(){
	app.use(express.static(__dirname + '/static'));
	app.use(express.methodOverride());
	app.use(express.bodyParser());
	//app.use(express.favicon(__dirname + '/static/favicon.ico', { maxAge: 2592000000 }));
	app.use(express.errorHandler({
		dumpExceptions: true, 
		showStack: true
	}));
});

app.get('*.less', function(req, res){
	var url = __dirname + path.normalize(req.url);
	var filename = path.basename(req.url)
	var url = lessFolder +'/'+ filename;

	compileLessFile(url, function(err, str){
		if(err){
			res.send(err);
			return;
		}

		res.writeHead(200, {
			'Content-Length': str.length,
			'Content-Type': 'text/css'
		});
		res.end(str);
	});
});

app.get('*', auth, function(req, res){
	//var url = path.normalize(req.url);
	var reqUrl = url.parse(req.url);

	getContentByUrl(reqUrl.pathname, function(err, content){
		res.send(content);
	});
});

var readSiteMap = function(){
	
	var go = function(){
		var data = fs.readFileSync('sitemap.json');

		try {
			sitemap = JSON.parse(data);
			console.log('Sitemap.json reloaded succesfully');
		} catch (e) {
			console.log('Failed to reload sitemap ('+ e.message +')');
			console.log('Save sitemap.json to reload');
		}
	}
	
	go();

	return go;
}();

fs.watch('sitemap.json', function() {
	readSiteMap();
});

console.log('Server running at http://127.0.0.1:'+ port +'/');




