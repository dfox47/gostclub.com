<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */


$travesia_header_css = $travesia_header_image = '';
$travesia_header_video = travesia_get_header_video();
if (true || empty($travesia_header_video)) {
	$travesia_header_image = get_header_image();
	if (travesia_trx_addons_featured_image_override()) $travesia_header_image = travesia_get_current_mode_image($travesia_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($travesia_header_image) || !empty($travesia_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($travesia_header_video!='') echo ' with_bg_video';
					if ($travesia_header_image!='') echo ' '.esc_attr(travesia_add_inline_css_class('background-image: url('.esc_url($travesia_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (travesia_is_on(travesia_get_theme_option('header_fullheight'))) echo ' header_fullheight travesia-full-height';
					?> scheme_<?php echo esc_attr(travesia_is_inherit(travesia_get_theme_option('header_scheme')) 
													? travesia_get_theme_option('color_scheme') 
													: travesia_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($travesia_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (travesia_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>