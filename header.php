<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Themehunk
 * @subpackage  Bevro
 * @since 1.0.0
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<!-- layout class call -->
<?php 
$bevro_default_container    = get_theme_mod('bevro_default_container','boxed');
$bevro_main_header_layout   = get_theme_mod('bevro_main_header_layout','mhdrleft');
$bevro_above_header_layout  = get_theme_mod('bevro_above_header_layout','abv-two');
$bevro_bottom_header_layout = get_theme_mod('bevro_bottom_header_layout','abv-two');
// add-pro-feature
$bevro_container_site_layout = get_theme_mod('bevro_container_site_layout','fullwidth');
?>
<!-- layout class call -->
<body <?php body_class(array(esc_attr($bevro_default_container), esc_attr($bevro_main_header_layout), esc_attr($bevro_above_header_layout),esc_attr($bevro_container_site_layout))); ?>>
<?php wp_body_open();?>
<?php if(get_theme_mod('bevro_scroll_to_top_disable')==false):?>	
<input type="hidden" id="back-to-top" value="on"/>
<?php endif;?>
<?php if(get_theme_mod('bevro_stick_hide_scroll_down')==true):?>	
<input type="hidden" id="header-scroll-down-hide" value="on"/>
<?php endif;?>
<?php bevro_preloader();?>
<div id="page" class="bevro-site">
<?php do_action( 'bevro_before_header' ); ?>
<?php do_action( 'bevro_header'); ?> 
<?php do_action( 'bevro_after_header' ); ?>
