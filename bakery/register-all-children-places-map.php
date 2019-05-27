<?php

add_action( 'vc_before_init', 'gcplaces_allchildren_integrateWithVC' );
function gcplaces_allchildren_integrateWithVC() {
  vc_map( array(
    "name" => __( "All Children Places", "gcplaces" ),
    "base" => "all_children_places_map",
    "class" => "",
    "category" => "Great Chile Shortcodes",
    "description" => "Mapa para ver todas las entidades tipo Place hijas de esta página y de sus hijas recursivamente.",
    "params" => array(
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Altura",
        "param_name" => "height",
        "value" => "400px",
        "description" => "Altura del mapa."
      ),
      array(
        "type" => "dropdown",
        "holder" => "div",
        "class" => "",
        "heading" => "Redirigir Hoteles",
        "param_name" => "redirect-hotels",
        "value" => array(
          "Sí" => "yes",
          "No" => "no"
        ),
        "description" => "Los links a las ubicaciones tipo Hotel apuntarán al tipo Hotel en vez de al Place."
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "ID del Div",
        "param_name" => "div_id",
        "value" => "map",
        "description" => "Nombre del ID del Div contenedor. Necesario para llamar correctamente funciones como invalidateSize."
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Latitud",
        "param_name" => "lat",
        "value" => "-33.4727092",
        "description" => "Latitud inicial del mapa."
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Longitud",
        "param_name" => "lng",
        "value" => "-70.769915",
        "description" => "Longitud inicial del mapa."
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Zoom",
        "param_name" => "zoom",
        "value" => "13",
        "description" => "Zoom inicial del mapa."
      )
    )
  )
);
}
?>
