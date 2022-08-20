<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( !function_exists( 'travesia_tourmaster_get_css' ) ) {
	add_filter( 'travesia_filter_get_css', 'travesia_tourmaster_get_css', 10, 2 );
	function travesia_tourmaster_get_css($css, $args) {
		if (isset($css['fonts']) && isset($args['fonts'])) {
			$fonts = $args['fonts'];
			$css['fonts'] .= <<<CSS
/* Tour Master */
.tourmaster-form-field input[type="text"],
.tourmaster-form-field input[type="email"],
.tourmaster-form-field input[type="password"],
.tourmaster-form-field textarea,
.tourmaster-form-field select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
CSS;
		}

		if (isset($css['vars']) && isset($args['vars'])) {
			$vars = $args['vars'];
			$css['vars'] .= <<<CSS
.tourmaster-form-field input[type="text"],
.tourmaster-form-field input[type="email"],
.tourmaster-form-field input[type="password"],
.tourmaster-form-field textarea,
.tourmaster-form-field select,
.tourmaster-form-field.tourmaster-with-border input[type="text"],
.tourmaster-form-field.tourmaster-with-border input[type="email"],
.tourmaster-form-field.tourmaster-with-border input[type="password"],
.tourmaster-form-field.tourmaster-with-border textarea,
.tourmaster-form-field.tourmaster-with-border select {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

CSS;
		}

		if (isset($css['colors']) && isset($args['colors'])) {
			$colors = $args['colors'];
			$css['colors'] .= <<<CSS
/* Tours list */
.tourmaster-template-search .tourmaster-template-wrapper,
.tourmaster-template-archive .tourmaster-template-wrapper {
	background-color: {$colors['alter_bg_color']};
	color: {$colors['alter_text']};
}
.tourmaster-tour-full .tourmaster-content-right {
	border-color: {$colors['alter_text']};
}

/* Message */
#tourmaster-urgency-message {
	background-color: {$colors['extra_bg_color']};
	color: {$colors['extra_dark']};
}
#tourmaster-urgency-message i {
	color: {$colors['extra_dark']};
}

/* Calendar */
.tourmaster-body .ui-datepicker table thead tr th {
	color: {$colors['extra_dark']};
	background-color: {$colors['extra_bg_color']};
}
.tourmaster-body .ui-datepicker table tbody tr td {
	border-color: {$colors['alter_bd_color']};
}
.tourmaster-body .ui-datepicker table tbody tr:nth-child(2n) td {
	background-color: {$colors['alter_bg_color']};
}
.tourmaster-body .ui-datepicker table tbody tr:nth-child(2n+1) td {
	background-color: {$colors['alter_bg_hover']};
}

/* Widget: Tour - Category */
.tourmaster-tour-category-widget .tourmaster-tour-category-head .tourmaster-tour-category-title a:hover {
	color: {$colors['alter_hover']};
}

/* Widget: Tour */
.tourmaster-tour-widget .tourmaster-tour-widget-inner {
	border-color: {$colors['alter_bd_color']};
}

/* Widget: Tour Search */
.tourmaster-tour-search-wrap .tourmaster-tour-search-title {
	color: {$colors['alter_dark']};
}
CSS;
		}
		
		return $css;
	}
}
?>