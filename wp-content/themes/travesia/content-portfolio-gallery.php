<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_blog_style = explode('_', travesia_get_theme_option('blog_style'));
$travesia_columns = empty($travesia_blog_style[1]) ? 2 : max(2, $travesia_blog_style[1]);
$travesia_post_format = get_post_format();
$travesia_post_format = empty($travesia_post_format) ? 'standard' : str_replace('post-format-', '', $travesia_post_format);
$travesia_animation = travesia_get_theme_option('blog_animation');
$travesia_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($travesia_columns).' post_format_'.esc_attr($travesia_post_format) ); ?>
	<?php echo (!travesia_is_off($travesia_animation) ? ' data-animation="'.esc_attr(travesia_get_animation_classes($travesia_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($travesia_image[1]) && !empty($travesia_image[2])) echo intval($travesia_image[1]) .'x' . intval($travesia_image[2]); ?>"
	data-src="<?php if (!empty($travesia_image[0])) echo esc_url($travesia_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$travesia_image_hover = 'icon';
	if (in_array($travesia_image_hover, array('icons', 'zoom'))) $travesia_image_hover = 'dots';
	$travesia_components = travesia_is_inherit(travesia_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: travesia_array_get_keys_by_value(travesia_get_theme_option('meta_parts'));
	$travesia_counters = travesia_is_inherit(travesia_get_theme_option_from_meta('counters')) 
								? 'comments'
								: travesia_array_get_keys_by_value(travesia_get_theme_option('counters'));
	travesia_show_post_featured(array(
		'hover' => $travesia_image_hover,
		'thumb_size' => travesia_get_thumb_size( strpos(travesia_get_theme_option('body_style'), 'full')!==false || $travesia_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($travesia_components)
										? travesia_show_post_meta(apply_filters('travesia_filter_post_meta_args', array(
											'components' => $travesia_components,
											'counters' => $travesia_counters,
											'seo' => false,
											'echo' => false
											), $travesia_blog_style[0], $travesia_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'travesia') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>