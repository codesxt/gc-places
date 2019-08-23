<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// Based on answers from:
// https://wordpress.stackexchange.com/questions/100707/automatically-assign-parent-terms-when-a-child-term-is-selected
// Code from:
// https://gist.github.com/tripflex/65dbffc4342cf7077e49d641462b46ad

add_action( 'set_object_terms', 'auto_set_parent_terms', 9999, 6 );
/**
 * Automatically set/assign parent taxonomy terms to posts
 *
 * This function will automatically set parent taxonomy terms whenever terms are set on a post,
 * with the option to configure specific post types, and/or taxonomies.
 *
 *
 * @param int    $object_id  Object ID.
 * @param array  $terms      An array of object terms.
 * @param array  $tt_ids     An array of term taxonomy IDs.
 * @param string $taxonomy   Taxonomy slug.
 * @param bool   $append     Whether to append new terms to the old terms.
 * @param array  $old_tt_ids Old array of term taxonomy IDs.
 */
function auto_set_parent_terms( $object_id, $terms, $tt_ids, $taxonomy, $append, $old_tt_ids ) {
	/**
	 * We only want to move forward if there are taxonomies to set
	 */
	if( empty( $tt_ids ) ) return FALSE;
	/**
	 * Set specific post types to only set parents on.  Set $post_types = FALSE to set parents for ALL post types.
	 */
	$post_types = array( 'place' );
	if( $post_types !== FALSE && ! in_array( get_post_type( $object_id ), $post_types ) ) return FALSE;
	/**
	 * Set specific post types to only set parents on.  Set $post_types = FALSE to set parents for ALL post types.
	 */
	$tax_types = array( 'place-type' );
	if( $tax_types !== FALSE && ! in_array( $taxonomy, $tax_types ) ) return FALSE;

	foreach( $tt_ids as $tt_id ) {
		$parent = wp_get_term_taxonomy_parent_id( $tt_id, $taxonomy );
		if( $parent ) {
			wp_set_post_terms( $object_id, array($parent), $taxonomy, TRUE );
		}
	}
}
