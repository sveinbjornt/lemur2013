
<?php if ( have_posts() ) : ?>

<div class="grid gutter greinasafn">
    <?php while ( have_posts() ) : the_post(); ?>
    
        <div class="col s1of3 grein">
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

<?php endif; ?>