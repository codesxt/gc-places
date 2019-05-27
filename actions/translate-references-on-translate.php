<?php

add_filter( 'pll_translate_post_meta', 'translate_post_meta', 10, 3 );

function translate_post_meta( $value, $key, $lang ) {
  // Al parecer esta acción se gatilla sólo cuando se crea la traducción
  // $value: valor del metadato traduciéndose
  // $key: key del metadato traduciéndose
  // $lang: idioma nuevo que se está generando
  /*
   * Algoritmo:
   * Cuando se crea un Car nuevo
   * Si está definido _car_pickup_ref
   *   Buscar si existe el post en el idioma $lang
   *   Asignar el post traducido en vez del normal.
   *
   * pll_get_post($post_id, $slug);
   *   $post_id: id del post original
   *   $slug: código del idioma
   *   retorna: int con el id del post traducido
   */
  if ( '_car_pickup_ref' === $key || '_car_dropoff_ref' === $key || '_hotel_place_ref' === $key) {
    // Value: 2159
    // Key:   _car_pickup_ref
    // Lang:  en
    $place_trans = pll_get_post( $value, $lang );
    // false: si el post no existe
    // null: si el idioma no está definido
    if ( !empty($place_trans) ) {
      $value = $place_trans;
    } else {
      $value = null;
    }
  }
  return $value;
}
