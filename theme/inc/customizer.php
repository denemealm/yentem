<?php
/**
 * Theme Customizer Settings
 */

if (!defined('ABSPATH')) exit;

function dtb_customize_register($wp_customize) {

    // Demo Theme Builder Panel
    $wp_customize->add_panel('dtb_panel', array(
        'title' => __('Demo Theme Builder', 'demo-theme-builder'),
        'description' => __('Customize your theme components', 'demo-theme-builder'),
        'priority' => 10,
    ));

    // Header Section
    $wp_customize->add_section('dtb_header_section', array(
        'title' => __('Header Style', 'demo-theme-builder'),
        'panel' => 'dtb_panel',
        'priority' => 10,
    ));

    $wp_customize->add_setting('dtb_header_style', array(
        'default' => '1',
        'transport' => 'refresh',
        'sanitize_callback' => 'dtb_sanitize_select',
    ));

    $wp_customize->add_control('dtb_header_style', array(
        'label' => __('Select Header Style', 'demo-theme-builder'),
        'section' => 'dtb_header_section',
        'type' => 'select',
        'choices' => dtb_get_component_options('header'),
    ));

    // Hero Section
    $wp_customize->add_section('dtb_hero_section', array(
        'title' => __('Hero Style', 'demo-theme-builder'),
        'panel' => 'dtb_panel',
        'priority' => 20,
    ));

    $wp_customize->add_setting('dtb_hero_style', array(
        'default' => '1',
        'transport' => 'refresh',
        'sanitize_callback' => 'dtb_sanitize_select',
    ));

    $wp_customize->add_control('dtb_hero_style', array(
        'label' => __('Select Hero Style', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'select',
        'choices' => dtb_get_component_options('hero'),
    ));

    // Hero Content Settings
    $wp_customize->add_setting('dtb_hero_tag', array(
        'default' => 'Gündem Özel',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dtb_hero_tag', array(
        'label' => __('Hero Tag', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('dtb_hero_title', array(
        'default' => 'Teknolojinin Sınırlarını Bugünden Keşfedin',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dtb_hero_title', array(
        'label' => __('Hero Title', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('dtb_hero_description', array(
        'default' => 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('dtb_hero_description', array(
        'label' => __('Hero Description', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('dtb_hero_button_text', array(
        'default' => 'Hemen Okumaya Başla',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dtb_hero_button_text', array(
        'label' => __('Button Text', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('dtb_hero_button_url', array(
        'default' => '#',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('dtb_hero_button_url', array(
        'label' => __('Button URL', 'demo-theme-builder'),
        'section' => 'dtb_hero_section',
        'type' => 'url',
    ));

    // Posts Section
    $wp_customize->add_section('dtb_posts_section', array(
        'title' => __('Posts Style', 'demo-theme-builder'),
        'panel' => 'dtb_panel',
        'priority' => 30,
    ));

    $wp_customize->add_setting('dtb_posts_style', array(
        'default' => '1',
        'transport' => 'refresh',
        'sanitize_callback' => 'dtb_sanitize_select',
    ));

    $wp_customize->add_control('dtb_posts_style', array(
        'label' => __('Select Posts Style', 'demo-theme-builder'),
        'section' => 'dtb_posts_section',
        'type' => 'select',
        'choices' => dtb_get_component_options('posts'),
    ));

    $wp_customize->add_setting('dtb_posts_title', array(
        'default' => 'Son Eklenenler',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dtb_posts_title', array(
        'label' => __('Section Title', 'demo-theme-builder'),
        'section' => 'dtb_posts_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('dtb_posts_count', array(
        'default' => 6,
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('dtb_posts_count', array(
        'label' => __('Number of Posts', 'demo-theme-builder'),
        'section' => 'dtb_posts_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
        ),
    ));

    // Footer Section
    $wp_customize->add_section('dtb_footer_section', array(
        'title' => __('Footer Style', 'demo-theme-builder'),
        'panel' => 'dtb_panel',
        'priority' => 40,
    ));

    $wp_customize->add_setting('dtb_footer_style', array(
        'default' => '1',
        'transport' => 'refresh',
        'sanitize_callback' => 'dtb_sanitize_select',
    ));

    $wp_customize->add_control('dtb_footer_style', array(
        'label' => __('Select Footer Style', 'demo-theme-builder'),
        'section' => 'dtb_footer_section',
        'type' => 'select',
        'choices' => dtb_get_component_options('footer'),
    ));

    $wp_customize->add_setting('dtb_footer_copyright', array(
        'default' => '© 2025 Teknopolis. Tüm hakları saklıdır.',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dtb_footer_copyright', array(
        'label' => __('Copyright Text', 'demo-theme-builder'),
        'section' => 'dtb_footer_section',
        'type' => 'text',
    ));

    // Site Colors Section
    $wp_customize->add_section('dtb_colors_section', array(
        'title' => __('Theme Colors', 'demo-theme-builder'),
        'panel' => 'dtb_panel',
        'priority' => 50,
    ));

    $wp_customize->add_setting('dtb_primary_color', array(
        'default' => '#2563eb',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'dtb_primary_color', array(
        'label' => __('Primary Color', 'demo-theme-builder'),
        'section' => 'dtb_colors_section',
    )));
}
add_action('customize_register', 'dtb_customize_register');

/**
 * Sanitize Select
 */
function dtb_sanitize_select($input) {
    $valid = array('1', '2', '3', '4', '5');
    return in_array($input, $valid) ? $input : '1';
}

/**
 * Output Custom CSS
 */
function dtb_custom_css() {
    $primary = get_theme_mod('dtb_primary_color', '#2563eb');
    ?>
    <style>
        :root {
            --primary: <?php echo esc_attr($primary); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'dtb_custom_css');
