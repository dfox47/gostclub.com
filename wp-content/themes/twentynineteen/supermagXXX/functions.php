<?php
/**
 * SuperMag functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acme Themes
 * @subpackage SuperMag
 */

/**
 *  Default Theme layout options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array $supermag_theme_layout
 *
 */
if ( !function_exists('supermag_get_default_theme_options') ) :
    function supermag_get_default_theme_options() {

        $default_theme_options = array(
            /*feature section options*/
            'supermag-feature-cat'  => 0,
            'supermag-feature-post-one'  => 0,
            'supermag-feature-post-two'  => 0,
            'supermag-feature-side-display-options'  => 'from-recent',
            'supermag-feature-side-title-length'  => 6,
            'supermag-feature-side-from-category'  => 0,
            'supermag-feature-add-one'  => get_template_directory_uri()."/assets/img/supermag-add1-240-172.png",
            'supermag-feature-add-one-link'  => "https://www.acmethemes.com/",
            'supermag-feature-add-two'  => get_template_directory_uri()."/assets/img/supermag-add2-240-172.png",
            'supermag-feature-add-two-link'  => "https://www.acmethemes.com/themes/supermag/",
            'supermag-enable-feature'  => true,

            /*header options*/
            'supermag-header-logo'  => '',
            'supermag-header-id-display-opt' => 'title-and-tagline',
            'supermag-show-date'  => 1,
            'supermag-breaking-news-title'  => __( 'Recent posts', 'supermag' ),
            'supermag-breaking-news-options'  => 'slide',
            'supermag-facebook-url'  => '',
            'supermag-twitter-url'  => '',
            'supermag-youtube-url'  => '',
            'supermag-instagram-url'        => '',
            'supermag-google-plus-url'  => '',
            'supermag-pinterest-url'        => '',
            'supermag-enable-social'  => 0,
            'supermag-header-main-show-banner-ads'  => 'image',
            'supermag-header-main-banner-ads'  => '',
            'supermag-header-main-banner-ads-link'  => 'https://www.acmethemes.com/themes/supermag/',
            'supermag-header-logo-ads-display-position'  => 'left-logo-right-ainfo',

            'supermag-menu-show-home-icon'  => 1,
            'supermag-enable-random-post'  => 1,
            'supermag-enable-sticky-menu'  => '',
            'supermag-menu-show-search'  => 1,
            'supermag-menu-search-type'  => 'dropdown-search',
            'supermag-enable-sticky-sidebar'  => 1,
            'supermag-header-date-format'  => 'default',

            'supermag-header-media-position'  => 'above-menu',
            'supermag-header-media-customizer-link'  => '',
            'supermag-header-image-link'  => esc_url( home_url() ),
            'supermag-header-image-link-new-tab'  => '',

            /*footer options*/
            'supermag-footer-copyright'  => __( 'Copyright &copy; All rights reserved', 'supermag' ),

            /*layout/design options*/
            'supermag-default-layout'  => 'boxed',
            'supermag-enable-box-shadow'  => '',
            'supermag-sidebar-layout'  => 'right-sidebar',
            'supermag-front-page-sidebar-layout'  => 'right-sidebar',
            'supermag-archive-sidebar-layout'  => 'right-sidebar',

            'supermag-blog-archive-layout'  => 'left-image',
            'supermag-blog-archive-image-layout' => 'full',
            'supermag-disable-image-zoom' => '',

            'supermag-blog-archive-more-text'  => __( 'Read More', 'supermag' ),

            'supermag-blog-archive-category-display-options' => 'default',
            'supermag-single-category-display-options' => 'default',

            'supermag-primary-color'  => '#4db2ec',
            'supermag-cat-hover-color'  => '#2d2d2d',

            'supermag-custom-css'  => '',

            /*single related post options*/
            'supermag-show-related'  => 1,
            'supermag-related-title'  => __( 'Related posts', 'supermag' ),
            'supermag-related-post-display-from'  => 'cat',
            'supermag-single-post-layout'  => 'large-image',
            'supermag-single-image-layout'  => 'full',

            /*theme options*/
            'supermag-search-placholder'  => __( 'Search', 'supermag' ),
            'supermag-show-breadcrumb'  => 0,
            'supermag-side-show-message'  => '',
            'supermag-image-size-message'  => '',
            'supermag-side-image-message'  => '',
            'supermag-hide-front-page-content'  => '',
            'supermag-you-are-here-text'  => __( 'You are here', 'supermag' ),

            /*woocommerce*/
            'supermag-wc-shop-archive-sidebar-layout'     => 'no-sidebar',
            'supermag-wc-product-column-number'           => 4,
            'supermag-wc-shop-archive-total-product'      => 16,
            'supermag-wc-single-product-sidebar-layout'   => 'no-sidebar',
            /*Reset*/
            'supermag-reset-options'  => '0'

        );
        return apply_filters( 'supermag_default_theme_options', $default_theme_options );
    }
endif;

/**
 *  Get theme options
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return array supermag_theme_options
 *
 */
if ( !function_exists('supermag_get_theme_options') ) :
    function supermag_get_theme_options() {
        $supermag_default_theme_options = supermag_get_default_theme_options();
        $supermag_get_theme_options = get_theme_mod( 'supermag_theme_options');
        if( is_array($supermag_get_theme_options )){
            return array_merge( $supermag_default_theme_options ,$supermag_get_theme_options );
        }
        else{
            return $supermag_default_theme_options;
        }
    }
endif;

$supermag_saved_theme_options = supermag_get_theme_options();
$GLOBALS['supermag_customizer_all_values'] = $supermag_saved_theme_options;

/**
 * require int.
 */
require_once trailingslashit( get_template_directory() ).'acmethemes/init.php';