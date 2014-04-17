<!DOCTYPE html>

    <!--HTML by Sveinbjörn Þórðarson-->
    <!--[if lt IE 7]> <html lang="is" class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]> <html lang="is" class="lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]> <html lang="is" class="lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--><html lang="is" class=""><!--<![endif]-->

    <head>
        <title><?php wp_title ( '|', true, 'right' ); ?></title>
        
        <!-- META -->
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- FB META -->
        <?php get_template_part('facebook-meta'); ?>
        
        <!-- STYLES -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">                
        
        <!-- RSS, favicon, etc. -->
        <link rel="alternate" type="application/rss+xml" title="RSS-veita Lemúrsins" href="<?php echo get_bloginfo('wpurl'); ?>/feed/">
        <link rel="apple-touch-icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/images/lemur-apple-icon.png">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favico.ico">        
        
        <!-- WP HEADER -->
        <?php wp_head(); ?>
        
        <!-- SCRIPTS -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.fancybox.pack.js"></script>
        
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri() ?>/style-lt-ie9.css">  
        <![endif]-->
        <!--[if lte IE 7]>
            <script src="<?php echo get_template_directory_uri() ?>/assets/js/lte-ie7.js"></script>
        <![endif]-->
        
    </head>
    
    <?php
        /* Append category slug to body class if in category or cat item */
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
                
                <?php
                    $base = get_bloginfo('wpurl');
                
                    $headerlink = $base . '/';
                    $is_category = false;
                    $arr = array(   'myndaalbum', 'svortu', 'sudrid', 'babel', 'langtiburtistan',
                                    'lanztidindi', 'bio', 'kvikindin', 'arodursmal', 'nattbord', 'mahlzeit'     );
                    
                    foreach ($arr as &$cat) {
                        if ( is_category($cat) || (is_single() and in_category($cat)) ) {
                            $headerlink .= $cat;
                            $is_category = true;
                        }
                    }
                    
                    if (is_page('greinasafn') or is_date() or is_category('greinar') 
                        or (is_archive() and !is_category()) or is_tag() or is_search()) {
                            $headerlink .= 'greinasafn';
                            $is_category = true;
                    }
                    
                ?>
                
                <a href="<?php echo $headerlink ?>" class="logo" title="Aftur á forsíðu">
                    <div class="facebook-like">
                        <div class="fb-like" data-href="http://facebook.com/lemurinn" data-send="false" data-width="120" data-show-faces="false" data-colorscheme="<?php if ( is_category('svortu') or (in_category('svortu') and is_single())) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="button_count"></div>
                    </div>
                    <div class="argangur">
                        <?php if (!$is_category) {
                                $d1 = new DateTime('2011-10-8');
                                $d2 = new DateTime();
                                $diff = $d1->diff($d2);
                                echo ($diff->y + 1) . '. árgangur';
                        } ?>
                    </div>
                </a>
                
                <nav class="nav">
                    <ul>
                        <li><a href="<?php echo $base ?>/" title="Fara á forsíðu"><i class="icon-home"></i></a></li>
                        <li><a href="<?php echo $base ?>/timalina" title="Tímalína Lemúrsins: Farðu á flakk um tímann!"><i class="icon-busy"></i></a></li>
                        <li><a href="<?php echo $base ?>/lemurskort" title="Lemúrskortið: Farðu á flakk um heiminn!"><i class="icon-earth"></i></a></li>
                        <li><a href="<?php echo $base ?>/greinasafn" title="Greinasafn Lemúrsins">Safnið</a></li>
                        <li><a href="<?php echo $base ?>/myndaalbum" title="Myndaalbúm Lemúrsins">Albúmið</a></li>
                        <li><a href="<?php echo $base ?>/utvarp" title="Útvarp Lemúr: Útvarpsþættir Lemúrsins">Útvarp</a></li>
                        <li><a href="<?php echo $base ?>/svortu" title="Svörtu síðurnar: Allt á sviði hryllings og viðbjóðs">Svörtu</a></li>
                        <!--<li><a href="<?php echo $base ?>/langtiburtistan" title="Langtíburtistan: Miðausturlandablogg Lemúrsins">Langtíburtistan</a></li>-->
                        <!--<li><a href="<?php echo $base ?>/sudrid" title="Suðrið: Rómanska Ameríka á Lemúrnum">Suðrið</a></li>
                        <li><a href="<?php echo $base ?>/babel" title="Babelsturninn: Hugmyndasögublogg Lemúrsins">Babel</a></li>-->
                        <li><a href="<?php echo $base ?>/nattbord" title="Náttborðið: Bókablogg Lemúrsins">Náttborðið</a></li>
                        <li><a href="<?php echo $base ?>/lanztidindi" title="Lanztíðindi: Úrklippusafn Lemúrsins">Lanz</a></li>
                        <li><a href="<?php echo $base ?>/bio" title="Bíó Lemúr: Hreyfimyndablogg Lemúrsins">Bíó</a></li>
                        <li><a href="<?php echo $base ?>/kvikindin" title="Kvikindin: Dýrasíða Lemúrsins">Dýr</a></li>
                        <li><a href="<?php echo $base ?>/arodursmal" title="Áróðursmálaráðuneytið">Áróður</a></li>
                        <li><a href="<?php echo $base ?>/um" title="Um Lemúrinn">Um</a></li>
                        <li><a href="<?php echo $base ?>/?random&cachebuster=<?php echo rand(10000000,999999999) ?>" title="Teningunum er kastað. Grein af handahófi."><i class="icon-dice"></i></a></li>
                        <li><a href="<?php echo $base ?>/leita" title="Leita á Lemúrnum"><i class="icon-search"></i></a></li>
                        
                    </ul>
                </nav>

            </header>
            
            <div class="content">
                <?php 
                    $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                
                    // if ( is_home() and $page == 1) {
                    //     get_template_part('bordi'); 
                    // }
                    
                    if ( is_category(63) ) {
                        get_template_part('myndaalbum-header');
                    }
                ?>
                <div class="grid gutter collapse720">
                    
                    <div class="col s2of3">

