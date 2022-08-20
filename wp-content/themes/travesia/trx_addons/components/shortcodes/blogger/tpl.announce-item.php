<?php
/**
 * The style "announce" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');


$a = get_query_var('global_'.$args['id']);
if( empty($a) ) {
	set_query_var('global_'.$args['id'], 1);
}
$a =  get_query_var('global_'.$args['id']);
if($a > 0) {
	set_query_var('global_'.$args['id'], $a+1);
}

$a =  get_query_var('global_'.$args['id']);



$type = $args['type'];
$number =  min(8, $a)-1;
$count = min(8, $args['count']);
$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');
$grid = array(
array('full'),
array('big', 'big'),
array('big', 'medium', 'medium'),
array('big', 'small', 'small', 'small'),
array('big', 'small', 'small', 'small', 'small'),
array('medium', 'medium', 'small', 'small', 'small', 'small'),
array('medium', 'small', 'small', 'small', 'small', 'small', 'small'),
array('small', 'small', 'small', 'small', 'small', 'small', 'small', 'small')
);


$thumb_size = $grid[$count-$number >= 8 ? 8 : ($count-1)%8][($number-1)%8];


?><article
<?php post_class( 'post_item post_layout_'.esc_attr($type)
	.' post_format_'.esc_attr($post_format)
	.' post_size_'.esc_attr($thumb_size)
); ?>
<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
>

<?php
if ( is_sticky() && is_home() && !is_paged() ) {
	?><span class="post_label label_sticky"></span><?php
}

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
</article>

<?php
$category_id = get_cat_ID( $args['cat'] );
$category_link = get_category_link( $args['cat']  );
if ($number == $count){
?>
	<article class="post_item  post_size_small button_article">
		<div class="button_article_desc">
			<a href="<?php echo(esc_url( $category_link ))?>" rel="bookmark"><?php esc_html_e('Our Hot Deals', 'travesia'); ?></a>
			<p class="desc_button_bloger_announce"><?php esc_html_e('Save Up to 50% on all trips', 'travesia'); ?></p>
		</div>
	</article>
	<?php
}
?>


