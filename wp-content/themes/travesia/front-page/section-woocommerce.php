<div class="front_page_section front_page_section_woocommerce<?php
			$travesia_scheme = travesia_get_theme_option('front_page_woocommerce_scheme');
			if (!travesia_is_inherit($travesia_scheme)) echo ' scheme_'.esc_attr($travesia_scheme);
			echo ' front_page_section_paddings_'.esc_attr(travesia_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$travesia_css = '';
		$travesia_bg_image = travesia_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($travesia_bg_image)) 
			$travesia_css .= 'background-image: url('.esc_url(travesia_get_attachment_url($travesia_bg_image)).');';
		if (!empty($travesia_css))
			echo ' style="' . esc_attr($travesia_css) . '"';
?>><?php
	// Add anchor
	$travesia_anchor_icon = travesia_get_theme_option('front_page_woocommerce_anchor_icon');	
	$travesia_anchor_text = travesia_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($travesia_anchor_icon) || !empty($travesia_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($travesia_anchor_icon) ? ' icon="'.esc_attr($travesia_anchor_icon).'"' : '')
										. (!empty($travesia_anchor_text) ? ' title="'.esc_attr($travesia_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (travesia_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' travesia-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$travesia_css = '';
			$travesia_bg_mask = travesia_get_theme_option('front_page_woocommerce_bg_mask');
			$travesia_bg_color = travesia_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($travesia_bg_color) && $travesia_bg_mask > 0)
				$travesia_css .= 'background-color: '.esc_attr($travesia_bg_mask==1
																	? $travesia_bg_color
																	: travesia_hex2rgba($travesia_bg_color, $travesia_bg_mask)
																).';';
			if (!empty($travesia_css))
				echo ' style="' . esc_attr($travesia_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$travesia_caption = travesia_get_theme_option('front_page_woocommerce_caption');
			$travesia_description = travesia_get_theme_option('front_page_woocommerce_description');
			if (!empty($travesia_caption) || !empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($travesia_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($travesia_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($travesia_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($travesia_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($travesia_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($travesia_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$travesia_woocommerce_sc = travesia_get_theme_option('front_page_woocommerce_products');
				if ($travesia_woocommerce_sc == 'products') {
					$travesia_woocommerce_sc_ids = travesia_get_theme_option('front_page_woocommerce_products_per_page');
					$travesia_woocommerce_sc_per_page = count(explode(',', $travesia_woocommerce_sc_ids));
				} else {
					$travesia_woocommerce_sc_per_page = max(1, (int) travesia_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$travesia_woocommerce_sc_columns = max(1, min($travesia_woocommerce_sc_per_page, (int) travesia_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$travesia_woocommerce_sc}"
									. ($travesia_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($travesia_woocommerce_sc_ids).'"' 
											: '')
									. ($travesia_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(travesia_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($travesia_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(travesia_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(travesia_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($travesia_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($travesia_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>