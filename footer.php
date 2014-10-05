                    </div>

                    <div class="col s1of3 sidebar">
                        <?php get_sidebar(); ?>
                    </div>
            
                </div>
            </div>
        
            <footer class="footer">
            
                <div class="grid gutter collapse720">
                    <div class="col s2of3">
                        
                        <!-- Footer text -->
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/minilem.png" style="float: left; margin-top: -45px; margin-right: 25px;" alt="Lemúrinn">
                        <p>
                            <strong>Lemúrinn</strong> er veftímarit um allt, stofnað í október 2011. <a href="<?php echo get_bloginfo('wpurl'); ?>/um" title="Nánar um Lemúrinn">Nánar...</a>
                            <br>
                            Ábendingar sendist á netfangið <a href="mailto:lemurinn@lemurinn.is">lemurinn [hjá] lemurinn.is</a>.
                        </p>
                    
                    </div>
                    <div class="col s1of3">
                    
                        <!-- Social buttons -->
                        <div class="social text-right">
                            <!--<a href="http://reddit.com/r/lemurinn" title="Lemúrinn á Reddit">
                                <i class="icon-reddit"></i>
                            </a>-->
                            <a href="https://www.facebook.com/lemurinn" title="Lemúrinn á Feisbúkk">
                                <i class="icon-facebook"></i>
                            </a>
                            <a href="https://twitter.com/Lemurinn" title="Lemúrinn á Twitter">
                                <i class="icon-twitter"></i>
                            </a>
                            <a href="<?php echo get_bloginfo('wpurl'); ?>/feed/" title="RSS-veita Lemúrsins">
                                <i class="icon-feed"></i>
                            </a>
                        </div>
                    
                    </div>
                </div>
            
            </footer>
        
        </div>
        
        <?php wp_footer(); ?>        
        <script src="<?php echo get_template_directory_uri() ?>/assets/js/lemur.js" defer></script>
        
            <!--<script src="<?php echo get_template_directory_uri() ?>/assets/js/jquery.twentytwenty-combined.js"></script>-->
    </body>

</html>