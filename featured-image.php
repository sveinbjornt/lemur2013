<?php $ttitle = trim(strip_tags( $post->post_title )) ?>

<?php if ( in_category('utvarplemur') and has_post_thumbnail() ) { ?>
    <?php $ttitle = trim(strip_tags( $post->post_title )) ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'myndin' ); ?>
    
    <a style="background-image: url('<?php echo $image[0]; ?>');" 
        class="play-link" 
        title="<?php echo $ttitle; ?>"
        href="<?php
        global $post;
        $mp3_url = get_post_meta($post->ID, 'remote_mp3_url', true);
        if ($mp3_url and $mp3_url != '') {
            echo $mp3_url;
        } else {
            echo the_permalink();
        }
        ?>">
        <?php if ($mp3_url and $mp3_url != ''): ?>
            <img src="https://lemurinn.is/images/utvarp-play-overlay.png" class="play-overlay" alt="Spila þáttinn">
        <?php endif; ?>
    </a>

<?php } else if ( !in_category('vidjo') and has_post_thumbnail() ) { ?>
    <?php
        $featured_link = get_permalink($post->ID);
        if (is_single()) {
            $featured_link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        }
    ?>
    
    <a href="<?php echo $featured_link; ?>" title="<?php echo $ttitle ?>">
        <?php 
            $imgtype = in_category('panorama-2') ? '' : 'myndin';
            the_post_thumbnail($imgtype, array(
            'alt'	=> $ttitle,
            'title'	=> $ttitle,
            'class' => 'image'
            )); 
        
        ?>
    </a>
<?php }; ?>
