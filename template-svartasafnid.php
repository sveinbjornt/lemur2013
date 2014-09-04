<?php
/*
    Template Name: Svarta safnið
*/
?>

<?php get_header(); ?>
<?php $paged = get_query_var('paged');
query_posts('cat=-637,26&paged='.$paged); ?>
<?php get_template_part('loop-greinasafn'); ?>
<?php get_template_part('pagination'); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
