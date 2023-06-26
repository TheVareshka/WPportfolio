<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class Elementor_Header_Section_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'header-section';
	}

	public function get_title() {
		return esc_html__( 'Header Section Slider', 'elementor-foundation' );
	}

	public function get_icon() {
		return 'fa fa-arrows-alt';
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return [ 'portfolio' ];
	}

	public function get_keywords() {
		return [ 'portfolio', 'url', 'link' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Slider Images', 'elementor-foundation' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
	
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'portfolio-image',
			[
				'label' => esc_html__( 'Image', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$repeater->add_control(
			'portfolio-repeat-image',
			[
				'label' => esc_html__( 'Duplicate Image', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'portfolio-image' => '',
						'portfolio-image' => '',
					],
				],
				'title_field' => esc_html__( 'Slider Image', 'elementor-foundation' ),
			]
		);

		$this->end_controls_section();


		//Header Info
		$this->start_controls_section(
			'headerinfo_section',
			[
				'label' => esc_html__( 'Header Info', 'elementor-foundation' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
            'header_title',
            [
                'label' => esc_html__('Header Title', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your title here', 'elementor-foundation'),
            ]
        );

		$this->add_control(
            'header_subtitle',
            [
                'label' => esc_html__('Header Sub Title', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your subtitle here', 'elementor-foundation'),
            ]
        );

		$this->add_control(
            'header_description',
            [
                'label' => esc_html__('Header Description', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your description here', 'elementor-foundation'),
            ]
        );

		$this->add_control(
            'header_subdescription',
            [
                'label' => esc_html__('Header Sub Description', 'elementor-foundation'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('', 'elementor-foundation'),
                'placeholder' => esc_html__('Type your subdescription here', 'elementor-foundation'),
            ]
        );

		$this->end_controls_section();
	}


	public function get_script_depends(){
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			wp_register_script('portfolio', plugins_url('/js/mains.js', __FILE__), ['elementor-frontend'], ' 1.0', true);
			return ['portfolio'];
		}
		return [];
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="header__info">
			<div class="header__info-slider">
				<div class="swiper  header__swiper-slider">
					<div class="swiper-wrapper ">
						
						<?php foreach ( $settings['list'] as $item ) : ?>
							<div class="swiper-slide">
								<img class="header__swiper-img" src="<?php echo $item['portfolio-image']['url']; ?>" alt="Slide" >
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper header__swiper-slider-mini">
					<div class="swiper-wrapper">
						<?php foreach ( $settings['list'] as $item ) : ?>
							<div class="swiper-slide">
								<img src="<?php echo $item['portfolio-repeat-image']['url']; ?>" alt="Slide" >
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="header__slider-button">
					<div class="header__swiper-button-prev"></div>
					<div class="header__swiper-button-next"></div>
				</div>
			</div>
			<div class="header__info-about">
				<h2 class="header__info-heading"><?php echo $settings['header_title']; ?></h2>
				<p class="header__info-position"><?php echo $settings['header_subtitle']; ?></p>
				<p class="header__info-description"><?php echo $settings['header_description']; ?></p>
				<p class="header__info-achievements"><?php echo $settings['header_subdescription']; ?></p>
			</div>
		</div>
	</div>
</header>
		<?php
	}
}
