<?php

/**
 * Add custom field in product page
 *
 *
 * @since      1.0.0
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/includes
 * @author      Creos Studio <contact@creosweb.com>
 */
class Woocommerce_Buy_Back_Product_Trade_In
{

    /**
     * Display Fields
     */
    public function woocommerce_product_custom_fields()
    {
        global $woocommerce, $post;
        $product = wc_get_product($post->ID);
        $is_trade_in =  $product->get_meta('_trade_in');
        echo '<div class="product_custom_field">';
        woocommerce_wp_checkbox(
            array(
                'id' => '_trade_in',
                'label' => __('Trade-in Product', WOOCOMMERCE_BUY_BACK),
                'desc_tip'=>__('Trade In Product', WOOCOMMERCE_BUY_BACK),
                'description' => __( 'Checking this box will convert the product to a trade-in product!', WOOCOMMERCE_BUY_BACK ),
            )
        );
        echo '</div>';
    }

    /**
     * Save Fields
     * @param $post_id
     */
    public function woocommerce_product_custom_fields_save($post_id)
    {
        $woocommerce_checkbox = isset( $_POST['_trade_in'] ) ? 'yes' : 'no';
        update_post_meta( $post_id, '_trade_in', $woocommerce_checkbox );
    }

}
