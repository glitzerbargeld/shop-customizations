<?php

/**
 * Plugin Name: Shop Customizations
 * Description: All Customizations for Sanaleo Web Shop
 * Author: Torben Jäckel
 */

add_action( 'woocommerce_after_shop_loop_item_title', 'custom_field_display_below_title', 2 );
function custom_field_display_below_title(){
    global $product;

    if(is_category( "cbd-blueten" )){
    // Display ACF text
    if( $text = get_field( 'anbaumethode', $product->get_id() ) ) {
        echo '<p class="anbaumethode">' . $text . '</p>';
    }
    }
}
