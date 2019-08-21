<?php

add_shortcode( 'gcplaces_wc_conditions', 'gc_places_woocommerce_conditions_shortcode' );
function gc_places_woocommerce_conditions_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID()
  ), $atts );

  global $woocommerce;

    if( !empty($woocommerce) && false ) {
      $items = $woocommerce->cart->get_cart();

      foreach($items as $item => $values) {
        $_product =  wc_get_product( $values['data']->get_id());
        echo "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>';
        $price = get_post_meta($values['product_id'] , '_price', true);
        echo "  Price: ".$price."<br>";
        echo "<pre>";
        print_r($values);
        echo "</pre>";

        echo "<pre>";
        print_r($_product);
        echo "</pre>";

        echo "<pre>";
        echo $_product->get_title();
        $post = get_page_by_title( $_product->get_title(), OBJECT, array( 'hotel', 'car', 'tour' ) );
        print_r($post);
        echo "</pre>";

        //$post = get_page_by_title( $_product->get_title(), OBJECT );
      }

      foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				print_r($_product);
				$permalink_producto = $_product->get_permalink( $cart_item );
				$original_post_id = url_to_postid( $permalink_producto );
				print_r(  get_post($original_post_id) );
				$value = rwmb_meta( '_hotel_conditions', array(), $original_post_id );
        echo do_shortcode( wpautop( $value ) );

			}
    }



  $output = '';
  return $output;
}
