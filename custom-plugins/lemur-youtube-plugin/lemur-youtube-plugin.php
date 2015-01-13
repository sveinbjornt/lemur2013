<?php
/*
Plugin Name: Lemúr Youtube Plugin
Description: Use placeholders for YouTube video URLs in posts.
Author: Sveinbjorn Thordarson
Version: 7.7
Author URI: http://www.sveinbjorn.org


To-Do: 

- Is there a way to have smart youtube display multiple thumbnails of youtube videos in this fashion:
http://wordpress.org/extend/plugins/my-youtube-playlist/

The author of this plugin has done a good job in birthing the concept, but is unable to really do much by way of support or add features, e.g. highlight thumbnail currently playing, flexible grouping styles of thumbnails (horizontal, vertical listing) etc.

- Wondering if there's a way to have smartyoutube generate a thumbnail of the youtube video that shows up as one of the thumbnail options for the article when someone shares the blog post?

- Would it be possible to overwrite the global autoplay param in a post, something like httpv://www.youtube.com/watch?v=00000000&autoplay=true; I tried to add autoplay=1 but unfortunately in the resuling html it adds autoplay=0 (the global option) and also autoplay=1
The result is no autoplay :(

- Instead of editing the shortcut, we have copied from youtube.
I would love to have a button,
like insert Smart YouTube Video
A dialogue box would pop up,
and allow me to just simply paste the link.
Then having check boxes on the side,
which allow me to choose whether you would like HD or not.
thus editing the link correctly.

I find this would greatly help, especiall when I help create video blogs for community provider who have very little computer background.

- Please add support for it on the BuddyPress Acitivity page, currently it just shows the url (which won't work because of the httpv and httpvh)

- Was wondering if it was possible for you to have the plugin take the URL for the Youtube thumbnail for the video and place it into a user defined custom field. The plugin "YoutubeThumb2CustomField" but no longer works in WP 3.0 (network).

- love to see vimeo support! i have video intensive site...love Vimeo

Only issue is I would LOVE to add the widget into another sidebar and I do not see this possibility. Can you have multiple Smart YouTubes? 

- 1. Adding few possibilities for posting videos into post � I have great production of videos but before end of 2009 all was in 320 x 240 and after end of 2009 I start publishing video in 640 x 480 resolution. I have adjusted player video for 640 x 480 but now 320 x 240 videos are stretched across all of player window.

For changes to be easy implemented � I suggest adding 2 or even 3 possibilities for playing videos � like this:
Your original code httpv://www.youtube.com/********************
Another version of httpv#1://www.youtube.com/********************
Another version of httpv#2://www.youtube.com/********************
Another version of httpv#3://www.youtube.com/********************

Adding #1 after v will allow us to predefine what will be size of player for #1 or number #2 or number #3 � I think it is good idea

If you don�t put #1, #2, #3 player will be those which is default (without number) � in my case that is 640 x 480.

2. If some video is for �personal use� which mean somebody must be log into you tube to see it, than I suggest making possibility for login for authors of those videos � If I put all my materials to be private (up to 25 people can see it) � than I cant publish them trough this way � and allowing authors to write theirs username and password will allow that those vides can be seen on my posts. That way I can protect all my archive of video on youtube, but allow those video can be visible on my blog � which can increase hits, visits and others possibility � that possibility is visible on this plug in http://tubepress.org/ where people can use its username and password for publishing all vides from if they have account on youtube


- marinas javascript suggestion for hq videos
- add editor button
- The plugin places a preview image in the RSS feed which is great, but it links to the video on http://www.youtube.com. I would like to change it so the image links to the blog post so I can generate some traffic on my blog. 
- localization
- the images appear under the embedded Smart Youtube videos. Is there any way to edit the z-index for Smart Youtube CSS? I
- would like to use multiple instances of the Smart YouTube plugin. I saw the reply that said to simply use multiple calls in one instance of the widget, but that doesn't let me choose different videos for different pages. 
- was wondering if it's possible to get a vid and playlist in a custom page template?? Is it possible to add a preview image to search results?
- I wondered if there were a way to bring the video to the forefront layer (perhaps z-index)? I know this actually breaks good design practice in my intended use, but have a look here:
- However, on one page I have two videos and therefore I want to add a a parameter to the second video embed URL to _not_ start automatically. Something like httpv://www.youtube.com/watch?v=xyz123&autostart=off
- Single videos work well from wordpress on the Iphone/ipod. Is there a way to make the playlists work, just getting the ? cube instead of image.
- I would like to "inject" automatically this preview image url in a custom field, in each post, to auto-generate the thumb on my homepage with this image.
*/



if (isset($smart_youtube_pro)) return false;

$smart_youtube_pro = new SmartYouTube_PRO();

class SmartYouTube_PRO {
	var $local_version;
	var $plugin_url;
	var $options;
	var $key;
	var $first;
	var $first_post_on_archive;
	
	function SmartYouTube() {
		$this->__construct();
	}
	
	function __construct() {
		$this->local_version = '1.0'; // TODO: Change this number???
		
		$this->plugin_url = trailingslashit(plugins_url(null,__FILE__));
	
		
		$this->key = 'smart_youtube_pro';
		$this->first_post_on_archive = false;
		
		$script_path = $this->plugin_url . '/javascripts/jquery.colorbox-min.js';
		
		$this->options = $this->get_options();
							
		$this->add_filters_and_hooks();
	}
	
	function add_filters_and_hooks() {
		if ( $this->options['posts'] == 'on' ) {
			add_filter( 'the_content', array( $this, 'check' ), 5 );
			add_filter( 'the_excerpt', array( $this, 'check_excerpt' ), 5 );
		}
		
		if ( $this->options['comments'] == 'on' ) {
			add_filter( 'comment_text', array( $this, 'check' ), 100 );
		}
		
		add_action( 'plugins_loaded', array( $this, 'install' ) );
		add_action( 'admin_menu', array( $this, 'add_menu_items' ) );
		add_action( 'admin_head', array( $this, 'plugin_header' ) );
		add_action( 'wp_head', array( $this, 'post_header' ) );
		add_action( 'wp_print_scripts', array( $this, 'load_scripts' ) );
		add_action( 'wp_print_styles', array( $this, 'load_styles' ) );
		add_action( 'template_redirect', array( $this, 'mark_first_post_on_archive' ) );
		
		register_activation_hook(__FILE__, array($this, 'install' ) );
	}
	
	function post_header() {
			global $wp_query;
			$the_content = $wp_query->post->post_content;
			$char_codes = array( '&#215;', '&#8211;' );
			$replacements = array( "x", "--" );
			$the_content = str_replace( $char_codes, $replacements, $the_content );			
			
			preg_match_all( "/(http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $the_content, $matches, PREG_SET_ORDER );
			
            // if ( isset( $matches[0][5] ) )
            //  if ( $matches[0][5] != '' and is_single() )
            //      echo '<meta property="og:image" content="http://i.ytimg.com/vi/' . $matches[0][5] . '/default.jpg" />';
			
			if ( $this->options['colorbox'] == 'on' ) {
		?>
		<script>
			jQuery(document).ready(function($){
				$(".colorbox_video").colorbox({iframe:true, innerWidth:<?php echo $this->options['width']; ?>, innerHeight:<?php echo $this->options['height']; ?>});
			});
		</script>
		<?php
			}
	}
	
	function load_scripts() {
		if ( $this->options["colorbox"] == 'on' ) {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'colorbox' );
		}
	}
	
	function load_styles() {
		$style_path = $this->plugin_url . '/themes/theme' . $this->options['colorbox_theme'] . '/colorbox.css';
		wp_register_style( 'colorbox', $style_path );
		
		if ( $this->options["colorbox"] == 'on' ) {
			wp_enqueue_style( 'colorbox' );
		}
	}
	
	function plugin_header() {
		if ( ! empty( $_REQUEST['page'] ) )
			$page = $_REQUEST['page'];
		else
			$page = '';
		?>		
		<style>
		<?php if ( ( $page == 'syt_settings' ) || ( $page == 'syt_colorbox_options' ) || ( $page == 'syt_about' ) ) : ?>
		#icon-syt_settings { background:transparent url('<?php echo $this->plugin_url .'i/logo.png';?>') no-repeat; }		
		<?php endif; ?>		
		</style>
		<script>
		<?php if ( $page == 'syt_settings' ) : ?>
		jQuery(document).ready(function($){
			if (($)('#disp_excerpt').val() == 'not')
				($)('#disp_excerpt_align_div').hide();
			else
				($)('#disp_excerpt_align_div').show();
			($)('#disp_excerpt').change(function(){
				if (($)(this).val() == 'not') 
					($)('#disp_excerpt_align_div').hide();
				else
					($)('#disp_excerpt_align_div').show();
			});
		});
		<?php endif; ?>
		<?php if ( $page == 'syt_colorbox_options' ) : ?>
		jQuery(document).ready(function($){
			$("#colorbox_theme").change(function() {
				var src = $("option:selected", this).val();
				if ( src != "" ){
					var $imgTag = "<img src=\"" + "<?php echo $this->plugin_url; echo '/screenshots/screenshot-'; ?>" + src  + ".jpg\" />";
					$("#screenshot_image").empty().html($imgTag).fadeIn();
				}
			});
		});
		<?php endif; ?>
		</script>
		<?php
	}
	
	function add_menu_items() {
		$image = $this->plugin_url . '/i/icon.png';
		add_menu_page( __( 'Smart Youtube', 'smart-youtube' ), __( 'Smart Youtube', 'smart-youtube' ), 'manage_options', 'syt_settings', array(
			&$this,
			'options_page'
		), $image);
		$page_settings = add_submenu_page( 'syt_settings', __( 'Smart Youtube', 'smart-youtube' ) . __( ' Settings', 'smart-youtube' ), __( 'Settings', 'smart-youtube' ), 'manage_options', 'syt_settings', array(
			&$this,
			'options_page'
		) );
		$page_colorbox = add_submenu_page( 'syt_settings', __( 'Smart Youtube', 'smart-youtube' ) . __( ' Colorbox Options', 'smart-youtube' ), __( 'Colorbox Options', 'smart-youtube' ), 'manage_options', 'syt_colorbox_options', array(
			&$this,
			'handle_colorbox_options'
		) );
		$page_about = add_submenu_page( 'syt_settings', __( 'Smart Youtube', 'smart-youtube' ) . __( ' About', 'smart-youtube' ), __( 'About', 'smart-youtube' ), 'manage_options', 'syt_about', array(
			&$this,
			'handle_about'
		) );
	}
		
