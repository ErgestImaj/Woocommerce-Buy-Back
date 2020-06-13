<?php

/**
 * Admin area view for the plugin
 *
 *
 * @link       http://creosweb.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Buy_Back
 * @subpackage Woocommerce_Buy_Back/admin/partials
 */
?>

<div class="wrap">
    <div class="nd_learning_bg_black">
        <form id="valutazione_bimbo" action="options.php" method="post">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
            <div class="left-section">
                <?php
                settings_fields( 'woocommerce_buy_back_options' );

                do_settings_sections( 'woocommerce_buy_back_invoice_data' );
                ?>
            </div>

            <?php submit_button();?>
        </form>
    </div>
</div>