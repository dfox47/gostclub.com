
<?php get_header(); ?>

<main data-tmp="index.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<?php // content
				the_content(); ?>

				<?php // posts
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
					}
				}
				else { ?>
					<div class="hidden">empty</div>
				<?php } ?>
			</div>

			<?php // aside
			include "template-parts/aside.php"; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
