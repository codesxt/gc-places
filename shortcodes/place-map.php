<?php

add_shortcode( 'place_map', 'gc_places_place_map_shortcode' );
function gc_places_place_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'height' => '400px',
    'div_id' => 'map',
    'lat' => '-33.4727092',
    'lng' => '-70.769915',
    'zoom' => '13'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );

  $geojson = htmlspecialchars_decode(get_post_meta( $a['post_id'], '_place_geo', $single = true ));
  $point_text = "";
  $place_string = __( 'Place', 'gcplaces');
  if( !empty($geojson) ) {
    $place = get_post( $a['post_id'] );

    // Obtener ícono custom por taxonomía
    $category = null;
    $primary_category = null;
    $custom_icon = null;
    $custom_style = null;
    $category = get_post_primary_category($place->ID, 'place-type', false);
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

  // {$a['div_id']}.dragging.disable();
  // {$a['div_id']}.touchZoom.disable();
  // {$a['div_id']}.doubleClickZoom.disable();
  {$a['div_id']}.scrollWheelZoom.disable();

  function onEachFeature(feature, layer) {
    let popupContent = "";
    popupContent += "<b>$place_string: " + feature.properties.name + "</b>";
    layer.bindPopup(popupContent);
  }

  let features = [];
  let geojson = '';

  $point_text

  let featureGroup = L.featureGroup(features).addTo({$a['div_id']});

  {$a['div_id']}.fitBounds(featureGroup.getBounds(), { maxZoom: {$a['zoom']} });
  </script>
EOT;

  return $output;
}



/*
<div id="map"></div>

		<script>
		let center = L.geoJSON(<?php echo $place_geo; ?>).getBounds().getCenter();
		let ctloc_map = L.map('map').setView(center, 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		maxZoom: 18,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoiY29kZXN4dCIsImEiOiJjanRnNnR2dnAwMnI2NDNxc3BsMTZhbG43In0.JxJPD5Tumyb1SkuPF_GL3Q'
		}).addTo(ctloc_map);

		// Si $place_geo esta definido, añadir capa GeoJSON
		<?php if( isset($place_geo) && $place_geo != '' && $place_geo != null ) {?>
			let geoLayer = L.geoJSON(<?php echo implode(",", $place_geo); ?>).addTo(ctloc_map);
			ctloc_map.fitBounds(geoLayer.getBounds());
		<?php } ?>
		</script>
    */
