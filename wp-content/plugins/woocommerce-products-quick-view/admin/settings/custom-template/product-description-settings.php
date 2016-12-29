<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Product Short Description Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Product_Description_Settings
{
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_product_description_settings';

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
				'name'		=> __( 'Product Description', 'wooquickview' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_description_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Product Description', 'wooquickview' ),
				'id' 		=> 'show_description',
				'class'		=> 'show_description',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			
			array(
            	'name' 		=> __( 'Pull Product Description From', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_description_container',
           	),
			array(  
				'name' 		=> __( "Product Short Description", 'wooquickview' ),
				'id' 		=> 'pull_description_from',
				'class'		=> 'pull_description_from',
				'type' 		=> 'onoff_radio',
				'default'	=> 'short_description',
				'onoff_options' => array(
					array(
						'val' 				=> 'short_description',
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),
				),
			),
			array(  
				'name' 		=> __( 'Product Description', 'wooquickview' ),
				'id' 		=> 'pull_description_from',
				'class'		=> 'pull_description_from',
				'type' 		=> 'onoff_radio',
				'default'	=> 'description',
				'onoff_options' => array(
					array(
						'val' 				=> 'description',
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),
				),
			),
			
			array(
                'type' 		=> 'heading',
				'class'		=> 'description_characters_container',
           	),
			array(  
				'name' 		=> __( 'Number of Characters', 'wooquickview' ),
				'id' 		=> 'description_characters',
				'type' 		=> 'text',
				'css'		=> 'width:40px;',
				'default'	=> 300
			),
			
			array(
				'name'		=> __( 'Product Description Style', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_description_container'
           	),
			array(  
				'name' 		=> __( 'Description Font', 'wooquickview' ),
				'id' 		=> 'description_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#000000' )
			),
			array(  
				'name' 		=> __( 'Description Alignment', 'wooquickview' ),
				'id' 		=> 'description_alignment',
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
				'name' 		=> __( 'Description Margin', 'wooquickview' ),
				'id' 		=> 'description_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'description_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'description_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
											
									array( 
											'id' 		=> 'description_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'description_margin_right',
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
	if ( $("input.pull_description_from:checked").val() == 'short_description' ) {
		$(".description_characters_container").hide();
	}
	
	if ( $("input.show_description:checked").val() != '1') {
		$(".show_description_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
		$(".description_characters_container").hide();
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.show_description', function( event, value, status ) {
		$(".show_description_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_description_container").slideDown();
			if ( $("input.pull_description_from:checked").val() == 'description' ) {
				$(".description_characters_container").slideDown();
			}
		} else {
			$(".show_description_container").slideUp();
			$(".description_characters_container").slideUp();
		}
	});
	
	$(document).on( "a3rev-ui-onoff_radio-switch", '.pull_description_from', function( event, value, status ) {
		if ( value == 'description' && status == 'true' ) {
			$('.description_characters_container').slideDown();
		} else {
			$('.description_characters_container').slideUp();
		}
	});
	
});
})(jQuery);
</script>
    <?php	
	}
	
}

global $wc_qv_custom_template_product_description_settings;
$wc_qv_custom_template_product_description_settings = new WC_QV_Custom_Template_Product_Description_Settings();

?>