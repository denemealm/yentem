<?php
/**
 * Plugin Name: Kinguin API Integration
 * Plugin URI: https://github.com/yourusername/kinguin-api-integration
 * Description: Kinguin eCommerce API entegrasyonu - Ürün listeleme, senkronizasyon ve satış yönetimi
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: kinguin-api
 * Domain Path: /languages
 */

// Doğrudan erişimi engelle
if (!defined('ABSPATH')) {
    exit;
}

// Plugin sabitleri
define('KINGUIN_API_VERSION', '1.0.0');
define('KINGUIN_API_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('KINGUIN_API_PLUGIN_URL', plugin_dir_url(__FILE__));
define('KINGUIN_API_INCLUDES', KINGUIN_API_PLUGIN_DIR . 'includes/');
define('KINGUIN_API_TEMPLATES', KINGUIN_API_PLUGIN_DIR . 'templates/');

/**
 * Ana Plugin Sınıfı
 */
class Kinguin_API_Integration {

    /**
     * Singleton instance
     */
    private static $instance = null;

    /**
     * Singleton pattern
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->load_dependencies();
        $this->init_hooks();
    }

    /**
     * Gerekli sınıfları yükle
     */
    private function load_dependencies() {
        require_once KINGUIN_API_INCLUDES . 'class-kinguin-api.php';
        require_once KINGUIN_API_INCLUDES . 'class-kinguin-cpt.php';
        require_once KINGUIN_API_INCLUDES . 'class-kinguin-admin.php';
        require_once KINGUIN_API_INCLUDES . 'class-kinguin-sync.php';
    }

    /**
     * Hook'ları başlat
     */
    private function init_hooks() {
        // Plugin aktivasyon/deaktivasyon
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        // Init hook
        add_action('init', array($this, 'init'));

        // Admin hooks
        if (is_admin()) {
            Kinguin_Admin::get_instance();
        }

        // Frontend hooks
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_filter('template_include', array($this, 'template_loader'));
    }

    /**
     * Plugin init
     */
    public function init() {
        // Custom Post Type kaydet
        Kinguin_CPT::get_instance();

        // Cron job başlat
        Kinguin_Sync::get_instance();
    }

    /**
     * Frontend scriptleri yükle
     */
    public function enqueue_scripts() {
        // CSS
        wp_enqueue_style(
            'kinguin-products',
            KINGUIN_API_PLUGIN_URL . 'assets/css/kinguin-products.css',
            array(),
            KINGUIN_API_VERSION
        );

        // JS (gerekirse)
        wp_enqueue_script(
            'kinguin-products',
            KINGUIN_API_PLUGIN_URL . 'assets/js/kinguin-products.js',
            array('jquery'),
            KINGUIN_API_VERSION,
            true
        );
    }

    /**
     * Template yükleyici
     */
    public function template_loader($template) {
        if (is_post_type_archive('kinguin_product')) {
            $plugin_template = KINGUIN_API_TEMPLATES . 'archive-kinguin_product.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }

        if (is_singular('kinguin_product')) {
            $plugin_template = KINGUIN_API_TEMPLATES . 'single-kinguin_product.php';
            if (file_exists($plugin_template)) {
                return $plugin_template;
            }
        }

        return $template;
    }

    /**
     * Plugin aktivasyonu
     */
    public function activate() {
        // Custom Post Type kaydet
        Kinguin_CPT::register_post_type();

        // Rewrite rules flush
        flush_rewrite_rules();

        // Default ayarları kaydet
        if (!get_option('kinguin_api_key')) {
            add_option('kinguin_api_key', '');
        }
        if (!get_option('kinguin_sync_interval')) {
            add_option('kinguin_sync_interval', 'hourly');
        }

        // Cron schedule
        if (!wp_next_scheduled('kinguin_sync_products')) {
            wp_schedule_event(time(), 'hourly', 'kinguin_sync_products');
        }
    }

    /**
     * Plugin deaktivasyonu
     */
    public function deactivate() {
        // Cron job temizle
        $timestamp = wp_next_scheduled('kinguin_sync_products');
        if ($timestamp) {
            wp_unschedule_event($timestamp, 'kinguin_sync_products');
        }

        // Rewrite rules flush
        flush_rewrite_rules();
    }
}

/**
 * Plugin'i başlat
 */
function kinguin_api_integration() {
    return Kinguin_API_Integration::get_instance();
}

// Plugin'i çalıştır
kinguin_api_integration();
