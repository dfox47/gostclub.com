<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('travesia_mailchimp_get_css')) {
	add_filter('travesia_filter_get_css', 'travesia_mailchimp_get_css', 10, 4);
	function travesia_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = travesia_get_border_radius();
			$css['fonts'] .= <<<CSS



CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS


.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
CSS;
		}

		return $css;
	}
}
?>