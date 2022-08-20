<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

						// Widgets area inside page content
						travesia_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					travesia_create_widgets_area('widgets_below_page');

					$travesia_body_style = travesia_get_theme_option('body_style');
					if ($travesia_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$travesia_footer_type = travesia_get_theme_option("footer_type");
			if ($travesia_footer_type == 'custom' && !travesia_is_layouts_available())
				$travesia_footer_type = 'default';
			get_template_part( "templates/footer-{$travesia_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->



	<?php wp_footer(); ?>

</body>
</html>