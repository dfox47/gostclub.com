
<div class="lang_switcher">
	<div class="lang_switcher__current"><?php echo substr(get_bloginfo("language"), 0, 2); ?></div>

	<ul class="lang_switcher_list">
		<?php if (get_bloginfo("language") !== 'en-US') { ?>
			<li class="lang_switcher_list__item"><a class="lang_switcher_list__link" href="/en/">en</a></li>
		<?php } ?>

		<?php if (get_bloginfo("language") !== 'ru-RU') { ?>
			<li class="lang_switcher_list__item"><a class="lang_switcher_list__link" href="/ru/">ru</a></li>
		<?php } ?>

		<?php if (get_bloginfo("language") !== 'bg-BG') { ?>
			<li class="lang_switcher_list__item"><a class="lang_switcher_list__link" href="/">bg</a></li>
		<?php } ?>
	</ul>
</div>
