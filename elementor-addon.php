<?php
/**
 * Plugin Name: Elementor Addon
 * Description: Simple hello world widgets for Elementor.
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 */

function register_hello_world_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hello-world-widget-1.php' );
	require_once( __DIR__ . '/widgets/hello-world-widget-2.php' );

	$widgets_manager->register( new \Elementor_Hello_World_Widget_1() );
	$widgets_manager->register( new \Elementor_Hello_World_Widget_2() );

}
add_action( 'elementor/widgets/register', 'register_hello_world_widget' );

function register_pricing_table_widget($widgets_manager){

	require_once( __DIR__ . '/widgets/pricing-widget.php' );

	$widgets_manager->register( new \Elementor_Pricing_Widget() );
}
add_action('elementor/widget/register', 'register_pricing_table_widget');

function widget_styles(){
	wp_enqueue_style("froala-css","https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.1/css/froala_blocks.min.css");
}
add_action('elementor/frontend/after_enqueue_styles','widget_styles');

function pricing_editor_assets(){
	wp_enqueue_script("pricing-editor-js",plugins_url("/assets/js/main.js",__FILE__),["jquery"],time(),true);
}
add_action('elementor/editor/after_enqueue_scripts','pricing_editor_assets');

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'first-category',
		[
			'title' => esc_html__( 'First Category', 'elementor-addon' ),
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'second-category',
		[
			'title' => esc_html__( 'Second Category', 'elementor-addon' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );