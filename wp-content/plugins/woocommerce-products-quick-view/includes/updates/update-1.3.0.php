<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

update_option( 'quick_view_ultimate_popup_content', 'custom_template' );

$fancybox_overlay_color = get_option( 'quick_view_ultimate_fancybox_overlay_color', '' );
update_option( 'quick_view_ultimate_fancybox_overlay_color', array( 'enable' => 1, 'color' => $fancybox_overlay_color ) );

$colorbox_overlay_color = get_option( 'quick_view_ultimate_colorbox_overlay_color', '' );
update_option( 'quick_view_ultimate_colorbox_overlay_color', array( 'enable' => 1, 'color' => $colorbox_overlay_color ) );

$quick_view_template_gallery_style_settings = get_option( 'quick_view_template_gallery_style_settings', array() );

if ( isset( $quick_view_template_gallery_style_settings['bg_image_wrapper'] ) ) {
	$bg_image_wrapper = $quick_view_template_gallery_style_settings['bg_image_wrapper'];
	$quick_view_template_gallery_style_settings['main_bg_color'] = array( 'enable' => 1, 'color' => $bg_image_wrapper );
}

if ( isset( $quick_view_template_gallery_style_settings['border_image_wrapper_color'] ) ) {
	$border_image_wrapper_color = $quick_view_template_gallery_style_settings['border_image_wrapper_color'];
	$quick_view_template_gallery_style_settings['main_border'] = array( 'width' => '1px', 'style' => 'solid', 'color' => $border_image_wrapper_color, 'corner' => 'square' , 'rounded_value' => 0 );
	$quick_view_template_gallery_style_settings['navbar_border'] = array( 'width' => '1px', 'style' => 'solid', 'color' => $border_image_wrapper_color, 'corner' => 'square' , 'rounded_value' => 0 );
}

if ( isset( $quick_view_template_gallery_style_settings['bg_nav_color'] ) ) {
	$bg_nav_color = $quick_view_template_gallery_style_settings['bg_nav_color'];
	$quick_view_template_gallery_style_settings['navbar_bg_color'] = array( 'enable' => 1, 'color' => $bg_nav_color );
}

if ( isset( $quick_view_template_gallery_style_settings['product_gallery_bg_des'] ) ) {
	$product_gallery_bg_des = $quick_view_template_gallery_style_settings['product_gallery_bg_des'];
	$quick_view_template_gallery_style_settings['caption_bg_color'] = array( 'enable' => 1, 'color' => $product_gallery_bg_des );
}

update_option( 'quick_view_template_gallery_style_settings', $quick_view_template_gallery_style_settings );

// Set Settings Default from Admin Init
global $wc_qv_admin_init;
$wc_qv_admin_init->set_default_settings();

// Build sass
global $wc_qv_less;
$wc_qv_less->plugin_build_sass();