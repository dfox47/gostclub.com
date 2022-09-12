
<?php get_header(); ?>

<main data-tmp="category.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<?php get_breadcrumbs(); ?>

				<h1><?php single_cat_title(); ?></h1>

				<?php // posts
				if (have_posts()) { ?>
					<ul class="cat_items_list js-news-list">
						<?php // The Loop
						while (have_posts()) : the_post(); ?>
							<?php // thumb img url
							$thumbUrl = '';

							if (get_the_post_thumbnail_url()) {
								$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
							} ?>

							<li class="cat_items_list__item">
								<a class="cat_items_list__link" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" style="background-image: url(<?php echo $thumbUrl; ?>)"></a>
							</li>
						<?php endwhile; ?>
					</ul>

					<?php // Загрузить ещё
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
			</div>

			<?php // aside
			include "template-parts/aside.php"; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
