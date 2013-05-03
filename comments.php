<?php if ( comments_open() ) : ?>
<div class="comments" id="comments">
    <fb:comments href="<?php the_permalink(); ?>" width="670" style="max-width: 100%;"></fb:comments>  
</div>
<?php endif; ?>