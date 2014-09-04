<?php
/*
    Template Name: Gallerí
*/
?>
 
<?php get_header(); ?>


</div>

<div class="col s1of3">
</div>

</div>


<!-- START OF CONTENT -->


<?php 


$paged = get_query_var('paged');
query_posts('cat=63,&posts_per_page=30&paged='.$paged); 

?>

<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
                
        <?php if (has_post_thumbnail()): ?>
                <a href="/wordpress/single-gallery-item/?gallery_post_id=<?php the_id(); ?>" class="gallery-link fancybox">
                <?php the_post_thumbnail('sidebar', array(
                    'alt'	=> trim(strip_tags( $post->post_title )),
                    'title'	=> trim(strip_tags( $post->post_title )),
                    'class' => 'image',
                    'style' => 'width: 19.5%; height: auto; margin: 0; padding: 0;'
                )); ?>
                </a>
        <?php endif; ?>
        
    <?php endwhile; ?>

<?php endif; ?>

<script type="text/javascript">
$(function(){
    $('.sidebar').hide();
    
    $('.gallery-link').fancybox({ type: 'ajax', maxWidth: 670 });
});


</script>


<!-- END OF CONTENT -->

<div class="grid gutter collapse720">
    
    <div class="col s2of3">


<?php get_footer(); ?>
