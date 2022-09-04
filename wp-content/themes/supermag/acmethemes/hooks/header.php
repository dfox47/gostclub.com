<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_set_global')) :
	function supermag_set_global() {
		// Getting saved values start
		$supermag_saved_theme_options = supermag_get_theme_options();
		$GLOBALS['supermag_customizer_all_values'] = $supermag_saved_theme_options;
	}
endif;

add_action( 'supermag_action_before_head', 'supermag_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_doctype' ) ) :
	function supermag_doctype() {?>
		<!DOCTYPE html><html <?php language_attributes(); ?>>
	<?php }
endif;

add_action( 'supermag_action_before_head', 'supermag_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_wp_head' ) ) :
	function supermag_before_wp_head() { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="<?php echo esc_url('http://gmpg.org/xfn/11')?>">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php }
endif;

add_action( 'supermag_action_before_wp_head', 'supermag_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_body_class' ) ) :
	function supermag_body_class( $supermagbody_classes ) {
		global $supermag_customizer_all_values;

		if ( 'boxed' == $supermag_customizer_all_values['supermag-default-layout'] ) {
			$supermagbody_classes[] = 'boxed-layout';
		}

		if ( 'no-image' == $supermag_customizer_all_values['supermag-blog-archive-layout'] ) {
			$supermagbody_classes[] = 'blog-no-image';
		}

		$supermagbody_classes[] = supermag_sidebar_selection();

		return $supermagbody_classes;
	}
endif;

add_action( 'body_class', 'supermag_body_class', 10, 1);

