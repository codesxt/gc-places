<?php

// Se añaden los campos de condiciones específicas a los posts
add_filter( 'rwmb_meta_boxes', 'gcplaces_add_conditions_to_hotel', 20 );
function gcplaces_add_conditions_to_hotel( $meta_boxes ) {
  foreach ( $meta_boxes as $k => &$meta_box ) {
    if ( isset( $meta_box['id'] ) && 'hotel_default_settings' == $meta_box['id'] ) {
      array_push(
        $meta_box['fields'],
        array(
          'name'  => 'Condiciones del Servicio',
          'id'      => "_hotel_conditions",
          'placeholder'  => 'Escriba las condiciones del servicio',
          'type'  => 'wysiwyg',
          'options' => array(
            'textarea_rows' => 4,
            'teeny'         => true,
          ),
        )
      );
    }

    if ( isset( $meta_box['id'] ) && 'tour_default_details' == $meta_box['id'] ) {
      array_push(
        $meta_box['fields'],
        array(
          'name'  => 'Condiciones del Servicio',
          'id'      => "_tour_conditions",
          'placeholder'  => 'Escriba las condiciones del servicio',
          'type'  => 'wysiwyg',
          'options' => array(
            'textarea_rows' => 4,
            'teeny'         => true,
          ),
        )
      );
    }

    if ( isset( $meta_box['id'] ) && 'car_default_details' == $meta_box['id'] ) {
      array_push(
        $meta_box['fields'],
        array(
          'name'  => 'Condiciones del Servicio',
          'id'      => "_car_conditions",
          'placeholder'  => 'Escriba las condiciones del servicio',
          'type'  => 'wysiwyg',
          'options' => array(
            'textarea_rows' => 4,
            'teeny'         => true,
          ),
        )
      );
    }
  }
  return $meta_boxes;
}

add_action( 'hotel_cart_main_after', 'add_hotel_conditions');
add_action( 'tour_cart_main_after', 'add_tour_conditions');
add_action( 'car_cart_main_after', 'add_car_conditions');

function add_hotel_conditions() {
  $hotel_id = $_REQUEST['hotel_id'];

  /*
  echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
  // Obtener página de condiciones por tipo de servicio
  $service_conditions_page = rwmb_meta( '_conditions_hotel_page', array( 'object_type' => 'setting' ), 'gc_conditions_options' );
  if ( !empty($service_conditions_page) ) {
    // Ese ID debe pasar por pll_get_post( id ) para obtener el ID de la página en el idioma correcto
    $service_conditions_page = pll_get_post( $service_conditions_page );
    $general_conditions = get_post( $service_conditions_page )->post_content;
    echo do_shortcode( wpautop( $general_conditions ) );
  } else {
    echo '<div class="alert alert-warning" role="alert"><strong>No se ha seleccionado una página con las condiciones para el tipo Hotel</strong><br>';
    echo 'Seleccione una página desde el menú de administración.</div>';
  }*/

  // Hay condiciones específicas para este servicio
  $specific_conditions = rwmb_meta( '_hotel_conditions', null, $hotel_id );
  if ( !empty($specific_conditions) ) {
    //echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
    echo "<h4 id='conditions'>" . __( 'Services requirements', 'gcplaces') . "</h4>";
    echo do_shortcode( wpautop( $specific_conditions ) );
  }
}

function add_car_conditions() {
  $car_id = $_REQUEST['car_id'];

  /*
  echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
  // Obtener página de condiciones por tipo de servicio
  $service_conditions_page = rwmb_meta( '_conditions_car_page', array( 'object_type' => 'setting' ), 'gc_conditions_options' );
  if ( !empty($service_conditions_page) ) {
    // Ese ID debe pasar por pll_get_post( id ) para obtener el ID de la página en el idioma correcto
    $service_conditions_page = pll_get_post( $service_conditions_page );
    $general_conditions = get_post( $service_conditions_page )->post_content;
    echo do_shortcode( wpautop( $general_conditions ) );
  } else {
    echo '<div class="alert alert-warning" role="alert"><strong>No se ha seleccionado una página con las condiciones para el tipo Car</strong><br>';
    echo 'Seleccione una página desde el menú de administración.</div>';
  }*/

  // Hay condiciones específicas para este servicio
  $specific_conditions = rwmb_meta( '_car_conditions', null, $car_id );
  if ( !empty($specific_conditions) ) {
    //echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
    echo "<h4 id='conditions'>" . __( 'Services requirements', 'gcplaces') . "</h4>";
    echo do_shortcode( wpautop( $specific_conditions ) );
  }
}

function add_tour_conditions() {
  $tour_id = $_REQUEST['tour_id'];

  /*
  echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
  // Obtener página de condiciones por tipo de servicio
  $service_conditions_page = rwmb_meta( '_conditions_tour_page', array( 'object_type' => 'setting' ), 'gc_conditions_options' );
  if ( !empty($service_conditions_page) ) {
    // Ese ID debe pasar por pll_get_post( id ) para obtener el ID de la página en el idioma correcto
    $service_conditions_page = pll_get_post( $service_conditions_page );
    $general_conditions = get_post( $service_conditions_page )->post_content;
    echo do_shortcode( wpautop( $general_conditions ) );
  } else {
    echo '<div class="alert alert-warning" role="alert"><strong>No se ha seleccionado una página con las condiciones para el tipo Tour</strong><br>';
    echo 'Seleccione una página desde el menú de administración.</div>';
  }*/

  // Hay condiciones específicas para este servicio
  $specific_conditions = rwmb_meta( '_tour_conditions', null, $tour_id );
  if ( !empty($specific_conditions) ) {
    //echo "<h4>" . __( 'Service Conditions', 'gcplaces') . "</h4>";
    echo "<h4 id='conditions'>" . __( 'Services requirements', 'gcplaces') . "</h4>";
    echo do_shortcode( wpautop( $specific_conditions ) );
  }
}
