<?php

function gc_places_car_pickup_dropoff_shortcode( $atts ) {
  $a = shortcode_atts( array(
      'height' => '400px'
  ), $atts );
  $pickup_id = rwmb_meta( '_car_pickup_ref' );
  $pickup_place = get_post( $pickup_id );

  $pickup_geojson = htmlspecialchars_decode(get_post_meta( $pickup_id, '_place_geo', $single = true ));

  $dropoff_id = rwmb_meta( '_car_dropoff_ref' );
  $dropoff_place = get_post( $dropoff_id );
  $dropoff_geojson = htmlspecialchars_decode(get_post_meta( $dropoff_id, '_place_geo', $single = true ));

  if (!isset($pickup_id) || $pickup_id == '') {
    return "<b>No se encontró un lugar de recogida.</b>";
  }
  if (!isset($dropoff_id) || $dropoff_id == '') {
    return "<b>No se encontró un lugar de llegada.</b>";
  }
  if (!isset($pickup_geojson) || $pickup_geojson == '') {
    return "<b>No se encontró ubicación del lugar de recogida.</b>";
  }
  if (!isset($dropoff_geojson) || $dropoff_geojson == '') {
    return "<b>No se encontró ubicación del lugar de llegada.</b>";
  }

  // HEREDOC notation
$output = <<<SHORTCODEOUTPUT
  <div id="mapid" style="height:{$a['height']};"></div>
  <script>
  (function( $ ) {
    // alert('Testing IIFE: $pickup_place->post_title');
    let mymap = L.map('mapid').setView([-33.4727092,-70.769915], 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox.streets',
				accessToken: 'pk.eyJ1IjoiY29kZXN4dCIsImEiOiJjanRnNnR2dnAwMnI2NDNxc3BsMTZhbG43In0.JxJPD5Tumyb1SkuPF_GL3Q'
		}).addTo(mymap);

    function onEachFeature(feature, layer) {
  		let popupContent = "";
      if (feature.properties && feature.properties.type == 'pickup') {
  			popupContent += "<b>Lugar de recogida: " + feature.properties.name + "</b>";
  		}
      if (feature.properties && feature.properties.type == 'dropoff') {
  			popupContent += "<b>Lugar de llegada: " + feature.properties.name + "</b>";
  		}
  		layer.bindPopup(popupContent);
  	}

    let pickupGeoJSON = $pickup_geojson;
    pickupGeoJSON.properties = {
      name: '$pickup_place->post_title',
      type: 'pickup'
    }
    let pickupGeoLayer = L.geoJSON(
      pickupGeoJSON,
      {
        onEachFeature: onEachFeature
      }
    );

    let dropoffGeoJSON = $dropoff_geojson;
    dropoffGeoJSON.properties = {
      name: '$dropoff_place->post_title',
      type: 'dropoff'
    }
    let dropoffGeoLayer = L.geoJSON(
      dropoffGeoJSON,
      {
        onEachFeature: onEachFeature
      }
    );

    let featureGroup = L.featureGroup([pickupGeoLayer, dropoffGeoLayer])
    //.bindPopup('Hello world!')
    .addTo(mymap);

    mymap.fitBounds(featureGroup.getBounds());
  })( jQuery );
  </script>
SHORTCODEOUTPUT;

  return $output;
}
add_shortcode( 'car_pickup_dropoff_map', 'gc_places_car_pickup_dropoff_shortcode' );
