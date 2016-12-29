=== WooCommerce Products Quick View ===
Contributors: a3rev, nguyencongtuan
Tags: WooCommerce, WooCommerce Quick View, Quick View, WooCommerce Products Quick View.
Requires at least: 4.1
Tested up to: 4.6.1
Stable tag: 1.5.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Add Quick View feature to all grid view products on shop, category, tag pages. Opens full product page content, add to cart without leaving the page

== Description ==

WooCommerce Products Quick View gives your customers a true supermarket shopping experience. In a supermarket shoppers browse products on the shelves, picking up the ones they are interested up, reading all the relevant information and either adding the item to their cart or putting it back on the shelf and continuing to browser. You can now give your customer exactly the same experience with WooCommerce Products Quick View.

While browsing products anywhere in your store - shop page / category pages / tag pages they see a products that interests them - instead of clicking 'More Details' and going to another page to view all the product information and images they click Quick View and see it all in a pop-up right there on their screen. This is the sequence

* See something of interest - Pick it up from the shelf (Open the product in the pop-up)
* View all the products information and make a buying decision
* Either add the item to the shopping basket (Add to Cart)
* Or put the item back on the shelf and continue to browse (close the pop-up)

It is quick easy and incredibly convenient for your customers and will create more sales.

= Quick View Features =

* Works on any theme.
* 2 choices of Quick pop-ups opens - full page content in pop-up or Custom pop-up.
* Fully mobile responsive - if your theme is responsive it opens in its true responsive dimensions within the pop-up.
* Show Quick View as a button or hyperlink text (fully customizable without writing any code)
* All product page features added by plugins work within the pop-up.
* Show Quick View on hover over image or show as button or linked text under the image.
* Mobile device optimized - all tablets and phones

= Show Quick View under the Image =

* Option to show Quick View as a Button or Hyper linked text under the product image.
* When placed under the image Quick View is visible all of the time.
* a3rev Button creator, for creating the perfect style without touching the theme code.
* a3rev Button style transparency setting.
* a3rev Hyperlink text creator - Simple point click settings to create an eye catching clickable link.
* Quick View button has 3 Positional settings Top, Center or bottom of the image.

= Advanced Pop-up Controls =

* Select pop-up open and close transition effect.
* Set pop-up opening / closing speed.
* Set pop-up background overlay colour with WYSIWYG colour picker.
* Fix pop-up or allow it to scroll with the screen content
* Same day priority Pro License support and auto updates from the a3API.

= Mobile Responsive Quick View Pop-up =

* Fancybox pop-up tool - can't be blocked by browser pop-up settings.
* Pop-up opens in 0.300 of a second and closes instantly.
* SEO tracking - Your analytics tracking code e.g. Google records every view.
* Add to Cart , View Cart all work within the pop-up.

= Localization =

* English (default) - always included.
*.po file (wooquickview.po) in languages folder for translations.
* If you do a translation for your site please send it to us for inclusion in the plugin language folder. We'll acknowledge your work here. [Go here](https://a3rev.com/contact-us-page/) to send your translation files to us.

= Plugin Resources =

