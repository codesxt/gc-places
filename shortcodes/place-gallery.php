<?php

/*
 * Se usa Slider Pro: https://github.com/bqworks/slider-pro/blob/master/docs/modules.md
 */

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
        <h3><?php echo __( 'Gallery', 'gcplaces'); ?></h3>
    </div>
    <style media="screen">
      #my-slider .sp-buttons {
        display: none;
      }
    </style>
    <div class="col-md-9">
        <div class="slider-pro sp-horizontal" id="my-slider">
        <div class="sp-slides">
            <?php
            foreach ( $images as $image ) {
                echo '<div class="sp-slide">';
                echo '<img class="sp-image" src="'.$image['full_url'].'"/>';
                /*
                if ( !empty($image['image_meta']['caption']) ) {
                    echo '<p class="sp-caption">'.$image['image_meta']['caption'].'</p>';
                }*/
                if ( !empty($image['image_meta']['title']) ) {
                    echo '<p class="sp-layer sp-white sp-padding" data-width="200" data-horizontal="center" data-vertical="80%" data-show-transition="down" data-hide-transition="up">'.$image['image_meta']['title'].'</p>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <div class="sp-thumbnails">
            <?php
            foreach ( $images as $image ) {
            ?>
		    <img class="sp-thumbnail" src="<?php echo $image['url'];?>"/>
		    <?php
            }
            ?>
	    </div>


    </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slider-pro/1.5.0/css/slider-pro.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/slider-pro/1.5.0/js/jquery.sliderPro.min.js"></script>

<script type="text/javascript">
	jQuery( document ).ready(function( $ ) {
		$( '#my-slider' ).sliderPro();
	});
</script>

<hr>
<?php
    }
?>
<?php

}
