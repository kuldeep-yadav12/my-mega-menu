<?php
    if (! defined('ABSPATH')) {
    exit;
    }

    class MMM_Accordion_Widget extends \Elementor\Widget_Base{
    public function get_name(){
        return 'mmm-custom-accordion';
    }

    public function get_title(){
        return 'Custom Accordion';
    }

    public function get_icon(){
        return 'eicon-accordion';
    }

    public function get_categories(){
        return ['my-mega-menu'];
    }

    public function get_keywords(){
        return ['accordion', 'faq', 'toggle', 'content'];
    }

    protected function register_controls(){
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Accordion',
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'accordion_title',
            [
                'label'       => 'Title',
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Accordion Title',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_content',
            [
                'label'   => 'Content',
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Accordion content goes here.',
            ]
        );

        $this->add_control(
            'accordion_items',
            [
                'label'       => 'Content',
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ accordion_title }}}',
                'default'     => [
                    [
                        'accordion_title'   => 'How Do I Know What Kind of Kidney Stones I Have?',
                        'accordion_content' => 'Your doctor can identify the type of kidney stone through urine, blood tests, or lab analysis of the stone.',
                    ],
                    [
                        'accordion_title'   => 'What Should I Do If I Think I Have Kidney Stones?',
                        'accordion_content' => 'You should contact your doctor immediately if you have severe pain, nausea, fever, or blood in urine.',
                    ],
                ],
            ]
        );

        $this->add_control(
            'keep_first_open',
            [
                'label'        => 'Keep first slide auto open?',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => 'Yes',
                'label_off'    => 'No',
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'faq_schema',
            [
                'label'        => 'Accordion FAQ Schema',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => 'Yes',
                'label_off'    => 'No',
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->end_controls_section();
    // Icon Section

        $this->start_controls_section(
            'section_icon',
            [
                'label' => 'Icon',
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'   => 'Icon Position',
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'right',
                'options' => [
                    'left'  => 'Left',
                    'right' => 'Right',
                ],
            ]
        );

        $this->add_control(
            'show_count',
            [
                'label'        => 'Show Loop Count',
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => 'Show',
                'label_off'    => 'Hide',
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->add_control(
            'right_icon',
            [
                'label'   => 'Closed Icon',
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'right_icon_active',
            [
                'label'   => 'Open Icon',
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();

    // Description Style
        $this->start_controls_section(
            'section_description_style',
            [
                'label' => 'Description',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .mmm-accordion-content',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => 'Color',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .mmm-accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    // Border Style
        $this->start_controls_section(
            'section_border_style',
            [
                'label' => 'Border',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => 'Border Color',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#e5e5e5',
                'selectors' => [
                    '{{WRAPPER}} .mmm-accordion-item' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label'      => 'Border Width',
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],

                'default'    => [
                    'size' => 1,
                    'unit' => 'px',
                ],

                'selectors'  => [
                    '{{WRAPPER}} .mmm-accordion-item' => 'border-bottom-width: {{SIZE}}{{UNIT}}; border-bottom-style: solid;',
                ],
            ]
        );

        $this->end_controls_section();

    // Transition Style
        $this->start_controls_section(
            'section_transition_style',
            [
                'label' => 'Transition',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label'      => 'Transition Duration',
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range'      => [
                    'ms' => [
                        'min'  => 0,
                        'max'  => 2000,
                        'step' => 50,
                    ],
                ],

                'default'    => [
                    'size' => 400,
                    'unit' => 'ms',
                ],

                'selectors'  => [
                    '{{WRAPPER}} .mmm-accordion-content' => 'transition-duration: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mmm-accordion-icon'    => 'transition-duration: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mmm-accordion-title'   => 'transition-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'transition_timing',
            [
                'label'     => 'Transition Timing Function',
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'ease',
                'options'   => [
                    'ease'        => 'Ease',
                    'linear'      => 'Linear',
                    'ease-in'     => 'Ease In',
                    'ease-out'    => 'Ease Out',
                    'ease-in-out' => 'Ease In Out',
                ],

                'selectors' => [
                    '{{WRAPPER}} .mmm-accordion-content' => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .mmm-accordion-icon'    => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .mmm-accordion-title'   => 'transition-timing-function: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    // Title Style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => 'Title',
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .mmm-accordion-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => 'Title Color',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#2D1B4E',
                'selectors' => [
                    '{{WRAPPER}} .mmm-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label'     => 'Active Title Color',
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#5B2C83',
                'selectors' => [
                    '{{WRAPPER}} .mmm-accordion-item.active .mmm-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
    protected function render(){
        $settings = $this->get_settings_for_display();
        $items = ! empty($settings['accordion_items']) ? $settings['accordion_items'] : [];
        if (empty($items)) {
            return;
        }
        echo '<div class="mmm-accordion-wrapper icon-' . esc_attr($settings['icon_position']) . '">';
        foreach ($items as $index => $item) {
            $active = ('yes' === $settings['keep_first_open'] && 0 === $index) ? ' active' : '';
            echo '<div class="mmm-accordion-item' . esc_attr($active) . '">';
            echo '<div class="mmm-accordion-header">';
            if ('yes' === $settings['show_count']) {
                echo '<span class="mmm-accordion-count">' . esc_html(str_pad($index + 1, 2, '0', STR_PAD_LEFT)) . '</span>';
            }
            echo '<span class="mmm-accordion-title">' . esc_html($item['accordion_title']) . '</span>';
            echo '<span class="mmm-accordion-icon">';
            echo '<span class="icon-default">';
            \Elementor\Icons_Manager::render_icon($settings['right_icon'], ['aria-hidden' => 'true']);
            echo '</span>';
            echo '<span class="icon-active">';
            \Elementor\Icons_Manager::render_icon($settings['right_icon_active'], ['aria-hidden' => 'true']);
            echo '</span>';
            echo '</span>';
            echo '</div>';
            echo '<div class="mmm-accordion-content">';
            echo wp_kses_post($item['accordion_content']);
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        ?>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.mmm-accordion-wrapper').forEach(function(wrapper){
        wrapper.querySelectorAll('.mmm-accordion-header').forEach(function(header){
            header.addEventListener('click', function(){
                const item = this.parentElement;
                if(item.classList.contains('active')) {
                    item.classList.remove('active');
                } else {
                    wrapper.querySelectorAll('.mmm-accordion-item').forEach(function(i){
                        i.classList.remove('active');
                    });
                    item.classList.add('active');
                }
            });
        });
    });
});
</script>
<?php
    }
}