<?php
/**
 * Installation related functions and actions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOOZOOm_Install' ) ) :
	
/**
 * WOOZOOm_Install Class
 */
class WOOZOOm_Install {

	/**
	 * Hook in tabs
	 */
	public function __construct() {
		// Run this on activation.
		register_activation_hook( WOOZOOm_PLUGIN_FILE, array( $this, 'install' ) );
		$plugin = plugin_basename(WOOZOOm_PLUGIN_FILE); 
		add_filter("plugin_action_links_$plugin", array( $this, 'woozoom_plugin_settings_link') );
	}

	/**
	 * Install WOOZOOm set values and create table
	 */
	public function install() {
		$fields_array = apply_filters( 'woozoom_setting_default_fields', array(
			'woozoom_activate'			=> 1,
			'woozoom_zoom_type'			=> 'window',
			'woozoom_easing'			=> 1
		) );
		foreach($fields_array as $field=>$value) {
			add_option( $field, $value );
		}
	}
	
	/**
	 * Add settings link on plugin page
	 */
	function woozoom_plugin_settings_link($links) {
		$settings_link = '<a href="admin.php?page=woozoom">'.__('Settings', 'WOOZOOm').'</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
	
}
	
endif;

return new WOOZOOm_Install();
