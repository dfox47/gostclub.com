
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
} ?>

<main class="main_content_wrap">
	<div class="main_content">
		<div class="wrap2">
			<?php if (is_single() && $thumbUrl !== '') { ?>
				<img class="thumb_img" src="<?php echo $thumbUrl; ?>" alt="" />
			<?php } ?>

			<?php
			// hide h1 at page About
			if ($currentUrl == '/o-kompanii/') {}
			else { ?>
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
