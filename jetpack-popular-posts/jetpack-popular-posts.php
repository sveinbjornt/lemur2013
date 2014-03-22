<?php

/*
Plugin Name: Jetpack Popular Posts
Plugin URI: http://www.my-wp-plugins.com/Forum-jetpack-popular-posts.html
Description: Using Jetpack stats, this widget will display the most popular posts.
Author: LordPretender
Version: 1.0.1
Author URI: http://www.duy-pham.fr
Domain Path: /languages
*/

//http://www.fruityfred.com/2012/08/20/internationaliser-traduire-un-plugin-wordpress/
load_plugin_textdomain('jetpack-popular-posts', false, dirname( plugin_basename( __FILE__ ) ). '/languages/');

//Déclaration de notre extention en tant que Widget
function register_JPP_Widget() {
    register_widget( 'JPP_Widget' );
}
add_action( 'widgets_init', 'register_JPP_Widget' );

/**
* Documentation : http://codex.wordpress.org/Widgets_API
* S'inspirer de wp-content/plugins/jetpack/modules/widgets/top-posts.php
* S'inspirer de http://wordpress.org/plugins/jetpack-post-views/
*/
class JPP_Widget extends WP_Widget {
	private $default_title;
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'jpp_widget', // Base ID
			'Jetpack Popular Posts', // Name
			array( 'description' => __('Shows your most viewed posts, based on Jetpack stats.', 'jetpack-popular-posts'), ) // Args
		);
		
		$this->default_title = __('Popular Posts', 'jetpack-popular-posts');
		
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
 	public function form( $instance ) {
		
		$title		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : $this->default_title;
		$number		= $this->getInstanceNumber($instance);
		$range		= $this->getInstanceRange($instance);
		$category	= isset( $instance['category'] ) ? (bool) $instance['category'] : false;
		
?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Maximum number of posts to show (no more than 10):', 'jetpack' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" value="<?php echo (int) $number; ?>" min="1" max="10" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('range'); ?>"><?php _e( 'Range:', 'jetpack-popular-posts' ); ?></label>
			<select name="<?php echo $this->get_field_name('range'); ?>" id="<?php echo $this->get_field_id('range'); ?>" class="widefat">
					<option value="-1" <?php echo ($range == -1 ? 'selected' : '') ?> ><?php _e('All time', 'jetpack-popular-posts'); ?></option>
					<option value="1" <?php echo ($range == 1 ? 'selected' : '') ?> ><?php _e('From one day', 'jetpack-popular-posts'); ?></option>
					<option value="7" <?php echo ($range == 7 ? 'selected' : '') ?> ><?php _e('From one week', 'jetpack-popular-posts'); ?></option>
					<option value="30" <?php echo ($range == 30 ? 'selected' : '') ?> ><?php _e('From one month', 'jetpack-popular-posts'); ?></option>
					<option value="366" <?php echo ($range == 366 ? 'selected' : '') ?> ><?php _e('From one year', 'jetpack-popular-posts'); ?></option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $category ); ?> id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Display post category?', 'jetpack-popular-posts' ); ?></label>
		</p>
