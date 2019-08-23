<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function run_tests() {
    global $wp_query;
    print_r($wp_query);
    var_dump($wp_query->query_vars);
    // yields array(0) { }
}
//add_action( 'wp_loaded', 'run_tests' );
