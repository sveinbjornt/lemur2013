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
            	        <?php the_author_meta('name2'); $c = get_post_meta($post->id, "geotag_country", true); echo $c; ?> 
            	    </a> 
            	    <span class="post-date">
            	        ♦ <?php the_time(__('j. F, Y')) ?>
            	    </span>
            	</div>
            	
            	<div class="col s1of3 facebook-like">
            	    <div class="fb-like" data-action="recommend" data-href="<?php the_permalink() ?>" data-send="false" data-width="60" data-show-faces="false" data-colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="button_count"></div>
                </div>
                
        	</div>
        	
        	
        	<div class="featured-image">
        	    <?php if ( in_category('utvarplemur') and has_post_thumbnail() ) { ?>
        	        <?php $ttitle = trim(strip_tags( $post->post_title )) ?>
        	        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'myndin' ); ?>
    	            
    	            <a style="background-image: url('<?php echo $image[0]; ?>');" class="play-link" href="<?php
                        global $post;
                        $mp3_url = get_post_meta($post->ID, 'remote_mp3_url', true);
                        if ($mp3_url and $mp3_url != '') {
                            echo $mp3_url;
                        } else {
                            echo the_permalink();
                        }
                        ?>">
                        <?php if ($mp3_url and $mp3_url != ''): ?>
                            <img src="http://lemurinn.is/images/utvarp-play-overlay.png" class="play-overlay">
                        <?php endif; ?>
                    </a>

        	    <?php } else if ( !in_category('139') and has_post_thumbnail() ) { ?>
        	        <?php $ttitle = trim(strip_tags( $post->post_title )) ?>
                    <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" title="<?php echo $ttitle ?>">
                        <?php the_post_thumbnail('myndin', array(
                            'alt'	=> $ttitle,
                            'title'	=> $ttitle,
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

                <div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-action="like" data-width="670" data-show-faces="false" data-colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="standard"></div>

                <div class="comments">
                    <div class="fb-comments" data-href="<?php the_permalink(); ?>" style="width: 100%;" data-width="670" data-num-posts="10" data-colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></div>
                </div>
                
            </div>
            
        </div>
        
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>