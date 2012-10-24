<?php

/*
Plugin Name: WooCommerce Facebook Like Share Button
Plugin URI: http://terrytsang.com
Description: Add a Facebook Like and Share button to your product pages
Version: 1.2.2
Author: Terry Tsang
Author URI: http://terrytsang.com
*/

/*  Copyright 2012 Terry Tsang (email: terry at terrytsang.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/*
 * TSANG_WooCommerce_FbShareLike_Button
 */
if ( ! class_exists( 'TSANG_WooCommerce_FbShareLike_Button' ) ) {
	class TSANG_WooCommerce_FbShareLike_Button{
		var $id_name = 'tsang_fbsharelike_tab';
		var $id = 'tsang_fbsharelike';
		var $plugin_url;
		var $options;
		var $key;
		
		function __construct()
		{
			$this->plugin_url = trailingslashit(plugins_url(null,__FILE__));
			$this->key = 'tsang_fbsharelike';
			
			//Add product write panel
			add_action( 'woocommerce_product_write_panels', array(&$this, 'tsang_fbsharelike_main') );
			add_action( 'woocommerce_product_write_panel_tabs', array(&$this,'tsang_fbsharelike_tab') );
			
			//Add product meta
			add_action( 'woocommerce_process_product_meta', array(&$this, 'tsang_fbsharelike_meta') );
			
			//Display on product page for the facebook share and like button
			$this->options = $this->get_options();
			$option_show_after_table = $this->options['custom_show_after_title'];
			
			if( $option_show_after_table == 'yes' )
				add_action( 'woocommerce_single_product_summary', array(&$this, 'tsang_fbsharelike_button' ), 8 );
			else
				add_action( 'woocommerce_single_product_summary', array(&$this, 'tsang_fbsharelike_button' ), 100 );
				
			$this->options = $this->get_options();
			
			//Display Admin Menu for Facebook App ID
			add_action( 'admin_menu', array( &$this, 'add_menu_items' ) );
			
			//Add javascript after <body> tag
			//add_action( 'init', array( &$this, 'add_afterbody_scripts' ) );
			add_action( 'wp_footer', array( &$this, 'add_afterbody_scripts' ) );
			
			//add image_src link for facebook thumbnail generation
			add_action( 'wp_head', array( &$this, 'add_head_imagesrc' ) );
		}
		
		function add_head_imagesrc()
		{
		?>
			<link rel="image_src" href="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); } ?>" />
			<link rel="image_src" href="logo.png" />
		<?php
		}
		
		function tsang_fbsharelike_main()
		{
			global $post;
			$enabled_option = get_post_meta($post->ID, $this->id, true);
			$label = 'Enable';
			$description = 'Enable Facebook Share Like Button on this product?';
			
			//if the option not set for yes or no, then default is yes
			if( 'yes' != $enabled_option && 'no' != $enabled_option ):
				$enabled_option = 'yes'; 
			endif;
			
			$check_id = $this->id;
			$check_app_id = $this->app_id;
			
			?>
			<div id="fbsharelike" class="panel woocommerce_options_panel" style="display: none; ">
				<fieldset>
					<p class="form-field">
						<?php
							woocommerce_wp_checkbox(array(
								'id'		=> $check_id,
								'label'		=> __($label, $this->id_name),
								'description'	=> __($description, $this->id_name),
								'value'		=> $enabled_option
							));
						?>
						<br /><br />
						<span class="alignright" style="font-size:75%; font-weight: bold;">Facebook ShareLike Extension by Terry Tsang - <a target="_blank" href="http://terrytsang.com/" title="Facebook ShareLike Extension by Terry Tsang">View More</a></span>
					</p>
				</fieldset>
			</div>
			<?php
		}
		
		function tsang_fbsharelike_tab()
		{
			?>
			<li class="tsang_fbsharelike_tab">	
				<a href="#fbsharelike"><?php _e('Facebook ShareLike', $this->app_name );?></a>
			</li>
			<?php
		}
		
		function tsang_fbsharelike_meta( $post_id )
		{
			$tsang_fbsharelike_option = isset($_POST[$this->id]) ? 'yes' : 'no';
	    	update_post_meta($post_id, $this->id, $tsang_fbsharelike_option);
		}
		
		function tsang_fbsharelike_button()
		{
			global $post;
			$enabled_option = get_post_meta($post->ID, $this->id, true);
			
			if( $enabled_option != 'yes' && $enabled_option != 'no' ):
				$enabled_option = 'yes'; //default new products or unset value to true
			endif;
			
			$this->options = $this->get_options();
			$option_show_only_like = $this->options['custom_show_only_like'];
			$data_send_option = true;
			
			if( $option_show_only_like == 'yes' )
				$data_send_option = false;
				
			if( $enabled_option == 'yes' ):
			?>
				<br />
				<div class="fb-like" data-send="<?php echo $data_send_option; ?>" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			<?php
			endif;
		}
		
		function add_menu_items() {
			$image = $this->plugin_url . '/assets/images/icon.png';
			add_menu_page( __( 'FbShareLike', 'facebook-sharelike' ), __( 'FbShareLike', 'facebook-sharelike' ), 'manage_options', 'fbshare_settings', array(
				&$this,
				'options_page'
			), $image);
		}
		
		//start to include any script after <body> tag
		function add_afterbody_scripts()
		{
			$custom_facebook_app_id = $this->options['custom_facebook_app_id'];
			if ( ! $custom_facebook_app_id ) 
				$custom_facebook_app_id = '216944597824';
				
			echo '<div id="fb-root"></div> 
        	<script>(function(d, s, id) { 
	            var js, fjs = d.getElementsByTagName(s)[0]; 
	            if (d.getElementById(id)) return; 
	            js = d.createElement(s); js.id = id; 
	            js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId='.$custom_facebook_app_id.'"; 
	            fjs.parentNode.insertBefore(js, fjs); 
        	}(document, \'script\', \'facebook-jssdk\'));</script>';
		}
		
		function options_page() 
		{ 
			// If form was submitted
			if ( isset( $_POST['submitted'] ) ) 
			{			
				check_admin_referer( 'facebook-sharelike' );
				
				$this->options['custom_facebook_app_id'] = ! isset( $_POST['custom_facebook_app_id'] ) ? '216944597824' : $_POST['custom_facebook_app_id'];
				$this->options['custom_show_after_title'] = ! isset( $_POST['custom_show_after_title'] ) ? '' : $_POST['custom_show_after_title'];
				$this->options['custom_show_only_like'] = ! isset( $_POST['custom_show_only_like'] ) ? '' : $_POST['custom_show_only_like'];
				
				update_option( $this->key, $this->options );
				
				// Show message
				echo '<div id="message" class="updated fade"><p>' . __( 'Facebook ShareLike options saved.', 'facebook-sharelike' ) . '</p></div>';
			} 
			
			$custom_facebook_app_id = $this->options['custom_facebook_app_id'];
			$custom_show_after_title = $this->options['custom_show_after_title'];
			$custom_show_only_like = $this->options['custom_show_only_like'];
			if ( ! $custom_facebook_app_id ) 
				$custom_facebook_app_id = '216944597824';
			
			$checked_value = '';
			if($custom_show_after_title == 'yes')
				$checked_value = 'checked="checked"';
				
			$checked_value2 = '';
			if($custom_show_only_like == 'yes')
				$checked_value2 = 'checked="checked"';
			
			global $wp_version;
		
			$imgpath = $this->plugin_url.'/assets/images/';
			$actionurl = $_SERVER['REQUEST_URI'];
			$nonce = wp_create_nonce( 'facebook-sharelike' );
			
			$this->options = $this->get_options();
					
			// Configuration Page
					
			?>
			<div class="wrap" >
				<h2><?php _e( 'WooCommerce Facebook ShareLike', 'facebook-sharelike' );  ?></h2>
				<div id="poststuff" style="margin-top:20px;">
					<div id="mainblock" style="width:700px">
						<div>
							<form action="<?php echo $actionurl; ?>" method="post">
								<input type="hidden" name="submitted" value="1" /> 
								<input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo $nonce; ?>" />
								<h2><?php _e( 'Options', 'facebook-sharelike' ); ?></h2>
								<div>
									<label for="custom_facebook_app_id">Your Facebook App ID</label>
									<input id="custom_facebook_app_id" name="custom_facebook_app_id" value="<?php echo $custom_facebook_app_id; ?>" size="20"/>
								</div>
								<div>&nbsp;</div>
								<div>
									<label for="custom_show_after_title">Show button after product title</label>
									<input class="checkbox" name="custom_show_after_title" id="custom_show_after_title" value="yes" <?php echo $checked_value; ?> type="checkbox">
								</div>
								<div>&nbsp;</div>
								<div>
									<label for="custom_show_only_like">Show only like button</label>
									<input class="checkbox" name="custom_show_only_like" id="custom_show_only_like" value="yes" <?php echo $checked_value2; ?> type="checkbox">
								</div>
								<div class="submit"><input type="submit" name="Submit" value="<?php _e( 'Update options', 'facebook-sharelike' ); ?>" /></div>
							</form>
						</div>
					 </div>
				</div>
			</div>
			<h4 class="author"><?php _e( 'A WooCommerce plugin by <a href="http://www.terrytsang.com">Terry Tsang', 'facebook-sharelike' ); ?></a></h4>
			<?php
		}
		
		// Handle our options
		function get_options() {
			$options = array(
				'custom_facebook_app_id' => '216944597824',
				'custom_show_after_title' => '',
			);
			$saved = get_option( $this->key );
			
			if ( ! empty( $saved ) ) {
				foreach ( $saved as $key => $option ) {
					$options[$key] = $option;
				}
			}
				  
			if ( $saved != $options ) {
				update_option( $this->key, $options );
			}
			
			return $options;
		}
	
	}
}


// finally instantiate the plugin class
$TSANG_WooCommerce_FbShareLike_Button = &new TSANG_WooCommerce_FbShareLike_Button();

?>