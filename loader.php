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
	$page = empty( $custom_login_settings['page'] ) ? '' : $custom_login_settings['page'];

	if( empty( $page ) ){
		return;
	}

	$new_login_page_url = get_permalink( $page );

	if( $pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		if( ! ( isset( $_GET['action']) && $_GET['action'] == 'lostpassword' || isset( $_GET['action']) && $_GET['action'] == 'rp' ) ){
			if( ! ( isset( $_GET['checkemail']) && $_GET['checkemail'] == 'confirm' ) ) {
				wp_redirect( $new_login_page_url );
				exit;
			}
		}
	}
}



//add_filter('login_form_bottom', 'baumensch_site_register_link');
function baumensch_site_register_link($wp_login_form){
	$url = home_url( '/jetzt-registrieren/' ); // new login page

	$wp_login_form .= '<a href="' . $url . '">Jetzt Registrieren</a> ';
	return $wp_login_form;
}