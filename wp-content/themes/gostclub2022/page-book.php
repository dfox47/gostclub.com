<?php /*
* Template Name: Book
* Template Post Type: post, page, product
*/ ?>

<?php //header
get_header(); ?>

	<div id="book_wrap" class="book wrap2">
		<?php // content
		the_content();

		// posts
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
			}
		} ?>
	</div>

<?php // footer
get_footer(); ?>