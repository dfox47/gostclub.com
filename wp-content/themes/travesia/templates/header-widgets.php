<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

// Header sidebar
$travesia_header_name = travesia_get_theme_option('header_widgets');
$travesia_header_present = !travesia_is_off($travesia_header_name) && is_active_sidebar($travesia_header_name);
if ($travesia_header_present) { 
	travesia_storage_set('current_sidebar', 'header');
	$travesia_header_wide = travesia_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($travesia_header_name) ) {
		dynamic_sidebar($travesia_header_name);
	}
	$travesia_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($travesia_widgets_output)) {
		$travesia_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $travesia_widgets_output);
		$travesia_need_columns = strpos($travesia_widgets_output, 'columns_wrap')===false;
		if ($travesia_need_columns) {
			$travesia_columns = max(0, (int) travesia_get_theme_option('header_columns'));
			if ($travesia_columns == 0) $travesia_columns = min(6, max(1, substr_count($travesia_widgets_output, '<aside ')));
			if ($travesia_columns > 1)
				$travesia_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($travesia_columns).' widget ', $travesia_widgets_output);
			else
				$travesia_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($travesia_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$travesia_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($travesia_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'travesia_action_before_sidebar' );
				travesia_show_layout($travesia_widgets_output);
				do_action( 'travesia_action_after_sidebar' );
				if ($travesia_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$travesia_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>