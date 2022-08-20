<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.22
 */

if (!defined("TRAVESIA_THEME_FREE")) define("TRAVESIA_THEME_FREE", false);
if (!defined("TRAVESIA_THEME_FREE_WP")) define("TRAVESIA_THEME_FREE_WP", false);

// Theme storage
$TRAVESIA_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'travesia'),

			
			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'tourmaster'				=> esc_html__('Tour Master', 'travesia'),
			'instagram-feed'				=> esc_html__('Custom Feeds for Instagram', 'travesia'),
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'travesia'),
		 	'tidio-live-chat'				=> esc_html__('Tidio Chat', 'travesia'),
            'contact-form-7'				=> esc_html__('Contact Form 7', 'travesia'),


		),

		// List of plugins for PREMIUM version only
		//-----------------------------------------------------
		TRAVESIA_THEME_FREE  ? array() : array(
			// Recommended (supported) plugins for the PRO (full) version
			// If plugin not need - comment (or remove) it

					'js_composer'				=> esc_html__('WPBakery Page Builder', 'travesia'),
					'vc-extensions-bundle'		=> esc_html__('WPBakery Page Builder extensions bundle', 'travesia'),
					'essential-grid'			=> esc_html__('Essential Grid', 'travesia'),
					'revslider'					=> esc_html__('Revolution Slider', 'travesia'),
                    'wp-gdpr-compliance'   => esc_html__( 'WP GDPR Compliance', 'travesia' ),

				)
	),
	
	// Theme-specific URLs (will be escaped in place of the output)
    'theme_pro_key' => 'env-axiom',
	'theme_demo_url' => 'http://travesia.axiomthemes.com',
	'theme_doc_url'  => 'http://travesia.axiomthemes.com/doc',

	'theme_video_url' => 'https://www.youtube.com/channel/UCBjqhuwKj3MfE3B6Hg2oA8Q',	// Axiom

	'theme_support_url'  => 'http://axiom.ticksy.com',
    'theme_download_url'=> 'https://1.envato.market/c/1262870/275988/4415?subId1=axiom&u=themeforest.net/item/travesia-travel-agency-wordpress-theme/21130885'
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('travesia_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'travesia_customizer_theme_setup1', 1 );
	function travesia_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		travesia_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for template and child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes
			
			'custmize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame
		
			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts
		
			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'
			
			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
			
			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:

													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false		// Allow upload not pre-packaged plugins via TGMPA
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		travesia_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Varela',
				'family' => 'sans-serif',
				'styles' => '400'		// Parameter 'style' used only for the Google fonts
			),
			array(
				'name'	 => 'Cabin',
				'family' => 'sans-serif',
				'styles' => '400,400italic,500,500italic,600,600italic,700,700italic'
			),
			array(
				'name'	 => 'Lora',
				'family' => 'sans-serif',
				'styles' => '400,400italic,700,700italic'
			)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		travesia_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		travesia_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'travesia'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'travesia'),
				'font-family'		=> '"Varela",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.8em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '2em'
			),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '3.33em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-2.1px',
				'margin-top'		=> '1.21em',
				'margin-bottom'		=> '0.5833em'
			),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '2.6em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.154em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.7px',
				'margin-top'		=> '1.55em',
				'margin-bottom'		=> '0.685em'
			),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '1.67em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.24em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1px',
				'margin-top'		=> '2.35em',
				'margin-bottom'		=> '1.15em'
			),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '1.33em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px',
				'margin-top'		=> '3.2em',
				'margin-bottom'		=> '1.35em'
			),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '1.2em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.39em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.715px',
				'margin-top'		=> '3.5em',
				'margin-bottom'		=> '1.1em'
			),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.6em',
				'text-decoration'	=> 'none',
				'text-transform'	=> '',
				'letter-spacing'	=> '0',
				'margin-top'		=> '4.09em',
				'margin-bottom'		=> '1.25em'
			),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'travesia'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
			),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '12px',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '2px'
			),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'travesia'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'travesia'),
				'font-family'		=> '"Varela",sans-serif',
				'font-size' 		=> '0.87em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
			),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'travesia'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'travesia'),
				'font-family'		=> '"Lora",sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
			),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'travesia'),
				'description'		=> esc_html__('Font settings of the main menu items', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '2.76em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
			),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'travesia'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'travesia'),
				'font-family'		=> '"Cabin",sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.65em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
			)
		));



		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		travesia_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> esc_html__('Main', 'travesia'),
							'description'	=> esc_html__('Colors of the main content area', 'travesia')
							),
			'alter'	=> array(
							'title'			=> esc_html__('Alter', 'travesia'),
							'description'	=> esc_html__('Colors of the alternative blocks (sidebars, etc.)', 'travesia')
							),
			'extra'	=> array(
							'title'			=> esc_html__('Extra', 'travesia'),
							'description'	=> esc_html__('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'travesia')
							),
			'inverse' => array(
							'title'			=> esc_html__('Inverse', 'travesia'),
							'description'	=> esc_html__('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'travesia')
							),
			'input'	=> array(
							'title'			=> esc_html__('Input', 'travesia'),
							'description'	=> esc_html__('Colors of the form fields (text field, textarea, select, etc.)', 'travesia')
							),
			)
		);
		travesia_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> esc_html__('Background color', 'travesia'),
							'description'	=> esc_html__('Background color of this block in the normal state', 'travesia')
							),
			'bg_hover'	=> array(
							'title'			=> esc_html__('Background hover', 'travesia'),
							'description'	=> esc_html__('Background color of this block in the hovered state', 'travesia')
							),
			'bd_color'	=> array(
							'title'			=> esc_html__('Border color', 'travesia'),
							'description'	=> esc_html__('Border color of this block in the normal state', 'travesia')
							),
			'bd_hover'	=>  array(
							'title'			=> esc_html__('Border hover', 'travesia'),
							'description'	=> esc_html__('Border color of this block in the hovered state', 'travesia')
							),
			'text'		=> array(
							'title'			=> esc_html__('Text', 'travesia'),
							'description'	=> esc_html__('Color of the plain text inside this block', 'travesia')
							),
			'text_dark'	=> array(
							'title'			=> esc_html__('Text dark', 'travesia'),
							'description'	=> esc_html__('Color of the dark text (bold, header, etc.) inside this block', 'travesia')
							),
			'text_light'=> array(
							'title'			=> esc_html__('Text light', 'travesia'),
							'description'	=> esc_html__('Color of the light text (post meta, etc.) inside this block', 'travesia')
							),
			'text_link'	=> array(
							'title'			=> esc_html__('Link', 'travesia'),
							'description'	=> esc_html__('Color of the links inside this block', 'travesia')
							),
			'text_hover'=> array(
							'title'			=> esc_html__('Link hover', 'travesia'),
							'description'	=> esc_html__('Color of the hovered state of links inside this block', 'travesia')
							),
			'text_link2'=> array(
							'title'			=> esc_html__('Link 2', 'travesia'),
							'description'	=> esc_html__('Color of the accented texts (areas) inside this block', 'travesia')
							),
			'text_hover2'=> array(
							'title'			=> esc_html__('Link 2 hover', 'travesia'),
							'description'	=> esc_html__('Color of the hovered state of accented texts (areas) inside this block', 'travesia')
							),
			'text_link3'=> array(
							'title'			=> esc_html__('Link 3', 'travesia'),
							'description'	=> esc_html__('Color of the other accented texts (buttons) inside this block', 'travesia')
							),
			'text_hover3'=> array(
							'title'			=> esc_html__('Link 3 hover', 'travesia'),
							'description'	=> esc_html__('Color of the hovered state of other accented texts (buttons) inside this block', 'travesia')
							)
			)
		);
		travesia_storage_set('schemes', array(

			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'travesia'),
				'colors' => array(

					// Whole block border and background
					'bg_color'			=> '#ffffff',//+
					'bd_color'			=> '#eeeeee',//+

					// Text and links colors
					'text'				=> '#6d6d6d',//+
					'text_light'		=> '#919394',//+
					'text_dark'			=> '#1c1d20',//+
					'text_link'			=> '#396fe0',//+
					'text_hover'		=> '#3164cf',//+
					'text_link2'		=> '#be935f',//+
					'text_hover2'		=> '#a87e4c',//+
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#faf7f2',//+
					'alter_bg_hover'	=> '#212a3b',//+
					'alter_bd_color'	=> '#e7e3dd',//+
					'alter_bd_hover'	=> '#cfccc8',//+
					'alter_text'		=> '#7a7b7d',//+
					'alter_light'		=> '#adb1b9',//+
					'alter_dark'		=> '#1d1d1d',//+
					'alter_link'		=> '#396fe0',//+
					'alter_hover'		=> '#b68e5e',//+
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#25262c',//+
					'extra_bg_hover'	=> '#ffffff',//+
					'extra_bd_color'	=> '#e6e3df',//+
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#6d6d6d',//+
					'extra_light'		=> '#acb4b6',//+
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#72cfd5',
					'extra_hover'		=> '#396fe0',//+
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#e7eaed',
					'input_bg_hover'	=> '#e7eaed',
					'input_bd_color'	=> '#e5e5e5',//+
					'input_bd_hover'	=> '#e0e0e0',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#d0d0d0',
					'input_dark'		=> '#1d1d1d',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#ffffff',//+
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',//+
					'inverse_hover'		=> '#1d1d1d'
				)
			),

			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'travesia'),
				'colors' => array(

					// Whole block border and background
					'bg_color'			=> '#25262c',//+
					'bd_color'			=> '#393b42',//+

					// Text and links colors
					'text'				=> '#919394',//+
					'text_light'		=> '#818385',//+
					'text_dark'			=> '#ffffff',//+
					'text_link'			=> '#396fe0',//+
					'text_hover'		=> '#be935f',//+
					'text_link2'		=> '#be935f',//+
					'text_hover2'		=> '#a87e4c',//+
					'text_link3'		=> '#ddb837',
					'text_hover3'		=> '#eec432',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1e1d22',
					'alter_bg_hover'	=> '#212a3b',//+
					'alter_bd_color'	=> '#313131',
					'alter_bd_hover'	=> '#3d3d3d',
					'alter_text'		=> '#a6a6a6',//+
					'alter_light'		=> '#ffffff',//+
					'alter_dark'		=> '#1c1d20',//+
					'alter_link'		=> '#b68e5e',//+
					'alter_hover'		=> '#396fe0',//+
					'alter_link2'		=> '#8be77c',
					'alter_hover2'		=> '#80d572',
					'alter_link3'		=> '#eec432',
					'alter_hover3'		=> '#ddb837',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#1e1d22',
					'extra_bg_hover'	=> '#ffffff',//+
					'extra_bd_color'	=> '#313131',
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#ffffff',//+
					'extra_light'		=> '#5f5f5f',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#ffaa5f',
					'extra_hover'		=> '#396fe0',//+
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#ddb837',
					'extra_hover3'		=> '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#2e2d32',
					'input_bg_hover'	=> '#2e2d32',
					'input_bd_color'	=> '#2e2d32',
					'input_bd_hover'	=> '#353535',
					'input_text'		=> '#b7b7b7',
					'input_light'		=> '#5f5f5f',//+
					'input_dark'		=> '#ffffff',//+

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#1d1d1d',
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#000000',
					'inverse_link'		=> '#ffffff',//+
					'inverse_hover'		=> '#1d1d1d'
				)
			)

		));

		// Simple schemes substitution
		travesia_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));
	}
}


// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('travesia_customizer_add_theme_colors')) {
	function travesia_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = travesia_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = travesia_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = travesia_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = travesia_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = travesia_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['inverse_link_04']  = travesia_hex2rgba( $colors['inverse_link'], 0.4 );
			$colors['inverse_link_07']  = travesia_hex2rgba( $colors['inverse_link'], 0.7 );
			$colors['alter_bg_color_07']  = travesia_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = travesia_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = travesia_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = travesia_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = travesia_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_01']  = travesia_hex2rgba( $colors['text_dark'], 0.1 );
			$colors['text_dark_07']  = travesia_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = travesia_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = travesia_hex2rgba( $colors['text_link'], 0.7 );
			$colors['alter_bg_hover_09']  = travesia_hex2rgba( $colors['alter_bg_hover'], 0.9 );
			$colors['text_link_blend'] = travesia_hsb2hex(travesia_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = travesia_hsb2hex(travesia_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['inverse_link_04'] = '{{ data.inverse_link_04 }}';
			$colors['inverse_link_07'] = '{{ data.inverse_link_07 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_01'] = '{{ data.text_dark_01 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['alter_bg_hover_09'] = '{{ data.alter_bg_hover_09 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}




// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('travesia_customizer_add_theme_fonts')) {
	function travesia_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {

			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !travesia_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !travesia_is_inherit($font['font-size'])
														? 'font-size:' . travesia_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !travesia_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !travesia_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !travesia_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !travesia_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !travesia_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !travesia_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !travesia_is_inherit($font['margin-top'])
														? 'margin-top:' . travesia_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !travesia_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . travesia_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}




//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('travesia_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'travesia_customizer_theme_setup' );
	function travesia_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('travesia_filter_add_thumb_sizes', array(
			'travesia-thumb-huge'		=> array(1170, 658, true),
			'travesia-thumb-big' 		=> array( 760, 428, true),
			'travesia-thumb-med' 		=> array( 370, 208, true),
			'travesia-thumb-med-avatar' 		=> array( 370, 260, true),
			'travesia-thumb-tiny' 		=> array(  90,  90, true),
			'travesia-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'travesia-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = travesia_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'travesia_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('travesia_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'travesia_customizer_image_sizes' );
	function travesia_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('travesia_filter_add_thumb_sizes', array(
			'travesia-thumb-huge'		=> esc_html__( 'Huge image', 'travesia' ),
			'travesia-thumb-big'			=> esc_html__( 'Large image', 'travesia' ),
			'travesia-thumb-med'			=> esc_html__( 'Medium image', 'travesia' ),
			'travesia-thumb-med-avatar'	=> esc_html__( 'Medium Avatar image', 'travesia' ),
			'travesia-thumb-tiny'		=> esc_html__( 'Small square avatar', 'travesia' ),
			'travesia-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'travesia' ),
			'travesia-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'travesia' ),
			)
		);
		$mult = travesia_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'travesia' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'travesia_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'travesia_customizer_trx_addons_add_thumb_sizes');
	function travesia_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-medium-avatar',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'travesia_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'travesia_customizer_trx_addons_get_thumb_size');
	function travesia_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-medium-avatar',
							'trx_addons-thumb-medium-avatar-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'travesia-thumb-huge',
							'travesia-thumb-huge-@retina',
							'travesia-thumb-big',
							'travesia-thumb-big-@retina',
							'travesia-thumb-med',
							'travesia-thumb-med-@retina',
							'travesia-thumb-med-avatar',
							'travesia-thumb-med-avatar-@retina',
							'travesia-thumb-tiny',
							'travesia-thumb-tiny-@retina',
							'travesia-thumb-masonry-big',
							'travesia-thumb-masonry-big-@retina',
							'travesia-thumb-masonry',
							'travesia-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'travesia_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'travesia_importer_set_options', 9 );
	function travesia_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(travesia_get_protocol() . '://demofiles.axiomthemes.com/travesia/');
			// Required plugins
			$options['required_plugins'] = array_keys(travesia_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('Travesia Demo', 'travesia');
			$options['files']['default']['domain_dev'] = esc_url(travesia_get_protocol().'://travesia.axiomthemes.dnw');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(travesia_get_protocol().'://travesia.axiomthemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter

			// Banners
			$options['banners'] = array(
									array(
										'image' => travesia_get_file_url('theme-specific/theme.about/images/frontpage.png'),
										'title' => esc_html__('Front page Builder', 'travesia'),
										'content' => wp_kses_post(__('Create your Frontpage right in WordPress Customizer! To do this, you will not need neither the WPBakery Page Builder nor any other Builder. Just turn on/off sections, and fill them with content and decorate to your liking', 'travesia')),
										'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
										'link_caption' => esc_html__('More about Frontpage Builder', 'travesia'),
										'duration' => 20
										),
									array(
										'image' => travesia_get_file_url('theme-specific/theme.about/images/layouts.png'),
										'title' => esc_html__('Custom layouts', 'travesia'),
										'content' => wp_kses_post(__('Forget about problems with customization of header or footer! You can edit any of layout without any changes in CSS or HTML directly in Visual Builder. Moreover - you can easily create your own headers and footers and use them along with built-in', 'travesia')),
										'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
										'link_caption' => esc_html__('More about Custom Layouts', 'travesia'),
										'duration' => 20
										),
									array(
										'image' => travesia_get_file_url('theme-specific/theme.about/images/documentation.png'),
										'title' => esc_html__('Read full documentation', 'travesia'),
										'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use Travesia', 'travesia')),
										'link_url' => esc_url(travesia_storage_get('theme_doc_url')),
										'link_caption' => esc_html__('Online documentation', 'travesia'),
										'duration' => 15
										),
									array(
										'image' => travesia_get_file_url('theme-specific/theme.about/images/video-tutorials.png'),
										'title' => esc_html__('Video tutorials', 'travesia'),
										'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize Travesia in detail.', 'travesia')),
										'link_url' => esc_url(travesia_storage_get('theme_video_url')),
										'link_caption' => esc_html__('Video tutorials', 'travesia'),
										'duration' => 15
										),
									array(
										'image' => travesia_get_file_url('theme-specific/theme.about/images/studio.jpg'),
										'title' => esc_html__('Website Customization', 'travesia'),
										'content' => wp_kses_post(__('We can make a website based on this theme for a very fair price.
We can implement any extra functional: translate your website, WPML implementation and many other customization accroding to your request.', 'travesia')),
										'link_url' => esc_url('//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash'),
										'link_caption' => esc_html__('Contact us', 'travesia'),
										'duration' => 25
										)
									);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('travesia_create_theme_options')) {

	function travesia_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override =  wp_kses_data( __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'travesia'));

		travesia_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'travesia'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'travesia'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'travesia'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'travesia') ),
				"class" => "travesia_column-1_2 travesia_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'travesia'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'travesia') ),
				"class" => "travesia_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_max_height' => array(
				"title" => esc_html__('Logo max. height', 'travesia'),
				"desc" => wp_kses_data( __("Max. height of the logo image (in pixels). Maximum size of logo depends on the actual size of the picture", 'travesia') ),
				"std" => 80,
				"min" => 20,
				"max" => 160,
				"step" => 1,
				"refresh" => false,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'travesia') ),
				"class" => "travesia_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'travesia') ),
				"class" => "travesia_column-1_2 travesia_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'travesia') ),
				"class" => "travesia_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'travesia') ),
				"class" => "travesia_column-1_2 travesia_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'travesia') ),
				"class" => "travesia_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'travesia') ),
				"class" => "travesia_column-1_2 travesia_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'travesia') ),
				"class" => "travesia_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'travesia'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'travesia'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'travesia'),
				"desc" => wp_kses_data( __('Select width of the body content', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'travesia')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => travesia_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'travesia') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'travesia')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'travesia'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'travesia')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'travesia'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'travesia'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'travesia'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'travesia'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'travesia') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'travesia'),
				"desc" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'travesia'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'travesia'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'travesia'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'travesia'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'travesia')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
				),



			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'travesia'),
				"desc" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'travesia'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'travesia') ),
				"std" => 0,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),

            'privacy_text' => array(
                "title" => esc_html__("Text with Privacy Policy link", 'travesia'),
                "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'travesia') ),
                "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'travesia') ),
                "type"  => "text"
            ),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'travesia'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'travesia'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'travesia'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => 'default',
				"options" => travesia_get_list_header_footer_types(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'travesia'),
				"desc" => wp_kses_data( __('Select custom header from Layouts Builder', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => TRAVESIA_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'travesia'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => 'default',
				"options" => array(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'travesia'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => 0,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'travesia'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'travesia') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwide', 'travesia'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'travesia'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'travesia') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'travesia'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'travesia') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'travesia'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => travesia_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'travesia'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'travesia') ),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'travesia'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'travesia'),
				),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'travesia'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'travesia'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'travesia')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'travesia'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'travesia') ),
				"std" => 1,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'travesia'),
				"desc" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'travesia'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'travesia') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => 0,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'travesia'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'travesia'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'travesia')
				),
				"std" => 'default',
				"options" => travesia_get_list_header_footer_types(),
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'travesia'),
				"desc" => wp_kses_data( __('Select custom footer from Layouts Builder', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'travesia')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => TRAVESIA_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'travesia'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'travesia')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'travesia'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'travesia')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => travesia_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwide', 'travesia'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'travesia') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'travesia')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'travesia'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'travesia') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'travesia') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'travesia') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'travesia'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'travesia') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'travesia'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'travesia') ),
				"std" => esc_html__('Copyright &copy; {Y} by AxiomThemes. All rights reserved.', 'travesia'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'travesia'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'travesia') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'travesia'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'travesia') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'travesia'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'travesia'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'travesia'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'travesia'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'travesia') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'travesia'),
						'fullpost'	=> esc_html__('Full post',	'travesia')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'travesia'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'travesia') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 40,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'travesia'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'travesia') ),
					"std" => 2,
					"options" => travesia_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'travesia'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'travesia'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'travesia'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'travesia'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"std" => "pages",
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'travesia'),
						'links'	=> esc_html__("Older/Newest", 'travesia'),
						'more'	=> esc_html__("Load more", 'travesia'),
						'infinite' => esc_html__("Infinite scroll", 'travesia')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'travesia'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'travesia'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'travesia'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'travesia') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'travesia'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'travesia') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'travesia'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'travesia') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'travesia'),
					"desc" => '',
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'travesia'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'travesia') ),
					"std" => 'hide',
					"options" => array(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'travesia'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'travesia') ),
					"std" => 'hide',
					"options" => array(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'travesia'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'travesia') ),
					"std" => 'hide',
					"options" => array(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'travesia'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'travesia') ),
					"std" => 'hide',
					"options" => array(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'travesia'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'travesia'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'travesia') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'travesia'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'travesia') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'travesia'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'travesia') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'travesia'),
						'columns' => esc_html__('Mini-cards',	'travesia')
					),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'travesia'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'travesia'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page.", 'travesia') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=0|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'travesia'),
						'date'		 => esc_html__('Post date', 'travesia'),
						'author'	 => esc_html__('Post author', 'travesia'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'travesia'),
						'share'		 => esc_html__('Share links', 'travesia'),
						'edit'		 => esc_html__('Edit link', 'travesia')
					),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'travesia'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'travesia') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'travesia')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'travesia'),
						'likes' => esc_html__('Likes', 'travesia'),
						'comments' => esc_html__('Comments', 'travesia')
					),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'travesia'),
					"desc" => wp_kses_data( __('Settings of the single post', 'travesia') ),
					"type" => "section",
					),
				'header_type_post' => array(
					"title" => esc_html__('Header style', 'travesia'),
					"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'travesia') ),
					"override" => array(
						'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__('Header', 'travesia')
					),
					"std" => 'default',
					"options" => travesia_get_list_header_footer_types(),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
				'header_style_post' => array(
					"title" => esc_html__('Select custom layout', 'travesia'),
					"desc" => wp_kses_data( __('Select custom header from Layouts Builder', 'travesia') ),
					"dependency" => array(
						'header_type_post' => array('custom')
					),
					"std" => TRAVESIA_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
					"options" => array(),
					"type" => "select"
				),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'travesia'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'travesia') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'travesia')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'travesia'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'travesia') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'travesia'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'travesia') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'travesia'),
					"desc" => wp_kses_data( __("Meta parts for single posts.", 'travesia') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'travesia'),
						'date'		 => esc_html__('Post date', 'travesia'),
						'author'	 => esc_html__('Post author', 'travesia'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'travesia'),
						'share'		 => esc_html__('Share links', 'travesia'),
						'edit'		 => esc_html__('Edit link', 'travesia')
					),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'travesia'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'travesia') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=1|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'travesia'),
						'likes' => esc_html__('Likes', 'travesia'),
						'comments' => esc_html__('Comments', 'travesia')
					),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'travesia'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'travesia') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'travesia'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'travesia') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'travesia'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'travesia'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'travesia') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'travesia')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'travesia'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts shown.', 'travesia') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => travesia_get_list_range(1,9),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'travesia'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'travesia') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => travesia_get_list_range(1,4),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'travesia'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'travesia') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => travesia_get_list_styles(1,2),
					"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'travesia'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'travesia'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'travesia') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'travesia'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'travesia')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'travesia'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'travesia')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'travesia'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'travesia')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'travesia'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'travesia')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'travesia'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'travesia')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'travesia'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'travesia') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'travesia'),
				"desc" => '',
				"std" => '$travesia_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'travesia'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'travesia') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'travesia')
				),
				"hidden" => true,
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'travesia'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'travesia') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'travesia')
				),
				"hidden" => true,
				"std" => '',
				"type" => TRAVESIA_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'travesia'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'travesia'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'travesia') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'travesia') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'travesia'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'travesia') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'travesia') ),
				"class" => "travesia_column-1_3 travesia_new_row",
				"refresh" => false,
				"std" => '$travesia_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=travesia_get_theme_setting('max_load_fonts'); $i++) {
			if (travesia_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(esc_html__('Font %s', 'travesia'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'travesia'),
				"desc" => '',
				"class" => "travesia_column-1_3 travesia_new_row",
				"refresh" => false,
				"std" => '$travesia_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'travesia'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'travesia') )
							: '',
				"class" => "travesia_column-1_3",
				"refresh" => false,
				"std" => '$travesia_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'travesia'),
					'serif' => esc_html__('serif', 'travesia'),
					'sans-serif' => esc_html__('sans-serif', 'travesia'),
					'monospace' => esc_html__('monospace', 'travesia'),
					'cursive' => esc_html__('cursive', 'travesia'),
					'fantasy' => esc_html__('fantasy', 'travesia')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'travesia'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'travesia') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'travesia') )
							: '',
				"class" => "travesia_column-1_3",
				"refresh" => false,
				"std" => '$travesia_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = travesia_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(esc_html__('%s settings', 'travesia'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'travesia'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'travesia'),
						'100' => esc_html__('100 (Light)', 'travesia'), 
						'200' => esc_html__('200 (Light)', 'travesia'), 
						'300' => esc_html__('300 (Thin)',  'travesia'),
						'400' => esc_html__('400 (Normal)', 'travesia'),
						'500' => esc_html__('500 (Semibold)', 'travesia'),
						'600' => esc_html__('600 (Semibold)', 'travesia'),
						'700' => esc_html__('700 (Bold)', 'travesia'),
						'800' => esc_html__('800 (Black)', 'travesia'),
						'900' => esc_html__('900 (Black)', 'travesia')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'travesia'),
						'normal' => esc_html__('Normal', 'travesia'), 
						'italic' => esc_html__('Italic', 'travesia')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'travesia'),
						'none' => esc_html__('None', 'travesia'), 
						'underline' => esc_html__('Underline', 'travesia'),
						'overline' => esc_html__('Overline', 'travesia'),
						'line-through' => esc_html__('Line-through', 'travesia')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'travesia'),
						'none' => esc_html__('None', 'travesia'), 
						'uppercase' => esc_html__('Uppercase', 'travesia'),
						'lowercase' => esc_html__('Lowercase', 'travesia'),
						'capitalize' => esc_html__('Capitalize', 'travesia')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "travesia_column-1_5",
					"refresh" => false,
					"std" => '$travesia_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		travesia_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			travesia_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'travesia'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'travesia') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'travesia')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			travesia_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'travesia'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'travesia') ),
				"class" => "travesia_column-1_2 travesia_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('travesia_options_get_list_cpt_options')) {
	function travesia_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'travesia'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'travesia'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'travesia') ),
						"std" => 'inherit',
						"options" => travesia_get_list_header_footer_types(true),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'travesia'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'travesia'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'travesia'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'travesia'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'travesia'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'travesia') ),
						"std" => 0,
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'travesia'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'travesia'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'travesia'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'travesia'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'travesia'), $title) ),
						"refresh" => false,
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'travesia'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'travesia'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'travesia'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'travesia') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'travesia'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'travesia'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'travesia') ),
						"std" => 'inherit',
						"options" => travesia_get_list_header_footer_types(true),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'travesia'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'travesia') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'travesia'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'travesia') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'travesia'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'travesia') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => travesia_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwide', 'travesia'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'travesia') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'travesia'),
						"desc" => '',
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'travesia'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'travesia') ),
						"std" => 'hide',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'travesia'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'travesia') ),
						"std" => 'hide',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'travesia'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'travesia') ),
						"std" => 'hide',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'travesia'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'travesia') ),
						"std" => 'hide',
						"options" => array(),
						"type" => TRAVESIA_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('travesia_options_get_list_choises')) {
	add_filter('travesia_filter_options_get_list_choises', 'travesia_options_get_list_choises', 10, 2);
	function travesia_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = travesia_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = travesia_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (substr($id, -7) == '_scheme')
				$list = travesia_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = travesia_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = travesia_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = travesia_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = travesia_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = travesia_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = travesia_array_merge(array(0 => esc_html__('- Select category -', 'travesia')), travesia_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = travesia_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = travesia_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = travesia_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>