<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

// Register settings page. In this case, it's a theme options page
add_filter( 'mb_settings_pages', 'gcplaces_conditions_admin_page' );
function gcplaces_conditions_admin_page( $settings_pages ) {
  $settings_pages[] = array(
    'id'          => 'gc_conditions_settings',
    'option_name' => 'gc_conditions_options',
    'menu_title'  => 'Service Conditions',
    'icon_url'    => 'dashicons-media-code',
    'style'       => 'no-boxes',
    'columns'     => 1,
    'tabs'        => array(
      'pages' => 'Páginas de Condiciones'
    ),
    'position'    => 68,
  );
  return $settings_pages;
}

// Register meta boxes and fields for settings page
add_filter( 'rwmb_meta_boxes', 'gc_conditions_options_meta_boxes' );
function gc_conditions_options_meta_boxes( $meta_boxes ) {
  $meta_boxes[] = array(
    'id'             => 'pages',
    'title'          => 'Páginas',
    'settings_pages' => 'gc_conditions_settings',
    'tab'            => 'pages',

    'fields' => array(
      array(
          'name'        => 'Hotel',
          'id'          => '_conditions_hotel_page',
          'type'        => 'post',
          'post_type'   => 'page',
          'field_type'  => 'select_advanced',
          'placeholder' => 'Seleccione una página',
          'query_args'  => array(
              'post_status'    => 'publish',
              'posts_per_page' => - 1,
          ),
      ),
      array(
          'name'        => 'Tour',
          'id'          => '_conditions_tour_page',
          'type'        => 'post',
          'post_type'   => 'page',
          'field_type'  => 'select_advanced',
          'placeholder' => 'Seleccione una página',
          'query_args'  => array(
              'post_status'    => 'publish',
              'posts_per_page' => - 1,
          ),
      ),
      array(
          'name'        => 'Car',
          'id'          => '_conditions_car_page',
          'type'        => 'post',
          'post_type'   => 'page',
          'field_type'  => 'select_advanced',
          'placeholder' => 'Seleccione una página',
          'query_args'  => array(
              'post_status'    => 'publish',
              'posts_per_page' => - 1,
          ),
      ),
    ),
  );
  return $meta_boxes;
}
