
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
} ?>

<main class="content_wrap" data-tmp="single-post.php">
	<div class="wrap">
		<div class="content">
			<div class="content_main">
				<article>
					<?php if (is_single() && $thumbUrl !== '') { ?>
						<img class="thumb_img" src="<?php echo $thumbUrl; ?>" alt="" />
					<?php } ?>

					<h1><?php single_post_title(); ?></h1>

					<?php // content
					the_content(); ?>

					<?php // posts
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
						}
					} ?>
				</article>
			</div>

			<?php // aside
			include "template-parts/aside.php"; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>
