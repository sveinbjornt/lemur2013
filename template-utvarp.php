<?php
/*
    Template Name: Útvarp Lemúr
*/
?>

<?php get_header(); ?>

<img src="http://lemurinn.is/images/utvarp-lemur.jpg" style="margin-bottom: 20px; max-width: 100%;" alt="Útvarp Lemúr">

<?php $paged = get_query_var('paged');
query_posts('category_name=utvarplemur,&paged='.$paged); ?>
<?php get_template_part('loop-utvarp'); ?>
<?php get_template_part('pagination'); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>
