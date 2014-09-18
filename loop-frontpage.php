<?php
    $page_num = $paged;
    if ($pagenum == '') { 
        $pagenum = 1;
    }
    query_posts('category_name=forsida&showposts=6&paged=' . $page_num); 
?>

<?php get_template_part('loop'); ?>
