<?php
/**
 * The style "Classic" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php

	// Post content
	?><div
	<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
		>

	<?php

	trx_addons_get_template_part('templates/tpl.featured.php',
		'trx_addons_args_featured',
		apply_filters('trx_addons_filter_args_featured', array(
			'post_info' => '<div class="post_info">'
				. '<h3 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">'.get_the_title().'</a></h3>'
				. '<span class="post_exerpt">'.wp_trim_words( get_the_content(), 5, ' ...' ).'</span>'
				. '</div>',
			'thumb_bg' => true,
			'thumb_size' => trx_addons_get_thumb_size('huge')
		),
			'sc_blogger_announce')
	);
	?>
		</div>
	
</div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>