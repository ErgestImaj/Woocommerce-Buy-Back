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
class Woocommerce_Buy_Back_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action('admin_init', [$this, 'woocommerce_buy_back_register_settings']);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/woocommerce-buy-back-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/woocommerce-buy-back-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Register plugin submenu item in woocommerce
     *
     * @since    1.0.0
     */

    public function register_submenu()
    {
        add_submenu_page(
            'woocommerce',
            __('Buy Back', WOOCOMMERCE_BUY_BACK),
            __('Buy Back', WOOCOMMERCE_BUY_BACK),
            'manage_options',
            'woocommerce-buy-back',
            [$this, 'submenu_content']
        );

    }


    /**
     * Admin area view for the plugin
     *
     * @since    1.0.0
     */
    public function submenu_content()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/woocommerce-buy-back-admin-display.php';

    }

    /**
     * Register plugin options
     *
     * @since    1.0.0
     */
    public function woocommerce_buy_back_register_settings()
    {

        register_setting(
            'woocommerce_buy_back_options',
            'woocommerce_buy_back_options',
            [$this, 'callback_validate_options']
        );

        add_settings_section(
            'woocommerce_buy_back_section',
            __('Buy Back Settings', WOOCOMMERCE_BUY_BACK),
            [$this, 'callback_section'],
            'woocommerce_buy_back_invoice_data'
        );

        add_settings_field(
            'woocommerce_buy_back_invoice_data',
            __('Insert invoice data', WOOCOMMERCE_BUY_BACK),
            [$this, 'woocommerce_buy_back_invoice_data'],
            'woocommerce_buy_back_invoice_data',
            'woocommerce_buy_back_section',
            ['id' => 'woocommerce_buy_back_invoice_data']

        );
    }

    public function callback_section(){}

    public function callback_validate_options($input)
    {
        $input['woocommerce_buy_back_invoice_data'] = (isset($input['woocommerce_buy_back_invoice_data'])) ? sanitize_textarea_field($input['woocommerce_buy_back_invoice_data']) : '';
        return $input;
    }

    public function woocommerce_buy_back_invoice_data($args)
    {

        $options = get_option('woocommerce_buy_back_options');

        $id = isset($args['id']) ? $args['id'] : '';

        $value = isset($options[$id]) ? $options[$id] : '';
      
        wp_editor($value, "woocommerce_buy_back_options[woocommerce_buy_back_invoice_data]", [
            'media_buttons' => false, // hide insert/upload button(s)
            'textarea_name' => 'woocommerce_buy_back_options[woocommerce_buy_back_invoice_data]',
            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
        ]);

    }

}
