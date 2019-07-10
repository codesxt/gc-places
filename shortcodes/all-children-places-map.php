<?php

function gc_places_all_children_places_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'post_id' => get_the_ID(),
    'redirect-hotels' => 'yes',
    'height' => '400px',
    'div_id' => 'map',
    'lat' => '-33.4727092',
    'lng' => '-70.769915',
    'zoom' => '13'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  $redirect_hotels = ($a['redirect-hotels'] == 'yes' ? true : false);

  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'place');
  $places = $filtered_posts;
  $geojsonlist = "";

  // Poner todos los lugares en el mapa
  foreach ($places as $place) {
    $geojson = htmlspecialchars_decode(get_post_meta( $place->ID, '_place_geo', $single = true ));
    if( empty($geojson) ) {
      continue;
    }
    if ($redirect_hotels) {
      $permalink = gc_places_get_place_permalink($place);
    } else {
      $permalink = get_post_permalink($place->ID);
    }
    //Obtener imagen de encabezado
    $header_img_src = ct_get_header_image_src( $place->ID, 'teaser' );
    if ( empty($header_img_src) ) {
      $header_img_src = ct_get_header_image_src( $place->ID, 'medium' );
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
    $point_text .= "  name: '".$place->post_title."',";
    $point_text .= "  url: '".$permalink."'";
    if ( ! empty( $header_img_src ) ) {
        $point_text .= ",\n  image: '".$header_img_src."'";
    }
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
  <style>
  .leaflet-popup-content { width:auto !important; }
  </style>
  <div class="wpb_content_element">
  <div id="{$a['div_id']}" style="height:{$a['height']};"></div>
  </div>
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
    if (feature.properties.image) {
      let imageUrl = feature.properties.image;
      popupContent += "<img src='"+ imageUrl +"' style='max-width:200px; width: 200px;'/> <br><br>";
    }
    popupContent += "<b><a href='" + feature.properties.url + "'>" + feature.properties.name + "</a></b>";
		layer.bindPopup(popupContent, { maxWidth: "auto" });
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
add_shortcode( 'all_children_places_map', 'gc_places_all_children_places_map_shortcode' );
