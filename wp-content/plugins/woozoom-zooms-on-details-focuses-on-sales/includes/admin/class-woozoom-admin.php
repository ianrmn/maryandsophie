<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOOZOOm_Admin' ) ) :

/**
 * Main WOOZOOm_Admin Class
 *
 * @class WOOZOOm_Admin
 */
class WOOZOOm_Admin {

	/**
	 * Constructor
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
	}

	/**
	 * Include the css & js script to admin
	 *
	 * @return string
	 */
	public function enqueue_assets() {
		global $pagenow, $wp_scripts;
		if( $pagenow == 'admin.php' && $_REQUEST['page'] == 'woozoom' ) {
			wp_enqueue_style('woozoom_chosen_style', WOOZOOm_PLUGIN_URL.'/assets/css/chosen.css');
			wp_enqueue_style('woozoom_admin_style', WOOZOOm_PLUGIN_URL.'/assets/css/admin.css');
			
			wp_enqueue_script( 'woozoom_jquery_chosen', WOOZOOm_PLUGIN_URL.'/assets/js/jquery.chosen.js', array('jquery') );
			wp_enqueue_script( 'woozoom_jquery_chosen_ajax', WOOZOOm_PLUGIN_URL.'/assets/js/jquery.chosen.ajax.js', array('woozoom_jquery_chosen') );
		}
	}
	
}

endif;

new WOOZOOm_Admin();
