        </div>
        <!-- /Content -->

        <?php get_sidebar(); ?>

        <!-- /Container -->

        <div style="clear:both"></div>
        <div class="footer">
            
        </div>          

        
        </div>
        </div>
    </div>
    <?php wp_footer(); ?>

    <!-- Google Analytics -->
    <?php echo (get_option('ga')) ? get_option('ga') : '' ?>
    
    <!-- Facebook Initialization -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '186476388086986', // App ID
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        //
        // All your canvas and getLogin stuff here
        //
      };

      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/is_IS/all.js";
         d.getElementsByTagName('head')[0].appendChild(js);
       }(document));
    </script>

    </body>
</html>