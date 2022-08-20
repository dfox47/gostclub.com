<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

// Page (category, tag, archive, author) title

if ( travesia_need_page_title() ) {
	travesia_sc_layouts_showed('title', true);
	travesia_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$travesia_blog_title = travesia_get_blog_title();
							$travesia_blog_title_text = $travesia_blog_title_class = $travesia_blog_title_link = $travesia_blog_title_link_text = '';
							if (is_array($travesia_blog_title)) {
								$travesia_blog_title_text = $travesia_blog_title['text'];
								$travesia_blog_title_class = !empty($travesia_blog_title['class']) ? ' '.$travesia_blog_title['class'] : '';
								$travesia_blog_title_link = !empty($travesia_blog_title['link']) ? $travesia_blog_title['link'] : '';
								$travesia_blog_title_link_text = !empty($travesia_blog_title['link_text']) ? $travesia_blog_title['link_text'] : '';
							} else
								$travesia_blog_title_text = $travesia_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($travesia_blog_title_class); ?>"><?php
								$travesia_top_icon = travesia_get_category_icon();
								if (!empty($travesia_top_icon)) {
									$travesia_attr = travesia_getimagesize($travesia_top_icon);
									?><img src="<?php echo esc_url($travesia_top_icon); ?>" alt="<?php esc_attr__('Image', 'travesia')?>" <?php if (!empty($travesia_attr[3])) travesia_show_layout($travesia_attr[3]);?>><?php
								}
								echo wp_kses_data($travesia_blog_title_text);
							?></h1>
							<?php
							if (!empty($travesia_blog_title_link) && !empty($travesia_blog_title_link_text)) {
								?><a href="<?php echo esc_url($travesia_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($travesia_blog_title_link_text); ?></a><?php
							}

							// Post meta on the single post
							if ( is_single() )  {
								?><div class="sc_layouts_title_meta"><?php
								travesia_show_post_meta(apply_filters('travesia_filter_post_meta_args', array(
										'components' => 'categories,date,counters,edit',
										'counters' => 'views,comments,likes',
										'seo' => true
									), 'header', 1)
								);
								?></div><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'travesia_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>