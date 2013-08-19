                    </div>

                    <div class="col s1of3 sidebar">
                        <?php get_sidebar(); ?>
                    </div>
            
            
                </div>
            </div>
        
            <footer class="footer">
            
                <div class="grid gutter collapse720">
                    <div class="col s2of3">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/minilem.png" style="float: left; margin-top: -45px; margin-right: 25px;" alt="Lemúrinn">
                        <p><strong>Lemúrinn</strong> er veftímarit um allt, stofnað í október 2011. <a href="<?php echo get_bloginfo('wpurl'); ?>/um" title="Nánar um Lemúrinn">Nánar...</a>
                            <br>
                            Ábendingar sendist á netfangið <a href="mailto:lemurinn@lemurinn.is">lemurinn [hjá] lemurinn.is</a>.</p>
                    
                    </div>
                    <div class="col s1of3">
                    
                        <div class="social text-right">
                            <a href="https://www.facebook.com/lemurinn" title="Lemúrinn á Feisbúkk"><i class="icon-facebook"></i></a>
                            <a href="https://twitter.com/Lemurinn" title="Lemúrinn á Twitter"><i class="icon-twitter"></i></a>
                            <a href="<?php echo get_bloginfo('wpurl'); ?>/feed/" title="RSS-veita Lemúrsins"><i class="icon-feed"></i></a>
                        </div>
                    
                    </div>
                </div>
            
            </footer>
        
        </div>
        
        <?php wp_footer(); ?>
        
        <?php if ( is_single() ): ?>
        <!-- Fancybox -->
        <!-- <script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.fancybox.pack.js"></script> -->
        <!--<script>
           
        var fb_options = {
            'openEffect': 'elastic',
            'closeEffect': "elastic", 
            // 'centerOnScroll': true,
            'closeClick': true,
            'autoSize': true,
            'fitToView': true,
            'aspectRatio': true,
            'scrollOutside': false,
            'helpers' : {
                    title: {
                    type: 'inside'
                }
            }
        };

        jQuery(document).ready(function($) {
            
            $('.post > div.featured-image > a').fancybox(fb_options);
            
            $('.post > .post-content img').each(function() {
                
                var p = $(this).parents('a'),
                    t = $(this).attr('title'),
                    h = $(this).attr('src'),
                    fbo = $.extend({}, fb_options);
                                
                if (p.length) {
                    t = $(p[0]).attr('title') ? $(p[0]).attr('title') : t;
                    h = $(p[0]).attr('href') ? $(p[0]).attr('href') : h;
                } 
                
                fbo.href = h, fbo.title = t;
                // $(p[0]).attr('rel', 'gallery');
                $(this).fancybox(fbo);
            });
            
        });
        </script>-->
        <?php endif; ?>
        
        <!-- YouTube Placeholder -->
        <script src="<?php echo get_template_directory_uri() ?>/assets/js/youtube-placeholder.js"></script>
        
        <!-- Google Analytics -->
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-25230683-1']);
            _gaq.push(['_trackPageview']);
            
            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>

        <!-- Facebook Initialization -->
        <script>
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/is_IS/all.js#xfbml=1&status=0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
                
    </body>

</html>