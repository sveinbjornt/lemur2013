<?php if (get_option('paging_mode') == 'default') : ?>
    <div class="pagination">
        <?php previous_posts_link(__('Nýrra')); ?>
        <?php next_posts_link(__('Eldra')); ?>
        <?php if (function_exists('wp_pagenavi')) wp_pagenavi(); ?>
    </div>
    <?php else : ?>
    <div id="pagination"><?php next_posts_link(__('FLEIRI GREINAR')); ?></div>
<?php endif; ?>