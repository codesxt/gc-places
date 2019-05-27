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

add_action( 'plugins_loaded', 'gcplaces_load_text_domain' );
function gcplaces_load_text_domain() {
  load_plugin_textdomain( 'gcplaces', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

function gcplaces_enqueue_styles() {
    wp_enqueue_style( 'ellipsis-css', plugin_dir_url( __FILE__ ) . 'css/ellipsis.css' );
		wp_enqueue_style( 'gcplaces-styles-css', plugin_dir_url( __FILE__ ) . 'css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'gcplaces_enqueue_styles' );

// Including helpers
include( plugin_dir_path( __FILE__ ) . '/helpers/children.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/parents.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/place-permalink.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/get-primary-category.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/map-icons.php' );
include( plugin_dir_path( __FILE__ ) . '/helpers/map-styles.php' );

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
include( plugin_dir_path( __FILE__ ) . '/actions/remove-fields-from-hotel.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-slider-fields.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/add-header-metabox-to-places.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-tour-data.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/copy-post-data-translation.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-fields-from-checkout.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/translate-references-on-translate.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/remove-quantity-selector.php' );
include( plugin_dir_path( __FILE__ ) . '/actions/tests.php' );

// Include tour schedules
include( plugin_dir_path( __FILE__ ) . '/tour-schedule/tour-schedule.php' );

// Include shortcodes
include( plugin_dir_path( __FILE__ ) . '/shortcodes/car-pickup-dropoff.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/place-map.php' );
// include( plugin_dir_path( __FILE__ ) . '/shortcodes/all-places-map.php' );
// include( plugin_dir_path( __FILE__ ) . '/shortcodes/children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/all-children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/places-teaser-list.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/tours-showcase.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/cars-showcase.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/tour-map.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/breadcrumbs.php' );
include( plugin_dir_path( __FILE__ ) . '/shortcodes/place-gallery.php' );
// NOT WORKING YET include( plugin_dir_path( __FILE__ ) . '/shortcodes/meta-place.php' );

// Add admin menu
include( plugin_dir_path( __FILE__ ) . '/admin/admin-page.php' );

// WP Bakery Integration
include( plugin_dir_path( __FILE__ ) . '/bakery/register-all-children-places-map.php' );
include( plugin_dir_path( __FILE__ ) . '/bakery/register-all-children-places-teaser-list.php' );
include( plugin_dir_path( __FILE__ ) . '/bakery/register-tours-showcase.php' );
include( plugin_dir_path( __FILE__ ) . '/bakery/register-cars-showcase.php' );
