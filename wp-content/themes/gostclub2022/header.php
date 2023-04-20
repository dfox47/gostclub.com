<!DOCTYPE html>

<html <?php language_attributes(); ?> <?php body_class(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
	<meta name="format-detection" content="telephone=no">

	<?php // favicon
	include_once "template-parts/favicon.php"; ?>

	<meta name="twitter:image" content="https://gostclub.com/wp-content/themes/gostclub2022/i/favicon/android-icon-192x192.png">
	<meta property="og:image" content="https://gostclub.com/wp-content/themes/gostclub2022/i/favicon/android-icon-192x192.png">
	<meta property="og:title" content="GOST Club">
	<meta property="og:url" content="https://gostclub.com/">

	<title><?php wp_title(''); ?></title>

	<?php wp_head(); ?>

	<link rel="stylesheet" href="/wp-content/themes/gostclub2022/style.css?v<?php echo(date("YmdH")); ?>">
</head>

<body class="lang_<?php echo substr(get_bloginfo("language"), 0, 2); ?>">
<?php // header
include "template-parts/head.php"; ?>

<?php if (is_active_sidebar('after_header')) : ?>
	<?php dynamic_sidebar('after_header'); ?>
<?php endif; ?>