<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('travesia_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'travesia_essential_grid_theme_setup9', 9 );
	function travesia_essential_grid_theme_setup9() {
		if (travesia_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'travesia_essential_grid_frontend_scripts', 1100 );
			add_filter( 'travesia_filter_merge_styles',					'travesia_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'travesia_filter_tgmpa_required_plugins',		'travesia_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'travesia_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('travesia_filter_tgmpa_required_plugins',	'travesia_essential_grid_tgmpa_required_plugins');
	function travesia_essential_grid_tgmpa_required_plugins($list=array()) {
		if (travesia_storage_isset('required_plugins', 'essential-grid')) {
			$path = travesia_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || travesia_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> travesia_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
                        'version'	=> '2.3.2',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'travesia_exists_essential_grid' ) ) {
	function travesia_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'travesia_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'travesia_essential_grid_frontend_scripts', 1100 );
	function travesia_essential_grid_frontend_scripts() {
		if (travesia_is_on(travesia_get_theme_option('debug_mode')) && travesia_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'travesia-essential-grid',  travesia_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'travesia_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('travesia_filter_merge_styles', 'travesia_essential_grid_merge_styles');
	function travesia_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>