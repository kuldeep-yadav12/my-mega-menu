<?php

/**
 * Plugin Name: Mega Menu
 * Plugin URI: https://github.com/kuldeep-yadav12/my-mega-menu
 * Description: Custom Mega Menu for Elementor - Works on all hosting
 * Version: 4.1.1
 * Author: Kuldeep TMB
 * License: GPL2
 * Text Domain: my-mega-menu
 */

if (! defined('ABSPATH')) {
    exit;
}

define('MMM_VERSION', '4.1.1');
define('MMM_PATH', plugin_dir_path(__FILE__));
define('MMM_URL', plugin_dir_url(__FILE__));

/**

 * On plugins_loaded load only Storage, Admin, Ajax

 * class-widget.php DO NOT load here

 * Widget will load only inside the elementor/widgets/register hook

 */

if (
    defined('ELEMENTOR_VERSION') &&
    version_compare(ELEMENTOR_VERSION, '3.0.0', '<')
) {
    return;
}

if (version_compare(PHP_VERSION, '7.4', '<')) {
    add_action('admin_notices', function () {
        printf(
            '<div class="notice notice-error"><p>%s</p></div>',
            esc_html__('Mega Menu requires PHP 7.4 or higher.', 'my-mega-menu')
        );
        echo esc_html__('Mega Menu requires PHP 7.4 or higher.', 'my-mega-menu');
        echo '</p></div>';
    });
    return;
}

add_action('plugins_loaded', 'mmm_load_textdomain');

function mmm_load_textdomain()
{
    load_plugin_textdomain(
        'my-mega-menu',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
}

add_action('plugins_loaded', 'mmm_init', 20);

function mmm_init()
{

    // Elementor check

    if (! did_action('elementor/loaded')) {
        add_action('admin_notices', 'mmm_no_elementor');
        return;
    }

    // Load only these files — NOT the widget
    require_once MMM_PATH . 'includes/class-storage.php';
    require_once MMM_PATH . 'includes/class-admin.php';
    require_once MMM_PATH . 'includes/class-ajax.php';
}

function mmm_no_elementor()
{
    echo '<div class="notice notice-error is-dismissible"><p>';
    echo esc_html__('Elementor plugin is required.', 'my-mega-menu');
    echo '</p></div>';
}

/**
 * Load the Widget ONLY here
 * This hook fires when Elementor is completely ready
 */

add_action('elementor/widgets/register', 'mmm_register_widget');

function mmm_register_widget($widgets_manager)
{
    // Mega Menu Nav Widget
    $file = MMM_PATH . 'includes/class-widget.php';
    if (file_exists($file)) {
        require_once $file;
        if (class_exists('MMM_Nav_Widget')) {
            $widgets_manager->register(new MMM_Nav_Widget());
        }
    }

    // Dual Color Heading Widget
    $file2 = MMM_PATH . 'includes/class-dual-heading-widget.php';
    if (file_exists($file2)) {
        require_once $file2;
        if (class_exists('MMM_Dual_Heading_Widget')) {
            $widgets_manager->register(new MMM_Dual_Heading_Widget());
        }
    }

    // Accordion Widget
    $file3 = MMM_PATH . 'includes/class-accordion-widget.php';
    if (file_exists($file3)) {
        require_once $file3;
        if (class_exists('MMM_Accordion_Widget')) {
            $widgets_manager->register(new MMM_Accordion_Widget());
        }
    }

    // Image Carousel Widget
    $file4 = MMM_PATH . 'includes/class-image-carousel-widget.php';
    if (file_exists($file4)) {

        require_once $file4;
        if (class_exists('MMM_Image_Carousel_Widget')) {
            $widgets_manager->register(new MMM_Image_Carousel_Widget());
        }
    }

}

// Elementor category

add_action('elementor/elements/categories_registered', 'mmm_add_category');
function mmm_add_category($elements_manager)
{
    $elements_manager->add_category('my-mega-menu', [
        'title' => 'My Mega Menu',
        'icon'  => 'fa fa-bars',
    ]);

}

// Frontend assets

add_action('wp_enqueue_scripts', 'mmm_frontend_assets');
function mmm_frontend_assets()
{
    wp_enqueue_style(
        'mmm-frontend',
        MMM_URL . 'assets/css/frontend.css',
        [],
        MMM_VERSION
    );

    wp_enqueue_style(
        'mmm-accordion-widget',
        MMM_URL . 'assets/css/accordion-widget.css',
        [],
        MMM_VERSION
    );

    wp_enqueue_script(
        'mmm-frontend',
        MMM_URL . 'assets/js/frontend.js',
        ['jquery'],
        MMM_VERSION,
        true
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper',
        MMM_URL . 'assets/vendor/swiper/swiper-bundle.min.css',
        [],
        '11.0.5'
    );

// Swiper JS
    wp_enqueue_script(
        'swiper',
        MMM_URL . 'assets/vendor/swiper/swiper-bundle.min.js',
        [],
        '11.0.5',
        true
    );

    wp_enqueue_style(
        'mmm-image-carousel-widget',
        MMM_URL . 'assets/css/image-carousel-widget.css',
        [],
        MMM_VERSION
    );

}
