<?php

/**
 * Plugin Name: Shop Customizations
 * Description: All Customizations for Sanaleo Web Shop
 * Author: Torben Jäckel
 */



include 'inc/seo.php';

wp_enqueue_style( 'custom-shop-styles', plugins_url( '/css/styles.css', __FILE__ ));

/** Fügt die Produktinfos "CBD-Anteil" und "Anbaumethode" zu den Blüten auf der Shop Übersicht hinzu */
#######################################################################################################

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
#############################################


add_action('woocommerce_before_add_to_cart_button', 'sprinkles_customizations');

function sprinkles_customizations() {

	global $product;
	
	$product_title = $product->get_name();
	
	if ($product_title == 'Sprinkles') {

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


/**ADD CONTAINERS TO BUD PRODUCT PAGES */

function container_size_buds_new(){

    $baggie_farbe = get_field('deckelfarbe');
    $baggie_farbe_innen = get_field ('baggie_farbe_innen');
    wp_register_script( 'buds_container', plugins_url( '/js/buds_container.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'buds_container');

    echo '
      <div class="content">
        <div class="glass-wrapper">
            <div class="baggie-wrapper">
                <div class="baggie bud-container" style="background:' . $baggie_farbe . ';" data-el="1g">
                    <p style="background: ' . $baggie_farbe_innen . ';">1g</p>
                </div>
            </div>
            <span class="glass"><div class="buds bud-container" data-el="2g">2g</div></span>
            <span class="glass"><div class="buds bud-container" data-el="5g">5g</div></span>
            <span class="glass"><div class="buds bud-container" data-el="10g"">10g</div></span>
            <span class="glass"><div class="buds bud-container" data-el="20g"">20g</div></span>
           
        </div>
      </div>
    ';
}


/**Promo Banner 
#############################

add_action('astra_header_after', 'fourTwenty_customizations');

function fourTwenty_customizations() {

    if(!is_product()) {
    wp_enqueue_style( 'fourtwenty-styles', plugins_url( '/css/fourtwenty.css', __FILE__ ));
    wp_register_script( 'fourtwenty-script', plugins_url( '/js/fourtwenty.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'fourtwenty-script');

    

    echo '
    
    <div id="fourtwenty"><p>Global Marijuana March Angebot: Erhalte heute <span>20%</span> auf alle Produkte mit dem Gutscheincode:</p><p id="p1">GMM2022</p>
    <button onclick="copyToClipboard(\'#p1\')"><img src="' . plugins_url( '/icons/icons8-kopieren-48.png', __FILE__ ) . '"></button>
    </div>';
}
}
*/

/**CHECKOUT*/

/**ADD CHECHBOX FOR EMAIL OPT-IN */


add_action('woocommerce_review_order_before_submit', 'moosendOptIn');


function moosendOptIn() {
    echo ' 
    <div>
      <p>
      <label for="scales">
      <input type="checkbox" id="moosend-optin" name="Email Optin"
      checked><span>Ich möchte spannende News und aktuelle Angebote von SANALEO per Email erhalten.</span>
      </label></p>
    </div>
    
    ';
}