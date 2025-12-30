<?php
/**
 * Kinguin Admin Sayfası
 *
 * Admin panel ayarları ve yönetim sayfası
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kinguin_Admin {

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
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_post_kinguin_sync_now', array($this, 'handle_sync_now'));
        add_action('admin_post_kinguin_clear_cache', array($this, 'handle_clear_cache'));
        add_action('admin_post_kinguin_clear_errors', array($this, 'handle_clear_errors'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Admin menüsü ekle
     */
    public function add_admin_menu() {
        // Üst seviye menü
        add_menu_page(
            'Kinguin Ayarları',           // Page title
            'Kinguin',                     // Menu title
            'manage_options',              // Capability
            'kinguin-settings',            // Menu slug
            array($this, 'render_settings_page'), // Callback
            'dashicons-games',             // Icon
            58                             // Position
        );
    }

    /**
     * Ayarları kaydet
     */
    public function register_settings() {
        register_setting('kinguin_settings', 'kinguin_api_key', array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        register_setting('kinguin_settings', 'kinguin_sync_interval', array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => 'hourly',
        ));

        register_setting('kinguin_settings', 'kinguin_products_per_sync', array(
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'default' => 50,
        ));

        register_setting('kinguin_settings', 'kinguin_auto_sync_enabled', array(
            'type' => 'boolean',
            'sanitize_callback' => 'rest_sanitize_boolean',
            'default' => true,
        ));
    }

    /**
     * Admin scripts
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'kinguin_product_page_kinguin-settings') {
            return;
        }

        wp_enqueue_style(
            'kinguin-admin',
            KINGUIN_API_PLUGIN_URL . 'assets/css/kinguin-admin.css',
            array(),
            KINGUIN_API_VERSION
        );
    }

    /**
     * Ayarlar sayfası
     */
    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        // API instance
        $api = Kinguin_API::get_instance();
        $has_api_key = $api->has_api_key();
        $errors = $api->get_errors(10);

        // İstatistikler
        $product_count = wp_count_posts('kinguin_product');
        $published_count = $product_count->publish ?? 0;

        // Son senkronizasyon
        $last_sync = get_option('kinguin_last_sync_time');

        ?>
        <div class="wrap">
            <h1>Kinguin API Ayarları</h1>

            <?php settings_errors(); ?>

            <div class="kinguin-dashboard">
                <!-- İstatistikler -->
                <div class="kinguin-stats">
                    <div class="stat-box">
                        <h3><?php echo esc_html($published_count); ?></h3>
                        <p>Yayınlanmış Ürün</p>
                    </div>
                    <div class="stat-box">
                        <h3><?php echo $has_api_key ? '<span style="color:green;">✓</span>' : '<span style="color:red;">✗</span>'; ?></h3>
                        <p>API Bağlantısı</p>
                    </div>
                    <div class="stat-box">
                        <h3><?php echo $last_sync ? human_time_diff(strtotime($last_sync), current_time('timestamp')) . ' önce' : 'Hiç'; ?></h3>
                        <p>Son Senkronizasyon</p>
                    </div>
                </div>

                <!-- Hızlı İşlemler -->
                <div class="kinguin-actions">
                    <h2>Hızlı İşlemler</h2>
                    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="display:inline;">
                        <input type="hidden" name="action" value="kinguin_sync_now">
                        <?php wp_nonce_field('kinguin_sync_now'); ?>
                        <button type="submit" class="button button-primary button-large">
                            <span class="dashicons dashicons-update"></span> Şimdi Senkronize Et
                        </button>
                    </form>

                    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="display:inline;">
                        <input type="hidden" name="action" value="kinguin_clear_cache">
                        <?php wp_nonce_field('kinguin_clear_cache'); ?>
                        <button type="submit" class="button button-secondary">
                            <span class="dashicons dashicons-trash"></span> Cache Temizle
                        </button>
                    </form>
                </div>

                <!-- API Ayarları -->
                <div class="kinguin-settings-form">
                    <h2>API Ayarları</h2>
                    <form method="post" action="options.php">
                        <?php settings_fields('kinguin_settings'); ?>

                        <table class="form-table">
                            <tr>
                                <th scope="row">
                                    <label for="kinguin_api_key">API Key</label>
                                </th>
                                <td>
                                    <input type="text"
                                           id="kinguin_api_key"
                                           name="kinguin_api_key"
                                           value="<?php echo esc_attr(get_option('kinguin_api_key')); ?>"
                                           class="regular-text"
                                           placeholder="Kinguin API anahtarınızı girin">
                                    <p class="description">
                                        Kinguin Integration'dan aldığınız API anahtarını buraya girin.
                                        <a href="https://www.kinguin.net/integration" target="_blank">API Key almak için tıklayın</a>
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="kinguin_auto_sync_enabled">Otomatik Senkronizasyon</label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox"
                                               id="kinguin_auto_sync_enabled"
                                               name="kinguin_auto_sync_enabled"
                                               value="1"
                                               <?php checked(get_option('kinguin_auto_sync_enabled', true)); ?>>
                                        Otomatik senkronizasyonu aktif et
                                    </label>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="kinguin_sync_interval">Senkronizasyon Aralığı</label>
                                </th>
                                <td>
                                    <select id="kinguin_sync_interval" name="kinguin_sync_interval">
                                        <option value="hourly" <?php selected(get_option('kinguin_sync_interval', 'hourly'), 'hourly'); ?>>Saatlik</option>
                                        <option value="twicedaily" <?php selected(get_option('kinguin_sync_interval'), 'twicedaily'); ?>>Günde 2 kez</option>
                                        <option value="daily" <?php selected(get_option('kinguin_sync_interval'), 'daily'); ?>>Günlük</option>
                                    </select>
                                    <p class="description">Ürünlerin ne sıklıkla güncelleneeceğini belirler.</p>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">
                                    <label for="kinguin_products_per_sync">Senkronizasyon Başına Ürün</label>
                                </th>
                                <td>
                                    <input type="number"
                                           id="kinguin_products_per_sync"
                                           name="kinguin_products_per_sync"
                                           value="<?php echo esc_attr(get_option('kinguin_products_per_sync', 50)); ?>"
                                           min="10"
                                           max="200"
                                           step="10"
                                           class="small-text">
                                    <p class="description">Her senkronizasyonda kaç ürün çekileceğini belirler (10-200 arası).</p>
                                </td>
                            </tr>
                        </table>

                        <?php submit_button('Ayarları Kaydet'); ?>
                    </form>
                </div>

                <!-- Hata Logları -->
                <?php if (!empty($errors)): ?>
                <div class="kinguin-errors">
                    <h2>Son Hatalar</h2>
                    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="float:right;">
                        <input type="hidden" name="action" value="kinguin_clear_errors">
                        <?php wp_nonce_field('kinguin_clear_errors'); ?>
                        <button type="submit" class="button button-small">Hataları Temizle</button>
                    </form>
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>
                                <th>Tarih/Saat</th>
                                <th>Hata Mesajı</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($errors) as $error): ?>
                            <tr>
                                <td><?php echo esc_html($error['time']); ?></td>
                                <td><?php echo esc_html($error['message']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

                <!-- Kullanım Bilgisi -->
                <div class="kinguin-info">
                    <h2>Kullanım Rehberi</h2>
                    <ol>
                        <li><strong>API Key girin:</strong> Kinguin Integration'dan aldığınız API anahtarını yukarıdaki alana girin.</li>
                        <li><strong>Ayarları kaydedin:</strong> "Ayarları Kaydet" butonuna tıklayın.</li>
                        <li><strong>İlk senkronizasyonu yapın:</strong> "Şimdi Senkronize Et" butonuna tıklayın.</li>
                        <li><strong>Ürünleri kontrol edin:</strong> Sol menüden "Kinguin Ürünler" sekmesine gidip ürünleri görüntüleyin.</li>
                        <li><strong>Ürünleri görüntüleyin:</strong> Sitenizde <code>/oyunlar/</code> sayfasına giderek ürünleri görün.</li>
                    </ol>
                    <p>
                        <strong>Shortcode:</strong> Herhangi bir sayfaya ürün listesi eklemek için: <code>[kinguin_products limit="12"]</code>
                    </p>
                </div>
            </div>
        </div>

        <style>
            .kinguin-dashboard { max-width: 1200px; }
            .kinguin-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 20px 0; }
            .stat-box { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 4px; text-align: center; }
            .stat-box h3 { margin: 0; font-size: 32px; color: #2271b1; }
            .stat-box p { margin: 10px 0 0; color: #666; }
            .kinguin-actions { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 4px; margin: 20px 0; }
            .kinguin-actions button { margin-right: 10px; }
            .kinguin-settings-form, .kinguin-errors, .kinguin-info { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 4px; margin: 20px 0; }
            .button .dashicons { margin-top: 3px; }
        </style>
        <?php
    }

    /**
     * Manuel senkronizasyon
     */
    public function handle_sync_now() {
        check_admin_referer('kinguin_sync_now');

        if (!current_user_can('manage_options')) {
            wp_die('Yetkiniz yok.');
        }

        $sync = Kinguin_Sync::get_instance();
        $result = $sync->sync_products();

        if (is_wp_error($result)) {
            add_settings_error(
                'kinguin_messages',
                'kinguin_sync_error',
                'Senkronizasyon hatası: ' . $result->get_error_message(),
                'error'
            );
        } else {
            add_settings_error(
                'kinguin_messages',
                'kinguin_sync_success',
                sprintf('%d ürün başarıyla senkronize edildi.', $result),
                'success'
            );
        }

        set_transient('settings_errors', get_settings_errors(), 30);

        wp_redirect(add_query_arg('settings-updated', 'true', wp_get_referer()));
        exit;
    }

    /**
     * Cache temizle
     */
    public function handle_clear_cache() {
        check_admin_referer('kinguin_clear_cache');

        if (!current_user_can('manage_options')) {
            wp_die('Yetkiniz yok.');
        }

        $api = Kinguin_API::get_instance();
        $api->clear_cache();

        add_settings_error(
            'kinguin_messages',
            'kinguin_cache_cleared',
            'Cache başarıyla temizlendi.',
            'success'
        );

        set_transient('settings_errors', get_settings_errors(), 30);

        wp_redirect(wp_get_referer());
        exit;
    }

    /**
     * Hataları temizle
     */
    public function handle_clear_errors() {
        check_admin_referer('kinguin_clear_errors');

        if (!current_user_can('manage_options')) {
            wp_die('Yetkiniz yok.');
        }

        $api = Kinguin_API::get_instance();
        $api->clear_errors();

        add_settings_error(
            'kinguin_messages',
            'kinguin_errors_cleared',
            'Hata logları temizlendi.',
            'success'
        );

        set_transient('settings_errors', get_settings_errors(), 30);

        wp_redirect(wp_get_referer());
        exit;
    }
}
