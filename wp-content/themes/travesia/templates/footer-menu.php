<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */

// Footer menu
$travesia_menu_footer = travesia_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($travesia_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php travesia_show_layout($travesia_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>