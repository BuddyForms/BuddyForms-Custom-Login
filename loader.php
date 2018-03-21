<?php

/**
* Plugin Name: BuddyForms Custom Login Page
* Plugin URI: http://buddyforms.com/downloads/buddyforms-password-strength/
* Description: Select a Custom Login Page
* Version: 0.1
* Author: ThemeKraft
* Author URI: https://themekraft.com/buddyforms/
* License: GPLv2 or later
* Network: false
*
*****************************************************************************
*
* This script is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*
****************************************************************************
*/

// BuddyForms Members init
add_action( 'init', 'buddyforms_custom_login_init' );
function buddyforms_custom_login_init() {
	require( dirname( __FILE__ ) . '/includes/admin/custom-login-settings.php' );
}

add_action( 'init', 'buddyforms_custom_login_page' );
function buddyforms_custom_login_page() {
	global $pagenow;

	if( is_user_logged_in() ){
		return;
	}

	$custom_login_settings = get_option( 'buddyforms_custom_login_settings' );
	$login_page = empty( $custom_login_settings['login_page'] ) ? '' : $custom_login_settings['login_page'];

	if( empty( $login_page ) || $login_page == 'default' ){
		return;
	}

	$new_login_page_url = get_permalink( $login_page );

	if( $pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		if( ! ( isset( $_GET['action']) && $_GET['action'] == 'lostpassword' || isset( $_GET['action']) && $_GET['action'] == 'rp' ) ){
			if( ! ( isset( $_GET['checkemail']) && $_GET['checkemail'] == 'confirm' ) ) {
				wp_redirect( $new_login_page_url );
				exit;
			}
		}
	}
}

add_filter('login_form_bottom', 'buddyforms_site_register_link', 9999);
function buddyforms_site_register_link($wp_login_form){

	$custom_login_settings = get_option( 'buddyforms_custom_login_settings' );
	$register_page = empty( $custom_login_settings['register_page'] ) ? '' : $custom_login_settings['register_page'];
	$login_page  = empty( $custom_login_settings['login_page'] ) ? '' : $custom_login_settings['login_page'];

	if( get_the_ID() != $login_page ){
		return $wp_login_form;
	}

	if( ! empty( $register_page ) ){
		$url = get_permalink( $register_page );
	}

	$wp_login_form = '<a href="' . $url . '">'. __('Register', 'buddyforms') . '</a> ';
	$wp_login_form .= '<a href="' . esc_url( wp_lostpassword_url() ) . '">' . __('Lost Password?', 'buddyforms') . '</a> ';
	return $wp_login_form;
}



add_filter( 'the_content', 'buddyforms_custom_login_the_content' );
function buddyforms_custom_login_the_content( $content ) {

	$custom_login_settings = get_option( 'buddyforms_custom_login_settings' );
	$login_page  = empty( $custom_login_settings['login_page'] ) ? '' : $custom_login_settings['login_page'];
	$display_login_form  = empty( $custom_login_settings['display_login_form'] ) ? 'overwrite' : $custom_login_settings['display_login_form'];

	if( get_the_ID() != $login_page ){
		return $content;
	}

	$form = do_shortcode('[bf_login_form title="Willkommen zurück!"]');

	if( $display_login_form == 'overwrite') {
		return $form;
	}
	if( $display_login_form == 'above') {
		return $form . $content;
	}
	if( $display_login_form == 'under') {
		return $content . $form;
	}

	return $content;

}