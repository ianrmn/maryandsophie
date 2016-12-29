<?php
/*
 * Plugin Name: Companion Auto Update
 * Plugin URI: https://qreative-web.com
 * Description: This plugin auto updates all plugins, all themes and the wordpress core.
 * Version: 2.7.4
 * Author: Qreative-Web
 * Author URI: http://papinschipper.nl
 * Contributors: papin
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: companion-auto-update
 * Domain Path: /languages/
 */

// Disable direct access
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function cau_load_translations() {

	// Load translations
	load_plugin_textdomain( 'companion-auto-update', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	
}
add_action( 'init', 'cau_load_translations' );

// Install db
function cau_install() {

	cau_database_creation();

	// Set schedule for emails
	if (! wp_next_scheduled ( 'cau_set_schedule_mail' )) {
		wp_schedule_event(time(), 'daily', 'cau_set_schedule_mail');
    }
}
add_action('cau_set_schedule_mail', 'cau_check_updates_mail');

function cau_database_creation() {

	global $wpdb;
	global $cau_db_version;

	$cau_db_version = '1.3';

	// Create db table
	$table_name = $wpdb->prefix . "auto_updates"; 

	$sql = "CREATE TABLE $table_name (
		id INT(9) NOT NULL AUTO_INCREMENT,
		name VARCHAR(255) NOT NULL,
		onoroff VARCHAR(255) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	// Database version
	add_option( "cau_db_version", "$cau_db_version" );

	// Insert data
	cau_install_data();

	// Updating..
	$installed_ver = get_option( "cau_db_version" );
	if ( $installed_ver != $cau_db_version ) update_option( "cau_db_version", $cau_db_version );

}

// Check if database table exists before creating
function cau_check_if_exists( $whattocheck ) {

	global $wpdb;
	$table_name = $wpdb->prefix . "auto_updates"; 

	$rows 	= $wpdb->get_col( "SELECT COUNT(*) as num_rows FROM $table_name WHERE name = '$whattocheck'" );
	$check 	= $rows[0];

	if( $check > 0) {
		return true;
	} else {
		return false;
	}

}

// Inset Data
function cau_install_data() {

	global $wpdb;
	$table_name = $wpdb->prefix . "auto_updates"; 
	$toemail = get_option('admin_email');

	// Update configs
	if( !cau_check_if_exists( 'plugins' ) ) $wpdb->insert( $table_name, array( 'name' => 'plugins', 'onoroff' => 'on' ) );
	if( !cau_check_if_exists( 'themes' ) ) $wpdb->insert( $table_name, array( 'name' => 'themes', 'onoroff' => 'on' ) );
	if( !cau_check_if_exists( 'minor' ) ) $wpdb->insert( $table_name, array( 'name' => 'minor', 'onoroff' => 'on' ) );
	if( !cau_check_if_exists( 'major' ) ) $wpdb->insert( $table_name, array( 'name' => 'major', 'onoroff' => 'on' ) );

	// Email configs
	if( !cau_check_if_exists( 'email' ) ) $wpdb->insert( $table_name, array( 'name' => 'email', 'onoroff' => '' ) );
	if( !cau_check_if_exists( 'send' ) ) $wpdb->insert( $table_name, array( 'name' => 'send', 'onoroff' => '' ) );
	if( !cau_check_if_exists( 'sendupdate' ) ) $wpdb->insert( $table_name, array( 'name' => 'sendupdate', 'onoroff' => '' ) );

}
register_activation_hook( __FILE__, 'cau_install' );

function cau_remove() {

	// Clear everything
	global $wpdb;
	$table_name = $wpdb->prefix . "auto_updates"; 
	$wpdb->query( "DROP TABLE IF EXISTS $table_name" );

	wp_clear_scheduled_hook('cau_set_schedule_mail');

}
register_deactivation_hook(  __FILE__, 'cau_remove' );

// Update
function cau_update_db_check() {
    global $cau_db_version;
    if ( get_site_option( 'cau_db_version' ) != $cau_db_version ) {
        cau_database_creation();
    }
}
add_action( 'plugins_loaded', 'cau_update_db_check' );

// Add plugin to menu
function register_cau_menu_page() {
	add_submenu_page( 'tools.php', __('Auto Updater', 'companion-auto-update'), __('Auto Updater', 'companion-auto-update'), 'manage_options', 'cau-settings', 'cau_frontend' );
}
add_action( 'admin_menu', 'register_cau_menu_page' );

// Settings page
function cau_frontend() { ?>
	
	<div class='wrap'>

		<h1><?php _e('Auto Updater', 'companion-auto-update');?></h1>

		<?php

		if ( !wp_next_scheduled ( 'cau_set_schedule_mail' )) echo '<div id="message" class="error"><p><b>'.__('Companion Auto Update was not able to set the event for sending you emails, please re-activate the plugin in order to set the event', 'companion-auto-update').'.</b></p></div>';

	    global $cau_db_version;
		if ( get_site_option( 'cau_db_version' ) != $cau_db_version ) echo '<div id="message" class="error"><p><b>'.__('Database Update', 'companion-auto-update').' &ndash;</b> '.__('It seems like something went wrong while updating the database, please re-activate this plugin', 'companion-auto-update').'.</p></div>';

		if( isset( $_POST['submit'] ) ) {

			global $wpdb;
			$table_name = $wpdb->prefix . "auto_updates"; 

			$plugins 	= $_POST['plugins'];
			$themes 	= $_POST['themes'];
			$minor 		= $_POST['minor'];
			$major 		= $_POST['major'];
			$email 		= $_POST['cau_email'];
			$send 		= $_POST['cau_send'];
			$sendupdate = $_POST['cau_send_update'];

			$wpdb->query( " UPDATE $table_name SET onoroff = '$plugins' WHERE name = 'plugins' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$themes' WHERE name = 'themes' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$minor' WHERE name = 'minor' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$major' WHERE name = 'major' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$email' WHERE name = 'email' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$send' WHERE name = 'send' " );
			$wpdb->query( " UPDATE $table_name SET onoroff = '$sendupdate' WHERE name = 'sendupdate' " );

			echo '<div id="message" class="updated"><p><b>'.__('Settings saved', 'companion-auto-update').'.</b></p></div>';
		}

		?>

		<form method="POST">

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e('Auto Updater', 'companion-auto-update');?></th>
					<td>
						<fieldset>

							<?php

							global $wpdb;
							$table_name = $wpdb->prefix . "auto_updates"; 

							$cau_configs = $wpdb->get_results( "SELECT * FROM $table_name" );

							echo '<p><input id="'.$cau_configs[0]->name.'" name="'.$cau_configs[0]->name.'" type="checkbox"';
							if( $cau_configs[0]->onoroff == 'on' ) echo 'checked';
							echo '/> <label for="'.$cau_configs[0]->name.'">'.__('Auto update plugins?', 'companion-auto-update').'</label></p>';

							echo '<p><input id="'.$cau_configs[1]->name.'" name="'.$cau_configs[1]->name.'" type="checkbox"';
							if( $cau_configs[1]->onoroff == 'on' ) echo 'checked';
							echo '/> <label for="'.$cau_configs[1]->name.'">'.__('Auto update themes?', 'companion-auto-update').'</label></p>';


							echo '<p><input id="'.$cau_configs[2]->name.'" name="'.$cau_configs[2]->name.'" type="checkbox"';
							if( $cau_configs[2]->onoroff == 'on' ) echo 'checked';
							echo '/> <label for="'.$cau_configs[2]->name.'">'.__('Auto update minor core updates?', 'companion-auto-update').'</label></p>';


							echo '<p><input id="'.$cau_configs[3]->name.'" name="'.$cau_configs[3]->name.'" type="checkbox"';
							if( $cau_configs[3]->onoroff == 'on' ) echo 'checked';
							echo '/> <label for="'.$cau_configs[3]->name.'">'.__('Auto update major core updates?', 'companion-auto-update').'</label></p>';

							?>

						</fieldset>
					</td>
				</tr>
			</table>

			<h2 class="title"><?php _e('Email Notifications', 'companion-auto-update');?></h2>
			<p><?php _e('Email notifications are send once a day, you can choose what notifications to send below.', 'companion-auto-update');?></p>

			<?php
			if( $cau_configs[4]->onoroff == '' ) $toemail = get_option('admin_email'); 
			else $toemail = $cau_configs[4]->onoroff;
			?>

			<table class="form-table">
				<tr>
					<th scope="row"><?php _e('Update Available', 'companion-auto-update');?></th>
					<td>
						<p>
							<input id="cau_send" name="cau_send" type="checkbox" <?php if( $cau_configs[5]->onoroff == 'on' ) { echo 'checked'; } ?> />
							<label for="cau_send"><?php _e('Send me emails when an update is available.', 'companion-auto-update');?></label>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Successful Update', 'companion-auto-update');?></th>
					<td>
						<p>
							<input id="cau_send_update" name="cau_send_update" type="checkbox" <?php if( $cau_configs[6]->onoroff == 'on' ) { echo 'checked'; } ?> />
							<label for="cau_send_update"><?php _e('Send me emails when something has been updated.', 'companion-auto-update');?></label>
						</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php _e('Email address', 'companion-auto-update');?></th>
					<td>
						<p>
							<label for="cau_email"><?php _e('To', 'companion-auto-update');?>:</label>
							<input type="text" name="cau_email" id="cau_email" class="regular-text" placeholder="<?php echo get_option('admin_email'); ?>" value="<?php echo $toemail; ?>" />
						</p>

						<p class="description"><?php _e('Seperate email adresses using commas.', 'companion-auto-update');?></p>
					</td>
				</tr>
			</table>
			
			<?php submit_button(); ?>

	</div>

<?php }

// Auto Update Class
class CAU_auto_update {

	public function __construct() {
	
        // Enable Update filters
        add_action( 'plugins_loaded', array( &$this, 'CAU_auto_update_filters' ), 1 );

    }

    public function CAU_auto_update_filters() {

		global $wpdb;
		$table_name = $wpdb->prefix . "auto_updates"; 

		// Enable for major updates
		$configs = $wpdb->get_results( "SELECT * FROM $table_name WHERE name = 'major'");
		foreach ( $configs as $config ) {

			if( $config->onoroff == 'on' ) add_filter( 'allow_major_auto_core_updates', '__return_true', 1 ); // Turn on
			if( $config->onoroff != 'on' ) add_filter( 'allow_major_auto_core_updates', '__return_false', 1 ); // Turn off

		}

		// Enable for minor updates
		$configs = $wpdb->get_results( "SELECT * FROM $table_name WHERE name = 'minor'");
		foreach ( $configs as $config ) {

			if( $config->onoroff == 'on' ) add_filter( 'allow_minor_auto_core_updates', '__return_true', 1 ); // Turn on
			if( $config->onoroff != 'on' ) add_filter( 'allow_minor_auto_core_updates', '__return_false', 1 ); // Turn off

		}

		// Enable for plugins
		$configs = $wpdb->get_results( "SELECT * FROM $table_name WHERE name = 'plugins'");
		foreach ( $configs as $config ) {

			if( $config->onoroff == 'on' ) add_filter( 'auto_update_plugin', '__return_true', 1 ); // Turn on
			if( $config->onoroff != 'on' ) add_filter( 'auto_update_plugin', '__return_false', 1 ); // Turn off

		}

		// Enable for themes
		$configs = $wpdb->get_results( "SELECT * FROM $table_name WHERE name = 'themes'");
		foreach ( $configs as $config ) {

			if( $config->onoroff == 'on' ) add_filter( 'auto_update_theme', '__return_true', 1 ); // Turn on
			if( $config->onoroff != 'on' ) add_filter( 'auto_update_theme', '__return_false', 1 ); // Turn off

		}

	}

}
new CAU_auto_update();

// Send e-mails
require_once('companion-auto-update-check-updates.php');

// Add settings link on plugin page
function cau_settings_link( $links ) { 

	$settings_link = '<a href="tools.php?page=cau-settings">'.__('Settings', 'companion-auto-update' ).'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 

}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'cau_settings_link' );

?>