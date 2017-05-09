<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://peterhegman.com/
 * @since      1.0.0
 *
 * @package    Trail_Manager
 * @subpackage Trail_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trail_Manager
 * @subpackage Trail_Manager/admin
 * @author     Peter Hegman <phegman@icloud.com>
 */
class Trail_Manager_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * If is add new trail network page
	 * @return boolean True for add new trail network page, otherwise false
	 */
	function is_new_trail_network() {
		global $pagenow;
		global $typenow;
		//make sure we are on the backend
		if (!is_admin()) {
			return false;
		}

		if ( ( in_array( $pagenow, array( 'post.php',  ) ) || in_array( $pagenow, array( 'post-new.php' ) ) ) && "trail_network" == $typenow) {
		   return true;
		} else {
			return false;
		}
	}

	/**
	 * Register the stylesheets for the admin area.
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
		if ( $this->is_new_trail_network() ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/trail-manager-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
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
		if ( $this->is_new_trail_network() ) {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dist/trail-manager-admin.js', array( 'jquery' ), $this->version, true );
		}

	}

	/**
	 * Register the trail_network CPT
	 */
	function trail_manager_register_post_types() {

		$labels = array(
			'name'                  => _x( 'Trail Networks', 'Post Type General Name', 'trail-manager' ),
			'singular_name'         => _x( 'Trail Network', 'Post Type Singular Name', 'trail-manager' ),
			'menu_name'             => __( 'Trail Manager', 'trail-manager' ),
			'name_admin_bar'        => __( 'Trail Manager', 'trail-manager' ),
			'archives'              => __( 'Trail Network Archives', 'trail-manager' ),
			'attributes'            => __( 'Item Attributes', 'trail-manager' ),
			'parent_item_colon'     => __( 'Parent Item:', 'trail-manager' ),
			'all_items'             => __( 'All Trail Networks', 'trail-manager' ),
			'add_new_item'          => __( 'Add New Trail Network', 'trail-manager' ),
			'add_new'               => __( 'Add New Trail Network', 'trail-manager' ),
			'new_item'              => __( 'New Trail Network', 'trail-manager' ),
			'edit_item'             => __( 'Edit Trail Network', 'trail-manager' ),
			'update_item'           => __( 'Update Trail Network', 'trail-manager' ),
			'view_item'             => __( 'View Trail Network', 'trail-manager' ),
			'view_items'            => __( 'View Trail Network', 'trail-manager' ),
			'search_items'          => __( 'Search Trail Network', 'trail-manager' ),
			'not_found'             => __( 'Not found', 'trail-manager' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'trail-manager' ),
			'featured_image'        => __( 'Featured Image', 'trail-manager' ),
			'set_featured_image'    => __( 'Set featured image', 'trail-manager' ),
			'remove_featured_image' => __( 'Remove featured image', 'trail-manager' ),
			'use_featured_image'    => __( 'Use as featured image', 'trail-manager' ),
			'insert_into_item'      => __( 'Insert into item', 'trail-manager' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'trail-manager' ),
			'items_list'            => __( 'Items list', 'trail-manager' ),
			'items_list_navigation' => __( 'Items list navigation', 'trail-manager' ),
			'filter_items_list'     => __( 'Filter items list', 'trail-manager' ),
		);
		$svg_icon = file_get_contents(plugin_dir_path( __FILE__ ) . 'img/trail-manager-icon.svg');
		$args = array(
			'label'                 => __( 'Trail Network', 'trail-manager' ),
			'description'           => __( 'Manage your trail networks', 'trail-manager' ),
			'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode($svg_icon),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'page-attributes' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,		
			'exclude_from_search'   => false,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);
		register_post_type( 'trail_network', $args );

	}

	/**
	 * Get meta
	 * @param  string $value slug of field to retreive
	 * @return string value of meta
	 */
	function trail_manager_get_meta( $value ) {
		global $post;

		$field = get_post_meta( $post->ID, $value, true );
		if ( ! empty( $field ) ) {
			return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
		} else {
			return false;
		}
	}

	/**
	 * Get meta and decode
	 * @param  string $value slug of field to retreive
	 * @return string value of meta
	 */
	function trail_manager_get_trails( $post_id ) {
		$field = get_post_meta( $post_id, 'trails', true );
		if ( ! empty( $field ) ) {
			return json_decode( html_entity_decode($field) );
		} else {
			return false;
		}
	}

	/**
	 * Add Trail Meta Box
	 */
	function trail_manager_add_meta_box() {
		add_meta_box(
			'trails-trails',
			__( 'Trails', 'trail-manager' ),
			array($this, 'trail_manager_meta_box_html'),
			'trail_network',
			'normal',
			'default'
		);

		add_meta_box(
			'trails-shortcode',
			__( 'Trail Network Shortcode', 'trail-manager' ),
			array($this, 'trail_manager_shortcode_meta_box_html'),
			'trail_network',
			'side',
			'default'
		);
	}

	/**
	 * HTML for the meta box
	 */
	function trail_manager_meta_box_html( $post ) {
		wp_nonce_field( '_trails_nonce', 'trails_nonce' ); ?>
		<?php
			$saved_trails = $this->trail_manager_get_meta( 'trails' )
		?>
		<div id="app">
			<input type="hidden" name="trails" id="trails" v-model="JSON.stringify(trailsData)">
			<trails
			:on-load-trails-data="<?php echo ( $saved_trails ? $saved_trails : '[]'); ?>"
			>
			</trails>
		</div><!-- /#app -->
		<?php
	}

	/**
	 * HTML for shortcode meta box
	 */
	function trail_manager_shortcode_meta_box_html( $post ) {
		wp_nonce_field( '_trails_shortcode_nonce', 'trails_shortcode_nonce' ); ?>
		<div id="app2">
			<shortcode-generator
			:post-id="<?php echo $post->ID; ?>"
			>
				
			</shortcode-generator>
		</div><!-- /#app -->
		<?php
	}

	/**
	 * Save meta
	 */
	function trail_manager_save_meta( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! isset( $_POST['trails_nonce'] ) || ! wp_verify_nonce( $_POST['trails_nonce'], '_trails_nonce' ) ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;

		if ( isset( $_POST['trails'] ) )
			update_post_meta( $post_id, 'trails', esc_attr( $_POST['trails'] ) );
	}

	function trail_manager_save_meta_from_bulk( $post_id, $meta ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
		
		update_post_meta( $post_id, 'trails', htmlentities(json_encode($meta, JSON_HEX_QUOT), ENT_QUOTES) );
	}

	/**
	 * Bulk trail status option
	 * @param  array $bulk_actions Current bulk options
	 * @return array               New bulk options
	 */
	function trail_manager_bulk_actions($bulk_actions) {
		$bulk_actions['open_all_trails'] = __( 'Open All Trails', 'trail-manager');
		$bulk_actions['caution_all_trails'] = __( 'Caution All Trails', 'trail-manager');
		$bulk_actions['close_all_trails'] = __( 'Close All Trails', 'trail-manager');
		return $bulk_actions;
	}

	/**
	 * Handler for trail_network CPT bulk options
	 */
	function trail_manager_bulk_action_handler( $redirect_to, $do_action, $post_ids ) {
		if ( $do_action !== 'open_all_trails' && $do_action !== 'caution_all_trails' && $do_action !== 'close_all_trails') {
			return $redirect_to;
		}
		foreach ( $post_ids as $post_id ) {
			$trails = $this->trail_manager_get_trails($post_id);
			if ($trails) {
				foreach ($trails as $key => $trail) {
					if ( $do_action === 'open_all_trails' ) {
						$trails[$key]->status = 'Open';
					} elseif ( $do_action === 'caution_all_trails' ) {
						$trails[$key]->status = 'Caution';
					} elseif ( $do_action === 'close_all_trails' ) {
						$trails[$key]->status = 'Closed';
					}
				}
				$this->trail_manager_save_meta_from_bulk($post_id, $trails);
			}
		}
		$redirect_to = add_query_arg( 'bulk_trail_networks_changed', count( $post_ids ), $redirect_to );
		return $redirect_to;
	}

	/**
	 * Display admin noty on successful update
	 */
	function trail_manager_bulk_action_admin_notice() {
		if ( ! empty( $_REQUEST['bulk_trail_networks_changed'] ) ) {
			$networks_changed_count = intval( $_REQUEST['bulk_trail_networks_changed'] );
			printf( '<div id="message" class="updated fade">' .
			_n( '%s network updated.',
				'%s networks updated.',
				$networks_changed_count,
				'trail_manager'
			) . '</div>', $networks_changed_count );
		}
	}

}
