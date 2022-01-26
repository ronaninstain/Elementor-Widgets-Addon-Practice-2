<?php

/**
 * Plugin Name: Elementor Currency Control
 * Description: Add new Elementor control for currencies selection.
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-currency-control
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

function register_hello_world_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/hello-world-widget-1.php');
	require_once(__DIR__ . '/widgets/hello-world-widget-2.php');

	$widgets_manager->register(new \Elementor_Hello_World_Widget_1());
	$widgets_manager->register(new \Elementor_Hello_World_Widget_2());
}
add_action('elementor/widgets/register', 'register_hello_world_widget');

function register_pricing_table_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/pricing-widget.php');

	$widgets_manager->register(new \Elementor_Pricing_Widget());
}
add_action('elementor/widgets/register', 'register_pricing_table_widget');

function register_progressbar_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/progressbar-widget.php');

	$widgets_manager->register(new \Elementor_Progressbar_Widget());
}
add_action('elementor/widgets/register', 'register_progressbar_widget');

function register_infobox_widget($widgets_manager){
	require_once(__DIR__ . '/widgets/infobox-widget.php');

	$widgets_manager->register(new \Elementor_Infobox_Widget());
}
add_action('elementor/widgets/register', 'register_infobox_widget');

function widget_styles()
{
	wp_register_style( 'froala-css', plugins_url( 'https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css', __FILE__ ) );
	wp_register_style( 'infobox-css', plugins_url( 'assets/css/infobox.css', __FILE__ ), [ 'external-framework' ] );
	wp_register_style( 'external-framework', plugins_url( 'https://use.fontawesome.com/releases/v5.0.7/css/all.css', __FILE__ ) );

	//wp_enqueue_style("froala-css", "https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css");
	wp_enqueue_style('infobox-css');
}
add_action('elementor/frontend/after_enqueue_styles', 'widget_styles');

function pricing_editor_assets()
{
	wp_enqueue_script("pricing-editor-js", plugins_url("/assets/js/main.js", __FILE__), ["jquery"], time(), true);
}
add_action('elementor/editor/after_enqueue_scripts', 'pricing_editor_assets');

function progressbar_assets()
{
	wp_enqueue_script('progressbar-js', plugins_url('assets/js/progressbar.min.js', __FILE__), null, time(), true);
	wp_enqueue_script('progressbar-helper-js', plugins_url('assets/js/scripts.js', __FILE__), null, time(), true);
}
add_action('elementor/frontend/after_enqueue_styles', 'progressbar_assets');

function add_elementor_widget_categories($elements_manager)
{

	$elements_manager->add_category(
		'first-category',
		[
			'title' => esc_html__('First Category', 'elementor-addon'),
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'second-category',
		[
			'title' => esc_html__('Second Category', 'elementor-addon'),
			'icon' => 'fa fa-plug',
		]
	);
}
add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');
