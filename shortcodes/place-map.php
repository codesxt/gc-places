<?php

function gc_places_place_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'height' => '400px'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );

  $geojson = htmlspecialchars_decode(get_post_meta( $a['post_id'], '_place_geo', $single = true ));
  $place_name = get_the_title( $a['post_id'] );

  // HEREDOC notation
$output = <<<SHORTCODEOUTPUT
  <div id="mapid" style="height:{$a['height']};"></div>
  <script>
  (function( $ ) {
    let mymap = L.map('mapid').setView([-33.4727092,-70.769915], 13);
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

    let placeGeoJSON = $geojson;
    placeGeoJSON.properties = {
      name: '$place_name'
    }
    let placeGeoLayer = L.geoJSON(
      placeGeoJSON,
      {
        onEachFeature: onEachFeature
      }
    );

    let featureGroup = L.featureGroup([placeGeoLayer])
    .addTo(mymap);

    mymap.fitBounds(featureGroup.getBounds(), { maxZoom: 13 });
  })( jQuery );
  </script>
SHORTCODEOUTPUT;

  return $output;
}
add_shortcode( 'place_map', 'gc_places_place_map_shortcode' );
