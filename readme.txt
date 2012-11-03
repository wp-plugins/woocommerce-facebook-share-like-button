=== Plugin Name ===
Contributors: terrytsang
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=terry@terrytsang.com&item_name=Donation+for+TerryTsang+Wordpress+WebDev
Plugin Name: WooCommerce Facebook Share Like Button
Plugin URI:  http://terrytsang.com/
Tags: woocommerce, facebook, e-commerce
Requires at least: 2.7
Tested up to: 3.4.1
Stable tag: 2.0.0
Version: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WooCommerce plugin that implements facebook share and like button on product page with flexible options.

== Description ==

This is a WooCommerce plugin that implements facebook share and like button on the product page with flexible options. After you activated the plugin, the default option is 'Enabled' for all the existing products.

Under WooCommerce sidebar panel, there will be a new child menu link called 'FBShareLike Settings' section.

The list of options for the section above:

*   Replace default app id value with yours one, or else just leave it
*   Set width
*   Enable "Show button below product title" option
*   Enable 'Show Like button only' option
*   Choose 'Verb to display' for LIKE button - default(like) or recommend
*   Choose 'Color Scheme' - default(light) or dark button
*   Select 'Language Setting' for the language for button. (77 languages supported)


NOTE: This plugin requires the WooCommerce Extension.

== Installation ==

1. Upload the entire *woocommerce-terrytsang-fbsharelike* folder to the */wp-content/plugins/* directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. A new menu link appeared under WooCommerce sidebar panel, you can click that to update options.
4. That's it. You're ready to go and cheers!

== Screenshots ==

1. Screenshot Admin Product Enabled Option 
2. Screenshot Frontend Product Detail Page
3. Screenshot Admin FbShareLike Settings Option Page
4. Screenshot Frontend - Chinese and Show After Product Title
5. Screenshot Frontend - French and Show Like Button Only

== Frequently Asked Questions ==

= After activated the plugin, do i need to insert facebook javascript after <body> tag? =

No, you can straight away use the plugin as the plugin included the script.


= If i want to use my own facebook application id, what should i do? =

To update your facebook app id for the plugin, go to Admin left sidebar, menu 'FbShareLike Settings' under 'WoocCommerce' and update option there.


= If i want to change the default button position[bottom of product summary] to position after product title, what should i do? =

You can check the option 'Show button after product title' at 'FbShareLike Settings' section.


= If i only want to show facebook like button on product page, not the share button. =

You can check the option 'Show only like button' at 'FbShareLike Settings' section.


= If i only want to show dark color button on product page, not the light color button. =

You can select 'Dark' at 'Color Scheme' option under 'FbShareLike Settings' section.


= If i only want to show different language for the button text? =

You can select at 'Language Settings' option under 'FbShareLike Settings' section. (77 Languages Supported Now)


== Upgrade Notice ==

coming soon...

== Changelog ==

= 2.0.0 =

* Change menu 'FbShareLike' sidebar to 'FBShareLike Settings' link under 'WooCommerce' sidebar panel
* Add more options for the setting page (width, languages, verb to display and color scheme)
* Add OG <Meta> tags for facebook graph apps


= 1.2.3 =

* Fixed bugs

= 1.2.2 =

* Add <link rel="image_src" href="[post thumbnail image]" /> to Fix Wrong Thumbnail Issue For FaceBook Like and Send

= 1.2.1 =

* Add sidebar admin menu 'FbShareLike' for option show only like button
* Update plugin banner photo

= 1.2.0 =

* Add sidebar admin menu 'FbShareLike' for option show button after product title
* Fixed missing assets/js/tsang_fbsharelike.js

= 1.1.0 =

* Add sidebar admin menu 'FbShareLike' for option update for own facebook app id

= 1.0.1 =

* Bug fixed: Class 'TSANG_WooCommerce_FbShareLike_Button' not found

= 1.0.0 =

* Initial Release
* Basic Facebook Share Like Button option for woocommerce products