<?php
function get_posts_children($parent_id){
  // Based on: https://wordpress.stackexchange.com/questions/81645/how-to-get-all-children-and-grandchildren-of-a-hierarchical-custom-post-type
  $children = array();
  $posts = get_posts(
    array(
      'numberposts' => -1,
      'post_status' => 'publish',
      'post_type' => 'any',
      'post_parent' => $parent_id,
      'suppress_filters' => false
    )
  );
  foreach( $posts as $child ){
    $gchildren = get_posts_children($child->ID);
    if( !empty($gchildren) ) {
      $children = array_merge($children, $gchildren);
    }
  }
  $children = array_merge($children,$posts);
  return $children;
}

function filter_posts_by_type($posts, $type) {
  $filtered_posts = array();
  foreach ( $posts as $post ) {
    if ( $post->post_type == $type ) {
      array_push($filtered_posts, $post);
    }
  }
  return $filtered_posts;
}

function gc_places_all_children_places_map_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'height' => '400px',
    'icon' => '',
    'redirect-hotels' => 'yes'
  ), $atts );
  $mapbox_token = rwmb_meta( 'mapbox_token', array( 'object_type' => 'setting' ), 'gcplaces_options' );
  $redirect_hotels = ($a['redirect-hotels'] == 'yes' ? true : false);

  $ICON_DEFINITION = <<<EOT
  let locationIcon = null;
  if ('{$a['icon']}' !== '') {
    locationIcon = L.icon({
      iconUrl: '{$a['icon']}',
      iconSize: [32, 37],
      iconAnchor: [16, 37],
      popupAnchor: [0, -28]
    });
  } else {
    locationIcon = new L.Icon.Default();
  }
EOT;

  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'place');
  $args = array(
  	'post_parent' => get_the_ID(),
  	'post_type'   => 'any',
  	'numberposts' => -1,
  	'post_status' => 'any'
  );
  $places = $filtered_posts;
  $geojsonlist = "";
  foreach ($places as $place) {
    $geojson = htmlspecialchars_decode(get_post_meta( $place->ID, '_place_geo', $single = true ));
    if( $geojson=="" ) {
      continue;
    }
    if ($redirect_hotels) {
      // Verificar si el place pertenece a un hotel
      $args = array(
        'post_type' => 'hotel',
        'meta_query' => array(
          array(
            'key' => '_hotel_place_ref',
            'value' => $place->ID,
            'compare' => '=',
          )
        )
      );
      $query = new WP_Query($args);
      echo "<pre>";
      echo $place->post_title;
      echo "</pre>";
      echo "<pre>";
      echo "Tiene posts: " . $query->have_posts();
      echo "</pre>";
      while ($query->have_posts()) {
        $query->the_post();
        echo "<pre>";
        echo get_the_title();
        echo "</pre>";
      }
      if ($query->have_posts()) {
        // Si pertenece a un hotel, linkear al hotel
        $permalink = get_post_permalink();
      } else {
        $permalink = get_post_permalink($place->ID);
      }
      wp_reset_postdata();
    } else {
      $permalink = get_post_permalink($place->ID);
    }

$point_text = <<<EOT
  geojson = $geojson;
  geojson.properties = {
    name: '$place->post_title',
    type: 'pickup',
    url: '$permalink'
  }
  features.push(L.geoJSON(
    geojson,
    {
      pointToLayer: function (feature, latlng) {
  			return L.marker(latlng, {icon: locationIcon});
  		},
      onEachFeature: onEachFeature
    }
  ));
EOT;
    $geojsonlist .= "\n";
    $geojsonlist .= $point_text;
  }

  // HEREDOC notation
$output = <<<SHORTCODEOUTPUT
  <div id="allChildrenPlacesMap" style="height:{$a['height']};"></div>
  <script>
  (function( $ ) {
    let mymap = L.map('allChildrenPlacesMap').setView([-33.4727092,-70.769915], 13);
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				maxZoom: 18,
				id: 'mapbox.streets',
				accessToken: '$mapbox_token'
		}).addTo(mymap);

    $ICON_DEFINITION

    function onEachFeature(feature, layer) {
  		let popupContent = "";
      popupContent += "<b><a href='" + feature.properties.url + "'>" + feature.properties.name + "</a></b>";
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
add_shortcode( 'all_children_places_map', 'gc_places_all_children_places_map_shortcode' );
