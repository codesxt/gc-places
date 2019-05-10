<?php
add_action( 'vc_before_init', 'gcplaces_carsshowcase_integrateWithVC' );
function gcplaces_carsshowcase_integrateWithVC() {
  vc_map(
    array(
      "name" => __( "Cars Showcase", "gcplaces" ),
      "base" => "cars_showcase",
      "class" => "",
      "category" => "Great Chile Shortcodes",
      "description" => "Lista de todos los Car hijos de esta página y de sus hijas recursivamente.",
      "params" => array(

      )
    )
  );
}
?>
