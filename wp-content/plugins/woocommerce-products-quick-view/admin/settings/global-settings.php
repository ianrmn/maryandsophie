<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Global Settings

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

class WC_QV_Global_Settings extends WC_QV_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'settings';
	
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
	public $form_key = 'wc_quick_view_global';
	
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
		//$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Quick View Settings successfully saved.', 'wooquickview' ),
				'error_message'		=> __( 'Error: Quick View Settings can not save.', 'wooquickview' ),
				'reset_message'		=> __( 'Quick View Settings successfully reseted.', 'wooquickview' ),
			);
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );

		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'clean_on_deletion' ) );

		//add_action( $this->plugin_name . '_settings_init' , array( $this, 'show_hide_tabs' ) );
		
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
	/* clean_on_deletion()
	/* Process when clean on deletion option is un selected */
	/*-----------------------------------------------------------------------------------*/
	public function clean_on_deletion() {
		if ( ( isset( $_POST['bt_save_settings'] ) || isset( $_POST['bt_reset_settings'] ) ) && get_option( 'quick_view_lite_clean_on_deletion' ) == 0  )  {
			$uninstallable_plugins = (array) get_option('uninstall_plugins');
			unset($uninstallable_plugins[WC_QUICK_VIEW_ULTIMATE_NAME]);
			update_option('uninstall_plugins', $uninstallable_plugins);
		}
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
			'name'				=> 'settings',
			'label'				=> __( 'Settings', 'wooquickview' ),
			'callback_function'	=> 'wc_qv_global_settings_form',
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
            	'name' 		=> __( 'Plugin Framework Global Settings', 'wooquickview' ),
            	'id'		=> 'plugin_framework_global_box',
                'type' 		=> 'heading',
                'first_open'=> true,
                'is_box'	=> true,
           	),

			array(
           		'name'		=> __( 'Google Fonts', 'wooquickview' ),
           		'desc'		=> __( 'By Default Google Fonts are pulled from a static JSON file in this plugin. This file is updated but does not have the latest font releases from Google.', 'wooquickview' ),
                'type' 		=> 'heading',
           	),
           	array(
                'type' 		=> 'google_api_key',
           	),
           	array(
            	'name' 		=> __( 'House Keeping', 'wooquickview' ),
                'type' 		=> 'heading',
            ),
			array(
				'name' 		=> __( 'Clean Up On Deletion', 'wooquickview' ),
				'desc' 		=> __( 'On deletion (not deactivate) the plugin will completely remove all tables and data it created, leaving no trace it was ever here.', 'wooquickview'),
				'id' 		=> 'quick_view_lite_clean_on_deletion',
				'type' 		=> 'onoff_checkbox',
				'default'	=> '0',
				'separate_option'	=> true,
				'checked_value'		=> '1',
				'unchecked_value'	=> '0',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

			array(
            	'name' => __( 'Quick View Activation', 'wooquickview' ),
                'type' => 'heading',
                'id'		=> 'master_switch_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Quick View Feature', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_enable',
				'class'		=> 'quick_view_ultimate_enable',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 'yes',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'Enable', 'wooquickview' ),
				'unchecked_label' 	=> __( 'Disable', 'wooquickview' ),
			),

			array(
            	'name' => __( 'Quick View Content Type', 'wooquickview' ),
                'type' => 'heading',
                'class'=> 'quick_view_ultimate_container',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( "Custom Template Pop-up", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_popup_content',
				'class'		=> 'quick_view_ultimate_popup_content',
				'type' 		=> 'onoff_radio',
				'default'	=> 'custom_template',
				'onoff_options' => array(
					array(
						'val' 				=> 'custom_template',
						'text' 				=> __( 'Use the Custom Template for pop-up with Dynamic product image gallery', 'wooquickview' ).' <span class="description">('.__( 'recommended', 'wooquickview' ).')</span>' ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),
				),
			),
			array(
            	'name' => '',
                'type' => 'heading',
                'class'=> 'quick_view_custom_template_container',
           	),
           	array(
				'name' 		=> __( 'Dynamic Gallery Activation', 'wooquickview' ),
				'id' 		=> 'quick_view_template_dynamic_gallery_activate',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 'yes',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'ON', 'wooquickview' ),
				'unchecked_label' 	=> __( 'OFF', 'wooquickview' ),
			),

           	array(
            	'name' => '',
                'type' => 'heading',
                'class'=> 'quick_view_ultimate_container',
           	),
			array(  
				'name' 		=> __( 'Site Product Page', 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_popup_content',
				'class'		=> 'quick_view_ultimate_popup_content',
				'type' 		=> 'onoff_radio',
				'default'	=> 'custom_template',
				'onoff_options' => array(
					array(
						'val' 				=> 'full_page',
						'text' 				=> __( 'Open full site in pop-up', 'wooquickview' ) ,
						'checked_label'		=> 'ON',
						'unchecked_label' 	=> 'OFF',
					),
				),
			),
        ));
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.quick_view_ultimate_popup_content:checked").val() != 'custom_template') {
		$('.quick_view_custom_template_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	if ( $("input[name='quick_view_ultimate_enable']:checked").val() != 'yes') {
		$('.quick_view_ultimate_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px' } );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.quick_view_ultimate_enable', function( event, value, status ) {
		$('.quick_view_ultimate_container').attr('style','display:none;');
		if ( status == 'true' ) {
			$(".quick_view_ultimate_container").slideDown();
		}
	});

	$(document).on( "a3rev-ui-onoff_radio-switch", '.quick_view_ultimate_popup_content', function( event, value, status ) {
		$('.quick_view_custom_template_container').attr('style','display:none;');
		if ( value == 'custom_template' && status == 'true' ) {
			$('.quick_view_custom_template_container').slideDown();
		}
	});

});
})(jQuery);
</script>
    <?php	
	}

	public function show_hide_tabs() {
		$quick_view_ultimate_enable        = get_option( 'quick_view_ultimate_enable', 'yes' );
		$quick_view_ultimate_popup_content = get_option( 'quick_view_ultimate_popup_content', 'custom_template' );
		$dynamic_gallery_activate          = get_option( 'quick_view_template_dynamic_gallery_activate', 'yes' );
?>
<style type="text/css">
<?php if ( 'yes' != $quick_view_ultimate_enable ) { ?>
	.nav-tab.quick-view-button, .nav-tab.quick-view-popup, .nav-tab.custom-template, .nav-tab.gallery-settings { display: none; }
<?php } elseif ( 'custom_template' != $quick_view_ultimate_popup_content ) { ?>
	.nav-tab.custom-template, .nav-tab.gallery-settings { display: none; }
<?php } elseif ( 'yes' != $dynamic_gallery_activate ) { ?>
	.nav-tab.gallery-settings { display: none; }
<?php } ?>
</style>
	<?php
	}
}

global $wc_qv_global_settings;
$wc_qv_global_settings = new WC_QV_Global_Settings();

/** 
 * wc_qv_global_settings_form()
 * Define the callback function to show subtab content
 */
function wc_qv_global_settings_form() {
	global $wc_qv_global_settings;
	$wc_qv_global_settings->settings_form();
}

?>