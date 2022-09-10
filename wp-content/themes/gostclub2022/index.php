
<?php get_header(); ?>

<main class="site-main" data-tmp="index.php">
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
</main>

<?php get_footer(); ?>
