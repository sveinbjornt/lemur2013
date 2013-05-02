<!DOCTYPE html xmlns:fb="http://ogp.me/ns/fb#" lang="<?php bloginfo('language'); ?>">

    <!--[if lt IE 7]> <html lang="en" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]> <html lang="en" class="lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]> <html lang="en" class="lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--><html lang="<?php bloginfo('language'); ?>" class="" ><!--<![endif]-->

    <head>
        
        <!-- LOAD POSTS -->
        <?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
        
        <!-- META TAGS -->
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=1020">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta http-equiv="Content-language" content="<?php bloginfo('language'); ?>" />
        <!-- if page is a single page use special meta tags -->  
        <?php if (is_single()) { ?>  
        <meta property="og:url" content="<?php the_permalink() ?>">  
        <meta property="og:title" content="<?php single_post_title(''); ?> | Lemúrinn" />  
        <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>">  
        <meta property="og:site_name" content="Lemúrinn">  
        <meta property="og:type" content="article">  
        <meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } ?>">  
        <?php } else { ?>  
        <meta property="og:site_name" content="Lemúrinn">  
        <meta property="og:description" content="Lemúrinn er veftímarit um allt. Furður, fjarlægir staðir, menning, saga, tónlist, blogg, morð og ofbeldi og fleira.">  
        <meta property="og:type" content="website">  
        <meta property="og:image" content="http://lemurinn.is/images/FIXME!!!!!!"> 
        <?php } ?>  
        
        <!-- STYLES -->
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="shortcut icon" href="/images/favico.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">        
        <!-- <link type="text/css" rel="stylesheet" href="/css/main.less"> -->
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <!--[if lte IE 7]>
            <script src="/js/lte-ie7.js"></script>
        <![endif]-->
        
        <title><?php wp_title ( '|', true, 'right' ); ?></title>
        
        
        <?php
			wp_enqueue_script('jquery');
			wp_enqueue_script('cycle', get_template_directory_uri() . '/js/jquery.cycle.all.min.js', 'jquery', false);
			wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', 'jquery', false);
            if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
            wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false);
		?>
        <?php wp_head(); ?>

    </head>
    
    <?php
        if (!is_home() and is_single()) {
            $cat_strings = array();
            $cat = get_the_category($post->ID);
            if( $cat ) {
                foreach ($cat as &$c) {
                    array_push($cat_strings, $c->slug);
                }
            }
        }
    ?>

    <body <?php body_class($cat_strings)?>>
        
        <div id="fb-root"></div>
        
        <div class="wrap">
            
            <header class="header">
                
                <a href="/" class="logo" title="Aftur á forsíðu Lemúrsins">
                    
                    <div class="fb-like">
                        <fb:like href="http://www.facebook.com/lemurinn" send="false" layout="button_count" width="120" show_faces="false" colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></fb:like>
                    </div>
                    
                </a>
                
                <nav class="nav">
                    <ul>
                        <li><a href="/wordpress/greinar">Greinasafn</a></li>
                        <li><a href="/wordpress/myndaalbum">Myndaalbúmið</a></li>
                        <li><a href="/wordpress/svartabloggid">Svörtu</a></li>
                        <li><a href="/wordpress/langtiburtistan">Langtíburtistan</a></li>
                        <li><a href="/wordpress/sudrid">Suðrið</a></li>
                        <li><a href="/wordpress/lanztidindi">Lanztíðindi</a></li>
                        <li><a href="/wordpress/bio">Bíó</a></li>
                        <li><a href="/wordpress/um">Um</a></li>
                    </ul>
                </nav>

            </header>
            
            <div class="content">
                <?php if ( is_home() ) get_template_part('bordi'); ?>
                <?php if ( is_category(63) ) get_template_part('myndaalbum-header'); ?>
                
                <div class="grid gutter collapse600">
                    
                	<div class="col s2of3">
                