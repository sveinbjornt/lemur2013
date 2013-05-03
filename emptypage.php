<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>

            <div <?php post_class('single clear page'); ?> id="post_<?php the_ID(); ?>">
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            </div>

        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?> 