<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://creosweb.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/includes
 * @author      Creos Studio <contact@creosweb.com>
 */
class Woocommerce_Buy_Back {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woocommerce_Buy_Back_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
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
		if ( defined( 'WOOCOMMERCE_BUY_BACK_VERSION' ) ) {
			$this->version = WOOCOMMERCE_BUY_BACK_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woocommerce-buy-back';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocommerce_Buy_Back_Loader. Orchestrates the hooks of the plugin.
	 * - Woocommerce_Buy_Back_i18n. Defines internationalization functionality.
	 * - Woocommerce_Buy_Back_Admin. Defines all hooks for the admin area.
	 * - Woocommerce_Buy_Back_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
        foreach ( glob ( plugin_dir_path( dirname( __FILE__ ) ) . "includes/*.php" ) as $file ){
            require_once $file;
        }

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
        foreach ( glob ( plugin_dir_path( dirname( __FILE__ ) ) . "admin/*.php" ) as $file ){
            require_once $file;
        }

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
        foreach ( glob ( plugin_dir_path( dirname( __FILE__ )  ) . "public/*.php" ) as $file ){
            require_once $file;
        }

        
		$this->loader = new Woocommerce_Buy_Back_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocommerce_Buy_Back_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocommerce_Buy_Back_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woocommerce_Buy_Back_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu',new Woocommerce_Buy_Back_Menu(),'register_submenu' );

		$this->loader->add_action( 'manage_shop_order_posts_custom_column',new Woocommerce_Buy_Back_New_Order_Admin_List_Column(),'add_new_order_admin_list_column_content' );
		$this->loader->add_action( 'manage_edit-shop_order_columns',new Woocommerce_Buy_Back_New_Order_Admin_List_Column(),'add_new_order_admin_list_column' );

		$this->loader->add_action( 'woocommerce_product_options_general_product_data',new Woocommerce_Buy_Back_Product_Trade_In(),'woocommerce_product_custom_fields' );
		$this->loader->add_action( 'woocommerce_process_product_meta',new Woocommerce_Buy_Back_Product_Trade_In(),'woocommerce_product_custom_fields_save' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woocommerce_Buy_Back_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

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
	 * @return    Woocommerce_Buy_Back_Loader    Orchestrates the hooks of the plugin.
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
