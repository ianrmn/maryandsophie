<?php
/**
 * WC_Quick_View_Ultimate Class
 *
 * Table Of Contents
 *
 * WC_Quick_View_Ultimate()
 * init()
 * fix_responsi_theme()
 * fix_style_js_responsi_theme()
 * add_quick_view_ultimate_under_image_each_products()
 * add_quick_view_ultimate_hover_each_products()
 * quick_view_ultimate_wp_enqueue_script()
 * quick_view_ultimate_wp_enqueue_style()
 * quick_view_ultimate_popup()
 * quick_view_ultimate_reload_cart()
 * a3_wp_admin()
 * plugin_extension()
 * plugin_extra_links()
 */
class WC_Quick_View_Ultimate
{
	public function __construct() {
		$this->init();
	}
	
	public function init () {
		add_action( 'wp', array( $this, 'set_customer_cookie' ) );

		//Fix Responsi Theme
		add_action( 'woocommerce_before_shop_loop_item', array( $this, 'fix_responsi_theme'), 42 );
		
		//Add Quick View Hover Each Products
		//add_action( 'woocommerce_after_shop_loop_item', array( $this, 'add_quick_view_ultimate_hover_each_products'), 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'add_quick_view_ultimate_hover_each_products'), 11 );
		
		//Add Quick View Under Image Each Products
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'add_quick_view_ultimate_under_image_each_products'), 11 );
		
		//Enqueue Script
		add_action( 'wp_enqueue_scripts', array ( $this, 'frontend_register_scripts') );
		add_action( 'woocommerce_after_shop_loop', array( $this, 'quick_view_ultimate_wp_enqueue_style'), 13 );
		add_action( 'wp_head', array( $this, 'fix_style_js_responsi_theme'), 13 );
		
		// Include google fonts into header
		add_action( 'wp_enqueue_scripts', array( $this, 'add_google_fonts'), 9 );
		
		// Add script check if checkout then close popup and redirect to checkout page
		add_action( 'wp_head', array( $this, 'redirect_to_checkout_page_from_popup') );
		
		//Enqueue Script On Home Page Responsi	
		add_action( 'wp_footer', array( $this, 'quick_view_ultimate_popup') );
		
		//Ajax Action
		add_action('wp_ajax_quick_view_ultimate_reload_cart', array( $this, 'quick_view_ultimate_reload_cart') );
		add_action('wp_ajax_nopriv_quick_view_ultimate_reload_cart', array( $this, 'quick_view_ultimate_reload_cart') );
	}

	public function frontend_register_scripts() {
		$quick_view_ultimate_enable = get_option('quick_view_ultimate_enable');
		if ( 'no' == $quick_view_ultimate_enable ) return ;

		$quick_view_ultimate_type = get_option('quick_view_ultimate_type');
		if ( 'hover' == $quick_view_ultimate_type ) {
			wp_register_script( 'quick-view-hover-script', WC_QUICK_VIEW_ULTIMATE_JS_URL.'/quick_view_hover.js', array('jquery'), WC_QUICK_VIEW_ULTIMATE_VERSION, true );
			wp_enqueue_script( 'quick-view-hover-script' );
		}

		$quick_view_ultimate_popup_content = get_option('quick_view_ultimate_popup_content', 'custom_template' );
		if ( 'custom_template' == $quick_view_ultimate_popup_content ) {
			wp_register_script( 'quick-view-popup-script', WC_QUICK_VIEW_ULTIMATE_JS_URL.'/quick_view_ultimate.js', array('jquery'), WC_QUICK_VIEW_ULTIMATE_VERSION, true );
			wp_enqueue_script( 'quick-view-popup-script' );
		}

		wp_localize_script( 'quick-view-popup-script',
			'wc_qv_vars',
			apply_filters( 'wc_qv_vars', array(
				'ajax_url' => admin_url( 'admin-ajax.php', 'relative' )
			) )
		);
	}

	public function set_customer_cookie() {
		if ( ! is_admin() ) {
			WC()->session->set_customer_session_cookie(true);
		}
	}
	
	public function redirect_to_checkout_page_from_popup() {
		if ( is_checkout() ) {
			$woocommerce_db_version = get_option( 'woocommerce_db_version', null );
	?>
    	<script type="text/javascript">
		if ( window.self !== window.top ) {
			self.parent.location.href = '<?php if ( version_compare( $woocommerce_db_version, '2.1', '<' ) ) { echo get_permalink( woocommerce_get_page_id( 'checkout' ) ); } else { echo get_permalink( wc_get_page_id( 'checkout' ) ); } ?>';
		}
		</script>
    <?php
		}
	}
	
	public function fix_responsi_theme(){
		if(function_exists('add_responsi_pagination_theme')){
			remove_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'add_quick_view_ultimate_under_image_each_products'), 11 );
			add_action( 'responsi_before_shop_loop_item_content_container', array( $this, 'add_quick_view_ultimate_under_image_each_products'), 11 );
		}
	}
	
	public function add_google_fonts() {
		global $wc_qv_fonts_face;
		$quick_view_ultimate_on_hover_bt_font = get_option( 'quick_view_ultimate_on_hover_bt_font' );
		$quick_view_ultimate_under_image_link_font = get_option( 'quick_view_ultimate_under_image_link_font' );
		$quick_view_ultimate_under_image_bt_font = get_option( 'quick_view_ultimate_under_image_bt_font' );
		
		$google_fonts = array( $quick_view_ultimate_on_hover_bt_font['face'], $quick_view_ultimate_under_image_link_font['face'], $quick_view_ultimate_under_image_bt_font['face'] );
		
		$wc_qv_fonts_face->generate_google_webfonts( $google_fonts );
	}
	
	public function fix_style_js_responsi_theme(){
		if ( (is_home() && function_exists('add_responsi_pagination_theme')) ){
			add_action( 'woo_main_end', array( $this, 'quick_view_ultimate_wp_enqueue_style'), 13 );
			add_action( 'a3rev_main_end', array( $this, 'quick_view_ultimate_wp_enqueue_style'), 13 );
		}
		if ( is_singular('product') ) {
			add_action( 'wp_footer', array( $this, 'quick_view_ultimate_wp_enqueue_style'), 13 );
		}
	}
	
	public function add_quick_view_ultimate_under_image_each_products(){
		
		//if (!is_tax( 'product_cat' ) && !is_post_type_archive('product') && !is_tax( 'product_tag' )) return; // Not on product page - return
		
		$quick_view_ultimate_enable = get_option('quick_view_ultimate_enable');
		$quick_view_ultimate_type = get_option('quick_view_ultimate_type');
		
		$do_this = false;
		
		if( $quick_view_ultimate_enable == 'yes' ) $do_this = true;
		if( !$do_this ) return;
		if( $quick_view_ultimate_type != 'under' ) return;
		
		$quick_view_ultimate_popup_tool = get_option( 'quick_view_ultimate_popup_tool' );
		$quick_view_ultimate_under_image_bt_type = get_option( 'quick_view_ultimate_under_image_bt_type' );
		$quick_view_ultimate_under_image_link_text = esc_attr( stripslashes( get_option( 'quick_view_ultimate_under_image_link_text' ) ) );
		$quick_view_ultimate_under_image_bt_text = esc_attr( stripslashes( get_option( 'quick_view_ultimate_under_image_bt_text' ) ) );
		
		$quick_view_ultimate_button = '';
		$link_text = $quick_view_ultimate_under_image_link_text;
		$class = $quick_view_ultimate_popup_tool.' quick_view_ultimate_under_link quick_view_ultimate_click';
		if( $quick_view_ultimate_under_image_bt_type == 'button' ){
			$link_text = $quick_view_ultimate_under_image_bt_text;
			$class = $quick_view_ultimate_popup_tool.' quick_view_ultimate_under_button quick_view_ultimate_click';
		}
		
		$quick_view_ultimate_button .= '<div style="clear:both;"></div><div class="quick_view_ultimate_container_under"><div class="quick_view_ultimate_content_under"><a class="'.$class.'" id="'.get_the_ID().'" href="'.get_permalink().'" data-link="'.get_permalink().'">'.$link_text.'</a></div></div><div style="clear:both;"></div>';
		
		echo $quick_view_ultimate_button;

	}
	
	public function add_quick_view_ultimate_hover_each_products(){
		
		//if (!is_tax( 'product_cat' ) && !is_post_type_archive('product') && !is_tax( 'product_tag' )) return; // Not on product page - return
		
		$quick_view_ultimate_enable = get_option('quick_view_ultimate_enable');
		$quick_view_ultimate_type = get_option('quick_view_ultimate_type');
		
		$do_this = false;
		
		if( $quick_view_ultimate_enable == 'yes' ) $do_this = true;
		
		if( !$do_this ) return;
		if( $quick_view_ultimate_type != 'hover' ) return;
		
		$quick_view_ultimate_on_hover_bt_alink = esc_attr( stripslashes( get_option('quick_view_ultimate_on_hover_bt_alink') ) );
		$quick_view_ultimate_popup_tool = get_option( 'quick_view_ultimate_popup_tool' );
		$quick_view_ultimate_on_hover_bt_text = esc_attr( stripslashes( get_option( 'quick_view_ultimate_on_hover_bt_text' ) ) );
		
		$quick_view_ultimate_button = '';
		
		$class = $quick_view_ultimate_popup_tool.' quick_view_ultimate_button quick_view_ultimate_click';
		
		$quick_view_ultimate_button .= '<div class="quick_view_ultimate_container" position="'.$quick_view_ultimate_on_hover_bt_alink.'"><div class="quick_view_ultimate_content"><span id="'.get_the_ID().'" data-link="'.get_permalink().'" class="'.$class.'">'.$quick_view_ultimate_on_hover_bt_text.'</span></div></div>';
		echo $quick_view_ultimate_button;
		
	}

	public function quick_view_ultimate_wp_enqueue_style(){
		$quick_view_ultimate_enable = get_option('quick_view_ultimate_enable');
		if ( 'no' == $quick_view_ultimate_enable ) return ;

		wp_enqueue_style( 'quick-view-css', WC_QUICK_VIEW_ULTIMATE_CSS_URL.'/style.css', array(), WC_QUICK_VIEW_ULTIMATE_VERSION );

		$quick_view_ultimate_popup_content = get_option('quick_view_ultimate_popup_content', 'custom_template' );
		$dynamic_gallery_activate = get_option('quick_view_template_dynamic_gallery_activate', 'yes' );
		if ( 'custom_template' == $quick_view_ultimate_popup_content ) {

			if ( 'yes' == $dynamic_gallery_activate ) {
				wp_enqueue_style( 'a3-dgallery-style' );
				wp_enqueue_script( 'a3-dgallery-script' );
			}

			$_upload_dir = wp_upload_dir();
			if ( file_exists( $_upload_dir['basedir'] . '/sass/wc_product_quick_view.min.css' ) ) {
				global $wc_qv_less;
				wp_enqueue_style( 'a3' . $wc_qv_less->css_file_name );
			} else {
				include( WC_QUICK_VIEW_ULTIMATE_DIR . '/templates/customized_popup_style.php' );
			}
		}
	}
	
	public function quick_view_ultimate_popup(){
		global $wc_qv_admin_interface;
		global $woocommerce;
		$suffix 				= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$woocommerce_db_version = get_option( 'woocommerce_db_version', null );
		
		$frontend_script_path 	= ( ( version_compare( $woocommerce_db_version, '2.1', '<' ) ) ? $woocommerce->plugin_url() : WC()->plugin_url() ) . '/assets/js/frontend/';
		
		$quick_view_ultimate_enable = get_option('quick_view_ultimate_enable');
		if ( 'no' == $quick_view_ultimate_enable ) return ;

		$quick_view_ultimate_popup_tool = get_option('quick_view_ultimate_popup_tool');
		
		if ($quick_view_ultimate_popup_tool == 'colorbox') {
			wp_enqueue_style( 'a3_colorbox_style', WC_QUICK_VIEW_ULTIMATE_JS_URL . '/colorbox/colorbox.css' );
			wp_enqueue_script( 'colorbox_script', WC_QUICK_VIEW_ULTIMATE_JS_URL . '/colorbox/jquery.colorbox'.$suffix.'.js', array('jquery'), false, true );
		} elseif ($quick_view_ultimate_popup_tool == 'fancybox') {
			wp_enqueue_style( 'woocommerce_fancybox_styles', WC_QUICK_VIEW_ULTIMATE_JS_URL . '/fancybox/fancybox.css' );
			wp_enqueue_script( 'fancybox', WC_QUICK_VIEW_ULTIMATE_JS_URL . '/fancybox/fancybox'.$suffix.'.js', array('jquery'), false, true );
		}
		wp_enqueue_style( 'quick-view-css', WC_QUICK_VIEW_ULTIMATE_CSS_URL.'/style.css', array(), WC_QUICK_VIEW_ULTIMATE_VERSION );

		$quick_view_ultimate_popup_content = get_option('quick_view_ultimate_popup_content', 'custom_template' );
		$dynamic_gallery_activate = get_option('quick_view_template_dynamic_gallery_activate', 'yes' );
		if ( 'custom_template' == $quick_view_ultimate_popup_content ) {

			if ( 'yes' == $dynamic_gallery_activate ) {
				wp_enqueue_style( 'a3-dgallery-style' );
				wp_enqueue_script( 'a3-dgallery-script' );
			}

			$_upload_dir = wp_upload_dir();
			if ( file_exists( $_upload_dir['basedir'] . '/sass/wc_product_quick_view.min.css' ) ) {
				global $wc_qv_less;
				wp_enqueue_style( 'a3' . $wc_qv_less->css_file_name );
			} else {
				include( WC_QUICK_VIEW_ULTIMATE_DIR . '/templates/customized_popup_style.php' );
			}
		}
		
		$quick_view_ultimate_fancybox_center_on_scroll = get_option('quick_view_ultimate_fancybox_center_on_scroll');
		if ( $quick_view_ultimate_fancybox_center_on_scroll == '' ) $quick_view_ultimate_fancybox_center_on_scroll = 'false';
		
		$quick_view_ultimate_fancybox_transition_in = get_option('quick_view_ultimate_fancybox_transition_in');
		$quick_view_ultimate_fancybox_transition_out = get_option('quick_view_ultimate_fancybox_transition_out');
		$quick_view_ultimate_fancybox_speed_in = get_option('quick_view_ultimate_fancybox_speed_in');
		$quick_view_ultimate_fancybox_speed_out = get_option('quick_view_ultimate_fancybox_speed_out');
		$quick_view_ultimate_fancybox_overlay_color = get_option('quick_view_ultimate_fancybox_overlay_color');
		
		$quick_view_ultimate_colorbox_center_on_scroll = get_option('quick_view_ultimate_colorbox_center_on_scroll');
		if ( $quick_view_ultimate_colorbox_center_on_scroll == '' ) $quick_view_ultimate_colorbox_center_on_scroll = 'false';
		$quick_view_ultimate_colorbox_transition = get_option('quick_view_ultimate_colorbox_transition');
		$quick_view_ultimate_colorbox_speed = get_option('quick_view_ultimate_colorbox_speed');
		$quick_view_ultimate_colorbox_overlay_color = get_option('quick_view_ultimate_colorbox_overlay_color');
		
		?>
		<script type="text/javascript">
			function wc_qv_getWidth() {
				xWidth = null;
				if(window.screen != null)
				  xWidth = window.screen.availWidth;
			
				if(window.innerWidth != null)
				  xWidth = window.innerWidth;
			
				if(document.body != null)
				  xWidth = document.body.clientWidth;
			
				return xWidth;
			}
			<?php
			if ( $quick_view_ultimate_popup_tool == 'fancybox' ) {
				
			?>
			jQuery(document).on("click", ".quick_view_ultimate_click.fancybox", function(){
			
				var product_id = jQuery(this).attr('id');
				var product_url = jQuery(this).attr('data-link');
				
				var obj = jQuery(this);
				var auto_Dimensions = true;
				
				<?php if ( $quick_view_ultimate_popup_content != 'custom_template' ) { ?>
				// detect iOS to fix scroll for iframe on fancybox
				var iOS = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
				if ( iOS ) {
					jQuery('#fancybox-content').attr( "style", "overflow-y: auto !important; -webkit-overflow-scrolling: touch !important;" );
				}
				<?php } ?>
				
				<?php if ( $quick_view_ultimate_popup_content == 'full_page' ) { ?>
				var url = product_url;
				<?php } else { ?>
				var is_shop = '<?php echo ( is_shop() ? 'yes': 'no' ); ?>';
				<?php if ( is_product_category() ) { 
				$term = get_queried_object();
				?>
				var is_category = '<?php echo $term->term_id; ?>';
				<?php } else { ?>
				var is_category = 'no';
				<?php } ?>
				var orderby = jQuery('.woocommerce-ordering').find('select[name=orderby]').val();
				var url = '<?php echo admin_url('admin-ajax.php', 'relative');?>'+'?action=quick_view_custom_template_load&product_id='+product_id+'&is_shop='+is_shop+'&is_category='+is_category+'&orderby='+orderby+'&security=<?php echo wp_create_nonce("quick_view_custom_template_load");?>';
				auto_Dimensions = false;
				<?php } ?>
				
				var popup_wide = <?php echo (int) get_option('quick_view_ultimate_fancybox_popup_width', 600 ); ?>;
				var popup_tall = <?php echo (int) get_option('quick_view_ultimate_fancybox_popup_height', 500 ); ?>;
				if ( wc_qv_getWidth()  <= 600 ) { 
					popup_wide = '90%';
					popup_tall = '90%'; 
				}
			
                jQuery.fancybox({
					<?php if ( $quick_view_ultimate_popup_content == 'custom_template' ) { ?>
					content: url,
					type: "ajax",
					<?php } else { ?>
					href: url,
					type: "iframe",
					<?php } ?>
					centerOnScroll : <?php echo $quick_view_ultimate_fancybox_center_on_scroll;?>,
					transitionIn : '<?php echo $quick_view_ultimate_fancybox_transition_in;?>', 
					transitionOut: '<?php echo $quick_view_ultimate_fancybox_transition_out;?>',
					easingIn: 'swing',
					easingOut: 'swing',
					speedIn : <?php echo $quick_view_ultimate_fancybox_speed_in;?>,
					speedOut : <?php echo $quick_view_ultimate_fancybox_speed_out;?>,
					width: popup_wide,
					autoScale: true,
					height: popup_tall,
					margin: 0,
					padding: 10,
					maxWidth: "90%",
					maxHeight: "90%",
					autoDimensions: auto_Dimensions,
					overlayColor: '<?php echo str_replace( array( 'background-color:', '!important', ';' ), '', $wc_qv_admin_interface->generate_background_color_css( $quick_view_ultimate_fancybox_overlay_color ) );?>',
					showCloseButton : true,
					openEffect	: "none",
					closeEffect	: "none",
					onClosed: function() {
						jQuery.post( '<?php echo admin_url('admin-ajax.php', 'relative');?>?action=quick_view_ultimate_reload_cart&security=<?php echo wp_create_nonce("reload-cart");?>', '', function(rsHTML){
							jQuery('.widget_shopping_cart_content').html(rsHTML);
							
						});
					}
                });

				return false;
			});
			<?php		
			}elseif( $quick_view_ultimate_popup_tool == 'colorbox' ){
			?>
			jQuery(document).bind('cbox_cleanup', function(){
				jQuery.post( '<?php echo admin_url('admin-ajax.php', 'relative');?>?action=quick_view_ultimate_reload_cart&security=<?php echo wp_create_nonce("reload-cart");?>', '', function(rsHTML){
					jQuery('.widget_shopping_cart_content').html(rsHTML);
					
				});
			});
			jQuery(document).on("click", ".quick_view_ultimate_click.colorbox", function(){
				
				var product_id = jQuery(this).attr('id');
				var product_url = jQuery(this).attr('data-link');
				<?php if ( get_option('quick_view_ultimate_popup_content', '' ) == 'full_page' ) { ?>
				var url = product_url;
				<?php } elseif ( $quick_view_ultimate_popup_content == 'custom_template' ) { ?>
				var is_shop = '<?php echo ( is_shop() ? 'yes': 'no' ); ?>';
				<?php if ( is_product_category() ) { 
				$term = get_queried_object();
				?>
				var is_category = '<?php echo $term->term_id; ?>';
				<?php } else { ?>
				var is_category = 'no';
				<?php } ?>
				var orderby = jQuery('.woocommerce-ordering').find('select[name=orderby]').val();
				var url = '<?php echo admin_url('admin-ajax.php', 'relative');?>'+'?action=quick_view_custom_template_load&product_id='+product_id+'&is_shop='+is_shop+'&is_category='+is_category+'&orderby='+orderby+'&security=<?php echo wp_create_nonce("quick_view_custom_template_load");?>';
				<?php } else { ?>
                var url = '<?php echo admin_url('admin-ajax.php', 'relative');?>'+'?action=quick_view_ultimate_clicked&product_id='+product_id+'&product_url='+product_url+'&security=<?php echo wp_create_nonce("quick-view-clicked");?>';
				<?php } ?>
				
				var popup_wide = <?php echo (int) get_option('quick_view_ultimate_colorbox_popup_width', 600 ); ?>;
				var popup_tall = <?php echo (int) get_option('quick_view_ultimate_colorbox_popup_height', 500 ); ?>;
				if ( wc_qv_getWidth()  <= 568 ) {
					popup_wide = '100%';
					popup_tall = '90%';
				}
				
				jQuery.colorbox({
					href		: url,
					<?php if ( $quick_view_ultimate_popup_content != 'custom_template' ) { ?>
					iframe		: true,
					<?php } ?>
					opacity		: 0.85,
					scrolling	: true,
					initialWidth: 100,
					initialHeight: 100,
					innerWidth	: popup_wide,
					innerHeight	: popup_tall,
					maxWidth  	: '100%',
					maxHeight  	: '90%',
					returnFocus : true,
					transition  : '<?php echo $quick_view_ultimate_colorbox_transition;?>',
					speed		: <?php echo $quick_view_ultimate_colorbox_speed;?>,
					fixed		: <?php echo $quick_view_ultimate_colorbox_center_on_scroll;?>
				});
				return false;
			});
			<?php	
			}
			?>
			
		</script>
        <style type="text/css">
		#cboxOverlay{ <?php echo $wc_qv_admin_interface->generate_background_color_css( $quick_view_ultimate_colorbox_overlay_color ); ?> }
        </style>
		<?php

		global $wc_quick_view_ultimate_style;
		$wc_quick_view_ultimate_style->button_style_under_image();
		$wc_quick_view_ultimate_style->button_style_show_on_hover();
	}
	
	public function strip_shortcodes ($content='') {
		$content = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content);
		
		return $content;
	}
	
	public function limit_words($str='',$len=100,$more=true) {
		if (trim($len) == '' || $len < 0) $len = 100;
	   if ( $str=="" || $str==NULL ) return $str;
	   if ( is_array($str) ) return $str;
	   $str = trim($str);
	   $str = strip_tags($str);
	   if ( strlen($str) <= $len ) return $str;
	   $str = substr($str,0,$len);
	   if ( $str != "" ) {
			if ( !substr_count($str," ") ) {
					  if ( $more ) $str .= " ...";
					return $str;
			}
			while( strlen($str) && ($str[strlen($str)-1] != " ") ) {
					$str = substr($str,0,-1);
			}
			$str = substr($str,0,-1);
			if ( $more ) $str .= " ...";
			}
			return $str;
	}

	
	public function quick_view_ultimate_reload_cart() {
		global $woocommerce;
		if(function_exists('woocommerce_mini_cart')) woocommerce_mini_cart() ;
		die();
	}
	
	public function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WC_QUICK_VIEW_ULTIMATE_CSS_URL . '/a3_wp_admin.css' );
	}
	
	public function admin_sidebar_menu_css() {
		wp_enqueue_style( 'a3rev-wc-qv-admin-sidebar-menu-style', WC_QUICK_VIEW_ULTIMATE_CSS_URL . '/admin_sidebar_menu.css' );
	}
	
	public function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WC_QUICK_VIEW_ULTIMATE_NAME) {
			return $links;
		}

		global $wc_qv_admin_init;
		$links[] = '<a href="http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce-quick-view-ultimate/" target="_blank">'.__('Documentation', 'wooquickview').'</a>';
		$links[] = '<a href="'.$wc_qv_admin_init->support_url.'" target="_blank">'.__('Support', 'wooquickview').'</a>';
		return $links;
	}

	public function settings_plugin_links($actions) {
		$actions = array_merge( array( 'settings' => '<a href="admin.php?page=wc-quick-view">' . __( 'Settings', 'wooquickview' ) . '</a>' ), $actions );

		return $actions;
	}

	public function plugin_extension_box( $boxes = array() ) {
		global $wc_qv_admin_init;

		$support_box = '<a href="'.$wc_qv_admin_init->support_url.'" target="_blank" alt="'.__('Go to Support Forum', 'wooquickview').'"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/go-to-support-forum.png" /></a>';

		$boxes[] = array(
			'content' => $support_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$review_box = '<div style="margin-bottom: 5px; font-size: 12px;"><strong>' . __('Is this plugin is just what you needed? If so', 'wooquickview') . '</strong></div>';
        $review_box .= '<a href="https://wordpress.org/support/view/plugin-reviews/woocommerce-products-quick-view#postform" target="_blank" alt="'.__('Submit Review for Plugin on WordPress', 'wooquickview').'"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/a-5-star-rating-would-be-appreciated.png" /></a>';

        $boxes[] = array(
            'content' => $review_box,
            'css' => 'border: none; padding: 0; background: none;'
        );


		$free_woocommerce_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WooCommerce Plugins', 'wooquickview').'"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/free-woocommerce-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $free_woocommerce_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$free_wordpress_box = '<a href="https://profiles.wordpress.org/a3rev/#content-plugins" target="_blank" alt="'.__('Free WordPress Plugins', 'wooquickview').'"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/free-wordpress-plugins.png" /></a>';

		$boxes[] = array(
			'content' => $free_wordpress_box,
			'css' => 'border: none; padding: 0; background: none;'
		);

		$connect_box = '<div style="margin-bottom: 5px;">' . __('Connect with us via','wooquickview') . '</div>';
		$connect_box .= '<a href="https://www.facebook.com/a3rev" target="_blank" alt="'.__('a3rev Facebook', 'wooquickview').'" style="margin-right: 5px;"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/follow-facebook.png" /></a> ';
		$connect_box .= '<a href="https://twitter.com/a3rev" target="_blank" alt="'.__('a3rev Twitter', 'wooquickview').'"><img src="'.WC_QUICK_VIEW_ULTIMATE_IMAGES_URL.'/follow-twitter.png" /></a>';

		$boxes[] = array(
			'content' => $connect_box,
			'css' => 'border-color: #3a5795;'
		);

		return $boxes;
	}
}

$GLOBALS['wc_quick_view_ultimate'] = new WC_Quick_View_Ultimate();

?>
