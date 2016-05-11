<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Impressum_Manager {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;
	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->plugin_name = 'Impressum Manager';
		$this->version     = '1.1.3';
		$this->load_dependencies();
		$this->define_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		if ( is_admin() ) {
			/**
			 * The class responsible for defining all actions that occur in the admin area.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class.impressum-manager-admin.php';
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/class.impressum-manager-form-factory.php';
		}
		if ( ! is_admin() ) {
			/**
			 * The class responsible for defining all actions that occur in the public-facing
			 * side of the site.
			 */
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class.impressum-manager-public.php';
		}

		/**
		 * Connection to the database.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class.impressum-manager-database.php';

		/**
		 * The class responsible for shortcodes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class.impressum-manager-shortcode-manager.php';

		/**
		 * The class responsible for the impressum.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/impressum/class.impressum-manager-impressum-manager.php';
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class.impressum-manager-loader.php';
		$this->loader = new Impressum_Manager_Loader();
	}

	/**
	 * Register all of the hooks of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_hooks() {
		if ( is_admin() ) {
			$plugin_admin = new Impressum_Manager_Admin( $this->get_plugin_name(), $this->get_version() );
			$this->loader->add_filter( 'attachment_fields_to_edit', $plugin_admin, 'field_credit', 10, 2 );
			$this->loader->add_filter( 'attachment_fields_to_save', $plugin_admin, 'field_credit_save', 10, 2 );

			$this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
			$this->loader->add_action( 'admin_init', $plugin_admin, 'enqueue_style' );
			$this->loader->add_action( 'admin_init', $plugin_admin, 'enqueue_script' );

			$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu' );
			$this->loader->add_action( 'admin_notices', $plugin_admin, 'installation_notice' );
			$this->loader->add_action( 'wp_ajax_impressum_manager_get_impressum_field', $plugin_admin, 'editor_ajax_callback' );
            $this->loader->add_action( 'wp_ajax_impressum_manager_save_impressum_field', $plugin_admin, 'save_editor_ajax_callback' );
			$this->loader->add_action( 'wp_ajax_impressum_manager_get_shortcode_preview', $plugin_admin, 'shortcode_preview_ajax_callback' );
			$this->loader->add_action( 'wp_ajax_delete_it', $plugin_admin, 'deletestuff' );
		}
		if ( ! is_admin() ) {
			$plugin_public = new Impressum_Manager_Public( $this->get_plugin_name(), $this->get_version() );
			$this->loader->add_action( 'init', $plugin_public, 'init' );
		}

		$short_code_manager = 'Impressum_Manager_Shortcode_Manager';
		$this->loader->add_action( 'init', $short_code_manager, 'init' );
		$this->loader->add_action( 'the_posts', $short_code_manager, 'metashortcode' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}
