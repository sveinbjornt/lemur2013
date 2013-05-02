<?php if (get_option('paging_mode') == 'default') : ?>
    <div class="pagination grid">
        <div class="col s1of2">
        <?php previous_posts_link(__('<< Nýrra')); ?>
        </div>
        <div class="col s1of2">
        <?php next_posts_link(__('Eldra >>')); ?>
        </div>
    </div>
    <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); ?>
    <?php else : ?>
    <div id="pagination"><?php next_posts_link(__('FLEIRI GREINAR')); ?></div>
<?php endif; ?>