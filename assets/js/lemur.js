


////////////// YouTube placeholder //////////////
var yt_link = function(ytid, list_id) {
    var tpl = '<span class="">\
            <iframe title="YouTube video player" class="youtube-player" type="text/html" \
                    width="670" height="350" src="http://www.youtube.com/embed/' + ytid +
    '?autoplay=1' + list_id + '&amp;wmode=transparent&amp;fs=1&amp;hl=en&amp;modestbranding=1&amp;iv_load_policy=3&amp;showsearch=0&amp;rel=0&amp;theme=light&amp;hd=1&amp;vq=hd720" \
            frameborder="0" allowfullscreen=""></iframe></span>';
    return tpl;
};

////////////// Google Analytics //////////////
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-25230683-1']);
_gaq.push(['_trackPageview']);

 (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl': 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();


////////////// Facebook Initialization //////////////
 (function(d, s, id) {
    var js,
    fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "http://connect.facebook.net/is_IS/all.js#xfbml=1&status=0";
    fjs.parentNode.insertBefore(js, fjs);
} (document, 'script', 'facebook-jssdk'));


