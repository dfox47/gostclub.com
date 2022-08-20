<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

if (travesia_sidebar_present()) {
	ob_start();
	$travesia_sidebar_name = travesia_get_theme_option('sidebar_widgets');
	travesia_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($travesia_sidebar_name) ) {
		dynamic_sidebar($travesia_sidebar_name);
	}
	$travesia_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($travesia_out)) {
		$travesia_sidebar_position = travesia_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($travesia_sidebar_position); ?> widget_area<?php if (!travesia_is_inherit(travesia_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(travesia_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'travesia_action_before_sidebar' );
				travesia_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $travesia_out));
				do_action( 'travesia_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>