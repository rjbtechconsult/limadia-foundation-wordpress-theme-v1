<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Limadia_Entity_Foundation_V1
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WL5BZMZS');</script>
	<!-- End Google Tag Manager -->

	<!-- Google AdSense -->
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8826698745914294" crossorigin="anonymous"></script>
	<!-- End Google AdSense -->
</head>

<body <?php body_class('has-side-panel side-panel-right fullwidth-page side-push-panel'); ?>>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WL5BZMZS"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>
<div class="body-overlay"></div>

<!-- Side panel -->
<?php include get_template_directory() . '/inc/side-panel.php'; ?>

<div id="wrapper" class="clearfix">

	<!-- preloader -->
	<?php include get_template_directory() . '/inc/preloader.php'; ?>
	
	<!-- Header -->
	<?php include get_template_directory() . '/inc/header-2.php'; ?>

	<!-- Main content -->
	<div class="main-content">

