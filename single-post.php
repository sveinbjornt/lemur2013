<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class('post clear single'); ?> id="post_<?php the_ID(); ?>">
        
        	<h2>
        	    <a href="<?php the_permalink() ?>">
        	        <?php the_title(); ?>
        	    </a>
        	</h2>
        	
        	
        	<div class="post-meta grid">
        	    
        	    <div class="col s2of3">
        	        eftir 
            	    <a class="author" href="<?php $id = get_the_author_meta('ID'); echo get_author_posts_url($id); ?>" title="Greinar eftir <?php the_author_meta( 'name2' ); ?>">
            	        <?php the_author_meta('name2'); ?>
            	    </a> 
            	    <span class="post-date">
            	        ✦ <?php the_time(__('j. F, Y')) ?>
            	    </span>
            	</div>
            	
            	<div class="col s1of3 fb-like">
            	    <?php if ( !is_home() ) { ?>
                	    <fb:like href="<?php the_permalink() ?>" layout="button_count" show_faces="false" width="60" action="like" colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>">
                	<?php } ?>
                </div>
                
        	</div>
        	
        	
        	<div class="featured-image">
        	    <?php if ( !in_category('139') and has_post_thumbnail() ) { ?>
                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>">
                        <?php the_post_thumbnail('myndin', array(
                            'alt'	=> trim(strip_tags( $post->post_title )),
                            'title'	=> trim(strip_tags( $post->post_title )),
                            'class' => 'image'
                        )); ?>
                    </a>
                <?php }; ?>
        	</div>
    	
        	<div class="post-content">
        	    <?php the_content(); ?>
        	</div>
        	
        	<div class="post-footer">                                              
        	    <div class="flokkar">
        	        <?php the_tags(__('<strong>Flokkar: </strong>'), ', '); ?>
        	    </div>

                <fb:like href="<?php the_permalink() ?>" layout="standard" show_faces="false" width="670" action="like" colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></fb:like>                  
                            
                <?php comments_template(); ?>
            </div>
        </div>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>