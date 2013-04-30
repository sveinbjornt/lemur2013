<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class('post clear single'); ?> id="post_<?php the_ID(); ?>">
        
        	<h2>
        	    <a href="<?php the_permalink() ?>">
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
        	<div>
        	    <?php if ( has_post_thumbnail() ) :?>
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
        	    <?php the_content(); ?>
        	</div>
        	
        	<div class="post-footer">                                              
        	    <div class="flokkar">
        	        <?php the_tags(__('<strong>Flokkar: </strong>'), ', '); ?>
        	    </div>

                <fb:like href="<?php the_permalink() ?>" layout="standard" show_faces="false" width="450" action="like" colorscheme="light"></fb:like>                  
                            
                <?php comments_template(); ?>
            </div>
        </div>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>