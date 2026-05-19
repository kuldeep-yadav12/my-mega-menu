<?php

    /**

 * Dual Color Heading Widget

 * Loads only within the `elementor/widgets/register` hook.

 * Therefore, `\Elementor\Widget_Base` is guaranteed to be available.

 */

    if (! defined('ABSPATH')) {

    exit;

    }

    class MMM_Dual_Heading_Widget extends \Elementor\Widget_Base
    {

    public function get_name()
    {return 'mmm-dual-heading';}

    public function get_title()
    {return 'Dual Color Heading';}

    public function get_icon()
    {return 'eicon-heading';}

    public function get_categories()
    {return ['my-mega-menu'];}

    public function get_keywords()
    {return ['heading', 'dual', 'color', 'title', 'text'];}

    protected function register_controls()
    {

        // ── CONTENT ──

        $this->start_controls_section('sec_content', [

            'label' => 'Heading Content',

            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

        ]);

        // Before Text

        $this->add_control('before_text', [

            'label'       => 'Before Text',

            'type'        => \Elementor\Controls_Manager::TEXT,

            'default'     => 'Best',

            'placeholder' => 'Before',

            'label_block' => true,

        ]);

        // Highlighted Text

        $this->add_control('highlighted_text', [

            'label'       => 'Highlighted Text',

            'type'        => \Elementor\Controls_Manager::TEXT,

            'default'     => 'Services',

            'placeholder' => 'Highlighted',

            'label_block' => true,

        ]);

        // After Text

        $this->add_control('after_text', [

            'label'       => 'After Text',

            'type'        => \Elementor\Controls_Manager::TEXT,

            'default'     => 'For You',

            'placeholder' => 'After',

            'label_block' => true,

        ]);

        // Heading Tag

        $this->add_control('heading_tag', [

            'label'   => 'HTML Tag',

            'type'    => \Elementor\Controls_Manager::SELECT,

            'default' => 'h2',

            'options' => [

                'h1' => 'H1',

                'h2' => 'H2',

                'h3' => 'H3',

                'h4' => 'H4',

                'h5' => 'H5',

                'h6' => 'H6',

                'p'  => 'Paragraph',

            ],

        ]);

        // Link

        $this->add_control('heading_link', [

            'label'   => 'Link (Optional)',

            'type'    => \Elementor\Controls_Manager::URL,

            'dynamic' => ['active' => true],

            'default' => ['url' => ''],

        ]);

        $this->end_controls_section();

        // ── STYLE: Heading ──

        $this->start_controls_section('style_heading', [

            'label' => 'Heading Style',

            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

        ]);

        // Alignment

        $this->add_responsive_control('heading_align', [

            'label'     => 'Alignment',

            'type'      => \Elementor\Controls_Manager::CHOOSE,

            'options'   => [

                'left'   => ['title' => 'Left', 'icon' => 'eicon-h-align-left'],

                'center' => ['title' => 'Center', 'icon' => 'eicon-h-align-center'],

                'right'  => ['title' => 'Right', 'icon' => 'eicon-h-align-right'],

            ],

            'default'   => 'left',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-wrap'    => 'text-align: {{VALUE}};',

                '{{WRAPPER}} .mmm-dh-heading' => 'justify-content: {{VALUE}};',

            ],

        ]);

        // Typography — before + after + heading

        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'heading_typo',

                'label'    => 'Typography',

                'selector' => '{{WRAPPER}} .mmm-dh-heading, {{WRAPPER}} .mmm-dh-before, {{WRAPPER}} .mmm-dh-after',

            ]

        );

        // Normal color

        $this->add_control('normal_color', [

            'label'     => 'Normal Text Color',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#333333',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-before' => 'color: {{VALUE}};',

                '{{WRAPPER}} .mmm-dh-after'  => 'color: {{VALUE}};',

            ],

        ]);

        // Space Between Words

        $this->add_control('heading_gap', [

            'label'      => 'Space Between Words',

            'type'       => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range'      => [

                'px' => [

                    'min' => 0,

                    'max' => 30,

                ],

            ],

            'default'    => [

                'size' => 8,

                'unit' => 'px',

            ],

            'selectors'  => [

                '{{WRAPPER}} .mmm-dh-heading' => 'gap: {{SIZE}}{{UNIT}};',

            ],

        ]);

        $this->end_controls_section();

        // ── STYLE: Highlighted Text ──

        $this->start_controls_section('style_highlighted', [

            'label' => 'Highlighted Text Style',

            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

        ]);

        // Highlighted color

        $this->add_control('highlighted_color', [

            'label'     => 'Text Color',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#0073aa',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-highlight' => 'color: {{VALUE}};',

            ],

        ]);

        // Highlighted typography

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [

            'name'     => 'highlighted_typo',

            'label'    => 'Typography (Override)',

            'selector' => '{{WRAPPER}} .mmm-dh-highlight',

        ]);

        // Style type

        $this->add_control('highlight_style', [

            'label'   => 'Highlight Style',

            'type'    => \Elementor\Controls_Manager::SELECT,

            'default' => 'none',

            'options' => [

                'none'       => 'Color',

                'underline'  => 'Underline',

                'background' => 'Background Box',

                'outline'    => 'Outline Box',

                'gradient'   => 'Gradient Text',

            ],

        ]);

        // Underline color

        $this->add_control('underline_color', [

            'label'     => 'Underline Color',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#0073aa',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-highlight.style-underline' => 'border-bottom-color: {{VALUE}};',

            ],

            'condition' => ['highlight_style' => 'underline'],

        ]);

        $this->add_control('underline_width', [

            'label'      => 'Underline Width',

            'type'       => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range'      => ['px' => ['min' => 1, 'max' => 10]],

            'default'    => ['size' => 3, 'unit' => 'px'],

            'selectors'  => [

                '{{WRAPPER}} .mmm-dh-highlight.style-underline' => 'border-bottom-width: {{SIZE}}{{UNIT}};',

            ],

            'condition'  => ['highlight_style' => 'underline'],

        ]);

        // Background color

        $this->add_control('highlight_bg_color', [

            'label'     => 'Background Color',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#e8f4fd',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-highlight.style-background' => 'background-color: {{VALUE}};',

            ],

            'condition' => ['highlight_style' => 'background'],

        ]);

        $this->add_control('highlight_bg_padding', [

            'label'      => 'Padding',

            'type'       => \Elementor\Controls_Manager::DIMENSIONS,

            'size_units' => ['px'],

            'default'    => [

                'top'      => '4',

                'right'    => '10',

                'bottom'   => '4',

                'left'     => '10',

                'unit'     => 'px',

                'isLinked' => false,

            ],

            'selectors'  => [

                '{{WRAPPER}} .mmm-dh-highlight.style-background' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                '{{WRAPPER}} .mmm-dh-highlight.style-outline'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

            ],

            'conditions' => [

                'relation' => 'or',

                'terms'    => [

                    [

                        'name'     => 'highlight_style',

                        'operator' => '==',

                        'value'    => 'background',

                    ],

                    [

                        'name'     => 'highlight_style',

                        'operator' => '==',

                        'value'    => 'outline',

                    ],

                ],

            ],

        ]);

        $this->add_control('highlight_bg_radius', [

            'label'      => 'Border Radius',

            'type'       => \Elementor\Controls_Manager::DIMENSIONS,

            'size_units' => ['px'],

            'default'    => [

                'top'      => '4',

                'right'    => '4',

                'bottom'   => '4',

                'left'     => '4',

                'unit'     => 'px',

                'isLinked' => true,

            ],

            'selectors'  => [

                '{{WRAPPER}} .mmm-dh-highlight.style-background' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                '{{WRAPPER}} .mmm-dh-highlight.style-outline'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

            ],

            'conditions' => [

                'relation' => 'or',

                'terms'    => [

                    [

                        'name'     => 'highlight_style',

                        'operator' => '==',

                        'value'    => 'background',

                    ],

                    [

                        'name'     => 'highlight_style',

                        'operator' => '==',

                        'value'    => 'outline',

                    ],

                ],

            ],

        ]);

        // Outline color

        $this->add_control('outline_color', [

            'label'     => 'Outline Border Color',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#0073aa',

            'selectors' => [

                '{{WRAPPER}} .mmm-dh-highlight.style-outline' => 'border-color: {{VALUE}};',

            ],

            'condition' => ['highlight_style' => 'outline'],

        ]);

        $this->add_control('outline_width', [

            'label'      => 'Border Width',

            'type'       => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['px'],

            'range'      => ['px' => ['min' => 1, 'max' => 5]],

            'default'    => ['size' => 2, 'unit' => 'px'],

            'selectors'  => [

                '{{WRAPPER}} .mmm-dh-highlight.style-outline' => 'border-width: {{SIZE}}{{UNIT}};',

            ],

            'condition'  => ['highlight_style' => 'outline'],

        ]);

        // Gradient colors

        $this->add_control('gradient_color_1', [

            'label'     => 'Gradient Color 1',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#0073aa',

            'condition' => ['highlight_style' => 'gradient'],

        ]);

        $this->add_control('gradient_color_2', [

            'label'     => 'Gradient Color 2',

            'type'      => \Elementor\Controls_Manager::COLOR,

            'default'   => '#00b4d8',

            'condition' => ['highlight_style' => 'gradient'],

        ]);

        $this->add_control('gradient_angle', [

            'label'      => 'Gradient Angle',

            'type'       => \Elementor\Controls_Manager::SLIDER,

            'size_units' => ['deg'],

            'range'      => [

                'deg' => [

                    'min' => 0,

                    'max' => 360,

                ],

            ],

            'default'    => [

                'size' => 90,

                'unit' => 'deg',

            ],

            'condition'  => ['highlight_style' => 'gradient'],

        ]);

        $this->end_controls_section();

    }

    protected function render()
    {

        $s = $this->get_settings_for_display();

        $before = isset($s['before_text']) ? sanitize_text_field($s['before_text']) : '';

        $highlighted = isset($s['highlighted_text']) ? sanitize_text_field($s['highlighted_text']) : '';

        $after = isset($s['after_text']) ? sanitize_text_field($s['after_text']) : '';

        $tag = isset($s['heading_tag']) ? sanitize_text_field($s['heading_tag']) : 'h2';

        $style = isset($s['highlight_style']) ? sanitize_text_field($s['highlight_style']) : 'none';

        $allowed_tags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p'];

        if (! in_array($tag, $allowed_tags, true)) {

            $tag = 'h2';

        }

        $link_open = '';

        $link_close = '';

        $link_attrs = '';

        if (! empty($s['heading_link']['url'])) {

            $link_attrs .= ' href="' . esc_url($s['heading_link']['url']) . '"';

            if (! empty($s['heading_link']['is_external'])) {
                $link_attrs .= ' target="_blank"';
            }

            if (! empty($s['heading_link']['nofollow'])) {
                $link_attrs .= ' rel="nofollow"';
            }

            $link_open  = '<a' . $link_attrs . '>';
            $link_close = '</a>';
        }

        $hl_class = 'mmm-dh-highlight';

        if ($style !== 'none') {

            $hl_class .= ' style-' . esc_attr($style);

        }

        $hl_style = '';

        if ($style === 'gradient') {

            $c1 = ! empty($s['gradient_color_1']) ? $s['gradient_color_1'] : '#0073aa';

            $c2 = ! empty($s['gradient_color_2']) ? $s['gradient_color_2'] : '#00b4d8';

            $angle = isset($s['gradient_angle']['size']) ? intval($s['gradient_angle']['size']) : 90;

            $hl_style = ' style="background: linear-gradient(' . $angle . 'deg, ' . esc_attr($c1) . ', ' . esc_attr($c2) . '); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;"';

        }

        ?>

        <div class="mmm-dh-wrap">

            <?php echo wp_kses_post($link_open); ?>



            <<?php echo esc_attr($tag); ?> class="mmm-dh-heading">

                <?php if (! empty($before)): ?>

                    <span class="mmm-dh-before"><?php echo esc_html($before); ?></span>

                <?php endif; ?>



                <?php if (! empty($highlighted)): ?>

                    <span class="<?php echo esc_attr($hl_class); ?>"<?php echo wp_kses_post($hl_style); ?>>

                        <?php echo esc_html($highlighted); ?>

                    </span>

                <?php endif; ?>



                <?php if (! empty($after)): ?>

                    <span class="mmm-dh-after"><?php echo esc_html($after); ?></span>

                <?php endif; ?>

            </<?php echo esc_attr($tag); ?>>



            <?php echo wp_kses_post($link_close); ?>

        </div>

        <?php

                }

        }