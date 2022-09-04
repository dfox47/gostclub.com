<?php
/**
 * content and content wrapper end
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_after_content' ) ) :
	function supermag_after_content() { ?>
		</div><!-- #content -->
		</div><!-- content-wrapper-->
	<?php }
endif;

add_action( 'supermag_action_after_content', 'supermag_after_content', 10 );

/**
 * Footer content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_footer' ) ) :

	function supermag_footer() {
		global $supermag_customizer_all_values; ?>

		<div class="clearfix"></div>

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrapper footer-wrapper">
				<div class="top-bottom">
					<div id="footer-top">
						<div class="footer-columns">
							<?php if( is_active_sidebar( 'footer-col-one' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-one' ); ?>
								</div>
							<?php endif; ?>

							<?php if( is_active_sidebar( 'footer-col-two' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-two' ); ?>
								</div>
							<?php endif; ?>

							<?php if( is_active_sidebar( 'footer-col-three' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-three' ); ?>
								</div>
							<?php endif; ?>
							<div class="clear"></div>
						</div>
					</div><!-- #foter-top -->

					<div class="clearfix"></div>
				</div><!-- top-bottom-->

				<div class="footer_copyright">
<!--					<div class="footer_copyright__item"><a href="tel:+359888086900" target="_blank">+359 888086900</a></div>-->
					<div class="footer_copyright__item"><a href="mailto:gost@gostclub.com" target="_blank">gost@gostclub.com</a></div>
					<div class="footer_copyright__item">ГОСТ клуб <?php echo date("Y"); ?></div>
					<div class="footer_copyright__item">© All rights reserved</div>
				</div>
			</div>
		</footer>
	<?php }
endif;

add_action( 'supermag_action_footer', 'supermag_footer', 10 );

/**
 * Page end
 *
 * @since supermag 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_page_end' ) ) :
	function supermag_page_end() { ?>
		</div><!-- #page -->
	<?php }
endif;

add_action( 'supermag_action_after', 'supermag_page_end', 10 ); ?>

<?php $themeFolderJs = '/wp-content/themes/supermag/assets/js'; ?>

<script src="<?php echo $themeFolderJs; ?>/jquery-3.6.0.min.js"></script>
<script src="<?php echo $themeFolderJs; ?>/owl.carousel.min.js"></script>
<script src="<?php echo $themeFolderJs; ?>/custom.js"></script>
