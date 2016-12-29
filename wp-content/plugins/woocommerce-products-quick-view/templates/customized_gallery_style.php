<style>
<?php
global $wc_qv_admin_interface, $wc_qv_fonts_face;
global $quick_view_template_gallery_style_settings;

$g_thumb_spacing            = $quick_view_template_gallery_style_settings['thumb_spacing'];

$main_bg_color              = $quick_view_template_gallery_style_settings['main_bg_color'];
$main_border                = $quick_view_template_gallery_style_settings['main_border'];
$main_shadow                = $quick_view_template_gallery_style_settings['main_shadow'];
$main_margin_top            = $quick_view_template_gallery_style_settings['main_margin_top'];
$main_margin_bottom         = $quick_view_template_gallery_style_settings['main_margin_bottom'];
$main_margin_left           = $quick_view_template_gallery_style_settings['main_margin_left'];
$main_margin_right          = $quick_view_template_gallery_style_settings['main_margin_right'];
$main_padding_top           = $quick_view_template_gallery_style_settings['main_padding_top'];
$main_padding_bottom        = $quick_view_template_gallery_style_settings['main_padding_bottom'];
$main_padding_left          = $quick_view_template_gallery_style_settings['main_padding_left'];
$main_padding_right         = $quick_view_template_gallery_style_settings['main_padding_right'];

$navbar_font                = $quick_view_template_gallery_style_settings['navbar_font'];
$navbar_bg_color            = $quick_view_template_gallery_style_settings['navbar_bg_color'];
$navbar_border              = $quick_view_template_gallery_style_settings['navbar_border'];
$navbar_shadow              = $quick_view_template_gallery_style_settings['navbar_shadow'];
$navbar_margin_top          = $quick_view_template_gallery_style_settings['navbar_margin_top'];
$navbar_margin_bottom       = $quick_view_template_gallery_style_settings['navbar_margin_bottom'];
$navbar_margin_left         = $quick_view_template_gallery_style_settings['navbar_margin_left'];
$navbar_margin_right        = $quick_view_template_gallery_style_settings['navbar_margin_right'];
$navbar_padding_top         = $quick_view_template_gallery_style_settings['navbar_padding_top'];
$navbar_padding_bottom      = $quick_view_template_gallery_style_settings['navbar_padding_bottom'];
$navbar_padding_left        = $quick_view_template_gallery_style_settings['navbar_padding_left'];
$navbar_padding_right       = $quick_view_template_gallery_style_settings['navbar_padding_right'];

$navbar_separator           = $quick_view_template_gallery_style_settings['navbar_separator'];

$caption_font               = $quick_view_template_gallery_style_settings['caption_font'];
$caption_bg_color           = $quick_view_template_gallery_style_settings['caption_bg_color'];
$caption_bg_transparent     = $quick_view_template_gallery_style_settings['caption_bg_transparent'];

$transition_scroll_bar      = $quick_view_template_gallery_style_settings['transition_scroll_bar'];

$thumb_show_type            = $quick_view_template_gallery_style_settings['thumb_show_type'];
$thumb_border_color         = $quick_view_template_gallery_style_settings['thumb_border_color'];
$thumb_current_border_color = $quick_view_template_gallery_style_settings['thumb_current_border_color'];

