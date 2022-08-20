<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$travesia_post_format = get_post_format();
$travesia_post_format = empty($travesia_post_format) ? 'standard' : str_replace('post-format-', '', $travesia_post_format);
$travesia_animation = travesia_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($travesia_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($travesia_post_format) ); ?>
	<?php echo (!travesia_is_off($travesia_animation) ? ' data-animation="'.esc_attr(travesia_get_animation_classes($travesia_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	travesia_show_post_featured(array(
		'thumb_size' => travesia_get_thumb_size($travesia_columns==1 ? 'big' : ($travesia_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($travesia_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			travesia_show_post_meta(apply_filters('travesia_filter_post_meta_args', array(), 'sticky', $travesia_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>