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
				<div class="ab-wrapper">
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_outdoor.svg " width="30">' . 'Outdoor</div>
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_greenhouse.svg " width="30">' . 'Greenhouse</div>
          	  	<span class="anbaumethode" data-el="outdoor"><img src="' . plugin_dir_url(__FILE__) . 'icons/icon_indoor.svg " width="30">' . 'Indoor</div>
      		  </div>
    		  </div>
  		';
  	}
}


/**Ändert den Standardtext des Add-to-Cart-Buttons von variablen Produkten zu "Zum Produkt" 

add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
	global $product;
	if ( $product->has_child() ) {
		$text = $product->is_purchasable() ? __( 'Zum Produkt', 'woocommerce' ) : __( 'Read more', 'woocommerce' );
	}
	return $text;
}, 10 );

*/

add_filter( 'gettext', 'meine_woocommerce_uebersetzung' );

function meine_woocommerce_uebersetzung( $translation, $text, $domain ) {
  if ('Vielleicht bist du interessiert an ...' === $translation ) {
  $translation = 'Passt perfekt zu deinem Einkauf';
  }
return $translation;
}