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
                	    <a class="author" href="<?php $id = get_the_author_meta('ID'); echo get_author_posts_url($id); ?>" title="Greinar eftir <?php the_author_meta( 'name2' ); ?>">
                	        eftir 
                	        <?php the_author_meta('name2'); ?>
                	    </a> 
                	    <span class="post-date">
                	        ♦ <?php the_time(__('j. F, Y')) ?>
                	    </span>
                	</div>
                	
                	<div class="col s1of3 facebook-like">
                	    <div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-width="60" data-show-faces="false" data-action="like" data-colorscheme="<?php if ( is_category('svortu') or (in_category('svortu') and is_single())) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="button_count"></div>
                    </div>
                    
            	</div>
            	<div class="featured-image">
                    <?php get_template_part('featured-image'); ?>
            	</div>
            	
            	<div class="post-content">
                    <?php echo improved_trim_excerpt('', 60, 'Lesa meira'); ?>
            	</div>
            </div>
            
        <?php endwhile; ?>
    </div>
<?php endif; ?>
