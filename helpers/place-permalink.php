<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function gc_places_get_place_permalink($place) {
  $args = array(
    'post_type' => 'hotel',
    'meta_query' => array(
      array(
        'key' => '_hotel_place_ref',
        'value' => $place->ID,
        'compare' => '=',
      )
    )
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $query->the_post();
    $permalink = get_post_permalink();
    wp_reset_postdata();
  } else {
    $permalink = get_post_permalink($place->ID);
  }
  return $permalink;
}

function gc_places_is_place_hotel($place) {
  // Retorna el ID del hotel si existe
  // Si no existe, retorna -1
  $args = array(
    'post_type' => 'hotel',
    'meta_query' => array(
      array(
        'key' => '_hotel_place_ref',
        'value' => $place->ID,
        'compare' => '=',
      )
    )
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) {
    $query->the_post();
    return get_the_ID();
    wp_reset_postdata();
  } else {
    return -1;
  }
}
