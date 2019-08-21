<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Habilitar funcionalidad de Wishlist para places tipo Hotel
$wishlist = array();
if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$wishlist = get_user_meta( $user_id, 'wishlist', true );
}
if ( ! is_array( $wishlist ) ) $wishlist = array();
$wishlist_link = ct_wishlist_page_url();

$place = get_post( $post_id );
$permalink = gc_places_get_place_permalink($place);
$image_src = ct_get_header_image_src( $place->ID, 'teaser' );
if ( empty($image_src) ) {
  $image_src = ct_get_header_image_src( $place->ID, 'medium' );
}
$brief = $place->post_content;
$brief = wp_trim_words( $brief, 20, '' );

// Variables en caso de que el Place esté asociado a un Hotel
$is_hotel = ( gc_places_is_place_hotel($place) > -1 );
if ( $is_hotel ) {
  $hotel_id = gc_places_is_place_hotel($place);
  $hotel_price = get_post_meta( $hotel_id, '_hotel_price', true );
}

?>

<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4">
		  <?php if ( !empty( $wishlist_link ) && $is_hotel ) : ?>
				<div class="wishlist">
					<a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="<?php echo esc_attr( $hotel_id ) ?>"<?php echo ( in_array( ct_hotel_org_id( $hotel_id ), $wishlist) ? ' style="display:none;"' : '' ) ?>><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back"><?php esc_html_e( 'Add to wishlist', 'citytours' ); ?></span></span></a>
					<a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="<?php echo esc_attr( $hotel_id ) ?>"<?php echo ( ! in_array( ct_hotel_org_id( $hotel_id ), $wishlist) ? ' style="display:none;"' : '' ) ?>><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back"><?php esc_html_e( 'Remove from wishlist', 'citytours' ); ?></span></span></a>
				</div>
			<?php endif; ?>

      <div class="img_list">
				<a href="<?php echo esc_url( $permalink ); ?>">
					<img src="<?php echo $image_src; ?>">
				</a>
			</div>
    </div>

    <div class="clearfix visible-xs-block"></div>

		<div class="col-lg-5 col-md-5 col-sm-5">
			<div class="tour_list_desc">
			  <h3>
          <a href="<?php echo esc_url( $permalink ); ?>"><?php echo $place->post_title; ?></a>
        </h3>
        <div class="block-with-text"><?php echo $brief; ?></div>
			</div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3">
			<div class="price_list">
        <div>
          <?php
          if ( !empty($hotel_price) ) {
          ?>
					<?php echo ct_price( $hotel_price, 'special' ) ?><small ><?php echo esc_html__( '*Per person', 'citytours' ) ?></small>
					<?php
          }
          ?>
					<p><a href="<?php echo esc_url( $permalink ); ?>" class="btn_1"><?php echo esc_html__( 'Details', 'citytours' ) ?></a></p>
				</div>
      </div>
		</div>
  </div>
</div>
