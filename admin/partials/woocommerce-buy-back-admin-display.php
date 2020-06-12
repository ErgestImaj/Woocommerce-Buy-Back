<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://creosweb.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/admin/partials
 */
?>

<div class="wrap">
    <h2><?php _e('Buy Back Settings', WOOCOMMERCE_BUY_BACK) ?></h2>
    <div class="nd_learning_bg_black">
<!--        <div class="notice notice-error">-->
<!--            <p><strong>--><?php //echo __('Backup your database before running the clean up. It will remove all html tags from all products description and short description!',ORDERS_TO_RTF)?><!--</strong></p>-->
<!--            <button type="button" class="notice-dismiss"><span class="screen-reader-text">Nascondi questa notifica.</span></button>-->
<!--        </div>-->
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
            <!-- Add a hidden form field with the name "action" and a unique value that you can use to handle the form submission  -->
            <input type="hidden" name="action" value="clean_product_html">
            <input type="submit" class="button button-primary" value="Clean Html from product description">
        </form>
    </div>
</div>