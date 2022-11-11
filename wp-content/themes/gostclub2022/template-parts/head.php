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
					'depth'             => 1,
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
			<div class="hero_slider__item" style="background-image: url(<?php echo $heroImg; ?>/8.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(<?php echo $heroImg; ?>/2.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(<?php echo $heroImg; ?>/5.jpg);"></div>
			<div class="hero_slider__item" style="background-image: url(<?php echo $heroImg; ?>/6.jpg);"></div>
		</div>
	</div>
<?php }
else {
	// category page | slider from description
	if (is_category()) {
		the_archive_description('<div class="hidden js-category-desc">', '</div>');
	}
} ?>

<?php // countries menu || 2d level
if (has_nav_menu('countries')) { ?>
	<div class="countries_submenu_wrap">
		<div class="text-center">
			<a class="countries_submenu_choose js-countries-submenu-toggle" href="javascript:void(0);">
				<span class="lang_bg_only">Изберете град</span>
				<span class="lang_en_only">Choose a city</span>
				<span class="lang_ru_only">Выберите город</span>
			</a>
		</div>

		<?php wp_nav_menu(array(
			'container'         => false,
			'depth'             => 2,
			'item_spacing'      => 'preserve',
			'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
			'menu'              => 'countries',
			'menu_class'        => 'countries_submenu js-countries-submenu',
			'theme_location'    => 'countries'
		)); ?>
	</div>
<?php } ?>

<?php // breadcrumbs
if (!is_front_page() && function_exists('breadcrumbs')) breadcrumbs(); ?>