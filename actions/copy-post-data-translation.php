<?php

add_action( 'edit_form_top', 'gcplaces_copy_post_title_lang', 10, 1 );
function gcplaces_copy_post_title_lang( $post ) {
  $from_post = isset($_GET['from_post']) ? $_GET['from_post'] : 0;
  if ( !empty($from_post) && empty($post->post_title) ) {
    $original_post = get_post( $from_post );
    if ( !empty($original_post) ) {
      $post->post_title = $original_post->post_title;
    }
  }
}

add_action( 'submitpost_box', 'gcplaces_copy_post_terms_lang', 10, 1 );
function gcplaces_copy_post_terms_lang( $post ) {
  // Verificar si el post es un place
  if (get_post_type() == 'place') {
    $from_post = isset($_GET['from_post']) ? $_GET['from_post'] : 0;
    $terms = get_the_terms( $post->ID, 'place-type' );
    if ( !empty( $from_post ) && empty( $terms ) ) {
      $original_post = get_post( $from_post );
      $original_terms = get_the_terms( $original_post->ID, 'place-type' );
  	$original_terms_ids = array();
    if( $original_terms != false ) {
      foreach( $original_terms as $original_term ) {
    	  array_push( $original_terms_ids, $original_term->term_id );
    	}
    	wp_set_post_terms( $post->ID, $tags = $original_terms_ids, $taxonomy = 'place-type', $append = false );
      }
    }  	
  }
}
