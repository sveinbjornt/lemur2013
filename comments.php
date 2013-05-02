<?php if ( comments_open() ) : ?>
<div class="comments">
    <?php if ( post_password_required() ) : ?>
                    <p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.'); ?></p>
                </div><!-- #comments -->
    <?php
            /* Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
             */
            return;
        endif;
    ?>

    <?php
        // You can start editing here -- including this comment!
    ?>

    <div id="comments">
    
    <a href="comments"></a>
<fb:comments href="<?php the_permalink(); ?>" width="650"></fb:comments>  

<?php endif; ?></div></div>


    
    
<!-- #comments -->