<div class="grid gutter collapse720 bordi">
	<?php $my_query = new WP_Query('cat=597&showposts=3'); ?>
	
	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    	<div class="col s1of3 bordi-item">
		    
            <div class="thumb">
                <a class="" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail('bordi'); ?>
                </a>
            </div>

            <div class="main">
            	<h2>
            	    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            	</h2>


            	<p><?php
                global $post;
                echo get_post_meta($post->ID, 'bordi', true);
                ?></p>
            </div>	
        </div>
    <?php endwhile; ?>

</div>