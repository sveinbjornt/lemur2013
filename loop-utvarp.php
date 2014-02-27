<img src="http://lemurinn.is/images/utvarp-lemur.jpg" style="margin-bottom: 20px;">
<?php $my_query = new WP_Query('cat=26&showposts=4&orderby=date'); ?>
<?php $counter = $my_query->found_posts; ?>
<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <?php $counter-- ;?>
    <div class="utvarp-post">
        <h2><?php 
            echo "Þáttur " . $counter . ": ";
            the_title();
        ?></h2>
        <div class="grid gutter collapse600" style="margin-bottom: 20px;">
            <div class="col s1of3">
                <?php if (has_post_thumbnail()): ?>
                    
                    
                        <?php the_post_thumbnail('sidebar', array(
                            'alt'	=> trim(strip_tags( $post->post_title )),
                            'title'	=> trim(strip_tags( $post->post_title )),
                            'class' => 'image'
                        )); ?>
                <?php endif; ?>
                <div class="post-meta">
                    <span class="post-date">
                        <?php the_time(__('j. F, Y')) ?>
        	        </span>
        	    </div>
            </div>
            <div class="col s2of3 utvarp-description">
                <p class="small"><?php echo improved_trim_excerpt('', 40); ?></p>
            </div>
        </div>
    </div>
<?php endwhile; ?>
