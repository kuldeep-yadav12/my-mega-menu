<?php
    /**
 * MMM_Nav_Widget
 * Important: This file is loaded only within Elementor/Widgets/Register Hooks.
 * Therefore, `\Elementor\Widget_Base` is guaranteed to be available.
 */

    if (! defined('ABSPATH')) {
    exit;
    }

    class MMM_Nav_Widget extends \Elementor\Widget_Base
    {
    public function get_name()
    {
        return 'mmm-nav';
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
        return ['menu', 'mega', 'nav', 'navigation'];
    }

    private function get_menus()
    {
        $menus  = wp_get_nav_menus();
        $result = [];
        foreach ($menus as $m) {
            $result[$m->term_id] = $m->name;
        }
        return $result;
    }

    protected function register_controls()
    {
        // ── CONTENT: Menu Settings ──
        $this->start_controls_section('sec_menu', [
            'label' => 'Menu Settings',
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $menus = $this->get_menus();

        if (! empty($menus)) {
            $this->add_control('menu_id', [
                'label'       => 'Select Menu',
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => $menus,
                'default'     => array_keys($menus)[0],
                'label_block' => true,
            ]);
        } else {
            $this->add_control('no_menu', [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw'  => '<p style="color:#c00">No menu found. <a href="' . admin_url('nav-menus.php') . '" target="_blank">Create a menu.</a></p>',
            ]);
        }

        $this->add_control('dropdown_trigger', [
            'label'   => 'Dropdown Open As',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'hover',
            'options' => ['hover' => 'Hover', 'click' => 'Click'],
        ]);

        $this->add_control('submenu_indicator', [
            'label'   => 'Submenu Indicator',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'arrow',
            'options' => [
                'none'    => 'None',
                'arrow'   => 'Arrow',
                'chevron' => 'Chevron',
                'plus'    => 'Plus',
            ],
        ]);

        $this->add_control('dropdown_fullwidth', [
            'label'        => 'Full Width Dropdown?',
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => 'Yes',
            'label_off'    => 'No',
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('breakpoint', [
            'label'   => 'Responsive Breakpoint',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'mobile',
            'options' => [
                'mobile' => 'Mobile (768px)',
                'tablet' => 'Tablet (1024px)',
                'none'   => 'None',
            ],
        ]);

        $this->add_control('toggle_button', [
            'label'   => 'Toggle Button',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'hamburger',
            'options' => [
                'hamburger' => 'Hamburger',
                'icon'      => 'Icon',
            ],
        ]);

        $this->add_control('hamburger_icon', [
            'label'     => 'Icon',
            'type'      => \Elementor\Controls_Manager::ICONS,
            'default'   => [
                'value'   => 'fas fa-bars',
                'library' => 'fa-solid',
            ],

            'condition' => [
                'toggle_button' => 'icon',
            ],
        ]);

        $this->add_control('hamburger_icon_hover', [
            'label'     => 'Icon Hover State',
            'type'      => \Elementor\Controls_Manager::ICONS,
            'default'   => [
                'value'   => 'fas fa-bars',
                'library' => 'fa-solid',
            ],

            'condition' => [
                'toggle_button' => 'icon',
            ],
        ]);

        $this->add_control('hamburger_icon_active', [
            'label'     => 'Icon Open State',
            'type'      => \Elementor\Controls_Manager::ICONS,
            'default'   => [
                'value'   => 'fas fa-times',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'toggle_button' => 'icon',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_nav', [
            'label' => 'Nav Items',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('nav_align', [
            'label'     => 'Alignment',
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
        ]);

        $this->start_controls_tabs('nav_tabs');
        $this->start_controls_tab('nav_normal', ['label' => 'Normal']);
        $this->add_control('nav_color', [
            'label'     => 'Text Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => ['{{WRAPPER}} .mmm-nav > li > a' => 'color: {{VALUE}};'],
        ]);

        $this->add_control('nav_bg', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .mmm-nav > li > a' => 'background-color: {{VALUE}};'],
        ]);

        $this->end_controls_tab();
        $this->start_controls_tab('nav_hover', ['label' => 'Hover']);
        $this->add_control('nav_hover_color', [
            'label'     => 'Text Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#0073aa',
            'selectors' => [
                '{{WRAPPER}} .mmm-nav > li > a:hover'    => 'color: {{VALUE}};',
                '{{WRAPPER}} .mmm-nav > li.mmm-open > a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('nav_hover_bg', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .mmm-nav > li > a:hover'    => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .mmm-nav > li.mmm-open > a' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'nav_typo',
            'selector' => '{{WRAPPER}} .mmm-nav > li > a',
        ]);

        $this->add_control('nav_padding', [
            'label'      => 'Padding',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'default'    => [
                'top'    => '15', 'right'    => '20',
                'bottom' => '15', 'left'     => '20',
                'unit'   => 'px', 'isLinked' => false,
            ],
            'selectors'  => [
                '{{WRAPPER}} .mmm-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->end_controls_section();

        // ── STYLE: Dropdown ──
        $this->start_controls_section('style_drop', [
            'label' => 'Dropdown',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('drop_bg', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => ['{{WRAPPER}} .mmm-dropdown' => 'background-color: {{VALUE}};'],
        ]);

        $this->add_control('drop_accent', [
            'label'     => 'Top Accent Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#0073aa',
            'selectors' => ['{{WRAPPER}} .mmm-dropdown' => 'border-top-color: {{VALUE}};'],
        ]);

        $this->add_control('drop_padding', [
            'label'      => 'Padding',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'default'    => [
                'top'    => '30', 'right'    => '30',
                'bottom' => '30', 'left'     => '30',
                'unit'   => 'px', 'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .mmm-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
            'name'     => 'drop_shadow',
            'selector' => '{{WRAPPER}} .mmm-dropdown',
        ]);

        $this->add_control('drop_radius', [
            'label'      => 'Border Radius',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .mmm-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // ── STYLE: Hamburger Menu ──
        $this->start_controls_section('style_hamburger', [
            'label' => 'Hamburger Menu',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->start_controls_tabs('hamburger_tabs');
        $this->start_controls_tab('hamburger_normal', ['label' => 'Normal']);
        $this->add_control('hamburger_bg', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => 'transparent',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('hamburger_color', [
            'label'     => 'Icon Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('hamburger_hover', ['label' => 'Hover']);
        $this->add_control('hamburger_bg_hover', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#f0f0f0',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger:hover' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('hamburger_color_hover', [
            'label'     => 'Icon Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#0073aa',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('hamburger_open', ['label' => 'Open']);
        $this->add_control('hamburger_bg_open', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#e5e5e5',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger.is-open' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('hamburger_color_open', [
            'label'     => 'Icon Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger.is-open' => 'color: {{VALUE}};',
            ],
        ]);
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control('hamburger_padding', [
            'label'      => 'Padding',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'default'    => [
                'top'      => '12',
                'right'    => '16',
                'bottom'   => '12',
                'left'     => '16',
                'unit'     => 'px',
                'isLinked' => false,
            ],
            'selectors'  => [
                '{{WRAPPER}} .mmm-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('hamburger_height', [
            'label'     => 'Min Height',
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'default'   => 50,
            'min'       => 30,
            'max'       => 100,
            'step'      => 5,
            'selectors' => [
                '{{WRAPPER}} .mmm-hamburger' => 'min-height: {{VALUE}}px;',
            ],
        ]);

        $this->add_control('hamburger_border_radius', [
            'label'      => 'Border Radius',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'selectors'  => [
                '{{WRAPPER}} .mmm-hamburger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_mobile_panel', [
            'label' => 'Mobile Panel',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('mobile_panel_bg', [
            'label'     => 'Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .mmm-mobile-panel' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('mobile_item_color', [
            'label'     => 'Item Text Color',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#333333',
            'selectors' => [
                '{{WRAPPER}} .mmm-m-item > a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('mobile_item_bg_hover', [
            'label'     => 'Item Hover Background',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'default'   => '#f5f5f5',
            'selectors' => [
                '{{WRAPPER}} .mmm-m-item > a:hover' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('mobile_panel_padding', [
            'label'      => 'Padding',
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px'],
            'default'    => [
                'top'      => '0',
                'right'    => '0',
                'bottom'   => '0',
                'left'     => '0',
                'unit'     => 'px',
                'isLinked' => true,
            ],
            'selectors'  => [
                '{{WRAPPER}} .mmm-mobile-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->end_controls_section();
    }

    private function indicator($type)
    {
        if ($type === 'arrow') {
            return '<span class="mmm-ind" aria-hidden="true">&#9660;</span>';
        }
        if ($type === 'chevron') {
            return '<span class="mmm-ind" aria-hidden="true">&#8250;</span>';
        }
        if ($type === 'plus') {
            return '<span class="mmm-ind" aria-hidden="true">&#43;</span>';
        }
        return '';
    }

    private function render_hamburger_icon($settings)
    {
        if (empty($settings['toggle_button']) || $settings['toggle_button'] !== 'icon') {
            return '';
        }
        $normal_icon = '';
        $hover_icon  = '';
        $active_icon = '';

        if (! empty($settings['hamburger_icon']['value'])) {
            ob_start();
            \Elementor\Icons_Manager::render_icon($settings['hamburger_icon'], ['aria-hidden' => 'true'], 'span');
            $normal_icon = ob_get_clean();
        }

        if (! empty($settings['hamburger_icon_hover']['value'])) {
            ob_start();
            \Elementor\Icons_Manager::render_icon($settings['hamburger_icon_hover'], ['aria-hidden' => 'true'], 'span');
            $hover_icon = ob_get_clean();
        }

        if (! empty($settings['hamburger_icon_active']['value'])) {
            ob_start();
            \Elementor\Icons_Manager::render_icon($settings['hamburger_icon_active'], ['aria-hidden' => 'true'], 'span');
            $active_icon = ob_get_clean();
        }

        return '<span class="mmm-hamburger-icon mmm-hamburger-icon-normal">' . $normal_icon . '</span>'
            . '<span class="mmm-hamburger-icon mmm-hamburger-icon-hover">' . $hover_icon . '</span>'
            . '<span class="mmm-hamburger-icon mmm-hamburger-icon-open">' . $active_icon . '</span>';
    }

    protected function render()
    {
        $s       = $this->get_settings_for_display();
        $menu_id = isset($s['menu_id']) ? intval($s['menu_id']) : 0;
        $trigger = isset($s['dropdown_trigger']) ? $s['dropdown_trigger'] : 'hover';
        $ind     = isset($s['submenu_indicator']) ? $s['submenu_indicator'] : 'arrow';
        $fullw   = isset($s['dropdown_fullwidth']) && $s['dropdown_fullwidth'] === 'yes';
        $bp      = isset($s['breakpoint']) ? $s['breakpoint'] : 'mobile';
        $toggle  = isset($s['toggle_button']) ? $s['toggle_button'] : 'hamburger';
        $content = '';
        if (! $menu_id) {
            echo '<p class="mmm-notice">Please select a menu in the Elementor panel.</p>';
            return;
        }
        $items = wp_get_nav_menu_items($menu_id);
        if (empty($items)) {
            echo '<p class="mmm-notice">There are no items in the menu.</p>';
            return;
        }
        $top = [];
        foreach ($items as $item) {
            if ($item->menu_item_parent == 0) {
                $top[] = $item;
            }
        }
        ?>
        <nav class="mmm-wrapper mmm-bp-<?php echo esc_attr($bp); ?>"
             data-trigger="<?php echo esc_attr($trigger); ?>"
             role="navigation" aria-label="Main Navigation">
            <ul class="mmm-nav">
                <?php foreach ($top as $item):
                                $id          = $item->ID;
                                $enabled     = MMM_Storage::is_enabled($id);
                                $template_id = MMM_Storage::get_template_id($id);
                                $has_drop    = $enabled && $template_id;
                                $target      = $item->target === '_blank' ? ' target="_blank" rel="noopener"' : '';
                        ?>
                    <li class="mmm-item<?php echo $has_drop ? ' has-mega' : ''; ?>">
                        <a href="<?php echo esc_url($item->url); ?>"<?php echo esc_attr($target); ?>>
                            <span class="mmm-label"><?php echo esc_html($item->title); ?></span>
                            <?php echo $has_drop ? $this->indicator($ind) : ''; ?>
                        </a>
                        <?php if ($has_drop): ?>
                            <div class="mmm-dropdown<?php echo $fullw ? ' mmm-fullwidth' : ''; ?>">
                                <?php
                                        $template_id = MMM_Storage::get_template_id($id);
                                                if ($template_id) {
                                                    echo \Elementor\Plugin::instance()
                                                        ->frontend
                                                        ->get_builder_content_for_display($template_id);
                                                }
                                        ?>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button class="mmm-hamburger<?php echo esc_attr($toggle === 'icon' ? ' mmm-hamburger-icon-btn' : ''); ?>" aria-label="Menu" aria-expanded="false">
                <?php if ($toggle === 'icon'): ?>
                    <?php echo $this->render_hamburger_icon($s); ?>
                <?php else: ?>
                    <span></span><span></span><span></span>
                <?php endif; ?>
            </button>

            <div class="mmm-mobile-panel">
                <ul class="mmm-mobile-nav">
                    <?php foreach ($top as $item):
                                    $id = $item->ID;
                                    $enabled = MMM_Storage::is_enabled($id);
                                    $template_id = MMM_Storage::get_template_id($id);
                                    $has_drop = $enabled && $template_id;
                                    $target = $item->target === '_blank' ? ' target="_blank" rel="noopener"' : '';
                            ?>
                        <li class="mmm-m-item<?php echo $has_drop ? ' has-mega' : ''; ?>">
                            <a href="<?php echo esc_url($item->url); ?>"<?php echo esc_attr($target); ?>>
                                <?php echo esc_html($item->title); ?>
                                <?php echo $has_drop ? '<span class="mmm-m-arr">&#9660;</span>' : ''; ?>
                            </a>
                            <?php if ($has_drop): ?>
                                <div class="mmm-m-drop">
                                    <?php
                                                    $template_id = MMM_Storage::get_template_id($id);
                                                    if ($template_id) {
                                                        echo \Elementor\Plugin::instance()
                                                            ->frontend
                                                            ->get_builder_content_for_display($template_id);
                                                    }
                                            ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <?php
                }
            }