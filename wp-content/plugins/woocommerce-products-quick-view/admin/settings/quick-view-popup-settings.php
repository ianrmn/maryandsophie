<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Quick View Popup Settings

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

class WC_QV_Popup_Settings extends WC_QV_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'quick-view-popup';
	
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
	public $form_key = 'wc_quick_view_popup_settings';
	
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
				'success_message'	=> __( 'Quick View Pop Up successfully saved.', 'wooquickview' ),
				'error_message'		=> __( 'Error: Quick View Pop Up can not save.', 'wooquickview' ),
				'reset_message'		=> __( 'Quick View Pop Up successfully reseted.', 'wooquickview' ),
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
			'name'				=> 'quick-view-popup-settings',
			'label'				=> __( 'Quick View Pop Up', 'wooquickview' ),
			'callback_function'	=> 'wc_qv_popup_settings_form',
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
     	$this->form_fields = array(
     		array(
				'name' => __( 'Quick View Pop Up', 'wooquickview' ),
				'type' => 'heading',
				'class'=> 'quick_view_ultimate_container',
				'id'		=> 'quick_view_popup_tool_box',
				'first_open'=> true,
				'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( "Pop Up Tool", 'wooquickview' ),
				'id' 		=> 'quick_view_ultimate_popup_tool',
				'class'		=> 'quick_view_ultimate_popup_tool',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'fancybox',
				'checked_value'		=> 'fancybox',
				'unchecked_value'	=> 'colorbox',
				'checked_label'		=> __( 'FANCYBOX', 'wooquickview' ),
				'unchecked_label' 	=> __( 'COLORBOX', 'wooquickview' ),
			),
        );

        include_once( $this->admin_plugin_dir() . '/settings/fancybox-popup-settings.php' );
		global $wc_qv_fancybox_popup_settings;
		$this->form_fields = array_merge( $this->form_fields, $wc_qv_fancybox_popup_settings->form_fields );

		include_once( $this->admin_plugin_dir() . '/settings/colorbox-popup-settings.php' );
		global $wc_qv_colorbox_popup_settings;
		$this->form_fields = array_merge( $this->form_fields, $wc_qv_colorbox_popup_settings->form_fields );

        $this->form_fields = apply_filters( $this->form_key . '_settings_fields', $this->form_fields );
	}

	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {

	if ( $("input.quick_view_ultimate_popup_tool:checked").val() == 'fancybox') {
		$(".quick_view_colorbox_popup_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	} else {
		$(".quick_view_fancybox_popup_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}

	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.quick_view_ultimate_popup_tool', function( event, value, status ) {
		$(".quick_view_fancybox_popup_container").attr('style','display:none;');
		$(".quick_view_colorbox_popup_container").attr('style','display:none;');
		if ( status == 'true') {
			$(".quick_view_fancybox_popup_container").slideDown();
			$(".quick_view_colorbox_popup_container").slideUp();
		} else {
			$(".quick_view_fancybox_popup_container").slideUp();
			$(".quick_view_colorbox_popup_container").slideDown();
		}
	});
});
})(jQuery);
</script>
    <?php
	}
}

global $wc_qv_popup_settings;
$wc_qv_popup_settings = new WC_QV_Popup_Settings();

/** 
 * wc_qv_fancybox_popup_settings_form()
 * Define the callback function to show subtab content
 */
function wc_qv_popup_settings_form() {
	global $wc_qv_popup_settings;
	$wc_qv_popup_settings->settings_form();
}

?>
