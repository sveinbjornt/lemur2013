<?php


add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));


/*** Theme setup ***/

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );


function sight_setup() {
    update_option('thumbnail_size_w', 320);
    update_option('thumbnail_size_h', 320);
    add_image_size( 'list', 120, 90, true );
    add_image_size( 'sidebar', 320, 240, true );
    add_image_size( 'safn', 275, 200, true);
    add_image_size( 'myndin', 670, 9999 );
}
add_action( 'init', 'sight_setup' );

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
    update_option( 'posts_per_page', 12 );
    update_option( 'paging_mode', 'default' );
}

/*** RSS ***/


remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action(‘wp_head’, ‘feed_links’, 1);
// 
// function remove_comments_rss( $for_comments ) {
//     return '';
// }
// add_filter('post_comments_feed_link_html','remove_comments_rss');
// add_filter('post_comments_feed_link','remove_comments_rss');

/*** Navigation ***/

/*** Slideshow ***/

// Add meta box
function sight_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'sight_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function sight_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="sight_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:50%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
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

function comments_link_attributes(){
    return 'class="comments_popup_link"';
}
add_filter('comments_popup_link_attributes', 'comments_link_attributes');

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
