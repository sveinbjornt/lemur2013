
<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <div class="utvarp-post grid">
            <h2>
                <?php if (is_user_logged_in()): ?>
                    <div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-width="60" data-show-faces="false" data-action="like" data-colorscheme="light" data-layout="button_count" style="float: right;"></div>
                <?php endif; ?>
                
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <div class="utvarp-description">
                <?php if (has_post_thumbnail()): ?>
                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sidebar' ); ?>
            
                    <a style="background-image: url('<?php echo $image[0]; ?>');" class="play-link" href="<?php
                        global $post;
                        $mp3_url = get_post_meta($post->ID, 'remote_mp3_url', true);
                        if ($mp3_url and $mp3_url != '') {
                            echo $mp3_url;
                        } else {
                            echo the_permalink();
                        }
                        ?>" title="Hlusta á <?php the_title(); ?>">
                        <?php if ($mp3_url and $mp3_url != ''): ?>
                            <img src="https://lemurinn.is/images/utvarp-play-overlay.png" class="play-overlay" alt="Spila þennan þátt">
                        <?php endif; ?>
                    </a>
    
                <?php endif; ?>
                <div>
                    <span class="post-date"><?php the_time(__('j. F, Y')) ?> | </span>
                    <?php echo improved_trim_excerpt('', 35, 'Nánar'); ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>