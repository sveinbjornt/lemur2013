<?php
/*
Template Name: Single Gallery Item

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Country Tag JSON
 * @type		PHP page
 * @desc		Wordpress template

 * @requires	Wordpress
 */
?>
<?php
    $gallery_post_id = $_GET['gallery_post_id'];
    // $my_query = new WP_Query('p=' . $gallery_post_id . '&showposts=1'); 
    
    query_posts('p=' . $gallery_post_id);
?>
<div style="padding: 20px;">
<?php get_template_part('single-post-content'); ?>
</div>