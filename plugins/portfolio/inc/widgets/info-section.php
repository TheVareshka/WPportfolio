<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

class Elementor_Info_Section_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'info-section';
	}

	public function get_title() {
		return esc_html__( 'Info Section', 'elementor-foundation' );
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
				'label' => esc_html__( 'Info Content', 'elementor-foundation' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info_title',
			[
				'label' => esc_html__( 'Info Title', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor-foundation' ),
				'placeholder' => esc_html__( 'Type your subtitle here', 'elementor-foundation' ),
			]
		);

		$repeater->add_control(
			'info_text-one',
			[
				'label' => esc_html__( 'Info Text', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor-foundation' ),
				'placeholder' => esc_html__( 'Type your description here', 'elementor-foundation' ),
			]
		);
		$repeater->add_control(
			'info_text-two',
			[
				'label' => esc_html__( 'Info Text', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor-foundation' ),
				'placeholder' => esc_html__( 'Type your description here', 'elementor-foundation' ),
			]
		);
		$repeater->add_control(
			'info_text-three',
			[
				'label' => esc_html__( 'Info Text', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor-foundation' ),
				'placeholder' => esc_html__( 'Type your description here', 'elementor-foundation' ),
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
						'info_title' => '',
						'info_text-one' => '',
						'info_text-two' => '',
						'info_text-three' => '',
					],
				],
				'title_field' => esc_html__( 'Info Title', 'elementor-foundation' ),
			]
		);

		$this->end_controls_section();


		// Info Slider content section
		$this->start_controls_section(
			'info_slider_section',
			[
				'label' => esc_html__( 'Info Slider', 'elementor-foundation' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'info_slider-titile',
			[
				'label' => esc_html__( 'Info Text', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'elementor-foundation' ),
				'placeholder' => esc_html__( 'Type your description here', 'elementor-foundation' ),
			]
		);

		$info_slider_repeater = new \Elementor\Repeater();

		$info_slider_repeater->add_control(
			'info_slide_image',
			[
				'label' => esc_html__( 'Slide Image', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);

		$this->add_control(
			'info_slider_list',
			[
				'label' => esc_html__( 'Slide Images', 'elementor-foundation' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $info_slider_repeater->get_controls(),
				'default' => [
					[
						'info_slide_image' => '',
					],
				],
				'title_field' => 'Image',
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
		$count = 0;
		?>
		<main>
			<section class="info__section">
				<div class="container">
					<div class="info__wrapper">
						<?php foreach ( $settings['list'] as $item ) : ?>
							<div class="info__content">
								<h2 class="info__title <?php if ( $count === 2 ) {
									echo 'info__title-specific';
								} ?>"><?php echo esc_html( $item['info_title'] ); ?></h2>
								<div class="info__text">
									<p><?php echo esc_html( $item['info_text-one'] ); ?></p>
									<p><?php echo esc_html( $item['info_text-two'] ); ?></p>
									<p><?php echo esc_html( $item['info_text-three'] ); ?></p>
								</div>
							</div>
							<?php
							$count++;
						endforeach;
						?>
						<div class="info__slider-content">
							<h2 class="info__title"><?php echo esc_html( $settings['info_slider-titile'] ); ?></h2>
							<div class="info__swiper-inner">
								<div class="info__swiper-slider">
									<div class="swiper info__swiper-wrapper">
										<div class="swiper-wrapper">
											<?php foreach ( $settings['info_slider_list'] as $slide ) : ?>
												<div class="foto-slide swiper-slide">
													<img src="<?php echo esc_url( $slide['info_slide_image']['url'] ); ?>" alt="">
												</div>
											<?php endforeach; ?>
										</div>
									</div>
									<div class="info__swiper-button-prev"></div>
									<div class="info__swiper-button-next"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>
		<?php
	}
}
