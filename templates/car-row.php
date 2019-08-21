<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$wishlist = array();
if ( is_user_logged_in() ) {
	$user_id = get_current_user_id();
	$wishlist = get_user_meta( $user_id, 'wishlist', true );
}
if ( ! is_array( $wishlist ) ) $wishlist = array();
$price = get_post_meta( $post_id, '_car_price', true );
if ( empty( $price ) ) $price = 0;
$car_type = wp_get_post_terms( $post_id, 'car_type' );
$brief = get_post_meta( $post_id, '_car_brief', true );
if ( empty( $brief ) ) {
	$brief = apply_filters('the_content', get_post_field('post_content', $post_id));
	$brief = wp_trim_words( $brief, 20, '' );
}
$review = get_post_meta( $post_id, '_review', true );
$review = ( ! empty( $review ) )?round( $review, 1 ):0;
$featured = get_post_meta( $post_id, '_car_featured', true );
$hot = get_post_meta( $post_id, '_car_hot', true );
$discount_rate = get_post_meta( $post_id, '_car_discount_rate', true );

$wishlist_link = ct_wishlist_page_url();

$image_src = ct_get_header_image_src( $post_id, 'teaser' );
if ( empty($image_src) ) {
  $image_src = ct_get_header_image_src( $post_id, 'medium' );
}
?>

<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">

	<div class="row">

		<div class="col-lg-4 col-md-4 col-sm-4">
			<?php if ( ! empty( $featured ) ) { ?>
				<div class="ribbon_3"><span><?php _e( 'Featured', 'citytours' ); ?></span></div>
			<?php } elseif ( ! empty( $hot ) ) { ?>
				<div class="ribbon_3 popular"><span><?php _e( 'Hot', 'citytours' ); ?></span></div>
			<?php } ?>
			<?php if ( ! empty( $wishlist_link ) ) : ?>
			<div class="wishlist">
				<a class="tooltip_flip tooltip-effect-1 btn-add-wishlist" href="#" data-post-id="<?php echo esc_attr( $post_id ) ?>"<?php echo ( in_array( ct_car_org_id( $post_id ), $wishlist) ? ' style="display:none;"' : '' ) ?>><span class="wishlist-sign">+</span><span class="tooltip-content-flip"><span class="tooltip-back"><?php esc_html_e( 'Add to wishlist', 'citytours' ); ?></span></span></a>
				<a class="tooltip_flip tooltip-effect-1 btn-remove-wishlist" href="#" data-post-id="<?php echo esc_attr( $post_id ) ?>"<?php echo ( ! in_array( ct_car_org_id( $post_id ), $wishlist) ? ' style="display:none;"' : '' ) ?>><span class="wishlist-sign">-</span><span class="tooltip-content-flip"><span class="tooltip-back"><?php esc_html_e( 'Remove from wishlist', 'citytours' ); ?></span></span></a>
			</div>
			<?php endif; ?>

			<div class="img_list">
				<a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
					<img src="<?php echo $image_src; ?>">
					<?php if ( ! empty( $discount_rate ) ) { ?>
						<div class="badge_save"><?php _e( 'Save', 'citytours' ); ?><strong><?php echo esc_html( $discount_rate . '%' ); ?></strong></div>
					<?php } ?>
					<div class="short_info"></div>
				</a>
			</div>
		</div>

		<div class="clearfix visible-xs-block"></div>

		<div class="col-lg-5 col-md-5 col-sm-5">
			<div class="tour_list_desc">
        <!--
				<div class="rating"><?php ct_rating_smiles( $review )?><small>(<?php echo esc_html( ct_get_review_count( $post_id ) ) ?>)</small></div>
        -->

				<h3><strong><?php echo esc_html( get_the_title( $post_id ) );?></strong></h3>
        <!--
				<?php
					if ( ! empty( $car_type ) ) {
						echo $car_type[0]->name;
					}
					?>
				</h3>
        -->

				<p><?php echo wp_kses_post( $brief ); ?></p>
				<ul class="add_info">
					<?php
						$car_facilities = wp_get_post_terms( $post_id, 'car_facility' );

						if ( ! $car_facilities || is_wp_error( $car_facilities ) ) $car_facilities = array();

						$car_terms = $car_facilities;
						foreach ( $car_terms as $car_term ) :
							$term_id = $car_term->term_id;
							$icon_class = get_tax_meta($term_id, 'ct_tax_icon_class', true);
							echo '<li><div class="tooltip_styled tooltip-effect-4">';
							if ( ! empty( $icon_class ) ) echo '<span class="tooltip-item"><i class="' . esc_attr( $icon_class ) . '"></i></span>';
							echo '<div class="tooltip-content"><h4>' . esc_html( $car_term->name ) . '</h4> ' . esc_html( $car_term->description ) . '</div>';
							echo '</div></li>';
						endforeach;
					?>

				</ul>
			</div>
		</div>

		<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="price_list">
				<div>
					<?php echo ct_price( $price, 'special' ) ?><small ><?php echo esc_html__( '*Per person', 'citytours' ) ?></small>
					<p><a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="btn_1"><?php echo esc_html__( 'Details', 'citytours' ) ?></a></p>
				</div>
			</div>
		</div>

	</div>

</div><!--End strip -->
