<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function gc_places_cars_showcase_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'car');

  ob_start();
  ?>

  <div class="car-list">
    <div class=" wpv-loop js-wpv-loop">
  <?php
  foreach ($filtered_posts as $car) {
    $post_id = $car->ID;
    $default_path = plugin_dir_path( __DIR__ ) . 'templates/';
    $template_name = 'car-row.php';

    include( $default_path . $template_name );
  }
  ?>
    </div>
  </div>

  <?php
  $data = ob_get_contents();
  ob_end_clean();

  return $data;
}
add_shortcode( 'cars_showcase', 'gc_places_cars_showcase_shortcode' );

/*

  $output = '';

  $output = '<div class="hotel-list">';
  $output .= '  <div class="">';
  $output .= '    <div class="row">';
  foreach ($filtered_posts as $post) {
    $pickup_id = null;
    $dropoff_id = null;

    $pickup_id = rwmb_meta( '_car_pickup_ref', null, $post->ID );
    $pickup_place = get_post( $pickup_id );
    $dropoff_id = rwmb_meta( '_car_pickup_ref', null, $post->ID );
    $dropoff_place = get_post( $pickup_id );

    $header_img_src = ct_get_header_image_src( $post->ID, 'teaser' );
    if ( empty($header_img_src) ) {
      $header_img_src = ct_get_header_image_src( $post->ID, 'medium' );
    }

    $permalink = get_post_permalink( $post->ID );
    $person_price = get_post_meta( $post->ID, '_car_price', true );

    $output .= '';
    $output .= '<div class="strip_all_tour_list wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">';
    $output .= '<div class="col-sm-4">';
    $output .= '  <div class="tour_container">';
    $output .= '    <div class="img_container" style="">';
    $output .= '      <a href="'. $permalink .'" data-slimstat="5">';
    $output .= '        <img src="'. $header_img_src .'">';
    $output .= '      </a>';
    $output .= '    </div>';
    $output .= '    <div class="tour_title">';
    $output .= '      <h2 style="font-size:20px;text-align:center;">';
    $output .= '        <a href="'. $permalink .'" data-slimstat="5">';
    $output .= '          '. $post->post_title .'';
    $output .= '        </a>';
    $output .= '      </h2>';
    $output .= '      <hr>';
    // $output .= '      <h4 class="text-center">';
    // $output .= '        3 Días';
    // $output .= '      </h4>';
    $output .= '      <h4 class="text-left">';
    if ( !empty($pickup_place) ) {
      $output .= '         Desde: <a href="'. get_post_permalink( $pickup_place->ID ) .'">'. $pickup_place->post_title . '</a></br>';
    }
    if ( !empty($dropoff_place) ) {
      $output .= '         Hasta: <a href="'. get_post_permalink( $dropoff_place->ID ) .'">'. $dropoff_place->post_title . '</a></br>';
    }
    $output .= '      </h4>';
    $output .= '      <hr>';
    if ( !empty($person_price) ) {
      $output .= '      <h4 class="text-center">';
      $output .= '        $<strong>'. $person_price .'</strong>';
      $output .= '      </h4>';
      $output .= '      <hr>';
    }
    $output .= '      <div class="text-center">';
    $output .= '        <a href="'. $permalink .'" class="btn_1" data-slimstat="5">';
    $output .= '          Ver Detalles';
    $output .= '        </a>';
    $output .= '      </div>';
    $output .= '    </div>';
    $output .= '  </div>';
    $output .= '</div>';
    $output .= '</div>';
  }
  $output .= '   </div>';
  $output .= ' </div>';
  $output .= '</div>';
  return $output;
*/
