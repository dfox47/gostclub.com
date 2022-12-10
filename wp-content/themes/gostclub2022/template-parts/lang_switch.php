<div class="lang_switcher">
	<div class="lang_switcher__current"><?php echo substr(get_bloginfo("language"), 0, 2); ?></div>

	<div class="lang_switcher_list">
		<?php if (function_exists('the_msls')) the_msls(); ?>
	</div>
</div>