<?php

add_filter('buddyforms_admin_tabs', 'buddyforms_custom_login_admin_tab', 10, 1);
function buddyforms_custom_login_admin_tab($tabs){

	$tabs['custom_login'] = 'Custom Login';

	return $tabs;
}

add_action( 'buddyforms_settings_page_tab', 'buddyforms_custom_login_settings_page_tab' );
function buddyforms_custom_login_settings_page_tab($tab){

	if($tab != 'custom_login')
		return $tab;

	$custom_login_settings = get_option( 'buddyforms_custom_login_settings' );


	?>

	<div class="metabox-holder">
		<div class="postbox buddyforms-metabox">
			<div class="inside">
				<form method="post" action="options.php">

					<?php settings_fields( 'buddyforms_custom_login_settings' ); ?>

					<table class="form-table">

						<tbody><tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_custom_login">Login Page</label>
								<span class="buddyforms-help-tip"></span>						</th>
							<td class="forminp forminp-select">
                                <?php
                                $pages = buddyforms_get_all_pages('id', 'settings');
                                $page = empty( $custom_login_settings['page'] ) ? '' : $custom_login_settings['page'];

                                if ( isset( $pages ) && is_array( $pages ) ) {
                                    echo '<select name="buddyforms_custom_login_settings[page]" id="buddyforms_login_page">';
                                    $pages['none'] = 'WordPress Default';
                                    foreach ( $pages as $page_id => $page_name ) {
                                        if( ! empty($page_name)){
	                                        echo '<option ' . selected( $page, $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
                                        }
                                    }
                                    echo '</select>';
                                }?>
							</td>
						</tr><tr valign="top">
							<th scope="row" class="titledesc">
								<label for="buddyforms_custom_login_lavel_1">Level 1 Message</label>
								<span class="buddyforms-help-tip"></span>						</th>
							<td class="forminp forminp-text">
								<input name="buddyforms_custom_login_settings[lavel_1]" id="buddyforms_custom_login_lavel_1" type="text" style="min-width:350px;" value="<?php echo isset( $custom_login_settings['lavel_1'] ) && ! empty( $custom_login_settings['lavel_1'] ) ? $custom_login_settings['lavel_1']  : __("Short: Your password is too short.", 'buddyforms_custom_login'); ?>" class="" placeholder="<?php _e("Short: Your password is too short.", 'buddyforms_custom_login'); ?>"> 						</td>
						</tr>
						</tbody></table>
					<?php submit_button(); ?>

				</form>
			</div><!-- .inside -->
		</div><!-- .postbox -->
	</div><!-- .metabox-holder -->
	<?php
}

add_action( 'admin_init', 'buddyforms_custom_login_register_option' );
function buddyforms_custom_login_register_option() {
	// creates our settings in the options table
	register_setting( 'buddyforms_custom_login_settings', 'buddyforms_custom_login_settings', 'buddyforms_custom_login_settings_default_sanitize' );
}

// Sanitize the Settings
function buddyforms_custom_login_settings_default_sanitize( $new ) {
	return $new;
}
