
<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php get_header(); ?>

<?php if (!is_front_page()) { ?>
	<main class="main_content_wrap">
		<div class="main_content">
			<?php if ($currentUrl == '/o-kompanii/') {}
			else { ?>
				<div class="wrap2">
			<?php } ?>
				<?php // hide h1 at page About
				if ($currentUrl == '/o-kompanii/') {}
				// hide h1 at page news
				elseif ($currentUrl == '/novosti/') {}
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
			<?php if ($currentUrl == '/o-kompanii/') {}
			else { ?>
				</div>
			<?php } ?>
		</div>
	</main>
<?php } ?>

<?php get_footer(); ?>
