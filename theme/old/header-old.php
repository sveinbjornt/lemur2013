<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" dir="<?php bloginfo('text_direction'); ?>" xml:lang="<?php bloginfo('language'); ?>">  

<head>
    
<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>  
<!-- the default values -->  
<meta property="fb:app_id" content="186476388086986" />  
<meta property="fb:admins" content="1161798800,670556891" />  
  
<!-- if page is content page -->  
<?php if (is_single()) { ?>  
<meta property="og:url" content="<?php the_permalink() ?>"/>  
<meta property="og:title" content="<?php single_post_title(''); ?> | Lemúrinn.is" />  
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />  
<meta property="og:site_name" content="Lemúrinn.is" />  
<meta property="og:type" content="article" />  
<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } ?>" />  
  
<!-- if page is others -->  
<?php } else { ?>  
<meta property="og:site_name" content="Lemúrinn" />  
<meta property="og:description" content="Lemúrinn er veftímarit um allt. Furður, fjarlægir staðir, menning, saga, tónlist, blogg, morð og ofbeldi og fleira." />  
<meta property="og:type" content="website" />  
<meta property="og:image" content="http://lemurinn.is/images/FIXME!!!!!!" /> <?php } ?>  
    

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title ( '|', true,'right' ); ?></title>
        <meta http-equiv="Content-language" content="<?php bloginfo('language'); ?>" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favico.ico" type="image/x-icon" />
        
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        
        
            <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/<?php 
            $category = get_the_category(get_the_ID()); 
            $category_id = $category->cat_ID;
            echo $category_id;
            ?>.css" />

        <!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/ie.css" /><![endif]-->
        <?php
			wp_enqueue_script('jquery');
			wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', 'jquery', false);
			wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
		?>
        <?php wp_head(); ?>
        
        <?php if ( is_home() && !get_option('ss_disable') ) : ?>
        <script type="text/javascript">
            (function($) {
                $(function() {
                    $('#slideshow').cycle({
                        fx:     'scrollHorz',
                        timeout: <?php echo (get_option('ss_timeout')) ? get_option('ss_timeout') : '7000' ?>,
                        next:   '#rarr',
                        prev:   '#larr'
                    });
                })
            })(jQuery)
        </script>
        
        <?php endif; ?>
                
	</head>
	<body <?php body_class()?>>

            <!-- Container -->
            <div id="container" class="clear">
                
                <div id="header">
                       <div id="social-media-buttons">
                            <div class="fb-like" data-send="false" data-layout="button_count" href="http://www.facebook.com/lemurinn" data-width="90" data-show-faces="false"></div>
                        
                       </div>
                </div>
                <ul id="navig">
                <li class="sticky">
                    <a href="/wordpress/">Forsíða</a>
               </li>
               <li class="sticky">
                   <a href="/wordpress/greinar">Greinar</a>
               </li>
               <li class="sticky">
                   <a href="/wordpress/menning">Menning</a>
               </li>
               <li>
                   <a href="/wordpress/faeriband">Færiband</a>
               </li>
               <li class="sticky">
                   <a href="/wordpress/svartabloggid">Svörtu</a>
               </li>
               <li class="small-item">
                   <a href="/wordpress/bio">Bíó</a>
               </li>
               <li class="sticky">
                   <a href="/wordpress/blogg" >Blogg</a>
               </li>
               <li class="um">
                   <a href="/wordpress/um">Um Lemúrinn</a>
               </li>
               <li id="last" class="sticky">
                   <form action="/wordpress/" method="get" id="menu-search" name="menu-search" method="GET">
                       <input type="submit" value="" class="submit"> <input type="text" name="s" placeholder="Leita..." class="search">
                   </form>
               </li>
                </ul>
                            
                <!--
                <?php 
                $args = array(
    				'limit' => 24,
    				'actcat' => false,
    				'cattitle' => false,
    				'linkcattitle' => false,
    				'linkthumbscat' => true,
    				'onecat' => '25',
    				'w' => 1,
    				'h' => 160,
    				'inline' => true,
    				't' => 0,
    				'r' => 0,
    				'b' => 0,
    				'l' => 0, 'title' => ' ', 'show-num' => 7, 'actcat' => 0, 'cattitle' => 0, 'linkcattitle' => 0, 'linkthumbscat' => 0, 'typeog' => '', 'onecat' => '25', 'cats' => '25', 'cus-field' => '', 'width' => '130', 'height' => '130', 'inline' => 'inline', 'top' => '10', 'right' => '3', 'bottom' => '5', 'left' => '0', 'bufferl' => '0', 'bufferr' => '0', 'firstimage' => 0, 'atimage' => 1, 'defimage'=>'' );                
                the_widget('dv_adv_random_post_thumbs', $args, $args); 
                
                
                ?>-->
                
                <?php if ( is_home() && !get_option('ss_disable') ) get_template_part('slideshow'); ?>
                <div style="clear:both;"></div>
                
                <!-- Content -->
                <div id="content">