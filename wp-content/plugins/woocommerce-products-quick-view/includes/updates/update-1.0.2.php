<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$quick_view_ultimate_on_hover_bt_border_width = get_option( 'quick_view_ultimate_on_hover_bt_border_width' );
$quick_view_ultimate_on_hover_bt_border_style = get_option( 'quick_view_ultimate_on_hover_bt_border_style' );
$quick_view_ultimate_on_hover_bt_border_color = get_option( 'quick_view_ultimate_on_hover_bt_border_color' );
$quick_view_ultimate_on_hover_bt_rounded = get_option( 'quick_view_ultimate_on_hover_bt_rounded' );
$quick_view_ultimate_on_hover_bt = array(
	'width' 	=> $quick_view_ultimate_on_hover_bt_border_width . 'px',
	'style'		=> $quick_view_ultimate_on_hover_bt_border_style,
	'color'		=> $quick_view_ultimate_on_hover_bt_border_color,
	'corner'	=> ( $quick_view_ultimate_on_hover_bt_rounded > 0) ? 'rounded' : 'square',
	'rounded_value' => $quick_view_ultimate_on_hover_bt_rounded
);
update_option( 'quick_view_ultimate_on_hover_bt_border', $quick_view_ultimate_on_hover_bt );

$quick_view_ultimate_on_hover_bt_font_family = get_option( 'quick_view_ultimate_on_hover_bt_font_family' );
$quick_view_ultimate_on_hover_bt_font_size = get_option( 'quick_view_ultimate_on_hover_bt_font_size' );
$quick_view_ultimate_on_hover_bt_font_style = get_option( 'quick_view_ultimate_on_hover_bt_font_style' );
$quick_view_ultimate_on_hover_bt_font_color = get_option( 'quick_view_ultimate_on_hover_bt_font_color' );
$quick_view_ultimate_on_hover_bt_font = array(
	'size' 		=> $quick_view_ultimate_on_hover_bt_font_size . 'px',
	'face'		=> $quick_view_ultimate_on_hover_bt_font_family,
	'style'		=> $quick_view_ultimate_on_hover_bt_font_style,
	'color' 	=> $quick_view_ultimate_on_hover_bt_font_color
);
update_option( 'quick_view_ultimate_on_hover_bt_font', $quick_view_ultimate_on_hover_bt_font );

$quick_view_ultimate_on_hover_bt_enable_shadow = get_option( 'quick_view_ultimate_on_hover_bt_enable_shadow' );
$quick_view_ultimate_on_hover_bt_shadow_color = get_option( 'quick_view_ultimate_on_hover_bt_shadow_color' );
$quick_view_ultimate_on_hover_bt_shadow = array(
	'enable'	=> ( $quick_view_ultimate_on_hover_bt_enable_shadow == 'yes' ) ? 1 : 0,
	'h_shadow'	=> '0px',
	'v_shadow'	=> '0px',
	'blur' 		=> '30px',
	'spread'	=> '0px',
	'color'		=> $quick_view_ultimate_on_hover_bt_shadow_color,
	'inset'		=> '',

);
update_option( 'quick_view_ultimate_on_hover_bt_shadow', $quick_view_ultimate_on_hover_bt_shadow );

$quick_view_ultimate_on_hover_bt_transparent = get_option( 'quick_view_ultimate_on_hover_bt_transparent' );
$quick_view_ultimate_on_hover_bt_transparent = $quick_view_ultimate_on_hover_bt_transparent * 10;
update_option( 'quick_view_ultimate_on_hover_bt_transparent', $quick_view_ultimate_on_hover_bt_transparent );

$quick_view_ultimate_under_image_link_font_family = get_option( 'quick_view_ultimate_under_image_link_font_family' );
$quick_view_ultimate_under_image_link_font_size = get_option( 'quick_view_ultimate_under_image_link_font_size' );
$quick_view_ultimate_under_image_link_font_style = get_option( 'quick_view_ultimate_under_image_link_font_style' );
$quick_view_ultimate_under_image_link_font_color = get_option( 'quick_view_ultimate_under_image_link_font_color' );
$quick_view_ultimate_under_image_link_font = array(
	'size' 		=> $quick_view_ultimate_under_image_link_font_size . 'px',
	'face'		=> $quick_view_ultimate_under_image_link_font_family,
	'style'		=> $quick_view_ultimate_under_image_link_font_style,
	'color' 	=> $quick_view_ultimate_under_image_link_font_color
);
update_option( 'quick_view_ultimate_under_image_link_font', $quick_view_ultimate_under_image_link_font );

$quick_view_ultimate_under_image_bt_border_width = get_option( 'quick_view_ultimate_under_image_bt_border_width' );
$quick_view_ultimate_under_image_bt_border_style = get_option( 'quick_view_ultimate_under_image_bt_border_style' );
$quick_view_ultimate_under_image_bt_border_color = get_option( 'quick_view_ultimate_under_image_bt_border_color' );
$quick_view_ultimate_under_image_bt_rounded = get_option( 'quick_view_ultimate_under_image_bt_rounded' );
$quick_view_ultimate_under_image_bt_border = array(
	'width' 	=> $quick_view_ultimate_under_image_bt_border_width . 'px',
	'style'		=> $quick_view_ultimate_under_image_bt_border_style,
	'color'		=> $quick_view_ultimate_under_image_bt_border_color,
	'corner'	=> ( $quick_view_ultimate_under_image_bt_rounded > 0) ? 'rounded' : 'square',
	'rounded_value' => $quick_view_ultimate_under_image_bt_rounded
);
update_option( 'quick_view_ultimate_under_image_bt_border', $quick_view_ultimate_under_image_bt_border );

$quick_view_ultimate_under_image_bt_font_family = get_option( 'quick_view_ultimate_under_image_bt_font_family' );
$quick_view_ultimate_under_image_bt_font_size = get_option( 'quick_view_ultimate_under_image_bt_font_size' );
$quick_view_ultimate_under_image_bt_font_style = get_option( 'quick_view_ultimate_under_image_bt_font_style' );
$quick_view_ultimate_under_image_bt_font_color = get_option( 'quick_view_ultimate_under_image_bt_font_color' );
$quick_view_ultimate_under_image_bt_font = array(
	'size' 		=> $quick_view_ultimate_under_image_bt_font_size . 'px',
	'face'		=> $quick_view_ultimate_under_image_bt_font_family,
	'style'		=> $quick_view_ultimate_under_image_bt_font_style,
	'color' 	=> $quick_view_ultimate_under_image_bt_font_color
);
update_option( 'quick_view_ultimate_under_image_bt_font', $quick_view_ultimate_under_image_bt_font );