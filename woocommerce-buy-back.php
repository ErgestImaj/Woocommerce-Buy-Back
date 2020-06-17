<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://creosweb.com
 * @since             1.0.0
 * @package           Woocommerce_Buy_Back
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce Buy Back
 * Plugin URI:        http://creosweb.com
 * Description:       WooCommerce Product Trade-In Plugin allows you to upload items that your visitors will be able to sell to you based on conditional pricing you can set just like any other regular WooCommerce product.
 * Version:           1.0.0
 * Author:            Creos Studio
 * Author URI:        http://creosweb.com
 * Text Domain:       woocommerce-buy-back
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'WOOCOMMERCE_BUY_BACK_VERSION', '1.0.0' );

/**
 * Plugin dir path.
 */
define( 'WOOCOMMERCE_BUY_BACK_DIR_PATH', plugin_dir_path( __FILE__ ));

/**
 * Language Text Domain
 */
define( 'WOOCOMMERCE_BUY_BACK', 'woocommerce-buy-back' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-buy-back-activator.php
 */
function activate_woocommerce_buy_back() {
	require_once WOOCOMMERCE_BUY_BACK_DIR_PATH . 'includes/class-woocommerce-buy-back-activator.php';
	Woocommerce_Buy_Back_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-buy-back-deactivator.php
 */
function deactivate_woocommerce_buy_back() {
	require_once  WOOCOMMERCE_BUY_BACK_DIR_PATH . 'includes/class-woocommerce-buy-back-deactivator.php';
	Woocommerce_Buy_Back_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_buy_back' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_buy_back' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require  WOOCOMMERCE_BUY_BACK_DIR_PATH . 'includes/class-woocommerce-buy-back.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_buy_back() {

	$plugin = new Woocommerce_Buy_Back();
	$plugin->run();

}
run_woocommerce_buy_back();
