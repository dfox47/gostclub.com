<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$travesia_content = '';
$travesia_blog_archive_mask = '%%CONTENT%%';
$travesia_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $travesia_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($travesia_content = apply_filters('the_content', get_the_content())) != '') {
		if (($travesia_pos = strpos($travesia_content, $travesia_blog_archive_mask)) !== false) {
			$travesia_content = preg_replace('/(\<p\>\s*)?'.$travesia_blog_archive_mask.'(\s*\<\/p\>)/i', $travesia_blog_archive_subst, $travesia_content);
		} else
			$travesia_content .= $travesia_blog_archive_subst;
		$travesia_content = explode($travesia_blog_archive_mask, $travesia_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) travesia_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$travesia_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$travesia_args = travesia_query_add_posts_and_cats($travesia_args, '', travesia_get_theme_option('post_type'), travesia_get_theme_option('parent_cat'));
$travesia_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($travesia_page_number > 1) {
	$travesia_args['paged'] = $travesia_page_number;
	$travesia_args['ignore_sticky_posts'] = true;
}
$travesia_ppp = travesia_get_theme_option('posts_per_page');
if ((int) $travesia_ppp != 0)
	$travesia_args['posts_per_page'] = (int) $travesia_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($travesia_args);


// Add internal query vars in the new query!
if (is_array($travesia_content) && count($travesia_content) == 2) {
	set_query_var('blog_archive_start', $travesia_content[0]);
	set_query_var('blog_archive_end', $travesia_content[1]);
}

get_template_part('index');
?>