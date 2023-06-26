<?php
/**
 * Plugin Name: Portfolio Extension
 * Description: Custom Widget for Portfolio Theme
 * Plugin URI:  https://ggs.com/
 * Version:     1.0.0
 * Author:      Vareshka
 * Author URI:  https://developers.elementor.com/
 * Text Domain: portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

function register_foundation_widget( $widgets_manager ) {
	require plugin_dir_path( __FILE__ ) . '/inc/portfolio-plugin.php';

	\Portfolio\Plugin::instance();
}
add_action( 'plugins_loaded', 'register_foundation_widget' );


add_action( 'elementor/editor/before_enqueue_scripts', function() { 
	wp_enqueue_style( 'font-awesome', plugins_url( '/elementor/assets/lib/font-awesome/css/all.css'), false); 
});
