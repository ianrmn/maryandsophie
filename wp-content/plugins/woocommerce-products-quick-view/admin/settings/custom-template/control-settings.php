<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Controls Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Control_Settings
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_control_settings';

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
				'name'		=> __( 'Controls Settings', 'wooquickview' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_controls_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Next / Previous Control', 'wooquickview' ),
				'id' 		=> 'enable_control',
				'class'		=> 'enable_control',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			
			array(
                'type' 		=> 'heading',
				'class'		=> 'popup_control_container'
           	),
			array(  
				'name' 		=> __( 'Control Transition', 'wooquickview' ),
				'id' 		=> 'control_transition',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'hover',
				'onoff_options' => array(
					array(
						'val' 				=> 'alway',
						'text' 				=> __( 'Alway show when popup loaded', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
					array(
						'val' 				=> 'hover',
						'text' 				=> __( 'Show when hover on popup container', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
				),			
			),
			array(
				'name' => __( 'Arrow Icons Size', 'wooquickview' ),
				'desc' 		=> "px",
				'id' 		=> 'popup_nextpre_icons_size',
				'type' 		=> 'slider',
				'default'	=> 40,
				'min'		=> 10,
				'max'		=> 60,
				'increment'	=> 1,
			),
			array(
				'name' 		=> __( 'Arrow Icon Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'popup_nextpre_icons_color',
				'type' 		=> 'color',
				'default'	=> '#727272'
			),
			array(
				'name' => __( 'Arrow Icon Transparency', 'wooquickview' ),
				'desc' 		=> "%. " . __( '100% = Full Colour', 'wooquickview' ),
				'id' 		=> 'popup_nextpre_icons_opacity',
				'type' 		=> 'slider',
				'default'	=> 80,
				'min'		=> 0,
				'max'		=> 100,
				'increment'	=> 10,
			),
			array(
				'name' 		=> __( 'Border Margin', 'wooquickview' ),
				'id' 		=> 'popup_nextpre_icons_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array(
									array(  'id' 		=> 'popup_nextpre_icons_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),

									array(  'id' 		=> 'popup_nextpre_icons_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'class' 	=> '',
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),

        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.enable_control:checked").val() != '1') {
		$(".popup_control_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.enable_control', function( event, value, status ) {
		$(".popup_control_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".popup_control_container").slideDown();
		}
	});
	
});
})(jQuery);
</script>
    <?php
	}
}

global $wc_qv_custom_template_control_settings;
$wc_qv_custom_template_control_settings = new WC_QV_Custom_Template_Control_Settings();

?>