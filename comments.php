<?php if ( comments_open() ) : ?>
<div class="comments" id="comments">
    <fb:comments href="<?php the_permalink(); ?>" width="670" colorscheme="<?php if ( in_category(26) ) { echo 'dark'; } else { echo 'light'; } ?>"></fb:comments>  
</div>

<?php endif; ?>