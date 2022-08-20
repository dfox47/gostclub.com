<div class="front_page_section front_page_section_subscribe<?php
			$travesia_scheme = travesia_get_theme_option('front_page_subscribe_scheme');
			if (!travesia_is_inherit($travesia_scheme)) echo ' scheme_'.esc_attr($travesia_scheme);
			echo ' front_page_section_paddings_'.esc_attr(travesia_get_theme_option('front_page_subscribe_paddings'));
		?>"<?php
		$travesia_css = '';
		$travesia_bg_image = travesia_get_theme_option('front_page_subscribe_bg_image');
		if (!empty($travesia_bg_image)) 
			$travesia_css .= 'background-image: url('.esc_url(travesia_get_attachment_url($travesia_bg_image)).');';
		if (!empty($travesia_css))
			echo ' style="' . esc_attr($travesia_css) . '"';
?>><?php
	// Add anchor
	$travesia_anchor_icon = travesia_get_theme_option('front_page_subscribe_anchor_icon');	
	$travesia_anchor_text = travesia_get_theme_option('front_page_subscribe_anchor_text');	
	if ((!empty($travesia_anchor_icon) || !empty($travesia_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_subscribe"'
										. (!empty($travesia_anchor_icon) ? ' icon="'.esc_attr($travesia_anchor_icon).'"' : '')
										. (!empty($travesia_anchor_text) ? ' title="'.esc_attr($travesia_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_subscribe_inner<?php
			if (travesia_get_theme_option('front_page_subscribe_fullheight'))
				echo ' travesia-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$travesia_css = '';
			$travesia_bg_mask = travesia_get_theme_option('front_page_subscribe_bg_mask');
			$travesia_bg_color = travesia_get_theme_option('front_page_subscribe_bg_color');
			if (!empty($travesia_bg_color) && $travesia_bg_mask > 0)
				$travesia_css .= 'background-color: '.esc_attr($travesia_bg_mask==1
																	? $travesia_bg_color
																	: travesia_hex2rgba($travesia_bg_color, $travesia_bg_mask)
																).';';
			if (!empty($travesia_css))
				echo ' style="' . esc_attr($travesia_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$travesia_caption = travesia_get_theme_option('front_page_subscribe_caption');
			if (!empty($travesia_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo !empty($travesia_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($travesia_caption); ?></h2><?php
			}
		
			// Description (text)
			$travesia_description = travesia_get_theme_option('front_page_subscribe_description');
			if (!empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo !empty($travesia_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($travesia_description)); ?></div><?php
			}
			
			// Content
			$travesia_sc = travesia_get_theme_option('front_page_subscribe_shortcode');
			if (!empty($travesia_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo !empty($travesia_sc) ? 'filled' : 'empty'; ?>"><?php
					travesia_show_layout(do_shortcode($travesia_sc));
				?></div><?php
			}
			?>
		</div>
	</div>
</div>