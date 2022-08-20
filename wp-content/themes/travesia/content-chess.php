<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

$travesia_blog_style = explode('_', travesia_get_theme_option('blog_style'));
$travesia_columns = empty($travesia_blog_style[1]) ? 1 : max(1, $travesia_blog_style[1]);
$travesia_expanded = !travesia_sidebar_present() && travesia_is_on(travesia_get_theme_option('expand_content'));
$travesia_post_format = get_post_format();
$travesia_post_format = empty($travesia_post_format) ? 'standard' : str_replace('post-format-', '', $travesia_post_format);
$travesia_animation = travesia_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($travesia_columns).' post_format_'.esc_attr($travesia_post_format) ); ?>
	<?php echo (!travesia_is_off($travesia_animation) ? ' data-animation="'.esc_attr(travesia_get_animation_classes($travesia_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($travesia_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	travesia_show_post_featured( array(
											'class' => $travesia_columns == 1 ? 'travesia-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => travesia_get_thumb_size(
																	strpos(travesia_get_theme_option('body_style'), 'full')!==false
																		? ( $travesia_columns > 1 ? 'huge' : 'original' )
																		: (	$travesia_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('travesia_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('travesia_action_before_post_meta'); 

			// Post meta
			$travesia_components = travesia_is_inherit(travesia_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($travesia_columns < 3 ? ',counters' : '').($travesia_columns == 1 ? ',edit' : '')
										: travesia_array_get_keys_by_value(travesia_get_theme_option('meta_parts'));
			$travesia_counters = travesia_is_inherit(travesia_get_theme_option_from_meta('counters')) 
										? 'comments'
										: travesia_array_get_keys_by_value(travesia_get_theme_option('counters'));
			$travesia_post_meta = empty($travesia_components) 
										? '' 
										: travesia_show_post_meta(apply_filters('travesia_filter_post_meta_args', array(
												'components' => $travesia_components,
												'counters' => $travesia_counters,
												'seo' => false,
												'echo' => false
												), $travesia_blog_style[0], $travesia_columns)
											);
			travesia_show_layout($travesia_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$travesia_show_learn_more = !in_array($travesia_post_format, array('link', 'aside', 'status', 'quote'));
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
				?>
			</div>
			<?php
			// Post meta
			if (in_array($travesia_post_format, array('link', 'aside', 'status', 'quote'))) {
				travesia_show_layout($travesia_post_meta);
			}
			// More button
			if ( $travesia_show_learn_more ) {
				?><p><a class="more-link sc_button color_style_link2 sc_button_default" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'travesia'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>