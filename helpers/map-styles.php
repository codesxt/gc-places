<?php

function gcplaces_build_style_by_taxonomy ( $taxonomy ) {
  $taxonomy_config = rwmb_meta( $taxonomy.'_config', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  $output = "";
  $output .= "style: {";
  if ( !empty($taxonomy_config) && !empty($taxonomy_config['fill_color']) ) {
    $output .= '  fillColor: "' . $taxonomy_config['fill_color'] .'",';
  }
  if ( !empty($taxonomy_config) && !empty($taxonomy_config['border_color']) ) {
    $output .= '  color: "' . $taxonomy_config['border_color'] .'",';
  }
  $output .= "}\n";
  return $output;
}
