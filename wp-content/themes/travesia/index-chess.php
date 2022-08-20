<?php
/**
 * The template for homepage posts with "Chess" style
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

travesia_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	travesia_show_layout(get_query_var('blog_archive_start'));

	$travesia_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$travesia_sticky_out = travesia_get_theme_option('sticky_style')=='columns' 
							&& is_array($travesia_stickies) && count($travesia_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($travesia_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$travesia_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($travesia_sticky_out && !is_sticky()) {
			$travesia_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $travesia_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	travesia_show_pagination();

	travesia_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>