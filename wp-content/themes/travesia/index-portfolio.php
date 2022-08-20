<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

travesia_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	travesia_show_layout(get_query_var('blog_archive_start'));

	$travesia_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$travesia_sticky_out = travesia_get_theme_option('sticky_style')=='columns' 
							&& is_array($travesia_stickies) && count($travesia_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$travesia_cat = travesia_get_theme_option('parent_cat');
	$travesia_post_type = travesia_get_theme_option('post_type');
	$travesia_taxonomy = travesia_get_post_type_taxonomy($travesia_post_type);
	$travesia_show_filters = travesia_get_theme_option('show_filters');
	$travesia_tabs = array();
	if (!travesia_is_off($travesia_show_filters)) {
		$travesia_args = array(
			'type'			=> $travesia_post_type,
			'child_of'		=> $travesia_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $travesia_taxonomy,
			'pad_counts'	=> false
		);
		$travesia_portfolio_list = get_terms($travesia_args);
		if (is_array($travesia_portfolio_list) && count($travesia_portfolio_list) > 0) {
			$travesia_tabs[$travesia_cat] = esc_html__('All', 'travesia');
			foreach ($travesia_portfolio_list as $travesia_term) {
				if (isset($travesia_term->term_id)) $travesia_tabs[$travesia_term->term_id] = $travesia_term->name;
			}
		}
	}
	if (count($travesia_tabs) > 0) {
		$travesia_portfolio_filters_ajax = true;
		$travesia_portfolio_filters_active = $travesia_cat;
		$travesia_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters travesia_tabs travesia_tabs_ajax">
			<ul class="portfolio_titles travesia_tabs_titles">
				<?php
				foreach ($travesia_tabs as $travesia_id=>$travesia_title) {
					?><li><a href="<?php echo esc_url(travesia_get_hash_link(sprintf('#%s_%s_content', $travesia_portfolio_filters_id, $travesia_id))); ?>" data-tab="<?php echo esc_attr($travesia_id); ?>"><?php echo esc_html($travesia_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$travesia_ppp = travesia_get_theme_option('posts_per_page');
			if (travesia_is_inherit($travesia_ppp)) $travesia_ppp = '';
			foreach ($travesia_tabs as $travesia_id=>$travesia_title) {
				$travesia_portfolio_need_content = $travesia_id==$travesia_portfolio_filters_active || !$travesia_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $travesia_portfolio_filters_id, $travesia_id)); ?>"
					class="portfolio_content travesia_tabs_content"
					data-blog-template="<?php echo esc_attr(travesia_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(travesia_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($travesia_ppp); ?>"
					data-post-type="<?php echo esc_attr($travesia_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($travesia_taxonomy); ?>"
					data-cat="<?php echo esc_attr($travesia_id); ?>"
					data-parent-cat="<?php echo esc_attr($travesia_cat); ?>"
					data-need-content="<?php echo (false===$travesia_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($travesia_portfolio_need_content) 
						travesia_show_portfolio_posts(array(
							'cat' => $travesia_id,
							'parent_cat' => $travesia_cat,
							'taxonomy' => $travesia_taxonomy,
							'post_type' => $travesia_post_type,
							'page' => 1,
							'sticky' => $travesia_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		travesia_show_portfolio_posts(array(
			'cat' => $travesia_cat,
			'parent_cat' => $travesia_cat,
			'taxonomy' => $travesia_taxonomy,
			'post_type' => $travesia_post_type,
			'page' => 1,
			'sticky' => $travesia_sticky_out
			)
		);
	}

	travesia_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>