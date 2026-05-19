<?php
    /**
 * Mega Menu Widget Class
 * No "use Elementor..." — using full class names directly.
 */
    if (! defined('ABSPATH')) {
    exit;
    }
    class MMM_Mega_Menu_Widget extends \Elementor\Widget_Base
    {
    public function get_name()
    {
        return 'mmm-mega-menu';
    }
    public function get_title()
    {
        return 'Mega Menu';

    }

    public function get_icon()
    {

        return 'eicon-nav-menu';

    }

    public function get_categories()
    {

        return ['my-mega-menu'];

    }

    public function get_keywords()
    {

        return ['menu', 'mega', 'nav', 'navigation', 'header'];

    }

    // ─────────────────────────────────────────

    // CONTROLS — Elementor Panel Settings

    // ─────────────────────────────────────────

    protected function register_controls()
    {

        // ── SECTION: Menu Items ──

        $this->start_controls_section(

            'section_menu_items',

            [

                'label' => 'Menu Items',

                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

            ]

        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(

            'item_label',

            [

                'label'       => 'Menu Label',

                'type'        => \Elementor\Controls_Manager::TEXT,

                'default'     => 'Menu Item',

                'placeholder' => 'e.g. Home, About, Services',

                'label_block' => true,

            ]

        );

        $repeater->add_control(

            'item_link',

            [

                'label'   => 'Link',

                'type'    => \Elementor\Controls_Manager::URL,

                'default' => ['url' => '#'],

            ]

        );

        $repeater->add_control(

            'has_dropdown',

            [

                'label'        => 'Mega Dropdown Enable?',

                'type'         => \Elementor\Controls_Manager::SWITCHER,

                'label_on'     => 'Yes',

                'label_off'    => 'No',

                'return_value' => 'yes',

                'default'      => 'no',

            ]

        );

        $repeater->add_control(

            'dropdown_columns',

            [

                'label'     => 'Columns',

                'type'      => \Elementor\Controls_Manager::SELECT,

                'default'   => '3',

                'options'   => [

                    '1' => '1 Column',

                    '2' => '2 Columns',

                    '3' => '3 Columns',

                    '4' => '4 Columns',

                ],

                'condition' => ['has_dropdown' => 'yes'],

            ]

        );

        $repeater->add_control(

            'dropdown_content',

            [

                'label'     => 'Dropdown Content',

                'type'      => \Elementor\Controls_Manager::WYSIWYG,

                'default'   => '<h4>Column Heading</h4><ul><li><a href="#">Link 1</a></li><li><a href="#">Link 2</a></li><li><a href="#">Link 3</a></li></ul>',

                'condition' => ['has_dropdown' => 'yes'],

            ]

        );

        $this->add_control(

            'menu_items',

            [

                'label'       => 'Menu Items',

                'type'        => \Elementor\Controls_Manager::REPEATER,

                'fields'      => $repeater->get_controls(),

                'default'     => [

                    ['item_label' => 'Home', 'item_link' => ['url' => '#']],

                    ['item_label' => 'About', 'item_link' => ['url' => '#']],

                    ['item_label' => 'Services', 'item_link' => ['url' => '#'], 'has_dropdown' => 'yes'],

                ],

                'title_field' => '{{{ item_label }}}',

            ]

        );

        $this->end_controls_section();

        // ── SECTION: Layout ──

        $this->start_controls_section(

            'section_layout',

            [

                'label' => 'Layout',

                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,

            ]

        );

        $this->add_control(

            'menu_align',

            [

                'label'     => 'Menu Alignment',

                'type'      => \Elementor\Controls_Manager::CHOOSE,

                'options'   => [

                    'flex-start' => ['title' => 'Left', 'icon' => 'eicon-h-align-left'],

                    'center'     => ['title' => 'Center', 'icon' => 'eicon-h-align-center'],

                    'flex-end'   => ['title' => 'Right', 'icon' => 'eicon-h-align-right'],

                ],

                'default'   => 'flex-start',

                'selectors' => [

                    '{{WRAPPER}} .mmm-nav' => 'justify-content: {{VALUE}};',

                ],

            ]

        );

        $this->add_control(

            'dropdown_fullwidth',

            [

                'label'        => 'Full Width Dropdown?',

                'type'         => \Elementor\Controls_Manager::SWITCHER,

                'label_on'     => 'yes',

                'label_off'    => 'No',

                'return_value' => 'yes',

                'default'      => 'yes',

            ]

        );

        $this->end_controls_section();

        // ── STYLE: Nav Items ──

        $this->start_controls_section(

            'style_nav_items',

            [

                'label' => 'Nav Items Style',

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );

        $this->add_control(

            'item_color',

            [

                'label'     => 'Text Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'default'   => '#333333',

                'selectors' => [

                    '{{WRAPPER}} .mmm-nav > li > a' => 'color: {{VALUE}};',

                ],

            ]

        );

        $this->add_control(

            'item_hover_color',

            [

                'label'     => 'Hover Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'default'   => '#0073aa',

                'selectors' => [

                    '{{WRAPPER}} .mmm-nav > li > a:hover'      => 'color: {{VALUE}};',

                    '{{WRAPPER}} .mmm-nav > li.mmm-active > a' => 'color: {{VALUE}};',

                ],

            ]

        );

        $this->add_control(

            'item_bg_color',

            [

                'label'     => 'Background Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .mmm-nav > li > a' => 'background-color: {{VALUE}};',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Typography::get_type(),

            [

                'name'     => 'item_typography',

                'selector' => '{{WRAPPER}} .mmm-nav > li > a',

            ]

        );

        $this->add_control(

            'item_padding',

            [

                'label'      => 'Padding',

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em'],

                'default'    => [

                    'top'      => '15',

                    'right'    => '20',

                    'bottom'   => '15',

                    'left'     => '20',

                    'unit'     => 'px',

                    'isLinked' => false,

                ],

                'selectors'  => [

                    '{{WRAPPER}} .mmm-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_section();

        // ── STYLE: Dropdown ──

        $this->start_controls_section(

            'style_dropdown',

            [

                'label' => 'Dropdown Style',

                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

            ]

        );

        $this->add_control(

            'dropdown_bg',

            [

                'label'     => 'Dropdown Background',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'default'   => '#ffffff',

                'selectors' => [

                    '{{WRAPPER}} .mmm-dropdown' => 'background-color: {{VALUE}};',

                ],

            ]

        );

        $this->add_control(

            'dropdown_padding',

            [

                'label'      => 'Dropdown Padding',

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px'],

                'default'    => [

                    'top'      => '30',

                    'right'    => '30',

                    'bottom'   => '30',

                    'left'     => '30',

                    'unit'     => 'px',

                    'isLinked' => true,

                ],

                'selectors'  => [

                    '{{WRAPPER}} .mmm-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(

            \Elementor\Group_Control_Box_Shadow::get_type(),

            [

                'name'     => 'dropdown_shadow',

                'selector' => '{{WRAPPER}} .mmm-dropdown',

            ]

        );

        $this->add_control(

            'dropdown_border_radius',

            [

                'label'      => 'Border Radius',

                'type'       => \Elementor\Controls_Manager::DIMENSIONS,

                'size_units' => ['px'],

                'selectors'  => [

                    '{{WRAPPER}} .mmm-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_control(

            'dropdown_top_border_color',

            [

                'label'     => 'Top Border Color',

                'type'      => \Elementor\Controls_Manager::COLOR,

                'default'   => '#0073aa',

                'selectors' => [

                    '{{WRAPPER}} .mmm-dropdown' => 'border-top: 3px solid {{VALUE}};',

                ],

            ]

        );

        $this->end_controls_section();

    }

    // ─────────────────────────────────────────

    // RENDER — Frontend HTML output

    // ─────────────────────────────────────────

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $items = $settings['menu_items'];

        $fullw = (isset($settings['dropdown_fullwidth']) && $settings['dropdown_fullwidth'] === 'yes') ? ' mmm-fullwidth' : '';

        if (empty($items)) {

            echo '<p>There are no menu items. Add items in the Elementor panel.</p>';

            return;

        }

        ?>



        <nav class="mmm-wrapper" role="navigation" aria-label="Main Navigation">



            <ul class="mmm-nav">



                <?php foreach ($items as $item):

                                $has_drop = (isset($item['has_dropdown']) && $item['has_dropdown'] === 'yes');

                                $cols = isset($item['dropdown_columns']) ? intval($item['dropdown_columns']) : 3;

                                $link_url = ! empty($item['item_link']['url']) ? esc_url($item['item_link']['url']) : '#';

                                $target = ! empty($item['item_link']['is_external']) ? ' target="_blank" rel="noopener"' : '';

                        ?>



                    <li class="mmm-item<?php echo $has_drop ? ' has-dropdown' : ''; ?>">







                        <a href="<?php echo esc_url($link_url); ?>"<?php echo esc_url($link_url); ?>>



                            <span class="mmm-item-label"><?php echo esc_html($item['item_label']); ?></span>



                            <?php if ($has_drop): ?>



                                <span class="mmm-arrow" aria-hidden="true">&#9660;</span>



                            <?php endif; ?>



                        </a>







                        <?php if ($has_drop): ?>



                            <div class="mmm-dropdown<?php echo esc_attr($fullw); ?>">



                                <div class="mmm-dropdown-inner mmm-cols-<?php echo intval($cols); ?>">



                                    <?php echo wp_kses_post($item['dropdown_content']); ?>



                                </div>



                            </div>



                        <?php endif; ?>







                    </li>



                <?php endforeach; ?>



            </ul>



        </nav>



        <?php

                }

            }
