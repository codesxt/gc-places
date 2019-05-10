<?php

add_shortcode( 'place_gallery', 'gc_places_place_gallery_shortcode' );
function gc_places_place_gallery_shortcode( $atts ) {
  $a = shortcode_atts( array(
  ), $atts );
?>
<?php
    $images = rwmb_meta( '_place_gallery', array( 'size' => 'thumbnail' ) );
    if ( !empty($images) ) {
?>
<div class="row">
    <div class="col-md-3">
        <h3><?php echo esc_html__( 'Galería', 'citytours') ?></h3>
    </div>
    <div class="col-md-9">
        <?php
        foreach ( $images as $image ) {
            echo '<a href="', $image['full_url'], '"><img src="', $image['url'], '"></a>';
        }
        ?>
    </div>
</div>

<hr>
<?php
    }
?>
<?php

}
