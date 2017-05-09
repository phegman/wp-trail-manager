<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://peterhegman.com/
 * @since      1.0.0
 *
 * @package    Trail_Manager
 * @subpackage Trail_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trail_Manager
 * @subpackage Trail_Manager/public
 * @author     Peter Hegman <phegman@icloud.com>
 */
class Trail_Manager_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trail_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trail_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trail-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Trail_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Trail_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
	}

	/**
	 * Get meta
	 * @param  string $value slug of field to retreive
	 * @return string value of meta
	 */
	public static function trail_manager_get_trails() {
		global $post;

		$field = get_post_meta( $post->ID, 'trails', true );
		if ( ! empty( $field ) ) {
			return json_decode( html_entity_decode($field) );
		} else {
			return false;
		}
	}

	/**
	 * Get number of trails open
	 * @param  string $status Trail status to count
	 * @return int Number of trails open
	 */
	public static function trail_manager_number_trails_status( $status ) {
		$trails = self::trail_manager_get_trails();
		$trails_w_status = 0;

		foreach ($trails as $trail) {
			if ($trail->status == $status) {
				$trails_w_status++;
			}
		}

		return $trails_w_status;
	}

	/**
	 * Add shortcode to embed trail manager in page
	 * @param  [type] $atts [description]
	 * @return [type]       [description]
	 */
	function trail_manager_register_shortcode( $atts ) {
		ob_start();
		if ( is_array( $atts ) && array_key_exists('post-id', $atts) ) {
			include( plugin_dir_path( __FILE__ ) . 'partials/trail-manager-single-network.php' );
		} else {
			include( plugin_dir_path( __FILE__ ) . 'partials/trail-manager-all-networks.php' );
		}
		return ob_get_clean();
	}

}
