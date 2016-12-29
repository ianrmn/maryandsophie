<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class woocommerce_svi_frontend {

    private static $_this;

    /**
     * contruct
     *
     * @since 1.0.0
     * @return bool
     */
    public function __construct() {

        $this->suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $this->wpml = false;
        add_action('wp', array($this, 'init'));
        return $this;
    }

    /**
     * run init to check if we are on product page
     *
     * @since 1.0.0
     * @return bool
     */
    function init() {
        if (is_product()) {
            $this->detect = new Mobile_Detect;
            $this->getMobile();
            $this->prepVars();
            if (class_exists('SitePress')) {
                $this->wpml = true;
            }
            add_action('woocommerce_before_single_product', array($this, 'remove_hooks'));
            add_action('woocommerce_before_single_product_summary', array($this, 'show_product_images'), 20);

            add_action('wp_enqueue_scripts', array($this, 'load_scripts'), 150, 1);

            add_filter('woocommerce_available_variation', array($this, 'modify_variation_json'), 10, 3);
            add_filter('wp_get_attachment_image_attributes', array($this, 'add_woosvi_attribute'), 10, 2);
        }
    }

    /**
     * Plugin path
     *
     * @since 1.0.0
     * @return html
     */
    function woo_svi_plugin_path() {
        return untrailingslashit(plugin_dir_path(dirname(__FILE__)));
    }

    /**
     * Loads the vars needed
     *
     * @since 1.1.1
     * @return instance object
     */
    function prepVars() {
        global $woosvi;
        $this->woosvi_options = get_option('woosvi_options');

        $this->woosvi_options['img_groups'] = $this->sviSingleProduct();
        $this->woosvi_options['failsafe'] = $this->sviFailSafeProduct();
        if ($this->wpml) {
            $this->woosvi_options['svitranslations'] = $this->sviGetTranslations();
        }
        $woosvi = $this->woosvi_options;
    }

    /**
     * Load images to be used for Single Products
     *
     * @since 1.0.0
     * @return html
     */
    public function sviFailSafeProduct() {
        global $product, $post;
        if ($post->post_type != 'product')
            return array();

        $pid = $post->ID;
        $_product = wc_get_product($pid);

        switch ($_product->get_type()) {
            case 'simple':
            case 'variable':

                if ($this->wpml) {
                    $pid = $this->wpml_is_original($pid);
                }

                $product = get_product($pid);

                $attachment_ids = $product->get_gallery_attachment_ids();
                $images = array();

                foreach ($attachment_ids as $attachment_id) {

                    $images[]['additional_images'][] = $this->imgArray($attachment_id);
                }

                break;
        }

        return $images;
    }

    /**
     * Loads visualization page
     *
     * @since 1.1.1
     * @return instance object
     */
    public function show_product_images() {
        require_once($this->woo_svi_plugin_path() . '/frontend/display.php');
    }

    /**
     * load front-end scripts
     *
     * @since 1.0.0
     * @return bool
     */
    function load_scripts() {
        global $wp_styles, $woocommerce;

        $loads = array(
            'jquery',
        );

        if ($this->woosvi_options['lens'] && !$this->isMobile) {
            wp_enqueue_script('sviezlens', plugins_url('assets/js/jquery.ez-plus' . $this->suffix . '.js', dirname(__FILE__)), $loads, null, true);
            array_push($loads, 'sviezlens');
        }


        if ($this->woosvi_options['lightbox']) {
            # prettyPhoto
            $handle = 'prettyPhoto' . $this->suffix . '.js';
            $list = 'enqueued';

            if (!wp_script_is($handle, $list)) {
                wp_enqueue_script('prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto' . $this->suffix . '.js', array('jquery'), $woocommerce->version, true);
                wp_enqueue_script('prettyPhoto-init', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.init' . $this->suffix . '.js', array('jquery'), $woocommerce->version, true);
                wp_enqueue_style('woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css');
                array_push($loads, 'prettyPhoto', 'prettyPhoto-init');
            }
        }

        wp_enqueue_script('sviImagesloaded', '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js', $loads, null, true);
        array_push($loads, 'sviImagesloaded');
        wp_enqueue_script('woosvijs', plugins_url('assets/js/svi-frontend' . $this->suffix . '.js', dirname(__FILE__)), $loads, null, true);
        wp_localize_script('woosvijs', 'WOOSVIDATA', $this->woosvi_options);

        $styles = null;
        $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src'));
        $key_woocommerce = array_search('woocommerce.css', $srcs);

        if ($key_woocommerce) {
            $styles = array(
                $key_woocommerce,
            );
        }



        wp_enqueue_style('woo_svicss', plugins_url('assets/css/woo_svi' . $this->suffix . '.css', dirname(__FILE__)), $styles, null);
    }

    /**
     * Remove hooks for plugin to work properly
     *
     * @since 1.1.1
     * @return instance object
     */
    public function remove_hooks() {

        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
        remove_action('woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20);
        remove_action('woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20);
    }

    /**
     * Check if is mobile phone
     *
     * @since 1.1.1
     * @return instance object
     */
    function getMobile() {
        $this->isMobile = false;
        if ($this->detect->isMobile())
            $this->isMobile = true;
        if ($this->detect->isTablet())
            $this->isMobile = false;
    }

    /**
     * Add SVI slug to images & Magnifier Lens
     *
     * @since 1.0.0
     * @return html
     */
    function add_woosvi_attribute($html, $post) {
        if (is_product()) {

            $html['data-woosvi'] = get_post_meta($post->ID, 'woosvi_slug', true);

            if ($this->woosvi_options['lens'] && !$this->isMobile) {
                $img = wp_get_attachment_image_src($post->ID, 'full');
                $html['data-svizoom-image'] = $img[0];
            }
        }
        return $html;
    }

    /**
     *
     * Alter Variation JSON
     *
     * This hooks into the data attribute on the variations form for each variation
     * we can get the additional image data here!
     *
     * @param mixed $anything Description of the parameter
     * @return bool
     *
     */
    public function modify_variation_json($variation_data, $wc_product_variable, $variation_obj) {
        $ids = $this->getVariationsImages($variation_data['attributes'], $variation_data['variation_id'], $wc_product_variable->id);
        $images = $this->loadVariationsImages($ids);
        $variation_data['additional_images'] = $images;
        $variation_data['image_src'] = '';

        return $variation_data;
    }

    /**
     * Find images IDs to be used on variations
     *
     * @since 1.0.0
     * @return html
     */
    public function getVariationsImages($att, $vid, $pid) {
        $images = array();
        $_product = wc_get_product($vid);

        switch ($_product->get_type()) {
            case 'simple':
            case 'variable':
            case 'variation':

                if ($this->wpml) {
                    $pid = $this->wpml_is_original($pid);
                }

                $product = get_product($pid);

                $attachment_ids = $product->get_gallery_attachment_ids();

                if (!empty($att)) {
                    if ($this->wpml) {
                        $opid = $this->wpml_is_original($vid);
                        $oattr = wc_get_product($opid);
                        $att = $oattr->get_variation_attributes();
                    }

                    foreach ($att as $key => $attribute) {

                        foreach ($attachment_ids as $attachment_id) {
                            $svi_slug = get_post_meta($attachment_id, 'woosvi_slug', true);

                            if (strtolower($svi_slug) == str_replace(" ", "", strtolower($attribute)))
                                array_push($images, $attachment_id);
                        }
                    }
                }
                break;
        }

        return $images;
    }

    function wpml_is_original($post_id = 0, $type = 'post_product') {
        global $post, $sitepress;

        $output = array();

        $p_ID = $post_id == 0 ? $post->ID : $post_id;

        $el_trid = $sitepress->get_element_trid($p_ID, $type);

        $el_translations = $sitepress->get_element_translations($el_trid, $type);

        if (!empty($el_translations)) {
            $is_original = FALSE;
            foreach ($el_translations as $lang => $details) {
                if ($details->original == 1 && $details->element_id == $p_ID) {
                    $is_original = TRUE;
                }
                if ($details->original == 1) {
                    $original_ID = $details->element_id;
                }
            }
        }
        return $original_ID;
    }

    /**
     * Load images of variation
     *
     * @since 1.0.0
     * @return html
     */
    public function loadVariationsImages($ids) {
        $images = array();
        if (!empty($ids)) {
            foreach ($ids as $imgId):
                if (!array_key_exists($imgId, $images)) {
                    $images[] = $this->imgArray($imgId);
                }
            endforeach;
        }
        return $images;
    }

    public function sviGetTranslations() {
        global $product, $post;

        $pid = $post->ID;

        $_product = wc_get_product($pid);

        switch ($_product->get_type()) {
            case 'simple':
                $translated = array();

                break;
            case 'variable':
            case 'variation':

                $product = get_product($pid);

                $atts = $product->get_variation_attributes();

                if ($this->wpml) {
                    $opid = $this->wpml_is_original($post->ID);
                    $oattr = wc_get_product($opid);
                    $checker = $oattr->get_variation_attributes();
                }

                $translated = array();
                foreach ($checker as $key => $value) {
                    foreach ($value as $k => $v) {
                        $translated[$v] = $atts[$key][$k];
                    }
                }

                break;
        }

        return $translated;
    }

    /**
     * Load images to be used for Single Products
     *
     * @since 1.0.0
     * @return html
     */
    public function sviSingleProduct() {
        global $product, $post;

        if ($post->post_type != 'product')
            return array();

        $pid = $post->ID;

        $_product = wc_get_product($pid);

        switch ($_product->get_type()) {
            case 'simple':

                $images = array();

                break;
            case 'variable':

                $product = get_product($pid);

                $attachment_ids = $product->get_gallery_attachment_ids();

                $atts = $product->get_variation_attributes();

                $checker = $atts;

                if ($this->wpml) {
                    $opid = $this->wpml_is_original($post->ID);
                    $oattr = wc_get_product($opid);
                    $checker = $oattr->get_variation_attributes();
                    $attachment_ids = $oattr->get_gallery_attachment_ids();
                }


                $images = array();

                foreach ($attachment_ids as $attachment_id) {

                    $image = $this->imgArray($attachment_id);

                    foreach ($checker as $key => $value) {
                        foreach ($value as $k => $v) {
                            if (strtolower($image['woosvi_slug']) == strtolower($v)) {
                                $variation = $atts[$key][$k];
                                $images[$variation][] = $image;
                            }
                        }
                    }
                }

                break;
        }

        return $images;
    }

    /**
     * Build the Image array
     *
     * @since 1.0.0
     * @return html
     */
    public function imgArray($id) {

        return array(
            'ID' => $id,
            'full' => wp_get_attachment_image_src($id, 'full'),
            'large' => wp_get_attachment_image_src($id, 'large'),
            'single' => wp_get_attachment_image_src($id, apply_filters('single_product_large_thumbnail_size', 'shop_single')),
            'thumb' => wp_get_attachment_image_src($id, 'thumbnail'),
            'title' => get_post($id)->post_excerpt,
            'woosvi_slug' => get_post_meta($id, 'woosvi_slug', true)
        );
    }

    /**
     * Add 1st match of variation image to cart
     *
     * @since 1.0.0
     * @return html
     */
    function filter_woocommerce_cart_item_thumbnail($product_get_image, $cart_item = array(), $cart_item_key = array()) {

        if ($cart_item['variation_id'] > 0) {

            $found = false;
            $product = wc_get_product($cart_item['product_id']);
            $attachment_ids = $product->get_gallery_attachment_ids();

            foreach ($cart_item['variation'] as $key => $value) {

                if (!$found) {

                    foreach ($attachment_ids as $attachment_id) {
                        $woo_svi = $this->get_woosvi_attribute_thumb($attachment_id);

                        if (strtolower($value) == $woo_svi) {
                            $image_title = $product->get_title();
                            $product_get_image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), 0, $attr = array(
                                'title' => $image_title,
                                'alt' => $image_title
                            ));
                            $found = true;
                            break;
                        }
                    }
                }
            }
        }

        return $product_get_image;
    }

    /**
     * Get woosvi variation slug for cart image
     *
     * @since 1.0.0
     * @return html
     */
    function get_woosvi_attribute_thumb($id) {

        $current = get_post_meta($id, 'woosvi_slug', true);

        return $current;
    }

    /**
     * public function to get instance
     *
     * @since 1.1.1
     * @return instance object
     */
    public function get_instance() {
        return self::$_this;
    }

}

function woosvi_class() {
    global $woosvi_class;

    if (!isset($woosvi_class)) {
        $woosvi_class = new woocommerce_svi_frontend();
    }

    return $woosvi_class;
}

// initialize
woosvi_class();


if (!function_exists('woocommerce_show_product_images')) {

    /**
     * Output the product image before the single product summary.
     *
     * @subpackage	Product
     */
    function woocommerce_show_product_images() {

        /**
         * woocommerce_before_single_product_summary hook
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action('woocommerce_before_single_product_summary');
    }

}