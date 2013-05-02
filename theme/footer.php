                </div>

                <div class="col s1of3 side">
                    <?php get_sidebar(); ?>
			    </div>
			
			
			</div>

			<footer class="footer">
				
				<div class="grid gutter collapse600">
					<div class="col s2of3">
						<img src="/images/minilem.png" style="float: left; margin-top: -45px; margin-right: 25px;">
						<p><strong>Lemúrinn</strong> er veftímarit um allt, stofnað í október 2011. <a href="/um" title="Nánar um Lemúrinn">Nánar...</a>
						    <br>
						    Ábendingar sendist á netfangið <a href="mailto:lemurinn@lemurinn.is">lemurinn [hjá] lemurinn.is</a>.</p>
						
					</div>
					<div class="col s1of3">
						
						<div class="social text-right">
							<a href="https://www.facebook.com/lemurinn" title="Lemúrinn á Feisbúkk"><i class="icon-facebook"></i></a>
							<a href="https://twitter.com/Lemurinn" title="Lemúrinn á Twitter"><i class="icon-twitter"></i></a>
							<a href="/feed/" title="RSS"><i class="icon-feed"></i></a>
						</div>
						
					</div>
				</div>
				
			</footer>

		</div>
		
		<?php wp_footer(); ?>
		
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
            window.fbAsyncInit = function(){
                FB.init({
                    appId      : '186476388086986', // App ID
                    status     : true, // check login status
                    cookie     : true, // enable cookies to allow the server to access the session
                    xfbml      : true  // parse XFBML
                });
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