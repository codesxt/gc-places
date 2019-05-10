<?php

function gcplaces_build_icontaxonomy_form_fields () {
  $fields = array();
  array_push($fields, array(
      'type' => 'custom_html',
      'std'  => '<h1>Íconos por Taxonomía de Place</h1>',
  ));

  $terms = get_terms( array(
    'taxonomy' => 'place-type',
    'hide_empty' => false,
  ));

  foreach ($terms as $term) {
    $taxonomy = $term->name;
    $form_group = array(
      'id'     => $taxonomy . '_config',
      'type'   => 'group',
      'sort_clone' => true,
      'fields' => array(
        array(
            'type' => 'custom_html',
            'std'  => '<h1>'.$taxonomy.'</h1>',
        ),
        array(
          'id'               => 'icon',
          'name'             => 'Icon',
          'type'             => 'image_advanced',
          'force_delete'     => false,
          'max_file_uploads' => 1,
          'max_status'       => 'false',
          'image_size'       => 'thumbnail',
        ),
        array(
          'name'          => 'Color de relleno',
          'id'            => 'fill_color',
          'type'          => 'color',
          'alpha_channel' => true,
          // Color picker options. See here: https://automattic.github.io/Iris/.
          'js_options'    => array(
            'palettes' => true
          ),
        ),
        array(
          'name'          => 'Color de borde',
          'id'            => 'border_color',
          'type'          => 'color',
          'alpha_channel' => true,
          // Color picker options. See here: https://automattic.github.io/Iris/.
          'js_options'    => array(
            'palettes' => true
          ),
        )
      )
    );
    array_push($fields, $form_group);
  };
  return $fields;
}

// Register settings page. In this case, it's a theme options page
add_filter( 'mb_settings_pages', 'gcplaces_options_page' );
function gcplaces_options_page( $settings_pages ) {
    $settings_pages[] = array(
        'id'          => 'gcplaces_settings',
        'option_name' => 'gcplaces_options',
        'menu_title'  => 'Great Chile Places',
        'icon_url'    => 'dashicons-media-code',
        'style'       => 'no-boxes',
        'columns'     => 1,
        'tabs'        => array(
            'general' => 'Opciones Generales',
            'map_settings' => 'Configuraciones de Mapas',
            'shortcodes' => 'Shortcodes',
        ),
        'position'    => 68,
    );
    return $settings_pages;
}

// Register meta boxes and fields for settings page
add_filter( 'rwmb_meta_boxes', 'prefix_options_meta_boxes' );
function prefix_options_meta_boxes( $meta_boxes ) {
		$faq_html = file_get_contents( plugin_dir_path( __FILE__ ) . '/content-faq.html', true);
    $meta_boxes[] = array(
        'id'             => 'general',
        'title'          => 'General',
        'settings_pages' => 'gcplaces_settings',
        'tab'            => 'general',

        'fields' => array(
            array(
                'name' => 'MapBox Token',
                'id'   => 'mapbox_token',
                'type' => 'text',
            ),
        ),
    );

    $meta_boxes[] = array(
        'id'             => 'map_settings',
        'title'          => 'Map Settings',
        'settings_pages' => 'gcplaces_settings',
        'tab'            => 'map_settings',
        'fields'         => gcplaces_build_icontaxonomy_form_fields(),
    );

    $meta_boxes[] = array(
        'id'             => 'shortcodes',
        'title'          => 'Shortcodes',
        'settings_pages' => 'gcplaces_settings',
        'tab'            => 'shortcodes',
        'fields'         => array(
            array(
                'type' => 'custom_html',
                'std'  => $faq_html,
            ),
        ),
    );
    return $meta_boxes;
}
