<?php if ( have_posts() ) : ?>
    <div id="loop" class="list clear">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <div <?php post_class('post clear'); ?> id="post_<?php the_ID(); ?>">
                
                <?php get_template_part('post-header'); ?>
            	
            	<div class="post-content">
                    <?php echo improved_trim_excerpt('', 60, 'Lesa meira'); ?>
            	</div>
            </div>
            
        <?php endwhile; ?>
    </div>
<?php endif; ?>
