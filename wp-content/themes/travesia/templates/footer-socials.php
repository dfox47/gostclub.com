<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */


// Socials
if ( travesia_is_on(travesia_get_theme_option('socials_in_footer')) && ($travesia_output = travesia_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php travesia_show_layout($travesia_output); ?>
		</div>
	</div>
	<?php
}
?>