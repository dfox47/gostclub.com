<?php // widgets
function registerMyWidgets() {
	// after_header
	register_sidebar(array(
		'after_title'       => '</h4>',
		'after_widget'      => '',
		'before_title'      => '<h4>',
		'before_widget'     => '',
		'id'                => 'after_header',
		'name'              => 'After header'
	));

	// footer
	register_sidebar(array(
		'after_title'       => '</h4>',
		'after_widget'      => '',
		'before_title'      => '<h4>',
		'before_widget'     => '',
		'id'                => 'footer',
		'name'              => 'Footer'
	));

	// woocommerce_filter
	register_sidebar(array(
		'after_title'       => '</h4>',
		'after_widget'      => '',
		'before_title'      => '<h4>',
		'before_widget'     => '',
		'id'                => 'woocommerce_filter',
		'name'              => 'Woocommerce filter'
	));
}

add_action('widgets_init', 'registerMyWidgets'); ?>