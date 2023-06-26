<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class Elementor_Icon_Widget extends \Elementor\Widget_Base {
    public function get_name() {
		return 'icon_widget';
	}

	public function get_title() {
		return esc_html__( 'Icon', 'elementor-foundation' );
	}

	public function get_icon() {
		return 'fa fa-bell';
        
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return [ 'foundation' ];
	}

	public function get_keywords() {
		return [ 'foundation', 'url', 'link' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Widget Data', 'elementor-foundation' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        
        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Social Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-google-plus',
					'fa fa-instagram',
					'fa fa-linkedin',
					'fa fa-pinterest',
					'fa fa-reddit',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-youtube',
				],
				'default' => 'fa fa-facebook',
			]
		);

        $this->add_control(
			'flaticon',
			[
				'label' => esc_html__( 'Social Icons', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => [
                    'fa fa-500px',
                    'fa fa-address-book',
				],
				'default' => 'fa fa-address-card',
			]
		);

        $this->add_control(
            'icon_title',
            [
                'label' => esc_html__('Icon Title', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your title here', 'elementor-foundation'),
            ]
        );

        $this->add_control(
            'icon_description',
            [
                'label' => esc_html__('Icon Description', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your title here', 'elementor-foundation'),
            ]
        );

		$this->end_controls_section();
	}

	public function get_script_depends(){
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			wp_register_script('foundations', plugins_url('/js/mains.js', __FILE__), ['elementor-frontend'], ' 1.0', true);
			return ['foundations'];
		}
		return [];
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
    ?>
        <div class="text-center">
            <span class="flaticon-piggy-bank d-block mb-3 display-3 text-secondary"></span>
            <h3 class="text-primary h4 mb-2"><?php echo esc_attr($settings['icon_title']); ?></h3>
            <p><?php echo esc_attr($settings['icon_description']); ?></p>
        </div>
    <?php
	}
}
