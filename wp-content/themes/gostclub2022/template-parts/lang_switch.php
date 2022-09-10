
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
