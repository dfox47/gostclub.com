<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */

// Footer sidebar
$travesia_footer_name = travesia_get_theme_option('footer_widgets');
$travesia_footer_present = !travesia_is_off($travesia_footer_name) && is_active_sidebar($travesia_footer_name);
if ($travesia_footer_present) { 
	travesia_storage_set('current_sidebar', 'footer');
	$travesia_footer_wide = travesia_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($travesia_footer_name) ) {
		dynamic_sidebar($travesia_footer_name);
	}
	$travesia_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($travesia_out)) {
		$travesia_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $travesia_out);
		$travesia_need_columns = true;
		if ($travesia_need_columns) {
			$travesia_columns = max(0, (int) travesia_get_theme_option('footer_columns'));
			if ($travesia_columns == 0) $travesia_columns = min(4, max(1, substr_count($travesia_out, '<aside ')));
			if ($travesia_columns > 1)
				$travesia_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($travesia_columns).' widget ', $travesia_out);
			else
				$travesia_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($travesia_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$travesia_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($travesia_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'travesia_action_before_sidebar' );
				travesia_show_layout($travesia_out);
				do_action( 'travesia_action_after_sidebar' );
				if ($travesia_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$travesia_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>