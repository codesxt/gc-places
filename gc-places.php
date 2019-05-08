<?php

/*
Plugin Name: Great Chile Places
Plugin URI: http://ferativ.com/
Description: Adds Place Custom Post Type. Developed for Great Chile.
Author: Ferativ
Version: 1.0
Author URI: http://ferativ.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}

function gcplaces_enqueue_styles() {
    wp_enqueue_style( 'ellipsis-css', plugin_dir_url( __FILE__ ) . 'css/ellipsis.css' );
}
add_action( 'wp_enqueue_scripts', 'gcplaces_enqueue_styles' );

// Including helpers
include( plugin_dir_path( __FILE__ ) . '/helpers/children.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/place-permalink.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/get-primary-category.php' );

include( plugin_dir_path( __FILE__ ) . '/dependencies/dependencies.php' );
include( plugin_dir_path( __FILE__ ) . '/place-cpt/place-cpt.php' );
include( plugin_dir_path( __FILE__ ) . '/place-cpt/place-taxonomy.php' );
include( plugin_dir_path( __FILE__ ) . '/place-cpt/place-metabox.php' );

// Including custom metabox according to taxonomy
include( plugin_dir_path( __FILE__ ) . '/place-cpt/place-local-business-metabox.php' );

// This enables automatic selection of parent taxonomies
include( plugin_dir_path( __FILE__ ) . '/place-cpt/place-parent-terms.php' );

// Execute actions on existing implementations
include( plugin_dir_path( __FILE__ ) . '/actions/add-place-to-hotel.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-district-from-hotel.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-related-from-hotel.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/add-header-metabox-to-places.php' );

// Include tour schedules
include( plugin_dir_path( __FILE__ ) . '/tour-schedule/tour-schedule.php' );

// Include shortcodes
include( plugin_dir_path( __FILE__ ) . '/shortcodes/car-pickup-dropoff.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/place-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/all-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/all-children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/places-teaser-list.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/tours-showcase.php' );

// Add admin menu
include( plugin_dir_path( __FILE__ ) . '/admin/admin-page.php' );

// WP Bakery Integration
include( plugin_dir_path( __FILE__ ) . '/bakery/register-all-children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/bakery/register-all-children-places-teaser-list.php' );
include( plugin_dir_path( __FILE__ ) . '/bakery/register-tours-showcase.php' );
