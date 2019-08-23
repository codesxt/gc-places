<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function get_posts_children($parent_id){
  // Based on: https://wordpress.stackexchange.com/questions/81645/how-to-get-all-children-and-grandchildren-of-a-hierarchical-custom-post-type
  $children = array();
  $posts = get_posts(
    array(
      'numberposts' => -1,
      'post_status' => 'publish',
      'post_type' => 'any',
      'post_parent' => $parent_id,
      'suppress_filters' => false,
      'orderby' => 'menu_order post_title',
      'order' => 'ASC',
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
