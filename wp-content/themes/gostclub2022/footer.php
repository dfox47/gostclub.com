
<?php
$i          = esc_url(get_template_directory_uri()) . '/i';
$currentUrl = $_SERVER['REQUEST_URI'];
?>

<?php if (is_active_sidebar('footer')) : ?>
	<?php dynamic_sidebar('footer'); ?>
<?php endif; ?>

<footer class="footer">
	<div class="hidden wrap">
		<div class="footer_wrap2">
			<div class="footer_wrap">
				<?php // footer_menu
				wp_nav_menu(array(
					'container'         => false,
					'depth'             => 2,
					'item_spacing'      => 'preserve',
					'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
					'menu'              => 'footer_menu',
					'menu_class'        => 'footer_menu',
				)); ?>
			</div>
		</div>
	</div>
</footer>

<?php // all scripts in one file with GULP ?>
<script src="<?php echo esc_url(get_template_directory_uri()); ?>/all.min.js?v<?php echo(date("Ymd")); ?>"></script>

<?php wp_footer(); ?>

</body>
</html>
