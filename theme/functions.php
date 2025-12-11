<?php
/**
 * Demo Theme Builder Functions
 */

if (!defined('ABSPATH')) exit;

define('DTB_VERSION', '1.0.0');
define('DTB_DIR', get_template_directory());
define('DTB_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function dtb_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('menus');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'demo-theme-builder'),
        'footer' => __('Footer Menu', 'demo-theme-builder'),
    ));
}
add_action('after_setup_theme', 'dtb_setup');

/**
 * Enqueue Scripts and Styles
 */
function dtb_scripts() {
    wp_enqueue_style('dtb-style', get_stylesheet_uri(), array(), DTB_VERSION);
    wp_enqueue_style('dtb-components', DTB_URI . '/assets/css/components.css', array(), DTB_VERSION);
    wp_enqueue_script('dtb-script', DTB_URI . '/assets/js/main.js', array(), DTB_VERSION, true);

    // Pass customizer settings to JS
    wp_localize_script('dtb-script', 'dtbSettings', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('dtb_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'dtb_scripts');

/**
 * Include Customizer
 */
require_once DTB_DIR . '/inc/customizer.php';

/**
 * Get Component Options
 */
function dtb_get_component_options($type) {
    $options = array(
        'header' => array(
            '1' => __('Classic - Logo left, menu right', 'demo-theme-builder'),
            '2' => __('Centered - Logo center, menu below', 'demo-theme-builder'),
            '3' => __('Minimal - Hamburger menu', 'demo-theme-builder'),
            '4' => __('Topbar - With social icons', 'demo-theme-builder'),
            '5' => __('Transparent - Overlay style', 'demo-theme-builder'),
        ),
        'hero' => array(
            '1' => __('Centered - Title and CTA', 'demo-theme-builder'),
            '2' => __('Split - Image right, text left', 'demo-theme-builder'),
            '3' => __('Slider - Multiple slides', 'demo-theme-builder'),
            '4' => __('Video Background', 'demo-theme-builder'),
            '5' => __('Minimal - Just text', 'demo-theme-builder'),
        ),
        'posts' => array(
            '1' => __('Card Grid - 3 columns', 'demo-theme-builder'),
            '2' => __('Horizontal - Image left', 'demo-theme-builder'),
            '3' => __('Vertical List', 'demo-theme-builder'),
            '4' => __('Masonry Grid', 'demo-theme-builder'),
            '5' => __('Magazine Layout', 'demo-theme-builder'),
        ),
        'footer' => array(
            '1' => __('4 Columns - Full info', 'demo-theme-builder'),
            '2' => __('3 Columns - Compact', 'demo-theme-builder'),
            '3' => __('Minimal - Single line', 'demo-theme-builder'),
            '4' => __('Centered - Logo focus', 'demo-theme-builder'),
            '5' => __('Dark - Modern style', 'demo-theme-builder'),
        ),
    );

    return isset($options[$type]) ? $options[$type] : array();
}

/**
 * Get Current Component Selection
 */
function dtb_get_component($type) {
    $default = '1';

    // Check for preview parameter
    if (isset($_GET["preview_{$type}"]) && current_user_can('edit_theme_options')) {
        $preview = sanitize_text_field($_GET["preview_{$type}"]);
        if (in_array($preview, array('1', '2', '3', '4', '5'))) {
            return $preview;
        }
    }

    return get_theme_mod("dtb_{$type}_style", $default);
}

/**
 * Fallback Menu
 */
function dtb_fallback_menu() {
    echo '<ul class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Ana Sayfa</a></li>';
    echo '<li><a href="#">Hakkımızda</a></li>';
    echo '<li><a href="#">Blog</a></li>';
    echo '<li><a href="#">İletişim</a></li>';
    echo '</ul>';
}

/**
 * Load Component Template
 */
function dtb_load_component($type) {
    $style = dtb_get_component($type);
    $template = "template-parts/{$type}s/{$type}-{$style}.php";

    if (file_exists(DTB_DIR . '/' . $template)) {
        get_template_part("template-parts/{$type}s/{$type}", $style);
    } else {
        get_template_part("template-parts/{$type}s/{$type}", '1');
    }
}

/**
 * AJAX Save Theme Settings (for frontend customizer)
 */
function dtb_save_settings() {
    check_ajax_referer('dtb_nonce', 'nonce');

    if (!current_user_can('edit_theme_options')) {
        wp_send_json_error('Permission denied');
    }

    $settings = array('header', 'hero', 'posts', 'footer');

    foreach ($settings as $setting) {
        if (isset($_POST[$setting])) {
            $value = sanitize_text_field($_POST[$setting]);
            if (in_array($value, array('1', '2', '3', '4', '5'))) {
                set_theme_mod("dtb_{$setting}_style", $value);
            }
        }
    }

    wp_send_json_success('Settings saved');
}
add_action('wp_ajax_dtb_save_settings', 'dtb_save_settings');

/**
 * Get Sample Posts Data (for demo)
 */
function dtb_get_sample_posts($count = 6) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $count,
        'post_status' => 'publish',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        return $query;
    }

    // Return demo data if no posts
    return dtb_get_demo_posts($count);
}

/**
 * Demo Posts Data
 */
function dtb_get_demo_posts($count = 6) {
    $demo_posts = array(
        array(
            'title' => 'Clean Code Prensipleriyle Daha İyi Kod Yazın',
            'excerpt' => 'Sürdürülebilir projeler için uymanız gereken 5 temel kural ve pratik örnekler.',
            'category' => 'Yazılım',
            'image' => 'https://placehold.co/600x338/2563eb/FFF?text=Yazılım',
        ),
        array(
            'title' => 'NVIDIA RTX 5000 Serisi Sızıntıları',
            'excerpt' => 'Yeni nesil ekran kartlarının performans testleri ve fiyat tahminleri ortaya çıktı.',
            'category' => 'Donanım',
            'image' => 'https://placehold.co/600x338/1e40af/FFF?text=Donanım',
        ),
        array(
            'title' => 'iOS 18 ile Gelecek Yapay Zeka Özellikleri',
            'excerpt' => 'Siri artık çok daha akıllı olacak. İşte beklenen yenilikler ve çıkış tarihi.',
            'category' => 'Mobil',
            'image' => 'https://placehold.co/600x338/0f172a/FFF?text=Mobil',
        ),
        array(
            'title' => 'Bitcoin Halving Sonrası Piyasa Analizi',
            'excerpt' => 'Uzmanların 2025 sonu için fiyat tahminleri ve yatırım önerileri.',
            'category' => 'Kripto',
            'image' => 'https://placehold.co/600x338/dc2626/FFF?text=Kripto',
        ),
        array(
            'title' => 'GTA VI Haritası Hakkında Yeni Detaylar',
            'excerpt' => 'Vice City\'nin modern hali düşündüğünüzden çok daha büyük olacak.',
            'category' => 'Oyun',
            'image' => 'https://placehold.co/600x338/16a34a/FFF?text=Oyun',
        ),
        array(
            'title' => 'Mars Kolonisi İçin İlk Büyük Adım',
            'excerpt' => 'SpaceX\'in yeni roketi başarıyla test edildi. İşte detaylar ve sonraki adımlar.',
            'category' => 'Bilim',
            'image' => 'https://placehold.co/600x338/9333ea/FFF?text=Bilim',
        ),
    );

    return array_slice($demo_posts, 0, $count);
}
