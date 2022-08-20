<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );

	// Previous/next post navigation.
	?><div class="nav-links-single"><?php
		the_post_navigation( array(
			'next_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'travesia' ) . '</span> '
				. '<span class="post_prev">'.esc_html__( 'Prev post', 'travesia' ).'</span>'
				. '<h6 class="post-title">%title</h6>',
			'prev_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'travesia' ) . '</span> '
				. '<span class="post_next">'.esc_html__( 'Next Post', 'travesia' ).'</span>'
				. '<h6 class="post-title">%title</h6>'
		) );
	?></div><?php

	// Related posts
	if ((int) travesia_get_theme_option('show_related_posts') && ($travesia_related_posts = (int) travesia_get_theme_option('related_posts')) > 0) {
		travesia_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, $travesia_related_posts)),
										'columns' => max(1, min(4, travesia_get_theme_option('related_columns')))
										),
									travesia_get_theme_option('related_style')
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>