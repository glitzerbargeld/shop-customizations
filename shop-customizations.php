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


/*CUSTOMIZATIONS FOR SPRINKLES PRODUCT PAGE*/


add_action('woocommerce_before_add_to_cart_button', 'sprinkles_customizations');

function sprinkles_customizations() {

	global $product;
	
	$product_title = $product->get_name();
	
	if ($product_title == 'SANALEO Sprinkles') {

        wp_enqueue_style( 'sprinkles', plugins_url( '/css/sprinkles.css', __FILE__ ));
        wp_register_script( 'ab_buttons', plugins_url( '/js/ab_buttons.js', __FILE__ ), array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'ab_buttons');

		echo '
			<div id ="abm-btn-wrapper" class="content">
          	  	<div class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_outdoor.svg " width="30">' . 'Outdoor</div>
          	  	<div class="anbaumethode" data-el="greenhouse"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_greenhouse.svg " width="30">' . 'Greenhouse</div>
          	  	<div class="anbaumethode" data-el="indoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_indoor.svg " width="30">' . 'Indoor</div>
    		  </div>
  		';
  	}
}

add_action('astra_header_after', 'fourTwenty_customizations');

function fourTwenty_customizations() {
    wp_enqueue_style( 'fourtwenty-styles', plugins_url( '/css/fourtwenty.css', __FILE__ ));
    wp_register_script( 'fourtwenty-script', plugins_url( '/js/fourtwenty.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'fourtwenty-script');

    echo '
    <p style="color:wheat;font-size:55px;text-align:center;">How to copy a TEXT to Clipboard on a Button-Click</p>
    <p id="p1">Test</p>
    <button onclick="copyToClipboard(\'#p1\')">Copy TEXT 1</button>';
}

