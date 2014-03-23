<?php

/*
Template Name: Kort

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Kort
 * @type		PHP page
 * @desc		Wordpress template

 * @requires	Wordpress
 * @install		Copy this file to the directory of the theme you wish to use, i.e. wp-content/themes/theme_name/
 * usage		
			   1. Create a new Page in your Wordpress control panel
			   2. Enter the URL (or local path, relative to your Wordpress directory) you want to redirect to as the only page content
			   3. Set the Page Template to "Greinasafn"
			   4. Publish
 */

?>

<?php get_header(); ?>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="http://lemurinn.is/js/jquery.maphilight.min.js"></script>
<script src="http://lemurinn.is/js/jquery.rwdImageMaps.min.js"></script>

<link rel="stylesheet" href="jquery-jvectormap-1.0.css" type="text/css" media="screen"/>
<script src="http://lemurinn.is/js/jquery-jvectormap-1.0.min.js"></script>
<script src="http://lemurinn.is/js/jquery-jvectormap-world-mill-en.js"></script>

<div id="world-map" style="width: 600px; height: 400px"></div>
  <script>
    $(function(){
      $('#world-map').vectorMap();
    });
  </script>



<script type="text/javascript">

$(document).ready(function(e) {
    $('img[usemap]').rwdImageMaps();
});

$(function() {

	//$('.map').maphilight({fade: false});

    $('#map_ID > area').hover(function(){
        $('#current-country').text($(this).attr('title'));
    });
    
    $('#map_ID > area').click(function(){
        
        var country = $(this).attr('title');
        var country_slug = $(this).data('tag');
        
        console.log(country);
        console.log(country_slug);
        
        $('#selected-country').text(country);
        
        $("#country-article-results").html("Sæki færslur fyrir " + country + "...");
        $("#country-article-results").load("./lemurskort-sidebar-item/?tag=" + country_slug);
    });
});


function countryClicked (elm) {
    $('#current-country').text($(this).attr('title'));
}

</script>

        <!--<h2>Lemúrskortið</h2>-->
        
        <?php get_template_part('kort'); ?>        
        </div>
        
    <div class="col s1of3 sidebar">
        <p>Lorem ipsum <span class="cat-title">Lemúrskortið</span>, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros.</p>
    </div>

</div>


<h2 id="selected-country"></h2>

<div id="country-article-results">


<br>
<br>
<div class="grid gutter collapse720">
    
    <div class="col s2of3">



<?php get_footer(); ?>
