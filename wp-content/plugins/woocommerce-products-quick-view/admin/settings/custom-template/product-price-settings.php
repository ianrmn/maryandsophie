<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Product Price Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Product_Price_Settings
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_product_price_settings';

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
				'name'		=> __( 'Product Price', 'wooquickview' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_product_price_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Product Price', 'wooquickview' ),
				'id' 		=> 'show_product_price',
				'class'		=> 'show_product_price',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			
			array(
				'name'		=> '',
                'type' 		=> 'heading',
				'class'		=> 'show_product_price_container'
           	),
			array(  
				'name' 		=> __( 'Price Font', 'wooquickview' ),
				'id' 		=> 'price_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#FF0000' )
			),
			array(  
				'name' 		=> __( 'Old Price Font', 'wooquickview' ),
				'id' 		=> 'old_price_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '11px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#000000' )
			),
			array(  
				'name' 		=> __( 'Price Alignment', 'wooquickview' ),
				'id' 		=> 'price_alignment',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'left',
				'onoff_options' => array(
					array(
						'val' 				=> 'left',
						'text' 				=> __( 'Left', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
					array(
						'val' 				=> 'center',
						'text' 				=> __( 'Center', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
					array(
						'val' 				=> 'right',
						'text' 				=> __( 'Right', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
				),
			),
			array(  
				'name' 		=> __( 'Price Margin', 'wooquickview' ),
				'id' 		=> 'price_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'price_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'price_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
											
									array( 
											'id' 		=> 'price_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'price_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
	 							)
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.show_product_price:checked").val() != '1') {
		$(".show_product_price_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.show_product_price', function( event, value, status ) {
		$(".show_product_price_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_product_price_container").slideDown();
		} else {
			$(".show_product_price_container").slideUp();
		}
	});
	
});
})(jQuery);
</script>
    <?php	
	}
	
}

global $wc_qv_custom_template_product_price_settings;
$wc_qv_custom_template_product_price_settings = new WC_QV_Custom_Template_Product_Price_Settings();

?>