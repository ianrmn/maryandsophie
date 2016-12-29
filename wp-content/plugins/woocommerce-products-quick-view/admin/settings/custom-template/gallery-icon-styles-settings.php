<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Dynamic Gallery Icon Settings

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

class WC_QV_Custom_Template_Gallery_Icon_Styles_Settings extends WC_QV_Admin_UI
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
	public $option_name = 'quick_view_template_gallery_icon_styles_settings';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_gallery_icon_styles_settings';
	
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
				'success_message'	=> __( 'Dynamic Gallery Icon Styles successfully saved.', 'wooquickview' ),
				'error_message'		=> __( 'Error: Dynamic Gallery Icon Styles can not save.', 'wooquickview' ),
				'reset_message'		=> __( 'Dynamic Gallery Icon Styles successfully reseted.', 'wooquickview' ),
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
			'name'				=> 'gallery-icon-styles',
			'label'				=> __( 'Icon Styles', 'wooquickview' ),
			'callback_function'	=> 'wc_qv_custom_template_gallery_icon_settings_form',
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
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
     		array(
            	'name' 		=> __( 'GALLERY ICON STYLES PREMIUM', 'wooquickview' ),
                'type' 		=> 'heading',
                'desc'		=> '<img class="rwd_image_maps" src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/premium-gallery-icons.png" usemap="#galleryIconMap" style="width: auto; max-width: 100%;" border="0" />
<map name="galleryIconMap" id="galleryIconMap">
	<area shape="rect" coords="445,135,890,200" href="'.$this->pro_plugin_page_url.'" target="_blank" />
</map>',
				'alway_open'=> true,
                'id'		=> 'gallery_icon_styles_premium_box',
                'is_box'	=> true,
           	),

			array(
				'name'   => __('Next / Previous Gallery Icons', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_next_pre_icons_box',
				'is_box' => true,
			),

			array(
				'type'   => 'heading',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' => __( 'Arrow Icons Size', 'wooquickview' ),
				'desc' 		=> "px",
				'id' 		=> 'nextpre_icons_size',
				'type' 		=> 'slider',
				'default'	=> 30,
				'min'		=> 10,
				'max'		=> 50,
				'increment'	=> 1,
			),
			array(
				'name' 		=> __( 'Arrow Icon Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'nextpre_icons_color',
				'type' 		=> 'color',
				'default'	=> '#000'
			),
			array(
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_background',
				'class'		=> 'qv_dgallery_nextpre_icons_background',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#FFF' )
			),

			array(
				'type'   => 'heading',
				'class'     => 'qv_dgallery_nextpre_icons_background_container',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' => __( 'Background Transparency', 'wooquickview' ),
				'desc' 		=> "%. " . __( '100% = Full Colour', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_opacity',
				'type' 		=> 'slider',
				'default'	=> 70,
				'min'		=> 0,
				'max'		=> 100,
				'increment'	=> 10,
			),

			array(
				'type'   => 'heading',
			),
			array(
				'name' 		=> __( 'Border', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '0px', 'style' => 'solid', 'color' => '#666', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '1px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#555555', 'inset' => 'inset' )
			),
			array(
				'name' 		=> __( 'Border Margin', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
									array(  'id' 		=> 'nextpre_icons_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

									array(  'id' 		=> 'nextpre_icons_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),
	 							)
			),
			array(
				'name' 		=> __( 'Border Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding between the Icon and Container border.', 'wooquickview' ),
				'id' 		=> 'nextpre_icons_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'nextpre_icons_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

	 								array(  'id' 		=> 'nextpre_icons_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'nextpre_icons_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'nextpre_icons_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),

			array(
				'name'   => __('Pause | Play Icon', 'wooquickview'),
				'desc'   => __('This control icons will show when is viewing on Mobile or when the Control Nav Bar is turn OFF.', 'wooquickview'),
				'type'   => 'heading',
				'class'		=> 'pro_feature_fields pro_feature_hidden',
				'id'     => 'qv_dgallery_pauseplay_icon_box',
				'is_box' => true,
			),

			array(
				'type'   => 'heading',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' => __( 'Icon Size', 'wooquickview' ),
				'desc' 		=> "px",
				'id' 		=> 'pauseplay_icon_size',
				'type' 		=> 'slider',
				'default'	=> 25,
				'min'		=> 10,
				'max'		=> 50,
				'increment'	=> 1,
			),
			array(
				'name' 		=> __( 'Icon Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'pauseplay_icon_color',
				'type' 		=> 'color',
				'default'	=> '#000'
			),
			array(
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_background',
				'class'		=> 'qv_dgallery_pauseplay_icon_background',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#FFF' )
			),

			array(
				'type'   => 'heading',
				'class'		=> 'qv_dgallery_pauseplay_icon_background_container',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' => __( 'Background Transparency', 'wooquickview' ),
				'desc' 		=> "%. " . __( '100% = Full Colour', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_opacity',
				'type' 		=> 'slider',
				'default'	=> 70,
				'min'		=> 0,
				'max'		=> 100,
				'increment'	=> 10,
			),

			array(
				'type'   => 'heading',
				'css'		=> 'padding-bottom: 0px;',
			),
			array(
				'name' 		=> __( 'Border', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '0px', 'style' => 'solid', 'color' => '#666', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '1px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#555555', 'inset' => 'inset' )
			),
			array(
				'name' 		=> __( 'Border Margin', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'pauseplay_icon_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

	 								array(  'id' 		=> 'pauseplay_icon_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

									array(  'id' 		=> 'pauseplay_icon_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

									array(  'id' 		=> 'pauseplay_icon_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),
	 							)
			),
			array(
				'name' 		=> __( 'Border Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding between the Icon and Container border.', 'wooquickview' ),
				'id' 		=> 'pauseplay_icon_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
	 								array(  'id' 		=> 'pauseplay_icon_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

	 								array(  'id' 		=> 'pauseplay_icon_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

									array(  'id' 		=> 'pauseplay_icon_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),

									array(  'id' 		=> 'pauseplay_icon_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '10' ),
	 							)
			),

			array(
				'name' => __( 'Vertical Position', 'wooquickview' ),
				'desc' 		=> '',
				'id' 		=> 'pauseplay_icon_vertical_position',
				'default'	=> 'center',
				'type' 		=> 'onoff_radio',
				'onoff_options' => array(
					array(
						'val' => 'top',
						'text' => __( 'Top', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
					array(
						'val' => 'center',
						'text' => __( 'Middle', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
					array(
						'val' => 'bottom',
						'text' => __( 'Bottom', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
				),
			),
			array(
				'name' => __( 'Horizontal Position', 'wooquickview' ),
				'desc' 		=> '',
				'id' 		=> 'pauseplay_icon_horizontal_position',
				'default'	=> 'center',
				'type' 		=> 'onoff_radio',
				'onoff_options' => array(
					array(
						'val' => 'left',
						'text' => __( 'Left', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
					array(
						'val' => 'center',
						'text' => __( 'Center', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
					array(
						'val' => 'right',
						'text' => __( 'Right', 'wooquickview' ),
						'checked_label'	=> 'ON',
						'unchecked_label' => 'OFF',
					),
				),
			),

			array(
            	'name' 		=> __('Thumbnail Slider Arrows', 'wooquickview'),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'     => 'qv_dgallery_thumbnail_slider_arrows_box',
				'is_box' => true,
           	),
			array(
				'name' => __( 'Arrow Icons Size', 'wooquickview' ),
				'desc' 		=> "px",
				'id' 		=> 'thumb_nextpre_icons_size',
				'type' 		=> 'slider',
				'default'	=> 20,
				'min'		=> 10,
				'max'		=> 50,
				'increment'	=> 1,
			),
			array(
				'name' 		=> __( 'Arrow Icon Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'thumb_nextpre_icons_color',
				'type' 		=> 'color',
				'default'	=> '#000'
			),
			array(
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'thumb_nextpre_icons_background',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#FFF' )
			),
			array(
				'name' 		=> __( 'Border', 'wooquickview' ),
				'id' 		=> 'thumb_nextpre_icons_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#666', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow', 'wooquickview' ),
				'id' 		=> 'thumb_nextpre_icons_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '1px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#555555', 'inset' => 'inset' )
			),
			array(
				'name' 		=> __( 'Border Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding between the Icon and Container border.', 'wooquickview' ),
				'id' 		=> 'thumb_nextpre_icons_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
									array(  'id' 		=> 'thumb_nextpre_icons_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'thumb_nextpre_icons_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),

        ) );
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
	if ( $("input.qv_dgallery_nextpre_icons_background:checked").val() != 1 ) {
		$('.qv_dgallery_nextpre_icons_background_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	if ( $("input.qv_dgallery_pauseplay_icon_background:checked").val() != 1 ) {
		$('.qv_dgallery_pauseplay_icon_background_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.qv_dgallery_nextpre_icons_background', function( event, value, status ) {
		$('.qv_dgallery_nextpre_icons_background_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".qv_dgallery_nextpre_icons_background_container").slideDown();
		} else {
			$(".qv_dgallery_nextpre_icons_background_container").slideUp();
		}
	});

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.qv_dgallery_pauseplay_icon_background', function( event, value, status ) {
		$('.qv_dgallery_pauseplay_icon_background_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".qv_dgallery_pauseplay_icon_background_container").slideDown();
		} else {
			$(".qv_dgallery_pauseplay_icon_background_container").slideUp();
		}
	});
});
})(jQuery);
</script>
<?php
	}
}

global $wc_qv_custom_template_gallery_icon_settings;
$wc_qv_custom_template_gallery_icon_settings = new WC_QV_Custom_Template_Gallery_Icon_Styles_Settings();

/** 
 * qv_dgallery_style_settings_form()
 * Define the callback function to show subtab content
 */
function wc_qv_custom_template_gallery_icon_settings_form() {
	global $wc_qv_custom_template_gallery_icon_settings;
	$wc_qv_custom_template_gallery_icon_settings->settings_form();
}

?>