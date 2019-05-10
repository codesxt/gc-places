<?php

add_shortcode( 'gcplaces_breadcrumbs', 'gc_places_breadcrumbs_shortcode' );
function gc_places_breadcrumbs_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'height' => '400px',
    'div_id' => 'map',
    'lat' => '-33.4727092',
    'lng' => '-70.769915',
    'zoom' => '13'
  ), $atts );

  $parents = get_post_parents($a['post_id']);

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
