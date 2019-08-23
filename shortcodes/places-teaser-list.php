<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function gc_places_all_children_places_teaser_list_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
  $descendants = get_posts_children(get_the_ID());
  $filtered_posts = filter_posts_by_type($descendants, 'place');

  ob_start();
  ?>

  <div class="hotel-list">
    <div class=" wpv-loop js-wpv-loop">
  <?php
  foreach ($filtered_posts as $place) {
    $post_id = $place->ID;
    $default_path = plugin_dir_path( __DIR__ ) . 'templates/';
    $template_name = 'place-row.php';

    include( $default_path . $template_name );
  }
  ?>
    </div>
  </div>

  <?php
  $data = ob_get_contents();
  ob_end_clean();

  return $data;
}
add_shortcode( 'all_children_places_teaser_list', 'gc_places_all_children_places_teaser_list_shortcode' );
