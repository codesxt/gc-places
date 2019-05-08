<?php

add_filter( 'rwmb_meta_boxes', 'gc_places_register_meta_boxes' );
function gc_places_register_meta_boxes( $meta_boxes ) {
    $prefix = '_place_';
    $meta_boxes[] = array(
        'id'         => 'place_default_details',
        'title'      => 'Place Default Details',
        'post_types' => 'place',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'id'   => $prefix . 'gallery',
                'name'             => 'Galería',
                'type'             => 'image_advanced',
                'force_delete'     => false,
                'max_file_uploads' => 10,
                'max_status'       => 'true',
                'image_size'       => 'thumbnail',
            ),
            array(
                'name' => 'Georeferencia',
                'id'   => $prefix . 'geo',
                'type' => 'georeference',
            ),
            array(
                'name'  => 'Dirección',
                'desc'  => 'Dirección del lugar',
                'id'    => $prefix . 'address',
                'type'  => 'text',
            ),
            array(
                'name'  => 'Teléfono',
                'desc'  => 'Uno o más números de teléfono relacionados con el lugar',
                'id'    => $prefix . 'phone',
                'type'  => 'text',
                'clone'       => true
            ),
            array(
                'name'  => 'Correo Electrónico',
                'desc'  => 'Uno o más correos electrónicos relacionados con el lugar',
                'id'    => $prefix . 'email',
                'type'  => 'text',
                'clone'       => true
            ),
            array(
                'name'  => 'Sitio Web',
                'desc'  => 'Uno o más sitios web relacionados con el lugar',
                'id'    => $prefix . 'website',
                'type'  => 'text',
                'clone'       => true
            ),
            array(
                'name'        => 'Links de Referencia',
                'label_description' => 'Usados para el campo sameAs del Schema',
                'id'          => $prefix . 'same_as',
                'desc'        => 'Ingrese enlaces',
                'type'        => 'text',
                'clone'       => true
            ),

        )
    );

    return $meta_boxes;
}
