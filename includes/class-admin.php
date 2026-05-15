<?php

    if (! defined('ABSPATH')) {
    exit;
    }

    class MMM_Admin
    {

    public static function init()
    {
        add_action('admin_enqueue_scripts', ['MMM_Admin', 'enqueue']);
        add_action('wp_nav_menu_item_custom_fields', ['MMM_Admin', 'add_button'], 10, 2);
        add_action('wp_update_nav_menu_item', ['MMM_Admin', 'save_on_menu_save'], 10, 2);
    }

    public static function enqueue($hook)
    {
        if ($hook !== 'nav-menus.php') {
            return;
        }

        wp_enqueue_style('mmm-admin', MMM_URL . 'assets/css/admin.css', [], MMM_VERSION);
        wp_enqueue_script('mmm-admin', MMM_URL . 'assets/js/admin.js', ['jquery'], MMM_VERSION, true);
        wp_localize_script('mmm-admin', 'mmmAdmin', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('mmm_nonce'),
        ]);
    }

    public static function add_button($item_id, $item)
    {
        $item_id = absint($item_id);
        $enabled = MMM_Storage::is_enabled($item_id);
        ?>
        <div class="mmm-wrap" data-item-id="<?php echo esc_attr($item_id); ?>">
            <input type="hidden"
                class="mmm-enabled-val"
                name="mmm_enabled[<?php echo esc_attr($item_id); ?>]"
                value="<?php echo $enabled ? '1' : '0'; ?>" />
            <button type="button"
                class="button mmm-open-btn <?php echo $enabled ? 'mmm-active' : ''; ?>"
                data-item-id="<?php echo esc_attr($item_id); ?>"
                data-enabled="<?php echo $enabled ? '1' : '0'; ?>">
                &#9776;
                <?php echo esc_html($enabled ? 'Mega Menu ✔' : 'Mega Menu'); ?>
            </button>
        </div>
        <?php
            }

                public static function save_on_menu_save($menu_id, $item_id)
                {
                    if (! current_user_can('edit_theme_options')) {
                        return;
                    }

                    if (! isset($_POST['_wpnonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'update-nav-menu')) {
                        return;
                    }

                    if (isset($_POST['mmm_enabled'][$item_id])) {
                        $enabled = sanitize_text_field(wp_unslash($_POST['mmm_enabled'][$item_id])) === '1';
                        MMM_Storage::toggle(absint($item_id), $enabled);
                    }
                }
            }

        MMM_Admin::init();
