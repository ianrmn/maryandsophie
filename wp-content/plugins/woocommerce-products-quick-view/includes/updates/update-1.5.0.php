<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$quick_view_template_global_settings = get_option( 'quick_view_template_global_settings', array() );

$quick_view_template_control_settings = get_option( 'quick_view_template_control_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_control_settings, $quick_view_template_global_settings );

$quick_view_template_product_title_settings = get_option( 'quick_view_template_product_title_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_product_title_settings, $quick_view_template_global_settings );

$quick_view_template_product_rating_settings = get_option( 'quick_view_template_product_rating_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_product_rating_settings, $quick_view_template_global_settings );

$quick_view_template_product_description_settings = get_option( 'quick_view_template_product_description_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_product_description_settings, $quick_view_template_global_settings );

$quick_view_template_product_meta_settings = get_option( 'quick_view_template_product_meta_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_product_meta_settings, $quick_view_template_global_settings );

$quick_view_template_product_price_settings = get_option( 'quick_view_template_product_price_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_product_price_settings, $quick_view_template_global_settings );

$quick_view_template_quantity_selector_settings = get_option( 'quick_view_template_quantity_selector_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_quantity_selector_settings, $quick_view_template_global_settings );

$quick_view_template_addtocart_settings = get_option( 'quick_view_template_addtocart_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_addtocart_settings, $quick_view_template_global_settings );

$quick_view_template_readmore_settings = get_option( 'quick_view_template_readmore_settings', array() );
$quick_view_template_global_settings = array_merge( $quick_view_template_readmore_settings, $quick_view_template_global_settings );


update_option( 'quick_view_template_global_settings', $quick_view_template_global_settings );


$quick_view_template_gallery_style_settings = get_option( 'quick_view_template_gallery_style_settings', array() );

$quick_view_template_gallery_thumbnails_settings = get_option( 'quick_view_template_gallery_thumbnails_settings', array() );

$quick_view_template_gallery_style_settings = array_merge( $quick_view_template_gallery_thumbnails_settings, $quick_view_template_gallery_style_settings );

update_option( 'quick_view_template_gallery_style_settings', $quick_view_template_gallery_style_settings );


// Set Settings Default from Admin Init
global $wc_qv_admin_init;
$wc_qv_admin_init->set_default_settings();

// Build sass
global $wc_qv_less;
$wc_qv_less->plugin_build_sass();