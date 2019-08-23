<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_action( 'vc_before_init', 'gcplaces_allchildrenteaser_integrateWithVC' );
function gcplaces_allchildrenteaser_integrateWithVC() {
  vc_map( array(
    "name" => __( "All Children Places Teaser", "gcplaces" ),
    "base" => "all_children_places_teaser_list",
    "class" => "",
    "category" => "Great Chile Shortcodes",
    "description" => "Lista de todas las entidades Place hijas de esta página y de sus hijas recursivamente.",
    "params" => array(

    )
  )
);
}
?>
