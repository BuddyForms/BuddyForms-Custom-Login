<?php

/**
* Plugin Name: BuddyForms Custom Login Page
* Plugin URI: https://themekraft.com/products/custom-login/
* Description: Select a Custom Login Page
* Version: 1.0.1
* Author: ThemeKraft
* Author URI: https://themekraft.com/
* License: GPLv2 or later
* Network: false
* Text Domain: buddyforms
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
	$redirect_page  = empty( $custom_login_settings['redirect_page'] ) ? '' : $custom_login_settings['redirect_page'];

	if( get_the_ID() != $login_page ){
		return $content;
	}

	if( empty( $redirect_page ) || $redirect_page == 'default' ){
		$form = do_shortcode('[bf_login_form title=" "]');
	} else {
		$redirect_url = get_permalink( $redirect_page );
		$form = do_shortcode('[bf_login_form title=" " redirect_url="' . $redirect_url . '"]');
	}

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

// Create a helper function for easy SDK access.
function buddyforms_clp_fs() {
	global $buddyforms_clp_fs;

	if ( ! isset( $buddyforms_clp_fs ) ) {
		// Include Freemius SDK.
		// Include Freemius SDK.
		if ( file_exists( dirname( dirname( __FILE__ ) ) . '/buddyforms/includes/resources/freemius/start.php' ) ) {
			// Try to load SDK from parent plugin folder.
			require_once dirname( dirname( __FILE__ ) ) . '/buddyforms/includes/resources/freemius/start.php';
		} else if ( file_exists( dirname( dirname( __FILE__ ) ) . '/buddyforms-premium/includes/resources/freemius/start.php' ) ) {
			// Try to load SDK from premium parent plugin folder.
			require_once dirname( dirname( __FILE__ ) ) . '/buddyforms-premium/includes/resources/freemius/start.php';
		}


		$buddyforms_clp_fs = fs_dynamic_init( array(
			'id'                  => '1924',
			'slug'                => 'buddyforms-custom-login-page',
			'type'                => 'plugin',
			'public_key'          => 'pk_9e440e4e95f7a9556ae3c03c4c221',
			'is_premium'          => false,
			'has_paid_plans'      => false,
			'parent'              => array(
				'id'         => '391',
				'slug'       => 'buddyforms',
				'public_key' => 'pk_dea3d8c1c831caf06cfea10c7114c',
				'name'       => 'BuddyForms',
			),
			'menu'                => array(
				'first-path'     => 'edit.php?post_type=buddyforms&page=buddyforms_welcome_screen',
				'support'        => false,
			),
		) );
	}

	return $buddyforms_clp_fs;
}

function buddyforms_clp_fs_is_parent_active_and_loaded() {
	// Check if the parent's init SDK method exists.
	return function_exists( 'buddyforms_core_fs' );
}

function buddyforms_clp_fs_is_parent_active() {
	$active_plugins = get_option( 'active_plugins', array() );

	if ( is_multisite() ) {
		$network_active_plugins = get_site_option( 'active_sitewide_plugins', array() );
		$active_plugins         = array_merge( $active_plugins, array_keys( $network_active_plugins ) );
	}

	foreach ( $active_plugins as $basename ) {
		if ( 0 === strpos( $basename, 'buddyforms/' ) ||
		     0 === strpos( $basename, 'buddyforms-premium/' )
		) {
			return true;
		}
	}

	return false;
}

function buddyforms_clp_fs_init() {
	if ( buddyforms_clp_fs_is_parent_active_and_loaded() ) {
		// Init Freemius.
		buddyforms_clp_fs();

		// Parent is active, add your init code here.
	} else {
		// Parent is inactive, add your error handling here.
	}
}

if ( buddyforms_clp_fs_is_parent_active_and_loaded() ) {
	// If parent already included, init add-on.
	buddyforms_clp_fs_init();
} else if ( buddyforms_clp_fs_is_parent_active() ) {
	// Init add-on only after the parent is loaded.
	add_action( 'buddyforms_core_fs_loaded', 'buddyforms_clp_fs_init' );
} else {
	// Even though the parent is not activated, execute add-on for activation / uninstall hooks.
	buddyforms_clp_fs_init();
}
