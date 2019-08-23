<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

/*
  Los custom place no tienen la opción para añadir un encabezado, como
  los demás posts de City Tours. Este archivo añade el tipo place a los tipos
  considerados para la metabox.
*/
add_filter( 'rwmb_meta_boxes', 'gcplaces_add_header_to_places', 20 );
function gcplaces_add_header_to_places( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'header_image_setting' == $meta_box['id'] ) {
      // Al array de la propiedad 'pages' de esta metabox
      // se debe añadir 'place'
      array_push($meta_box['pages'], 'place');
    }
  }
  return $meta_boxes;
}
