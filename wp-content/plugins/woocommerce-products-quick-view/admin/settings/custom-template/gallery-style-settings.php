<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Dynamic Gallery Style Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Gallery_Style_Settings extends WC_QV_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'gallery-settings';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = 'quick_view_template_gallery_style_settings';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_gallery_style_settings';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;
	
	/**
	 * @var array
	 */
	public $form_fields = array();
	
	/**
	 * @var array
	 */
	public $form_messages = array();
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Gallery Style successfully saved.', 'wooquickview' ),
				'error_message'		=> __( 'Error: Gallery Style can not save.', 'wooquickview' ),
				'reset_message'		=> __( 'Gallery Style successfully reseted.', 'wooquickview' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {
		
		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $wc_qv_admin_interface;
		
		$wc_qv_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $wc_qv_admin_interface;
		
		$wc_qv_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}
	
	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array ( 
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {
		
		$subtab_data = array( 
			'name'				=> 'gallery-style',
			'label'				=> __( 'Gallery Style', 'wooquickview' ),
			'callback_function'	=> 'wc_qv_custom_template_gallery_style_settings_form',
		);
		
		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {
	
		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();
		
		return $subtabs_array;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $wc_qv_admin_interface;
		
		$output = '';
		$output .= $wc_qv_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );
		
		return $output;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		
  		// Define settings			
     	$this->form_fields = array(
			array(
            	'name' 		=> __( 'GALLERY STYLES PREMIUM', 'wooquickview' ),
                'type' 		=> 'heading',
                'desc'		=> '<img class="rwd_image_maps" src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/premium-dynamic-gallery.png" usemap="#galleryStylesMap" style="width: auto; max-width: 100%;" border="0" />
<map name="galleryStylesMap" id="galleryStylesMap">
	<area shape="rect" coords="470,145,890,210" href="'.$this->pro_plugin_page_url.'" target="_blank" />
</map>',
				'alway_open'=> true,
                'id'		=> 'gallery_styles_premium_box',
                'is_box'	=> true,
           	),
			array(
				'name' => __('Gallery Dimensions', 'wooquickview'),
				'type' => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_dimensions_box',
				'is_box' => true,
			),
			array(
				'name' 		=> __( 'Gallery Container Height', 'wooquickview' ),
				'id' 		=> 'gallery_height_type',
				'desc'		=> __( 'Dynamic and Gallery Container height will auto adjust to the scaled height of each image.', 'wooquickview' ),
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'fixed',
				'checked_value'		=> 'fixed',
				'unchecked_value' 	=> 'dynamic',
				'checked_label'		=> __( 'FIXED', 'wooquickview' ),
				'unchecked_label' 	=> __( 'DYNAMIC', 'wooquickview' ),
			),

			array(	
				'name' => __('Gallery Image Transition Effects', 'wooquickview'),
				'desc' => __( 'Note! These settings DO NOT apply to mobile and tablet when the + Mobile and Tablet Touch Swipe feature is switched on.', 'wooquickview' ),
				'type' => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_effects_box',
				'is_box' => true,
			),
			array(  
				'name' => __( 'Auto Start', 'wooquickview' ),
				'desc' 		=> '',
				'id' 		=> 'product_gallery_auto_start',
				'default'	=> 'true',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'true',
				'unchecked_value'	=> 'false',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			array(  
				'name' => __( 'Slide Transition Effect', 'wooquickview' ),
				'desc' 		=> '',
				'id' 		=> 'product_gallery_effect',
				'css' 		=> 'width:120px;',
				'default'	=> 'slide-hori',
				'type' 		=> 'select',
				'options' => array( 
					'none'  			=> __( 'None', 'wooquickview' ),
					'fade'				=> __( 'Fade', 'wooquickview' ),
					'slide-hori'		=> __( 'Slide Hori', 'wooquickview' ),
					'slide-vert'		=> __( 'Slide Vert', 'wooquickview' ),
					'resize'			=> __( 'Resize', 'wooquickview' ),
				),
			),
			array(  
				'name' => __( 'Time Between Transitions', 'wooquickview' ),
				'desc' 		=> 'seconds',
				'id' 		=> 'product_gallery_speed',
				'type' 		=> 'slider',
				'default'	=> 5,
				'min'		=> 1,
				'max'		=> 10,
				'increment'	=> 1,
			),
			array(  
				'name' => __( 'Transition Effect Speed', 'wooquickview' ),
				'desc' 		=> 'seconds',
				'id' 		=> 'product_gallery_animation_speed',
				'type' 		=> 'slider',
				'default'	=> 2,
				'min'		=> 1,
				'max'		=> 10,
				'increment'	=> 1,
			),
			
			array(  
				'name' 		=> __( 'Single Image Transition', 'wooquickview' ),
				'desc' 		=> __( 'ON to auto deactivate image transition effect when only 1 image is loaded to gallery.', 'wooquickview' ),
				'id' 		=> 'stop_scroll_1image',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

			array(
				'name'   => __('Gallery Container', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_container_box',
				'is_box' => true,
			),
			array(
				'name' => __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'main_bg_color',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#FFFFFF' )
			),
			array(
				'name' => __( 'Border', 'wooquickview' ),
				'id' 		=> 'main_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#666', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow', 'wooquickview' ),
				'id' 		=> 'main_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '0px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#DBDBDB', 'inset' => '' )
			),
			array(
				'name' 		=> __( 'Border Margin', 'wooquickview' ),
				'desc' 		=> __( 'Margin around the Container border.', 'wooquickview' ),
				'id' 		=> 'main_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'main_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

	 								array(  'id' 		=> 'main_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'main_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'main_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
	 							)
			),
			array(
				'name' 		=> __( 'Border Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding between the main image and Container border.', 'wooquickview' ),
				'id' 		=> 'main_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'main_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

	 								array(  'id' 		=> 'main_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'main_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'main_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
	 							)
			),
			array(  
				'name' => __( 'Gallery Icon Display Type', 'wooquickview' ),
				'id' 		=> 'icons_display_type',
				'default'	=> 'hover',
				'type' 		=> 'switcher_checkbox',
				'checked_value'		=> 'show',
				'unchecked_value'	=> 'hover',
				'checked_label'		=> __( 'SHOW', 'wooquickview' ),
				'unchecked_label' 	=> __( 'ON HOVER', 'wooquickview' ),
			),

			array(
				'name'   => __('Nav Bar Control Container', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'desc' 		=> __( "ON to show a Stop Slideshow, Start Slideshow Nav Bar under the gallery in PC and Laptop browsers. If OFF Start | Stop functions are done with click image and Pause Play Icon", 'wooquickview' ),
				'id'     => 'qv_dgallery_navbar_control_box',
				'is_box' => true,
			),
			array(
				'name' 		=> __( 'Control Nav Bar', 'wooquickview' ),
				'class'		=> 'gallery_nav_control',
				'id' 		=> 'product_gallery_nav',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

			array(
				'type' 		=> 'heading',
				'class'		=> 'nav_bar_container',
			),
			array(
				'name' 		=> __( 'Font', 'wooquickview' ),
				'id' 		=> 'navbar_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#000000' )
			),
			array(
				'name' => __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'navbar_bg_color',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#FFFFFF' )
			),
			array(
				'name' => __( 'Border', 'wooquickview' ),
				'id' 		=> 'navbar_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#666', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow', 'wooquickview' ),
				'id' 		=> 'navbar_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '0px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#DBDBDB', 'inset' => '' )
			),
			array(
				'name' 		=> __( 'Border Margin', 'wooquickview' ),
				'desc' 		=> __( 'Margin around the Nav Bar border.', 'wooquickview' ),
				'id' 		=> 'navbar_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'navbar_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

	 								array(  'id' 		=> 'navbar_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'navbar_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),

									array(  'id' 		=> 'navbar_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
	 							)
			),
			array(
				'name' 		=> __( 'Border Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding between the the Text and Nav Bar border.', 'wooquickview' ),
				'id' 		=> 'navbar_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'navbar_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

	 								array(  'id' 		=> 'navbar_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'navbar_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'navbar_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),
			array(
				'name' => __( 'Vertical Separator', 'wooquickview' ),
				'id' 		=> 'navbar_separator',
				'type' 		=> 'border_styles',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#666' ),
			),

			array(
				'name'   => __('Caption Text Container', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_caption_text_box',
				'is_box' => true,
			),
			array(
				'type'   => 'heading',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' 		=> __( 'Font', 'wooquickview' ),
				'id' 		=> 'caption_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#FFFFFF' )
			),
			array(
				'name' => __( 'Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Caption text background colour.', 'wooquickview' ),
				'class'		=> 'qv_dgallery_caption_bg_color',
				'id' 		=> 'caption_bg_color',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#000000' )
			),
			array(
				'type'   => 'heading',
				'class'     => 'qv_dgallery_caption_bg_color_container',
			),
			array(
				'name'      => __( 'Background Transparency', 'wooquickview' ),
				'desc'      => '%. ' . __( 'Scale - 0 = 100% transparent - 100 = 100% Solid Colour.', 'wooquickview' ),
				'id'        => 'caption_bg_transparent',
				'type'      => 'slider',
				'default'   => 50,
				'min'       => 0,
				'max'       => 100,
				'increment' => 10,
			),

			array(
				'name'   => __('Lazy Load Scroll Bar Container', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_lazyload_scroll_bar_box',
				'is_box' => true,
			),
			array(
				'name' 		=> __( 'Scroll Bar', 'wooquickview' ),
				'class'		=> 'lazy_load_control',
				'id' 		=> 'lazy_load_scroll',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

			array(
				'type' 		=> 'heading',
				'class'		=> 'lazy_load_container',
			),
			array(
				'name' => __( 'Scroll Bar Colour', 'wooquickview' ),
				'id' 		=> 'transition_scroll_bar',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),

			array(
				'name' => __( 'Product Feature Image', 'wooquickview' ),
				'type' => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'desc' => '<ul>
<li>* '.__( 'ON this option and the Product Image (featured image) will show as the first image in the gallery without having to upload it to the Gallery.', 'wooquickview' ).'</li>
<li>* '.__( 'OFF and the uploaded Product Image (feature image) will show on the product card but not in the Gallery on Product Page.', 'wooquickview' ).'</li>
</ul>',
				'id'     => 'qv_dgallery_feature_image_box',
				'is_box' => true,
			),
			array(
				'name' 		=> __( 'Include in Gallery', 'wooquickview' ),
				'id' 		=> 'auto_feature_image',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

        );

		include_once( $this->admin_plugin_dir() . '/settings/custom-template/thumbnails-settings.php' );
		global $wc_qv_custom_template_gallery_thumbnails_settings;
		$this->form_fields = array_merge( $this->form_fields, $wc_qv_custom_template_gallery_thumbnails_settings->form_fields );

		$this->form_fields = apply_filters( $this->option_name . '_settings_fields', $this->form_fields );

	}

	public function include_script() {
		global $wc_qv_admin_interface;
		$wc_qv_admin_interface->reset_settings( $this->form_fields, $this->option_name, true, true );

		wp_enqueue_script( 'jquery-rwd-image-maps' );
?>
<style type="text/css">
	.a3rev_panel_container p.submit {
		display: none;
	}
</style>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.gallery_nav_control:checked").val() != 'yes') {
		$('.nav_bar_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}
	if ( $("input.lazy_load_control:checked").val() != 'yes') {
		$(".lazy_load_container").hide();
	}

	if ( $("input.qv_dgallery_thumb_show_type:checked").val() != 'slider') {
		$('.qv_dgallery_thumbnail_slider_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	if ( $("input.qv_dgallery_caption_bg_color:checked").val() != 1 ) {
		$('.qv_dgallery_caption_bg_color_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.gallery_nav_control', function( event, value, status ) {
		$('.nav_bar_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".nav_bar_container").slideDown();
		} else {
			$(".nav_bar_container").slideUp();
		}
	});

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.lazy_load_control', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".lazy_load_container").slideDown();
		} else {
			$(".lazy_load_container").slideUp();
		}
	});
	if ( $("input.enable_gallery_thumb:checked").val() != 'yes') {
		$(".gallery_thumb_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.enable_gallery_thumb', function( event, value, status ) {
		$('.gallery_thumb_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".gallery_thumb_container").slideDown();
		} else {
			$(".gallery_thumb_container").slideUp();
		}
	});


	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.qv_dgallery_thumb_show_type', function( event, value, status ) {
		$('.qv_dgallery_thumbnail_slider_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".qv_dgallery_thumbnail_slider_container").slideDown();
		} else {
			$(".qv_dgallery_thumbnail_slider_container").slideUp();
		}
	});

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.qv_dgallery_caption_bg_color', function( event, value, status ) {
		$('.qv_dgallery_caption_bg_color_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".qv_dgallery_caption_bg_color_container").slideDown();
		} else {
			$(".qv_dgallery_caption_bg_color_container").slideUp();
		}
	});
});
})(jQuery);
</script>
    <?php
	}

}

global $wc_qv_custom_template_gallery_style_settings;
$wc_qv_custom_template_gallery_style_settings = new WC_QV_Custom_Template_Gallery_Style_Settings();

/** 
 * wc_qv_custom_template_gallery_style_settings_form()
 * Define the callback function to show subtab content
 */
function wc_qv_custom_template_gallery_style_settings_form() {
	global $wc_qv_custom_template_gallery_style_settings;
	$wc_qv_custom_template_gallery_style_settings->settings_form();
}

?>
