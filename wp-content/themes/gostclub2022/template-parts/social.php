<?php // all options https://brokertop.ru/wp-admin/admin.php?page=theme-custom-options
//$whatsapp = esc_attr(get_option('broker_whatsapp'));
$i      = "/wp-content/themes/gostclub2022/i";
$icons  = $i . "/icons"; ?>

<ul class="social_links">
	<?php // whatsapp
//	if ( isset($whatsapp) ) { ?>
<!--		<li class="social_links__item">-->
<!--			<a class="social_links__link" href="//wa.me/--><?php //echo $whatsapp; ?><!--" target="_blank"></a>-->
<!--		</li>-->
<!--	--><?php //} ?>

	<li class="social_links__item">
		<a class="social_links__link" href="//www.instagram.com/gostclub.balkans/" target="_blank" title="instagram"><img src="<?php echo $icons; ?>/instagram.svg" alt="instagram" /></a>
	</li>

	<li class="social_links__item">
		<a class="social_links__link" href="//www.facebook.com/gostmagazine" target="_blank" title="facebook"><img src="<?php echo $icons; ?>/facebook.svg" alt="facebook" /></a>
	</li>
</ul>