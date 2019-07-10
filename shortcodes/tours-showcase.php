<?php

function gc_places_tours_showcase_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'tour');

  $output = '';

  $output = '<div class="hotel-list">';
  $output .= '  <div class="">';
  $output .= '    <div class="row">';
  foreach ($filtered_posts as $tour) {

    // Obtener imagen del teaser
    //$header_attachment_id = get_post_meta( $tour->ID, '_header_image', true );
    //wp_get_attachment_image_src( $header_img_ids, $size );
    $header_img_src = ct_get_header_image_src( $tour->ID, 'teaser' );
    if ( empty($header_img_src) ) {
      $header_img_src = ct_get_header_image_src( $tour->ID, 'medium' );
    }
    // Fin de obtener imagen

    $permalink = get_post_permalink( $tour->ID );
    $person_price = get_post_meta( $tour->ID, '_tour_price', true );

    $output .= '';
    $output .= '<div class="strip_all_tour_list wow fadeIn animated animated" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">';
    $output .= '<div class="col-sm-4 col-xs-12">';
    $output .= '  <div class="tour_container">';
    $output .= '    <div class="img_container">';
    $output .= '      <a href="'. $permalink .'" data-slimstat="5">';
    $output .= '        <img src="'. $header_img_src .'">';
    $output .= '      </a>';
    $output .= '    </div>';
    $output .= '    <div class="tour_title">';
    $output .= '      <h2 style="font-size:20px;text-align:center;">';
    $output .= '        <a href="'. $permalink .'" data-slimstat="5">';
    $output .= '          '. $tour->post_title .'';
    $output .= '        </a>';
    $output .= '      </h2>';
    $output .= '      <hr>';
    // $output .= '      <h4 class="text-center">';
    // $output .= '        3 Días';
    // $output .= '      </h4>';
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
}
add_shortcode( 'tours_showcase', 'gc_places_tours_showcase_shortcode' );
