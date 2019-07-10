<?php

// Se definen las taxonomías para Tour
function gcplaces_create_taxonomies_tours() {
  $labels = array(
    'name' => _x( 'Services', 'taxonomy general name', 'gcplaces' ),
    'singular_name' => _x( 'Services', 'taxonomy singular name', 'gcplaces' ),
    'search_items' =>  __( 'Search Services', 'gcplaces' ),
    'all_items' => __( 'All Services', 'gcplaces' ),
    'parent_item' => __( 'Parent Service', 'gcplaces' ),
    'parent_item_colon' => __( 'Parent Service:', 'gcplaces' ),
    'edit_item' => __( 'Edit Service', 'gcplaces' ),
    'update_item' => __( 'Update Service', 'gcplaces' ),
    'add_new_item' => __( 'Add New Service', 'gcplaces' ),
    'new_item_name' => __( 'New Service Name', 'gcplaces' ),
    'menu_name' => __( 'Services', 'gcplaces' ),
  );

  $args = array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'services' ),
  );

  register_taxonomy( 'service', array('tour'), $args );
}
add_action( 'init', 'gcplaces_create_taxonomies_tours', 0 );

// Se añade la metabox para seleccionar un tour
function gcplaces_add_benefits_selector( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'tour_default_details' == $meta_box['id'] ) {
      array_push(
        $meta_box['fields'],
        array(
            'name'       => __( 'Included Services', 'gcplaces' ),
            'id'         => '_tour_services_included',
            'type'       => 'taxonomy_advanced',

            // Taxonomy slug.
            'taxonomy'   => 'service',

            // How to show taxonomy.
            'field_type' => 'checkbox_list',
        )
      );

      array_push(
        $meta_box['fields'],
        array(
            'name'       => __( 'Not Included Services', 'gcplaces' ),
            'id'         => '_tour_services_not_included',
            'type'       => 'taxonomy_advanced',

            // Taxonomy slug.
            'taxonomy'   => 'service',

            // How to show taxonomy.
            'field_type' => 'checkbox_list',
        )
      );
    }
  }
  return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'gcplaces_add_benefits_selector', 20 );
