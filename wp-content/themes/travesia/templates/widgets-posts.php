<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_post_id    = get_the_ID();
$travesia_post_date  = travesia_get_date();
$travesia_post_title = get_the_title();
$travesia_post_link  = get_permalink();
$travesia_post_author_id   = get_the_author_meta('ID');
$travesia_post_author_name = get_the_author_meta('display_name');
$travesia_post_author_url  = get_author_posts_url($travesia_post_author_id, '');

$travesia_args = get_query_var('travesia_args_widgets_posts');
$travesia_show_date = isset($travesia_args['show_date']) ? (int) $travesia_args['show_date'] : 1;
$travesia_show_image = isset($travesia_args['show_image']) ? (int) $travesia_args['show_image'] : 1;
$travesia_show_author = isset($travesia_args['show_author']) ? (int) $travesia_args['show_author'] : 1;
$travesia_show_counters = isset($travesia_args['show_counters']) ? (int) $travesia_args['show_counters'] : 1;
$travesia_show_categories = isset($travesia_args['show_categories']) ? (int) $travesia_args['show_categories'] : 1;

$travesia_output = travesia_storage_get('travesia_output_widgets_posts');

$travesia_post_counters_output = '';
if ( $travesia_show_counters ) {
	$travesia_post_counters_output = '<span class="post_info_item post_info_counters">'
								. travesia_get_post_counters('comments')
							. '</span>';
}


$travesia_output .= '<article class="post_item with_thumb">';

if ($travesia_show_image) {
	$travesia_post_thumb = get_the_post_thumbnail($travesia_post_id, travesia_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($travesia_post_thumb) $travesia_output .= '<div class="post_thumb">' . ($travesia_post_link ? '<a href="' . esc_url($travesia_post_link) . '">' : '') . ($travesia_post_thumb) . ($travesia_post_link ? '</a>' : '') . '</div>';
}

$travesia_output .= '<div class="post_content">'
			. ($travesia_show_categories 
					? '<div class="post_categories">'
						. travesia_get_post_categories()
						. $travesia_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($travesia_post_link ? '<a href="' . esc_url($travesia_post_link) . '">' : '') . ($travesia_post_title) . ($travesia_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('travesia_filter_get_post_info', 
								'<div class="post_info">'
									. ($travesia_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($travesia_post_link ? '<a href="' . esc_url($travesia_post_link) . '" class="post_info_date">' : '') 
											. esc_html($travesia_post_date) 
											. ($travesia_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($travesia_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'travesia') . ' ' 
											. ($travesia_post_link ? '<a href="' . esc_url($travesia_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($travesia_post_author_name) 
											. ($travesia_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$travesia_show_categories && $travesia_post_counters_output
										? $travesia_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
travesia_storage_set('travesia_output_widgets_posts', $travesia_output);
?>