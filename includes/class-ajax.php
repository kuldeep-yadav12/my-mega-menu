<?php

if (! defined('ABSPATH')) {
    exit;
}

class MMM_Ajax{
    public static function init(){
        add_action('wp_ajax_mmm_toggle', ['MMM_Ajax', 'toggle']);
        add_action('wp_ajax_mmm_get_data', ['MMM_Ajax', 'get_data']);
        add_action('wp_ajax_mmm_save_data', ['MMM_Ajax', 'save_data']);
        add_action('wp_ajax_mmm_get_elementor_template', ['MMM_Ajax', 'get_elementor_template']);
    }

    private static function verify(){
        if (! isset($_REQUEST['nonce']) || ! check_ajax_referer('mmm_nonce', 'nonce', false)) {
            wp_send_json_error(['msg' => esc_html__('Security error', 'my-mega-menu')], 403);
        }
        if (! current_user_can('edit_theme_options')) {
            wp_send_json_error(['msg' => esc_html__('Permission denied', 'my-mega-menu')], 403);
        }
    }

    // ✅ MAIN FUNCTION (FIXED)
    public static function get_elementor_template(){
        self::verify();
        $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
        if (! $item_id) {
            wp_send_json_error(['msg' => esc_html__('Invalid ID', 'my-mega-menu')]);
        }

        // check existing
        $template_id = MMM_Storage::get_template_id($item_id);
        if ($template_id) {
            wp_send_json_success([
                'edit_url' => admin_url("post.php?post={$template_id}&action=elementor"),
            ]);
        }

        // create new template
        $template_id = wp_insert_post([
            'post_title'  => sprintf(
                /* translators: %d: Menu item ID */
                __('Mega Menu %d', 'my-mega-menu'),
                $item_id
            ),

            'post_type'   => 'elementor_library',
            'post_status' => 'publish',
        ]);

        if (! $template_id) {
            wp_send_json_error(['msg' => esc_html__('Template create failed', 'my-mega-menu')]);
        }

        // save template id
        MMM_Storage::save_template_id($item_id, $template_id);
        wp_send_json_success([
            'edit_url' => admin_url("post.php?post={$template_id}&action=elementor"),
        ]);
    }

    public static function toggle(){
        self::verify();
        $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
        $enabled = isset($_POST['enabled']) && $_POST['enabled'] === '1';
        if (! $item_id) {
            wp_send_json_error(['msg' => esc_html__('Invalid ID', 'my-mega-menu')]);
        }
        MMM_Storage::toggle($item_id, $enabled);
        wp_send_json_success(['enabled' => $enabled]);
    }

    public static function get_data(){
        self::verify();
        $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
        if (! $item_id) {
            wp_send_json_error(['msg' => esc_html__('Invalid ID', 'my-mega-menu')]);
        }
        $data = MMM_Storage::get($item_id);
        wp_send_json_success([
            'enabled' => ! empty($data['enabled']),
            'content' => isset($data['content']) ? wp_kses_post($data['content']) : '',
        ]);
    }

    public static function save_data(){
        check_ajax_referer('mmm_nonce', 'nonce');
        self::verify();
        $item_id = isset($_POST['item_id']) ? intval($_POST['item_id']) : 0;
        $content = isset($_POST['content'])
            ? wp_kses_post(wp_unslash($_POST['content']))
            : '';
        $enabled = isset($_POST['enabled']) && $_POST['enabled'] === '1';
        if (! $item_id) {
            wp_send_json_error(['msg' => esc_html__('Invalid ID', 'my-mega-menu')]);
        }

        MMM_Storage::save($item_id, [
            'enabled' => $enabled,
            'content' => wp_kses_post(
                wp_unslash($content)
            ),
        ]);
        wp_send_json_success(['msg' => esc_html__('Saved!', 'my-mega-menu')]);
    }
}

MMM_Ajax::init();
