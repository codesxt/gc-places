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
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => "Ícono",
        "param_name" => "icon",
        "value" => "",
        "description" => "Ícono del marcador. Dejar vacío para usar el marcador por defecto."
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
      )
    )
  )
);
}
?>
