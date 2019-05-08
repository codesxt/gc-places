<?php
add_action( 'vc_before_init', 'gcplaces_toursshowcase_integrateWithVC' );
function gcplaces_toursshowcase_integrateWithVC() {
  vc_map(
    array(
      "name" => __( "Tours Showcase", "gcplaces" ),
      "base" => "tours_showcase",
      "class" => "",
      "category" => "Great Chile Shortcodes",
      "description" => "Lista de todos los Tour hijos de esta página y de sus hijas recursivamente.",
      "params" => array(

      )
    )
  );
}
?>
