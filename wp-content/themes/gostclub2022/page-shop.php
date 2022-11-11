<?php /*
* Template Name: Shop
* Template Post Type: post, page, product
*/ ?>

<?php get_header(); ?>

<?php // echo do_shortcode("[woof_products per_page=8 columns=3 is_ajax=0 taxonomies=product_cat:9 custom_tpl='woof_tpls/woo_tpl_1.php']"); ?>

	<main class="main_content_wrap">
		<div class="main_content">
			<div class="wrap2">
				<?php if (single_post_title()) { ?>
					<h1><?php single_post_title(); ?></h1>
				<?php } ?>

				<?php // content
				the_content(); ?>

				<?php // posts
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
					}
				} ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>