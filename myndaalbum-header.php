<?php $my_query = new WP_Query('cat=63&showposts=4&orderby=rand'); ?>

<div class="grid gutter collapse600 myndaalbum-top">
    <div class="col s1of3">
        
        <p><span class="cat-title">Myndaalbúm Lemúrsins</span> geymir forvitnilegar ljósmyndir úr sögunnar rás. Flestar myndirnar eru frá opinberum stofnunum eða söfnum víða um heim.</p>
        
    </div>
    <div class="col s2of3">
        
        <div class="grid gutter photos top">
            
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>     
                <div class="col s1of4">
                    <div>
                        <a class="aspect album" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_post_thumbnail('sidebar'); ?>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            
        </div>

    </div>
</div>