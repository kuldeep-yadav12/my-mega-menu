<?php

    if (! defined('ABSPATH')) {
    exit;
    }

    class MMM_Image_Carousel_Widget extends \Elementor\Widget_Base
    {

    public function get_name()
    {
        return 'mmm-image-carousel';
    }

    public function get_title()
    {
        return 'Custom Image Carousel';
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['my-mega-menu'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Carousel Content',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => 'Image',
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label'   => 'Heading',

                'type'    => \Elementor\Controls_Manager::TEXT,

                'default' => 'Carousel Heading',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'   => 'Description',

                'type'    => \Elementor\Controls_Manager::TEXTAREA,

                'default' => 'Carousel description text.',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => 'Link',
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        $this->add_control(
            'slides',
            [
                'label'       => 'Slides',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [],
                'title_field' => '{{{ image.url ? "Image Slide" : "Slide" }}}',
            ]
        );

        $this->end_controls_section();
        // SETTINGS

        $this->start_controls_section(
            'section_settings',
            [
                'label' => 'Carousel Settings',
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label'           => 'Slides Per View',
                'type'            => \Elementor\Controls_Manager::NUMBER,
                'desktop_default' => 3.5,
                'tablet_default'  => 2.5,
                'mobile_default'  => 1.2,
                'min'             => 1,
                'max'             => 10,
                'step'            => 0.1,
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label'           => 'Space Between',
                'type'            => \Elementor\Controls_Manager::NUMBER,
                'desktop_default' => 20,
                'tablet_default'  => 15,
                'mobile_default'  => 10,
                'min'             => 0,
                'max'             => 100,
                'step'            => 1,
            ]
        );

        $this->add_control(
            'autoplay_desktop',
            [
                'label'        => 'Desktop Autoplay',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_tablet',
            [
                'label'        => 'Tablet Autoplay',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_mobile',
            [
                'label'        => 'Mobile Autoplay',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label'     => 'Autoplay Delay',
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'default'   => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'   => 'Autoplay Speed',
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 3000,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'        => 'Loop',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label'        => 'Navigation Arrows',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'        => 'Pagination Dots',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'lazyload',
            [
                'label'        => 'Lazyload',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => 'Pause on Hover',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'pause_on_interaction',
            [
                'label'        => 'Pause on Interaction',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label'   => 'Animation Speed',
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'   => 'Direction',
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => 'Left',
                    'right'      => 'Right',
                    'vertical'   => 'Vertical',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => 'Image',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
       
        /*
|--------------------------------------------------------------------------
| IMAGE STYLE CONTROLS
|--------------------------------------------------------------------------
*/

        $this->add_responsive_control(
            'image_height',
            [
                'label'      => 'Image Height',
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors'  => [

                    '{{WRAPPER}} .mmm-image-carousel'     =>
                    'height: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}} .swiper-wrapper'         =>
                    'height: 100%;',

                    '{{WRAPPER}} .swiper-slide'           =>
                    'height: 100%;',

                    '{{WRAPPER}} .mmm-carousel-image'     =>
                    'height: 100%;',

                    '{{WRAPPER}} .mmm-carousel-image img' =>
                    'height:100%; width:100%; object-fit:cover;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => 'Border Radius',

                'type'       =>
                \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors'  => [
                    '{{WRAPPER}} .mmm-carousel-image img' =>
                    'border-radius:
            {{TOP}}{{UNIT}}
            {{RIGHT}}{{UNIT}}
            {{BOTTOM}}{{UNIT}}
            {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'object_fit',
            [
                'label'     => 'Object Fit',
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'cover',

                'options'   => [
                    'cover'   => 'Cover',
                    'contain' => 'Contain',
                    'fill'    => 'Fill',
                ],

                'selectors' => [
                    '{{WRAPPER}} .mmm-carousel-image img' =>
                    'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

// add content style controls

         $this->start_controls_section(
            'content_style_section',
            [
                'label' => 'Content',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => 'Heading Color',

                'type' => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .mmm-carousel-title' =>
                    'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',

                'selector' =>
                '{{WRAPPER}} .mmm-carousel-title',
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => 'Description Color',

                'type' => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .mmm-carousel-description' =>
                    'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',

                'selector' =>
                '{{WRAPPER}} .mmm-carousel-description',
            ]
        );
$this->end_controls_section();

        /*
|--------------------------------------------------------------------------
| NAVIGATION STYLE SECTION
|--------------------------------------------------------------------------
*/

        $this->start_controls_section(
            'navigation_style_section',
            [
                'label' => 'Navigation',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        /*
|--------------------------------------------------------------------------
| PAGINATION
|--------------------------------------------------------------------------
*/

        $this->add_control(
            'pagination_heading',
            [
                'label' => 'Pagination',
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'pagination_position',
            [
                'label'   => 'Position',

                'type'    => \Elementor\Controls_Manager::SELECT,

                'default' => 'inside',

                'options' => [
                    'inside'  => 'Inside',
                    'outside' => 'Outside',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label'      => 'Space Between Dots',

                'type'       => \Elementor\Controls_Manager::SLIDER,

                'size_units' => ['px'],

                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],

                'selectors'  => [
                    '{{WRAPPER}} .swiper-pagination-bullet' =>
                    'margin: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_size',
            [
                'label'      => 'Size',

                'type'       => \Elementor\Controls_Manager::SLIDER,

                'size_units' => ['px'],

                'range'      => [
                    'px' => [
                        'min' => 4,
                        'max' => 30,
                    ],
                ],

                'selectors'  => [

                    '{{WRAPPER}} .swiper-pagination-bullet' =>

                    'width: {{SIZE}}{{UNIT}};
             height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => 'Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' =>
                    'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label'     => 'Active Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' =>
                    'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label'      => 'Arrow Size',

                'type'       => \Elementor\Controls_Manager::SLIDER,

                'size_units' => ['px'],

                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [

                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev'             =>
                    'width: {{SIZE}}{{UNIT}};
                     height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-button-next:after, {{WRAPPER}} .swiper-button-prev:after' =>
                    'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_position',
            [
                'label'   => 'Arrow Position',

                'type'    => \Elementor\Controls_Manager::SELECT,

                'default' => 'inside',

                'options' => [
                    'inside'  => 'Inside',
                    'outside' => 'Outside',
                ],
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => 'Arrow Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .swiper-button-next:after, {{WRAPPER}} .swiper-button-prev:after' =>

                    'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {

        $settings    = $this->get_settings_for_display();
        $carousel_id = 'mmm-carousel-' . $this->get_id();
        ?>

<div class="mmm-image-carousel-wrapper">

    <div class="swiper mmm-image-carousel
<?php echo esc_attr($carousel_id); ?>
<?php echo $settings['direction'] === 'vertical' ? ' vertical-mode' : ''; ?>
<?php echo $settings['arrow_position'] === 'outside' ? ' arrow-outside' : ''; ?>
<?php echo $settings['pagination_position'] === 'outside' ? ' pagination-outside' : ''; ?>">

        <div class="swiper-wrapper">

            <?php foreach ($settings['slides'] as $slide): ?>

                <div class="swiper-slide">

                    <div class="mmm-carousel-image">

                        <?php if (! empty($slide['link']['url'])): ?>

                            <a href="<?php echo esc_url($slide['link']['url']); ?>">

                        <?php endif; ?>

                        <img
                        src="<?php echo esc_url($slide['image']['url']); ?>"
                        alt=""
                        loading="lazy"
                    >

                        <?php if (! empty($slide['link']['url'])): ?>

                            </a>

                        <?php endif; ?>

                    </div>
                    <div class="mmm-carousel-content">

                        <?php if (! empty($slide['heading'])): ?>

                            <h3 class="mmm-carousel-title">
                                <?php echo esc_html($slide['heading']); ?>
                            </h3>

                        <?php endif; ?>

                        <?php if (! empty($slide['description'])): ?>

                            <div class="mmm-carousel-description">
                                <?php echo esc_html($slide['description']); ?>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>


        <?php if ($settings['navigation'] === 'yes'): ?>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        <?php endif; ?>


        <?php if ($settings['pagination'] === 'yes'): ?>

            <div class="swiper-pagination"></div>

        <?php endif; ?>

    </div>

</div>
<script>

document.addEventListener('DOMContentLoaded', function () {

    const carousel = document.querySelector('.<?php echo esc_js($carousel_id); ?>');

    if (!carousel || typeof Swiper === 'undefined') {
        return;
    }

    new Swiper(carousel, {

    speed: <?php echo intval($settings['animation_speed']); ?>,

            direction:
            '<?php echo $settings['direction'] === 'vertical'
                         ? 'vertical'
                         : 'horizontal'; ?>',
            mousewheel: true,

            lazy: <?php echo $settings['lazyload'] === 'yes'
                              ? '{ loadPrevNext: true }'
                              : 'false'; ?>,


        loop: <?php echo $settings['loop'] === 'yes'
                          ? 'true'
                          : 'false'; ?>,

        observer: true,
        observeParents: true,

        autoplay: {
            delay: <?php echo intval($settings['autoplay_speed']); ?>,

            disableOnInteraction:
            <?php echo $settings['pause_on_interaction'] === 'yes'
                        ? 'true'
                        : 'false'; ?>,

            pauseOnMouseEnter:
            <?php echo $settings['pause_on_hover'] === 'yes'
                        ? 'true'
                        : 'false'; ?>,
                        reverseDirection:
            <?php echo $settings['direction'] === 'right'
                        ? 'true'
                        : 'false'; ?>,
                    },

        navigation: <?php echo $settings['navigation'] === 'yes'
                                    ? json_encode([
                                    'nextEl' => '.' . $carousel_id . ' .swiper-button-next',
                                    'prevEl' => '.' . $carousel_id . ' .swiper-button-prev',
                            ])
                                : 'false'; ?>,

        pagination: <?php echo $settings['pagination'] === 'yes'
                                    ? json_encode([
                                    'el'        => '.' . $carousel_id . ' .swiper-pagination',
                                    'clickable' => true,
                            ])
                                : 'false'; ?>,

      breakpoints: {

    0: {
        slidesPerView: <?php echo ! empty($settings['slides_per_view_mobile'])
                                   ? floatval($settings['slides_per_view_mobile'])
                                   : 1.2; ?>,
                                   spaceBetween: <?php echo ! empty($settings['space_between_mobile'])
                                                             ? intval($settings['space_between_mobile'])
                                                             : 10; ?>,
                                                             autoplay: <?php echo $settings['autoplay_mobile'] === 'yes'
                                                                                   ? '{
                delay: ' . intval($settings['autoplay_delay']) . ',
                disableOnInteraction: false
            }'
                                                                                   : 'false'; ?>,
    },

    768: {
        slidesPerView: <?php echo ! empty($settings['slides_per_view_tablet'])
                                   ? floatval($settings['slides_per_view_tablet'])
                                   : 2.5; ?>,
                                    spaceBetween: <?php echo ! empty($settings['space_between_tablet'])
                                                              ? intval($settings['space_between_tablet'])
                                                              : 15; ?>,
                                                              autoplay: <?php echo $settings['autoplay_tablet'] === 'yes'
                                                                                    ? '{
                delay: ' . intval($settings['autoplay_delay']) . ',
                disableOnInteraction: false
            }'
                                                                                    : 'false'; ?>,
    },

    1024: {
        slidesPerView: <?php echo ! empty($settings['slides_per_view'])
                                   ? floatval($settings['slides_per_view'])
                                   : 3.5; ?>,
                                   spaceBetween: <?php echo ! empty($settings['space_between'])
                                                             ? intval($settings['space_between'])
                                                             : 20; ?>,
                                                             autoplay: <?php echo $settings['autoplay_desktop'] === 'yes'
                                                                                   ? '{
                delay: ' . intval($settings['autoplay_delay']) . ',
                disableOnInteraction: false
            }'
                                                                                   : 'false'; ?>,
    }

},

    });

});

</script>

<?php
}
}