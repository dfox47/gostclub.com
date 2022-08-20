<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('travesia_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'travesia_revslider_theme_setup9', 9 );
	function travesia_revslider_theme_setup9() {
		if (travesia_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'travesia_revslider_frontend_scripts', 1100 );
			add_filter( 'travesia_filter_merge_styles',			'travesia_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'travesia_filter_tgmpa_required_plugins','travesia_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'travesia_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('travesia_filter_tgmpa_required_plugins',	'travesia_revslider_tgmpa_required_plugins');
	function travesia_revslider_tgmpa_required_plugins($list=array()) {
		if (travesia_storage_isset('required_plugins', 'revslider')) {
			$path = travesia_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || travesia_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> travesia_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
                    'version'	=> '6.0.8',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'travesia_exists_revslider' ) ) {
	function travesia_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'travesia_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'travesia_revslider_frontend_scripts', 1100 );
	function travesia_revslider_frontend_scripts() {
		if (travesia_is_on(travesia_get_theme_option('debug_mode')) && travesia_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'travesia-revslider',  travesia_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'travesia_revslider_merge_styles' ) ) {
	//Handler of the add_filter('travesia_filter_merge_styles', 'travesia_revslider_merge_styles');
	function travesia_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>