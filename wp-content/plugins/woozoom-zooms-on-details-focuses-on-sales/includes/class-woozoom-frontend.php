<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOOZOOm_Frontend' ) ) :

/**
 * Main WOOZOOm_Frontend Class
 *
 * @class WOOZOOm_Frontend
 */
class WOOZOOm_Frontend {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {
		$this->hooks(); // Setup Hooks/Filters
	}
	
	/**
	 * Setup FrontEnd Hooks/Filters
	 */
	 public function hooks() {
	 	add_filter( 'woozoom_activate', array($this, 'woozoom_activate') ); //Enable/Disable WooZoomer
		add_action( 'template_redirect', array( $this, 'render' ) ); // add the action only when the loop is initializate
	}
	
	/**
	 * Enable/Disable WooZoom on Product Pages
	 *
	 * @access public
	 * @return void
	 */
	public function woozoom_activate( $flag=true ) {
		$woozoom_activate = get_option('woozoom_activate');
		if( $woozoom_activate != 1 ) {
			$flag = false;
		}
		return $flag;
	}
	
	/**
	 * Override WooCommerce default hooks to load our template
	 */
	 public function render() {
		if( apply_filters('woozoom_activate', true) ) {
			//change the templates
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
			add_action( 'woocommerce_before_single_product_summary', array($this, 'show_product_images'), 20 );
			add_action( 'woocommerce_product_thumbnails', array($this, 'show_product_thumbnails'), 20 );	
			add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
		}
	}

	/**
	 * Include the css & js script to frontend
	 *
	 * @return string
	 */
	public function enqueue_assets() {
		global $wp_scripts;
		
		//Load WooCommerce Prettyphoto Scripts/Styles
		global $woocommerce;
		$suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$lightbox_en = get_option( 'woocommerce_enable_lightbox' ) == 'yes' ? true : false;
		wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
		wp_enqueue_script( 'prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $suffix . '.js', array( 'jquery' ), $woocommerce->version, true );
		wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );		
		
		//Load Plugin Scripts/Styles
		wp_enqueue_style('woozoom_front_style', WOOZOOm_PLUGIN_URL.'/assets/css/style.css');
		wp_enqueue_style('woozoom_jcarousel_responsive_style', WOOZOOm_PLUGIN_URL.'/assets/css/jcarousel.responsive.css');
		
		wp_enqueue_script( 'woozoom_jquery_elevateZoom', WOOZOOm_PLUGIN_URL.'/assets/js/jquery.elevateZoom-3.0.8.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'woozoom_jquery_jcarousel', WOOZOOm_PLUGIN_URL.'/assets/js/jquery.jcarousel.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'woozoom_api_script', WOOZOOm_PLUGIN_URL.'/assets/js/woozoom.api.js', array('jquery'), '', true );
		wp_enqueue_script( 'woozoom_front_script', WOOZOOm_PLUGIN_URL.'/assets/js/script.js', array('jquery'), '', true );
		
		$woozoom_args = array();
		$fields_array = apply_filters( 'woozoom_js_fields', array('zoom_type', 'zoom_box_size', 'zoom_lens_type', 'zoom_lens_size', 'easing', 'scroll_zoom') );
		foreach($fields_array as $field) {
			$woozoom_args[$field] = get_option('woozoom_'.$field);
		}
		wp_localize_script( 'woozoom_front_script', 'woozoom_js', $woozoom_args );
	}
	
	/**
	 * Change product-single.php template
	 *
	 * @access public
	 * @return void
	 */
	public function show_product_images() {

		/** FIX WOO 2.1 */
		$wc_get_template = function_exists( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
		$wc_get_template( 'single-product/product-image-magnifier.php', array(), '', WOOZOOm_PLUGIN_PATH . '/includes/templates/' );
	}

	/**
	 * Change product-thumbnails.php template
	 *
	 * @access public
	 * @return void
	 */
	public function show_product_thumbnails() {
		$wc_get_template = function_exists( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
		$wc_get_template( 'single-product/product-thumbnails-magnifier.php', array(), '', WOOZOOm_PLUGIN_PATH . '/includes/templates/' );
	}
	
}

endif;

new WOOZOOm_Frontend();
