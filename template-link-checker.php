<?php
/*
    Template Name: Link Checker
 */
?>

<?php get_header(); ?>

<h2>YouTube hlekkir</h2>

<table border="1" cellpadding="4">
    <tr>
       <td><small><strong>Nafn</strong></small></td>
       <td><small><strong>Vídjó</strong></small></td>
    </tr>


<?php query_posts('posts_per_page=10000'); ?>

<?php if (have_posts()) : ?>
     <?php while(have_posts()) : the_post(); ?>
        
         <?php
             $yt_matches = array();
             preg_match_all( "/((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*))|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtu\.be\/([a-zA-Z0-9\-\_]{11}))|((http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?metacafe\.com\/watch\/([a-zA-Z0-9\-\_]{7})\/([^<^\/\s]*)([\/])?)|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?vimeo\.com\/([a-zA-Z0-9\-\_]{8})([\/])?)|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?liveleak\.com\/view(\?i\=)([a-zA-Z0-9\-\_]*))|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?facebook\.com\/video\/video.php\?v\=([a-zA-Z0-9\-\_]*))|((http(vp|vhp)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/(view_play_list\?p\=|playlist\?list\=)([a-zA-Z0-9\-\_]{18,34})([^<\s]*))/", $post->post_content, $yt_matches, PREG_SET_ORDER );
             
             $yt_links = array();
             $failed = 0;
             
             foreach ($yt_matches as $match) {
                if (strlen($match[6]) > 0) {
                    $img_url = 'https://img.youtube.com/vi/' . $match[6] . '/hqdefault.jpg';
                    $vid_url = 'https://youtube.com/watch?v=' . $match[6];
                    
                    #sleep(0.01);
                    $resp = get_headers($img_url);
                    $status = $resp[0];

                    # Check if status is 200 OK
                    if (!preg_match('/OK/', $status)) { 
                        $failed = 1;
                        array_push($yt_links, $vid_url);
                    }
                }
            }
        ?>
        
        <?php if ($failed): ?>
            <tr>
                <td><a href="<?php the_permalink(); ?>"><small><?php the_title(); ?></small></a></td>
                <td>
                    <?php foreach ($yt_links as $link): ?>
                        <a href="<?php echo $link; ?>">
                            <i class="icon-video-camera" style="color:red;"></i>
                        </a>
                    <?php endforeach ?>
                </td>
            </tr>
        <?php endif; ?>
         
    <?php endwhile; ?>
<?php endif; ?>

</table>


<?php get_footer(); ?>
