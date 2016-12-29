<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Add To Cart Button Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Quantity_Selector_Settings
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_quantity_selector_settings';

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
            	'name' => __( 'Quantity Selector', 'wooquickview' ),
                'type' => 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_quantity_selector_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Quantity Selector', 'wooquickview' ),
				'id' 		=> 'show_quantity_selector',
				'class'		=> 'show_quantity_selector',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			
			array(
				'name'		=> __( 'Quantity Selector Container', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_quantity_selector_container'
           	),
			array(  
				'name' 		=> __( 'Container Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quantity_selector_bg_colour',
				'type' 		=> 'color',
				'default'	=> '#DDDDDD'
			),
			array(  
				'name' 		=> __( 'Container Border', 'wooquickview' ),
				'id' 		=> 'quantity_selector_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#666666', 'corner' => 'rounded' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(  
				'name' 		=> __( 'Container Shadow', 'wooquickview' ),
				'id' 		=> 'quantity_selector_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),
			array(  
				'name' 		=> __( 'Container Border Margin (Outside)', 'wooquickview' ),
				'id' 		=> 'quantity_selector_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'quantity_selector_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
									array(  'id' 		=> 'quantity_selector_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 								array(  'id' 		=> 'quantity_selector_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
									array(  'id' 		=> 'quantity_selector_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),
			
			array(
				'name'		=> __( 'Quantity Input', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_quantity_selector_container'
           	),
			array(  
				'name' 		=> __( 'Quantity Input Font', 'wooquickview' ),
				'id' 		=> 'quantity_input_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '16px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#000000' )
			),
			array(  
				'name' 		=> __( 'Quantity Input Padding (Inside)', 'wooquickview' ),
				'id' 		=> 'quantity_input_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'quantity_input_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
									array(  'id' 		=> 'quantity_input_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 								array(  'id' 		=> 'quantity_input_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
									array(  'id' 		=> 'quantity_input_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 							)
			),
			
			array(
				'name'		=> __( 'Quantity Plus / Minus', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_quantity_selector_container'
           	),
			array(  
				'name' 		=> __( 'Quantity Plus / Minus Font', 'wooquickview' ),
				'id' 		=> 'quantity_plus_minus_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '11px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#000000' )
			),
			array(  
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quantity_plus_minus_bg_colour',
				'type' 		=> 'color',
				'default'	=> '#DDDDDD'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quantity_plus_minus_bg_colour_from',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'quantity_plus_minus_bg_colour_to',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			array(  
				'name' 		=> __( 'Quantity Plus / Minus Padding (Inside)', 'wooquickview' ),
				'id' 		=> 'quantity_plus_minus_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'quantity_plus_minus_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
									array(  'id' 		=> 'quantity_plus_minus_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
	 								array(  'id' 		=> 'quantity_plus_minus_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '2' ),
									array(  'id' 		=> 'quantity_plus_minus_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '2' ),
	 							)
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	
	if ( $("input.show_quantity_selector:checked").val() != '1') {
		$(".show_quantity_selector_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.show_quantity_selector', function( event, value, status ) {
		$(".show_quantity_selector_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_quantity_selector_container").slideDown();
		} else {
			$(".show_quantity_selector_container").slideUp();
		}
	});
});
})(jQuery);
</script>
    <?php	
	}
}

global $wc_qv_custom_template_quantity_selector_settings;
$wc_qv_custom_template_quantity_selector_settings = new WC_QV_Custom_Template_Quantity_Selector_Settings();

?>