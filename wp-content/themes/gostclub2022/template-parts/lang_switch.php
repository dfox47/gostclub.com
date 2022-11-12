<?php $currentLang = get_bloginfo("language"); ?>

<div class="lang_switcher">
	<div class="lang_switcher__current"><?php echo substr($currentLang, 0, 2); ?></div>

	<div class="lang_switcher_list">
		<?php if (function_exists('the_msls')) the_msls(); ?>
	</div>
</div>