<?php
/*
    Template Name: Lemurskort Sidebar Item
*/
?>
<?php
    $tag = $_GET['tag'];
?>

<?php $my_query = new WP_Query('tag=' . $tag . '&showposts=12&orderby=rand'); ?>
<!--<div class="sidebar-box post-list">
    <ul class="article-list">
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
            <li>
        		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        	        <div class="figure">
        	        	<div class="aspect album">
        	        		<?php the_post_thumbnail('sidebar'); ?>
        	        	</div>
        	        </div>
        	        <p><?php the_title_attribute(); ?></p>
        		</a>
        	</li>
        <?php endwhile; ?>
    </ul>
</div>-->


<div class="grid gutter greinasafn">
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
        <div class="col s1of6 grein">
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