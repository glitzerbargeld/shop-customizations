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
        echo '<span class="cbd-anteil" style="background: rgba(0,255,0,'. ceil($text) * 0.1 . '"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_cbd_gehalt.svg">'  . $text . '%</span>';
    }

   echo '</div>';
    
}
