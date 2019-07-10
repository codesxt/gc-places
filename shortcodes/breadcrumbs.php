<?php

add_shortcode( 'gcplaces_breadcrumbs', 'gc_places_breadcrumbs_shortcode' );
function gc_places_breadcrumbs_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID()
  ), $atts );

  $post_type = get_post_type( $a['post_id'] );
  $parents = [];
  if ( $post_type == 'hotel' ) {
    // Si el post es un hotel, se deben usar los
    // permalinks padres del place asociado
    $place_id = get_post_meta( $a['post_id'], '_hotel_place_ref', true );
    if( !empty($place_id) ) {
      $place = get_post( $place_id );
      if( !empty($place) ) {
        $parents = get_post_parents( $place_id );
      }
    }
  } else {
    $parents = get_post_parents( $a['post_id'] );
  }

  $parents = array_reverse ( $parents );

  $output = '';
  $output .= '<ul>';
  $output .= '  <li>';
  $output .= '    <a href="'.esc_url( home_url('/') ).'" title="'.esc_html__('Home', 'citytours').'">'.esc_html__('Home', 'citytours').'</a>';
  $output .= '  </li>';
  foreach ($parents as $post) {
    $output .= '  <li>';
    $output .= '    <a href="'.get_post_permalink($post->ID).'">'.$post->post_title.'</a>';
    $output .= '  </li>';
  }
  $output .= '  <li class="active">';
  $output .= '    '.get_the_title();
  $output .= '  </li>';
  $output .= '<ul>';
  return $output;
}
