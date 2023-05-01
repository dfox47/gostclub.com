<?php $i    = esc_url(get_template_directory_uri()) . '/i';
$currentUrl = $_SERVER['REQUEST_URI']; ?>

<?php if (is_active_sidebar('footer')) : ?>
	<?php dynamic_sidebar('footer'); ?>
<?php endif; ?>

<footer class="footer">
	<div class="wrap">
		<div class="footer_copyright">
			<div class="footer_copyright__item"><a href="mailto:gost@gostclub.com" target="_blank">gost@gostclub.com</a></div>
			<div class="footer_copyright__item">ГОСТ клуб <?php echo(date("Y")); ?></div>
			<div class="footer_copyright__item">© All rights reserved</div>
		</div>

		<?php // social
		include "template-parts/social.php"; ?>
	</div>
</footer>

<!--LiveInternet counter-->
<a class="hidden" href="https://www.liveinternet.ru/click" target="_blank">
	<img id="licntA70C" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAEALAAAAAABAAEAAAIBTAA7" alt="">
</a>

<script>
	(function(d,s){d.getElementById("licntA70C").src="https://counter.yadro.ru/hit?t11.6;r"+escape(d.referrer)+
		((typeof(s)=="undefined")?"":";s"+s.width+"*"+s.height+"*"+
			(s.colorDepth?s.colorDepth:s.pixelDepth))+";u"+escape(d.URL)+
		";h"+escape(d.title.substring(0,150))+";"+Math.random()})
	(document,screen)</script>
<!--/LiveInternet-->

<?php // all scripts in one file with GULP ?>
<script src="/wp-content/themes/gostclub2022/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<!-- Google tag (gtag.js) -->
<script async src="//www.googletagmanager.com/gtag/js?id=G-F3E6L1LH3M"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-F3E6L1LH3M');
</script>

<?php wp_footer(); ?>

</body>
</html>