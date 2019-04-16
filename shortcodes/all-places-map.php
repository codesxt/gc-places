<?php

function gc_places_all_places_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
      'height' => '400px'
  ), $atts );
  $args = array(
    'numberposts' => -1,
    'post_type'   => 'place'
  );
  $places = get_posts( $args );
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
  <div id="allPlacesMap" style="height:{$a['height']};"></div>
  <script>
  (function( $ ) {
    let mymap = L.map('allPlacesMap').setView([-33.4727092,-70.769915], 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox.streets',
				accessToken: 'pk.eyJ1IjoiY29kZXN4dCIsImEiOiJjanRnNnR2dnAwMnI2NDNxc3BsMTZhbG43In0.JxJPD5Tumyb1SkuPF_GL3Q'
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
add_shortcode( 'all_places_map', 'gc_places_all_places_map_shortcode' );
