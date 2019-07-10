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

add_action( 'edit_form_top', 'gcplaces_copy_and_translate_tour_services', 10, 1 );
function gcplaces_copy_and_translate_tour_services( $post ) {
  // Verificar que sea un tour
  if (get_post_type() == 'tour') {
    // Obtener post original
    $from_post = isset($_GET['from_post']) ? $_GET['from_post'] : 0;
    $original_post = get_post( $from_post );
    if ( ($from_post != 0 ) && !empty($original_post) ) {
      // Obtener la taxonomía de los servicios disponibles
      $term_meta = get_post_meta( $from_post, '_tour_services_available', true );
      if ( !empty($term_meta) ) {
        // Separar los valores de los términos de la taxonomía
        $terms = explode( ',', $term_meta );
        $translated_terms = array();
        // Para cada término, se busca la traducción y se agrega a un nuevo arreglo
        foreach( $terms as $term ) {
          $trans_term = pll_get_term( $term );
          array_push( $translated_terms, $trans_term );
        }
        // El resultado se une en una nueva string y se guarda como metadata del nuevo post traducido
        $translated_meta = implode( ',', $translated_terms );
        update_post_meta( get_the_ID(), '_tour_services_available', $translated_meta );
      }

      // Obtener la taxonomía de los servicios no disponibles
      $term_meta = get_post_meta( $from_post, '_tour_services_unavailable', true );
      if ( !empty($term_meta) ) {
        // Separar los valores de los términos de la taxonomía
        $terms = explode( ',', $term_meta );
        $translated_terms = array();
        // Para cada término, se busca la traducción y se agrega a un nuevo arreglo
        foreach( $terms as $term ) {
          $trans_term = pll_get_term( $term );
          array_push( $translated_terms, $trans_term );
        }
        // El resultado se une en una nueva string y se guarda como metadata del nuevo post traducido
        $translated_meta = implode( ',', $translated_terms );
        update_post_meta( get_the_ID(), '_tour_services_unavailable', $translated_meta );
      }
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
