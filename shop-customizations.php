<?php

/**
 * Plugin Name: Shop Customizations
 * Description: All Customizations for Sanaleo Web Shop
 * Author: Torben Jäckel
 */



/** Fügt die Produktinfos "CBD-Anteil" und "Anbaumethode" zu den Blüten auf der Shop Übersicht hinzu */

add_action( 'woocommerce_after_shop_loop_item_title', 'custom_field_display_below_title', 2 );
function custom_field_display_below_title(){
    global $product;
    // Display ACF text

    echo '<div class="acf-infos">';
    if( $anbau = get_field( 'anbaumethode', $product->get_id() ) ) {
        echo '<span class="anbaumethode"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_' . strtolower($anbau) . '.svg' . '" width="30">' . $anbau . '</span>';
    }

    if( $text = get_field( 'cbd_gehalt', $product->get_id() ) ) {
        echo '<span class="cbd-anteil" style="background: rgba(100,255,100,'. ceil($text) * 0.025 . '"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_cbd_gehalt.svg">'  . $text . '%</span>';
    }

   echo '</div>';
    
}

add_action('woocommerce_before_add_to_cart_button', 'ab_buttons');

function ab_buttons() {

	global $product; 
	
	$product_title = $product->get_name();
	
	if ($product_title == 'SANALEO Sprinkles') {
		echo '
			<div class="content">
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_outdoor.svg " width="30">' . 'Outdoor</span>
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_greenhouse.svg " width="30">' . 'Greenhouse</span>
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_indoor.svg " width="30">' . 'Indoor</span>
    		  </div>
  		';
  	}
}

