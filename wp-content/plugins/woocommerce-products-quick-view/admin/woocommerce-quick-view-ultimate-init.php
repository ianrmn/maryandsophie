<?php
/**
 * Register Activation Hook
 */
update_option('wc_quick_view_ultimate_plugin', 'wc_quick_view_ultimate');
function wc_quick_view_ultimate_install(){
	global $wpdb;

	// Set Settings Default from Admin Init
	global $wc_qv_admin_init;
	$wc_qv_admin_init->set_default_settings();

	// Build sass
	global $wc_qv_less;
	$wc_qv_less->plugin_build_sass();

	update_option('wc_quick_view_ultimate_version', '1.5.1');
	update_option('wc_quick_view_lite_version', '1.5.1');
	update_option('wc_quick_view_ultimate_plugin', 'wc_quick_view_ultimate');

	delete_metadata( 'user', 0, $wc_qv_admin_init->plugin_name . '-' . 'plugin_framework_global_box' . '-' . 'opened', '', true );

	delete_transient( $wc_qv_admin_init->version_transient );

	update_option('wc_quick_view_ultimate_just_installed', true);
}

function quick_view_ultimate_init() {
	if ( get_option('wc_quick_view_ultimate_just_installed') ) {
		delete_option('wc_quick_view_ultimate_just_installed');
		wp_redirect( admin_url( 'admin.php?page=wc-quick-view', 'relative' ) );
		exit;
	}
	load_plugin_textdomain( 'wooquickview', false, WC_QUICK_VIEW_ULTIMATE_FOLDER.'/languages' );
}

global $wc_quick_view_ultimate;

// Add language
add_action('init', 'quick_view_ultimate_init');

// Add custom style to dashboard
add_action( 'admin_enqueue_scripts', array( $wc_quick_view_ultimate, 'a3_wp_admin' ) );

// Add admin sidebar menu css
add_action( 'admin_enqueue_scripts', array( $wc_quick_view_ultimate, 'admin_sidebar_menu_css' ) );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array( $wc_quick_view_ultimate, 'plugin_extra_links'), 10, 2 );

global $wc_qv_admin_init;
$wc_qv_admin_init->init();

// Add upgrade notice to Dashboard pages
add_filter( $wc_qv_admin_init->plugin_name . '_plugin_extension_boxes', array( $wc_quick_view_ultimate, 'plugin_extension_box' ) );

// Add extra link on left of Deactivate link on Plugin manager page
add_action('plugin_action_links_' . WC_QUICK_VIEW_ULTIMATE_NAME, array( $wc_quick_view_ultimate, 'settings_plugin_links' ) );

//Ajax Load Custom Template for Popup
add_action('wp_ajax_quick_view_custom_template_load', array( 'WC_Quick_View_Custom_Template', 'quick_view_custom_template_load') );
add_action('wp_ajax_nopriv_quick_view_custom_template_load', array( 'WC_Quick_View_Custom_Template', 'quick_view_custom_template_load') );


// Check upgrade functions
add_action('init', 'wc_quick_view_lite_upgrade_plugin');
function wc_quick_view_lite_upgrade_plugin () {

	// Upgrade to 1.0.2
	if ( version_compare(get_option('wc_quick_view_lite_version'), '1.0.2' ) === -1) {
		update_option('wc_quick_view_lite_version', '1.0.2');
		include( WC_QUICK_VIEW_ULTIMATE_FILE_PATH. '/includes/updates/update-1.0.2.php' );
	}

	// Upgrade to 1.3.0
	if ( version_compare(get_option('wc_quick_view_lite_version'), '1.3.0' ) === -1) {
		update_option('wc_quick_view_lite_version', '1.3.0');
		include( WC_QUICK_VIEW_ULTIMATE_FILE_PATH. '/includes/updates/update-1.3.0.php' );
	}

	// Upgrade to 1.3.2
	if ( version_compare(get_option('wc_quick_view_lite_version'), '1.4.0') === -1 ) {
		update_option('wc_quick_view_lite_version', '1.4.0');
		update_option('wc_product_quick_view_style_version', time() );

		// Build sass
		global $wc_qv_less;
		$wc_qv_less->plugin_build_sass();
	}

	// Upgrade to 1.5.0
	if(version_compare(get_option('wc_quick_view_lite_version'), '1.5.0') === -1){
		update_option('wc_quick_view_lite_version', '1.5.0');
		include( WC_QUICK_VIEW_ULTIMATE_FILE_PATH. '/includes/updates/update-1.5.0.php' );
	}

	update_option('wc_quick_view_ultimate_version', '1.5.1');
	update_option('wc_quick_view_lite_version', '1.5.1');

}
?>
