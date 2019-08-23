<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

add_action( 'init', 'unregister_tags' );
function unregister_tags() {
  unregister_taxonomy_for_object_type( 'district', 'hotel' );
}
?>
