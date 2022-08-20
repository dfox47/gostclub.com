<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_args = get_query_var('travesia_logo_args');

// Site logo
$travesia_logo_type   = isset($travesia_args['type']) ? $travesia_args['type'] : '';
$travesia_logo_image  = travesia_get_logo_image($travesia_logo_type);
$travesia_logo_text   = travesia_is_on(travesia_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$travesia_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($travesia_logo_image) || !empty($travesia_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($travesia_logo_image)) {
			if (empty($travesia_logo_type) && function_exists('the_custom_logo') && (int) $travesia_logo_image > 0) {
				the_custom_logo();
			} else {
				$travesia_attr = travesia_getimagesize($travesia_logo_image);
				echo '<img src="'.esc_url($travesia_logo_image).'" alt="'.esc_attr__('Image', 'travesia').'"'.(!empty($travesia_attr[3]) ? ' '.wp_kses_data($travesia_attr[3]) : '').'>';
			}
		} else {
			travesia_show_layout(travesia_prepare_macros($travesia_logo_text), '<span class="logo_text">', '</span>');
			travesia_show_layout(travesia_prepare_macros($travesia_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>