
<?php
$i          = esc_url(get_template_directory_uri()) . '/i';
$currentUrl = $_SERVER['REQUEST_URI'];
?>

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
	</div>
</footer>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>
