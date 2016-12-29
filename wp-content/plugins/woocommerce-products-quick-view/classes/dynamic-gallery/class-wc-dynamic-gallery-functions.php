<?php
/**
 * WC Quick View Gallery Functions
 *
 * Table Of Contents
 *
 */
class WC_Quick_View_Gallery_Functions
{
	public function get_no_image_uri() {
		$no_image_uri = apply_filters( 'wc_dg_no_image_uri', WC_QUICK_VIEW_ULTIMATE_JS_URL . '/mygallery/no-image.png' );

		return $no_image_uri;
	}

	public function get_gallery_ids( $post_id = 0 ) {
		global $quick_view_template_gallery_style_settings;

		if ( $post_id < 1 ) return array();

		$post_type = get_post_type( $post_id );
		if ( false === $post_type ) {
			return array();
		}


		if ( 'product' != $post_type ) {
			return array();
		}


		$auto_feature_image = $quick_view_template_gallery_style_settings['auto_feature_image'];
		if ( $auto_feature_image == 1 || $auto_feature_image == 'yes' ) {
			$auto_feature_image = 'yes';
		}

		$have_gallery_ids    = false;
		$have_featured_image = false;

		$featured_img_id = (int) get_post_meta( $post_id, '_thumbnail_id', true );
		if ( ! empty( $featured_img_id ) && $featured_img_id > 0 ) {
			$have_featured_image = true;
			$have_gallery_ids = true;
		}

		// Use the WooCommerce Default Gallery
		$dgallery_ids = get_post_meta( $post_id, '_product_image_gallery', true );
		if ( ! empty( $dgallery_ids ) && '' != trim( $dgallery_ids ) ) {
			$dgallery_ids = explode( ',', $dgallery_ids );

			if ( count( $dgallery_ids ) > 0 ) {
				$have_gallery_ids = true;
			}
		}

		if ( $have_gallery_ids && is_array( $dgallery_ids ) && count( $dgallery_ids ) > 0 ) {

			foreach ( $dgallery_ids as $img_id ) {
				// Remove image id if it is not image
				if ( ! wp_attachment_is_image( $img_id ) ) {
					$dgallery_ids = array_diff( $dgallery_ids, array( $img_id ) );
				}
			}

			if ( 'yes' == $auto_feature_image && $have_featured_image && ! in_array( $featured_img_id, $dgallery_ids ) ) {
				$dgallery_ids = array_merge( array( $featured_img_id ), $dgallery_ids );
			}

			if ( count( $dgallery_ids ) > 0 ) {
				return $dgallery_ids;
			}

		}

		// set dgallery_ids to empty array if don't have Woo Default Gallery
		$dgallery_ids = array();

		if ( $have_featured_image ) {
			$dgallery_ids[] = $featured_img_id;
		}

		$attached_images = (array) get_posts( array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'numberposts'    => -1,
			'post_status'    => null,
			'post_parent'    => $post_id,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'exclude'        => array( $featured_img_id ),
		) );

		if ( is_array( $attached_images ) && count( $attached_images ) > 0 ) {
			foreach ( $attached_images as $item_thumb ) {
				$is_excluded   = get_post_meta( $item_thumb->ID, '_woocommerce_exclude_image', true );

				// Don't get if this image is excluded on main gallery
				if ( 1 == $is_excluded ) continue;

				$dgallery_ids[]    = $item_thumb->ID;
			}
		}

		return $dgallery_ids;
	}
}

global $wc_quick_view_gallery_functions;
$wc_quick_view_gallery_functions = new WC_Quick_View_Gallery_Functions();

?>