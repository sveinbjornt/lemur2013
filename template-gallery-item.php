<?php
/*
    Template Name: Single Gallery Item
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