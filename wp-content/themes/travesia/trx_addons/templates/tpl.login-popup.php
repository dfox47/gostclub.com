<?php
/**
 * The template to display login popup
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6
 */

// Prepare popup
$trx_addons_login_via_socials = do_shortcode(apply_filters('trx_addons_filter_login_via_socials', trx_addons_get_option('login_via_socials')));
$trx_addons_form_style = 'default';
?>
<div id="trx_addons_login_popup" class="trx_addons_popup trx_addons_tabs mfp-hide">
	<ul class="trx_addons_tabs_titles"><?php // Attention! No CR or LF between tab titles!
		// Login tab
		?><li class="trx_addons_tabs_title trx_addons_tabs_title_login">
			<a href="<?php echo esc_url(trx_addons_get_hash_link('#trx_addons_login_content')); ?>">
				<?php esc_html_e('Sign In', 'travesia'); ?>
			</a>
		</li><?php
		// Register tab
		?><li class="trx_addons_tabs_title trx_addons_tabs_title_register"<?php
				if ( (int) get_option('users_can_register') == 0) {
					echo ' data-disabled="true"';
				}
				?>>
			<a href="<?php echo esc_url(trx_addons_get_hash_link('#trx_addons_register_content')); ?>">
				<?php esc_html_e('Registration', 'travesia'); ?>
			</a>
		</li><?php
	?></ul><?php
	
	// Login form
	?>
	<div id="trx_addons_login_content" class="trx_addons_tabs_content trx_addons_login_content">
		<div<?php if (!empty($trx_addons_login_via_socials)) echo ' class="trx_addons_left_side"'; ?>>
			<div class="trx_addons_popup_form_wrap trx_addons_popup_form_wrap_login">
				<form class="trx_addons_popup_form trx_addons_popup_form_login <?php if ($trx_addons_form_style != 'default') echo 'sc_input_hover_'.esc_attr($trx_addons_form_style); ?>" action="<?php echo wp_login_url(); ?>" method="post" name="trx_addons_login_form">
					<input type="hidden" id="login_redirect_to" name="redirect_to" value="">
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_login">
						<div class="trx_addons_popup_form_name"><?php esc_html_e('Username or email address *', 'travesia')?></div>
						<?php
						trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
														'trx_addons_args_sc_form_field',
														array(
															'style'       => $trx_addons_form_style,
															'field_name'  => 'log',
															'field_type'  => 'text',
															'field_req'   => true,
															'field_icon'  => 'trx_addons_icon-user-alt',
															'field_title' => esc_html__('Login', 'travesia')
															)
													);
						?>
					</div>
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_password">
						<div class="trx_addons_popup_form_name"><?php esc_html_e('Password', 'travesia')?></div>
						<?php
						trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
														'trx_addons_args_sc_form_field',
														array(
															'style'       => $trx_addons_form_style,
															'field_name'  => 'pwd',
															'field_type'  => 'password',
															'field_req'   => true,
															'field_icon'  => 'trx_addons_icon-lock',
															'field_title' => esc_html__('Password', 'travesia')
															)
													);
						?>
					</div>
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_remember">
						<input type="checkbox" value="forever" id="rememberme" name="rememberme"><label for="rememberme"> <?php esc_html_e('Keep me signed in', 'travesia'); ?></label>
					</div>
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_submit">
						<input type="submit" class="submit_button" value="<?php esc_attr_e('Sign In', 'travesia'); ?>">
					</div>
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_remember_forgot">
						<a href="<?php echo esc_url(wp_lostpassword_url(get_permalink())); ?>" class="trx_addons_popup_form_field_forgot_password"><?php esc_html_e('Forgot password?', 'travesia'); ?></a>
					</div>
					<div class="trx_addons_message_box sc_form_result"></div>
				</form>
			</div>
		</div>
		<?php if (!empty($trx_addons_login_via_socials)) { ?>
			<div class="trx_addons_right_side">
				<div class="trx_addons_login_socials_title"><?php esc_html_e('or you can login using your favorite social profile!', 'travesia'); ?></div>
				<div class="trx_addons_login_socials_list">
					<?php trx_addons_show_layout($trx_addons_login_via_socials); ?>
				</div>
			</div>
		<?php } ?>
	</div><?php
	
	// Registration form
	if ( (int) get_option('users_can_register') > 0) {
		?>
		<div id="trx_addons_register_content" class="trx_addons_tabs_content">
			<div class="trx_addons_popup_form_wrap trx_addons_popup_form_wrap_register">
				<form class="trx_addons_popup_form trx_addons_popup_form_register <?php if ($trx_addons_form_style != 'default') echo 'sc_input_hover_'.esc_attr($trx_addons_form_style); ?>" action="<?php echo wp_login_url(); ?>" method="post" name="trx_addons_login_form">
					<input type="hidden" id="register_redirect_to" name="redirect_to" value="">
					<div class="trx_addons_left_side">
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_login">
							<?php
							trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
															'trx_addons_args_sc_form_field',
															array(
																'style'       => $trx_addons_form_style,
																'field_name'  => 'log',
																'field_type'  => 'text',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-user-alt',
																'field_title' => esc_html__('Login', 'travesia'),
																'field_placeholder' => esc_html__('Login', 'travesia')
																)
														);
							?>
						</div>
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_email">
							<?php
							trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
															'trx_addons_args_sc_form_field',
															array(
																'style'       => $trx_addons_form_style,
																'field_name'  => 'email',
																'field_type'  => 'text',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-mail',
																'field_title' => esc_html__('E-mail', 'travesia'),
																'field_placeholder' => esc_html__('E-mail', 'travesia')
																)
														);
							?>
						</div>
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_agree">
							<input type="checkbox" value="agree" id="agree" name="agree"><label for="agree"> <?php echo wp_kses_data(__('I agree with <a href="#">Terms and Conditions</a>', 'travesia')); ?></label>
						</div>
					</div>
					<div class="trx_addons_right_side">
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_password">
							<?php
							trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
															'trx_addons_args_sc_form_field',
															array(
																'style'       => $trx_addons_form_style,
																'field_name'  => 'pwd',
																'field_type'  => 'password',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-lock',
																'field_title' => esc_html__('Password', 'travesia'),
																'field_placeholder' => esc_html__('Password', 'travesia')
																)
														);
							?>
						</div>
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_password">
							<?php
							trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'form/tpl.form-field.php',
															'trx_addons_args_sc_form_field',
															array(
																'style'       => $trx_addons_form_style,
																'field_name'  => 'pwd2',
																'field_type'  => 'password',
																'field_req'   => true,
																'field_icon'  => 'trx_addons_icon-lock',
																'field_title' => esc_html__('Confirm Password', 'travesia'),
																'field_placeholder' => esc_html__('Confirm Password', 'travesia')
																)
														);
							?>
						</div>
						<div class="trx_addons_popup_form_field trx_addons_popup_form_field_pwd_description">
							<?php esc_html_e('Minimum 4 characters', 'travesia'); ?>
						</div>
					</div>
					<div class="trx_addons_popup_form_field trx_addons_popup_form_field_submit">
						<input type="submit" class="submit_button" value="<?php esc_attr_e('Sign Up', 'travesia'); ?>">
					</div>
					<div class="trx_addons_message_box sc_form_result"></div>
				</form>
			</div>
		</div>
		<?php
	}
	?>
</div>