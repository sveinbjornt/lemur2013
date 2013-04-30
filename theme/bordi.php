<div class="grid gutter collapse600">
	<?php $my_query = new WP_Query('cat=597&showposts=3'); ?>
	
	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<div class="col s1of3">
		<div class="article-item">
		    
		        <div class="thumb aspect a4-3">
		            <a class="" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		                <?php the_post_thumbnail('bordi'); ?>
		            </a>
		        </div>
    			
    			<h2 class="headline">
    			    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    			</h2>
    			
    			<div class="main">
    				<p><?php
                    global $post;
                    echo get_post_meta($post->ID, 'bordi', true);
                    ?></p>
    			</div>
			
		</div>
	</div>
	<?php endwhile; ?>

</div>