<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<main data-tmp="page.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<div class="mobile_show">
					<?php // aside
					include "template-parts/cat_list_1.php"; ?>
				</div>

				<?php // content
				the_content(); ?>

				<?php // posts
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
					}
				} ?>
			</div>

			<?php // aside
			include "template-parts/aside.php"; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>