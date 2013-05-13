<?php get_header(); ?>

    <div class="content-title">

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>        
            <?php /* If this is a tag archive */ if ( is_tag() ) { ?>
            <?php printf(__('&raquo; Greinar í flokknum &bdquo;%s&ldquo;'), single_tag_title('', false) ); ?>
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <?php printf(_c('Greinasafn %s'), get_the_time(__('M j, Y'))); ?>
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
            <?php printf(_c('Greinasafn %s'), get_the_time(__('F, Y'))); ?>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
            <?php printf(_c('Greinasafn %s'), get_the_time(__('Y'))); ?>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
            <?php printf(__('&raquo; Greinar eftir %s'), get_the_author_meta('name2') ); ?>
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            <?php _e('Arkífur'); ?>
            <?php } ?>

    </div> 

    <?php get_template_part('loop'); ?>

    <?php get_template_part('pagination'); ?>

<?php get_footer(); ?>
