<?php

if (!class_exists('Redux')) {
    return;
}

function sviremoveDemoModeLink() { // Be sure to rename this function to something more unique
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
    }
}

add_action('init', 'sviremoveDemoModeLink');

// This is your option name where all the Redux data is stored.
$opt_name = "woosvi_options";

$args = array(
    'opt_name' => 'woosvi_options',
    'use_cdn' => TRUE,
    'dev_mode' => false,
    'forced_dev_mode_off' => false,
    'display_name' => 'SMART VARIATIONS IMAGES',
    'display_version' => SL_VERSION,
    'page_slug' => 'woocommerce_svi',
    'page_title' => 'Smart Variations Images for WooCommerce',
    'update_notice' => TRUE,
    'admin_bar' => TRUE,
    'menu_type' => 'submenu',
    'menu_title' => 'SVI',
    'page_parent' => 'woocommerce',
    'customizer' => FALSE,
    'default_mark' => '*',
    'hints' => array(
        'icon' => 'el el-adjust-alt',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'duration' => '500',
                'event' => 'mouseleave unfocus',
            ),
        ),
    ),
    'output_tag' => TRUE,
    'cdn_check_time' => '1440',
    'page_permissions' => 'manage_woocommerce',
    'save_defaults' => TRUE,
    'database' => 'options',
    'transient_time' => '3600',
    'network_sites' => TRUE,
);

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

Redux::setSection($opt_name, array(
    'title' => __('Global', 'wc_svi'),
    'id' => 'general',
    //'desc' => __('General settings', 'wc_svi'),
    'icon' => 'el el-home',
    'fields' => array(
        array(
            'id' => 'default',
            'type' => 'switch',
            'title' => __('Enable SVI', 'wc_svi'),
            'desc' => __('Activate or Deactivate SVI from running on your site.', 'wc_svi'),
            'on' => __('Activate', 'wc_svi'),
            'off' => __('Deactivate', 'wc_svi'),
            'default' => false,
        ),
        array(
            'id' => 'svi1_info',
            'type' => 'info',
            'title' => __('Cart Image (PRO VERSION)', 'wc_svi'),
            'style' => 'warning',
            'desc' => __('Display choosen variation image in cart/checkout instead of default Product image.', 'wc_svi')
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Lightbox', 'wc_svi'),
    'id' => 'lightbox-svi',
    'fields' => array(
        array(
            'id' => 'lightbox',
            'type' => 'switch',
            'required' => array(
                array('default', '=', '1'),
            ),
            'title' => __('Activate Lightbox', 'wc_svi'),
            //'subtitle' => __('Also called a "fold" parent.', 'wc_svi'),
            //'desc' => __('Items set with a fold to this ID will hide unless this is set to the appropriate value.', 'wc_svi'),
            'default' => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Slider', 'wc_svi'),
    'id' => 'slider-subsection',
    //'desc' => __('For full documentation on validation, visit: ', 'wc_svi') . '<a href="//docs.reduxframework.com/core/the-basics/required/" target="_blank">docs.reduxframework.com/core/the-basics/required/</a>',
    'fields' => array(
        array(
            'id' => 'svi8_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Activate Slider (PRO VERSION)', 'wc_svi'),
        ),
        array(
            'id' => 'svi5_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Navigation (PRO VERSION)', 'wc_svi'),
            'subtitle' => __('Add arrow navigation to main image.', 'wc_svi'),
            'desc' => __('Incompatible with Magnifier Lens.', 'wc_svi'),
        ),
        array(
            'id' => 'svi6_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Nav Color (PRO VERSION)', 'wc_svi'),
            'desc' => __('Select your navigation color.', 'wc_svi'),
        ),
        array(
            'id' => 'svi7_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Thumbnail Position (PRO VERSION)', 'wc_svi'),
            'subtitle' => __('Select thumnails position. Bottom, Left or right.', 'wc_svi'),
            'desc' => __('Left and Right positions not available on mobile phones, falls back to horizontal.', 'wc_svi'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Magnifier Lens', 'wc_svi'),
    'id' => 'lens-subsection',
    'fields' => array(
        array(
            'id' => 'lens-navigation-info',
            'type' => 'info',
            'style' => 'warning',
            'required' => array(
                array('default', '=', '1'),
            ),
            'desc' => __('Magnifier Lens is disabled on mobile phones.', 'wc_svi')
        ),
        array(
            'id' => 'lens',
            'type' => 'switch',
            'required' => array(
                array('default', '=', '1'),
            ),
            'title' => __('Activate Magnifier Lens', 'wc_svi'),
            //'subtitle' => __('Also called a "fold" parent.', 'wc_svi'),
            //'desc' => __('Disabled on mobile phones.', 'wc_svi'),
            'default' => false,
        ),
        array(
            'id' => 'svi9_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Lens Format (PRO VERSION)', 'wc_svi'),
            'desc' => __('Square or Round format, default is round', 'wc_svi')
        ),
        array(
            'id' => 'svi10_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Lens Size (PRO VERSION)', 'wc_svi'),
            'desc' => __('Lens size to be displayed, min:100 | max: 300.', 'wc_svi'),
        ),
        array(
            'id' => 'svi10_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Zoom type (PRO VERSION)', 'wc_svi'),
            'desc' => __('Lens, Window or Inner, defaul is Lens.', 'wc_svi'),
        ),
        array(
            'id' => 'svi11_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Zoom Effect (PRO VERSION)', 'wc_svi'),
            'desc' => __('Allows Zoom with mouse scroll.', 'wc_svi'),
        ),
        array(
            'id' => 'svi12_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Fade Effect (PRO VERSION)', 'wc_svi'),
            'desc' => __('On mouse in Lens fades in or out.', 'wc_svi'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Thumbails', 'wc_svi'),
    'id' => 'thumbs-subsection',
    //'desc' => __('For full documentation on validation, visit: ', 'wc_svi') . '<a href="//docs.reduxframework.com/core/the-basics/required/" target="_blank">docs.reduxframework.com/core/the-basics/required/</a>',
    'fields' => array(
        array(
            'id' => 'svi13_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Disable Thumbnails (PRO VERSION)', 'wc_svi'),
            'desc' => __('Disable thumbnails on product page', 'wc_svi'),
        ),
        array(
            'id' => 'columns',
            'type' => 'text',
            'required' => array(
                array('default', '=', '1'),
            ),
            'title' => __('Thumbnail Columns', 'wc_svi'),
            //'subtitle' => __('Also called a "fold" parent.', 'wc_svi'),
            'desc' => __('Number of thumbnails to be displayed, min:1 | max: 10.', 'wc_svi'),
            'validate' => 'numeric',
            'default' => '4',
        ),
        array(
            'id' => 'hide_thumbs',
            'type' => 'switch',
            'required' => array(
                array('default', '=', '1'),
            ),
            'title' => __('Hidden Thumbnails', 'wc_svi'),
            'desc' => __('Thumbnails will be hidden until a variation as been selected.', 'wc_svi'),
            'default' => false,
        ),
        array(
            'id' => 'svi14_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Select Swap (PRO VERSION)', 'wc_svi'),
            'desc' => __('All selects will trigger the thumbnail swaps. Don\'t have to wait for select combination.', 'wc_svi'),
        ),
        array(
            'id' => 'svi15_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Thumbnail Click Swap (PRO VERSION)', 'wc_svi'),
            'desc' => __('Swap select box(es) to match variation on thumbnail click.', 'wc_svi'),
        ),
    )
));

