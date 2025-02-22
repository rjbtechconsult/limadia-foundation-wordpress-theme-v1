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
</head>

<body <?php body_class('has-side-panel side-panel-right fullwidth-page side-push-panel'); ?>>
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

