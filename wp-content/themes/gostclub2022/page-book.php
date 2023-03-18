<?php /*
* Template Name: Book
* Template Post Type: post, page, product
*/ ?>

<?php //header
get_header(); ?>

	<div id="book_wrap" class="wrap2">
		<?php // content
		the_content();

		// posts
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
			}
		} ?>

		<ul class="book_nav">
			<li class="book_nav__item">
				<a class="book_nav__link book_nav__link--prev js-book-prev" href="javascript:void(0);"></a>
			</li>

			<li>
				<a class="book_nav__link book_nav__link--next js-book-next" href="javascript:void(0);"></a>
			</li>
		</ul>
	</div>

<?php // footer
get_footer(); ?>