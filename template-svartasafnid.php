<?php

/*
Template Name: Svarta safnið

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Svarta safnið
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
<?php $paged = get_query_var('paged');
query_posts('cat=-637,26&paged='.$paged); ?>
<?php get_template_part('loop-greinasafn'); ?>
<?php get_template_part('pagination'); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
