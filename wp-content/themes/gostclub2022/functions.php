<?php

// allow menus
add_theme_support('menus');

// title at head
add_theme_support('title-tag');

// remove class from li at menus
//add_filter('nav_menu_css_class', '__return_empty_array', 10, 3);

// remove ID's from li at menus
add_filter('nav_menu_item_id', '__return_null', 10, 3);

// header menu
function headerMenu() {
	register_nav_menu('header', 'Header menu');
}
add_action('after_setup_theme', 'headerMenu');

// footer menu
function footerMenu() {
	register_nav_menu('footer', 'Footer menu');
}
add_action('after_setup_theme', 'footerMenu');

// theme's custom options
include "template-parts/theme_options.php";

// widgets
include "template-parts/widgets.php";

// support woocommerce custom themes
function woocommerceThemeSupport() {
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'woocommerceThemeSupport');

function get_current_url() {
	global $wp;
	$old = 'http://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'], '?');

	$current_url = add_query_arg( '', '', home_url( $wp->request ) );
	return $current_url;
}

// change menu item name at admin
function edit_admin_menus() {
	global $menu, $submenu;

//	$menu[25][0] = 'Отзывы';
//	$menu[26][0] = 'Объекты';

//	$submenu['edit.php?post_type=product'][5][0] = 'Все объекты';
}
add_action('admin_menu', 'edit_admin_menus');
