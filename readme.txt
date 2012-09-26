=== Plugin Name ===
Contributors: Terry Tsang
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=terry@terrytsang.com&item_name=Donation+for+TerryTsang+Wordpress+WebDev
Plugin Name: WooCommerce Facebook Share Like Button
Plugin URI:  http://terrytsang.com/
Tags: woocommerce, facebook, e-commerce
Requires at least: 2.7
Tested up to: 3.4.1
Stable tag: 1.2.0
Version: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WooCommerce plugin that implements facebook share and like button on product page.

== Description ==

This is a WooCommerce plugin that implements facebook share and like button on your product page. After you activated the plugin, the default option is 'Enabled' for all the existing products.

In WooCommerce Product panel, there will be a new tab called 'Facebook ShareLike' where you can uncheck or check 'Enabled' option to show the button or not.

NOTE: This plugin requires the WooCommerce Extension.

== Installation ==

1. Upload the entire *woocommerce-terrytsang-fbsharelike* folder to the */wp-content/plugins/* directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. If you want to use your own facebook app id for the plugin, go to Admin left sidebar menu 'FbShareLike' and update the option. Or else, just use default option.
4. That's it. You're ready to go and cheers!

== Screenshots ==

1. Screenshot Admin Product Enabled Option 
2. Screenshot Product Detail Page
3. Screenshot Admin FbShareLike Option Page

== Frequently Asked Questions ==

= After activated the plugin, do i need to insert facebook javascript after <body> tag? =

No, you can straight away use the plugin as the plugin included the script.

= If i want to use my own facebook app id, what should i do? =

To update your facebook app id for the plugin, go to Admin left sidebar, menu 'FbShareLike' and update option there.
If you want to change the default button position[bottom of product summary] to position after product title, just checked the option 'show button after product title'.

== Upgrade Notice ==

coming soon...

== Changelog ==

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

