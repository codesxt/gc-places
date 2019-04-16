<?php

function create_posttype() {
    register_post_type(
      'place',
      array(
        'labels' => array(
          'name' => __( 'Places' ),
          'singular_name' => __( 'Place' )
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array(
          'slug' => 'place'
        ),
        'hierarchical' => true,
        'supports' => array(
          'title',
          'editor',
          'page-attributes',
          'custom-fields'
        ),
        'menu_icon' => 'dashicons-location-alt'
      )
    );
}
add_action( 'init', 'create_posttype' );
