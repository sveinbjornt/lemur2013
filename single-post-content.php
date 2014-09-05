<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class('post clear single'); ?> id="post_<?php the_ID(); ?>">
        
    	    <?php get_template_part('post-header'); ?>
    	    
        	<div class="post-content">
        	    <?php the_content(); ?>
        	</div>
        	
        	<?php get_template_part('post-footer'); ?>
            
        </div>
        
    <?php endwhile; ?>
<?php endif; ?>