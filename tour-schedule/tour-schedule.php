<?php

add_filter( 'rwmb_meta_boxes', 'gc_places_tour_schedule' );
function gc_places_tour_schedule( $meta_boxes ) {
    $prefix = '_tour_schedule';
    $meta_boxes[] = array(
        'id'         => 'tour_schedule_details',
        'title'      => 'Tour Schedule Details',
        'post_types' => 'tour',
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'id'     => 'tour_schedule',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'fields' => array(
                    array(
                        'name' => 'Día',
                        'id'   => 'day',
                        'type' => 'text'
                    ),
                    array(
                        'name'   => 'Actividades',
                        'id'     => 'activities',
                        'type'   => 'group',
                        'clone'  => true,
                        'fields' => array(
                            array(
                                'name'  => 'Actividad',
                                'id'    => 'activity_name',
                                'type'  => 'text'
                            ),
                            array(
                                'name'  => 'Hora',
                                'id'    => 'activity_time',
                                'type'  => 'text'
                            ),
                            array(
                                'name'  => 'Descripción',
                                'id'    => 'activity_desc',
                                'type'  => 'textarea',
                                'placeholder' => 'Ingrese una descripción de la actividad'
                            ),
                            array(
                              'name'  => 'Lugar de la actividad',
                              'id'      => "activity_location",
                              'desc'  => 'Seleccione la entidad Place dónde se realizará la actividad',
                              'placeholder'  => 'Escriba el nombre de un lugar',
                              'type'  => 'post',
                              'post_type' => array( 'place' ),
                              'field_type' => 'select_advanced',
                              'multiple' => false,
                            ),
                        ),
                    ),
                ),
            ),
        ),
    );

    return $meta_boxes;
}

/*

*/
