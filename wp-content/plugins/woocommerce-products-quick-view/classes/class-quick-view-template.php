<?php
/**
 * WC Quick View Template Class
 *
 * Table Of Contents
 *
 * custom_template_display()
 */
class WC_Quick_View_Custom_Template
{
	public static function quick_view_custom_template_load() {
		
		$product_id = $_REQUEST['product_id'];
		$orderby = $_REQUEST['orderby'];
		$is_shop = $_REQUEST['is_shop'];
		$is_category = $_REQUEST['is_category'];
		echo WC_Quick_View_Custom_Template::custom_template_display( $product_id, $orderby, $is_shop, $is_category );
		
		die();
	}
	
	public static function custom_template_display( $product_id, $orderby = 'menu_order', $is_shop = 'no', $is_category = 'no' ) {
		$quick_view_ultimate_popup_tool = get_option('quick_view_ultimate_popup_tool');
		
		$output_html = '';
		ob_start();

		$output_html .= ob_get_clean();
		$output_html .= '<div class="quick_view_popup_container">';
		$output_html .= WC_Quick_View_Custom_Template::custom_template_popup( $product_id, $orderby, $is_shop, $is_category );
		$output_html .= '</div>';
		ob_start();
	?>
    	<script type="text/javascript">
		jQuery(document).ready(function($) {
			<?php if ($quick_view_ultimate_popup_tool == 'colorbox') { ?>
			$(document).find('#cboxContent').append( '<div class="quick_view_popup_loading"></div>' );
			<?php } else { ?>
			setTimeout( function() {
				$(document).find('#fancybox-content').append( '<div class="quick_view_popup_loading"></div>' );
			}, 1000);
			<?php } ?>
		});
		</script>
    <?php
		$output_html .= ob_get_clean();
		
		return $output_html;
	}
	
