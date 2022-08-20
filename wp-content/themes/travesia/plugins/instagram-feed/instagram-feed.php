<?php
/* Custom Feeds for Instagram support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('travesia_instagram_feed_theme_setup9')) {
	add_action( 'after_setup_theme', 'travesia_instagram_feed_theme_setup9', 9 );
	function travesia_instagram_feed_theme_setup9() {
		if (is_admin()) {
			add_filter( 'travesia_filter_tgmpa_required_plugins',		'travesia_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'travesia_instagram_feed_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('travesia_filter_tgmpa_required_plugins',	'travesia_instagram_feed_tgmpa_required_plugins');
	function travesia_instagram_feed_tgmpa_required_plugins($list=array()) {
		if (travesia_storage_isset('required_plugins', 'instagram-feed')) {
			$list[] = array(
					'name' 		=> travesia_storage_get_array('required_plugins', 'instagram-feed'),
					'slug' 		=> 'instagram-feed',
					'required' 	=> false
				);
		}
		return $list;
	}
}

// Check if Custom Feeds for Instagram installed and activated
if ( !function_exists( 'travesia_exists_instagram_feed' ) ) {
	function travesia_exists_instagram_feed() {
		return defined('SBIVER');
	}
}
?>