<?php

function gc_places_all_children_places_teaser_list_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'place');

  $output = '<div class="hotel-list">';
  $output = '  <div class=" wpv-loop js-wpv-loop">';
  foreach ($filtered_posts as $place) {
    $header_img_src = ct_get_header_image_src( $place->ID, 'teaser' );
    if ( empty($header_img_src) ) {
      $header_img_src = ct_get_header_image_src( $place->ID, 'medium' );
    }

    $permalink = gc_places_get_place_permalink($place);

    $output .= '';
    $output .= '<div class="strip_all_tour_list wow fadeIn animated animated place-teaser-list" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">';
    $output .= '<div class="row">';
    $output .= '  <div class="col-sm-3 col-xs-12">';
    $output .= '    <div class="img_list">';
    $output .= '      <a href="' . $permalink . '">';
    $output .= '        <img src="'. $header_img_src .'" style="max-width: none !important; left: 0% !important;">';
    $output .= '      </a>';
    $output .= '    </div>';
    $output .= '  </div>';
    $output .= '  <div class="col-sm-6 col-xs-12">';
    $output .= '    <div class="tour_list_desc">';
    $output .= '      <h3>';
    $output .= '        <a href="' . $permalink . '">'. $place->post_title .'</a>';
    $output .= '      </h3>';
    if (gc_places_is_place_hotel($place) > -1 && !empty(get_post_meta( gc_places_is_place_hotel($place), '_hotel_price', true ))) {
      $output .= '      <div>';
      $output .= '        <h4>'.esc_html__( 'from/per night', 'citytours' ).': $'. get_post_meta( gc_places_is_place_hotel($place), '_hotel_price', true ) .'</h4>';
      $output .= '      </div>';
    }
    $output .= '      <div class="block-with-text">' . $place->post_content . '</div>';
    $output .= '    </div>';
    $output .= '  </div>';
    $output .= '  <div class="col-sm-3 col-xs-12">';
    $output .= '    <div class="price_list">';
    $output .= '      <div>';
    $output .= '        <a class="btn_1" href="' . $permalink . '">Ver Detalles</a>';
    $output .= '      </div>';
    $output .= '    </div>';
    $output .= '  </div>';
    $output .= '</div>';
    $output .= '</div>';
  }
  $output .= ' </div>';
  $output .= '</div>';
  return $output;
}
add_shortcode( 'all_children_places_teaser_list', 'gc_places_all_children_places_teaser_list_shortcode' );
