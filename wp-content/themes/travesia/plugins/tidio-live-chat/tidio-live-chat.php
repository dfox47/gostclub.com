<?php
/* Tidio support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('travesia_tidio_theme_setup9')) {
    add_action( 'after_setup_theme', 'travesia_tidio_theme_setup9', 9 );
    function travesia_tidio_theme_setup9() {
        if (travesia_exists_tidio()) {
            add_action( 'wp_enqueue_scripts',							'travesia_tidio_frontend_scripts', 1100 );
            add_filter( 'travesia_filter_merge_styles',					'travesia_tidio_merge_styles' );
        }
        if (is_admin()) {
            add_filter( 'travesia_filter_tgmpa_required_plugins',		'travesia_tidio_tgmpa_required_plugins' );
        }
    }
}

// Check if plugin installed and activated
if ( !function_exists( 'travesia_exists_tidio' ) ) {
    function travesia_exists_tidio() {
        return class_exists('tidio_plugin');
    }
}
// Filter to add in the required plugins list
if ( !function_exists( 'travesia_tidio_tgmpa_required_plugins' ) ) {
    //Handler of the add_filter('travesia_filter_tgmpa_required_plugins',	'travesia_tidio_tgmpa_required_plugins');
    function travesia_tidio_tgmpa_required_plugins($list=array()) {
        if (travesia_storage_isset('required_plugins', 'tidio-live-chat')) {
            $list[] = array(
                'name' 		=> travesia_storage_get_array('required_plugins', 'tidio-live-chat'),
                'slug' 		=> 'tidio-live-chat',
                'required' 	=> false
            );
        }
        return $list;
    }
}
?>