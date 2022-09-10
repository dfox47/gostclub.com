
<!DOCTYPE html>

<html <?php language_attributes(); ?> <?php body_class(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no" />
	<meta name="format-detection" content="telephone=no" />

	<?php // favicon
	include "template-parts/favicon.php"; ?>

	<title><?php wp_title(''); ?></title>

	<?php wp_head(); ?>

	<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/style.css?v<?php echo(date("YmdHis")); ?>" />
</head>

<body>
<?php // header
include "template-parts/head.php"; ?>

<?php if (is_active_sidebar('after_header')) : ?>
	<?php dynamic_sidebar('after_header'); ?>
<?php endif; ?>
