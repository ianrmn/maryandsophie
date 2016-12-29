<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WOOZOOm_Settings' ) ) :

/**
 * Main WOOZOOm_Settings Class
 *
 * @class WOOZOOm_Settings
 */
 class WOOZOOm_Settings {
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_settings_page' ), 69 );
    }

    /**
     * Add options page
     */
    public function add_plugin_settings_page() {
        // This page will be under "Settings"
        add_submenu_page( 
        	'woocommerce',
        	__('WOOZOOm', 'WOOZOOm'), 
        	__('WOOZOOm', 'WOOZOOm'),
        	'manage_options',
        	'woozoom',
        	array($this, 'settings_callback')
    	); 
    }

    /**
     * Options page callback
     */
    public function settings_callback() {    	
		$message = '';

		$fields = apply_filters( 'woozoom_setting_fields', array(
			'woozoom_activate'			=>	array(
				'label'			=>	__('Activate WOOZOOm', 'WOOZOOm'),
				'type'			=>	'checkbox_single',
				'opts'			=>	array(
					'1'			=>	__('Activate WOOZOOm on product images', 'WOOZOOm'),
				)
			),
	
			'woozoom_main_image_size'	=>	array(
				'label'			=>	__('Main Image Size', 'WOOZOOm'),
				'type'			=>	'woozoom_size'
			),
	
			'woozoom_thumb_image_size'	=>	array(
				'label'			=>	__('Thumbnail Image Size', 'WOOZOOm'),
				'type'			=>	'woozoom_size'
			),
	
			'woozoom_zoom_type'			=>	array(
				'label'			=>	__('Zoom Box Type', 'WOOZOOm'),
				'type'			=>	'select',
				'opts'			=>	apply_filters( 'woozoom_zoom_types', array(
					'window'	=>	__('Window', 'WOOZOOm'),
					'inner'		=>	__('Inner', 'WOOZOOm'),
					'lens'		=>	__('Lens', 'WOOZOOm')
				) )
			),
	
			'woozoom_zoom_box_size'		=>	array(
				'label'			=>	__('Zoom Box Size', 'WOOZOOm'),
				'type'			=>	'woozoom_size',
				'parent'		=>	'woozoom_zoom_type',
				'parent_val'	=>	'window'
			),
	
			'woozoom_scroll_zoom'		=>	array(
				'label'			=>	__('Mouse Scroll Zoom', 'WOOZOOm'),
				'type'			=>	'checkbox_single',
				'opts'			=>	array(
					'1'			=>	__('Activate on mouse scroll to zoom', 'WOOZOOm'),
				),
				'parent'		=>	'woozoom_zoom_type',
				'parent_val'	=>	'window'
			),
	
			'woozoom_zoom_lens_type'	=>	array(
				'label'			=>	__('Zoom Lens Type', 'WOOZOOm'),
				'type'			=>	'select',
				'opts'			=>	apply_filters( 'woozoom_zoom_lens_types', array(
					'square'	=>	__('Square', 'WOOZOOm'),
					'round'		=>	__('Round', 'WOOZOOm')
				) ),
				'parent'		=>	'woozoom_zoom_type',
				'parent_val'	=>	'lens'
			),
	
			'woozoom_zoom_lens_size'	=>	array(
				'label'			=>	__('Zoom Lens Size', 'WOOZOOm'),
				'type'			=>	'text',
				'size'			=>	'3',
				'parent'		=>	'woozoom_zoom_type',
				'parent_val'	=>	'lens'
			),
	
			'woozoom_easing'			=>	array(
				'label'			=>	__('Easing', 'WOOZOOm'),
				'type'			=>	'checkbox_single',
				'opts'			=>	array(
					'1'			=>	__('Add easing effect to images', 'WOOZOOm'),
				)
			),
		) );

		if( !empty( $_POST ) ) {
			if( isset( $_POST['action'] ) && $_POST['action'] == 'woozoom_settings' ) {
				foreach( $fields as $field_name=>$field ) {
					if( isset($_POST[ $field_name ]) ) {
						update_option( $field_name, $_POST[ $field_name ] );
					} else {
						update_option( $field_name, '' );
					}					
				}				
				$message = __('Updated successfully.', 'WOOZOOm');
			}
		}
		?>
        
        <div class="wrap">
        	<?php
		    	$tabs = array('general' => __('General','WOOZOOm'), 'support' => __('Support','WOOZOOm') );        	
		    	$current = ( isset ( $_GET['tab'] ) ) ? $_GET['tab'] : 'general';
				echo '<div id="icon-themes" class="icon32"><br></div>';
				echo '<h2 class="nav-tab-wrapper">';
				foreach( $tabs as $tab => $name ){
					$class = ( $tab == $current ) ? ' nav-tab-active' : '';
					echo "<a class='nav-tab$class' href='?page=woozoom&tab=$tab'>$name</a>";
				}
				echo '</h2>';
			
				switch ( $current ) {
					case 'general' :
						?>  
						<h3><?php _e('General Settings','WOOZOOm'); ?></h3>
						<form method="post" action="">
							<table class="form-table woozoom-form-table" id="woozoom-settings-form">
								<tbody>
									<?php										
										foreach( $fields as $field_name=>$field ) {
											$val = get_option( $field_name );
											
											$atts = '';
											if( isset( $field['parent'] ) &&  isset( $field['parent_val'] ) ) {
												$atts .= ' data-parent="'.$field['parent'].'" data-parent-val="'.$field['parent_val'].'"';
											}
											
											echo '<tr class="field_'.$field['type'].'" '.$atts.'>
												<th scope="row"><label for="'.$field_name.'">'.$field['label'].'</label></th>';
											
												switch( $field['type'] ) {
														case 'select':
															echo '
																<td>
																	<select name="'.$field_name.'" id="'.$field_name.'">';
																		if( !empty( $field['default'] ) ) {
																			echo '<option value="" selected="selected">'.__($field['default'], 'WOOZOOm').'</option>';
																		}

																		if( isset( $field['opts'] ) && !empty( $field['opts'] ) ) {
																			foreach( $field['opts'] as $k=>$v ) {
																				$selected = '';
																				if( $val == $k ) {
																					$selected = 'selected="selected"';
																				}

																				echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'WOOZOOm').'</option>';
																			}
																		}
																		echo '
																	</select>
																</td>
															';
														break;
														
														case 'select_multiple':
															echo '
																<td>
																	<select name="'.$field_name.'[]" id="'.$field_name.'" multiple>';
																		if( !empty( $field['default'] ) ) {
																			echo '<option value="">'.__($field['default'], 'WOOZOOm').'</option>';
																		}

																		if( isset( $field['opts'] ) && !empty( $field['opts'] ) ) {
																			foreach( $field['opts'] as $k=>$v ) {
																				$selected = '';
																				if( !empty($val) && in_array($k, $val) ) {
																					$selected = 'selected="selected"';
																				}

																				echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'WOOZOOm').'</option>';
																			}
																		}
																		echo '
																	</select>
																</td>
															';
														break;
														
														case 'select_chosen':
															$atts = '';
															if( isset( $field['action'] ) ) {
																$atts .= ' data-action="'.$field['action'].'"';
															}															
															if( isset( $field['min_length'] ) ) {
																$atts .= ' data-min-length="'.$field['min_length'].'"';
															}
															if( isset( $field['msg_typing'] ) ) {
																$atts .= ' data-msg-typing="'.$field['msg_typing'].'"';
															}
															if( isset( $field['msg_looking'] ) ) {
																$atts .= ' data-msg-looking="'.$field['msg_looking'].'"';
															}
											
															echo '
																<td>
																	<select name="'.$field_name.'[]" id="'.$field_name.'" '.$atts.' class="field_choosen" multiple>';
																		if( isset( $field['opts'] ) && !empty( $field['opts'] ) ) {
																			foreach( $field['opts'] as $k=>$v ) {
																				$selected = '';
																				if( !empty($val) && in_array($k, $val) ) {
																					$selected = 'selected="selected"';
																				}

																				echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'WOOZOOm').'</option>';
																			}
																		}
																		echo '
																	</select>
																</td>
															';
														break;
												
														case 'checkbox':
															echo '
																<td>
																	<ul>';
																		if( !empty( $field['opts'] ) ) {
																			foreach( $field['opts'] as $k=>$v ) {
																				$checked = '';
																				if( !empty( $val ) ) {
																					if( in_array( $k, $val ) ) {
																						$checked = 'checked="checked"';
																					}
																				}
																				echo '<li><input type="checkbox" name="'.$field_name.'[]" id="'.$field_name.'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field_name.'_'.$k.'">'.__($v, 'WOOZOOm').'</label></li>';
																			}
																		}
																		echo '
																	</ul>
																</td>
															';
														break;
												
														case 'checkbox_single':
															echo '
																<td>';
																	if( !empty( $field['opts'] ) ) {
																		foreach( $field['opts'] as $k=>$v ) {
																			$checked = '';
																			if( !empty( $val ) ) {
																				if( $k == $val ) {
																					$checked = 'checked="checked"';
																				}
																			}
																			echo '<input type="checkbox" name="'.$field_name.'" id="'.$field_name.'" value="'.$k.'" '.$checked.' /> <label for="'.$field_name.'">'.__($v, 'WOOZOOm').'</label>';
																		}
																	}
																	echo '
																</td>
															';
														break;
												
														case 'radio':
															echo '
																<td>';
																	if( !empty( $field['opts'] ) ) {
																		foreach( $field['opts'] as $k=>$v ) {
																			$checked = '';
																			if($val == $k) {
																				$checked = 'checked="checked"';
																			}
																			echo '<input type="radio" name="'.$field_name.'" id="'.$field_name.'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field_name.'_'.$k.'">'.__($v, 'epl').'</label>';
																		}
																	}
																	echo '
																</td>
															';
														break;
												
														case 'woozoom_size':
															echo '
																<td>';
																	echo '
																		<input type="text" name="'.$field_name.'[width]" id="'.$field_name.'_width" placeholder="'.__('Width','WOOZOOm').'" size="4" value="'.stripslashes($val['width']).'" />
																		x
																		<input type="text" name="'.$field_name.'[height]" id="'.$field_name.'_height" placeholder="'.__('Height','WOOZOOm').'" size="4" value="'.stripslashes($val['height']).'" />
																		px
																	';
																echo '
																</td>
															';
														break;
												
														default:
															echo '
																<td>';
																	$atts = '';
																	if( isset( $field['maxlength'] ) &&  $field['maxlength'] > 0 ) {
																		$atts .= ' maxlength="'.$field['maxlength'].'"';
																	}
																	if( isset( $field['size'] ) &&  $field['size'] > 0 ) {
																		$atts .= ' size="'.$field['size'].'"';
																	}
											
																	echo '<input type="'.$field['type'].'" name="'.$field_name.'" id="'.$field_name.'" value="'.stripslashes($val).'" '.$atts.' />';
																echo '
																</td>
															';
												}
											echo '</tr>';
											
											do_action( 'woozoom_settings_after_field_'.$field_name );
										}
									?>
								</tbody>
							</table>
							<input type="hidden" name="action" value="woozoom_settings" />
							<?php submit_button(); ?>
						</form>
						
						<script type="text/javascript">
							jQuery(document).ready(function($) {
							
								//Show/hide dependent settings based on choosen options
								var $data_parents_elems = [];
								
								$('#woozoom-settings-form tr').each(function() {
									var $data_parent = $(this).data('parent');
									if( typeof $data_parent != 'undefined' && $.inArray($data_parent, $data_parents_elems) == -1 ) {
										$data_parents_elems.push($data_parent);
									}
								});
								
								if( $data_parents_elems.length > 0 ) {
									$data_parents_elems.forEach(function($data_parent_elem) {
										$('#'+$data_parent_elem).change(function() {
											var $data_parent_elem_value = $(this).val();
											
											$('#woozoom-settings-form tr').each(function() {
												var $data_parent = $(this).data('parent');
												var $data_parent_val = $(this).data('parent-val');
												
												if( typeof $data_parent != 'undefined' && $data_parent == $data_parent_elem ) {
													if( $data_parent_elem_value == $data_parent_val ) {
														$(this).show();
													} else {
														$(this).hide();
													}
												}
											});
										});
										$('#'+$data_parent_elem).trigger('change');
									});
								}
								
								// Jquery choosen
								$('.field_choosen').each(function() {
									var $min_length = $(this).data('min-length');
									var $msg_typing = $(this).data('msg-typing');
									var $msg_looking = $(this).data('msg-looking');
									var $action = $(this).data('action');
									if( $action != '' && typeof $action != 'undefined' ) {
										$(this).ajaxChosen({
											type			: 'GET',
											url				: '<?php echo admin_url( "admin-ajax.php" ); ?>?action='+$action,
											dataType		: 'json',
											minTermLength	: $min_length,
											keepTypingMsg	: $msg_typing,
											lookingForMsg	: $msg_looking,
										}, function (data) {
											var terms = {};
											$.each(data.items, function (i, val) {
												terms[i] = val;
											});			
											return terms;
										});
									} else {
										$(this).chosen();
									}
								});
							});
						</script>
					  	<?php
					break;
				
		  			case 'support' : ?>
		  				<h3 class="no-margin"><?php _e('Overview Video','WOOZOOm'); ?></h3>
		  				<p><?php _e('A brief walkthrough on configuring the plugin for your site.','WOOZOOm'); ?></p>
		  				<p><iframe width="560" height="315" src="https://www.youtube.com/embed/l4xU2I9D6W0" frameborder="0" allowfullscreen></iframe></p>
		  				<!--h3 class="no-margin"><?php _e('Support Forum','WOOZOOm'); ?></h3>
		  				<p><a href="https://wordpress.org/plugins/woozoom/" target="_blank">https://wordpress.org/plugins/woozoom/</a></p -->
		  				<?php
		  			break;      			
				}
			?>
        </div>
        <?php
    }
    
    /**
     * Success notice 
     */
    function cs_upload_notice() {
    	?>
		<div class="updated">
		    <p><?php _e( 'Updated Successfully!', 'WOOZOOm' ); ?></p>
		</div>
		<?php
	}

}

endif;

new WOOZOOm_Settings();
