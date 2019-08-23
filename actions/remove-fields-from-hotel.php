<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_filter( 'rwmb_meta_boxes', 'gcplaces_remove_fields_from_hotel', 20 );
function gcplaces_remove_fields_from_hotel( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'hotel_default_settings' == $meta_box['id'] ) {
      foreach ( $meta_box['fields'] as $l => $nested_meta_box ) {
        if ( isset( $nested_meta_box['id'] ) && '_hotel_related' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
        if ( isset( $nested_meta_box['id'] ) && '_hotel_address' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
      }
    }
  }
  return $meta_boxes;
}
