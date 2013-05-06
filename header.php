<!DOCTYPE html>

    <!--[if lt IE 7]> <html lang="en" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]> <html lang="en" class="lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]> <html lang="en" class="lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--><html lang="<?php bloginfo('language'); ?>" class="" xmlns:fb="http://ogp.me/ns/fb#"><!--<![endif]-->

    <head>
        <!-- META TAGS -->
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta http-equiv="Content-language" content="<?php bloginfo('language'); ?>" />

        <?php if (is_single()) { ?>
            <?php
                $src = '';
                if (function_exists('wp_get_attachment_thumb_url')) {
                    $src = wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); 
                } 
            ?>
        <meta property="og:url" content="<?php the_permalink() ?>" />  
        <meta property="og:title" content="<?php single_post_title(''); ?> | Lemúrinn" />  
        <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />  
        <meta property="og:site_name" content="Lemúrinn" />  
        <meta property="og:type" content="article" />  
        <meta property="og:image" content="<?php echo $src ?>" />
        <link rel="image_src" href="<?php echo $src ?>" /> 
        
        <?php } else { ?>  
        <meta property="og:site_name" content="Lemúrinn" />  
        <meta property="og:description" content="Lemúrinn er veftímarit um allt. Furður, fjarlægir staðir, menning, saga, tónlist, blogg, morð og ofbeldi og fleira." />  
        <meta property="og:type" content="website" />  
        <meta property="og:image" content="<?php echo get_template_directory_uri() ?>/assets/images/lemur-fb-icon.jpg" />
        <link rel="image_src" href="<?php echo get_template_directory_uri() ?>/assets/images/lemur-fb-icon.jpg" />
        <?php } ?>  
        
        <!-- STYLES -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">                
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favico.ico" type="image/x-icon">
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/style-lt-ie9.css">  
        <![endif]-->
        <!--[if lte IE 7]>
            <script src="<?php echo get_template_directory_uri() ?>/assets/js/lte-ie7.js"></script>
        <![endif]-->
        
        
        <?php wp_head(); ?>

        <title><?php wp_title ( '|', true, 'right' ); ?></title>

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
                
                <?php $base = get_bloginfo('wpurl'); ?>
                
                <a href="<?php echo $base ?>" class="logo" title="Aftur á forsíðu Lemúrsins">
                    
                    <div class="fb-like">
                        <fb:like href="http://www.facebook.com/lemurinn" send="false" layout="button_count" width="120" show_faces="false" colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></fb:like>
                    </div>
                    
                </a>
                
                <nav class="nav">
                    <ul>
                        <li><a href="<?php echo $base ?>/greinar" title="Greinasafn Lemúrsins">Greinasafn</a></li>
                        <li><a href="<?php echo $base ?>/myndaalbum" title="Myndaalbúm Lemúrsins">Albúmið</a></li>
                        <li><a href="<?php echo $base ?>/svartabloggid" title="Svörtu síðurnar">Svörtu</a></li>
                        <li><a href="<?php echo $base ?>/langtiburtistan" title="Miðausturlandablogg Lemúrsins">Langtíburtistan</a></li>
                        <li><a href="<?php echo $base ?>/sudrid" title="Rómanska Ameríka á Lemúrnum">Suðrið</a></li>
                        <li><a href="<?php echo $base ?>/lanztidindi" title="Úrklippusafn Lemúrsins">Lanztíðindi</a></li>
                        <li><a href="<?php echo $base ?>/bio" title="Bíó Lemúr, hreyfimyndablogg Lemúrsins">Bíó</a></li>
                        <li><a href="<?php echo $base ?>/kvikindin" title="Dýrasíða Lemúrsins">Kvikindin</a></li>
                        <li><a href="<?php echo $base ?>/um" title="Um Lemúrinn">Um</a></li>
                    </ul>
                </nav>

            </header>
            
            <div class="content">
                <?php 
                    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                    if ( is_home() and $page == 1) {
                        get_template_part('bordi'); 
                    }
                    
                    if ( is_category(63) ) {
                        get_template_part('myndaalbum-header');
                    }
                ?>
                <div class="grid gutter collapse720">
                    
                	<div class="col s2of3">

