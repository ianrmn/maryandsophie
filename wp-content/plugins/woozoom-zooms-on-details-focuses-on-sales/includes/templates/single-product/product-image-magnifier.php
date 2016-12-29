<?php
/**
 * Template: Single Product Image
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $post, $woocommerce, $product;

$placeholder   = function_exists( 'wc_placeholder_img_src' ) ? wc_placeholder_img_src() : woocommerce_placeholder_img_src();

?>
<div class="images woozoom-images">

	<?php
		if ( has_post_thumbnail() ) {
			$main_image_full  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			if( !empty($main_image_full) ) {
				$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
				
				$main_image_size = get_option('woozoom_main_image_size');
				if( $main_image_size['width'] > 0 && $main_image_size['height'] > 0 ) {
					$image_src = ! empty( $main_image_full[0] ) ? $main_image_full[0] : false;
			
					$args = apply_filters( 'woozoom_main_image_args',
						array(
							'position' => 'c',
							'width'    => $main_image_size['width'],
							'height'   => $main_image_size['height'],
							'quality'  => 100,
							'retina'   => false
						)
					);
					
					$woozoom_resizer = new WOOZOOm_Resizer();
					$main_image = $woozoom_resizer->resize_image( 
						$image_src,
						$args['width'],
						$args['height'],
						false,
						$args['position'],
						$args['quality'],
						$args['retina']
					);
				} else {
					$main_image = $main_image_full[0];
				}
				
				$attachment_count = count( $product->get_gallery_attachment_ids() );
				if ( $attachment_count > 0 ) {
					$gallery = '[product-gallery]';
				} else {
					$gallery = '';
				}
			
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '"><img id="woozoom-zoom" class="woocommerce-main-image notSelectable" src="%s" data-zoom-image="%s" /></a>', $main_image_full[0], $image_caption, $main_image, $main_image_full[0]), $post->ID );
			}

		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s">', $placeholder), $post->ID );
		}
		
		do_action( 'woocommerce_product_thumbnails' );
	?>

</div>
