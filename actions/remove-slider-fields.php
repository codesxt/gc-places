<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_filter( 'rwmb_meta_boxes', 'gcplaces_remove_slider_fields', 20 );
function gcplaces_remove_slider_fields( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    // En Car
    if ( isset( $meta_box['id'] ) && 'car_default_details' == $meta_box['id'] ) {
      foreach ( $meta_box['fields'] as $l => $nested_meta_box ) {
        if ( isset( $nested_meta_box['id'] ) && '_car_slider' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
      }
    }

    // En Hotel
    if ( isset( $meta_box['id'] ) && 'hotel_default_settings' == $meta_box['id'] ) {
      foreach ( $meta_box['fields'] as $l => $nested_meta_box ) {
        if ( isset( $nested_meta_box['id'] ) && '_hotel_slider' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
      }
    }

    // En Tour
    if ( isset( $meta_box['id'] ) && 'tour_default_details' == $meta_box['id'] ) {
      foreach ( $meta_box['fields'] as $l => $nested_meta_box ) {
        if ( isset( $nested_meta_box['id'] ) && '_tour_slider' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
      }
    }


  }
  return $meta_boxes;
}
