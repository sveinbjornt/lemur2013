<?php
/*
    Template Name: Single Gallery Item
 */
?>
<?php
    $gallery_post_id = $_GET['gallery_post_id'];
?>
<?php if ($gallery_post_id): ?>
    <? query_posts('p=' . $gallery_post_id); ?>
    <div style="padding: 20px;">
    <?php get_template_part('single-post-content'); ?>
    </div>
<? endif; ?>