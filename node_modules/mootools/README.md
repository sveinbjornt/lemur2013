# MooTools 1.4.5 Server

For more information about mootools in general I suggest you visit http://mootools.net
In short it is a library for web development, with support for OOP.

Mootools Server is a stripped down version that gives you all the nice things from the mootools library, sans the browser-specific stuff

# Installation

* Get npm (http://npmjs.org)
* run `npm install mootools`
* Done

# Usage

Calling `require('mootools')` will import it into the global scope, and you'll be able to do things like

    var Application = new Class(
    {
        Implements: [process.EventEmitter],
        initialize: function()
        {
            //initialize here
        },
        compute: function()
        {
            //some code
            this.emit("done");
        }
    });

    var app = new Application();
    app.on("done", function() { /* Callback */ });
    app.compute();

You can also use other things that mootools provides, like `Options` and `Events` (mootools events might not be as efficient as the native `EventEmitter` stuff)
