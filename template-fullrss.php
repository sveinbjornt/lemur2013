<?php
/*
    Template Name: Full RSS
*/
    header('Content-type: application/rss+xml');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

<channel>
    <title>Lemúrinn</title>
    <link>http://lemurinn.is</link>
    <description>tímarit um allt</description>
    <lastBuildDate>Thu, 15 Dec 2018 20:50:21 +0000</lastBuildDate>
    <language>is</language>
    <image>
        <title>Lemúrinn</title>
        <url>http://lemurinn.is/wp-content/themes/lemur2013/assets/images/lemur-fb-icon.jpg</url>
        <link>http://lemurinn.is</link>
        <width>760</width>
        <height>760</height>
        <description>Lemúrinn er furðuleg vera, rétt eins og náfrændi hans maðurinn.</description>
    </image>
</channel>

<?php 
    $wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>100000)); 
?>
 
<?php if ( $wpb_all_query->have_posts() ) : ?>
 
    <!-- the loop -->
    <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
        <item>
            <title><?php the_title(); ?></title>
            <link><?php the_permalink(); ?></link>
            <pubDate><?php echo get_the_date('c'); ?></pubDate>
        </item>
    <?php endwhile; ?>
    <!-- end of the loop -->

 
    <?php wp_reset_postdata(); ?>
 
<?php endif; ?>

</rss>
