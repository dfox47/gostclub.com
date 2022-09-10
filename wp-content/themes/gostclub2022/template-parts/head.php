
<?php // thumb img url
$thumbUrl = '';

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
}

$currentUrl = $_SERVER['REQUEST_URI']; ?>

<div class="header_wrap">
	<div class="wrap">
		<div class="header">
			<a href="javascript:void(0);">Sign in</a>

			<a class="header_logo" href="/">GOST</a>

			<div class="header_right">
				<span class="header_search_icon js-search-toggle"></span>

				<?php // lang switcher
				include "lang_switch.php"; ?>
			</div>
		</div>

		<div class="hidden">
			<?php // countries_menu
			wp_nav_menu(array(
				'container'         => false,
				'depth'             => 0,
				'item_spacing'      => 'preserve',
				'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
				'menu'              => 'countries_menu',
				'menu_class'        => 'countries_menu',
				'theme_location'    => 'countries_menu'
			)); ?>
		</div>

		<ul class="countries_list">
			<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Bulgaria</a></li>
			<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Greece</a></li>
			<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">North Macedonia</a></li>
			<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Turkey</a></li>
		</ul>
	</div>
</div>

<?php if (is_front_page()) { ?>
	<div class="hero_slider">
		<div class="js-owl-carousel-auto owl-carousel">
			<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/1.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/2.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/3.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/5.jpg);"></div>
		</div>
	</div>
<?php } ?>
