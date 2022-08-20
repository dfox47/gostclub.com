<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.10
 */

// Copyright area
$travesia_footer_scheme =  travesia_is_inherit(travesia_get_theme_option('footer_scheme')) ? travesia_get_theme_option('color_scheme') : travesia_get_theme_option('footer_scheme');
$travesia_copyright_scheme = travesia_is_inherit(travesia_get_theme_option('copyright_scheme')) ? $travesia_footer_scheme : travesia_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($travesia_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php

                $travesia_copyright = travesia_get_theme_option( 'copyright' );
			if ( ! empty( $travesia_copyright ) ) {
                // Replace {{Y}} or {Y} with the current year
                $travesia_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $travesia_copyright );
                // Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
                $travesia_copyright = travesia_prepare_macros( $travesia_copyright );
                // Display copyright
                echo wp_kses_post( nl2br( $travesia_copyright ) );
            }
			?>
			</div>
		</div>
	</div>
</div>
