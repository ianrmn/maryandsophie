<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Product Title Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Product_Title_Settings
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_product_title_settings';

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
				'name'		=> __( 'Product Title', 'wooquickview' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_title_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Title Transformation', 'wooquickview' ),
				'id' 		=> 'title_transformation',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'none',
				'onoff_options' => array(
					array(
						'val' 				=> 'none',
						'text' 				=> __( 'None', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
					array(
						'val' 				=> 'uppercase',
						'text' 				=> __( 'Uppercase', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
					array(
						'val' 				=> 'lowercase',
						'text' 				=> __( 'Lowercase', 'wooquickview' ),
						'checked_label'		=> __( 'ON', 'wooquickview') ,
						'unchecked_label' 	=> __( 'OFF', 'wooquickview') ,
					),
				),
			),
			array(  
				'name' 		=> __( 'Title Alignment', 'wooquickview' ),
				'id' 		=> 'title_alignment',
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
				'name' 		=> __( 'Title Font', 'wooquickview' ),
				'id' 		=> 'title_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '18px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#000000' )
			),
			array(  
				'name' 		=> __( 'Title Hover Colour', 'wooquickview' ),
				'id' 		=> 'title_font_hover_color',
				'type' 		=> 'color',
				'default'	=> '#999999'
			),
			array(  
				'name' 		=> __( 'Title Container Background Colour', 'wooquickview' ),
				'id' 		=> 'title_bg_color',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' 		=> __( 'Title Container Border', 'wooquickview' ),
				'id' 		=> 'title_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '0px', 'style' => 'solid', 'color' => '#FFFFFF', 'corner' => 'square' , 'rounded_value' => 0 ),
			),
			array(  
				'name' => __( 'Title Container Shadow', 'wooquickview' ),
				'id' 		=> 'title_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),
			array(  
				'name' 		=> __( 'Border Margin (Outside)', 'wooquickview' ),
				'id' 		=> 'title_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'title_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'title_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
											
									array( 
											'id' 		=> 'title_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'title_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
	 							)
			),
			array(  
				'name' 		=> __( 'Border Padding (Inside)', 'wooquickview' ),
				'id' 		=> 'title_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'title_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
	 
	 								array(  'id' 		=> 'title_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'title_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'title_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
	 							)
			),
			
        ));
	}
	
}

global $wc_qv_custom_template_product_title_settings;
$wc_qv_custom_template_product_title_settings = new WC_QV_Custom_Template_Product_Title_Settings();

?>