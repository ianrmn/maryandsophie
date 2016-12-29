<?php
/**
 * Plugin Name: WOOZOOm - Zooms On Details. Focuses on Sales
 * Description: WOOZOOm is a product image magnifier and an image slider that can be easily customized. It helps enhance user experience and sales.
 * Version: 1.1
 * Author: The JST Team
 * Author URI: http://jst-technologies.com/
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOOZOOm' ) ) :

/**
 * Main WOOZOOm Class
 *
 * @class WOOZOOm
 */
final class WOOZOOm {

	/**
	 * @var string
	 */
	public $version = '1.0';

	/**
	 * @var WOOZOOm The single instance of the class
	 */
	protected static $_instance = null;

	/**
	 * Main WOOZOOm Instance
	 *
	 * Ensures only one instance of WOOZOOm is loaded or can be loaded.
	 *
	 * @see WOOZOOm()
	 * @return WOOZOOm - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * WOOZOOm Constructor.
	 * @access public
	 * @return Curated WOOZOOm
	 */
	public function __construct() {

		// Define constants
		$this->define_constants();
		
		// Include required files
		$this->includes();

		// Init Hook
		add_action( 'init', array( $this, 'init' ), 0 );		
	}


	/**
	 * Define WOOZOOm Constants
	 */
	private function define_constants() {
		define( 'WOOZOOm_PLUGIN_FILE', __FILE__ );
		define( 'WOOZOOm_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'WOOZOOm_VERSION', $this->version );
		define( 'WOOZOOm_PLUGIN_URL', $this->plugin_url() );
		define( 'WOOZOOm_PLUGIN_PATH', $this->plugin_path() );
	}
	
	/**
	 * Include required core files used in admin and on the frontend
	 */
	private function includes() {
		include_once( 'includes/class-woozoom-resizer.php' );
		include_once( 'includes/class-woozoom-frontend.php' );
		
		include_once( 'includes/class-woozoom-install.php' );
		
		if ( is_admin() ) {
			include_once( 'includes/admin/class-woozoom-settings.php' );
			include_once( 'includes/admin/class-woozoom-admin.php' );
		}
	}
	
	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'woozoom', false, plugin_basename( dirname( __FILE__ ) ) . "/i18n/languages" );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}
	
	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Init Cards when WordPress Initialises.
	 */
	public function init() {
		$this->load_plugin_textdomain();		
		do_action( 'WOOZOOm_init' );
	}

}

/**
 * Returns the main instance of WOOZOOm to prevent the need to use globals.
 *
 * @since  1.0
 * @return WOOZOOm
 */

function WOOZOOm() {
	return WOOZOOm::instance();
}

WOOZOOm();

endif;
