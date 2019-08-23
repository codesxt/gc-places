<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_filter( 'rwmb_meta_boxes', 'gcplaces_add_place_to_hotel', 20 );
function gcplaces_add_place_to_hotel( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'hotel_default_settings' == $meta_box['id'] ) {
      array_push(
        $meta_box['fields'],
        array(
          'name'  => 'Lugar del Hotel',
          'id'      => "_hotel_place_ref",
          'desc'  => 'Seleccione la entidad Place correspondiente a este Hotel',
          'placeholder'  => 'Escriba el nombre de un lugar',
          'type'  => 'post',
          'post_type' => array( 'place' ),
          'field_type' => 'select_advanced',
          'multiple' => false,
        )
      );
    }
  }
  return $meta_boxes;
}
