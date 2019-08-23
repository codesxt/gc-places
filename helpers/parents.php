<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function get_post_parents($post_id){
  $parents = array();

  $parent_id = wp_get_post_parent_id($post_id); // 0 if no parent, false if not exists
  while (wp_get_post_parent_id($post_id) != 0 || wp_get_post_parent_id($post_id) != false) {
    $parent_id = wp_get_post_parent_id($post_id);
    $parent = get_post($parent_id);
    array_push($parents, $parent);
    $post_id = $parent_id;
  }
  return $parents;
}
