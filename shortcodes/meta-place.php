<?php

add_shortcode( 'meta_place', 'gc_places_meta_place_shortcode' );
function gc_places_meta_place_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
?>
<!-- Metadata de Schema.org -->
	<?php if( isset($place_geo) && $place_geo != '' && $place_geo != null ) {
	$geojson = json_decode($place_geo, $assoc = false);
	$category  = get_post_primary_category(get_the_ID(), 'place-type', false);
	if ( !empty($category['primary_category']) ) {
		$primary_category = $category['primary_category']->name;
	} else {
		$primary_category = 'Place';
	}
	$phone   = rwmb_meta( '_place_phone' );
	$email   = rwmb_meta( '_place_email' );
	$website = rwmb_meta( '_place_website' );
	$same_as = rwmb_meta( '_place_same_as' );
	} ?>

	<script type="application/ld+json">

		{
			"@context": "http://schema.org",
			"@type": "<?php echo $primary_category; ?>",
			<?php if( isset($place_geo) && $place_geo != '' && $place_geo != null ) { ?>
			"geo": {
				<?php if ($geojson->geometry->type == 'Point') {?>
				"@type": "GeoCoordinates",
				"latitude": "<?php echo $geojson->geometry->coordinates[1]; ?>",
				"longitude": "<?php echo $geojson->geometry->coordinates[0]; ?>"
				<?php } ?>
				<?php if ($geojson->geometry->type == 'LineString') {?>
				"@type": "GeoShape",
				"line": "
					<?php foreach ($geojson->geometry->coordinates as $pair) { ?>
						<?php echo $pair[1]." ".$pair[0]." "; ?>
					<?php } ?>
				"
				<?php } ?>
				<?php if ($geojson->geometry->type == 'Polygon') {?>
				"@type": "GeoShape",
				"polygon": "
					<?php foreach ($geojson->geometry->coordinates[0] as $pair) { ?>
						<?php echo $pair[1]." ".$pair[0]." "; ?>
					<?php } ?>
				"
				<?php } ?>
			},
			<?php } ?>
			"description": "<?php echo wp_strip_all_tags(get_the_content()); ?>",
			"address": "<?php echo $address ?>",
			"photo": "<?php echo $header_img_scr ?>",
			"image": "<?php echo $header_img_scr ?>",
			<?php if (count($phone) > 0) {?>
			"telephone": "<?php echo $phone[0] ?>",
			<?php } ?>
			<?php if (count($same_as) > 0) {?>
			"sameAs": "<?php echo $same_as[0] ?>",
			<?php } ?>
			"url": "<?php echo get_post_permalink() ?>",
			"name": "<?php the_title(); ?>"
		}
	</script>
	<!-- Fin Metadata de Schema.org -->
<?php

}
