<?php
/**
 * @package Retain
 * @version 0.1
Plugin Name: Retain
Plugin URI: http://wordpress.org/plugins/retain/
Description: Retain is a Livechat plugin
Author: websima
Version: 0.1
Author URI: https://retain.ir
*/


add_action( 'plugins_loaded', 'retain_load_textdomain' );
function retain_load_textdomain() {
  load_plugin_textdomain( 'retain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_action('admin_menu', 'retain_custom_menu_page');

function retain_custom_menu_page()
{
	add_menu_page(__('Retain', 'retain'), __('Retain', 'retain'), 'manage_options', 'retain', 'retain_options_page_view', plugins_url('retain/assets/icon.png') , 100);
}

include_once('includes/retain-settings.php');

add_action('wp_head', 'retain_hook_head');
function retain_hook_head() {
	$retain_settings = get_option('retain_settings');
	if ($retain_settings['retain_appid'] != '') {
		if ($retain_settings['retain_type'] == 'yes') {
			if ( is_user_logged_in() ) {
					$current_user = wp_get_current_user();
					$userid = $current_user->user_id;
					$email = $current_user->user_email;
					$nickname = $current_user->display_name;
					echo '<script type="text/javascript">window.vasleSettings = {
						app_id: "'.$retain_settings['retain_appid'].'",
						userid: "'.$userid.'",
						email: "'.$email.'",
						fullname: "'.$nickname.'",
						};</script>';

			} else {
			echo '<script type="text/javascript">window.vasleSettings = {app_id: "'.$retain_settings['retain_appid'].'"};</script>';
			}
		} else {
			echo '<script type="text/javascript">window.vasleSettings = {app_id: "'.$retain_settings['retain_appid'].'"};</script>';
		}
		echo '<script type="text/javascript"> !function(){function t(){var t=n.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://www.retain.ir/app/3esScD5p/widget/?"+Math.random().toString(34).slice(2);var e=n.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}var e=window,a=e.Vasle;if("function"==typeof a)a("reattach_activator"),a("update",e.vasleSettings);else{var n=document,c=function(){c.c(arguments)};c.q=[],c.c=function(t){c.q.push(t)},e.Vasle=c,e.attachEvent?e.attachEvent("onload",t):e.addEventListener("load",t,!1)}}();</script>';
	}
}
?>