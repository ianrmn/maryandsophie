<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Dynamic Gallery Style Settings

-----------------------------------------------------------------------------------*/

class WC_QV_Custom_Template_Gallery_Thumbnails_Settings
{
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_gallery_thumbnails_settings';

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
            	'name' 		=> __('Image Thumbnails', 'wooquickview'),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'     => 'qv_dgallery_thumbnails_box',
				'is_box' => true,
           	),
           	array(  
				'name' 		=> __( 'Gallery Thumbnails', 'wooquickview' ),
				'class'		=> 'enable_gallery_thumb',
				'id' 		=> 'enable_gallery_thumb',
				'default'			=> 'yes',
				'type' 				=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

			array(
                'type' 		=> 'heading',
				'class'		=> 'gallery_thumb_container',
           	),
			array(  
				'name' 		=> __( 'Single Image Thumbnail', 'wooquickview' ),
				'desc' 		=> __( "ON to hide thumbnail when only 1 image is loaded to gallery.", 'wooquickview' ),
				'id' 		=> 'hide_thumb_1image',
				'default'			=> 'yes',
				'type' 				=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),
			array(
				'name' 		=> __( 'Thumbnail Display', 'wooquickview' ),
				'desc'		=> __( 'Static displays all Gallery thumbnails in columns', 'wooquickview' ),
				'id' 		=> 'thumb_show_type',
				'class'		=> 'qv_dgallery_thumb_show_type',
				'default'			=> 'slider',
				'type' 				=> 'switcher_checkbox',
				'checked_value'		=> 'slider',
				'unchecked_value'	=> 'static',
				'checked_label'		=> __( 'Slider', 'wooquickview' ),
				'unchecked_label' 	=> __( 'Static', 'wooquickview' ),
			),
			array(
				'class'		=> 'gallery_thumb_container',
                'type' 		=> 'heading',
				'desc'		=> '<table class="form-table"><tbody>
				<tr valign="top">
				<th class="titledesc" scope="row"><label>' . __( 'Thumbnail Dimensions', 'wooquickview' ) . '</label></th>
				<td class="forminp">' . sprintf( __( 'The plugin is using <a href="%s" target="_blank">Product Thumbnails Dimension</a> from WooCommerce Settings', 'wooquickview' ), admin_url( 'admin.php?page=wc-settings&tab=products&section=display' ) ) . '</td>
				</tr></tbody></table>',
           	),
			array(
				'name' 		=> __( 'Thumbnail Spacing', 'wooquickview' ),
				'desc' 		=> 'px',
				'id' 		=> 'thumb_spacing',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '10'
			),
			array(
				'name' => __( 'Thumbnail Columns', 'wooquickview' ),
				'desc' 		=> __( 'columns', 'wooquickview' ) . '</span></div></div>
				<div style="clear: both;"></div>
				<div><div>' . __( 'Applies to Thumbnail Slider (number visible in Slider) and Static Thumbnail Display. Default of WooCommerce is 3 column', 'wooquickview' ) . '<span>',
				'id' 		=> 'thumb_columns',
				'type' 		=> 'slider',
				'default'	=> 3,
				'min'		=> 2,
				'max'		=> 8,
				'increment'	=> 1,
			),
			array(  
				'name' => __( 'Thumbnail Border Colour', 'wooquickview' ),
				'desc' 		=> __( 'Type in the word <code>transparent</code> for no colour', 'wooquickview' ),
				'id' 		=> 'thumb_border_color',
				'type' 		=> 'color',
				'default'	=> 'transparent'
			),
			array(  
				'name' => __( 'Current Thumbail Border Colour', 'wooquickview' ),
				'desc' 		=> __( 'Type in the word <code>transparent</code> for no colour', 'wooquickview' ),
				'id' 		=> 'thumb_current_border_color',
				'type' 		=> 'color',
				'default'	=> '#96588a'
			),

			array(
            	'name' 		=> __('Thumbnail Slider Container', 'wooquickview'),
                'type' 		=> 'heading',
                'id'     => 'qv_dgallery_thumbnail_slider_box',
                'class'  => 'pro_feature_fields pro_feature_hidden',
				'is_box' => true,
           	),
           	array(
				'name' 		=> __( 'Background Colour', 'wooquickview' ),
				'id' 		=> 'thumb_slider_background',
				'type' 		=> 'bg_color',
				'default'	=> array( 'enable' => 0, 'color' => '#FFF' )
			),
			array(
				'name' 		=> __( 'Border', 'wooquickview' ),
				'id' 		=> 'thumb_slider_border',
				'type' 		=> 'border',
				'default'	=> array( 'width' => '0px', 'style' => 'solid', 'color' => '#ddd', 'corner' => 'square' , 'top_left_corner' => 3 , 'top_right_corner' => 3 , 'bottom_left_corner' => 3 , 'bottom_right_corner' => 3 ),
			),
			array(
				'name' => __( 'Border Shadow Effect', 'wooquickview' ),
				'id' 		=> 'thumb_slider_shadow',
				'type' 		=> 'box_shadow',
				'default'	=> array( 'enable' => 0, 'h_shadow' => '0px' , 'v_shadow' => '1px', 'blur' => '0px' , 'spread' => '0px', 'color' => '#555555', 'inset' => 'inset' )
			),
        ));
	}
}

global $wc_qv_custom_template_gallery_thumbnails_settings;
$wc_qv_custom_template_gallery_thumbnails_settings = new WC_QV_Custom_Template_Gallery_Thumbnails_Settings();

?>