<?php
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title']		= strip_tags($new_instance['title']);
		$instance['number']		= $this->getInstanceNumber($new_instance);
		$instance['range']		= $this->getInstanceRange($new_instance);
		$instance['category']	= isset( $new_instance['category'] ) ? (bool) $new_instance['category'] : false;
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['jetpack-popular-posts']) )
			delete_option('jetpack-popular-posts');

		return $instance;
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$cache = wp_cache_get('jetpack-popular-posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}
		
		ob_start();
		extract($args);

		$title		= apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		$number		= $this->getInstanceNumber($instance);
		$range		= $this->getInstanceRange($instance);
		$categorie	= isset( $instance['category'] ) ? $instance['category'] : false;
		
		//Lecture des IDs populaires
		$IDs = $this->getPopularIDs($range);
		
		$posts = $this->getPopularPosts($IDs, $number, $categorie);
		
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="article-list">
<?php
		foreach($posts as $post){
			//Ajouter dans le titre la catégorie associée ?
			$catTitre = $post["cat_name"] == "" ? "" : $post["cat_name"];
			
			$lien = $post["permalink"];
			$titre = $post["title"];
			
			$thumb_id = get_post_thumbnail_id($post["ID"]);
            $thumb_url = wp_get_attachment_image_src($thumb_id, 'list', true);
            $thumb_url = $thumb_url[0];
            
?>
			<li>
			    <a href="<?php echo $lien; ?>" title="<?php echo $titre; echo $post["ID"]; ?>">
			        <div class="figure">
        	        	<div class="aspect album">
    			            <img src="<?php echo $thumb_url; ?>" class="attachment-list wp-post-image" alt="<?php echo $titre; ?>" scale="0">
    			        </div>
    			    </div>
    			    <p>
    			        <?php echo $titre; ?>
    			        <br>
    			        <span class="date"><?php echo $catTitre; ?></span>
    			    </p>
			    </a>
			</li>
<?php
		}
?>
		</ul>
		<?php echo $after_widget; ?>
<?php

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('jetpack-popular-posts', $cache, 'widget');
		
	}
	
	private function getPopularPosts($IDs, $number, $displayCat){
		$counter = 0;
		$posts = array();
		
		foreach ( (array) $IDs as $post_id ) {
			$post = get_post( $post_id );
			$cat_name = "";

			if ( !$post ) continue;

			// On ne garde que les articles. Il est donc possible qu'à la fin, nous ayons moins d'articles que demandé
			if ( 'post' != $post->post_type ) continue;

			// On ne garde que les articles publiés et non protégés
			if ( 'publish' != $post->post_status || !empty( $post->post_password ) || empty( $post->ID ) )
				continue;

			// Both get HTML stripped etc on display
			if ( empty( $post->post_title ) ) {
				$title_source = $post->post_content;
				$title = wp_html_excerpt( $title_source, 50 );
				$title .= '&hellip;';
			} else {
				$title = $post->post_title;
			}
			
			// Si l'affichage du nom de la catégorie est demandée, alors on va la lire.
			if($displayCat){
				$category = get_the_category($post->ID); 
				
				if($category[0]){
				    if ($category[0]->slug == 'forsida') {
				        if (count($category) > 1) {
				            $cat_name = $category[1]->cat_name;
				        } else {
				            $cat_name = "";
				        }
				    } else {
					    $cat_name = $category[0]->cat_name;
					}
				}
			}
			
			// Génération du lien
			$permalink = get_permalink( $post->ID );
			
			$ID = $post->ID;
			
			// Ajout dans le tableau qui sera renvoyé
			$posts[] = compact( 'title', 'permalink', 'cat_name', 'ID');
			
			$counter++;
			if ( $counter == $number )
				break; // only need to load and show x number of likes
		}

		return $posts;
	}
	
	/**
	* Lecture des stats Jetpack afin d'y récupérer les articles/pages populaires.
	* 
	* @param int $days Période concernée.
	* 
	* @return array Tableau d'ID.
	*/
	private function getPopularIDs( $days ) {
		//Lecture des articles populaires sur la période demandée.
		$post_view_posts = stats_get_csv( 'postviews', array( 'days' => $days, 'limit' => 100 ) );
		if ( !$post_view_posts ) {
			return array();
		}
		
		//On récupère les ID.
		$post_view_ids = array_filter( wp_list_pluck( $post_view_posts, 'post_id' ) );
		if ( !$post_view_ids ) {
			return array();
		}

		return $post_view_ids;
	}

	private function flush_widget_cache() {
		wp_cache_delete('jetpack-popular-posts', 'widget');
	}
	
	private function getInstanceNumber($instance){
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 10;
		
		//Protection pour éviter d'avoir un nombre hors des limites fixées.
		if ( $number < 1 || 10 < $number )$number = 10;
		
		return $number;
	}
	
	private function getInstanceRange($instance){
		$ranges = array(-1, 1, 7, 30, 366);
		$défaut = -1;
		
		//Lecture de la période
		$range = isset( $instance['range'] ) ? intval( $instance['range'] ) : $défaut;
		
		//On s'assure que la période choisie existe bien
		if(!in_array($range, $ranges))$range = $défaut;
		
		return $range;
	}
	
}

?>