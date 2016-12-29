<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class woocommerce_svi_admin {

    private static $_this;

    /**
     * init
     *
     * @since 1.0.0
     * @return bool
     */
    public function __construct() {

        if (false === (get_option('woosvi-notice-dismissed'))) {
            add_action('admin_notices', array($this, 'sample_admin_notice__success'));
        }

        add_action('wp_ajax_nopriv_woosvi_dismiss_notice', array($this, 'woosvi_dismiss_notice'));
        add_action('wp_ajax_woosvi_dismiss_notice', array($this, 'woosvi_dismiss_notice'));

        add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts'));

        include_once( 'admin/admin-init.php' );
        add_filter('attachment_fields_to_edit', array($this, 'woo_svi_field'), 10, 2);
        add_filter('attachment_fields_to_save', array($this, 'woo_svi_field_save'), 10, 2);

        $role = get_role('shop_manager');
        $role->add_cap('manage_options');


        return true;
    }

    function sample_admin_notice__success() {
        ?>
        <div class="notice notice-error woosvi-notice-dismissed is-dismissible">
            <p><?php _e('<strong>SVI NOTICE</strong>, Please go to WooCommerce > <a href="admin.php?page=woocommerce_svi">SVI</a> and <strong>Reset All</strong> options and "Enable SVI" so that plugin works properly again. <br>If you like my free version please leave a review <a href="https://wordpress.org/support/plugin/smart-variations-images/reviews/" target="_blank">here</a> so that I keep improving the free version.', 'wc_svi'); ?></p>
        </div>
        <?php
    }

    function woosvi_dismiss_notice() {
        update_option('woosvi-notice-dismissed', true);
        header("Content-type: application/json");
        echo json_encode(true);
        die();
    }

    /**
     * load admin scripts
     *
     * @since 1.0.0
     * @return bool
     */
    function load_admin_scripts() {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        $screen = get_current_screen();

        //if ($screen->base == 'woocommerce_page_woocommerce_svi') {
            wp_enqueue_script('woo_svijs', plugins_url('assets/js/svi-admin-settings' . $suffix . '.js', dirname(__FILE__)), array('jquery'));
        //}
    }

    /**
     * Add woovsi field to media uploader
     *
     * @param $form_fields array, fields to include in attachment form
     * @param $post object, attachment record in database
     * @return $form_fields, modified form fields
     */
    function woo_svi_field($form_fields, $post) {

        if (isset($_POST['post_id']) && $_POST['post_id'] != '0') {
            $in_use = false;
            $wc = new WC_Product($_POST['post_id']);
            $att = $wc->get_attributes();

            if (!empty($att)) {

                $current = get_post_meta($post->ID, 'woosvi_slug', true);

                $html = "<select name='attachments[{$post->ID}][woosvi-slug]' id='attachments[{$post->ID}][woosvi-slug]' style='width:100%;'>";

                $variations = false;

                $html .= "<option value='' " . selected($current, '', false) . ">Select Variation</option>";

                foreach ($att as $key => $attribute) {
                    if ($attribute['is_taxonomy']) {

                        $terms = wp_get_post_terms($_POST['post_id'], $key, 'all');

                        if (!empty($terms)) {
                            $the_tax = get_taxonomy($attribute['name']);
                            $variations = true;

                            $html .= '<optgroup label="' . $the_tax->label . '">';
                            foreach ($terms as $term) {
                                if ($current == $term->slug)
                                    $in_use = true;
                                $html .= "<option value='" . $term->slug . "' " . selected($current, $term->slug, false) . ">" . $term->name . "</option>";
                            }
                            $html .= '</optgroup>';
                        }
                    } else {
                        $values = str_replace(" ", "", $attribute['value']);
                        $terms = explode('|', $values);
                        if (!empty($terms)) {
                            $variations = true;
                            $html .= '<optgroup label="' . $attribute['name'] . '">';
                            foreach ($terms as $term) {
                                if ($current == strtolower($term))
                                    $in_use = true;
                                $html .= "<option value='" . strtolower($term) . "' " . selected($current, strtolower($term), false) . ">" . $term . "</option>";
                            }
                            $html .= '</optgroup>';
                        }
                    }
                }

                if (!$in_use && $current != '')
                    $html .= "<option value='" . $current . "' " . selected($current, $current, false) . ">" . $current . "</option>";

                $html .= '</select>';
                $helps = '';
                if (!$in_use && $current != '')
                    $helps = '<div style="color:red;">Image in use by other product, if you wish to use with this product upload another new/same image.<br><strong>Image will not be displayed!</strong></div><br>';

                if ($variations) {
                    $form_fields['woosvi-slug'] = array(
                        'label' => 'Variation',
                        'input' => 'html',
                        'html' => $html,
                        'application' => 'image',
                        'exclusions' => array(
                            'audio',
                            'video'
                        ),
                        'helps' => $helps . 'Choose the variation'
                    );
                } else {
                    $form_fields['woosvi-slug'] = array(
                        'label' => 'Variation',
                        'input' => 'html',
                        'html' => 'This product doesn\'t seem to be using any variations.',
                        'application' => 'image',
                        'exclusions' => array(
                            'audio',
                            'video'
                        ),
                        'helps' => 'Add variations to the product and Save'
                    );
                }
            }
        }
        return $form_fields;
    }

    /**
     * Save values of woovsi in media uploader
     *
     * @param $post array, the post data for database
     * @param $attachment array, attachment fields from $_POST form
     * @return $post array, modified post data
     */
    function woo_svi_field_save($post, $attachment) {
        if (isset($attachment['woosvi-slug']))
            update_post_meta($post['ID'], 'woosvi_slug', $attachment['woosvi-slug']);


        return $post;
    }

}

new woocommerce_svi_admin();
