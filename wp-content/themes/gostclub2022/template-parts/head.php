<?php // thumb img url
$thumbUrl = "";

if (get_the_post_thumbnail_url()) {
	$thumbUrl = str_replace('https://' . $_SERVER['SERVER_NAME'], '', get_the_post_thumbnail_url());
}

$currentLang    = get_bloginfo("language");
$currentUrl     = $_SERVER['REQUEST_URI'];
$logoLink       = '/';

if ($currentLang == 'en-US') {
	$logoLink = '/en/';
}
elseif ($currentLang == 'ru-RU') {
	$logoLink = '/ru/';
} ?>

	<div class="header_wrap">
		<div class="wrap">
			<div class="header">
				<a class="mobile_menu_toggle js-mobile-menu-toggle" href="javascript:void(0);"><span></span></a>

				<a class="header_login" href="javascript:void(0);"></a>

				<a class="header_logo" href="<?php echo $logoLink; ?>">GOST <span class="header_logo__country">Bulgaria</span></a>

				<div class="header_right">
					<span class="header_search_icon js-search-toggle"></span>

					<?php // lang switcher
					include "lang_switch.php"; ?>
				</div>
			</div>

			<?php // countries menu
			if (has_nav_menu('countries')) {
				wp_nav_menu(array(
					'container'         => false,
					'depth'             => 2,
					'item_spacing'      => 'preserve',
					'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
					'menu'              => 'countries',
					'menu_class'        => 'countries_menu js-countries-menu',
					'theme_location'    => 'countries'
				));
			} ?>
		</div>
	</div>

<?php // home page
if (is_front_page()) {
	$heroImg = '/wp-content/themes/gostclub2022/i/hero_slider'; ?>

	<div class="hero_slider">
		<div class="js-owl-carousel-auto owl-carousel">
			<a class="hero_slider__item js-img-bg" href="//tzarsimeon.bg/" target="_blank" data-src="<?php echo $heroImg; ?>/9.jpg"></a>
			<a class="hero_slider__item js-img-bg" href="//www.instagram.com/gostclub.balkans/" target="_blank" data-src="<?php echo $heroImg; ?>/8.jpg"></a>
			<div class="hero_slider__item js-img-bg" data-src="<?php echo $heroImg; ?>/2.jpg"></div>
			<div class="hero_slider__item js-img-bg" data-src="<?php echo $heroImg; ?>/5.jpg"></div>
			<div class="hero_slider__item js-img-bg" data-src="<?php echo $heroImg; ?>/6.jpg"></div>
		</div>
	</div>
<?php }
else {
	// category page | slider from description
	if (is_category()) {
		the_archive_description('<div class="hidden js-category-desc">', '</div>');
	}
} ?>

<?php // breadcrumbs
if (!is_front_page() && function_exists('breadcrumbs')) breadcrumbs(); ?>