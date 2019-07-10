<?php

add_action( 'init', 'gcplaces_add_new_image_size' );
function gcplaces_add_new_image_size() {
  add_image_size( 'teaser', 600, 338, true );
}

// Hace que el tamaño 'teaser' sea seleccionable desde la Media Library
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {
  return array_merge(
    $sizes,
    array(
      'teaser' => pll__( 'Teaser Header Image' ),
    )
  );
}
