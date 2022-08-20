<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */

// Logo
if (travesia_is_on(travesia_get_theme_option('logo_in_footer'))) {
	$travesia_logo_image = '';
	if (travesia_is_on(travesia_get_theme_option('logo_retina_enabled')) && travesia_get_retina_multiplier(2) > 1)
		$travesia_logo_image = travesia_get_theme_option( 'logo_footer_retina' );
	if (empty($travesia_logo_image)) 
		$travesia_logo_image = travesia_get_theme_option( 'logo_footer' );
	$travesia_logo_text   = get_bloginfo( 'name' );
	if (!empty($travesia_logo_image) || !empty($travesia_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($travesia_logo_image)) {
					$travesia_attr = travesia_getimagesize($travesia_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($travesia_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('Image', 'travesia').'"'.(!empty($travesia_attr[3]) ? ' ' . wp_kses_data($travesia_attr[3]) : '').'></a>' ;
				} else if (!empty($travesia_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($travesia_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>