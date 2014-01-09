<?php

/*
Template Name: Arkífur eftir dagsetningu

 * @author		Sveinbjorn
 * @email		sveinbjornt@gmail.com
 * @web			sveinbjorn.org
 
 * @name		Arkífur eftir dagsetningu
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


<!-- <?php wp_get_archives( array(
    'type'            => 'weekly',
    'limit'           => '',
    'format'          => 'html', 
    'before'          => '',
    'after'           => '',
    'show_post_count' => true,
    'echo'            => 1,
    'order'           => 'DESC'
) ); ?> -->

<?php wp_reset_query(); ?>
<?php get_footer(); ?>