[PRO Version](http://a3rev.com/shop/woocommerce-quick-view-ultimate/) |
[Documentation](http://docs.a3rev.com/user-guides/plugins-extensions/woocommerce-quick-view-ultimate/) |

== Installation ==

= Minimum Requirements =

* WordPress 4.1
* WooCommerce v2.1 and later.
* PHP version 5.4.0 or greater
* MySQL version 5.4 or greater

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't even need to leave your web browser. To do an automatic install of WooCommerce Products Quick View, log in to your WordPress admin panel, navigate to the Plugins menu and click Add New. Search WooCommerce Products Quick View and click install. Or download the plugin from wordpress.org and click the upload sub nav item and use the WordPress plugins uploader to upload the plugin from your computer and unpack it and install it for you.

= Manual installation =

The manual installation method involves downloading our plugin and uploading it to your web server via your favourite FTP application.

1. Download the plugin file to your computer and unzip it
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installations wp-content/plugins/ directory.
3. Activate the plugin from the Plugins menu within the WordPress admin.


== Usage ==

1. Install and activate the plugin

2. On wp-admin go to the WC Quick View Menu

3. Go to Quick View sub menu Settings - Turn the Quick View Feature ON.

4. Make your settings and style the Quick View Button or hypertext link.

5. Have fun.

== Frequently Asked Questions ==

= When can I use this plugin? =

On any WordPress install that has the WooCommerce plugin installed and activated.

== Screenshots ==

1. Quick view on a product page as it shows on a widescreen.


== Changelog ==

= 1.5.1 - 2016/10/22 =
* Tweak - Tested for full compatibility with WooCommerce version 2.6.6
* Fix - Update add-to-cart-variation.js script for variation product when add to cart

= 1.5.0 - 2016/09/03 =
* Feature - Plugin Framework Mobile First focus upgrade
* Feature - Massive improvement in admin UI and UX in PC, tablet and mobile browsers
* Feature - Introducing opening and closing Options Boxes on admin panels
* Feature - Added Font editor 'Line Height' option
* Feature - Support select Default Gallery of WC or Dynamic Gallery show on Quick View Pop-up
* Feature - Upgrade all Gallery and thumbnail slider images to fontawesome icons
* Feature - Add colorbox pop up tool option
* Feature - Add customization options for fancybox and colorbox pop up tools
* Tweak - Change Pop-up Controls to font awesome icon
* Tweak - Move Plugin menu to as submenu of WooCommerce menu
* Tweak - Update select type of plugin framework for support group options
* Tweak - Update Typography Preview script for apply 'Line Height' value to Preview box
* Tweak - Update the generate_font_css() function with new 'Line Height' option
* Tweak - Replace all hard code for line-height inside custom style by new dynamic 'Line Height' value
* Tweak - Register fontawesome in plugin framework with style name is 'font-awesome-styles'
* Tweak - Update a3 Dynamic Gallery script and style to support new features
* Tweak - Update dynamic style for new features
* Tweak - Tested for full compatibility with WooCommerce version 2.6.4
* Tweak - Tested for full compatibility with WordPress version 4.6

= 1.4.1 - 2016/06/21 =
* Tweak - Enqueue scripts to 'wp_enqueue_scripts' instead of footer to resolve script can't load if theme don't have wp_footer
* Tweak - Register two new scripts 'quick-view-hover-script' and 'quick-view-popup-script'
* Tweak - Tested for full compatibility with WooCommerce major version 2.6.0
* Tweak - Tested for full compatibility with WooCommerce version 2.6.1
* Tweak - Tested for full compatibility with WordPtress version 4.5.2
* Fix - update minus and plus script for just increase 1 time for when click instead of increase 2 or 3 times
* Fix - Add to cart works on quick view pop up for Variation product that have custom attributes
* Fix - Update style to not have padding when Quick View hover type is activated

= 1.4.0 - 2016/04/11 =
* Feature - Completed full integration with WooCommerce Product Image Gallery. Dynamic Gallery functions and features are now applied to WooCommerce Product Gallery and does not create its own Gallery
* Tweak - Define new 'strip_methods' argument for Uploader type, allow strip http/https or no
* Tweak - Register fontawesome in plugin framework with style name is 'font-awesome-styles'
* Tweak - Update a3 Dynamic Gallery script and style to support new feature
* Tweak - Saved the time number into database for one time customize style and Save change on the Plugin Settings
* Tweak - Replace version number by time number for dynamic style file are generated by Sass to solve the issue get cache file on CDN server
* Tweak - Update plugin framework to latest version
* Tweak - Tested for full compatibility with WordPress major version 4.5
* Tweak - Tested for full compatibility with WooCommerce version 2.5.5
* Dev - Add 'quick_view_product_sku' selector class for SKU meta on popup
* Dev - Add 'quick_view_product_category' selector class for Product Categories meta on popup
* Dev - Add 'quick_view_product_tag' selector class for Product Tags meta on popup
* Fix - Update Dynamic script to get data from attributes of gallery container instead of using 'a3_dgallery_arg' variable to parse into script. Resolves confliction with WooCommerce Dynamic Gallery plugin
* Fix - Remove 'z-index' for Control Bar. Now obsolete with Dynamic gallery html structure. Resolves conflict with any overlaying html for example from sidebar navigation pop out menus
* Fix - Remove 'parseInt' javascript function that was applying to get thumbnail type. Was causing the thumbnail container UI to be broken
* Fix - Support shortcode for the description on Custom Quick View Popup
* Credit - Thanks to Lana Mangusa for the suggestion to add sku, category and tag CSS selector classes for developers a3rev.com/forums/topic/quick-view-product-meta/

= 1.3.0 - 2016/01/29 =
* Feature - Add new popup content Feature - Simple Custom Template
* Feature - Custom Template has Dynamic gallery feature in popup
* Feature - Make Dynamic Gallery on frontend support the Responsive Image with 2 new attribute 'scrset' and 'sizes' are put on thumbnail and main image for decrease the total size of images are load on gallery for small screen
* Feature - Change old Media Uploader pop-up to New UI of Uploader with Backbone and Underscore from WordPress
* Feature - Added full support for Right to Left RTL layout on plugins admin dashboard
* Feature - Added Option to set Google Fonts API key to directly access latest fonts and font updates from Google
* Feature - Custom Template - Thumbnails use Hard Crop or Scale set on the WooCommerce Product Images settings
* Feature - Define new function - hextorgb() - for convert hex color to rgb color on plugin framework
* Feature - Define new function - generate_background_color_css() - for export background style code on plugin framework that is used to make custom style
* Tweak - Remove Pop up Content type, Product Page Content Feature - has been replaced by the Simple Custom Template feature
* Tweak - Update the uploader script to save the Attachment ID and work with New Uploader
* Tweak - Change call action from 'wp_head' to 'wp_enqueue_scripts' and use 'wp_enqueue_style' function to load style for better compatibility with minify feature of caching plugins
* Tweak - Change call action from  'wp_head' to 'wp_enqueue_scripts' to load  google fonts
* Tweak - Updated a3 Plugin Framework to the latest version
* Tweak - Defined 'frontend_register_scripts' function with all gallery scripts are registered here for easy to enqueue on frontend
* Tweak - Move all upgrade function code to /includes/updates/ path
* Tweak - Update the frontend process for get new gallery of product
* Tweak - Update core style and script of plugin framework for support Background Color type
* Tweak - Updated required WordPress version to 4.1 for full compatibility with WooCommerce plugin
* Tweak - Tested for full compatibility with WooCommerce version 2.5.1
* Tweak - Tested for full compatibility with WordPress version 4.4.1
* Fix - Quick View feature work for when use WooCommerce shortcode on homepage or any page or when it's related products, current it just work for shop page

= 1.2.5 - 2015/08/19 =
* Tweak - Tested for full compatibility with WooCommerce Version 2.4.4
* Tweak - Tested for full compatibility with WordPress major version 4.3.0
* Tweak - Include new CSSMin lib from https://github.com/tubalmartin/YUI-CSS-compressor-PHP-port into plugin framework instead of old CSSMin lib from http://code.google.com/p/cssmin/ , to avoid conflict with plugins or themes that have CSSMin lib
* Tweak - Make __construct() function for 'Compile_Less_Sass' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Tweak - Change class name from 'lessc' to 'a3_lessc' so that it does not conflict with plugins or themes that have another Lessc lib
* Fix - Check 'request_filesystem_credentials' function, if it does not exists then require the core php lib file from WP where it is defined
* Fix - Make __construct() function for 'WC_Quick_View_Ultimate' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4
* Fix - Make __construct() function for 'WC_Quick_View_Ultimate_Style' class instead of using a method with the same name as the class for compatibility on WP 4.3 and is deprecated on PHP4

= 1.2.4 - 2015/06/04 =
* Tweak - Tested for full compatibility with WooCommerce Version 2.3.10
* Tweak - Tested for full compatibility with WordPress Version 4.2.2
* Tweak - Security Hardening. Removed all php file_put_contents functions in the plugin framework and replace with the WP_Filesystem API
* Tweak - Security Hardening. Removed all php file_get_contents functions in the plugin framework and replace with the WP_Filesystem API
* Fix - Update dynamic stylesheet url in uploads folder to the format <code>//domain.com/</code> so it's always is correct when loaded as http or https

= 1.2.3 - 2015/05/05 =
* Tweak - Tested for full compatibility with WordPress Version 4.2.1
* Fix - Removed check_ajax_referer() call on frontend for compatibility with PHP caching plugins. Was returning -1 to js success call-back.

= 1.2.2 - 2015/04/21 =
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.2.0
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.8
* Tweak - Update style of plugin framework. Removed the [data-icon] selector to prevent conflict with other plugins that have font awesome icons

= 1.2.1 - 2015/03/19 =
* Tweak - Tested and Tweaked for full compatibility with WooCommerce Version 2.3.7
* Tweak - Tested and Tweaked for full compatibility with WordPress Version 4.1.1

= 1.2.0 - 2015/02/13 =
* Tweak - Maintenance update for full compatibility with WooCommerce major version release 2.3.0 with backward compatibility to WC 2.2.0
* Tweak - Tested fully compatible with WooCommerce just released version 2.3.3
* Tweak - Changed WP_CONTENT_DIR to WP_PLUGIN_DIR. When an admin sets a custom WordPress file structure then it can get the correct path of plugin
* Tweak - Added Link to new plugins a3 Lazy Load and a3 Portfolio to the Free WordPress plugins list in yelow sidebar.
* Tweak - Tested 100% compatible with WordPress Version 4.1
* Fix - Sass compile path not saving on windows xampp

= 1.1.1 - 2014/09/12 =
* Tweak - Tested 100% compatible with WooCommerce 2.2.2
* Fix - Changed __DIR__ to dirname( __FILE__ ) for Sass script so that on some server __DIR___ is not defined

= 1.1.0 - 2014/09/05 =
* Feature - Converted all front end CSS #dynamic {stylesheets} to Sass #dynamic {stylesheets} for faster loading.
* Feature - Convert all back end CSS to Sass.
* Tweak - use wc_get_product() function instead of get_product() function when site is using WooCommerce Version 2.2
* Tweak - Updated google font face in plugin framework.
* Tweak - Tested 100% compatible with WooCommerce Version 2.2 and backward to Version 2.1
* Tweak - Tested 100% compatible with WordPress Version 4.0

= 1.0.6.4 - 2014/06/19 =
* Tweak - change wp_register_script( 'a3rev-chosen') to wp_register_script( 'a3rev-chosen-new')
* Tweak - Tested 100% compatible with WooCommerce version 2.1.11

= 1.0.6.3 - 2014/06/04 =
* Tweak - Updated chosen js script to latest version 1.1.0 on the a3rev Plugin Framework
* Tweak - Tested fully compatible with WooCommerce Version 2.1.10

= 1.0.6.2 - 2014/05/29 =
* Tweak - Changed add_filter( 'gettext', array( $this, 'change_button_text' ), null, 2 ); to add_filter( 'gettext', array( $this, 'change_button_text' ), null, 3 );
* Tweak - Update change_button_text() function from ( $original == 'Insert into Post' ) to ( is_admin() && $original === 'Insert into Post' )
* Tweak - Added support for placeholder feature for input, email , password , text area types.

= 1.0.6.1 - 2014/05/19 =
* Tweak - Updated Pop-up menu with new Pro Version features set custom pop-up width and height.
* Tweak - Updated Custom Template, Product Data > Product Description menu with new Pro Version features.
* Fix - Quick View Fancybox pop-up menu not scrolling in iOS Mobiles

= 1.0.6 - 2014/05/17 =
* Feature - Added option to show Quick View button or link text under image
* Feature - Added full Quick View Button customization with the a3rev Button Creator functions - Create any style button.
* Feature - Added Button transparency setting for Quick View hover button.
* Feature - Added Under Image Button creator and Hyperlink styling functions.
* Tweak - Moved the plugin from a sub menu item on the WooCommerce menu to its own WordPress Admin menu WC Quick View.
* Tweak - Added all Custom Template Menus as a Sub menu of WC Quick View (Pro Version new feature)
* Tweak - Updated the plugins description text with new features for Lite and Pro versions.
* Tweak - Updated the plugins admin help text and yellow sidebar content.
* Tweak - Tested 100% compatible with WooCommerce Version 2.1.9

= 1.0.5.1 - 2014/05/12 =
* Tweak - Updated Framework help text font for consistency.
* Tweak - Added remove_all_filters('mce_external_plugins'); before call to wp_editor to remove extension scripts from other plugins.
* Tweak - Launched Plugin Pro Version Trail License for Free Trail.
* Tweak - Updated the plugins admin panel Yellow sidebar content.
* Tweak - Update plugins description text for easier reading.
* Tweak - Tested for full compatibility with WooCommerce Version 2.1.8
* Tweak - Tested for full compatibility with WordPress Version 3.9.1

= 1.0.5 - 2014/01/28 =
* Feature - Upgraded for 100% compatibility with soon to be released WooCommerce Version 2.1 with backward compatibility to Version 2.0
* Feature - Added all required code so plugin can work with WooCommerce Version 2.1 refactored code.
* Tweak - Removed dynamic pop-up wide setting and replaced with static pop-up max wide.
* Tweak - Pop-up tools wide under 520px shows 100% wide of the screen for mobiles in portrait or landscape
* Tweak - Added description text to the top of each Pro Version yellow border section
* Tweak - Tested for compatibility with WordPress version 3.8.1
* Tweak - Full WP_DEBUG ran, all uncaught exceptions, errors, warnings, notices and php strict standard notices fixed.
* Fix - Distorted pop-up display in mobile phone portrait view with new pop-up static max wide.

= 1.0.4 - 2013/12/20 =
* Feature - a3rev Plugin Framework admin interface upgraded to 100% Compatibility with WordPress v3.8.0 with backward compatibility.
* Feature - a3rev framework 100% mobile and tablet responsive, portrait and landscape viewing.
* Tweak - Upgraded dashboard switches and sliders to Vector based display that shows when WordPress version 3.8.0 is activated.
* Tweak - Upgraded all plugin .jpg icons and images to Vector based display for full compatibility with new WordPress version.
* Tweak - Yellow sidebar on Pro Version Menus does not show in Mobile screens to optimize admin panel screen space.
* Tweak - Tested 100% compatible with WP 3.8.0
* Fix - Upgraded array_textareas type for Padding, Margin settings on the a3rev plugin framework

= 1.0.3 - 2013/10/10 =
* Feature - Admin panel intuitive app interface feature. Show slider to set corner radius when select Round, hide when select Square on Border Corner Style Switch. (Pro Version Feature)
* Tweak - a3rev logo image now resizes to the size of the yellow sidebar in tablets and mobiles.
* Fixe - Intuitive Radio Switch settings not saving. Input with disabled attribute could not parse when form is submitted, replace disabled with custom attribute: checkbox-disabled
* Fix - App interface Radio switches not working properly on Android platform, replace removeProp() with removeAttr() function script

= 1.0.2 - 2013/10/03 =
* Feature - Upgraded the plugin to the newly developed a3rev admin panel app interface.
* Feature - New admin UI features check boxes replaced by switches, some dropdowns replaced by sliders.
* Feature - Replaced colour picker with new WordPress 3.6.0 colour picker (Pro Version feature).
* Feature - Added choice of 350 Google fonts to the existing 17 websafe fonts in all new single row font editor (Pro Version features).
* Feature - New Border / Button shadow features. Create shadow external or internal, set wide of shadow (Pro Version Features).
* Feature - New on page instant previews for Fonts editor, create border and shadow style.(Pro Version Features).
* Feature - Added intuitive triggers for some settings. When selected corresponding feature settings appear (Pro Version features).
* Feature - Added set pop up wide from 50% to 100% by increments of + or - 1% using new slider interface (Pro Version features)
* Tweak - Moved admin from WooCommerce settings tab onto the WooCommerce menu.
* Fix - PayPal as a security feature blocks POST request from checkout in iframe pop-up. Added feature that when /checkout URL is requested in pop-up it auto closes and redirects user to the sites checkout.
* Fix - Plugins admin script and style not loading in Firefox with SSL on admin. Stripped http// and https// protocols so browser will use the protocol that the page was loaded with.

= 1.0.1 - 2013/09/03 =
* Tweak - Tested for full compatibility with WordPress v3.6.0
* Fix - Updated some prefixes to a3rev_ for compatibility with the a3revFramework.

= 1.0.0 - 2013/08/05 =
* First working release


== Upgrade Notice ==

= 1.5.1 =
Maintenance Update. 1 bug fix for full compatibility with WooCoomerce version 2.6.6

= 1.5.0 =
Massive Feature Upgrade! 8 new features, 8 major code tweaks (see changelog) plus full compatibility with WordPress 4.6 and WooCommerce 2.6.4

= 1.4.1 =
Maintenance Update. 3 bug fixes plus 2 major tweaks for full compatibility with WooCommerce major version 2.6.0, version 2.6.1 and WordPress version 4.5.2

= 1.4.0 =
Feature Upgrade. Major upgrade of Custom Template Dynamic Product Gallery, plus 6 Tweaks, 4 bug fixes for full compatibility with upcoming major WordPress 4.5.0 version and WooCommerce version 2.5.5

= 1.3.0 =
Major Feature upgrade with 9 new features 9 major code tweaks and 1 bug fix for full compatibility with WordPress 4.4.1 and WooCommerce 2.5.1

= 1.2.5 = 
Major Maintenance Upgrade. 3 Code Tweaks plus 4 bug fixes for full compatibility with WordPress v 4.3.0 and WooCommerce v 2.4.4

= 1.2.4 =
Important Maintenance Upgrade. 2 x major a3rev Plugin Framework Security Hardening Tweaks plus 1 https bug fix and full compatibility with WooCommerce 2.3.10 and WordPress 4.2.2

= 1.2.3 =
Maintenance Update. 1 Bug fix for full compatibility with PHP caching plugins and full compatibility with WordPress version 4.2.1

= 1.2.2 =
Maintenance upgrade. Code tweaks for full compatibility with WordPress 4.2.0 and WooCommerce 2.3.8

= 1.2.1 =
Upgrade now for full compatibility with WooCommerce Version 2.3.7 and WordPress version 4.1.1

= 1.2.0 =
Maintenance Update.Full compatibility with WooCommerce major version release 2.3.0 with backward compatibility to WooCommerce v 2.2.0 and full compatibility with WordPress v4.1

= 1.1.1 =
Upgrade now for 1 Sass bug fix and full compatibility with WooCommerce Version 2.2.2

= 1.1.0 =
Major Version upgrade. Full CSS conversion to Sass and full compatibility with WordPress v4.0 and WooCommerce v2.2

= 1.0.6.4 =
Upgrade now for a framework code tweak that makes your plugin fully compatibile with WooCommerce Version 2.1.11 and backwards.

= 1.0.6.3 =
Update your plugin for a Framework code tweak and full compatibility with WooCommerce version 2.1.10

= 1.0.6.2 =
Update your plugin now for 3 new a3rev plugin framework code tweaks.

= 1.0.6.1 =
Upgrade now for a Quick View Fancybox scroll bug fix in iOS Mobile operating system.

= 1.0.6 =
Upgrade now for new features. Full Button styling options. Quick View as button or Hyperlink text under product images. Full compatibility with WooCommerce 2.1.9

= 1.0.5.1 =
Update now for 4 Tweaks and full compatibility with WooCommerce Version version 2.1.8 and WordPress Version 3.9.1

= 1.0.5 =
Upgrade now for full compatibility with WooCommerce Version 2.1 and WordPress version 3.8.1. Includes full backward compatibly with WooCommerce versions 2.0 to 2.0.20. Major pop-up display in mobiles rework.

= 1.0.4 =
Upgrade now for full a3rev Plugin Framework compatibility with WordPress version 3.8.0 and backwards. New admin interface full mobile and tablet responsive display.

= 1.0.3 =
Upgrade now for another admin panel intuitive app interface feature plus a Radio switch bug fix and Android platform bug fix

= 1.0.2 =
Upgrade now to get the all new admin panel app interface. PayPal checkout in pop-up bug fix and browser protocol bug fix.

= 1.0.0 =
Upgrade now for one new bug fix

