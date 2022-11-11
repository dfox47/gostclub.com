<?php get_header(); ?>

<main data-tmp="category.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<h1><?php single_cat_title(); ?></h1>
				<?//php echo do_shortcode('[caf_filter id="3345"]'); ?>
				<?php // posts
				if (have_posts()) { ?>
					<ul class="cat_items_list js-news-list">
						<?php // The Loop
						while (have_posts()) : the_post(); ?>
							<?php // thumb img url
							$thumbUrl = '';

							if (get_the_post_thumbnail_url()) {
								// remove everything before /wp-content/
								$thumbUrl = strstr(get_the_post_thumbnail_url(), '/wp-content/');
							} ?>

							<li class="cat_items_list__item">
								<a class="cat_item_link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
									<span class="cat_item_link__img" style="background-image: url(<?php echo $thumbUrl; ?>)"></span>
									<span class="cat_item_link__title"><?php the_title(); ?></span>
								</a>
							</li>
						<?php endwhile; ?>
					</ul>

					<?php // Load more
					global $wp_query;

					$total_pages    = $wp_query -> max_num_pages;
					$paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;

					if ($paged !== $total_pages) { ?>
						<div class="pagination_wrap js-pagination-more">
							<?php next_posts_link( 'Загрузить ещё' ); ?>
						</div>
					<?php } ?>

					<div class="pagination_result js-pagination-result"></div>
				<?php } ?>

				<div class="mobile_show">
					<?php // aside
					include "template-parts/cat_list_1.php"; ?>
				</div>
			</div>

			<?php // aside
			include "template-parts/aside.php"; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>