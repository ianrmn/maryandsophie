<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Read More Button Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_ReadMore_Button_Settings
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_readmore_settings';

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
            	'name' => __( 'Read More Button', 'wooquickview' ),
                'type' => 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_readmore_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Read More Button', 'wooquickview' ),
				'id' 		=> 'show_readmore',
				'class'		=> 'show_readmore',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			
			array(
				'name'		=> __( 'Read More Button / Hyperlink', 'wooquickview' ),
                'type' 		=> 'heading',
				'class'		=> 'show_readmore_container'
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Type', 'wooquickview' ),
				'id' 		=> 'readmore_button_type',
				'class' 	=> 'readmore_button_type',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'button',
				'checked_value'		=> 'button',
				'unchecked_value'	=> 'link',
				'checked_label'		=> __( 'Button', 'wooquickview' ),
				'unchecked_label' 	=> __( 'Hyperlink', 'wooquickview' ),
			),

			array(
            	'name' 		=> '',
                'type' 		=> 'heading',
          		'class'		=> 'readmore_hyperlink_styling_container'
           	),
			array(  
				'name' 		=> __( 'Hyperlink Text', 'wooquickview' ),
				'id' 		=> 'readmore_link_text',
				'type' 		=> 'text',
				'default'	=> __('Read More', 'wooquickview')
			),
			array(  
				'name' 		=> __( 'Hyperlink Font', 'wooquickview' ),
				'id' 		=> 'readmore_link_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#21759B' )
			),
			array(  
				'name' 		=> __( 'Hyperlink Hover Colour', 'wooquickview' ),
				'id' 		=> 'readmore_link_font_hover_colour',
				'type' 		=> 'color',
				'default'	=> '#D54E21'
			),
			
			array(
            	'name' 		=> '',
                'type' 		=> 'heading',
          		'class' 	=> 'readmore_button_styling_container'
           	),
			array(  
				'name' 		=> __( 'Button Text', 'wooquickview' ),
				'id' 		=> 'readmore_button_text',
				'type' 		=> 'text',
				'default'	=> __('Read More', 'wooquickview')
			),
			array(  
				'name' 		=> __( 'Button Font', 'wooquickview' ),
				'id' 		=> 'readmore_button_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'line_height' => '1.4em', 'face' => 'Arial, sans-serif', 'style' => 'bold', 'color' => '#FFFFFF' )
			),
			array(  
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'readmore_button_bg_colour',
				'type' 		=> 'color',
				'default'	=> '#476381'
			),
			array(  
				'name' 		=> __( 'Background Colour Gradient From', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'readmore_button_bg_colour_from',
				'type' 		=> 'color',
				'default'	=> '#538bbc'
			),
			
			array(  
				'name' 		=> __( 'Background Colour Gradient To', 'wooquickview' ),
				'desc' 		=> __( 'Default', 'wooquickview' ) . ' [default_value]',
				'id' 		=> 'readmore_button_bg_colour_to',
				'type' 		=> 'color',
				'default'	=> '#476381'
			),
			
			array(  
				'name' 		=> __( 'Button Border', 'wooquickview' ),
				'id' 		=> 'readmore_button_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '1px', 'style' => 'solid', 'color' => '#476381', 'corner' => 'rounded' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(  
				'name' => __( 'Button Shadow', 'wooquickview' ),
				'id' 		=> 'readmore_button_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '5px' , 'v_shadow' => '5px', 'blur' => '2px' , 'spread' => '2px', 'color' => '#999999', 'inset' => '' )
			),
			array(  
				'name' 		=> __( 'Border Margin (Outside)', 'wooquickview' ),
				'id' 		=> 'readmore__button_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'readmore_button_margin_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '20' ),
									array(  'id' 		=> 'readmore_button_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '5' ),
	 								array(  'id' 		=> 'readmore_button_margin_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
									array(  'id' 		=> 'readmore_button_margin_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '0' ),
	 							)
			),
			array(  
				'name' 		=> __( 'Border Padding (Inside)', 'wooquickview' ),
				'desc' 		=> __( 'Padding from Button text to Button border', 'wooquickview' ),
				'id' 		=> 'readmore_button_padding',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array(  'id' 		=> 'readmore_button_padding_top',
	 										'name' 		=> __( 'Top', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '7' ),
									array(  'id' 		=> 'readmore_button_padding_bottom',
	 										'name' 		=> __( 'Bottom', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '7' ),
	 								array(  'id' 		=> 'readmore_button_padding_left',
	 										'name' 		=> __( 'Left', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '8' ),
									array(  'id' 		=> 'readmore_button_padding_right',
	 										'name' 		=> __( 'Right', 'wooquickview' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> '8' ),
	 							)
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.readmore_button_type:checked").val() == 'button') {
		$('.readmore_hyperlink_styling_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	} else {
		$('.readmore_button_styling_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	if ( $("input.show_readmore:checked").val() != '1') {
		$('.show_readmore_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
		$('.readmore_button_styling_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
		$('.readmore_hyperlink_styling_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.readmore_button_type', function( event, value, status ) {
		$('.readmore_button_styling_container').attr('style','display:none;');
		$('.readmore_hyperlink_styling_container').attr('style','display:none;');
		if ( status == 'true') {
			$(".readmore_button_styling_container").slideDown();
		} else {
			$(".readmore_hyperlink_styling_container").slideDown();
		}
	});
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.show_readmore', function( event, value, status ) {
		$('.show_readmore_container').attr('style','display:none;');
		$('.readmore_button_styling_container').attr('style','display:none;');
		$('.readmore_hyperlink_styling_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_readmore_container").slideDown();
			if ( $("input.readmore_button_type:checked").val() == 'button') {
				$(".readmore_button_styling_container").slideDown();
			} else {
				$(".readmore_hyperlink_styling_container").slideDown();
			}
		}
	});
});
})(jQuery);
</script>
    <?php
	}
}

global $wc_qv_custom_template_readmore_button_settings;
$wc_qv_custom_template_readmore_button_settings = new WC_QV_Custom_Template_ReadMore_Button_Settings();

?>