/**
 * Page start
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_page_start')) :

function supermag_page_start() { ?>
<div class="hfeed site">
<?php }
endif;
add_action( 'supermag_action_before', 'supermag_page_start', 15 );

/**
 * Skip to content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_skip_to_content' ) ) :
	function supermag_skip_to_content() { ?>
		<a class="skip-link screen-reader-text" href="#content" title="link"><?php esc_html_e( 'Skip to content', 'supermag' ); ?></a>
	<?php }
endif;

add_action( 'supermag_action_before_header', 'supermag_skip_to_content', 10 );

/**
 * Main header
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if (!function_exists('supermag_header')) :
	function supermag_header() {
		global $supermag_customizer_all_values; ?>

		<div class="header_new_wrap">
			<div class="wrap">
				<div class="header_new">
					<a href="javascript:void(0);">Sign in</a>

<!--					<a class="header_logo" href="/">G★ST</a>-->
					<a class="header_logo" href="/">GOST</a>

					<div class="header_right">
<!--						<a href="tel:+359888086900" target="_blank">+359(88)808-69-00</a>-->

						<span class="header_search_icon js-search-toggle"></span>

						<div class="header_lang_switcher">
							<div class="header_lang_switcher__current" data-x="<?php echo get_bloginfo("language"); ?>"><?php echo substr(get_bloginfo("language"), 0, 2); ?></div>

							<ul class="header_lang_switcher_list">
								<?php if (get_bloginfo("language") !== 'en-US') { ?>
									<li class="header_lang_switcher_list__item"><a class="header_lang_switcher_list__link" href="/en/">en</a></li>
								<?php } ?>

								<?php if (get_bloginfo("language") !== 'ru-RU') { ?>
									<li class="header_lang_switcher_list__item"><a class="header_lang_switcher_list__link" href="/ru/">ru</a></li>
								<?php } ?>

								<?php if (get_bloginfo("language") !== 'bg-BG') { ?>
									<li class="header_lang_switcher_list__item"><a class="header_lang_switcher_list__link" href="/">bg</a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>

				<ul class="countries_list">
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Romania</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Serbia</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Bosnia and Herzegovina</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Croatia</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Slovenia</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Kosovo</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Montenegro</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Albania</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Greece</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">North Macedonia</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Turkey</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Bulgaria</a></li>
					<li class="countries_list__item"><a class="countries_list__link" href="javascript:void(0);">Italy</a></li>
				</ul>
			</div>
		</div>

		<div class="hero_slider">
			<div class="js-owl-carousel owl-carousel">
				<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/1.jpg);"></div>
				<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/2.jpg);"></div>
				<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/3.jpg);"></div>
				<div class="hero_slider__item" style="background-image: url(/wp-content/themes/supermag/assets/img/hero_slider/5.jpg);"></div>
			</div>
		</div>

		<header id="masthead" class="site-header" role="banner">
			<div class="top-header-section clearfix">
				<div class="wrapper">
					<?php if (1 == $supermag_customizer_all_values['supermag-show-date']) {
						echo ' <div class="header-latest-posts float-left bn-title">';
						supermag_date_display();
						echo "</div>";
					}

					if ( 1 == $supermag_customizer_all_values['supermag-enable-breaking-news'] ) {
						$recent_args = array(
							'numberposts' => 5,
							'post_status' => 'publish',
						);
						$recent_posts = wp_get_recent_posts($recent_args);

						if ( !empty( $recent_posts ) ):
							if ( !empty( $supermag_customizer_all_values['supermag-breaking-news-title'] ) ){
								$bn_title = $supermag_customizer_all_values['supermag-breaking-news-title'];
							}
							else {
								$bn_title = __( 'Recent posts', 'supermag' );
							} ?>

							<div class="header-latest-posts bn-wrapper float-left">
								<div class="bn-title">
									<?php echo esc_html( $bn_title ); ?>
								</div>

								<ul class="bn">
									<?php foreach ($recent_posts as $recent): ?>
										<li class="bn-content">
											<a href="<?php echo esc_url( get_permalink($recent["ID"]) ); ?>" title="<?php echo esc_attr($recent['post_title']); ?>">
												<?php echo esc_html( $recent['post_title'] ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div> <!-- .header-latest-posts -->
						<?php endif;
					} ?>
				</div>
			</div><!-- .top-header-section -->

			<div class="wrapper header-wrapper clearfix">
				<div class="header-container">
					<div class="site-branding clearfix">
						<?php if ( 'disable' != $supermag_customizer_all_values['supermag-header-id-display-opt'] ):?>
						<div class="site-logo float-left">
							<?php if ( 'logo-only' == $supermag_customizer_all_values['supermag-header-id-display-opt'] ):
								if( !empty( $supermag_customizer_all_values['supermag-header-logo'] ) ):
									$supermag_header_alt = $supermag_customizer_all_values['supermag-header-alt']; ?>

									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-logo'] ); ?>" alt="<?php echo esc_attr( $supermag_header_alt ); ?>">
									</a>
								<?php
								endif;/*supermag-header-logo*/
							else:/*else is title-only or title-and-tagline*/
								if ( is_front_page() && is_home() ) : ?>
									<h1 class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									</h1>
								<?php else : ?>
									<p class="site-title">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
									</p>
								<?php endif;

								if ( 'title-and-tagline' == $supermag_customizer_all_values['supermag-header-id-display-opt'] ):
									$description = get_bloginfo( 'description', 'display' );
									if ( $description || is_customize_preview() ) : ?>
										<p class="site-description"><?php echo esc_html( $description ); ?></p>
									<?php endif;
								endif;
							endif; ?>
						</div><!--site-logo-->
						<?php endif;?><!--supermag-header-id-display-opt-->

						<?php if ( !empty( $supermag_customizer_all_values['supermag-header-main-banner-ads'] )):
							$supermag_header_main_banner_ads_link = $supermag_customizer_all_values['supermag-header-main-banner-ads-link']; ?>

							<div class="header-ads float-right">
								<a href="<?php echo esc_url( $supermag_header_main_banner_ads_link ); ?>" target="_blank">
									<img src="<?php echo esc_url( $supermag_customizer_all_values['supermag-header-main-banner-ads'] )?>">
								</a>
							</div>
						<?php endif; ?>

						<div class="clearfix"></div>
					</div>

					<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
						<div class="header-main-menu clearfix">
							<?php if( has_nav_menu( 'primary' ) ) {
								if ( 1 == $supermag_customizer_all_values['supermag-menu-show-home-icon'] ) {
									if ( is_front_page() ) {
										$home_icon_class = 'home-icon front_page_on';
									}
									else {
										$home_icon_class = 'home-icon';
									} ?>

									<div class="<?php echo esc_attr( $home_icon_class ); ?>">
										<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><i class="fa fa-home"></i></a>
									</div>
								<?php } ?>

								<?php wp_nav_menu(array('theme_location' => 'primary','container' => 'div', 'container_class' => 'acmethemes-nav')); ?>

								<?php if ( isset( $supermag_customizer_all_values['supermag-menu-show-search']) && $supermag_customizer_all_values['supermag-menu-show-search'] == 1 ):
									get_search_form();
								endif;
							}
							else { ?>
								<div class="sm-default-menu">
									<?php _e('Goto Appearance > Menus -: for setting up menu ','supermag'); ?>
								</div>
							<?php } ?>
						</div>

						<div class="responsive-slick-menu clearfix"></div>
					</nav>
					<!-- #site-navigation -->
				</div>
				<!-- .header-container -->
			</div>
			<!-- header-wrapper-->
		</header>
		<!-- #masthead -->
		<?php
	}
endif;

add_action( 'supermag_action_header', 'supermag_header', 10 );

/**
 * Before main content
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_before_content' ) ) :
	function supermag_before_content() { ?>
		<div class="wrapper content-wrapper clearfix">
		<?php global $supermag_customizer_all_values;
		$supermag_enable_feature = $supermag_customizer_all_values['supermag-enable-feature'];
		if ( is_front_page() && !is_home() && 1 == $supermag_enable_feature ) {
			echo '<div class="slider-feature-wrap clearfix">';
			/*Slide*/
			/**
			 * supermag_action_feature_slider
			 * @since supermag 1.1.0
			 *
			 * @hooked supermag_feature_slider -  0
			 */
			do_action('supermag_action_feature_slider');

			/*Featured Post Beside Slider*/
			/**
			 * supermag_action_feature_side
			 * @since supermag 1.1.0
			 *
			 * @hooked supermag_feature_side-  0
			 */
			do_action('supermag_action_feature_side');
			echo "</div>";
			$supermag_content_id = "home-content";
		}
		else {
			$supermag_content_id = "content";
		} ?>
	<div id="<?php echo esc_attr( $supermag_content_id ); ?>" class="site-content">
		<?php if( 1 == $supermag_customizer_all_values['supermag-show-breadcrumb'] ){
			supermag_breadcrumbs();
		}
	}
endif;

add_action( 'supermag_action_after_header', 'supermag_before_content', 10 );