	function options_page() { 
		// If form was submitted
		if ( isset( $_POST['submitted'] ) ) {			
			check_admin_referer( 'smart-youtube' );
			
			$this->options['img'] = ! isset( $_POST['disp_img'] ) ? 'off' : 'on';
			$this->options['link'] = ! isset( $_POST['disp_link'] ) ? 'off' : 'on';
			$this->options['valid'] = ! isset( $_POST['valid'] ) ? 'off' : 'on';
			$this->options['search'] = ! isset( $_POST['disp_search'] ) ? 'off' : 'on';
			$this->options['ann'] = ! isset( $_POST['disp_ann'] ) ? 'off' : 'on';
			
			$this->options['info'] = ! isset( $_POST['disp_info'] ) ? 'off' : 'on';
			
			$this->options['width'] = ! isset( $_POST['disp_width'] ) ? 425 : intval( $_POST['disp_width'] );
			$this->options['height'] = ! isset( $_POST['disp_height'] ) ? 344 : intval( $_POST['disp_height'] );
			
			$this->options['widthhq'] = ! isset( $_POST['disp_widthhq'] ) ? 480 : intval( $_POST['disp_widthhq'] );
			$this->options['heighthq'] = ! isset( $_POST['disp_heighthq'] ) ? 295 : intval( $_POST['disp_heighthq'] );
			
			$this->options['widthside'] = ! isset( $_POST['disp_widthside'] ) ? 150 : intval( $_POST['disp_widthside'] );
			$this->options['heightside'] = ! isset( $_POST['disp_heightside'] ) ? 125 : intval( $_POST['disp_heightside'] );
			
			$this->options['rel'] = ! isset( $_POST['embedRel'] ) ? 1 : $_POST['embedRel'];
			$this->options['autoplay'] = ! isset( $_POST['autoplay'] ) ? 0 : 1;
			$this->options['autoplay_first'] = ! isset( $_POST['autoplay_first'] ) ? 0 : 1;
			$this->options['privacy'] = ! isset( $_POST['disp_privacy'] ) ? 0 : 1;
			
			$this->options['posts'] = ! isset( $_POST['disp_posts'] ) ? 'off' : 'on';
			$this->options['comments'] = ! isset( $_POST['disp_comments'] ) ? 'off' : 'on';
			$this->options['iframe'] = ! isset( $_POST['iframe'] ) ? 'off' : 'on';
			$this->options['www'] = ! isset( $_POST['www'] ) ? 'off' : 'on';
			$this->options['http'] = ! isset( $_POST['http'] ) ? 'off' : 'on';
			
			$this->options['template'] = ! isset( $_POST['disp_template'] ) ? '{video}' : stripslashes( htmlspecialchars( $_POST['disp_template'] ) );
			$this->options['tag'] = ! isset( $_POST['tag'] ) ? '' : $_POST['tag'];
			$this->options['wiziapp'] = ! isset( $_POST['wiziapp'] ) ? 'off' : 'on';
			$this->options['loop'] = ! isset( $_POST['loop'] ) ? 0 : 1;
			$this->options['thumb'] = ! isset( $_POST['thumb'] ) ? 'off' : 'on';
			$this->options['colorbox'] = ! isset( $_POST['colorbox'] ) ? 'off' : 'on';
			$this->options['excerpt'] = ! isset( $_POST['excerpt'] ) ? '' : $_POST['excerpt'];
			$this->options['excerpt_align'] = ! isset( $_POST['excerpt_align'] ) ? '' : $_POST['excerpt_align'];
			$this->options['logoless'] = ! isset( $_POST['logoless'] ) ? 'off' : 'on';
			$this->options['theme'] = ! isset( $_POST['theme'] ) ? '' : $_POST['theme'];
			
			update_option( $this->key, $this->options );
			
			// Show message
			echo '<div id="message" class="updated fade"><p>' . __( 'Smart Youtube options saved.', 'smart-youtube' ) . '</p></div>';
		} 
		
		$disp_img = $this->options['img'] == 'on' ? 'checked="checked"' : '';
		$disp_link = $this->options['link'] == 'on' ? 'checked="checked"' : '';
		$disp_search = $this->options['search'] == 'on' ? 'checked="checked"' : '';
		$disp_ann = $this->options['ann'] == 'on' ? 'checked="checked"' : '';
		$disp_info = $this->options['info'] == 'on' ? 'checked="checked"' : '';
		
		$valid = $this->options['valid'] == 'on' ? 'checked="checked"' : '';
		
		$disp_width = $this->options['width'];
		$disp_height = $this->options['height'];
		
		$disp_widthhq = $this->options['widthhq'];
		$disp_heighthq = $this->options['heighthq'];
		
		$disp_widthside = $this->options['widthside'];
		$disp_heightside = $this->options['heightside'];
		
		$disp_autoplay = $this->options['autoplay'] ? 'checked="checked"' : '';
		$disp_autoplay_first = $this->options['autoplay_first'] ? 'checked="checked"' : '';
		$disp_rel = $this->options['rel'] ? 'checked="checked"' : '';
		$disp_rel2 = $this->options['rel'] ? '' : 'checked="checked"';
		$disp_posts = $this->options['posts'] == 'on' ? 'checked="checked"' : '' ;
		$disp_comments = $this->options['comments'] == 'on' ? 'checked="checked"' : '';
		
		$disp_privacy = $this->options['privacy'] ? 'checked="checked"' : '';
		$iframe = $this->options['iframe'] =='on' ? 'checked="checked"' : '';
		$www = $this->options['www'] =='on' ? 'checked="checked"' : '';
		$http = $this->options['http'] =='on' ? 'checked="checked"' : '';
		$disp_loop = $this->options['loop'] ? 'checked="checked"' : '';
		$thumb = $this->options['thumb'] == 'on' ? 'checked="checked"' : '';
		$colorbox = $this->options['colorbox'] == 'on' ? 'checked="checked"' : '';
		$excerpt = isset( $this->options['excerpt'] ) ? $this->options['excerpt'] : 'not';
		$excerpt_align = isset( $this->options['excerpt_align'] ) ? $this->options['excerpt_align'] : 'left';
		
		$disp_template = esc_html( $this->options['template'] );
		$tag = $this->options['tag'];
		$wiziapp = $this->options['wiziapp'] == 'on' ? 'checked="checked"' : '';
		$logoless = $this->options['logoless'] == 'on' ? 'checked="checked"' : '';
		$theme = isset( $this->options['theme'] ) ? $this->options['theme'] : '';
		
		if ( ! $disp_width ) {
			$disp_width = 425;
		}
		
		if ( ! $disp_height ) {
			$disp_height = 344;
		}
		
		global $wp_version;
		
		$embed_img = $this->plugin_url . '/img/embed_selection-vfl29294.png';
			
		echo '<script src="' . $this->plugin_url . '/yt.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="' . $this->plugin_url . '/styleyt.css" />';
		
		$imgpath = $this->plugin_url.'/i';
		$actionurl = stripslashes(htmlentities(strip_tags($_SERVER['REQUEST_URI'])));
		$nonce = wp_create_nonce( 'smart-youtube' );
		$example = htmlentities( '<div style="float:left;margin-right: 10px;">{video}</div>' );
		
		// Configuration Page
		
?>
<div class="wrap smartyoutube" >
	<?php screen_icon(); ?>
	<h2><?php _e( 'Smart YouTube PRO', 'smart-youtube' );  ?></h2>
	<a href="admin.php?page=syt_settings"><?php _e( 'Settings', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_colorbox_options"><?php _e( 'Colorbox Options', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_about"><?php _e( 'About', 'smart-youtube' ); ?></a>
	<div id="poststuff" style="margin-top:10px;">
		<div id="sideblock" style="float:right;width:270px;margin-left:10px;">
			<iframe width=270 height=800 frameborder="0" src="http://www.prelovac.com/plugin/news.php?id=0&utm_source=plugin&utm_medium=plugin&utm_campaign=Smart%2BYoutube"></iframe>
		</div> 
		<div id="mainblock" style="width:710px">
			<div class="dbx-content">
				<h2 id="usageHeader"><?php _e( 'Usage <span style="font-size:small">[<a href="#">view instructions</a>]</span>', 'smart-youtube' ); ?></h2>
				<div id="usage" style="display:none">
					<p><?php _e( 'To use the video in your posts, paste YouTube video URL with <strong>httpv://</strong> (notice the \'v\').', 'smart-youtube' ); ?> </p>
					<p><?php _e( '<strong>Important:</strong> The URL should just be copied into your post normally and the letter \'v\' added, do not create a clickable link!', 'smart-youtube' ); ?></p>
					<p><?php _e( 'Example: httpv://www.youtube.com/watch?v=OWfksMD4PAg', 'smart-youtube' ); ?></p>
					<p><?php _e( 'If you want to embed High/HD Quality video use <strong>httpvh://</strong> instead (Video High Defintion).', 'smart-youtube' ); ?></p>
					<p><?php _e( 'Vimeo Example: httpv://vimeo.com/27287078', 'smart-youtube' ); ?></p>
					<p><?php _e( 'Metacafe Example: httpvh://vww.metacafe.com/watch/7815470/harry_potter_and_the_deathly_hallows_dvd_interview/', 'smart-youtube' ); ?></p>
					<p><?php _e( 'Live Leak Example: httpv://www.liveleak.com/view?i=cad_1322822486', 'smart-youtube' ); ?></p>
					<p><?php _e( 'To embed playlists use httpvp:// (eg. httpvp://www.youtube.com/playlist?list=PL050E43A49BC5E5E5)', 'smart-youtube' ); ?></p>
					<p><?php _e( 'Smart Youtube also supports migrated blogs from Wordpress.com using [youtube=youtubeadresss]', 'smart-youtube' ); ?></p>
					<ul>
						<li><?php _e( 'httpv:// - regular video', 'smart-youtube' ); ?></li>
						<li><?php _e( 'httpvh:// - high/HD quality', 'smart-youtube' ); ?></li>
						<li><?php _e( 'httpvp:// - playlist', 'smart-youtube' ); ?></li>
						<li><?php _e( 'httpvhp:// - HD playlist', 'smart-youtube' ); ?></li>
						<li><?php _e( '[youtube=youtubeadresss] - supported for blogs migrated from wordpress.com', 'smart-youtube' ); ?></li>
					</ul>
				</div>
				<form name="yteform" action="<?php echo $actionurl; ?>" method="post">
					<input type="hidden" name="submitted" value="1" /> 
					<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo $nonce; ?>" />
					<h2><?php _e( 'Options', 'smart-youtube' ); ?></h2>
					<p><?php _e( 'Smart Youtube is powerful and free WordPress plugin for embeding videos into your blog. ', 'smart-youtube' ); ?></p>
					
					<p><?php _e( 'From the same author: <a href="http://managewp.com" target="_blank">ManageWP.com</a> - Wordpress service that helps you manage all your WordPress sites from one location.', 'smart-youtube' ); ?></p>
					<p><?php _e( 'You can adjust the way your embeded youtube videos behave in the options below.', 'smart-youtube' ); ?></p>
					<h3><?php _e( 'Video settings', 'smart-youtube' ); ?></h3>
					<div>
						<input id="check3" type="checkbox" name="disp_posts" <?php echo $disp_posts; ?> />
						<label for="check3"><?php _e( 'Display videos in posts', 'smart-youtube' ); ?></label>
					</div>
					<div>
						<input id="check4" type="checkbox" name="disp_comments" <?php echo $disp_comments; ?> />
						<label for="check4"><?php _e( 'Display videos in comments', 'smart-youtube' ); ?></label>
					</div>
					<br />
					<div>
						<input id="iframe" type="checkbox" name="iframe" <?php echo $iframe; ?> />
						<label for="iframe"><?php _e( 'Use IFRAME embed code', 'smart-youtube' ); ?></label> [<a target="_blank" href="http://apiblog.youtube.com/2010/07/new-way-to-embed-youtube-videos.html">?</a>]
					</div>
					<h3><?php _e( 'Video Appearence', 'smart-youtube' ); ?></h3>
					<p class="instruct">
						<?php _e( 'Video template. Default is just {video}.', 'smart-youtube' ); ?><br />
						<?php echo __( 'You can try <code>', 'smart-youtube' ) . $example . __( '</code> if you want the text to wrap around video.', 'smart-youtube' ); ?>
					</p>
					<textarea cols="50" id="disp_template" name="disp_template"><?php echo $disp_template; ?></textarea>
					<br />
					<input id="http" type="checkbox" name="http" <?php echo $http; ?> />
					<label for="http"><?php _e( 'Parse links with http:// prefix same as httpv://', 'smart-youtube' ); ?></label>
					<br />
					<input id="www" type="checkbox" name="www" <?php echo $www; ?> />
					<label for="www"><?php _e( 'Parse links without http:// prefix', 'smart-youtube' ); ?></label>
					<p class="instruct"><?php _e( 'Video width and height in normal mode (httpv://). Default is 425x344.', 'smart-youtube' ); ?></p>
					<div id="inputSizeNormal">
						<input class="width" name="disp_width" value="<?php echo $disp_width; ?>" size="7"/>x<input class="height" name="disp_height" value="<?php echo $disp_height; ?>" size="7" />
					</div>
					<div class="size-chooser" forDiv="inputSizeNormal">
						 <a v-width="320" v-height="265" href="#">
							<span></span>
								<div class="outer">
									<div></div>
								</div>
							</a>
						<a v-width="425" v-height="344" href="#">
							<span></span>
							 <div class="outer">
								<div></div>
							 </div>
						</a>
						<a v-width="480" v-height="385" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="640" v-height="505" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="960" v-height="745" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<br clear="both" />
					</div>
					   <p class="instruct"><?php _e( 'Video width and height in <strong>high quality</strong> mode (httpvh://). Default is 480x295.', 'smart-youtube' ); ?></p>
					<div id="inputSizeHQ">
						<input class="width" name="disp_widthhq" value="<?php echo $disp_widthhq; ?>" size="7" />x<input class="height" name="disp_heighthq" value="<?php echo $disp_heighthq; ?>" size="7" />
					</div>
					<div class="size-chooser" forDiv="inputSizeHQ">
						<a v-width="480" v-height="295" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="560" v-height="340" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="640" v-height="385" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="853" v-height="505" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<a v-width="1280" v-height="745" href="#">
							<span></span>
							<div class="outer">
								<div></div>
							</div>
						</a>
						<br clear="both" />
					</div>
					<p class="instruct"><?php _e( 'Video width and height in <strong>sidebar</strong> mode (regardless of quality). Default is 150x125.', 'smart-youtube' ); ?></p>
					<input id="disp_widthside" name="disp_widthside" value="<?php echo $disp_widthside; ?>" size="7" />x<input id="disp_heightside" name="disp_heightside" value="<?php echo $disp_heightside; ?>" size="7" /><br /><br />
					<div id="watch-customize-embed-form">
						  <input type="radio" <?php echo $disp_rel; ?> id="embedCustomization1" name="embedRel" value="1"/>
						  <label for="embedCustomization1"><?php _e( 'Include related videos', 'smart-youtube' ); ?></label>
						  <br/>
						  <input type="radio" <?php echo $disp_rel2; ?> id="embedCustomization0" name="embedRel" value="0"/>
						  <label for="embedCustomization0"><?php _e( 'Do not include related videos', 'smart-youtube' ); ?></label>
						  <br/>
					</div>
					<br/>
					<div style="margin: 0 0 0 4px; clear: both;">
						<input type="checkbox" id="autoplay_checkbox" name="autoplay" <?php echo $disp_autoplay; ?> /><label for="autoplay_checkbox"><?php _e( 'Autoplay videos', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="autoplay_first_checkbox" name="autoplay_first" <?php echo $disp_autoplay_first; ?> /><label for="autoplay_first_checkbox"><?php _e( 'Autoplay only first video on page', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="loop_checkbox" name="loop" <?php echo $disp_loop; ?> /><label for="loop_checkbox"><?php _e( 'Loop videos', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="disp_search" name="disp_search" <?php echo $disp_search; ?> /><label for="disp_search"><?php _e( 'Display search box', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="thumb_checkbox" name="thumb" <?php echo $thumb; ?> /><label for="thumb_checkbox"><?php _e( 'Display thumbnails on home/archive pages', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="cbox_checkbox" name="colorbox" <?php echo $colorbox; ?> /><label for="cbox_checkbox"><?php _e( 'Show video in colorbox', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="disp_info" name="disp_info" <?php echo $disp_info; ?> /><label for="disp_info"><?php _e( 'Remove Titles & Ratings', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="disp_ann" name="disp_ann" <?php echo $disp_ann; ?> /><label for="disp_ann"><?php _e( 'Remove Annotations', 'smart-youtube' ); ?></label><br />
						<input type="checkbox" id="logoless" name="logoless" <?php echo $logoless; ?> /><label for="logoless"><?php _e( 'Hide YouTube Logo', 'smart-youtube' ); ?></label><br />
						<label for="theme"><?php _e( 'Theme (YouTube only):', 'smart-youtube' ); ?></label>
						<select id="theme" name="theme" />
							<option value="dark" <?php echo ( ( $theme == 'dark' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Dark', 'smart-youtube' ); ?></option>
							<option value="light" <?php echo ( ( $theme == 'light' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Light', 'smart-youtube' ); ?></option>
						</select><br />
						<input type="checkbox" id="privacy" name="disp_privacy" <?php echo $disp_privacy; ?> /><label for="privacy"><?php _e( 'Enable privacy-enhanced mode', 'smart-youtube' ); ?> [<a target="_blank" href="http://www.google.com/support/youtube/bin/answer.py?answer=141046">?</a>] <?php _e( 'videos may not work for Iphone users)', 'smart-youtube' ); ?></label><br />
						<div id="disp_excerpt_div">
							<label for="disp_excerpt"><?php _e( 'Show embeds in post excerpts as', 'smart-youtube' ); ?></label>
							<select id="disp_excerpt" name="excerpt">
								<option value="vid" <?php echo ( ( $excerpt == 'vid' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Video', 'smart-youtube' ); ?></option>
								<option value="thm" <?php echo ( ( $excerpt == 'thm' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Thumbnail', 'smart-youtube' ); ?></option>
								<option value="not" <?php echo ( ( $excerpt == 'not' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Nothing', 'smart-youtube' ); ?></option>
							</select>
						</div>
						<div id="disp_excerpt_align_div">
							<label for="disp_excerpt_align"><?php _e( 'Align embeds in post excerpts to', 'smart-youtube' ); ?></label>						
							<select id="disp_excerpt_align" name="excerpt_align">
								<option value="left" <?php echo ( ( $excerpt_align == 'left' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Left', 'smart-youtube' ); ?></option>
								<option value="right" <?php echo ( ( $excerpt_align == 'right' ) ? 'selected="yes"' : '' ); ?>><?php _e( 'Right', 'smart-youtube' ); ?></option>
							</select>
						</div>
					</div>
					<h3><?php _e( 'Custom code compatibility', 'smart-youtube' ); ?></h3>
					<p><?php _e( 'Use this option if you have used another youtube plugin and switched over to Smart Youtube.', 'smart-youtube' ); ?><p>
					<p><?php _e( 'For example if you used [yt]qYWWBwf2wHE[/yt] type of code, you would type yt in the box below.', 'smart-youtube' ); ?></p>
					<input id="tag" type="text" name="tag" value="<?php echo $tag; ?>" />
					<label for="tag"><?php _e( 'Custom code', 'smart-youtube' ); ?></label>
					 
					<h3><?php _e( 'WiziApp support', 'smart-youtube' ); ?></h3>
					<p><?php _e( 'This will integrate your video seamlessly with WiziApp', 'smart-youtube' ); ?></p>
					<input id="wiziapp" type="checkbox" name="wiziapp" <?php echo $wiziapp; ?> />
					<label for="wiziapp"><?php _e( 'Enable WiziApp support', 'smart-youtube' ); ?></label>
					<h3><?php _e( 'xHTML validation', 'smart-youtube' ); ?></h3>
					<p class="instruct"><?php _e( 'Enabling the option below will change default YouTube code to be xHTML valid. (videos may not work for Iphone users)', 'smart-youtube' ); ?></p>
					<input id="valid" type="checkbox" name="valid" <?php echo $valid; ?> />
					<label for="valid"><?php _e( 'Enable xHTML Validation', 'smart-youtube' ); ?></label>
					<h3><?php _e( 'RSS feed options', 'smart-youtube' ); ?></h3>
					<p class="instruct"><?php _e( 'Some RSS feed readers like Bloglines will show embeded YouTube videos. Some will not and Smart YouTube allows you to display a video link and a video screenshot instead.', 'smart-youtube' ); ?></p>
					<p class="instruct"><?php _e( 'Smart YouTube will always embed the video but it can not know if the reader supports embeded video or not. So use these additional options at your own likening.', 'smart-youtube' ); ?></p>
					<input id="check2" type="checkbox" name="disp_link" <?php echo $disp_link; ?> />
					<label for="check2"><?php _e( 'Display video link in RSS feed', 'smart-youtube' ); ?></label><br />
					<input id="check1" type="checkbox" name="disp_img" <?php echo $disp_img; ?> />
					<label for="check1"><?php _e( 'Display video preview image in RSS feed', 'smart-youtube' ); ?></label>
					<div class="submit"><input type="submit" name="Submit" value="<?php _e( 'Update options', 'smart-youtube' ); ?>" /></div>
				</form>
			</div>
		 </div>
	</div>
</div>
<h5 class="author"><?php _e( 'Another fine WordPress plugin by <a href="http://www.prelovac.com/vladimir/">Vladimir Prelovac', 'smart-youtube' ); ?></a></h5>
<?php
	}
	
	function handle_colorbox_options() {
		if ( isset( $_POST['submitted'] ) ) {
			$this->options['colorbox_theme'] = ( ! isset( $_POST['colorbox_theme'] ) ? '1' : $_POST['colorbox_theme'] );
			
			update_option( $this->key, $this->options );
			
			$msg_status = __( 'SEO Friendly Images PRO colorbox options saved.', 'smart-youtube' );
			
			// Show message
			echo '<div id="message" class="updated fade"><p>' . $msg_status . '</p></div>';
		}
		
		$imgpath = $this->plugin_url . '/i';
		$actionurl = stripslashes(htmlentities(strip_tags($_SERVER['REQUEST_URI'])));
		
		$this->options = $this->get_options();
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Smart YouTube PRO', 'smart-youtube' ); echo '&nbsp;' . $this->local_version; ?></h2>
		<a href="admin.php?page=syt_settings"><?php _e( 'Settings', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_colorbox_options"><?php _e( 'Colorbox Options', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_about"><?php _e( 'About', 'smart-youtube' ); ?></a>
		<div id="poststuff" style="margin-top:10px;">
			<div id="sideblock" style="float:right;width:270px;margin-left:10px;">		  
				<iframe width=270 height=800 frameborder="0" src="http://www.prelovac.com/plugin/news.php?id=2&utm_source=plugin&utm_medium=plugin&utm_campaign=SEO%2BFriendly%2BImages%2BPRO"></iframe>
			</div>
		</div>
		<div id="mainblock" class="submit">
			<div class="dbx-content">
				<h2><?php _e( 'Colorbox Options', 'smart-youtube' ); ?></h2>
				<br />
				<form name="sytform" action="<?php echo $actionurl; ?>" method="post">
					<input type="hidden" name="submitted" value="1" />
					<div>
						<label for="colorbox_theme"><?php _e( 'Choose ColorBox theme:', 'smart-youtube' ); ?></label>
						<select id="colorbox_theme" name="colorbox_theme">
							<?php for($i = 1; $i <= 11; $i++): ?>
								<option value="<?php echo $i; ?>" <?php echo ( $this->options['colorbox_theme'] == $i ) ? 'selected="yes"' : ''; ?>><?php echo __( 'Theme ', 'smart-youtube' ) . $i; ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div>
						<label for="screenshot_image"><?php _e( 'Theme screenshot:', 'smart-youtube' ); ?></label>
						<div id="screenshot_image">
							<img src="<?php echo $this->plugin_url . '/screenshots/screenshot-' . $this->options['colorbox_theme'] . '.jpg'; ?>" />
						</div>
					</div>
					<div style="padding: 1.5em 0;margin: 5px 0;">
						<input type="submit" name="Submit" value="<?php _e( 'Update options', 'smart-youtube' ); ?>" />
					</div>
				</form>
			</div>   
		</div>
		<h5><?php _e( 'Another fine WordPress plugin by', 'smart-youtube' ); ?> <a href="http://www.prelovac.com/vladimir/">Vladimir Prelovac</a></h5>
	</div>
	<?php		
	}
	
	function handle_about() {
		global $wp_version;
		
		$upd_msg = "";
		
		$actionurl = stripslashes(htmlentities(strip_tags($_SERVER['REQUEST_URI'])));
		$nonce = wp_create_nonce( 'smart-youtube' );
		
		$lic_msg = '<p>Welcome to ' . __( 'Smart YouTube PRO', 'smart-youtube' ) . '.</p>';
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Smart YouTube PRO', 'smart-youtube' ); echo '&nbsp;' . $this->local_version; ?></h2>
		<a href="admin.php?page=syt_settings"><?php _e( 'Settings', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_colorbox_options"><?php _e( 'Colorbox Options', 'smart-youtube' ); ?></a> &nbsp;|&nbsp; <a href="admin.php?page=syt_about"><?php _e( 'About', 'smart-youtube' ); ?></a>
		<div id="poststuff" style="margin-top:10px;">
		
			<div id="sideblock" style="float:right;width:270px;margin-left:10px;">		  
				<iframe width=270 height=800 frameborder="0" src="http://www.prelovac.com/plugin/news.php?id=2&utm_source=plugin&utm_medium=plugin&utm_campaign=SEO%2BFriendly%2BImages%2BPRO"></iframe>
			</div>
		</div>
		<div id="mainblock" class="submit">
			<div class="dbx-content">				
				<h2><?php _e( 'About', 'smart-youtube' ); ?></h2>
				<br />
				<form name="STY_about" action="$actionurl" method="post">
					<input type="hidden" id="_wpnonce" name="_wpnonce" value="$nonce" />
					<input type="hidden" name="submitted" value="1" /> 			
					<?php echo $lic_msg; ?>
					<?php echo __( 'Version:', 'smart-youtube' ) . $this->local_version; ?> <?php echo $upd_msg; ?>
				</form>
			</div>   
		</div>
		<h5><?php _e( 'Another fine WordPress plugin by', 'smart-youtube' ); ?> <a href="http://www.prelovac.com/vladimir/">Vladimir Prelovac</a></h5>
	</div>
	<?php
	}
	
	function mark_first_post_on_archive() {
		if ( is_archive() || is_home() || is_front_page() ) {
			$this->first_post_on_archive = true;
		}
	}
	
	/**
	* Looks for Smart Youtube URL(s) in the post content
	* and replace them with proper HTML tags
	* 
	* @param mixed $the_content
	* @param mixed $side
	* @return mixed
	*/
	function check( $the_content, $side = 0 ) {
		$char_codes = array( '&#215;', '&#8211;' );
		$replacements = array( "x", "--" );
		$the_content = str_replace( $char_codes, $replacements, $the_content );
		$this->first = false;
		
		$context = $side ? 'side' : 'post';
		
		preg_match_all( "/((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*))|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtu\.be\/([a-zA-Z0-9\-\_]{11}))|((http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?metacafe\.com\/watch\/([a-zA-Z0-9\-\_]{7})\/([^<^\/\s]*)([\/])?)|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?vimeo\.com\/([a-zA-Z0-9\-\_]{8})([\/])?)|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?liveleak\.com\/view(\?i\=)([a-zA-Z0-9\-\_]*))|((http(s|v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?facebook\.com\/video\/video.php\?v\=([a-zA-Z0-9\-\_]*))|((http(vp|vhp)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/(view_play_list\?p\=|playlist\?list\=)([a-zA-Z0-9\-\_]{18,34})([^<\s]*))/", $the_content, $matches, PREG_SET_ORDER );
		
		foreach ( $matches as $match ) {
			if ( $match[1] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.youtube.com/watch?v={$match[6]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( ($match[2] == 'http://' || $match[2] == 'https://') && $this->options['http'] == 'on' ) || ( $match[2] == '' && $this->options['www'] == 'on' ) || ( $match[3] == 'v' || $match[3] == 'vh' || $match[3] == 'vhd' )) {
				    
				// $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'myndin' );
				
				// http://img.youtube.com/vi/$match[6]/hqdefault.jpg
                 $repl = <<<EOF
 <p class="youtube-placeholder"><img src="http://img.youtube.com/vi/$match[6]/hqdefault.jpg" alt="Vídjó"><a class="clickable" onClick="jQuery(this).parent().html(yt_link('$match[6]', '$match[7]'));"></a></p>
EOF;
                 $the_content = str_replace( $match[1], $repl, $the_content);
                    // $the_content = str_replace( $match[1], $this->tag_youtube( $context, $match[6], 'v', $match[7] ), $the_content );
				}
				
				 // else if ( $match[3] == 'v' || $match[3] == 'vh' || $match[3] == 'vhd' ) {
				 //                                                  $the_content = str_replace( $match[1], $this->tag_youtube( $context, $match[6], $match[3], $match[7] ), $the_content );
				 //                                              }
			} elseif ( $match[8] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.youtube.com/watch?v={$match[12]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[9] == 'http://' && $this->options['http'] == 'on' ) || ( $match[9] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[8], $this->tag_youtube( $context, $match[12], 'v' ), $the_content );
				} else if ( $match[10] == 'v' || $match[10] == 'vh' || $match[10] == 'vhd' ) {
					$the_content = str_replace( $match[8], $this->tag_youtube( $context, $match[12], $match[10] ), $the_content );
				}
			} elseif ( $match[13] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.metacafe.com/watch/{$match[17]}/{$match[18]}/";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[14] == 'http://' && $this->options['http'] == 'on' ) || ( $match[14] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[13], $this->tag_metacafe( $context, $match[17], 'v', $match[18] ), $the_content );
				} else if ( $match[15] == 'v' || $match[15] == 'vh' || $match[15] == 'vhd' ) {
					$the_content = str_replace( $match[13], $this->tag_metacafe( $context, $match[17], $match[15], $match[18] ), $the_content );
				}
			} elseif ( $match[20] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.vimeo.com/{$match[24]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[21] == 'http://' && $this->options['http'] == 'on' ) || ( $match[21] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[20], $this->tag_vimeo( $context, $match[24], 'v' ), $the_content );
				} else if ( $match[22] == 'v' || $match[22] == 'vh' || $match[22] == 'vhd' ) {
					$the_content = str_replace( $match[20], $this->tag_vimeo( $context, $match[24], $match[22] ), $the_content );
				}
			} elseif ( $match[26] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.liveleak.com/view?i={$match[31]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[27] == 'http://' && $this->options['http'] == 'on' ) || ( $match[27] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[26], $this->tag_liveleak( $context, $match[31], 'v' ), $the_content );
				} else if ( $match[28] == 'v' || $match[28] == 'vh' || $match[28] == 'vhd' ) {
					$the_content = str_replace( $match[26], $this->tag_liveleak( $context, $match[31], $match[28] ), $the_content );
				}
			} elseif ( $match[32] != '' ) {
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.facebook.com/video/video.php?v={$match[36]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[33] == 'http://' && $this->options['http'] == 'on' ) || ( $match[33] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[32], $this->tag_facebook( $context, $match[36], 'v' ), $the_content );
				} else if ( $match[34] == 'v' || $match[34] == 'vh' || $match[34] == 'vhd' ) {
					$the_content = str_replace( $match[32], $this->tag_facebook( $context, $match[36], $match[34] ), $the_content );
				}
			} elseif ( $match[37] != '' ) {
				
				if ( 'on' == $this->options['wiziapp'] ) {
					$videos = array();
					$video_info['src'] = "http://www.youtube.com/playlist?list={$match[42]}";
					array_push( $videos, $video_info );
					$replace_text = '';
					$replace_text = apply_filters( 'wiziapp_3rd_party_plugin', $replace_text, 'video', $videos );
					$the_content = str_replace( $match[1], $replace_text, $the_content );
				} else if ( ( $match[38] == 'http://' && $this->options['http'] == 'on' ) || ( $match[38] == '' && $this->options['www'] == 'on' ) ) {
					$the_content = str_replace( $match[37], $this->tag_youtube( $context, $match[42], 'vp', $match[43] ), $the_content );
				} else if ( $match[39] == 'vp' || $match[39] == 'vhp' ) {
					$the_content = str_replace( $match[37], $this->tag_youtube( $context, $match[42], $match[39], $match[43] ), $the_content );
				}
			}
		}
		
		/*preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtu\.be\/([a-zA-Z0-9\-\_]{11})/", $the_content, $matches, PREG_SET_ORDER );
		foreach ( $matches as $match ) {
			if (( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_youtube( $context, $match[4], 'v' ), $the_content );
			} else if ( $match[2] == 'v' || $match[2] == 'vh' || $match[2] == 'vhd' ) {
				$the_content = str_replace( $match[0], $this->tag_youtube( $context, $match[4], $match[2] ), $the_content );
			}
		}
		
		preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?metacafe\.com\/watch\/([a-zA-Z0-9\-\_]{7})\/([^<^\/\s]*)([\/])?/", $the_content, $matches, PREG_SET_ORDER ); 
		foreach ( $matches as $match ) {	 
			if ( ( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_metacafe( $context, $match[4], 'v', $match[5] ), $the_content );
			} else if ( $match[2] == 'v' || $match[2] == 'vh' || $match[2] == 'vhd' ) {
				$the_content = str_replace( $match[0], $this->tag_metacafe( $context, $match[4], $match[2], $match[5] ), $the_content );
			}
		}
		
		preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?vimeo\.com\/([a-zA-Z0-9\-\_]{8})([\/])?/", $the_content, $matches, PREG_SET_ORDER ); 
		foreach ( $matches as $match ) {	 
			if ( ( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_vimeo( $context, $match[4], 'v' ), $the_content );
			} else if ( $match[2] == 'v' || $match[2] == 'vh' || $match[2] == 'vhd' ) {
				$the_content = str_replace( $match[0], $this->tag_vimeo( $context, $match[4], $match[2] ), $the_content );
			}
		}
		
		preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?liveleak\.com\/view(\?i\=)([a-zA-Z0-9\-\_]*)/", $the_content, $matches, PREG_SET_ORDER ); 
		foreach ( $matches as $match ) {	 
			if ( ( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_liveleak( $context, $match[5], 'v' ), $the_content );
			} else if ( $match[2] == 'v' || $match[2] == 'vh' || $match[2] == 'vhd' ) {
				$the_content = str_replace( $match[0], $this->tag_liveleak( $context, $match[5], $match[2] ), $the_content );
			}
		}
		
		preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?facebook\.com\/video\/video.php\?v\=([a-zA-Z0-9\-\_]*)/", $the_content, $matches, PREG_SET_ORDER );
		foreach ( $matches as $match ) {
			if ( ( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_facebook( $context, $match[4], 'v' ), $the_content );
			} else if ( $match[2] == 'v' || $match[2] == 'vh' || $match[2] == 'vhd' ) {
				$the_content = str_replace( $match[0], $this->tag_facebook( $context, $match[4], $match[2] ), $the_content );
			}
		}
		
		preg_match_all( "/(http(vp|vhp)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/view_play_list(\?p\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{16})([^<\s]*)/", $the_content, $matches, PREG_SET_ORDER );
		foreach ( $matches as $match ) {
			if ( ( $match[1] == 'http://' && $this->options['http'] == 'on' ) || ( $match[1] == '' && $this->options['www'] == 'on' ) ) {
				$the_content = str_replace( $match[0], $this->tag_youtube( $context, $match[5], 'vp', $match[6] ), $the_content );
			} else if ( $match[2] == 'vp' || $match[2] == 'vhp' ) {
				$the_content = str_replace( $match[0], $this->tag_youtube( $context, $match[5], $match[2], $match[6] ), $the_content );
			}
		}*/
	
		// to work with migrated blogs from Wordpress.com replacing [youtube=youtubeadresss]
		if ( strpos($the_content, "[youtube") !== false ) {
			preg_match_all( "/\[youtube\=http:\/\/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*)\]/", $the_content, $matches, PREG_SET_ORDER );
			foreach ( $matches as $match ) {
				$the_content = preg_replace( "/\[youtube\=http:\/\/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^\s<]*)\]/", $this->tag_youtube( $context, $match[3], '', $match[4] ), $the_content, 1 );
			}
		}
		$tag = $this->options['tag'];

		if ( $tag != '' && strpos( $the_content, "[".$tag."]" ) !== false ) {
			preg_match_all( "/\[$tag\]([a-zA-Z0-9\-\_]{11})([^<\s]*)\[\/$tag\]/", $the_content, $matches, PREG_SET_ORDER );
			foreach ( $matches as $match ) {
				$the_content = preg_replace( "/\[$tag\]([a-zA-Z0-9\-\_]{11})([^<\s]*)\[\/$tag\]/", $this->tag_youtube( $context, $match[1], '', '' ), $the_content, 1 );
			}
		}
		
		if ( $this->first_post_on_archive ) {
			$this->first_post_on_archive = false;
		}
		
		return $the_content;
	}
	
	function check_excerpt( $the_content ) {
		$excerpt = $this->options['excerpt'];
		$template = trim($this->options['template']) == '' ? '{video}' : $this->options['template'];
		
		if ( $excerpt != 'not' ) {
			global $post;
			$content = $post->post_content;
			
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $content, $matches['youtube.com'], PREG_SET_ORDER );
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtu\.be\/([a-zA-Z0-9\-\_]{11})/", $content, $matches['youtu.be'], PREG_SET_ORDER );
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?metacafe\.com\/watch\/([a-zA-Z0-9\-\_]{7})\/([^<^\/\s]*)([\/])?/", $content, $matches['metacafe.com'], PREG_SET_ORDER );
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?vimeo\.com\/([a-zA-Z0-9\-\_]{8})([\/])?/", $content, $matches['vimeo.com'], PREG_SET_ORDER );
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?liveleak\.com\/view(\?i\=)([a-zA-Z0-9\-\_]*)/", $content, $matches['liveleak.com'], PREG_SET_ORDER );
			preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?facebook\.com\/video\/video.php\?v\=([a-zA-Z0-9\-\_]*)/", $content, $matches['facebook.com'], PREG_SET_ORDER );
			
			if ( isset( $matches['youtube.com'][0] ) ) {
				if ( ( $matches['youtube.com'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['youtube.com'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['youtube.com'][0][0] = str_replace( $matches['youtube.com'][0][0], $this->tag_youtube( 'excerpt', $matches['youtube.com'][0][5], 'v', $matches['youtube.com'][0][6] ), $matches['youtube.com'][0][0] );
				} else if ( $matches['youtube.com'][0][2] == 'v' || $matches['youtube.com'][0][2] == 'vh' || $matches['youtube.com'][0][2] == 'vhd' ) {
					$matches['youtube.com'][0][0] = str_replace( $matches['youtube.com'][0][0], $this->tag_youtube( 'excerpt', $matches['youtube.com'][0][5], $matches['youtube.com'][0][2], $matches['youtube.com'][0][6] ), $matches['youtube.com'][0][0] );
				}
				$result = $matches['youtube.com'][0][0];
			} else if ( isset( $matches['youtu.be'][0] ) ) {
				if ( ( $matches['youtu.be'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['youtu.be'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['youtu.be'][0][0] = str_replace( $matches['youtu.be'][0][0], $this->tag_youtube( 'excerpt', $matches['youtu.be'][0][4], 'v' ), $matches['youtu.be'][0][0] );
				} else if ( $matches['youtu.be'][0][2] == 'v' || $matches['youtu.be'][0][2] == 'vh' || $matches['youtu.be'][0][2] == 'vhd' ) {
					$matches['youtu.be'][0][0] = str_replace( $matches['youtu.be'][0][0], $this->tag_youtube( 'excerpt', $matches['youtu.be'][0][4], $matches['youtu.be'][0][2]), $matches['youtu.be'][0][0] );
				}
				$result = $matches['youtu.be'][0][0];
			} else if ( isset( $matches['metacafe.com'][0] ) ) {
				if ( ( $matches['metacafe.com'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['metacafe.com'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['metacafe.com'][0][0] = str_replace( $matches['metacafe.com'][0][0], $this->tag_metacafe( 'excerpt', $matches['metacafe.com'][0][4], 'v', $matches['metacafe.com'][0][5] ), $matches['metacafe.com'][0][0] );
				} else if ( $matches['metacafe.com'][0][2] == 'v' || $matches['metacafe.com'][0][2] == 'vh' || $matches['metacafe.com'][0][2] == 'vhd' ) {
					$matches['metacafe.com'][0][0] = str_replace( $matches['metacafe.com'][0][0], $this->tag_metacafe( 'excerpt', $matches['metacafe.com'][0][4], $matches['metacafe.com'][0][2], $matches['metacafe.com'][0][5] ), $matches['metacafe.com'][0][0] );
				}
				$result = $matches['metacafe.com'][0][0];
			} else if ( isset($matches['vimeo.com'][0] ) ) {
				if ( ( $matches['vimeo.com'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['vimeo.com'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['vimeo.com'][0][0] = str_replace( $matches['vimeo.com'][0][0], $this->tag_vimeo( 'excerpt', $matches['vimeo.com'][0][4], 'v' ), $matches['vimeo.com'][0][0] );
				}
				else if ( $matches['vimeo.com'][0][2] == 'v' || $matches['vimeo.com'][0][2] == 'vh' || $matches['vimeo.com'][0][2] == 'vhd' ) {
					$matches['vimeo.com'][0][0] = str_replace( $matches['vimeo.com'][0][0], $this->tag_vimeo( 'excerpt', $matches['vimeo.com'][0][4], $matches['vimeo.com'][0][2] ), $matches['vimeo.com'][0][0] );
				}
				$result = $matches['vimeo.com'][0][0];
			} else if ( isset( $matches['liveleak.com'][0] ) ) {
				if ( ( $matches['liveleak.com'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['liveleak.com'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['liveleak.com'][0][0] = str_replace( $matches['liveleak.com'][0][0], $this->tag_liveleak( 'excerpt', $matches['liveleak.com'][0][4], 'v' ), $matches['liveleak.com'][0][0] );
				} else if ( $matches['liveleak.com'][0][2] == 'v' || $matches['liveleak.com'][0][2] == 'vh' || $matches['liveleak.com'][0][2] == 'vhd' ) {
					$matches['liveleak.com'][0][0] = str_replace( $matches['liveleak.com'][0][0], $this->tag__liveleak( 'excerpt', $matches['liveleak.com'][0][4], $matches['liveleak.com'][0][2] ), $matches['liveleak.com'][0][0] );
				}
				$result = $matches['liveleak.com'][0][0];
			} else if ( isset( $matches['facebook.com'][0] ) ) {
				if ( ( $matches['facebook.com'][0][1] == 'http://' && $this->options['http'] == 'on' ) || ( $matches['facebook.com'][0][1] == '' && $this->options['www'] == 'on' ) ) {
					$matches['facebook.com'][0][0] = str_replace( $matches['facebook.com'][0][0], $this->tag_facebook( 'excerpt', $matches['facebook.com'][0][4], 'v' ), $matches['facebook.com'][0][0] );
				} else if ( $matches['facebook.com'][0][2] == 'v' || $matches['facebook.com'][0][2] == 'vh' || $matches['facebook.com'][0][2] == 'vhd' ) {
					$matches['facebook.com'][0][0] = str_replace( $matches['facebook.com'][0][0], $this->tag_facebook( 'excerpt', $matches['facebook.com'][0][4], $matches['facebook.com'][0][2] ), $matches['facebook.com'][0][0] );
				}
				$result = $matches['facebook.com'][0][0];
			} else {
				/*$width = $this->options['widthside'];
				$height = $this->options['heightside'];  
				
				$img_url = htmlspecialchars( $this->plugin_url . '/img/default.jpg' );
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url">
<img src="$img_url" height="$height" width="$width" />
</a>
EOT;
				$result = str_replace( '{video}', $yte_tag, html_entity_decode( $template ) );*/
				
				return $the_content;
			}
			if ( isset( $result ) ) {
				$the_content = '<div style="float:' . $this->options["excerpt_align"] . ';padding-' . ( $this->options["excerpt_aign"] == 'left' ? 'right' : 'left' ) . ':10px;">' . $result . '</div>' . $the_content . '<div style="clear:both"></div>';
			}
		}
		
		if ( $this->first_post_on_archive ) {
			$this->first_post_on_archive = false;
		}
		
		return $the_content;
	}
	
	function tag_youtube( $context, $file, $high = 'v', $time = '' ) {
		$playlist = 0;
		$disp_rel = $this->options['rel'];
		$autoplay = $this->options['autoplay'];
		$autoplay_first = $this->options['autoplay_first'];
		$disp_search = $this->options['search'] == 'on' ? 1 : 0;
		$disp_info = $this->options['info'] == 'on' ? '&showinfo=0' : '';
		$disp_ann = $this->options['ann'] == 'on' ? '&iv_load_policy=3' : '';
		$template = trim( $this->options['template'] ) == '' ? '{video}' : $this->options['template']; 
		$valid = $this->options['valid'];
		if ($this->options['loop'])		
			$loop="&loop=1&playlist=$file";
		else $loop='';
		$thumb = $this->options['thumb'];
		$colorbox = $this->options['colorbox'];
		$logoless = $this->options['logoless'];
		$theme = $this->options['theme'];
		$excerpt = $this->options['excerpt'];
		
		switch ( $high ) {
			case 'v': 
				$high = ''; 
				break;
			case 'vh': 
				$high = '&amp;hd=1'; 
				break;
			case 'vhd': 
				$high = '&amp;hd=1'; 
				break;
			case 'vp': 
				$high = ''; 
				$playlist = 1; 
				break;
			case 'vhp': 
				$high = '&amp;hd=1'; 
				$playlist = 1; 
				break;
			default: 
				$high = ''; 
				break;
		}
		
		$width = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['widthside'] : 
				( $high ? $this->options['widthhq'] : $this->options['width'] );
		
		$height = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['heightside'] : 
				( $high ? $this->options['heighthq'] : $this->options['height'] );
		
		if ( ! $width ) {
			$width = ! $high ? 480 : 425 ;
		}
		
		if ( ! $height ) {
			$height = ! $high ? 360 : 344;
		}
		
		$ap = '';
		if ( is_single() ) {
			if ( $context == 'post' && $autoplay_first && ! $this->first ) {
				$ap = '&autoplay=1';
				$this->first = true;
			} else if ( ( $context == 'post' && $autoplay && ! $autoplay_first ) || ( $context == 'excerpt' && $autoplay ) ) {
				$ap = '&autoplay=1';
			} else {
				$ap = '';
			}
		} elseif ( $this->first_post_on_archive ) {
			if ( $context == 'post' && $autoplay_first && ! $this->first ) {
				$ap = '&autoplay=1';
				$this->first = true;
			} else if ( ( $context == 'post' && $autoplay && ! $autoplay_first ) || ( $context == 'excerpt' && $autoplay ) ) {
				$ap = '&autoplay=1';
			} else {
				$ap = '';
			}
		}
		
		if ( $logoless == 'on' ) {
			$ll = '&modestbranding=1';
			$disp_info = '';
		} else {
			$ll = '';
		}
		
		$root_url = $this->options['privacy'] ? 'http://www.youtube-nocookie.com' : 'http://www.youtube.com'; 
		
		if ( $excerpt == 'thm' ) {
			$img_url = htmlspecialchars( "http://img.youtube.com/vi/$file/0.jpg" );
			global $post;
			$post_url = get_permalink( $post->ID );
			$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
		}
		
		if ( ( ( is_home() || is_front_page() || is_archive() ) && $context == 'post' && $thumb == 'on' ) || ( $context == 'thumb' ) || ( $context == 'excerpt' && $excerpt == 'thm' ) ) {
			$img_url = htmlspecialchars( "http://img.youtube.com/vi/$file/0.jpg" );
			if ( $context == 'excerpt' && $excerpt == 'thm' ) {
				global $post;
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
			} else {
			$yte_tag = <<<EOT
<img src="$img_url" height="$height" width="$width" />
EOT;
			}
		} else {
			if ( $this->options['iframe'] == 'on' )
				$video_url = htmlspecialchars( "$root_url/embed/$file?wmode=transparent&fs=1&hl=en$ap$ll$loop{$disp_info}$disp_ann&showsearch=$disp_search&rel=$disp_rel&theme=$theme", ENT_QUOTES ) . $high . $time;
			else
				$video_url = htmlspecialchars( "$root_url/v/$file?wmode=transparent&fs=1&hl=en&$ap$ll$loop{$disp_info}$disp_ann&showsearch=$disp_search&rel=$disp_rel&theme=$theme", ENT_QUOTES ) . $high . $time;
			
			if ( $playlist ) {				
				$video_url = htmlspecialchars( "$root_url/embed/videoseries?list=$file&fs=1&hl=en$ap$ll$loop{$disp_info}$disp_ann&showsearch=$disp_search&rel=$disp_rel&theme=$theme", ENT_QUOTES ) . $high . $time;
				$yte_tag = <<<EOT
<span class="youtube"><iframe class="youtube-player" src="$video_url" width="$width" height="$height" frameborder="0" allowfullscreen></iframe></span>
EOT;
			} elseif ( $valid == 'off' || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPhone' ) === TRUE || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPod' ) === TRUE || strpos( $_SERVER['HTTP_USER_AGENT'], 'iPad' ) === TRUE ) {
				if ( $context == 'post' && $colorbox == 'on' ) {
					$img_url = htmlspecialchars( "http://img.youtube.com/vi/$file/0.jpg" );
					$yte_tag = <<<EOT
<a class="colorbox_video" href="$video_url"><img width="$width" height="$height" src="$img_url" /></a></span>
EOT;
				} else if ( $this->options['iframe'] == 'on' )
					$yte_tag = <<<EOT
<span class="youtube"><iframe title="YouTube video player" class="youtube-player" type="text/html" width="$width" height="$height" src="$video_url" frameborder="0" allowfullscreen></iframe></span>
EOT;
				else
					$yte_tag = <<<EOT
<span class="youtube"><object width="$width" height="$height"><param name="movie" value="$video_url" />
<param name="allowFullScreen" value="true" /><embed wmode="opaque" src="$video_url" type="application/x-shockwave-flash" allowfullscreen="true" width="$width" height="$height"></embed><param name="wmode" value="opaque" /></object></span>
EOT;
			} else {
				if ( $context == 'post' && $colorbox == 'on' ) {
					$img_url = htmlspecialchars( "http://img.youtube.com/vi/$file/0.jpg" );
					$yte_tag = <<<EOT
<a class="colorbox_video" href="$video_url"><img width="$width" height="$height" src="$img_url" /></a></span>
EOT;
				} else if ( $this->options['iframe'] == 'on' ) {
					$yte_tag = <<<EOT
<span class="youtube"><iframe title="YouTube video player" class="youtube-player" type="text/html" width="$width" height="$height" src="$video_url" frameborder="0" allowfullscreen></iframe></span>
EOT;
				} else {
					$yte_tag = <<<EOT
<span class="youtube"><object type="application/x-shockwave-flash" width="$width" height="$height" data="$video_url"><param name="movie" value="$video_url" />
<param name="allowFullScreen" value="true" /><param name="wmode" value="transparent" /></object></span>
EOT;
				}
			}
		}
		
		if ( is_feed() && ( $context == 'post' || $context = 'excerpt' ) ) {
			if ( $high ) {
				$high = '&fmt=18';
			}
			if ( $playlist )
				$url = 'http://www.youtube.com/playlist?list=';
			else
				$url = 'http://www.youtube.com/watch?v=';
				
			$yte_tag = '';
			if ( $this->options['link'] == 'on' ) {
				$yte_tag .= '<p><a href="' . $url . $file . $high . '">'.$url. $file . '</a></p>';
			}
			
			if ( $this->options['img'] == 'on' ) {
				$yte_tag .= '<p><a href="' . $url . $file . $high. '"><img src="http://img.youtube.com/vi/' . $file . '/default.jpg" width="130" height="97" border=0></a></p>';
			}
			
			 if ($this->options['link'] == 'off' && $this->options['img'] == 'off')
			 $yte_tag=$url.$file;
		}
		
		return str_replace( '{video}', $yte_tag, html_entity_decode( $template ) ); 
	}
	
	function tag_metacafe( $context, $file, $high = 'v', $name = '' ) {
		$width = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['widthside'] : 
				( $high ? $this->options['widthhq'] : $this->options['width'] );
		
		$height = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['heightside'] : 
				( $high ? $this->options['heighthq'] : $this->options['height'] );
		
		if ( ! $width ) {
			$width = ! ( $high == 'v' ) ? 480 : 425 ;
		}
		
		if ( ! $height ) {
			$height = ! ( $high == 'v' ) ? 360 : 344;
		}
		
		$template = trim( $this->options['template'] ) == '' ? '{video}' : $this->options['template'];
		$excerpt = $this->options['excerpt'];
		$thumb = $this->options['thumb'];
		$colorbox = $this->options['colorbox'];
		$autoplay = $this->options['autoplay'];
		$autoplay_first = $this->options['autoplay_first'];
		
		$ap = 'no';
		if ( is_single() ) {
			if ( $context == 'post' && $autoplay_first && ! $this->first ) {
				$ap = 'yes';
				$this->first = true;
			} else if ( ( $context == 'post' && $autoplay && ! $autoplay_first ) || ( $context == 'excerpt' && $autoplay ) ) {
				$ap = 'yes';
			} else {
				$ap = 'no';
			}
		} elseif ( $this->first_post_on_archive ) {
			if ( $context == 'post' && $autoplay_first && ! $this->first ) {
				$ap = 'yes';
				$this->first = true;
			} else if ( ( $context == 'post' && $autoplay && ! $autoplay_first ) || ( $context == 'excerpt' && $autoplay ) ) {
				$ap = 'yes';
			} else {
				$ap = 'no';
			}
		}
		
		$flash_vars = "playerVars=showStats=no|autoPlay=$ap|";
		
		if ( ( ( is_home() || is_front_page() || is_archive() ) && $context == 'post' && $thumb == 'on' ) || ( $context == 'thumb' ) || ( $context == 'excerpt' && $excerpt == 'thm' ) ) {
			$img_url = htmlspecialchars( "http://www.metacafe.com/thumb/$file.jpg" );
			if ( $context == 'excerpt' && $excerpt == 'thm' ) {
				global $post;
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
			} else {
			$yte_tag = <<<EOT
<img src="$img_url" height="$height" width="$width" />
EOT;
			}
		} else if ( $context == 'post' && $colorbox == 'on' ) {
			$img_url = htmlspecialchars( "http://www.metacafe.com/thumb/$file.jpg" );
			$yte_tag = <<<EOT
<a class="colorbox_video" href="http://www.metacafe.com/fplayer/$file/$name.swf"><img width="$width" height="$height" src="$img_url" /></a></span>
EOT;
		} else {
			$yte_tag = <<<EOT
<embed flashVars="$flash_vars" src="http://www.metacafe.com/fplayer/$file/$name.swf" width="$width" height="$height" wmode="transparent" allowFullScreen="true" allowScriptAccess="always" name="Metacafe_6261286" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
EOT;
		}
		
		return str_replace( '{video}', $yte_tag, html_entity_decode( $template ) ); 
	}
	
	function tag_vimeo( $context, $file, $high = 'v', $side = 0 ) {
		$width = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['widthside'] : 
				( $high ? $this->options['widthhq'] : $this->options['width'] );
		
		$height = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['heightside'] : 
				( $high ? $this->options['heighthq'] : $this->options['height'] );
		
		if ( ! $width ) {
			$width = ! ( $high == 'v' ) ? 480 : 425 ;
		}
		
		if ( ! $height ) {
			$height = ! ( $high == 'v' ) ? 360 : 344;
		}
		
		$template = trim( $this->options['template'] ) == '' ? '{video}' : $this->options['template'];
		$excerpt = $this->options['excerpt'];
		$thumb = $this->options['thumb'];
		$colorbox = $this->options['colorbox'];
		$autoplay = $this->options['autoplay'];
		$autoplay_first = $this->options['autoplay_first'];
		$loop = $this->options['loop'];
				
		$video_url = "http://player.vimeo.com/video/$file";
		
		if ( $context == 'post' && $autoplay_first && ! $this->first ) {
			if ( is_single() ) {
				$video_url .= "?autoplay=1";
			} elseif ( $this->first_post_on_archive ) {
				$video_url .= "?autoplay=1";
			}
			if ( $loop ) {
				$video_url .= "&amp;loop=1";
			}
			$this->first = true;
		} else if ( ( $context == 'post' && $autoplay && ! $autoplay_first ) || ( $context == 'excerpt' && $autoplay ) ) {
			if ( is_single() ) {
				$video_url .= "?autoplay=1";
			} elseif ( $this->first_post_on_archive ) {
				$video_url .= "?autoplay=1";
			}
			if ( $loop ) {
				$video_url .= "&amp;loop=1";
			}
		} else {
			if ( $loop ) {
				$video_url .= "?loop=1";
			}
		}
		
		if ( ( ( is_home() || is_front_page() || is_archive() ) && $context == 'post' && $thumb == 'on' ) || ( $context == 'thumb' ) || ( $context == 'excerpt' && $excerpt == 'thm' ) ) {
			$thumbs = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$file.php"));
			$img_url = htmlspecialchars($thumbs[0]['thumbnail_large']);
			if ( $context == 'excerpt' && $excerpt == 'thm' ) {
				global $post;
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
			} else {
			$yte_tag = <<<EOT
<img src="$img_url" height="$height" width="$width" />
EOT;
			}
		}
		else if ( $context == 'post' && $colorbox == 'on' ) {
			$thumbs = unserialize( file_get_contents( "http://vimeo.com/api/v2/video/$file.php" ) );
			$img_url = htmlspecialchars( $thumbs[0]['thumbnail_large'] );
			$yte_tag = <<<EOT
<a class="colorbox_video" href="$video_url"><img width="$width" height="$height" src="$img_url" /></a>
EOT;
		} else {
			$yte_tag = <<<EOT
<iframe src="$video_url" width="$width" height="$height" frameborder="0"></iframe>
EOT;
		}
		
		return str_replace( '{video}', $yte_tag, html_entity_decode( $template ) ); 
	}
	
	function tag_liveleak( $context, $file, $high = 'v', $side = 0 ) {
		$width = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['widthside'] : 
				( $high ? $this->options['widthhq'] : $this->options['width'] );
		
		$height = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['heightside'] : 
				( $high ? $this->options['heighthq'] : $this->options['height'] );
		
		if ( ! $width ) {
			$width = ! ( $high == 'v' ) ? 480 : 425 ;
		}
		
		if ( ! $height ) {
			$height = ! ( $high == 'v' ) ? 360 : 344;
		}
		
		$template = trim($this->options['template']) == '' ? '{video}' : $this->options['template'];
		$thumb = $this->options['thumb'];
		$colorbox = $this->options['colorbox'];
		$excerpt = $this->options['excerpt'];
		
		if ( ( ( is_home() || is_front_page() || is_archive() ) && $context == 'post' && $thumb == 'on' ) || ( $context == 'thumb' ) || ( $context == 'excerpt' && $excerpt == 'thm' ) ) {
			$img_url = htmlspecialchars( $this->plugin_url . '/img/default.jpg' );
			if ( $context == 'excerpt' && $excerpt == 'thm' ) {
				global $post;
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
			} else {
			$yte_tag = <<<EOT
<img src="$img_url" height="$height" width="$width" />
EOT;
			}
		} else if ( $context == 'post' && $colorbox == 'on' ) {
			$img_url = htmlspecialchars( $this->plugin_url . '/img/default.jpg' );
			$yte_tag = <<<EOT
<a class="colorbox_video" href="http://www.liveleak.com/e/$file"><img width="$width" height="$height" src="$img_url" /></a></span>
EOT;
		} else {
			$yte_tag = <<<EOT
<object width="$width" height="$height"><param name="movie" value="http://www.liveleak.com/e/$file"></param><param name="wmode" value="transparent"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.liveleak.com/e/$file" type="application/x-shockwave-flash" wmode="transparent" allowscriptaccess="always" width="$width" height="$height"></embed></object>
EOT;
		}
		
		return str_replace( '{video}', $yte_tag, html_entity_decode( $template ) ); 
	}
	
	function tag_facebook( $context, $file, $high = 'v', $side = 0 ) {
		$width = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['widthside'] : 
				( $high ? $this->options['widthhq'] : $this->options['width'] );
		
		$height = ( $context == 'excerpt' || $context == 'side' ) ? 
				$this->options['heightside'] : 
				( $high ? $this->options['heighthq'] : $this->options['height'] );
		
		if ( ! $width ) {
			$width = ! ( $high == 'v' ) ? 480 : 425 ;
		}
		
		if ( ! $height ) {
			$height = ! ( $high == 'v' ) ? 360 : 344;
		}
		
		$template = trim($this->options['template']) == '' ? '{video}' : $this->options['template'];
		$thumb = $this->options['thumb'];
		$colorbox = $this->options['colorbox'];
		$excerpt = $this->options['excerpt'];
		
		if ( ( ( is_home() || is_front_page() || is_archive() ) && $context == 'post' && $thumb == 'on' ) || ( $context == 'thumb' ) || ( $context == 'excerpt' && $excerpt == 'thm' ) ) {
			$img_url = htmlspecialchars( $this->plugin_url . '/img/default.jpg' );
			if ( $context == 'excerpt' && $excerpt == 'thm' ) {
				global $post;
				$post_url = get_permalink( $post->ID );
				$yte_tag = <<<EOT
<a href="$post_url"><img src="$img_url" height="$height" width="$width" /></a>
EOT;
			} else {
				$yte_tag = <<<EOT
<img src="$img_url" height="$height" width="$width" />
EOT;
			}
		} else if ( $context == 'post' && $colorbox == 'on' ) {
			$img_url = htmlspecialchars( $this->plugin_url . '/img/default.jpg' );
			$yte_tag = <<<EOT
<a class="colorbox_video" href="http://www.facebook.com/v/$file"><img width="$width" height="$height" src="$img_url" /></a></span>
EOT;
		} else {
			$yte_tag = <<<EOT
<object width="$width" height="$height"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" />
<param name="movie" value="http://www.facebook.com/v/$file" /><embed src="http://www.facebook.com/v/$file" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="$width" height="$height"></embed></object> 
EOT;
		}
		
		return str_replace( '{video}', $yte_tag, html_entity_decode( $template ) ); 
	}
	
	function install() {
		add_action( 'widgets_init', array( $this, 'load_widgets' ) );
		
		if ( get_option( $this->key ) ) {
			$this->options = $this->get_options();
		}
	}
	
	// Handle our options
	function get_options() {
		$options = array(
			'posts' => 'on',
			'comments' => 'off',
			'img' => 'off',
			'width' => 425,
			'height' => 344,
			'widthhq' => 480,
			'heighthq' => 295,
			'widthside' => 200,
			'heightside' => 167,
			'rel' => 1,
			'link' => 'on',
			'valid' => 'off',
			'search' => 'off',
			'info' => 'on',
			'ann' => 'on',
			'template' => '{video}',
			'autoplay' => 0,
			'autoplay_first' => 0,
			'privacy' => 0,
			'wtext' => '',
			'wtitle' => '',
			'tag' => '',
			'iframe' => 'on',
			'http' => 'off',
			'www' => 'off',
			'loop' => 0,
			'thumb' => 'off',
			'colorbox' => 'off',
			'colorbox_theme' => 1,
			'excerpt' => 'not',
			'logoless' => 'on',
			'wiziapp' => 'off',
			'theme' => 'dark'
		);
		$saved = get_option( $this->key );
		
		if ( ! empty( $saved ) ) {
			foreach ( $saved as $key => $option ) {
				$options[$key] = $option;
			}
		}
			  
		if ( $saved != $options ) {
			update_option( $this->key, $options );
		}
		
		return $options;
	}	
		  
	function load_widgets() {
		register_widget( 'SmartYouTube_Widget' );
	}
	
	/**
	 * Gets plugin info from WordPress Codex repo 
	 * @return mixed
	 */
	function get_info() {
		$checkfile = 'http://svn.wp-plugins.org/smart-youtube/trunk/smartyoutube.chk';
		
		$status = array();
		
		return $status; //???
		
		$vcheck = wp_remote_fopen( $checkfile );
		
		if ( $vcheck ) {
			$version = $this->local_version;
			
			$status = explode( '@', $vcheck );
			return $status;
		}
	}
}

class SmartYouTube_Widget extends WP_Widget {
	function SmartYouTube_Widget() {		
		$widget_ops = array( 'classname' => 'smart-youtube', 'description' => 'A widget which dispalys some video from Youtube.' );		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'smart-youtube' );
		$this->WP_Widget( 'smart-youtube', 'Smart Youtube', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$text = smart_youtube_check( $instance['text'], 1 );
		$title = $instance['title'];
		
		echo
		$before_widget,
		$before_title, $title, $after_title,
		$text,
		$after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 'title' => 'Smart Youtube Widget', 'text' => '' );
		$instance = wp_parse_args( ( array )$instance, $defaults ); 
?>
<?php _e('Title:', 'smart-youtube'); ?><br /><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /><br />
<?php _e('Insert HTML code below. In addition to normal text you may use httpv, httpvh and httpvhd links just like in your posts.'); ?><br />
<textarea id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" rows="10" cols="16" class="widefat"><?php echo $instance['text']; ?></textarea>
<?php
	}
}

function smart_youtube_check( $the_content, $side = 0 ) {
	global $smart_youtube_pro;
	return $smart_youtube_pro->check( $the_content, $side );
}

function syt_show_thumb( $post_id ) {
	$p = get_post( $post_id );
	$content = $p->post_content;
	
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtube\.com\/watch(\?v\=|\/v\/|#!v=)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $content, $matches['youtube.com'], PREG_SET_ORDER );
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?youtu\.be\/([a-zA-Z0-9\-\_]{11})/", $content, $matches['youtu.be'], PREG_SET_ORDER );
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?metacafe\.com\/watch\/([a-zA-Z0-9\-\_]{7})\/([^<^\/\s]*)([\/])?/", $content, $matches['metacafe.com'], PREG_SET_ORDER );
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?vimeo\.com\/([a-zA-Z0-9\-\_]{8})([\/])?/", $content, $matches['vimeo.com'], PREG_SET_ORDER );
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?liveleak\.com\/view(\?i\=)([a-zA-Z0-9\-\_]*)/", $content, $matches['liveleak.com'], PREG_SET_ORDER );
	preg_match_all( "/(http(v|vh|vhd)?:\/\/)?([a-zA-Z0-9\-\_]+\.|)?facebook\.com\/video\/video.php\?v\=([a-zA-Z0-9\-\_]*)/", $content, $matches['facebook.com'], PREG_SET_ORDER );
	
	global $smart_youtube_pro;
	
	if ( isset( $matches['youtube.com'][0] ) ) {
		if ( ( $matches['youtube.com'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['youtube.com'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['youtube.com'][0][0] = str_replace( $matches['youtube.com'][0][0], $smart_youtube_pro->tag_youtube( 'excerpt', $matches['youtube.com'][0][5], 'v', $matches['youtube.com'][0][6] ), $matches['youtube.com'][0][0] );
		} else if ( $matches['youtube.com'][0][2] == 'v' || $matches['youtube.com'][0][2] == 'vh' || $matches['youtube.com'][0][2] == 'vhd' ) {
			$matches['youtube.com'][0][0] = str_replace( $matches['youtube.com'][0][0], $smart_youtube_pro->tag_youtube( 'excerpt', $matches['youtube.com'][0][5], $matches['youtube.com'][0][2], $matches['youtube.com'][0][6] ), $matches['youtube.com'][0][0] );
		}
		$result = $matches['youtube.com'][0][0];
	} else if ( isset( $matches['youtu.be'][0] ) ) {
		if ( ( $matches['youtu.be'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['youtu.be'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['youtu.be'][0][0] = str_replace( $matches['youtu.be'][0][0], $smart_youtube_pro->tag_youtube( 'excerpt', $matches['youtu.be'][0][4], 'v' ), $matches['youtu.be'][0][0] );
		} else if ( $matches['youtu.be'][0][2] == 'v' || $matches['youtu.be'][0][2] == 'vh' || $matches['youtu.be'][0][2] == 'vhd' ) {
			$matches['youtu.be'][0][0] = str_replace( $matches['youtu.be'][0][0], $smart_youtube_pro->tag_youtube( 'excerpt', $matches['youtu.be'][0][4], $matches['youtu.be'][0][2]), $matches['youtu.be'][0][0] );
		}
		$result = $matches['youtu.be'][0][0];
	} else if ( isset( $matches['metacafe.com'][0] ) ) {
		if ( ( $matches['metacafe.com'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['metacafe.com'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['metacafe.com'][0][0] = str_replace( $matches['metacafe.com'][0][0], $smart_youtube_pro->tag_metacafe( 'excerpt', $matches['metacafe.com'][0][4], 'v', $matches['metacafe.com'][0][5] ), $matches['metacafe.com'][0][0] );
		} else if ( $matches['metacafe.com'][0][2] == 'v' || $matches['metacafe.com'][0][2] == 'vh' || $matches['metacafe.com'][0][2] == 'vhd' ) {
			$matches['metacafe.com'][0][0] = str_replace( $matches['metacafe.com'][0][0], $smart_youtube_pro->tag_metacafe( 'excerpt', $matches['metacafe.com'][0][4], $matches['metacafe.com'][0][2], $matches['metacafe.com'][0][5] ), $matches['metacafe.com'][0][0] );
		}
		$result = $matches['metacafe.com'][0][0];
	} else if ( isset($matches['vimeo.com'][0] ) ) {
		if ( ( $matches['vimeo.com'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['vimeo.com'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['vimeo.com'][0][0] = str_replace( $matches['vimeo.com'][0][0], $smart_youtube_pro->tag_vimeo( 'excerpt', $matches['vimeo.com'][0][4], 'v' ), $matches['vimeo.com'][0][0] );
		}
		else if ( $matches['vimeo.com'][0][2] == 'v' || $matches['vimeo.com'][0][2] == 'vh' || $matches['vimeo.com'][0][2] == 'vhd' ) {
			$matches['vimeo.com'][0][0] = str_replace( $matches['vimeo.com'][0][0], $smart_youtube_pro->tag_vimeo( 'excerpt', $matches['vimeo.com'][0][4], $matches['vimeo.com'][0][2] ), $matches['vimeo.com'][0][0] );
		}
		$result = $matches['vimeo.com'][0][0];
	} else if ( isset( $matches['liveleak.com'][0] ) ) {
		if ( ( $matches['liveleak.com'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['liveleak.com'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['liveleak.com'][0][0] = str_replace( $matches['liveleak.com'][0][0], $smart_youtube_pro->tag_liveleak( 'excerpt', $matches['liveleak.com'][0][4], 'v' ), $matches['liveleak.com'][0][0] );
		} else if ( $matches['liveleak.com'][0][2] == 'v' || $matches['liveleak.com'][0][2] == 'vh' || $matches['liveleak.com'][0][2] == 'vhd' ) {
			$matches['liveleak.com'][0][0] = str_replace( $matches['liveleak.com'][0][0], $smart_youtube_pro->tag__liveleak( 'excerpt', $matches['liveleak.com'][0][4], $matches['liveleak.com'][0][2] ), $matches['liveleak.com'][0][0] );
		}
		$result = $matches['liveleak.com'][0][0];
	} else if ( isset( $matches['facebook.com'][0] ) ) {
		if ( ( $matches['facebook.com'][0][1] == 'http://' && $smart_youtube_pro->options['http'] == 'on' ) || ( $matches['facebook.com'][0][1] == '' && $smart_youtube_pro->options['www'] == 'on' ) ) {
			$matches['facebook.com'][0][0] = str_replace( $matches['facebook.com'][0][0], $smart_youtube_pro->tag_facebook( 'excerpt', $matches['facebook.com'][0][4], 'v' ), $matches['facebook.com'][0][0] );
		} else if ( $matches['facebook.com'][0][2] == 'v' || $matches['facebook.com'][0][2] == 'vh' || $matches['facebook.com'][0][2] == 'vhd' ) {
			$matches['facebook.com'][0][0] = str_replace( $matches['facebook.com'][0][0], $smart_youtube_pro->tag_facebook( 'excerpt', $matches['facebook.com'][0][4], $matches['facebook.com'][0][2] ), $matches['facebook.com'][0][0] );
		}
		$result = $matches['facebook.com'][0][0];
	} else {
		$width = $smart_youtube_pro->options['width'];
		$height = $smart_youtube_pro->options['height'];  
		
		$img_url = htmlspecialchars( $smart_youtube_pro->plugin_url . '/img/default.jpg' );
		$post_url = get_permalink( $post->ID );
		$yte_tag = <<<EOT
<a href="$post_url">
<img src="$img_url" height="$height" width="$width" />
</a>
EOT;
		$result = str_replace( '{video}', $yte_tag, html_entity_decode( $template ) );
	}
	if ( isset( $result ) ) {
		return $result;
	}
}
?>