Redux::setSection($opt_name, array(
    'title' => __('Layout Fixes', 'wc_svi'),
    'id' => 'fixes-subsection',
    //'desc' => __('For full documentation on validation, visit: ', 'wc_svi') . '<a href="//docs.reduxframework.com/core/the-basics/required/" target="_blank">docs.reduxframework.com/core/the-basics/required/</a>',
    'fields' => array(
        array(
            'id' => 'svi16_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Custom Class (PRO VERSION)', 'wc_svi'),
            'desc' => __('Insert custom css class(es) to fit your theme needs.', 'wc_svi'),
        ),
        array(
            'id' => 'svi17_info',
            'type' => 'info',
            'style' => 'warning',
            'title' => __('Remove Image class (PRO VERSION)', 'wc_svi'),
            'desc' => __('Some theme force styling on image class that may break the layout.', 'wc_svi'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title' => __('Support', 'wc_svi'),
    'id' => 'info-svi',
    'desc' => 'All support for my free plugins are provided at <a href="https://wordpress.org/support/plugin/smart-variations-images" target="_blank">www.wordpress.org</a>.<br>
Themes that follow the default WooCommerce implementation will usually work with this plugin. However, some themes use an unorthodox method to add their own lightbox/slider, which breaks the hooks this plugin needs.<br>
<br>
<b>Please note that WordPress has a big history of conflicts between plugins.</b><br>
<br>
Love the free version? Why not go PRO? <a href="http://www.rosendo.pt/product/smart-variations-images-pro/" target="_blank">SMART VARIATIONS IMAGES PRO</a><br>
<br>
<h2>No refunds, test the free version before buying!</h2>
<br>
<a href="http://www.rosendo.pt/terms-conditions/">Terms & Conditions</a><br><br>
<h3>If you like my free version please leave a review <a href="https://wordpress.org/support/plugin/smart-variations-images/reviews/" target="_blank">here</a> so that I keep improving the free version.</h3>',
));

/*
     * <--- END SECTIONS
     */
