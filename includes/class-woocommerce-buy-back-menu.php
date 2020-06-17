<?php

/**
 * Register plugin submenu item in woocommerce
 *
 *
 * @since      1.0.0
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/includes
 * @author      Creos Studio <contact@creosweb.com>
 */
class Woocommerce_Buy_Back_Menu
{

    /**
     * Woocommerce_Buy_Back_Menu constructor.
     *  @since    1.0.0
     */
    public function __construct() {
        add_action('admin_init', [$this, 'woocommerce_buy_back_register_settings']);
    }

    /**
     * Register submenu
     *  @since    1.0.0
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


    /**
     * Admin area view for the plugin
     *
     * @since    1.0.0
     */
    public function submenu_content() {
        require_once WOOCOMMERCE_BUY_BACK_DIR_PATH . 'admin/partials/woocommerce-buy-back-admin-display.php';

    }

    /**
     * Register plugin options
     *
     * @since    1.0.0
     */
    public function woocommerce_buy_back_register_settings() {

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

    public function callback_section() {
    }

    /**
     * @param $input
     * @return mixed
     * @since    1.0.0
     */
    public function callback_validate_options($input) {
        $input['woocommerce_buy_back_invoice_data'] = (isset($input['woocommerce_buy_back_invoice_data'])) ? $input['woocommerce_buy_back_invoice_data'] : '';
        return $input;
    }

    /**
     * @param $args
     * @since    1.0.0
     */
    public function woocommerce_buy_back_invoice_data($args) {

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
