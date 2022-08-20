<div class="front_page_section front_page_section_testimonials<?php
			$travesia_scheme = travesia_get_theme_option('front_page_testimonials_scheme');
			if (!travesia_is_inherit($travesia_scheme)) echo ' scheme_'.esc_attr($travesia_scheme);
			echo ' front_page_section_paddings_'.esc_attr(travesia_get_theme_option('front_page_testimonials_paddings'));
		?>"<?php
		$travesia_css = '';
		$travesia_bg_image = travesia_get_theme_option('front_page_testimonials_bg_image');
		if (!empty($travesia_bg_image)) 
			$travesia_css .= 'background-image: url('.esc_url(travesia_get_attachment_url($travesia_bg_image)).');';
		if (!empty($travesia_css))
			echo ' style="' . esc_attr($travesia_css) . '"';
?>><?php
	// Add anchor
	$travesia_anchor_icon = travesia_get_theme_option('front_page_testimonials_anchor_icon');	
	$travesia_anchor_text = travesia_get_theme_option('front_page_testimonials_anchor_text');	
	if ((!empty($travesia_anchor_icon) || !empty($travesia_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_testimonials"'
										. (!empty($travesia_anchor_icon) ? ' icon="'.esc_attr($travesia_anchor_icon).'"' : '')
										. (!empty($travesia_anchor_text) ? ' title="'.esc_attr($travesia_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_testimonials_inner<?php
			if (travesia_get_theme_option('front_page_testimonials_fullheight'))
				echo ' travesia-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$travesia_css = '';
			$travesia_bg_mask = travesia_get_theme_option('front_page_testimonials_bg_mask');
			$travesia_bg_color = travesia_get_theme_option('front_page_testimonials_bg_color');
			if (!empty($travesia_bg_color) && $travesia_bg_mask > 0)
				$travesia_css .= 'background-color: '.esc_attr($travesia_bg_mask==1
																	? $travesia_bg_color
																	: travesia_hex2rgba($travesia_bg_color, $travesia_bg_mask)
																).';';
			if (!empty($travesia_css))
				echo ' style="' . esc_attr($travesia_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_testimonials_content_wrap content_wrap">
			<?php
			// Caption
			$travesia_caption = travesia_get_theme_option('front_page_testimonials_caption');
			if (!empty($travesia_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_testimonials_caption front_page_block_<?php echo !empty($travesia_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($travesia_caption); ?></h2><?php
			}
		
			// Description (text)
			$travesia_description = travesia_get_theme_option('front_page_testimonials_description');
			if (!empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_testimonials_description front_page_block_<?php echo !empty($travesia_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($travesia_description)); ?></div><?php
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_testimonials_output"><?php 
				if (is_active_sidebar('front_page_testimonials_widgets')) {
					dynamic_sidebar( 'front_page_testimonials_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!travesia_exists_trx_addons())
						travesia_customizer_need_trx_addons_message();
					else
						travesia_customizer_need_widgets_message('front_page_testimonials_caption', 'ThemeREX Addons - Testimonials');
				}
			?></div>
		</div>
	</div>
</div>