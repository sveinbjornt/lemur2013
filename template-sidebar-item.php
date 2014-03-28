<?php
/*
    Template Name: Lemurskort Sidebar Item
*/
?>
<?php
    $tag = $_GET['tag'];
    $num_posts = 10;
?>

<?php $my_query = new WP_Query('tag=' . $tag . '&showposts=' . $num_posts . '&orderby=rand'); ?>
<div id="lemurmap-results" 
data-count="<?php
    $number_of_posts = (have_posts()) ? sizeof($my_query->posts) : 0;
    echo $number_of_posts;
?>" 
data-max="<?php echo $num_posts; ?>" 
style="display: none;"></div>
<div class="grid gutter greinasafn">
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
        <div class="col s1of5 grein full">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
            
                <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('sidebar', array(
                            'alt'	=> trim(strip_tags( $post->post_title )),
                            'title'	=> trim(strip_tags( $post->post_title )),
                            'class' => 'image'
                        )); ?>
                <?php endif; ?>
                <h2><?php the_title(); ?></h2> 
            </a>
            
        </div>
        
    <?php endwhile; ?>
</div>