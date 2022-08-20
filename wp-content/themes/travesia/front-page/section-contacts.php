<div class="front_page_section front_page_section_contacts<?php
			$travesia_scheme = travesia_get_theme_option('front_page_contacts_scheme');
			if (!travesia_is_inherit($travesia_scheme)) echo ' scheme_'.esc_attr($travesia_scheme);
			echo ' front_page_section_paddings_'.esc_attr(travesia_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$travesia_css = '';
		$travesia_bg_image = travesia_get_theme_option('front_page_contacts_bg_image');
		if (!empty($travesia_bg_image)) 
			$travesia_css .= 'background-image: url('.esc_url(travesia_get_attachment_url($travesia_bg_image)).');';
		if (!empty($travesia_css))
			echo ' style="' . esc_attr($travesia_css) . '"';
?>><?php
	// Add anchor
	$travesia_anchor_icon = travesia_get_theme_option('front_page_contacts_anchor_icon');	
	$travesia_anchor_text = travesia_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($travesia_anchor_icon) || !empty($travesia_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($travesia_anchor_icon) ? ' icon="'.esc_attr($travesia_anchor_icon).'"' : '')
										. (!empty($travesia_anchor_text) ? ' title="'.esc_attr($travesia_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (travesia_get_theme_option('front_page_contacts_fullheight'))
				echo ' travesia-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$travesia_css = '';
			$travesia_bg_mask = travesia_get_theme_option('front_page_contacts_bg_mask');
			$travesia_bg_color = travesia_get_theme_option('front_page_contacts_bg_color');
			if (!empty($travesia_bg_color) && $travesia_bg_mask > 0)
				$travesia_css .= 'background-color: '.esc_attr($travesia_bg_mask==1
																	? $travesia_bg_color
																	: travesia_hex2rgba($travesia_bg_color, $travesia_bg_mask)
																).';';
			if (!empty($travesia_css))
				echo ' style="' . esc_attr($travesia_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$travesia_caption = travesia_get_theme_option('front_page_contacts_caption');
			$travesia_description = travesia_get_theme_option('front_page_contacts_description');
			if (!empty($travesia_caption) || !empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($travesia_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($travesia_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($travesia_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($travesia_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($travesia_description));
					?></div><?php
				}
			}

			// Content (text)
			$travesia_content = travesia_get_theme_option('front_page_contacts_content');
			$travesia_layout = travesia_get_theme_option('front_page_contacts_layout');
			if ($travesia_layout == 'columns' && (!empty($travesia_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($travesia_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($travesia_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($travesia_content);
				?></div><?php
			}

			if ($travesia_layout == 'columns' && (!empty($travesia_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$travesia_sc = travesia_get_theme_option('front_page_contacts_shortcode');
			if (!empty($travesia_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($travesia_sc) ? 'filled' : 'empty'; ?>"><?php
					travesia_show_layout(do_shortcode($travesia_sc));
				?></div><?php
			}

			if ($travesia_layout == 'columns' && (!empty($travesia_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>