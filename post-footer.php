<div class="post-footer">                                              
    <div class="flokkar">
        <?php the_tags(__('<strong>Flokkar:&nbsp;&nbsp;</strong>'), '&nbsp; '); ?>
    </div>

    <div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-action="like" data-width="670" data-show-faces="false" data-colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>" data-layout="standard"></div>

    <div class="comments">
        <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-num-posts="10" data-colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></div>
    </div>
    
</div>