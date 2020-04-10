
<?php if ( have_posts() ) : ?>

    <div class="grid gutter greinasafn">
        <?php while ( have_posts() ) : the_post(); ?>
            
            <?php // Get category 
                $cat_name = "Grein";
                $cat_class = "generic";
                $category = get_the_category(); 
                
                // Excluded categories
                $excluded = array("forsida", 'panorama-2', 'excluded');
                $cat_names = array();
                $cat_slugs = array();
                for ($i = 0; $i < sizeof($category); $i++) {
                    if ($category[$i]) {
                        if (!in_array($category[$i]->slug, $excluded)) {
                            array_push($cat_names, $category[$i]->cat_name);
                            array_push($cat_slugs, $category[$i]->slug);
                        }
                    }
                }
                
                if (sizeof($cat_names)){
                    $cat_name = $cat_names[0];
                    $cat_class = $cat_slugs[0];
                }
                
                $title = get_the_title();
                // if (strlen($title) > 87) {
                //     $list = split(':', $title);
                //     if (count($list) <= 1) {
                         
                //     } else {
                //          $title = $list[1];
                //     }                    
                // }
                if (strlen($title) > 87) {
                    $title = substr($title, 0, 86);
                    $title = $title . '…';
                }
                
                
            
            ?>
            
            <div class="col s1of3 grein">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('sidebar', array(
                                'alt'   => trim(strip_tags( $post->post_title )),
                                'title' => trim(strip_tags( $post->post_title )),
                                'class' => 'image'
                            )); ?>
                    <?php endif; ?>
                    <div class="grein-category <?php echo $cat_class; ?>"><?php echo $cat_name; ?></div>
                    <h2><?php echo $title; ?></h2> 
                </a>
            </div>
        
        <?php endwhile; ?>
    </div>

<?php endif; ?>