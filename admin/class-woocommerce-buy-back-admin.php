<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://creosweb.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/admin
 * @author      Creos Studio <contact@creosweb.com>
 */
class Woocommerce_Buy_Back_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-buy-back-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-buy-back-admin.js', array( 'jquery' ), $this->version, false );

	}
    /**
     * Register plugin submenu item in woocommerce
     *
     * @since    1.0.0
     */

    public function register_submenu() {
        add_submenu_page(
            'woocommerce',
            __('Buy Back', WOOCOMMERCE_BUY_BACK),
            __('Buy Back', WOOCOMMERCE_BUY_BACK),
            'manage_options',
            'woocommerce-buy-back',
            [$this, 'submenu_content']
        );

    }
    public function submenu_content() {
        require_once plugin_dir_path( __FILE__ ) . 'partials/woocommerce-buy-back-admin-display.php';

    }

}
