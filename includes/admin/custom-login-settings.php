<?php

add_filter( 'buddyforms_admin_tabs', 'buddyforms_custom_login_admin_tab', 1, 1 );
function buddyforms_custom_login_admin_tab( $tabs ) {

	$tabs['custom_login'] = 'Custom Login';

	return $tabs;
}

add_action( 'buddyforms_settings_page_tab', 'buddyforms_custom_login_settings_page_tab' );
function buddyforms_custom_login_settings_page_tab( $tab ) {
    global $buddyforms;

	if ( $tab != 'custom_login' ) {
		return $tab;
	}

	$custom_login_settings = get_option( 'buddyforms_custom_login_settings' );


	?>

    <div class="metabox-holder">
        <div class="postbox buddyforms-metabox">
            <div class="inside">
                <form method="post" action="options.php">

					<?php settings_fields( 'buddyforms_custom_login_settings' ); ?>

                    <table class="form-table">

                        <tbody>
                        <tr valign="top">
                            <th scope="row" class="titledesc">
                                <label for="buddyforms_custom_login">Login Page</label>
                                <span class="buddyforms-help-tip"></span></th>
                            <td class="forminp forminp-select">
								<?php
								$pages = buddyforms_get_all_pages( 'id', 'settings' );
								$login_page  = empty( $custom_login_settings['login_page'] ) ? '' : $custom_login_settings['login_page'];

								if ( isset( $pages ) && is_array( $pages ) ) {
									echo '<select name="buddyforms_custom_login_settings[login_page]" id="buddyforms_custom_login_login_page">';
									$pages['none'] = 'WordPress Default';
									foreach ( $pages as $page_id => $page_name ) {
										if ( ! empty( $page_name ) ) {
											echo '<option ' . selected( $login_page, $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
										}
									}
									echo '</select>';
								} ?>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" class="titledesc">
                                <label for="buddyforms_custom_login_lavel_1">Display Login Form?</label>
                                <span class="buddyforms-help-tip"></span></th>
                            <td class="forminp forminp-select">
		                        <?php
		                        $display_login_form  = empty( $custom_login_settings['display_login_form'] ) ? '' : $custom_login_settings['display_login_form'];
		                        ?>
                                <select name="buddyforms_custom_login_settings[display_login_form]" id="buddyforms_custom_login_display_login_form">
                                    <option <?php selected( $display_login_form, 'overwrite'); ?> value="overwrite">Overwrite Page Content</option>
                                    <option <?php selected( $display_login_form, 'above'); ?> value="above">Above the Content</option>
                                    <option <?php selected( $display_login_form, 'under'); ?> value="under">Under the Content</option>
                                    <option <?php selected( $display_login_form, 'shortcode'); ?> value="shortcode">I use the Shortcode</option>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" class="titledesc">
                                <label for="buddyforms_custom_login_lavel_1">Display Registration Link?</label>
                                <span class="buddyforms-help-tip">You can select a Registation Page </span></th>
                            <td>
		                        <?php
		                        $register_page  = empty( $custom_login_settings['register_page'] ) ? '' : $custom_login_settings['register_page'];

		                        if ( isset( $pages ) && is_array( $pages ) ) {
			                        echo '<select name="buddyforms_custom_login_settings[register_page]" id="buddyforms_registration_form">';
			                        echo '<option value="default">' . __( 'WordPress Default', 'buddyforms' ) . '</option>';
			                        echo '<option value="none">' . __( 'None', 'buddyforms' ) . '</option>';
			                        foreach ( $pages as $page_id => $page_name ) {
				                        if ( ! empty( $page_name ) ) {
					                        echo '<option ' . selected( $register_page, $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
				                        }
			                        }
			                        echo '</select>';
		                        }
		                        ?>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row" class="titledesc">
                                <label for="buddyforms_custom_login_lavel_1">Redirect after Login</label>
                                <span class="buddyforms-help-tip"></span></th>
                            <td class="forminp forminp-select">
		                        <?php
		                        $redirect_page  = empty( $custom_login_settings['redirect_page'] ) ? '' : $custom_login_settings['redirect_page'];
		                        if ( isset( $pages ) && is_array( $pages ) ) {
			                        echo '<select name="buddyforms_custom_login_settings[redirect_page]" id="buddyforms_custom_login_redirect_page">';
			                        $pages['default'] = 'WordPress Default';
			                        foreach ( $pages as $page_id => $page_name ) {
				                        if ( ! empty( $page_name ) ) {
					                        echo '<option ' . selected( $redirect_page, $page_id ) . 'value="' . $page_id . '">' . $page_name . '</option>';
				                        }
			                        }
			                        echo '</select>';
		                        } ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
