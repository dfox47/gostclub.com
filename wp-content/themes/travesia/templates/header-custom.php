<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.06
 */

$travesia_header_css = $travesia_header_image = '';
$travesia_header_video = travesia_get_header_video();
if (true || empty($travesia_header_video)) {
	$travesia_header_image = get_header_image();
	if (travesia_trx_addons_featured_image_override()) $travesia_header_image = travesia_get_current_mode_image($travesia_header_image);
}

$travesia_header_id = str_replace('header-custom-', '', travesia_get_theme_option("header_style"));
if ((int) $travesia_header_id == 0) {
	$travesia_header_id = travesia_get_post_id(array(
												'name' => $travesia_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUT_PT') ? TRX_ADDONS_CPT_LAYOUT_PT : 'cpt_layouts'
												)
											);
} else {
	$travesia_header_id = apply_filters('travesia_filter_get_translated_layout', $travesia_header_id);
}
$travesia_header_meta = get_post_meta($travesia_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($travesia_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($travesia_header_id)));
				echo !empty($travesia_header_image) || !empty($travesia_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($travesia_header_video!='') 
					echo ' with_bg_video';
				if ($travesia_header_image!='') 
					echo ' '.esc_attr(travesia_add_inline_css_class('background-image: url('.esc_url($travesia_header_image).');'));
				if (!empty($travesia_header_meta['margin']) != '') 
					echo ' '.esc_attr(travesia_add_inline_css_class('margin-bottom: '.esc_attr(travesia_prepare_css_value($travesia_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (travesia_is_on(travesia_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight travesia-full-height';
				?> scheme_<?php echo esc_attr(travesia_is_inherit(travesia_get_theme_option('header_scheme')) 
												? travesia_get_theme_option('color_scheme') 
												: travesia_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($travesia_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('travesia_action_show_layout', $travesia_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>