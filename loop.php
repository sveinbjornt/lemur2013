<?php if ( have_posts() ) : ?>
    <div id="loop" class="list clear">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <div <?php post_class('post clear'); ?> id="post_<?php the_ID(); ?>">
                
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
                	        ♦ <?php the_time(__('j. F, Y')) ?>
                	    </span>
                	</div>
                	
                	<div class="col s1of3 facebook-like">
                	    <div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-width="60" data-show-faces="false" data-action="recommend" data-colorscheme="<?php if ( is_category('svortu') or (in_category('svortu') and is_single())) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="button_count"></div>
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
                            <a href="<?php the_permalink() ?>" title="<?php echo trim(strip_tags( $post->post_title )); ?>">
                                <?php the_post_thumbnail('myndin', array(
                                    'alt'	=> trim(strip_tags( $post->post_title )),
                                    'title'	=> trim(strip_tags( $post->post_title )),
                                    'class' => 'image'
                                )); ?>
                            </a>
                        <?php } ?>            	          	    
            	</div>
            	
            	<div class="post-content">
                    <?php echo improved_trim_excerpt('', 60, 'Lesa meira'); ?>
            	</div>
            </div>
            
        <?php endwhile; ?>
    </div>
<?php endif; ?>
