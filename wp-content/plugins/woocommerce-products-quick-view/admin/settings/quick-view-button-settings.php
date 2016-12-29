<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Button Settings

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

class WC_QV_Button_Settings extends WC_QV_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'quick-view-button';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = '';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wc_quick_view_button_style';
	
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
				'success_message'	=> __( 'Quick View Button successfully saved.', 'wooquickview' ),
				'error_message'		=> __( 'Error: Quick View Button can not save.', 'wooquickview' ),
				'reset_message'		=> __( 'Quick View Button successfully reseted.', 'wooquickview' ),
			);

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );

		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
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
			'name'				=> 'quick-view-button-settings',
			'label'				=> __( 'Quick View Button', 'wooquickview' ),
			'callback_function'	=> 'wc_qv_button_settings_form',
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
     	$this->form_fields = apply_filters( $this->form_key . '_settings_fields', array(

			array(
            	'name' => __( 'Set Display Type', 'wooquickview' ),
                'type' => 'heading',
                'class'=> 'quick_view_ultimate_container',
                'id'		=> 'quick_view_button_display_type_box',
                'first_open'=> true,
                'is_box'	=> true,
           	),
			array(
				'name' 		=> __( "Show Quick View as", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_type',
				'class'		=> 'quick_view_ultimate_type',
				'type' 		=> 'onoff_radio',
				'default'	=> 'hover',
				'onoff_options' => array(
					array(
						'val' 				=> 'hover',
						'text'				=> __( 'Button that shows on mouse hover on product image', 'wooquickview' ) ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),

					array(
						'val' 				=> 'under',
						'text' 				=> __( 'Show as button or link text under image', 'wooquickview' ) ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					)
				),
			),

			array(
            	'name' => __( 'Button Show On Hover', 'wooquickview' ),
                'type' => 'heading',
                'class'		=> 'qv_button_hover_container',
                'id'		=> 'qv_button_hover_box',
                'is_box'	=> true,
           	),
           	array(  
				'name' 		=> __( 'Button Align', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_alink',
				'css' 		=> 'width:80px;',
				'type' 		=> 'select',
				'default'	=> 'center',
				'options'	=> array(
						'top'			=> __( 'Top', 'wooquickview' ) ,	
						'center'		=> __( 'Center', 'wooquickview' ) ,	
						'bottom'		=> __( 'Bottom', 'wooquickview' ) ,	
					),
			),
			array(  
				'name' => __( 'Button Text', 'wooquickview' ),
				'desc' 		=> __('Text for Quick View Button Show On Hover', 'wooquickview'),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_text',
				'type' 		=> 'text',
				'default'	=> __('QUICKVIEW', 'wooquickview')
			),
			array(  
				'name' 		=> __( 'Button Font', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '14px', 'line_height' => '1.4em', 'face' => 'Arial', 'style' => 'normal', 'color' => '#FFFFFF' )
			),
			array(  
				'name' => __( 'Button Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding from Button text to Button border Show On Hover', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'quick_view_ultimate_on_hover_bt_padding_tb',
	 										'name' 		=> __( 'Top/Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '7' ),
	 
	 								array(  'id' 		=> 'quick_view_ultimate_on_hover_bt_padding_lr',
	 										'name' 		=> __( 'Left/Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '17' ),
	 							)
			),
			
			array(  
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview') . ' [default_value]',
				'id' 		=> 'quick_view_ultimate_on_hover_bt_bg',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ). ' [default_value]',
				'id' 		=> 'quick_view_ultimate_on_hover_bt_bg_from',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ). ' [default_value]',
				'id' 		=> 'quick_view_ultimate_on_hover_bt_bg_to',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			array(  
				'name' 		=> __( 'Button Transparency', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_transparent',
				'desc'		=> '%',
				'type' 		=> 'slider',
				'default'	=> 50,
				'min'		=> 0,
				'max'		=> 100,
				'increment'	=> 10
			),
			array(  
				'name' 		=> __( 'Button Border', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#FFFFFF', 'corner' => 'rounded' , 'rounded_value' => 3 ),
			),
			array(  
				'name' => __( 'Button Shadow', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_on_hover_bt_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),


			array(
            	'name' => __( 'Button/Hyperlink Show under Image', 'wooquickview' ),
                'type' => 'heading',
                'class'		=> 'qv_button_under_image_container',
                'id'		=> 'qv_button_under_image_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Quick View Type', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_type',
				'class' 	=> 'quick_view_ultimate_under_image_change',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'link',
				'checked_value'		=> 'link',
				'unchecked_value'	=> 'button',
				'checked_label'		=> __( 'Hyperlink', 'wooquickview' ),
				'unchecked_label' 	=> __( 'Button', 'wooquickview' ),
			),
			array(  
				'name' 		=> __( 'Horizontal Align', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_alink',
				'css' 		=> 'width:80px;',
				'type' 		=> 'select',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wooquickview' ) ,	
						'left'			=> __( 'Left', 'wooquickview' ) ,	
						'right'			=> __( 'Right', 'wooquickview' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Magrin', 'wooquickview' ),
				'desc' 		=> 'px '. __( 'Above/Below', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_margin',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '10'
			),
			
			array(
            	'name' 		=> '',
                'type' 		=> 'heading',
          		'class'		=> 'show_under_image_hyperlink_styling'
           	),
			array(  
				'name' => __( 'Hyperlink Text', 'wooquickview' ),
				'desc' 		=> __( 'Text for Hyperlink show under image', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_link_text',
				'type' 		=> 'text',
				'default'	=> __('Quick View', 'wooquickview')
			),
			array(  
				'name' 		=> __( 'Hyperlink Font', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_link_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial', 'style' => 'bold', 'color' => '#000000' )
			),
			
			array(  
				'name' 		=> __( 'Hyperlink Hover Colour', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_link_font_hover_color',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			
			array(
            	'name' 		=> '',
                'type' 		=> 'heading',
          		'class' 	=> 'show_under_image_button_styling'
           	),
			array(  
				'name' 		=> __( 'Button Text', 'wooquickview' ),
				'desc' 		=> __( 'Text for Button show under image', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_text',
				'type' 		=> 'text',
				'default'	=> __('Quick View', 'wooquickview')
			),
			array(  
				'name' 		=> __( 'Button Font', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial', 'style' => 'bold', 'color' => '#FFFFFF' )
			),
			array(  
				'name' 		=> __( 'Button Padding', 'wooquickview' ),
				'desc' 		=> __( 'Padding from Button text to Button border show under image', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'quick_view_ultimate_under_image_bt_padding_tb',
	 										'name' 		=> __( 'Top/Bottom', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '7' ),
	 
	 								array(  'id' 		=> 'quick_view_ultimate_under_image_bt_padding_lr',
	 										'name' 		=> __( 'Left/Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '8' ),
	 							)
			),
			array(  
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quick_view_ultimate_under_image_bt_bg',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quick_view_ultimate_under_image_bt_bg_from',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quick_view_ultimate_under_image_bt_bg_to',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),
			array(  
				'name' 		=> __( 'Button Border', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_under_image_bt_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#000000', 'corner' => 'rounded' , 'rounded_value' => 3 ),
			),
        ));
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {

	if ( $("input.quick_view_ultimate_type:checked").val() == 'hover') {
		$(".qv_button_under_image_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".qv_button_hover_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	$(document).on( "a3rev-ui-onoff_radio-switch", '.quick_view_ultimate_type', function( event, value, status ) {
		$(".qv_button_under_image_container").attr('style','display:none;');
		$(".qv_button_hover_container").attr('style','display:none;');
		if ( value == 'hover' && status == 'true' ) {
			$(".qv_button_hover_container").slideDown();
			$(".qv_button_under_image_container").slideUp();
		} else if ( status == 'true' ) {
			$(".qv_button_hover_container").slideUp();
			$(".qv_button_under_image_container").slideDown();
		}
	});

	if ( $("input[name='quick_view_ultimate_under_image_bt_type']:checked").val() == 'link') {
		$(".show_under_image_button_styling").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".show_under_image_hyperlink_styling").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.quick_view_ultimate_under_image_change', function( event, value, status ) {
		$(".show_under_image_hyperlink_styling").attr('style','display:none;');
		$(".show_under_image_button_styling").attr('style','display:none;');
		if ( status == 'true') {
			$(".show_under_image_hyperlink_styling").slideDown();
			$(".show_under_image_button_styling").slideUp();
		} else {
			$(".show_under_image_hyperlink_styling").slideUp();
			$(".show_under_image_button_styling").slideDown();
		}
	});
});
})(jQuery);
</script>
    <?php
	}
}

global $wc_qv_button_settings;
$wc_qv_button_settings = new WC_QV_Button_Settings();

/** 
 * wc_qv_hover_position_style_settings_form()
 * Define the callback function to show subtab content
 */
function wc_qv_button_settings_form() {
	global $wc_qv_button_settings;
	$wc_qv_button_settings->settings_form();
}

?>