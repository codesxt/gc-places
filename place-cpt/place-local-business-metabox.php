<?php

add_filter( 'rwmb_meta_boxes', 'gc_places_local_business_register_meta_boxes' );
function gc_places_local_business_register_meta_boxes( $meta_boxes ) {
    $prefix = '_place_loc_bus_';
    $meta_boxes[] = array(
        'id'         => 'local_business_details',
        'title'      => 'Local Business Details',
        'post_types' => 'place',
        'context'    => 'normal',
        'priority'   => 'high',
        'visible'    => array( 'slug:tax_input[place-type]', 'in', array( 'local-business' ) ),

        'fields' => array(
            array(
                'name'  => 'Dirección',
                'desc'  => 'Dirección del lugar',
                'id'    => $prefix . 'address',
                'type'  => 'text',
            ),
            array(
                'name'  => 'Teléfono',
                'desc'  => 'Número de teléfono',
                'id'    => $prefix . 'phone',
                'type'  => 'text',
            ),
        )
    );

    return $meta_boxes;
}
