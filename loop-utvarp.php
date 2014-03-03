<img src="http://lemurinn.is/images/utvarp-lemur.jpg" style="margin-bottom: 20px;">
<?php $my_query = new WP_Query('category_name=utvarplemur&showposts=50&orderby=date'); ?>
<?php $counter = $my_query->found_posts; ?>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <div class="utvarp-post grid">
        <h2>
            <a href="<?php the_permalink() ?>">
                <?php the_title(); ?>
            </a>
        </h2>
        <div class="utvarp-description">
            <?php if (has_post_thumbnail()): ?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sidebar
                ' ); ?>
            
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
    
            <?php endif; ?>
            <div>
                <span class="post-date"><?php the_time(__('j. F, Y')) ?> | </span>
                <?php echo improved_trim_excerpt('', 35, 'Nánar'); ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
