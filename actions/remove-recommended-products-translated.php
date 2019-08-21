<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'woocommerce_related_products' ) ) {

	/**
	 * Output the related products.
	 *
	 * @param array $args Provided arguments.
	 */
	function woocommerce_related_products( $args = array() ) {
		global $product;

		if ( ! $product ) {
			return;
		}

		$defaults = array(
			'posts_per_page' => 2,
			'columns'        => 2,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			'order'          => 'desc',
		);

		$args = wp_parse_args( $args, $defaults );

		// Get visible related products then sort them at random.
		$related_products = wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() );

		// Verifica si existe polylang y lo usa para filtrar los posts recomendados
		// que son traducciones o corresponden a otro idioma
		if ( function_exists( 'pll_current_language' ) ) {
		  $language_code = pll_current_language();
      echo "<br>";
		  foreach ($related_products as $i => $product_id) {
        $translation = pll_get_post($product_id, $language_code);
        if( $translation == $product->get_id() ) {
          // Ignorar el producto si es una traducción del producto actual
          // echo "Ignorando el producto: " . get_the_title( $product_id );
          unset( $related_products[$i] );
          break;
        }

        // Ignorar el producto si está en otro idioma
        if ( pll_get_post_language( $product_id ) != $language_code ) {
          unset( $related_products[$i] );
          break;
        }
      }
		}
		$args['related_products'] = array_filter( array_map( 'wc_get_product', $related_products ), 'wc_products_array_filter_visible' );

		// Handle orderby.
		$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

		// Set global loop values.
		wc_set_loop_prop( 'name', 'related' );
		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );

		wc_get_template( 'single-product/related.php', $args );
	}
}
