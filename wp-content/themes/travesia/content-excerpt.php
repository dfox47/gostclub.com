<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_post_format = get_post_format();
$travesia_post_format = empty($travesia_post_format) ? 'standard' : str_replace('post-format-', '', $travesia_post_format);
$travesia_animation = travesia_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($travesia_post_format) ); ?>
	<?php echo (!travesia_is_off($travesia_animation) ? ' data-animation="'.esc_attr(travesia_get_animation_classes($travesia_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	travesia_show_post_featured(array( 'thumb_size' => travesia_get_thumb_size( strpos(travesia_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('travesia_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			do_action('travesia_action_before_post_meta'); 

			// Post meta
			$travesia_components = travesia_is_inherit(travesia_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date,counters,edit'
										: travesia_array_get_keys_by_value(travesia_get_theme_option('meta_parts'));
			$travesia_counters = travesia_is_inherit(travesia_get_theme_option_from_meta('counters')) 
										? 'views,likes,comments'
										: travesia_array_get_keys_by_value(travesia_get_theme_option('counters'));

			if (!empty($travesia_components))
				travesia_show_post_meta(apply_filters('travesia_filter_post_meta_args', array(
					'components' => $travesia_components,
					'counters' => $travesia_counters,
					'seo' => false
					), 'excerpt', 1)
				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (travesia_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'travesia' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'travesia' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$travesia_show_learn_more = !in_array($travesia_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($travesia_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($travesia_post_format == 'quote') {
					if (($quote = travesia_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						travesia_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $travesia_show_learn_more ) {
				?><p><a class="more-link sc_button color_style_link2 sc_button_default" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'travesia'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>