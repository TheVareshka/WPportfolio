<?php
namespace Portfolio;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Plugin {
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.7.0';
	const MINIMUM_PHP_VERSION = '7.4';

	private static $_instance = null;

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	public function is_compatible() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-foundation' ),
			'<strong>' . esc_html__( 'Elementor Foundation', 'elementor-foundation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-foundation' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-foundation' ),
			'<strong>' . esc_html__( 'Elementor Foundation', 'elementor-foundation' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-foundation' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-foundation' ),
			'<strong>' . esc_html__( 'Elementor Test Addon', 'elementor-foundation' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-foundation' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function init() {
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		//add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
	}

	//Add our Category
	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'portfolio',
			[
				'title' => esc_html__( 'Portfolio Category', 'portfolio' ),
				'icon' => 'fa fa-medkit',
			],
			
		);
	}

	public function register_widgets( $widgets_manager ) {

		require_once( __DIR__ . '/widgets/header-section.php' );
		require_once( __DIR__ . '/widgets/info-section.php' );
		// require_once( __DIR__ . '/widgets/elementor-slider-widget.php' );


		// $widgets_manager->register_widget_type( new \Elementor_Slider_Widget() );
		$widgets_manager->register_widget_type( new \Elementor_Header_Section_Widget() );
		$widgets_manager->register_widget_type( new \Elementor_Info_Section_Widget() );

	}
}