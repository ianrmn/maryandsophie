<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Fancybox Popup Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Fancybox_Popup_Settings
{
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wc_quick_view_fancybox_popup_settings';

	/**
	 * @var array
	 */
	public $form_fields = array();

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {

  		// Define settings
     	$this->form_fields = apply_filters( $this->form_key . '_settings_fields', array(

			array(
            	'name' 		=> __( 'Fancy Box Pop Up', 'wooquickview' ),
                'type' 		=> 'heading',
                'class'		=> 'quick_view_fancybox_popup_container',
                'id'		=> 'quick_view_fancybox_popup_box',
				'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Pop-up Maximum Width', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_popup_width',
				'desc'		=> 'px',
				'type' 		=> 'slider',
				'default'	=> 600,
				'min'		=> 520,
				'max'		=> 800,
				'increment'	=> 10
			),
			array(  
				'name' 		=> __( 'Pop-up Maximum Height', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_popup_height',
				'desc'		=> 'px',
				'type' 		=> 'slider',
				'default'	=> 500,
				'min'		=> 300,
				'max'		=> 500,
				'increment'	=> 10
			),
			array(  
				'name' 		=> __( "Fix Position on Scroll", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_center_on_scroll',
				'type' 		=> 'onoff_radio',
				'default'	=> 'true',
				'onoff_options' => array(
					array(
						'val' 				=> 'true',
						'text'				=> __( 'Pop-up stays centered in screen while page scrolls behind it.', 'wooquickview' ) ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),
					
					array(
						'val' 				=> 'false',
						'text' 				=> __( 'Pop-up scrolls up and down with the page.', 'wooquickview' ) ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					) 
				),
			),
			array(  
				'name' 		=> __( 'Open Transition Effect', 'wooquickview' ),
				'desc' 		=> __( "Choose a pop-up opening effect. Default - None.", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_transition_in',
				'css' 		=> 'width:80px;',
				'type' 		=> 'select',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'None', 'wooquickview' ) ,	
						'fade'			=> __( 'Fade', 'wooquickview' ) ,	
						'elastic'		=> __( 'Elastic', 'wooquickview' ) ,
					),
			),
			array(  
				'name' 		=> __( 'Close Transistion Effect', 'wooquickview' ),
				'desc' 		=> __( "Choose a pop-up closing effect. Default - None.", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_transition_out',
				'css' 		=> 'width:80px;',
				'type' 		=> 'select',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'None', 'wooquickview' ) ,	
						'fade'			=> __( 'Fade', 'wooquickview' ) ,	
						'elastic'		=> __( 'Elastic', 'wooquickview' ) ,
					),
			),
			array(  
				'name' 		=> __( 'Opening Speed', 'wooquickview' ),
				'desc' 		=> __( 'Milliseconds when open popup', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_speed_in',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '300'
			),
			array(  
				'name' 		=> __( 'Closing Speed', 'wooquickview' ),
				'desc' 		=> __( 'Milliseconds when close popup', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_fancybox_speed_out',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '0'
			),
			array(  
				'name' 		=> __( 'Background Overlay Colour', 'wooquickview' ),
				'desc' 		=> __( 'Select a colour or empty for no colour.', 'wooquickview' ). ' ' . __( 'Default', 'wooquickview' ). ' [default_value]',
				'id' 		=> 'quick_view_ultimate_fancybox_overlay_color',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 1, 'color' => '#666666' )
			),
			
        ));
	}
}

global $wc_qv_fancybox_popup_settings;
$wc_qv_fancybox_popup_settings = new WC_QV_Fancybox_Popup_Settings();

?>