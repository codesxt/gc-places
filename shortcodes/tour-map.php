<?php

add_shortcode( 'tour_map', 'gc_places_tour_map_shortcode' );
function gc_places_tour_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'height' => '400px',
    'div_id' => 'map',
    'lat' => '-33.4727092',
    'lng' => '-70.769915',
    'zoom' => '13'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );

  $places = array();
  $geojsonlist = "";

  // Obtener el itinerario
  $schedule_data = rwmb_meta( 'tour_schedule', null, $a['post_id'] );

  // Obtener todos los lugares del itinerario
  foreach ( $schedule_data as $day ) :
	foreach ( $day['activities'] as $activity ) :
    if ( !empty($activity['activity_location']) ) {
      $activity_place = get_post( $activity['activity_location'] );
      if ( !empty($activity_place) ) {
        array_push($places, $activity_place);
      }
    }
	endforeach;
	endforeach;

  // Poner todos los lugares en el mapa
  foreach ($places as $place) {
    $geojson = htmlspecialchars_decode(get_post_meta( $place->ID, '_place_geo', $single = true ));
    if( empty($geojson) ) {
      continue;
    }

    // Obtener ícono custom por taxonomía
    $category = null;
    $primary_category = null;
    $custom_icon = null;
    $custom_style = null;
    $category  = get_post_primary_category($place->ID, 'place-type', false);
    if( !empty($category) && !empty($category['primary_category']) ) {
      $primary_category = $category['primary_category']->name;
    }
    if ( !empty($primary_category) ) {
      // Buscar si la categoría tiene un ícono seleccionado.
      $custom_icon = gcplaces_get_icon_by_taxonomy($primary_category);
      $custom_style = gcplaces_build_style_by_taxonomy($primary_category);
    }

    $point_text = "";
    $point_text .= "geojson = ".$geojson.";\n";
    $point_text .= "geojson.properties = {";
    $point_text .= "  name: '".$place->post_title."'";
    $point_text .= "};\n";
    $point_text .= "features.push(L.geoJSON(";
    $point_text .= "  geojson,";
    $point_text .= "  {";
    if ( !empty($custom_icon) ) {
      $point_text .= "    " . gcplaces_build_point_to_layer($custom_icon) . ",";
    }
    if ( !empty($custom_style) ) {
      $point_text .= "    " . $custom_style . ",";
    }
    $point_text .= "    onEachFeature: onEachFeature";
    $point_text .= "  }";
    $point_text .= "));";

    $geojsonlist .= "\n";
    $geojsonlist .= $point_text;
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
    popupContent += "<b>Lugar: " + feature.properties.name + "</b>";
    layer.bindPopup(popupContent);
  }

  let features = [];
  let geojson = '';

  $geojsonlist

  let featureGroup = L.featureGroup(features).addTo({$a['div_id']});

  {$a['div_id']}.fitBounds(featureGroup.getBounds());
  </script>
EOT;

  return $output;
}
