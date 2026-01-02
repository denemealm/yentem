<?php
/**
 * Plugin Name: Kinguin Product Importer
 * Plugin URI: https://github.com/yourusername/kinguin-importer
 * Description: Kinguin API'sinden ürünleri çeker ve WordPress'e kaydeder. Tüm API verilerini eksiksiz saklar ve admin panelinde gösterir.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * Text Domain: kinguin-importer
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kinguin_Product_Importer {

    private $api_key;
    private $api_base_url = 'https://gateway.kinguin.net/esa/api';
    private $sandbox_url = 'https://gateway.sandbox.kinguin.net/esa/api';

    public function __construct() {
        // Admin menüsünü ekle
        add_action('admin_menu', [$this, 'add_admin_menu']);

        // Admin ayarlarını kaydet
        add_action('admin_init', [$this, 'register_settings']);

        // Post editor'da metabox ekle
        add_action('add_meta_boxes', [$this, 'add_product_metabox']);

        // Admin scripts ve styles
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);

        // AJAX handlers
        add_action('wp_ajax_kinguin_import_products', [$this, 'ajax_import_products']);

        // API key'i al
        $this->api_key = get_option('kinguin_api_key', '');
    }

    /**
     * Admin menü ekle
     */
    public function add_admin_menu() {
        add_menu_page(
            'Kinguin Importer',
            'Kinguin',
            'manage_options',
            'kinguin-importer',
            [$this, 'render_import_page'],
            'dashicons-download',
            30
        );

        add_submenu_page(
            'kinguin-importer',
            'Ayarlar',
            'Ayarlar',
            'manage_options',
            'kinguin-settings',
            [$this, 'render_settings_page']
        );
    }

    /**
     * Ayarları kaydet
     */
    public function register_settings() {
        register_setting('kinguin_settings', 'kinguin_api_key');
        register_setting('kinguin_settings', 'kinguin_use_sandbox');
    }

    /**
     * Admin assets ekle
     */
    public function enqueue_admin_assets($hook) {
        if (strpos($hook, 'kinguin') !== false) {
            wp_enqueue_style('kinguin-admin-style', false, [], '1.0.0');
            wp_add_inline_style('kinguin-admin-style', '
                .kinguin-wrap { max-width: 1200px; margin: 20px; }
                .kinguin-card { background: #fff; padding: 20px; margin: 20px 0; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
                .kinguin-form-group { margin-bottom: 20px; }
                .kinguin-form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
                .kinguin-form-group input[type="text"],
                .kinguin-form-group input[type="number"] { width: 100%; max-width: 500px; padding: 8px; }
                .kinguin-btn { background: #2271b1; color: #fff; padding: 10px 20px; border: none; cursor: pointer; border-radius: 3px; }
                .kinguin-btn:hover { background: #135e96; }
                .kinguin-btn:disabled { background: #ccc; cursor: not-allowed; }
                .kinguin-progress { margin-top: 20px; display: none; }
                .kinguin-progress-bar { width: 100%; height: 30px; background: #f0f0f0; border-radius: 3px; overflow: hidden; }
                .kinguin-progress-fill { height: 100%; background: #2271b1; transition: width 0.3s; }
                .kinguin-log { margin-top: 20px; max-height: 400px; overflow-y: auto; background: #f5f5f5; padding: 15px; font-family: monospace; font-size: 12px; border-radius: 3px; }
                .kinguin-log-item { margin-bottom: 5px; padding: 5px; }
                .kinguin-log-success { color: #008000; }
                .kinguin-log-error { color: #dc3232; background: #fff0f0; }
                .kinguin-log-info { color: #0073aa; }
                .kinguin-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px; }
                .kinguin-stat-box { background: #f0f6fc; padding: 15px; border-left: 4px solid #2271b1; }
                .kinguin-stat-label { font-size: 12px; color: #666; text-transform: uppercase; }
                .kinguin-stat-value { font-size: 24px; font-weight: bold; color: #2271b1; }
                .kinguin-json-viewer { background: #282c34; color: #abb2bf; padding: 15px; border-radius: 5px; max-height: 500px; overflow: auto; font-family: "Courier New", monospace; font-size: 13px; line-height: 1.5; }
                .kinguin-json-viewer pre { margin: 0; white-space: pre-wrap; word-wrap: break-word; }
                .kinguin-metabox-section { margin-bottom: 20px; }
                .kinguin-metabox-section h4 { margin-top: 0; padding-bottom: 10px; border-bottom: 1px solid #ddd; }
                .kinguin-data-table { width: 100%; border-collapse: collapse; }
                .kinguin-data-table th, .kinguin-data-table td { padding: 8px; text-align: left; border-bottom: 1px solid #eee; }
                .kinguin-data-table th { background: #f5f5f5; font-weight: bold; }
                .kinguin-tabs { border-bottom: 1px solid #ddd; margin-bottom: 20px; }
                .kinguin-tab { display: inline-block; padding: 10px 20px; cursor: pointer; border: 1px solid transparent; margin-bottom: -1px; }
                .kinguin-tab.active { border-color: #ddd #ddd #fff; background: #fff; }
                .kinguin-tab-content { display: none; }
                .kinguin-tab-content.active { display: block; }
            ');

            wp_enqueue_script('kinguin-admin-script', false, ['jquery'], '1.0.0', true);
            wp_add_inline_script('kinguin-admin-script', '
                jQuery(document).ready(function($) {
                    // Tab switching
                    $(".kinguin-tab").on("click", function() {
                        var tab = $(this).data("tab");
                        $(".kinguin-tab").removeClass("active");
                        $(this).addClass("active");
                        $(".kinguin-tab-content").removeClass("active");
                        $("#" + tab).addClass("active");
                    });

                    // Import products
                    $("#kinguin-import-btn").on("click", function() {
                        var btn = $(this);
                        var limit = $("#kinguin-limit").val();
                        var page = $("#kinguin-page").val();
                        var name = $("#kinguin-name").val();
                        var platform = $("#kinguin-platform").val();

                        btn.prop("disabled", true).text("İçe aktarılıyor...");
                        $(".kinguin-progress").show();
                        $(".kinguin-log").html("");

                        addLog("İçe aktarma başlatıldı...", "info");

                        $.ajax({
                            url: ajaxurl,
                            type: "POST",
                            data: {
                                action: "kinguin_import_products",
                                limit: limit,
                                page: page,
                                name: name,
                                platform: platform,
                                nonce: "' . wp_create_nonce('kinguin_import') . '"
                            },
                            success: function(response) {
                                if (response.success) {
                                    var data = response.data;
                                    addLog("✓ Başarılı: " + data.imported + " ürün içe aktarıldı", "success");
                                    addLog("Toplam bulunan: " + data.total_found, "info");

                                    if (data.errors.length > 0) {
                                        addLog("Hatalar:", "error");
                                        data.errors.forEach(function(error) {
                                            addLog("  - " + error, "error");
                                        });
                                    }

                                    updateStats(data);
                                } else {
                                    addLog("✗ Hata: " + response.data.message, "error");
                                }
                            },
                            error: function(xhr, status, error) {
                                addLog("✗ AJAX Hatası: " + error, "error");
                            },
                            complete: function() {
                                btn.prop("disabled", false).text("Ürünleri İçe Aktar");
                                $(".kinguin-progress").hide();
                            }
                        });
                    });

                    function addLog(message, type) {
                        var logClass = "kinguin-log-" + (type || "info");
                        $(".kinguin-log").append("<div class=\"kinguin-log-item " + logClass + "\">" + message + "</div>");
                        $(".kinguin-log").scrollTop($(".kinguin-log")[0].scrollHeight);
                    }

                    function updateStats(data) {
                        $("#stat-imported").text(data.imported);
                        $("#stat-total").text(data.total_found);
                        $("#stat-errors").text(data.errors.length);
                    }
                });
            ');

            wp_localize_script('kinguin-admin-script', 'kinguinAdmin', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('kinguin_import')
            ]);
        }
    }

    /**
     * Import sayfası
     */
    public function render_import_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        ?>
        <div class="kinguin-wrap">
            <h1>Kinguin Ürün İçe Aktarma</h1>

            <?php if (empty($this->api_key)): ?>
                <div class="notice notice-error">
                    <p><strong>Uyarı:</strong> API anahtarı ayarlanmamış. Lütfen <a href="<?php echo admin_url('admin.php?page=kinguin-settings'); ?>">Ayarlar</a> sayfasından API anahtarınızı girin.</p>
                </div>
            <?php endif; ?>

            <div class="kinguin-stats">
                <div class="kinguin-stat-box">
                    <div class="kinguin-stat-label">İçe Aktarılan</div>
                    <div class="kinguin-stat-value" id="stat-imported">0</div>
                </div>
                <div class="kinguin-stat-box">
                    <div class="kinguin-stat-label">Toplam Bulunan</div>
                    <div class="kinguin-stat-value" id="stat-total">0</div>
                </div>
                <div class="kinguin-stat-box">
                    <div class="kinguin-stat-label">Hatalar</div>
                    <div class="kinguin-stat-value" id="stat-errors">0</div>
                </div>
            </div>

            <div class="kinguin-card">
                <h2>Ürün Filtreleme ve İçe Aktarma</h2>

                <div class="kinguin-form-group">
                    <label for="kinguin-limit">Kaç ürün çekilsin? (Max: 100)</label>
                    <input type="number" id="kinguin-limit" name="limit" value="25" min="1" max="100">
                    <p class="description">Tek seferde çekilecek ürün sayısı. API limiti: 100</p>
                </div>

                <div class="kinguin-form-group">
                    <label for="kinguin-page">Sayfa Numarası</label>
                    <input type="number" id="kinguin-page" name="page" value="1" min="1">
                    <p class="description">Hangi sayfadan başlansın?</p>
                </div>

                <div class="kinguin-form-group">
                    <label for="kinguin-name">Ürün Adı (Opsiyonel)</label>
                    <input type="text" id="kinguin-name" name="name" placeholder="Örn: Call of Duty">
                    <p class="description">Belirli bir ürün aramak için (minimum 3 karakter)</p>
                </div>

                <div class="kinguin-form-group">
                    <label for="kinguin-platform">Platform (Opsiyonel)</label>
                    <input type="text" id="kinguin-platform" name="platform" placeholder="Örn: Steam,Epic">
                    <p class="description">Platform filtreleme (virgülle ayırın): Steam, Epic, GOG, Uplay, vb.</p>
                </div>

                <button type="button" id="kinguin-import-btn" class="kinguin-btn" <?php echo empty($this->api_key) ? 'disabled' : ''; ?>>
                    Ürünleri İçe Aktar
                </button>

                <div class="kinguin-progress">
                    <div class="kinguin-progress-bar">
                        <div class="kinguin-progress-fill" style="width: 0%"></div>
                    </div>
                </div>

                <div class="kinguin-log"></div>
            </div>

            <div class="kinguin-card">
                <h3>Bilgilendirme</h3>
                <ul>
                    <li><strong>API Endpoint:</strong> GET /v1/products</li>
                    <li><strong>Tüm veriler kaydedilir:</strong> API'den dönen her alan eksiksiz şekilde post meta olarak saklanır</li>
                    <li><strong>Meta Key:</strong> <code>_kinguin_full_data</code> (Tüm JSON response)</li>
                    <li><strong>Post Type:</strong> Normal WordPress post</li>
                    <li><strong>Post Title:</strong> Ürün adı (name)</li>
                    <li><strong>Post Content:</strong> Ürün açıklaması (description)</li>
                    <li><strong>Admin'de görüntüleme:</strong> Her post'un düzenleme sayfasında "Kinguin Ürün Bilgileri" metabox'ında tüm veriler görüntülenir</li>
                </ul>
            </div>
        </div>
        <?php
    }

    /**
     * Ayarlar sayfası
     */
    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['submit'])) {
            check_admin_referer('kinguin_settings');
            update_option('kinguin_api_key', sanitize_text_field($_POST['kinguin_api_key']));
            update_option('kinguin_use_sandbox', isset($_POST['kinguin_use_sandbox']) ? '1' : '0');
            echo '<div class="notice notice-success"><p>Ayarlar kaydedildi!</p></div>';
        }

        $api_key = get_option('kinguin_api_key', '');
        $use_sandbox = get_option('kinguin_use_sandbox', '0');

        ?>
        <div class="kinguin-wrap">
            <h1>Kinguin Ayarlar</h1>

            <div class="kinguin-card">
                <form method="post">
                    <?php wp_nonce_field('kinguin_settings'); ?>

                    <div class="kinguin-form-group">
                        <label for="kinguin_api_key">API Anahtarı</label>
                        <input type="text" id="kinguin_api_key" name="kinguin_api_key" value="<?php echo esc_attr($api_key); ?>" required>
                        <p class="description">
                            API anahtarınızı <a href="https://www.kinguin.net/integration" target="_blank">Kinguin Integration</a> portalından alabilirsiniz.
                        </p>
                    </div>

                    <div class="kinguin-form-group">
                        <label>
                            <input type="checkbox" name="kinguin_use_sandbox" value="1" <?php checked($use_sandbox, '1'); ?>>
                            Sandbox (Test) Ortamını Kullan
                        </label>
                        <p class="description">
                            <strong>Production:</strong> https://gateway.kinguin.net/esa/api<br>
                            <strong>Sandbox:</strong> https://gateway.sandbox.kinguin.net/esa/api
                        </p>
                    </div>

                    <button type="submit" name="submit" class="kinguin-btn">Ayarları Kaydet</button>
                </form>
            </div>

            <div class="kinguin-card">
                <h3>API Bilgileri</h3>
                <table class="kinguin-data-table">
                    <tr>
                        <th>Endpoint</th>
                        <td><?php echo $this->get_api_url(); ?></td>
                    </tr>
                    <tr>
                        <th>Durum</th>
                        <td><?php echo empty($api_key) ? '<span style="color: red;">❌ API anahtarı ayarlanmamış</span>' : '<span style="color: green;">✓ API anahtarı ayarlandı</span>'; ?></td>
                    </tr>
                    <tr>
                        <th>Mod</th>
                        <td><?php echo $use_sandbox == '1' ? 'Sandbox (Test)' : 'Production (Canlı)'; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }

    /**
     * API URL'ini al
     */
    private function get_api_url() {
        $use_sandbox = get_option('kinguin_use_sandbox', '0');
        return $use_sandbox == '1' ? $this->sandbox_url : $this->api_base_url;
    }

    /**
     * Kinguin API'den ürünleri çek
     */
    public function fetch_products($params = []) {
        if (empty($this->api_key)) {
            return new WP_Error('no_api_key', 'API anahtarı ayarlanmamış');
        }

        $default_params = [
            'page' => 1,
            'limit' => 25,
            'sortBy' => 'updatedAt',
            'sortType' => 'desc'
        ];

        $params = array_merge($default_params, $params);

        // Boş parametreleri kaldır
        $params = array_filter($params, function($value) {
            return $value !== '' && $value !== null;
        });

        $url = $this->get_api_url() . '/v1/products?' . http_build_query($params);

        $response = wp_remote_get($url, [
            'headers' => [
                'X-Api-Key' => $this->api_key,
                'Accept' => 'application/json'
            ],
            'timeout' => 30
        ]);

        if (is_wp_error($response)) {
            return $response;
        }

        $status_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($status_code !== 200) {
            return new WP_Error('api_error', 'API Hatası: HTTP ' . $status_code . ' - ' . $body);
        }

        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error('json_error', 'JSON çözümleme hatası: ' . json_last_error_msg());
        }

        return $data;
    }

    /**
     * Ürünü WordPress'e kaydet
     */
    public function save_product_to_wordpress($product_data) {
        // Önce bu ürün daha önce içe aktarılmış mı kontrol et
        $existing_post = $this->find_existing_product($product_data['kinguinId']);

        $post_data = [
            'post_title' => sanitize_text_field($product_data['name']),
            'post_content' => wp_kses_post($product_data['description'] ?? ''),
            'post_status' => 'publish',
            'post_type' => 'post'
        ];

        if ($existing_post) {
            // Güncelle
            $post_data['ID'] = $existing_post->ID;
            $post_id = wp_update_post($post_data);
        } else {
            // Yeni oluştur
            $post_id = wp_insert_post($post_data);
        }

        if (is_wp_error($post_id)) {
            return $post_id;
        }

        // TÜM API verisini JSON olarak kaydet
        update_post_meta($post_id, '_kinguin_full_data', $product_data);

        // Kinguin ID'yi ayrıca kaydet (arama için)
        update_post_meta($post_id, '_kinguin_id', $product_data['kinguinId']);

        // Sık kullanılabilecek alanları ayrı meta olarak da kaydet
        update_post_meta($post_id, '_kinguin_price', $product_data['price'] ?? 0);
        update_post_meta($post_id, '_kinguin_platform', $product_data['platform'] ?? '');
        update_post_meta($post_id, '_kinguin_qty', $product_data['qty'] ?? 0);
        update_post_meta($post_id, '_kinguin_product_id', $product_data['productId'] ?? '');
        update_post_meta($post_id, '_kinguin_updated_at', $product_data['updatedAt'] ?? '');

        // Ham API yanıtını da kaydet (debugging için)
        update_post_meta($post_id, '_kinguin_raw_response', json_encode($product_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $post_id;
    }

    /**
     * Mevcut ürünü bul
     */
    private function find_existing_product($kinguin_id) {
        $posts = get_posts([
            'post_type' => 'post',
            'meta_key' => '_kinguin_id',
            'meta_value' => $kinguin_id,
            'posts_per_page' => 1,
            'post_status' => 'any'
        ]);

        return !empty($posts) ? $posts[0] : null;
    }

    /**
     * AJAX: Ürünleri içe aktar
     */
    public function ajax_import_products() {
        check_ajax_referer('kinguin_import', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Yetkiniz yok']);
        }

        $limit = intval($_POST['limit'] ?? 25);
        $page = intval($_POST['page'] ?? 1);
        $name = sanitize_text_field($_POST['name'] ?? '');
        $platform = sanitize_text_field($_POST['platform'] ?? '');

        $params = [
            'limit' => min($limit, 100),
            'page' => max($page, 1)
        ];

        if (!empty($name) && strlen($name) >= 3) {
            $params['name'] = $name;
        }

        if (!empty($platform)) {
            $params['platform'] = $platform;
        }

        $result = $this->fetch_products($params);

        if (is_wp_error($result)) {
            wp_send_json_error(['message' => $result->get_error_message()]);
        }

        $imported = 0;
        $errors = [];
        $total_found = $result['item_count'] ?? 0;

        if (!empty($result['results']) && is_array($result['results'])) {
            foreach ($result['results'] as $product) {
                $post_id = $this->save_product_to_wordpress($product);

                if (is_wp_error($post_id)) {
                    $errors[] = 'Hata: ' . $product['name'] . ' - ' . $post_id->get_error_message();
                } else {
                    $imported++;
                }
            }
        }

        wp_send_json_success([
            'imported' => $imported,
            'total_found' => $total_found,
            'errors' => $errors,
            'params' => $params
        ]);
    }

    /**
     * Post editor'da metabox ekle
     */
    public function add_product_metabox() {
        add_meta_box(
            'kinguin_product_data',
            'Kinguin Ürün Bilgileri',
            [$this, 'render_product_metabox'],
            'post',
            'normal',
            'high'
        );
    }

    /**
     * Metabox içeriğini render et
     */
    public function render_product_metabox($post) {
        $kinguin_id = get_post_meta($post->ID, '_kinguin_id', true);

        if (empty($kinguin_id)) {
            echo '<p>Bu post bir Kinguin ürünü değil.</p>';
            return;
        }

        $full_data = get_post_meta($post->ID, '_kinguin_full_data', true);
        $raw_response = get_post_meta($post->ID, '_kinguin_raw_response', true);

        ?>
        <div class="kinguin-metabox">
            <div class="kinguin-tabs">
                <div class="kinguin-tab active" data-tab="tab-summary">Özet</div>
                <div class="kinguin-tab" data-tab="tab-details">Detaylar</div>
                <div class="kinguin-tab" data-tab="tab-offers">Teklifler</div>
                <div class="kinguin-tab" data-tab="tab-raw">Ham JSON</div>
            </div>

            <!-- Özet Tab -->
            <div id="tab-summary" class="kinguin-tab-content active">
                <div class="kinguin-metabox-section">
                    <h4>Temel Bilgiler</h4>
                    <table class="kinguin-data-table">
                        <tr>
                            <th style="width: 200px;">Kinguin ID</th>
                            <td><?php echo esc_html($full_data['kinguinId'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Product ID</th>
                            <td><?php echo esc_html($full_data['productId'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ürün Adı</th>
                            <td><?php echo esc_html($full_data['name'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Orijinal Ad</th>
                            <td><?php echo esc_html($full_data['originalName'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Platform</th>
                            <td><?php echo esc_html($full_data['platform'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Fiyat (EUR)</th>
                            <td><strong>€<?php echo esc_html($full_data['price'] ?? '0.00'); ?></strong></td>
                        </tr>
                        <tr>
                            <th>Stok (Qty)</th>
                            <td><?php echo esc_html($full_data['qty'] ?? '0'); ?></td>
                        </tr>
                        <tr>
                            <th>Toplam Stok</th>
                            <td><?php echo esc_html($full_data['totalQty'] ?? '0'); ?></td>
                        </tr>
                        <tr>
                            <th>Text Serials</th>
                            <td><?php echo esc_html($full_data['textQty'] ?? '0'); ?></td>
                        </tr>
                        <tr>
                            <th>Teklif Sayısı</th>
                            <td><?php echo esc_html($full_data['offersCount'] ?? '0'); ?></td>
                        </tr>
                        <tr>
                            <th>Çıkış Tarihi</th>
                            <td><?php echo esc_html($full_data['releaseDate'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Ön Sipariş</th>
                            <td><?php echo !empty($full_data['isPreorder']) ? '✓ Evet' : '✗ Hayır'; ?></td>
                        </tr>
                        <tr>
                            <th>Metacritic Puanı</th>
                            <td><?php echo esc_html($full_data['metacriticScore'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Yaş Sınırı</th>
                            <td><?php echo esc_html($full_data['ageRating'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Son Güncelleme</th>
                            <td><?php echo esc_html($full_data['updatedAt'] ?? 'N/A'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Detaylar Tab -->
            <div id="tab-details" class="kinguin-tab-content">
                <div class="kinguin-metabox-section">
                    <h4>Geliştiriciler</h4>
                    <p><?php echo !empty($full_data['developers']) ? esc_html(implode(', ', $full_data['developers'])) : 'Bilgi yok'; ?></p>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Yayıncılar</h4>
                    <p><?php echo !empty($full_data['publishers']) ? esc_html(implode(', ', $full_data['publishers'])) : 'Bilgi yok'; ?></p>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Türler</h4>
                    <p><?php echo !empty($full_data['genres']) ? esc_html(implode(', ', $full_data['genres'])) : 'Bilgi yok'; ?></p>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Diller</h4>
                    <p><?php echo !empty($full_data['languages']) ? esc_html(implode(', ', $full_data['languages'])) : 'Bilgi yok'; ?></p>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Etiketler</h4>
                    <p><?php echo !empty($full_data['tags']) ? esc_html(implode(', ', $full_data['tags'])) : 'Bilgi yok'; ?></p>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Bölge Kısıtlamaları</h4>
                    <table class="kinguin-data-table">
                        <tr>
                            <th style="width: 200px;">Bölge ID</th>
                            <td><?php echo esc_html($full_data['regionId'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Bölge Adı</th>
                            <td><?php echo esc_html($full_data['regionalLimitations'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <th>Kısıtlı Ülkeler</th>
                            <td><?php echo !empty($full_data['countryLimitation']) ? esc_html(implode(', ', $full_data['countryLimitation'])) : 'Yok'; ?></td>
                        </tr>
                    </table>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Aktivasyon Detayları</h4>
                    <p><?php echo !empty($full_data['activationDetails']) ? nl2br(esc_html($full_data['activationDetails'])) : 'Bilgi yok'; ?></p>
                </div>

                <?php if (!empty($full_data['systemRequirements'])): ?>
                <div class="kinguin-metabox-section">
                    <h4>Sistem Gereksinimleri</h4>
                    <?php foreach ($full_data['systemRequirements'] as $req): ?>
                        <p><strong><?php echo esc_html($req['system'] ?? 'N/A'); ?>:</strong></p>
                        <p style="white-space: pre-wrap; background: #f5f5f5; padding: 10px; border-radius: 3px;"><?php echo esc_html($req['requirement'] ?? 'Bilgi yok'); ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($full_data['images'])): ?>
                <div class="kinguin-metabox-section">
                    <h4>Görseller</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 10px;">
                        <?php foreach (array_slice($full_data['images'], 0, 6) as $image): ?>
                            <?php if (!empty($image['url'])): ?>
                                <img src="<?php echo esc_url($image['url']); ?>" style="width: 100%; height: auto; border-radius: 3px;" alt="Product Image">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="kinguin-metabox-section">
                    <h4>Satıcılar</h4>
                    <p><?php echo !empty($full_data['merchantName']) ? esc_html(implode(', ', (array)$full_data['merchantName'])) : 'Bilgi yok'; ?></p>
                </div>
            </div>

            <!-- Teklifler Tab -->
            <div id="tab-offers" class="kinguin-tab-content">
                <div class="kinguin-metabox-section">
                    <h4>Satıcı Teklifleri (<?php echo count($full_data['offers'] ?? []); ?> adet)</h4>

                    <?php if (!empty($full_data['offers'])): ?>
                        <table class="kinguin-data-table">
                            <thead>
                                <tr>
                                    <th>Teklif ID</th>
                                    <th>Satıcı</th>
                                    <th>Fiyat</th>
                                    <th>Stok</th>
                                    <th>Text Qty</th>
                                    <th>Ön Sipariş</th>
                                    <th>Toptan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($full_data['offers'], 0, 20) as $offer): ?>
                                    <tr>
                                        <td><?php echo esc_html($offer['offerId'] ?? 'N/A'); ?></td>
                                        <td><?php echo esc_html($offer['merchantName'] ?? 'N/A'); ?></td>
                                        <td><strong>€<?php echo esc_html($offer['price'] ?? '0.00'); ?></strong></td>
                                        <td><?php echo esc_html($offer['qty'] ?? '0'); ?></td>
                                        <td><?php echo esc_html($offer['textQty'] ?? '0'); ?></td>
                                        <td><?php echo !empty($offer['isPreorder']) ? '✓' : '✗'; ?></td>
                                        <td>
                                            <?php if (!empty($offer['wholesale']['enabled'])): ?>
                                                ✓ Aktif
                                                <?php if (!empty($offer['wholesale']['tiers'])): ?>
                                                    <br><small>
                                                    <?php foreach ($offer['wholesale']['tiers'] as $tier): ?>
                                                        Level <?php echo $tier['level']; ?>: €<?php echo $tier['price']; ?><br>
                                                    <?php endforeach; ?>
                                                    </small>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                ✗
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php if (count($full_data['offers']) > 20): ?>
                            <p><em>İlk 20 teklif gösteriliyor. Tümünü görmek için "Ham JSON" sekmesine bakın.</em></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Teklif bulunamadı.</p>
                    <?php endif; ?>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>En Ucuz Teklif ID'leri</h4>
                    <p><?php echo !empty($full_data['cheapestOfferId']) ? esc_html(implode(', ', (array)$full_data['cheapestOfferId'])) : 'Bilgi yok'; ?></p>
                </div>
            </div>

            <!-- Ham JSON Tab -->
            <div id="tab-raw" class="kinguin-tab-content">
                <div class="kinguin-metabox-section">
                    <h4>Tam API Yanıtı (JSON)</h4>
                    <p><em>API'den gelen tüm veriler aşağıda gösterilmektedir:</em></p>
                    <div class="kinguin-json-viewer">
                        <pre><?php echo esc_html($raw_response); ?></pre>
                    </div>
                </div>

                <div class="kinguin-metabox-section">
                    <h4>Meta Anahtarları</h4>
                    <table class="kinguin-data-table">
                        <tr>
                            <th style="width: 300px;">Meta Key</th>
                            <th>Açıklama</th>
                        </tr>
                        <tr>
                            <td><code>_kinguin_full_data</code></td>
                            <td>Tüm ürün verisi (array/object)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_raw_response</code></td>
                            <td>Ham JSON yanıt (string)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_id</code></td>
                            <td>Kinguin ID (arama için)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_price</code></td>
                            <td>Fiyat (float)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_platform</code></td>
                            <td>Platform (string)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_qty</code></td>
                            <td>Stok miktarı (int)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_product_id</code></td>
                            <td>Product ID (string)</td>
                        </tr>
                        <tr>
                            <td><code>_kinguin_updated_at</code></td>
                            <td>Son güncelleme (datetime)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }
}

// Plugin'i başlat
new Kinguin_Product_Importer();
