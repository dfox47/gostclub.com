<?php
/* Tour Master support functions
------------------------------------------------------------------------------- */

if (!defined('TRAVESIA_TOURMASTER_CPT_TOUR'))			define('TRAVESIA_TOURMASTER_CPT_TOUR', 			'tour');
if (!defined('TRAVESIA_TOURMASTER_CPT_TOUR_COUPON'))		define('TRAVESIA_TOURMASTER_CPT_TOUR_COUPON',	'tour_coupon');
if (!defined('TRAVESIA_TOURMASTER_CPT_TOUR_SERVICE'))	define('TRAVESIA_TOURMASTER_CPT_TOUR_SERVICE',	'tour_service');
if (!defined('TRAVESIA_TOURMASTER_TAX_TOUR_CATEGORY'))	define('TRAVESIA_TOURMASTER_TAX_TOUR_CATEGORY',	'tour_category');
if (!defined('TRAVESIA_TOURMASTER_TAX_TOUR_TAG'))		define('TRAVESIA_TOURMASTER_TAX_TOUR_TAG',		'tour_tag');

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('travesia_tourmaster_theme_setup1')) {
	add_action( 'after_setup_theme', 'travesia_tourmaster_theme_setup1', 1 );
	function travesia_tourmaster_theme_setup1() {
		add_filter( 'travesia_filter_list_posts_types',	'travesia_tourmaster_list_post_types');
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('travesia_tourmaster_theme_setup3')) {
	add_action( 'after_setup_theme', 'travesia_tourmaster_theme_setup3', 3 );
	function travesia_tourmaster_theme_setup3() {
		if (travesia_exists_tourmaster()) {
			// Section 'Tour Master'
			travesia_storage_merge_array('options', '', array_merge(
				array(
					'tourmaster' => array(
						"title" => esc_html__('Tour Master', 'travesia'),
						"desc" => wp_kses_data( __('Select parameters to display the Tour Master pages', 'travesia') ),
						"type" => "section"
						),
					'tourmaster_general_info' => array(
						"title" => esc_html__('General', 'travesia'),
						"desc" => '',
						"type" => "info",
						),
					'tourmaster_tours_page' => array(
						"title" => esc_html__('Page with all tours', 'travesia'),
						"desc" => wp_kses_data( __('Select page with shortcode [tourmaster_tour] to show all tours', 'travesia') ),
						"std" => '0',
						"options" => array(),
						"type" => "select"
						),
				),
				travesia_options_get_list_cpt_options('tourmaster')
			));
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('travesia_tourmaster_theme_setup9')) {
	add_action( 'after_setup_theme', 'travesia_tourmaster_theme_setup9', 9 );
	function travesia_tourmaster_theme_setup9() {

		add_filter( 'travesia_filter_merge_styles',					'travesia_tourmaster_merge_styles' );

		if (travesia_exists_tourmaster()) {
			add_filter( 'travesia_filter_post_type_taxonomy',		'travesia_tourmaster_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'travesia_filter_detect_blog_mode',		'travesia_tourmaster_detect_blog_mode' );
				add_filter( 'travesia_filter_get_post_categories',	'travesia_tourmaster_get_post_categories');
			}
		}
		if (is_admin()) {
			add_filter( 'travesia_filter_tgmpa_required_plugins',	'travesia_tourmaster_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'travesia_tourmaster_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('travesia_filter_tgmpa_required_plugins',	'travesia_tourmaster_tgmpa_required_plugins');
	function travesia_tourmaster_tgmpa_required_plugins($list=array()) {
		if (travesia_storage_isset('required_plugins', 'tourmaster')) {
			$path = travesia_get_file_dir('plugins/tourmaster/tourmaster.zip');
			if (!empty($path) || travesia_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> travesia_storage_get_array('required_plugins', 'tourmaster'),
					'slug' 		=> 'tourmaster',
                    'source'	=> !empty($path) ? $path : 'upload://tourmaster.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}



// Check if tourmaster installed and activated
if ( !function_exists( 'travesia_exists_tourmaster' ) ) {
	function travesia_exists_tourmaster() {
		return defined( 'TOURMASTER_LOCAL' );
	}
}

// Return true, if current page is any tourmaster page
if ( !function_exists( 'travesia_is_tourmaster_page' ) ) {
	function travesia_is_tourmaster_page() {
		$rez = false;
		if (travesia_exists_tourmaster()) {
			$rez = (is_single() && in_array(get_query_var('post_type'),
									array(TRAVESIA_TOURMASTER_CPT_TOUR, TRAVESIA_TOURMASTER_CPT_TOUR_COUPON, TRAVESIA_TOURMASTER_CPT_TOUR_SERVICE)))
					|| is_post_type_archive(TRAVESIA_TOURMASTER_CPT_TOUR)
					|| is_post_type_archive(TRAVESIA_TOURMASTER_CPT_TOUR_COUPON)
					|| is_post_type_archive(TRAVESIA_TOURMASTER_CPT_TOUR_SERVICE)
					|| is_tax(TRAVESIA_TOURMASTER_TAX_TOUR_CATEGORY)
					|| is_tax(TRAVESIA_TOURMASTER_TAX_TOUR_TAG);
		}
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'travesia_tourmaster_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'travesia_filter_detect_blog_mode', 'travesia_tourmaster_detect_blog_mode' );
	function travesia_tourmaster_detect_blog_mode($mode='') {
		if (travesia_is_tourmaster_page())
			$mode = 'tourmaster';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'travesia_tourmaster_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'travesia_filter_post_type_taxonomy',	'travesia_tourmaster_post_type_taxonomy', 10, 2 );
	function travesia_tourmaster_post_type_taxonomy($tax='', $post_type='') {
		if (travesia_exists_tourmaster()) {
			if ($post_type == TRAVESIA_TOURMASTER_CPT_TOUR)
				$tax = TRAVESIA_TOURMASTER_TAX_TOUR_CATEGORY;
		}
		return $tax;
	}
}

// Show categories of the current product
if ( !function_exists( 'travesia_tourmaster_get_post_categories' ) ) {
	//Handler of the add_filter( 'travesia_filter_get_post_categories', 		'travesia_tourmaster_get_post_categories');
	function travesia_tourmaster_get_post_categories($cats='') {
		if (travesia_exists_tourmaster()) {
			if (get_post_type()==TRAVESIA_TOURMASTER_CPT_TOUR)
				$cats = travesia_get_post_terms(', ', get_the_ID(), TRAVESIA_TOURMASTER_TAX_TOUR_CATEGORY);
		}
		return $cats;
	}
}

// Add 'tour' to the list of the supported post-types
if ( !function_exists( 'travesia_tourmaster_list_post_types' ) ) {
	//Handler of the add_filter( 'travesia_filter_list_posts_types', 'travesia_tourmaster_list_post_types');
	function travesia_tourmaster_list_post_types($list=array()) {
		if (travesia_exists_tourmaster()) {
			$list[TRAVESIA_TOURMASTER_CPT_TOUR] = esc_html__('Tours', 'travesia');
		}
		return $list;
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('travesia_tourmaster_get_list_choises')) {
	add_filter('travesia_filter_options_get_list_choises', 'travesia_tourmaster_get_list_choises', 10, 2);
	function travesia_tourmaster_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'tourmaster_tours_page')===0)
				$list = travesia_get_list_posts(false, array(
													'post_type' => 'page',
													'not_selected' => true,
													'orderby' => 'title',
													'order' => 'ASC',
													)
												);
		}
		return $list;
	}
}


// Return id of the 'tours_page'
if (!function_exists('travesia_tourmaster_get_all_posts_page_id')) {
	add_filter('trx_addons_filter_get_all_posts_page_id', 'travesia_tourmaster_get_all_posts_page_id', 10, 2);
	function travesia_tourmaster_get_all_posts_page_id($id, $slug) {
		if ($id==0 && $slug=='tourmaster') {
			$id = travesia_get_theme_option('tourmaster_tours_page');
		}
		return $id;
	}
}

// Merge custom styles
if ( !function_exists( 'travesia_tourmaster_merge_styles' ) ) {
	//Handler of the add_filter('travesia_filter_merge_styles', 'travesia_tourmaster_merge_styles');
	function travesia_tourmaster_merge_styles($list) {
		if (travesia_exists_tourmaster()) {
			$list[] = 'plugins/tourmaster/_tourmaster.scss';
		}
		return $list;
	}
}



// Add plugin-specific colors and fonts to the custom CSS
if (travesia_exists_tourmaster()) { require_once TRAVESIA_THEME_DIR . 'plugins/tourmaster/tourmaster-styles.php'; }
?>