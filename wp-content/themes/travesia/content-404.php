<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( '404', 'travesia' ); ?></h1>
		<div class="page_info">
			<h1 class="page_subtitle"><?php esc_html_e('Oops...', 'travesia'); ?></h1>
			<p class="page_description"><?php echo wp_kses_post(__("We're sorry, but <br>something went wrong.", 'travesia')); ?></p>
			<a href="<?php echo esc_url(home_url('/')); ?>" class="sc_button color_style_default sc_button_default sc_button_size_normal"><?php esc_html_e('Homepage', 'travesia'); ?></a>
		</div>
	</div>
</article>
