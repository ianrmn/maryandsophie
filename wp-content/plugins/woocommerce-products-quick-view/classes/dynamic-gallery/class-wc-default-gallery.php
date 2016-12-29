<?php
/**
 * WC Quick View Template Gallery Class
 *
 * Class Function into woocommerce plugin
 *
 * Table Of Contents
 *
 * wc_dynamic_gallery_display()
 * wc_dynamic_gallery_preview()
 */
class WC_Quick_View_Template_Default_Gallery_Class
{

	public function wc_default_gallery_display( $product_id = 0 ) {
		global $wc_quick_view_gallery_functions;
		global $quick_view_template_gallery_style_settings;

		$product = wc_get_product( $product_id );
	?>
	<div class="woocommerce">
	<div class="product">
	<div class="images" style="width: 100% !important;">
	<?php
		if ( has_post_thumbnail( $product_id ) ) {
			$image            = get_the_post_thumbnail( $product_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			echo $image;
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $product_id );
		}

		// Get gallery of this product
		$attachment_ids = $product->get_gallery_attachment_ids();

		if ( $attachment_ids ) {

			$loop 		= 0;
			$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
		<div class="thumbnails <?php echo 'columns-' . $columns; ?>">
		<?php
			foreach ( $attachment_ids as $attachment_id ) {
				$classes = array();

				if ( $loop === 0 || $loop % $columns === 0 ) {
					$classes[] = 'first';
				}

				if ( ( $loop + 1 ) % $columns === 0 ) {
					$classes[] = 'last';
				}

				$image_class = implode( ' ', $classes );

				echo apply_filters(
					'woocommerce_single_product_image_thumbnail_html',
					sprintf(
						'<a class="%s">%s</a>',
						esc_attr( $image_class ),
						wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0 )
					),
					$attachment_id,
					$product_id,
					esc_attr( $image_class )
				);

				$loop++;
			}
		?>
		</div>
	<?php
		}
	?>
	</div>
	</div>
	</div>
	<?php
	}
}

global $wc_quick_view_template_default_gallery_class;
$wc_quick_view_template_default_gallery_class = new WC_Quick_View_Template_Default_Gallery_Class();

?>