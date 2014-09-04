<?php

/*** Theme setup ***/

add_theme_support( 'automatic-feed-links' );

function theme_setup() {
    add_image_size( 'list', 120, 90, true );
    add_image_size( 'sidebar', 320, 240, true );
    add_image_size( 'safn', 275, 200, true);
    add_image_size( 'myndin', 670, 9999 );
}
add_action( 'init', 'theme_setup' );

/* Ignore the default image sizes in wordpress */
function trickspanda_remove_default_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['large']);
 
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'trickspanda_remove_default_image_sizes');

function wpmayor_custom_image_sizes($sizes) {
    $myimgsizes = array(
        "list" => __( "List" ),
        "sidebar" => __( "Sidebar" ),
        "safn" => __( "Safn" ),
        "medium" => __("Miðstærð"),
        "myndin" => __( "Featured image" ),
        "full" => __( "Original size" )
        );
    return $myimgsizes;
}
add_filter('image_size_names_choose', 'wpmayor_custom_image_sizes');

/* Remove Jetpack styles */
function remove_jetpack_styles(){
    wp_deregister_style('AtD_style'); // After the Deadline
    wp_deregister_style('jetpack-carousel'); // Carousel
    wp_deregister_style('grunion.css'); // Grunion contact form
    wp_deregister_style('the-neverending-homepage'); // Infinite Scroll
    wp_deregister_style('infinity-twentyten'); // Infinite Scroll - Twentyten Theme
    wp_deregister_style('infinity-twentyeleven'); // Infinite Scroll - Twentyeleven Theme
    wp_deregister_style('infinity-twentytwelve'); // Infinite Scroll - Twentytwelve Theme
    wp_deregister_style('noticons'); // Notes
    wp_deregister_style('jetpack-subscriptions');
    wp_deregister_style('jetpack-subscriptions-css');
    wp_deregister_style('post-by-email'); // Post by Email
    wp_deregister_style('publicize'); // Publicize
    wp_deregister_style('sharedaddy'); // Sharedaddy
    wp_deregister_style('sharing'); // Sharedaddy Sharing
    wp_deregister_style('stats_reports_css'); // Stats
    wp_deregister_style('jetpack-widgets'); // Widgets
}
add_action('wp_print_styles', 'remove_jetpack_styles');

/* Remove shortlinks and feed links */
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links');
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action( 'wp_head', 'index_rel_link');
remove_action( 'wp_head', 'parent_post_rel_link');
remove_action( 'wp_head', 'start_post_rel_link');
remove_action( 'wp_head', 'adjacent_posts_rel_link');
remove_action( 'wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*** RSS ***/

remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action(‘wp_head’, ‘feed_links’, 1);

// Add RSS feed logo

add_action('rss2_head', 'lemurinn_add_rss_image');

function lemurinn_add_rss_image() {
    echo "<image>
    <title>Lemúrinn</title>
    <url>" . get_bloginfo('template_directory') . "/assets/images/lemur-fb-icon.jpg</url>
    <link>" . get_bloginfo('url') ."</link>
    <width>760</width>
    <height>760</height>
    <description>Lemúrinn er furðuleg vera, rétt eins og náfrændi hans maðurinn.</description>
    </image>";
}

/*** Widgets ***/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'=>'Site description',
        'before_widget' => '<div class="site-description">',
        'after_widget' => '</div>'
    ));
    register_sidebar(array(
        'name'=>'Sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-body clear">'
    ));    
}

function seo_title() {
    global $page, $paged;
    $sep = " | "; # delimiter
    $newtitle = get_bloginfo('name'); # default title

    # Single & Page ##################################
    if (is_single() || is_page())
        $newtitle = single_post_title("", false);

    # Category ######################################
    if (is_category())
        $newtitle = single_cat_title("", false);

    # Tag ###########################################
    if (is_tag())
     $newtitle = single_tag_title("", false);

    # Search result ################################
    if (is_search())
     $newtitle = "Leitarniðurstöður " . $s;

    # Taxonomy #######################################
    if (is_tax()) {
        $curr_tax = get_taxonomy(get_query_var('taxonomy'));
        $curr_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy')); # current term data
        # if it's term
        if (!empty($curr_term)) {
            $newtitle = $curr_tax->label . $sep . $curr_term->name;
        } else {
            $newtitle = $curr_tax->label;
        }
    }

    # Page number
    if ($paged >= 2 || $page >= 2)
            $newtitle .= $sep . sprintf('Síða %s', max($paged, $page));

    # Home & Front Page ########################################
    if (is_home() || is_front_page()) {
        $newtitle = get_bloginfo('name') . $sep . get_bloginfo('description');
    } else {
        $newtitle .=  $sep . get_bloginfo('name');
    }
        
	return $newtitle;
}
add_filter('wp_title', 'seo_title');

function next_posts_attributes(){
    return 'class="nextpostslink"';
}
add_filter('next_posts_link_attributes', 'next_posts_attributes');


add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Beyging</label></th>

			<td>
				<input type="text" name="name2" id="name2" value="<?php echo esc_attr( get_the_author_meta( 'name2', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Nafn í þolfalli</span>
			</td>
		</tr>

	</table>
	
<?php }


add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'name2', $_POST['name2'] );
}

function improved_trim_excerpt($text, $length, $more_text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text, '<p> <iframe> <img> <a>');
                if (!$length) {
                    $excerpt_length = 60;
                } else {
                    $excerpt_length = $length;
                }
                $words = explode(' ', $text, $excerpt_length + 1);
                array_pop($words);
                $text = implode(' ', $words);
                $more = '</a>&hellip;&nbsp;<a class="more-link" title="' . $more_text . '" href="'. get_permalink() . '">' .__('[' . $more_text . ']', 'thematic') . '</a>';
                $text = $text . $more;
                
        }
        return $text;
}


add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );


function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";
}
