<?php
/**
 * Kinguin API Bağlantı Sınıfı
 *
 * Kinguin API v2 ile iletişim kurar
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kinguin_API {

    /**
     * Singleton instance
     */
    private static $instance = null;

    /**
     * API Base URL
     */
    private $api_base = 'https://gateway.kinguin.net/esa/api';

    /**
     * API Key
     */
    private $api_key;

    /**
     * Cache süresi (saniye)
     */
    private $cache_time = 3600; // 1 saat

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
        $this->api_key = get_option('kinguin_api_key', '');
    }

    /**
     * API Key kontrolü
     */
    public function has_api_key() {
        return !empty($this->api_key);
    }

    /**
     * API isteği gönder
     *
     * @param string $endpoint API endpoint
     * @param array $args Ek parametreler
     * @return array|WP_Error
     */
    private function make_request($endpoint, $args = array()) {
        if (!$this->has_api_key()) {
            return new WP_Error('no_api_key', 'Kinguin API anahtarı tanımlanmamış.');
        }

        $url = $this->api_base . $endpoint;

        // Query parametrelerini ekle
        if (!empty($args)) {
            $url = add_query_arg($args, $url);
        }

        // Request headers
        $headers = array(
            'X-Api-Key' => $this->api_key,
            'Accept' => 'application/json',
        );

        // WordPress HTTP API kullan
        $response = wp_remote_get($url, array(
            'headers' => $headers,
            'timeout' => 30,
        ));

        // Hata kontrolü
        if (is_wp_error($response)) {
            $this->log_error('API Request Failed: ' . $response->get_error_message());
            return $response;
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        // HTTP hata kodları
        if ($response_code !== 200) {
            $error_message = "API returned code {$response_code}";
            if ($body) {
                $error_data = json_decode($body, true);
                if (isset($error_data['message'])) {
                    $error_message .= ': ' . $error_data['message'];
                }
            }
            $this->log_error($error_message);
            return new WP_Error('api_error', $error_message);
        }

        // JSON decode
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->log_error('JSON decode error: ' . json_last_error_msg());
            return new WP_Error('json_error', 'API yanıtı geçersiz JSON formatında.');
        }

        return $data;
    }

    /**
     * Ürün listesi çek
     *
     * @param array $args Filtreleme parametreleri
     * @return array|WP_Error
     */
    public function get_products($args = array()) {
        // Cache kontrolü
        $cache_key = 'kinguin_products_' . md5(serialize($args));
        $cached = get_transient($cache_key);

        if (false !== $cached) {
            return $cached;
        }

        // Default parametreler
        $defaults = array(
            'limit' => 50,
            'page' => 1,
            'sortBy' => 'popularity', // popularity, price, name
            'sortType' => 'desc',
        );

        $params = wp_parse_args($args, $defaults);

        // API isteği
        $response = $this->make_request('/v1/products', $params);

        if (is_wp_error($response)) {
            return $response;
        }

        // Cache'e kaydet
        set_transient($cache_key, $response, $this->cache_time);

        return $response;
    }

    /**
     * Tek ürün detayı çek
     *
     * @param string $product_id Kinguin Product ID
     * @return array|WP_Error
     */
    public function get_product($product_id) {
        // Cache kontrolü
        $cache_key = 'kinguin_product_' . $product_id;
        $cached = get_transient($cache_key);

        if (false !== $cached) {
            return $cached;
        }

        // API isteği
        $response = $this->make_request('/v1/products/' . $product_id);

        if (is_wp_error($response)) {
            return $response;
        }

        // Cache'e kaydet
        set_transient($cache_key, $response, $this->cache_time);

        return $response;
    }

    /**
     * Kategorileri çek
     *
     * @return array|WP_Error
     */
    public function get_categories() {
        // Cache kontrolü
        $cache_key = 'kinguin_categories';
        $cached = get_transient($cache_key);

        if (false !== $cached) {
            return $cached;
        }

        // API isteği
        $response = $this->make_request('/v1/products/categories');

        if (is_wp_error($response)) {
            return $response;
        }

        // Cache'e kaydet
        set_transient($cache_key, $response, 86400); // 24 saat

        return $response;
    }

    /**
     * Arama yap
     *
     * @param string $query Arama terimi
     * @param array $args Ek parametreler
     * @return array|WP_Error
     */
    public function search_products($query, $args = array()) {
        $defaults = array(
            'name' => $query,
            'limit' => 50,
            'page' => 1,
        );

        $params = wp_parse_args($args, $defaults);

        return $this->get_products($params);
    }

    /**
     * Cache temizle
     *
     * @param string|null $product_id Belirli ürün için temizle (opsiyonel)
     */
    public function clear_cache($product_id = null) {
        if ($product_id) {
            delete_transient('kinguin_product_' . $product_id);
        } else {
            // Tüm cache'i temizle
            global $wpdb;
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_kinguin_%'");
            $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_kinguin_%'");
        }
    }

    /**
     * Görsel URL'ini al
     *
     * @param array $product Ürün verisi
     * @param string $type 'cover' veya 'screenshot'
     * @param bool $thumbnail Thumbnail kullan mı?
     * @return string|null
     */
    public function get_image_url($product, $type = 'cover', $thumbnail = false) {
        if (!isset($product['images'])) {
            return null;
        }

        if ($type === 'cover') {
            if ($thumbnail && isset($product['images']['cover']['thumbnail'])) {
                return $product['images']['cover']['thumbnail'];
            }
            if (isset($product['images']['cover']['url'])) {
                return $product['images']['cover']['url'];
            }
        }

        if ($type === 'screenshot') {
            if (isset($product['images']['screenshots']) && is_array($product['images']['screenshots'])) {
                $first = reset($product['images']['screenshots']);
                if ($thumbnail && isset($first['thumbnail'])) {
                    return $first['thumbnail'];
                }
                if (isset($first['url'])) {
                    return $first['url'];
                }
            }
        }

        return null;
    }

    /**
     * Tüm screenshot'ları al
     *
     * @param array $product Ürün verisi
     * @return array
     */
    public function get_screenshots($product) {
        if (!isset($product['images']['screenshots']) || !is_array($product['images']['screenshots'])) {
            return array();
        }

        return $product['images']['screenshots'];
    }

    /**
     * Hata logla
     *
     * @param string $message Hata mesajı
     */
    private function log_error($message) {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('Kinguin API Error: ' . $message);
        }

        // Veritabanına kaydet
        $logs = get_option('kinguin_api_errors', array());
        $logs[] = array(
            'message' => $message,
            'time' => current_time('mysql'),
        );

        // Son 50 hatayı sakla
        if (count($logs) > 50) {
            $logs = array_slice($logs, -50);
        }

        update_option('kinguin_api_errors', $logs);
    }

    /**
     * Son hataları al
     *
     * @param int $limit Kaç hata döndürülsün
     * @return array
     */
    public function get_errors($limit = 10) {
        $logs = get_option('kinguin_api_errors', array());
        return array_slice($logs, -$limit);
    }

    /**
     * Hata loglarını temizle
     */
    public function clear_errors() {
        delete_option('kinguin_api_errors');
    }
}
