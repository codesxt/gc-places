<?php

function gc_places_children_places_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
      'height' => '400px'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  /* $args = array(
    'numberposts' => -1,
    'post_type'   => 'place'
  );
  $places = get_posts( $args ); */
  $args = array(
  	'post_parent' => get_the_ID(),
  	'post_type'   => 'any',
  	'numberposts' => -1,
  	'post_status' => 'any'
  );
  $places = get_children( $args );
  print_r($places);
  $geojsonlist = "";
  foreach ($places as $place) {
    $geojson = htmlspecialchars_decode(get_post_meta( $place->ID, '_place_geo', $single = true ));
    if( $geojson=="" ) {
      continue;
    }
$point_text = <<<EOT
  geojson = $geojson;
  geojson.properties = {
    name: '$place->post_title',
    type: 'pickup'
  }
  features.push(L.geoJSON(
    geojson,
    {
      onEachFeature: onEachFeature
    }
  ));
EOT;
    $geojsonlist .= "\n";
    $geojsonlist .= $point_text;
  }

  // HEREDOC notation
$output = <<<SHORTCODEOUTPUT
  <div id="childrenPlacesMap" style="height:{$a['height']};"></div>
  <script>
  (function( $ ) {
    let mymap = L.map('childrenPlacesMap').setView([-33.4727092,-70.769915], 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox.streets',
				accessToken: '$mapbox_token'
		}).addTo(mymap);

    function onEachFeature(feature, layer) {
  		let popupContent = "";
      popupContent += "<b>Lugar: " + feature.properties.name + "</b>";
  		layer.bindPopup(popupContent);
  	}

    let features = [];
    let geojson = '';

    $geojsonlist

    let featureGroup = L.featureGroup(features)
    .addTo(mymap);

    mymap.fitBounds(featureGroup.getBounds());
  })( jQuery );
  </script>
SHORTCODEOUTPUT;

  return $output;
}
add_shortcode( 'children_places_map', 'gc_places_children_places_map_shortcode' );