?>
#TB_window {
    width: auto !important;
}
.product .onsale {
    z-index: 100;
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper {
	<?php echo $wc_qv_admin_interface->generate_background_color_css( $main_bg_color ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $main_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $main_shadow ); ?>
    margin: <?php echo $main_margin_top; ?>px <?php echo $main_margin_right; ?>px <?php echo $main_margin_bottom; ?>px <?php echo $main_margin_left; ?>px !important;
    padding: <?php echo $main_padding_top; ?>px <?php echo $main_padding_right; ?>px <?php echo $main_padding_bottom; ?>px <?php echo $main_padding_left; ?>px !important;
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-image {
    margin-top: <?php echo $main_padding_top; ?>px !important;
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-thumbs li {
    margin-right: <?php echo $g_thumb_spacing; ?>px !important;
<?php if ( 'static' == $thumb_show_type ) { ?>
    margin-bottom: <?php echo $g_thumb_spacing; ?>px !important;
<?php } ?>
}

/* Caption Text */
.quick_view_product_gallery_container .a3dg-image-wrapper .a3dg-image-description {
    <?php echo $wc_qv_fonts_face->generate_font_css( $caption_font ); ?>;
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $caption_bg_color, $caption_bg_transparent ); ?>
}

/* Navbar Separator */
.quick_view_product_gallery_container .product_gallery .a3dg-navbar-separator {
    <?php echo str_replace( 'border', 'border-left', $wc_qv_admin_interface->generate_border_style_css( $navbar_separator ) ); ?>
    margin-left: -<?php echo ( (int)$navbar_separator['width'] / 2 ); ?>px;
}

/* Navbar Control */
.quick_view_product_gallery_container .product_gallery .a3dg-navbar-control {
    <?php echo $wc_qv_fonts_face->generate_font_css( $navbar_font ); ?>
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $navbar_bg_color ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $navbar_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $navbar_shadow ); ?>
    margin: <?php echo $navbar_margin_top; ?>px <?php echo $navbar_margin_right; ?>px <?php echo $navbar_margin_bottom; ?>px <?php echo $navbar_margin_left; ?>px !important;
}
.quick_view_product_gallery_container .product_gallery .a3dg-navbar-control .slide-ctrl,
.quick_view_product_gallery_container .product_gallery .a3dg-navbar-control .icon_zoom {
    padding: <?php echo $navbar_padding_top; ?>px <?php echo $navbar_padding_right; ?>px <?php echo $navbar_padding_bottom; ?>px <?php echo $navbar_padding_left; ?>px !important;
}

/* Lazy Load Scroll */
.quick_view_product_gallery_container .a3-dgallery .lazy-load {
    background-color: <?php echo $transition_scroll_bar; ?> !important;
}

.quick_view_product_gallery_container .product_gallery .a3-dgallery .a3dg-thumbs li a {
    border: 1px solid <?php echo $thumb_border_color; ?> !important;
}

.quick_view_product_gallery_container .a3-dgallery .a3dg-thumbs li a.a3dg-active {
    border: 1px solid <?php echo $thumb_current_border_color; ?> !important;
}

<?php
global $quick_view_template_gallery_icon_styles_settings;

$icons_display_type                 = $quick_view_template_gallery_style_settings['icons_display_type'];

$nextpre_icons_size                 = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_size'];
$nextpre_icons_color                = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_color'];
$nextpre_icons_background           = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_background'];
$nextpre_icons_opacity              = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_opacity'];
$nextpre_icons_border               = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_border'];
$nextpre_icons_shadow               = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_shadow'];
$nextpre_icons_padding_top          = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_padding_top'];
$nextpre_icons_padding_bottom       = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_padding_bottom'];
$nextpre_icons_padding_left         = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_padding_left'];
$nextpre_icons_padding_right        = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_padding_right'];
$nextpre_icons_margin_left          = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_margin_left'];
$nextpre_icons_margin_right         = $quick_view_template_gallery_icon_styles_settings['nextpre_icons_margin_right'];

$pauseplay_icon_size                = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_size'];
$pauseplay_icon_color               = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_color'];
$pauseplay_icon_background          = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_background'];
$pauseplay_icon_opacity             = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_opacity'];
$pauseplay_icon_border              = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_border'];
$pauseplay_icon_shadow              = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_shadow'];
$pauseplay_icon_padding_top         = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_padding_top'];
$pauseplay_icon_padding_bottom      = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_padding_bottom'];
$pauseplay_icon_padding_left        = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_padding_left'];
$pauseplay_icon_padding_right       = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_padding_right'];
$pauseplay_icon_margin_top          = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_margin_top'];
$pauseplay_icon_margin_bottom       = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_margin_bottom'];
$pauseplay_icon_margin_left         = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_margin_left'];
$pauseplay_icon_margin_right        = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_margin_right'];
$pauseplay_icon_vertical_position   = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_vertical_position'];
$pauseplay_icon_horizontal_position = $quick_view_template_gallery_icon_styles_settings['pauseplay_icon_horizontal_position'];

$thumb_nextpre_icons_size           = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_size'];
$thumb_nextpre_icons_color          = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_color'];
$thumb_nextpre_icons_background     = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_background'];
$thumb_nextpre_icons_border         = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_border'];
$thumb_nextpre_icons_shadow         = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_shadow'];
$thumb_nextpre_icons_padding_left   = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_padding_left'];
$thumb_nextpre_icons_padding_right  = $quick_view_template_gallery_icon_styles_settings['thumb_nextpre_icons_padding_right'];

$thumb_slider_background            = $quick_view_template_gallery_style_settings['thumb_slider_background'];
$thumb_slider_border                = $quick_view_template_gallery_style_settings['thumb_slider_border'];
$thumb_slider_shadow                = $quick_view_template_gallery_style_settings['thumb_slider_shadow'];

?>

<?php if ( 'show' == $icons_display_type ) { ?>
.quick_view_product_gallery_container .a3dg-image-wrapper .slide-ctrl,
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-next,
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-prev {
    display: block !important;
}
<?php } ?>

/* Next / Previous Icons */
.quick_view_product_gallery_container .a3-dgallery .fa-caret-left:before,
.quick_view_product_gallery_container .a3-dgallery .fa-caret-right:before  {
    font-size: <?php echo $nextpre_icons_size; ?>px !important;
    color: <?php echo $nextpre_icons_color; ?> !important;
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-next,
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-prev {
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $nextpre_icons_background ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $nextpre_icons_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $nextpre_icons_shadow ); ?>
    padding: <?php echo $nextpre_icons_padding_top; ?>px <?php echo $nextpre_icons_padding_right; ?>px <?php echo $nextpre_icons_padding_bottom; ?>px <?php echo $nextpre_icons_padding_left; ?>px !important;
    <?php if ( isset( $nextpre_icons_background['enable'] ) && 0 == $nextpre_icons_background['enable'] ) { ?>
    opacity: 1 !important;
    <?php } else { ?>
    opacity: <?php echo ( $nextpre_icons_opacity / 100 ); ?> !important;
    <?php } ?>
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-prev {
    left: <?php echo $nextpre_icons_margin_left; ?>px !important;
}
.quick_view_product_gallery_container .a3-dgallery .a3dg-image-wrapper .a3dg-next {
    right: <?php echo $nextpre_icons_margin_right; ?>px !important;
}

/* Pause | Play icon */
.quick_view_product_gallery_container .a3-dgallery .fa-pause:before,
.quick_view_product_gallery_container .a3-dgallery .fa-play:before  {
    font-size: <?php echo $pauseplay_icon_size; ?>px !important;
    color: <?php echo $pauseplay_icon_color; ?> !important;
}

.quick_view_product_gallery_container .a3dg-image-wrapper .slide-ctrl .a3dg-slideshow-start-slide,
.quick_view_product_gallery_container .a3dg-image-wrapper .slide-ctrl .a3dg-slideshow-stop-slide {
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $pauseplay_icon_background ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $pauseplay_icon_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $pauseplay_icon_shadow ); ?>
    padding: <?php echo $pauseplay_icon_padding_top; ?>px <?php echo $pauseplay_icon_padding_right; ?>px <?php echo $pauseplay_icon_padding_bottom; ?>px <?php echo $pauseplay_icon_padding_left; ?>px !important;
    <?php if ( isset( $pauseplay_icon_background['enable'] ) && 0 == $pauseplay_icon_background['enable'] ) { ?>
    opacity: 1 !important;
    <?php } else { ?>
    opacity: <?php echo ( $pauseplay_icon_opacity / 100 ); ?> !important;
    <?php } ?>
}

.quick_view_product_gallery_container .a3dg-image-wrapper .slide-ctrl {

<?php if ( 'top' == $pauseplay_icon_vertical_position ) { ?>
top: 0 !important;
margin-top: <?php echo $pauseplay_icon_margin_top; ?>px !important;
<?php } elseif ( 'bottom' == $pauseplay_icon_vertical_position ) { ?>
top: auto !important;
bottom: 0 !important;
margin-bottom: <?php echo $pauseplay_icon_margin_bottom; ?>px !important;
<?php } ?>

<?php if ( 'left' == $pauseplay_icon_horizontal_position ) { ?>
left: 0 !important;
margin-left: <?php echo $pauseplay_icon_margin_left; ?>px !important;
<?php } elseif ( 'right' == $pauseplay_icon_horizontal_position ) { ?>
left: auto !important;
right: 0 !important;
margin-right: <?php echo $pauseplay_icon_margin_right; ?>px !important;
<?php } ?>
}

/* Thumbnail Slider Next / Previous icons */
.quick_view_product_gallery_container .a3-dgallery .fa-angle-left:before,
.quick_view_product_gallery_container .a3-dgallery .fa-angle-right:before  {
    font-size: <?php echo $thumb_nextpre_icons_size; ?>px !important;
    color: <?php echo $thumb_nextpre_icons_color; ?> !important;
}

.quick_view_product_gallery_container .a3-dgallery .a3dg-forward,
.quick_view_product_gallery_container .a3-dgallery .a3dg-back {
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $thumb_nextpre_icons_background ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $thumb_nextpre_icons_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $thumb_nextpre_icons_shadow ); ?>
    padding-left: <?php echo $thumb_nextpre_icons_padding_left; ?>px !important;
    padding-right: <?php echo $thumb_nextpre_icons_padding_right; ?>px !important;
}

<?php if ( 'slider' == $thumb_show_type ) { ?>
/* Thumbnail Slider Container */
.quick_view_product_gallery_container .a3-dgallery .a3dg-nav {
    <?php echo $wc_qv_admin_interface->generate_background_color_css( $thumb_slider_background ); ?>
    <?php echo $wc_qv_admin_interface->generate_border_css( $thumb_slider_border ); ?>
    <?php echo $wc_qv_admin_interface->generate_shadow_css( $thumb_slider_shadow ); ?>
}
<?php } ?>

</style>
