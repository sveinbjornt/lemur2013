<?php
/*
    Template Name: All Links 
*/
?>

<html>
<body>
<?php 
    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>100000)); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); ?>
 
<?php endif; ?>

</body>
</html>