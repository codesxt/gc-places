<?php

function gcplaces_build_point_to_layer ($icon) {
  $output = "";
  $output .= "pointToLayer: function(feature, latlng) {";
  $output .= "  return L.marker(latlng, {";
  $output .= "    icon: new L.Icon({";
  $output .= "        iconSize: [27, 27],";
  $output .= "        iconAnchor: [13, 27],";
  $output .= "        popupAnchor:  [1, -24],";
  $output .= "        iconUrl: '".$icon."'";
  $output .= "    })";
  $output .= "  })";
  $output .= "}\n";
  return $output;
}

function gcplaces_get_icon_by_taxonomy ($taxonomy) {
  $taxonomy_config = rwmb_meta( $taxonomy.'_config', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  if ( !empty($taxonomy_config) && !empty($taxonomy_config['icon']) ) {
    $image = RWMB_Image_Field::file_info( $taxonomy_config['icon'][0], array( 'size' => 'thumbnail' ) );
    if ( !empty($image) ) {
      return $image['url'];
    }
  } else {
    return '';
  }
}
