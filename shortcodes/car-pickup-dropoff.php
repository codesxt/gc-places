<?php

add_shortcode( 'car_pickup_dropoff_map', 'gc_places_car_pickup_dropoff_shortcode' );
function gc_places_car_pickup_dropoff_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'height' => '400px',
    'div_id' => 'map',
    'lat' => '-33.4727092',
    'lng' => '-70.769915',
    'zoom' => '13'
  ), $atts );

  $pickup_string = __( 'Pickup Place', 'gcplaces');
  $dropoff_string = __( 'Dropoff Place', 'gcplaces');

  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  $pickup_id = rwmb_meta( '_car_pickup_ref' );
  $pickup_place = get_post( $pickup_id );

  $pickup_geojson = htmlspecialchars_decode(get_post_meta( $pickup_id, '_place_geo', $single = true ));

  $dropoff_id = rwmb_meta( '_car_dropoff_ref' );
  $dropoff_place = get_post( $dropoff_id );
  $dropoff_geojson = htmlspecialchars_decode(get_post_meta( $dropoff_id, '_place_geo', $single = true ));

  if (!isset($pickup_id) || $pickup_id == '') {
    // return "<b>No se encontró un lugar de recogida.</b>";
    return "";
  }
  if (!isset($dropoff_id) || $dropoff_id == '') {
    // return "<b>No se encontró un lugar de llegada.</b>";
    return "";
  }
  if (!isset($pickup_geojson) || $pickup_geojson == '') {
    // return "<b>No se encontró ubicación del lugar de recogida.</b>";
    return "";
  }
  if (!isset($dropoff_geojson) || $dropoff_geojson == '') {
    // return "<b>No se encontró ubicación del lugar de llegada.</b>";
    return "";
  }

  // Genera el contenido que define el ícono de Pickup
  $category = null;
  $primary_category = null;
  $custom_icon = null;
  $pickup_style = null;
  $category  = get_post_primary_category($pickup_place->ID, 'place-type', false);
  if( !empty($category) && !empty($category['primary_category']) ) {
    $primary_category = $category['primary_category']->name;
  }
  if ( !empty($primary_category) ) {
    // Buscar si la categoría tiene un ícono seleccionado.
    $custom_icon = gcplaces_get_icon_by_taxonomy($primary_category);
    $pickup_style = gcplaces_build_style_by_taxonomy($primary_category) . ',';
  }
  if ( !empty($custom_icon) ) {
    $pickup_icon = gcplaces_build_point_to_layer($custom_icon) . ",";
  } else {
    $pickup_icon = '';
  }

  // Genera el contenido que define el ícono de Dropoff
  $category = null;
  $primary_category = null;
  $custom_icon = null;
  $dropoff_style = null;
  $category  = get_post_primary_category($dropoff_place->ID, 'place-type', false);
  if( !empty($category) && !empty($category['primary_category']) ) {
    $primary_category = $category['primary_category']->name;
  }
  if ( !empty($primary_category) ) {
    // Buscar si la categoría tiene un ícono seleccionado.
    $custom_icon = gcplaces_get_icon_by_taxonomy($primary_category);
    $dropoff_style = gcplaces_build_style_by_taxonomy($primary_category) . ',';
  }
  if ( !empty($custom_icon) ) {
    $dropoff_icon = gcplaces_build_point_to_layer($custom_icon) . ",";
  } else {
    $dropoff_icon = '';
  }


$output = <<<EOT
  <div id="{$a['div_id']}" style="height:{$a['height']};"></div>
  <script>
  let {$a['div_id']} = L.map('{$a['div_id']}').setView([{$a['lat']},{$a['lng']}], {$a['zoom']});
  L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 18,
      id: 'mapbox.streets',
      accessToken: '$mapbox_token'
  }).addTo({$a['div_id']});

  {$a['div_id']}.scrollWheelZoom.disable();

  function onEachFeature(feature, layer) {
		let popupContent = "";
    if (feature.properties && feature.properties.type == 'pickup') {
			popupContent += "<b>$pickup_string: " + feature.properties.name + "</b>";
		}
    if (feature.properties && feature.properties.type == 'dropoff') {
			popupContent += "<b>$dropoff_string: " + feature.properties.name + "</b>";
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
      $pickup_icon
      $pickup_style
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
      $dropoff_icon
      $dropoff_style
      onEachFeature: onEachFeature
    }
  );

  let featureGroup = L.featureGroup([pickupGeoLayer, dropoffGeoLayer]).addTo({$a['div_id']});

  {$a['div_id']}.fitBounds(featureGroup.getBounds());
  </script>
EOT;

  return $output;
}
