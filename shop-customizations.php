<?php

/**
 * Plugin Name: Shop Customizations
 * Description: All Customizations for Sanaleo Web Shop
 * Author: Torben Jäckel
 */



 /** ADDS Custom Fields to Products on Shop Page */

add_action( 'woocommerce_after_shop_loop_item_title', 'custom_field_display_below_title', 2 );
function custom_field_display_below_title(){
    global $product;
    // Display ACF text

    echo '<div class="acf-infos">';
    if( $anbau = get_field( 'anbaumethode', $product->get_id() ) ) {
        echo '<span class="anbaumethode"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_' . strtolower($anbau) . '.svg' . '" width="30">' . $anbau . '</span>';
    }

    if( $text = get_field( 'cbd_gehalt', $product->get_id() ) ) {
        echo '<span class="cbd-anteil" style="background: rgba(0,255,0,'. ceil($text) * 0.025 . '"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_cbd_gehalt.svg">'  . $text . '%</span>';
    }

   echo '</div>';
    
}


/** Product Variations on Shop Page*/

/**
 * Replace add to cart button in the loop.
 */
function iconic_change_loop_add_to_cart() {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    add_action( 'woocommerce_after_shop_loop_item', 'iconic_template_loop_add_to_cart', 10 );
}

add_action( 'init', 'iconic_change_loop_add_to_cart', 10 );

/**
 * Use single add to cart button for variable products.
 */
function iconic_template_loop_add_to_cart() {
    global $product;

    if ( ! $product->is_type( 'variable' ) ) {
        woocommerce_template_loop_add_to_cart();
    return;
    }

remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
    add_action( 'woocommerce_single_variation', 'iconic_loop_variation_add_to_cart_button', 20 );

    woocommerce_template_single_add_to_cart();
}

/**
 * Customise variable add to cart button for loop.
 *
 * Remove qty selector and simplify.
 */
  function iconic_loop_variation_add_to_cart_button()
{
    global $product;

    ?>
    <div class="woocommerce-variation-add-to-cart variations_button">
        <button   type="submit" class="custom_add_to_cart single_add_to_cart_button button"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
        <input type="hidden" name="variation_id" class="variation_id" value="0" />
    </div>
    <?php
}
function iconic_add_to_cart_form_action( $redirect ) {
    if ( ! is_archive() ) {
        return $redirect;
    }

    return '';
}
add_filter( 'woocommerce_add_to_cart_form_action', 'iconic_add_to_cart_form_action' );
add_action('wp_footer', 'myScript');

function myScript()
{
    ?>
<script>

    jQuery(document).ready(function ($) {
"use strict";

$('.custom_add_to_cart').click(function (e) {
    e.preventDefault();
    var id = $(this).next().next().next().attr('value');
    var data = {
    product_id: id,
    quantity: 1
    };
    $(this).parent().addClass('loading');
    $.post(wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), data, function (response) {

    if (!response) {
        return;
    }
    if (response.error) {
        alert("Custom Massage ");
        $('.custom_add_to_cart').parent().removeClass('loading');
        return;
    }
    if (response) {

        var url = woocommerce_params.wc_ajax_url;
        url = url.replace("%%endpoint%%", "get_refreshed_fragments");
        $.post(url, function (data, status) {
        $(".woocommerce.widget_shopping_cart").html(data.fragments["div.widget_shopping_cart_content"]);
        if (data.fragments) {
            jQuery.each(data.fragments, function (key, value) {

            jQuery(key).replaceWith(value);
            });
        }
        jQuery("body").trigger("wc_fragments_refreshed");
        });
        $('.custom_add_to_cart').parent().removeClass('loading');

    }

    });

});
});
        </script>
    <?php
}