	public static function custom_template_popup( $product_id, $orderby = 'menu_order', $is_shop = 'no', $is_category = 'no', $next_previous_loaded = 'no' ) {
		global $wc_quick_view_ultimate;
		global $quick_view_template_global_settings;

		$dynamic_gallery_activate = get_option('quick_view_template_dynamic_gallery_activate', 'yes' );
		
		if ( version_compare( WC()->version, '2.2.0', '<' ) ) {
			$my_product = get_product( $product_id );
		} else {
			$my_product = wc_get_product( $product_id );
		}
		$my_post = get_post( $product_id );
		$product_name = get_the_title( $product_id );
		$product_url = get_permalink( $product_id );
		$product_description = apply_filters( 'the_content', $my_post->post_excerpt );
		if ( $quick_view_template_global_settings['pull_description_from'] == 'description' || trim( $product_description ) == '' ) {
			$product_description = apply_filters( 'the_content', $wc_quick_view_ultimate->limit_words( $my_post->post_content , $quick_view_template_global_settings['description_characters'] ) );
		}
		
		
		/**
		 * Add code check show or hide price and add to cart button support for Woo Catalog Visibility Options plugin
		 */
		$show_add_to_cart = true;
		$show_price = true;
		if ( class_exists( 'WC_CVO_Visibility_Options' ) ) {
			global $wc_cvo;
			/**
			 * Check show or hide price
			 */
			 if (($wc_cvo->setting('wc_cvo_prices') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_prices') == 'disabled') {
				 $show_price = false;
			 }
			 
			 /**
			 * Check show or hide add to cart button
			 */
			 if (($wc_cvo->setting('wc_cvo_atc') == 'secured' && !catalog_visibility_user_has_access()) || $wc_cvo->setting('wc_cvo_atc') == 'disabled') {
				 $show_add_to_cart = false;
			 }
		}
		if ( class_exists( 'WC_Email_Inquiry_Functions' ) ) {
			if ( method_exists( 'WC_Email_Inquiry_Functions', 'check_hide_add_cart_button' ) && WC_Email_Inquiry_Functions::check_hide_add_cart_button( $product_id ) ) {
				$show_add_to_cart = false;
			}
			
			if ( method_exists( 'WC_Email_Inquiry_Functions', 'check_hide_price' ) && WC_Email_Inquiry_Functions::check_hide_price( $product_id ) ) {
				$show_price = false;
			}
		}
		
		ob_start();
	?>
        
    	<div class="quick_view_popup_container_inner">
        	<!-- Product Gallery -->
        	<div class="quick_view_product_gallery_container">
            <?php
            if ( 'yes' == $dynamic_gallery_activate ) {
				global $wc_quick_view_template_gallery_class;
				$wc_quick_view_template_gallery_class->wc_dynamic_gallery_display( $product_id, $next_previous_loaded );
			} else {
				global $wc_quick_view_template_default_gallery_class;
				$wc_quick_view_template_default_gallery_class->wc_default_gallery_display( $product_id );
			}
			?>
            </div>
            <div class="quick_view_product_data_container">
            	
                <!-- Product Title -->
            	<div class="quick_view_product_title_container">
                	<a class="quick_view_product_title" href="<?php echo $product_url; ?>"><?php echo $product_name; ?></a>
                </div>
                
                <!-- Product Rating -->
                <?php if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' && $quick_view_template_global_settings['show_rating'] == 1 ) { ?>
                <?php
					$count   = $my_product->get_rating_count();
					$average = $my_product->get_average_rating();
				?>
                <?php if ( $count > 0 ) { ?>
                <div class="quick_view_product_rating_container">
                    <div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'wooquickview' ), $average ); ?>">
                        <span style="width:<?php echo ( ( $average / 5 ) * 100 ); ?>%">
                            <strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php _e( 'out of 5', 'wooquickview' ); ?>
                        </span>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <?php } ?>
                <?php } ?>
                
                <!-- Product Description -->
                <?php if ( $quick_view_template_global_settings['show_description'] == 1 ) { ?>
                <div class="quick_view_product_description_container">
                <?php echo $product_description; ?>
                </div>
                <?php } ?>
                
                <!-- Product Meta -->
                <?php if ( $quick_view_template_global_settings['show_product_meta'] == 1 ) { ?>
                <?php
					$cat_count = sizeof( get_the_terms( $product_id, 'product_cat' ) );
					$tag_count = sizeof( get_the_terms( $product_id, 'product_tag' ) );
				?>
                <div class="quick_view_product_meta_container">
                	<?php if ( wc_product_sku_enabled() && ( $my_product->get_sku() || $my_product->is_type( 'variable' ) ) ) : ?>

                        <div class="quick_view_product_meta quick_view_product_sku"><span class="quick_view_product_meta_name"><?php _e( 'SKU:', 'wooquickview' ); ?></span> <span class="quick_view_product_meta_value"><?php echo ( $sku = $my_product->get_sku() ) ? $sku : __( 'N/A', 'wooquickview' ); ?></span>.</div>
                
                    <?php endif; ?>
                
                    <?php echo $my_product->get_categories( ', ', '<div class="quick_view_product_meta quick_view_product_category"><span class="quick_view_product_meta_name">' . _n( 'Category:', 'Categories:', $cat_count, 'wooquickview' ) . '</span> ', '.</div>' ); ?>
                
                    <?php echo $my_product->get_tags( ', ', '<div class="quick_view_product_meta quick_view_product_tag"><span class="quick_view_product_meta_name">' . _n( 'Tag:', 'Tags:', $tag_count, 'wooquickview' ) . '</span> ', '.</div>' ); ?>
                </div>
                <?php } ?>
                
                <!-- Product Price -->
                <?php if ( $show_price && $quick_view_template_global_settings['show_product_price'] == 1 ) { ?>
                <div class="quick_view_product_price_container">
                	<?php echo $my_product->get_price_html(); ?>
                </div>
                <?php } ?>
                
                <!-- Product Add To Cart -->
                <?php if ( $show_add_to_cart && $quick_view_template_global_settings['show_addtocart'] == 1 ) { ?>
                <div class="quick_view_product_addtocart_container">
					<?php 
					global $product;
					$product = $my_product;
					switch( $my_product->product_type ) {
						case 'variable' :
						case 'variable-subscription':
							WC_Quick_View_Custom_Template::variable_add_to_cart( $my_product );
						break;
						
						case 'external' :
							WC_Quick_View_Custom_Template::external_add_to_cart( $my_product );
						break;
						
						case 'grouped' :
							WC_Quick_View_Custom_Template::grouped_add_to_cart( $my_product );
						break;
						
						default :
							WC_Quick_View_Custom_Template::simple_add_to_cart( $my_product );
						break;
					}
					?>
                </div>
                <?php } ?>

            </div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        <script>
		jQuery(document).ready(function($) {
			$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="quick_view_plus" />' ).prepend( '<input type="button" value="-" class="quick_view_minus" />' );
		});
		</script>
    <?php
		$output_html = ob_get_clean();
		
		return $output_html;
	}
	
	public static function simple_add_to_cart( $product ) {
		global $quick_view_template_global_settings;
				
		if ( $product->is_purchasable() && $product->is_in_stock() ) {
			
			$add_to_cart_bt_class = 'quick_view_add_to_cart_button';
			$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_button_text'] );
			if ( $quick_view_template_global_settings['addtocart_button_type'] == 'link' ) {
				$add_to_cart_bt_class = 'quick_view_add_to_cart_link';
				$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_link_text'] );
			}
			
			echo '<div class="quick_view_product_simple_addtocart_container quick_view_product_addtocart_button_container">';
			
	 		if ( $quick_view_template_global_settings['show_quantity_selector'] == 1 && ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
			), $product );
		
			echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-quantity="1" data-product_sku="%s" class="button %s product_type_%s %s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( $product->id ),
					esc_attr( $product->get_sku() ),
					$product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart add_to_cart_button' : '',
					esc_attr( $product->product_type ),
					esc_attr( $add_to_cart_bt_class ),
					esc_html( apply_filters( 'woocommerce_product_single_add_to_cart_text', $add_to_cart_text, $product ) )
				);
			
			echo '</div>';
		?>
        	<script>
			
			jQuery(document).ready(function($) {
				// Get trigger when qty is changed
				$(document).on( "change", '.quick_view_product_simple_addtocart_container .qty', function( event ) {
					var quantity_number = $(this).val();
					$(this).parents('.quick_view_product_simple_addtocart_container').find('.product_type_simple').attr('data-quantity', quantity_number );
				});
			});
			</script>
        <?php
		}
	}
	
	public static function variable_add_to_cart( $product ) {
		global $quick_view_template_global_settings;
				
		$add_to_cart_bt_class = 'quick_view_add_to_cart_button';
		$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_button_text'] );
		if ( $quick_view_template_global_settings['addtocart_button_type'] == 'link' ) {
			$add_to_cart_bt_class = 'quick_view_add_to_cart_link';
			$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_link_text'] );
		}

		$available_variations = $product->get_available_variations();
		$attributes = $product->get_variation_attributes();
		$attribute_keys = array_keys( $attributes );
	?>
    	<form class="quick_view_variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $product->id; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
			<?php if ( ! empty( $available_variations ) ) : ?>
                <table class="variations quick_view_table_variations" cellspacing="0">
                    <tbody>
                        <?php foreach ( $attributes as $attribute_name => $options ) : ?>
                            <tr>
                                <td class="label"><label for="<?php echo sanitize_title($attribute_name); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
                                <td class="value">
                                	<?php
										$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) : $product->get_variation_default_attribute( $attribute_name );
										wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
										echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations quick_view_reset_variations" href="#">' . __( 'Clear', 'woocommerce' ) . '</a>' ) : '';
									?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
        
                <div class="quick_view_single_variation_wrap" style="display:none;">
        
                    <div class="quick_view_single_variation"></div>
        
                    <div class="quick_view_variations_button">
                    	<div class="quick_view_product_addtocart_button_container">
                    	<?php if ( $quick_view_template_global_settings['show_quantity_selector'] == 1 ) woocommerce_quantity_input( array(), $product ); ?>
                    	<?php
						echo sprintf( '<a href="%s" rel="nofollow" class="quick_view_single_add_to_cart_button single_add_to_cart_button button product_type_%s %s">%s</a>',
								esc_url( $product->add_to_cart_url() ),
								esc_attr( $product->product_type ),
								esc_attr( $add_to_cart_bt_class ),
								esc_html( apply_filters( 'woocommerce_product_single_add_to_cart_text', $add_to_cart_text, $product ) )
							);
						?>
                        </div>
                    </div>
        
                    <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
                    <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->id ); ?>" />
                    <input type="hidden" name="variation_id" value="" />
        
                </div>
                
            <?php else : ?>
        
                <p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
        
            <?php endif; ?>
        
        </form>
    	<script>
		jQuery(document).ready(function($) {
			
			var cart_page_url = '<?php echo str_replace( array( 'https:', 'http:' ), '' , get_permalink( wc_get_page_id( 'cart' ) ) ) ; ?>';
			$('.quick_view_single_add_to_cart_button').click(function(){
				
				var addtocart_object =$(this);
				
				$(this).removeClass('added');
				$(this).addClass('loading');
				
				var all_data = $('.quick_view_variations_form').serialize();
				
				$.get( cart_page_url, all_data, function(response) {
					addtocart_object.addClass('added');
					addtocart_object.removeClass('loading');
					$.post( '<?php echo admin_url('admin-ajax.php', 'relative');?>?action=quick_view_ultimate_reload_cart&security=<?php echo wp_create_nonce("reload-cart");?>', '', function(rsHTML){
						$('.widget_shopping_cart_content').html(rsHTML);
							
					});
				});
				return false;
			});
		});
		</script>
        <script src="<?php echo WC_QUICK_VIEW_ULTIMATE_JS_URL . '/add-to-cart-variation.js'; ?>"></script>
    <?php
	}
	
	public static function grouped_add_to_cart( $product ) {
		global $quick_view_template_global_settings;
				
		$add_to_cart_bt_class = 'quick_view_add_to_cart_button';
		$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_button_text'] );
		if ( $quick_view_template_global_settings['addtocart_button_type'] == 'link' ) {
			$add_to_cart_bt_class = 'quick_view_add_to_cart_link';
			$add_to_cart_text = trim( $quick_view_template_global_settings['addtocart_link_text'] );
		}
		
		$grouped_product = $product;
		$grouped_products = $product->get_children();
		$quantites_required = false;
	?>
    	<form class="quick_view_grouped_form cart" method="post" enctype='multipart/form-data'>
            <table cellspacing="0" class="group_table">
                <tbody>
                    <?php
                        foreach ( $grouped_products as $product_id ) :
							if ( version_compare( WC()->version, '2.2.0', '<' ) ) {
								$product = get_product( $product_id );
							} else {
								$product = wc_get_product( $product_id );
							}
                            ?>
                            <tr>
                            	<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
                                <td>
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                </td>
                                <?php elseif( $quick_view_template_global_settings['show_quantity_selector'] == 1 ) : ?>
                                <td>
                                        <?php
                                            $quantites_required = true;
                                            woocommerce_quantity_input( array( 'input_name' => 'quantity[' . $product_id . ']', 'input_value' => '0' ), $product );
                                        ?>
                                </td>
                                <?php else : ?>
                                <?php $quantites_required = true; ?>
                                <input type="hidden" size="4" class="input-text qty text" title="Qty" value="1" name="quantity[<?php echo $product_id; ?>]" step="1">
                                <?php endif; ?>
        
                                <td class="label">
                                    <label for="product-<?php echo $product_id; ?>">
                                        <?php echo $product->is_visible() ? '<a href="' . get_permalink( $product_id ) . '">' . get_the_title( $product_id ) . '</a>' : get_the_title( $product_id ); ?>
                                    </label>
                                </td>
                
                                <td class="price">
                                    <?php
                                        echo $product->get_price_html();
        
                                        if ( ( $availability = $product->get_availability() ) && $availability['availability'] )
                                            echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
        
                        $product = $grouped_product;
                    ?>
                </tbody>
            </table>
        
            <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
        
            <?php if ( $quantites_required ) : ?>
        		<?php
					echo sprintf( '<div class="quick_view_product_addtocart_button_container"><a href="%s" rel="nofollow" class="single_add_to_cart_button button product_type_%s %s">%s</a></div>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->product_type ),
							esc_attr( $add_to_cart_bt_class ),
							esc_html( apply_filters( 'woocommerce_product_single_add_to_cart_text', $add_to_cart_text, $product ) )
						);
				?>
        
            <?php endif; ?>
        </form>
    	<script>
		jQuery(document).ready(function($) {
			
			var cart_page_url = '<?php str_replace( array( 'https:', 'http:' ), '' , get_permalink( wc_get_page_id( 'cart' ) ) ) ; ?>';
			$('.single_add_to_cart_button').click(function(){
				
				var addtocart_object =$(this);
				
				$(this).removeClass('added');
				$(this).addClass('loading');
				
				var all_data = $('.quick_view_grouped_form').serialize();
				
				$.get( cart_page_url, all_data, function(response) {
					addtocart_object.addClass('added');
					addtocart_object.removeClass('loading');
					$.post( '<?php echo admin_url('admin-ajax.php', 'relative');?>?action=quick_view_ultimate_reload_cart&security=<?php echo wp_create_nonce("reload-cart");?>', '', function(rsHTML){
						$('.widget_shopping_cart_content').html(rsHTML);
							
					});
				});
				return false;
			});
		});
		</script>
    <?php
	}
	
	public static function external_add_to_cart( $product ) {
		global $quick_view_template_global_settings;
		
		$add_to_cart_bt_class = 'quick_view_add_to_cart_button';
		if ( $quick_view_template_global_settings['addtocart_button_type'] == 'link' ) {
			$add_to_cart_bt_class = 'quick_view_add_to_cart_link';
		}
		
		$product_url = $product->get_product_url();
		$button_text = $product->single_add_to_cart_text();
	?>
    	<div class="quick_view_product_addtocart_button_container"><a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt <?php echo $add_to_cart_bt_class; ?>"><?php echo $button_text; ?></a></div>
    <?php
	}
}
?>
