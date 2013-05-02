<?php

/*
Template Name: Page Redirect

 * @author		Dave Stewart
 * @email		dave@davestewart.co.uk
 * @web			www.davestewart.co.uk
 
 * @name		Page Redirect
 * @type		PHP page
 * @desc		Wordpress template that redirects the current page based on the content of the database entry it loads

 * @requires	Wordpress
 * @install		Copy this file to the directory of the theme you wish to use, i.e. wp-content/themes/theme_name/
 * usage		
			   1. Create a new Page in your Wordpress control panel
			   2. Enter the URL (or local path, relative to your Wordpress directory) you want to redirect to as the only page content
			   3. Set the Page Template to "Page Redirect"
			   4. Publish
 */

if (function_exists('have_posts') && have_posts())
{
	while (have_posts())
	{
	
		// get the post
			the_post();
		
		// get content
			ob_start();
			the_content();
			$contents	= ob_get_contents();
			ob_end_clean();
			
		// correctly build the link

			// grab the 'naked' link
				$link	= trim(strip_tags($contents));
				
			// work out
				if(! preg_match('%^http://%', $link))
				{
					$host	= $_SERVER['HTTP_HOST'];
					$dir	= dirname($_SERVER['PHP_SELF']);
					$link	= "http://$host$dir/$link";
				}

		// navigate to the link
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $link");
			exit;

	}

}
?>
