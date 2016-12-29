=== ZWoom - WooCommerce Product Image Zoom ===
Contributors: WisdmLabs
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40wisdmlabs%2ecom&lc=US&item_name=WisdmLabs%20Plugin%20Donation&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest
Tags: woocommerce product zoom, woocommerce zoom, ecommerce product magnify plugin, picture zoom plugin, jquery picture zoom, image gallery zoom, photo zoom add on
Requires at least: 4.0
Tested up to:  4.5
Stable tag: 1.2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html 

This plugin allows store visitors on a single product page, to easily zoom into the primary product image within its container.

== Description ==

__ZWoom - WooCommerce Product Image Zoom__ helps your WooCommerce store visitors seamlessly zoom in to a single product image. Zwoom supports only __simple products__ for now.

__The Problem__

Many store visitors are interested in zooming into a product image, to notice the finer details. WooCommerce handles this by displaying a zoomed version of the product image in a fancybox/lightbox, each time a product image or thumbnail is clicked. While this solves the purpose, it is cumbersome for visitors because they have to toggle between the fancybox and the product page to infer details about the product such as price, features, shipping details, etc.

Some WooCommerce websites address this issue partially by displaying a secondary zoomed image box when a visitor hovers over a product image.

We also noticed that some plugins/sites have addressed the issue partially, in the form of creating a secondary image zoom box when you hover over the product image. But the issue with this approach is that the zoomed image box overlaps important product details, or the "Add to Cart" functionality.

So, at WisdmLabs, we decided to address all these issues which culminated into this awesome plugin!

__How Zwoom solves the problem?__

Zwoom displays the zoomed version of the image in its own image box on hover, thus eliminating any overlay issues. It also adds a slider for secondary product images, instead of the multiple rows of images which appear by default. If any of these secondary images are clicked, we load the image in primary image box, rather than directly opening the fancybox (which is the default functionality).

When an image in the primary image box is clicked, the fancybox pop-up is shown to visitors, allowing them to browse all product images.

__How to set the Zoom Level?__

Upon installing and activating the plugin, you will be able to see an additional option in the WooCommerce Catalog Page within WooCommerce settings. The new option will allow you to set the 'Zoom Level' and is present just below the set width and height options for a Single Product Image.

__Please note, the current version of Zwoom is compatible only with WooCommerce 2.4 and above.__

To see this plugin in action, please visit the live demo here:

http://wisdmlabs.com/demo/product/zwoom-woocommerce-product-zoom-plugin/

== Installation ==

How to install '__ZWoom__'

= Method 1 -Installing from the WordPress: =
1. From Dashboard, locate the 'Plugins' tab. Select 'Add New' under this tab.
2. Search for the term __Zwoom - Woocommerce Product Image Zoom__
3. Select for the __Zwoom - Woocommerce Product Image Zoom__ on the Results page and click 'Install Now' button under it.
4. After the installation completes, click 'Activate Plugin'.


= Method 2- Installing Manually : =
1. Download the 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs.zip'file.
2. After downloading, go to your WordPress dashboard.
3. From the Dashboard, locate 'Plugins'. Select 'Add New' under Plugin tab.
4. On that page, click on the 'Upload' Tab.
5. It would open a new window. On that window, click 'Browse' button and locate 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs.zip'. After locating the file, select it and     click 'Open' button and then press 'Install now'.
6. It might ask you for the FTP details before uploading. Kindly, fill those fields and install the plugin.
7. After the installation completes, click 'Activate Plugin'.

== Frequently Asked Questions ==

= How can I set the Zoom level for images ? =

To set a zoom level, go to Woocommerce Settings -> Catalog. On that page, there will be an option named 'Zoom Level' just below the option which allows you to set width and height for Single Product Image.

= How can I give my feedback about this plugin? =

If you like our plugin and it does help your visitors, please click on the Donate button and donate as per your desire. If you have any suggestions or queries, please feel free to write us from the "form" available in the settings page.

== Screenshots ==

1. ZWoom settings page

== Changelog ==

= 1.0 =
* Launching Plugin

= 1.0.1 =
* Made few modifications in plugin code. Added Rating and Review link in Settings page.

= 1.0.2 =
* Added WisdmLabs logo in sidebar

= 1.0.3 =
* Reducing the time lag appearing while sending a clicked image to main box. Also made few more changes to speed up the performance.

= 1.0.4 =
* Removing unwanted CSS file so that performance can be improved

= 1.0.5 =
* Removing asynchronous zoom problem

= 1.0.6 =
* Preloading thumbnail images on page load

= 1.0.7 =
* Improving Performance

= 1.0.8 =
* Adding new sidebar in Plugin's Settings page. Also improved loading of images.

= 1.0.9 =
* Providing a link to Zwoom's settings page on Plugin's Page.

= 1.1.0 =
* Removing an Error 'First argument is expected to be a valid callback'

= 1.1.1 =
* Removing an Error 'You do not have sufficient permissions to access this page.' on Zwoom Settings Page

= 1.1.2 =
* Removed confliction of wp_localize_script function

= 1.2 =
* Made compatible with WordPress 4.x
* Made compatible with WooCommerce  2.4.x
* Providing minified versions of javascript files

= 1.2.1 =
* Fixed the issue related to javascript object in minified file.

= 1.2.2 =
* Fix - Display image not changing on clickng the image in slider.
* Fix - Declared the variables for re-usable selectors in swap_images.js to improve the performance.