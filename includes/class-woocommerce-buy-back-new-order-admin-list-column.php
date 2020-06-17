<?php

/**
 * Add Column Trade in to Orders Table
 *
 *
 * @since      1.0.0
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/includes
 * @author      Creos Studio <contact@creosweb.com>
 */
class Woocommerce_Buy_Back_New_Order_Admin_List_Column
{

    /**
     * @param $columns
     * @return mixed
     * @since      1.0.0
     */
    public function add_new_order_admin_list_column($columns) {
        $columns['trade_in'] = __('Trade In',WOOCOMMERCE_BUY_BACK);
        return $columns;
    }


    /**
     * @param $column
     * @since      1.0.0
     */
    public function add_new_order_admin_list_column_content($column) {

        global $post;

        if ('trade_in' === $column) {

            $order = wc_get_order($post->ID);
            $is_trade_in = $order->get_meta('_trade_in') == 1 ? 'checked' : '';
            $checkbox =  "<input class='styled-checkbox' id='styled-checkbox-{$post->ID}' {$is_trade_in} type='checkbox'>";
            $checkbox .= "<label for='styled-checkbox-{$post->ID}'>".__('Trade In',WOOCOMMERCE_BUY_BACK)."</label>";
            echo  $checkbox;
        }
    }

}
