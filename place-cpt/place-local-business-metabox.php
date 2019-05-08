<?php

add_filter( 'rwmb_meta_boxes', 'gc_places_local_business_register_meta_boxes' );
function gc_places_local_business_register_meta_boxes( $meta_boxes ) {
    $prefix = '_place_localbusiness_';
    $meta_boxes[] = array(
      'id'         => 'local_business_details',
      'title'      => 'Local Business Details',
      'post_types' => 'place',
      'context'    => 'normal',
      'priority'   => 'high',
      'visible'    => array( 'slug:tax_input[place-type]', 'in', array( 'local-business' ) ),

      'fields' => array(
        array(
          'name'    => 'Monedas Aceptadas',
          'id'      => $prefix . 'currencies_accepted',
          'type'    => 'checkbox_list',
          'options' => array(
              'USD'       => 'USD',
              'CLP'       => 'CLP',
          ),
          'select_all_none' => true,
        ),
        array(
          'id'      => $prefix . 'opening_hours',
          'name'    => 'Horarios de Apertura',
          'type'    => 'text_list',
          'clone'   => true,
          'description' => 'Use formatos de día de dos letras: Mo, Tu, We, Th, Fr, Sa, Su. Para un rango de días, sepárelos con un guión (p.ej. Mo-Fr)',
          'options' => array(
            ''      => 'Día / Días',
            '00:00' => 'Hora',
          ),
        ),
      )
    );

    return $meta_boxes;
}
