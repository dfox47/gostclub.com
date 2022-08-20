<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($travesia_columns).' post_format_'.esc_attr($travesia_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!travesia_is_off($travesia_animation) ? ' data-animation="'.esc_attr(travesia_get_animation_classes($travesia_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$travesia_image_hover = travesia_get_theme_option('image_hover');
	// Featured image
	travesia_show_post_featured(array(
		'thumb_size' => travesia_get_thumb_size(strpos(travesia_get_theme_option('body_style'), 'full')!==false || $travesia_columns < 3 
								? 'big'
								: 'huge'),
		'show_no_image' => true,
		'class' => $travesia_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $travesia_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>