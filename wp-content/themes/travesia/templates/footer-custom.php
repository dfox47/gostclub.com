<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */

$travesia_footer_scheme =  travesia_is_inherit(travesia_get_theme_option('footer_scheme')) ? travesia_get_theme_option('color_scheme') : travesia_get_theme_option('footer_scheme');
$travesia_footer_id = str_replace('footer-custom-', '', travesia_get_theme_option("footer_style"));
if ((int) $travesia_footer_id == 0) {
	$travesia_footer_id = travesia_get_post_id(array(
												'name' => $travesia_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$travesia_footer_id = apply_filters('travesia_filter_get_translated_layout', $travesia_footer_id);
}
$travesia_footer_meta = get_post_meta($travesia_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($travesia_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($travesia_footer_id))); 
						if (!empty($travesia_footer_meta['margin']) != '') 
							echo ' '.esc_attr(travesia_add_inline_css_class('margin-top: '.travesia_prepare_css_value($travesia_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($travesia_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('travesia_action_show_layout', $travesia_footer_id);
	?>
</footer><!-- /.footer_wrap -->
