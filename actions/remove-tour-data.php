<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_filter( 'rwmb_meta_boxes', 'gcplaces_remove_tour_fields', 20 );
function gcplaces_remove_tour_fields( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'tour_default_details' == $meta_box['id'] ) {
      foreach ( $meta_box['fields'] as $l => $nested_meta_box ) {
        if ( isset( $nested_meta_box['id'] ) && '_tour_related' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
        if ( isset( $nested_meta_box['id'] ) && '_tour_schedule_info' == $nested_meta_box['id'] ) {
          unset( $meta_box['fields'][$l] );
        }
      }
    }
  }
  return $meta_boxes;
}
