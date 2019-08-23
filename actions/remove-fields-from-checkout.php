<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_filter( 'woocommerce_checkout_fields' , 'custom_checkout_fields' );
function custom_checkout_fields( $fields ) {
  unset($fields['billing']['billing_company']);
  unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_city']);
  return $fields;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_wc_checkout_fields' );
function custom_wc_checkout_fields( $fields ) {
    //$fields['billing']['billing_country']['class'][0] = 'col-sm-6';
    return $fields;
}
