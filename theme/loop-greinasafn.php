
<?php if ( have_posts() ) : ?>

<div class="grid gutter greinasafn">
    <?php while ( have_posts() ) : the_post(); ?>
    
        <div class="col s1of3 grein">
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
            
                <?php if (has_post_thumbnail() and !in_category('139')): ?>
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


<?php endif; ?>

<!--
<?php if ( have_posts() ) : ?>
    <div id="loop" class="list clear">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <div <?php post_class('post clear'); ?> id="post_<?php the_ID(); ?>">
                
            	<h2>
            	    <a href="<?php the_permalink()?> title="<?php the_title(); ?>">
            	        <?php the_title(); ?>
            	    </a>
            	</h2>
            	
            	<div class="post-meta">
            	    eftir 
            	    <a class="author" href="<?php $id = get_the_author_meta('ID'); echo get_author_posts_url($id); ?>" title="Greinar eftir <?php the_author_meta( 'name2' ); ?>">
            	        <?php the_author_meta('name2'); ?>
            	    </a> 
            	    <span class="post-date">
            	        ✦ <?php the_time(__('j. F, Y')) ?>
            	    </span>
            	</div>
            	<div class="featured-image">
        	        <?php if (has_post_thumbnail() and !in_category('139')): ?>
                        <a href="<?php the_permalink() ?>" title="">
                            <?php the_post_thumbnail('myndin', array(
                                'alt'	=> trim(strip_tags( $post->post_title )),
                                'title'	=> trim(strip_tags( $post->post_title )),
                                'class' => 'image'
                            )); ?>
                        </a>
                    <?php endif; ?>            	          	    
            	</div>
            	
            	<div class="post-content">
            	    <?php if ( in_category('139') ) { ?>
                    	<?php echo improved_trim_excerpt(''); ?>
                    <?php } else { ?>
                        	<?php echo improved_trim_excerpt(''); ?>
                    <?php } ?>
            	    
            	</div>
            </div>
            
        <?php endwhile; ?>
    </div>
<?php endif; ?>
-->