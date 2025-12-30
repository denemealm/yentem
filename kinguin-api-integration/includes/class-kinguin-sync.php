<?php
/**
 * Kinguin Senkronizasyon Sınıfı
 *
 * Ürünleri Kinguin API'den çeker ve WordPress'e kaydeder
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kinguin_Sync {

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
        add_action('kinguin_sync_products', array($this, 'sync_products'));
    }

    /**
     * Ürünleri senkronize et
     *
     * @return int|WP_Error Senkronize edilen ürün sayısı veya hata
     */
    public function sync_products() {
        // Otomatik senkronizasyon kapalıysa atla
        if (!get_option('kinguin_auto_sync_enabled', true)) {
            return new WP_Error('sync_disabled', 'Otomatik senkronizasyon devre dışı.');
        }

        $api = Kinguin_API::get_instance();

        // API key kontrolü
        if (!$api->has_api_key()) {
            return new WP_Error('no_api_key', 'API anahtarı tanımlanmamış.');
        }

        // Kaç ürün çekileceğini al
        $limit = get_option('kinguin_products_per_sync', 50);

        // API'den ürünleri çek
        $response = $api->get_products(array(
            'limit' => $limit,
            'page' => 1,
            'sortBy' => 'popularity',
            'sortType' => 'desc',
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        // Ürün verisi kontrolü
        if (!isset($response['results']) || !is_array($response['results'])) {
            return new WP_Error('invalid_response', 'API yanıtında ürün bulunamadı.');
        }

        $products = $response['results'];
        $synced_count = 0;

        // Her ürünü kaydet
        foreach ($products as $product_data) {
            $result = Kinguin_CPT::sync_product($product_data);

            if (!is_wp_error($result)) {
                $synced_count++;
            }

            // Sunucu yükünü azaltmak için kısa bekleme
            usleep(100000); // 0.1 saniye
        }

        // Son senkronizasyon zamanını kaydet
        update_option('kinguin_last_sync_time', current_time('mysql'));
        update_option('kinguin_last_sync_count', $synced_count);

        return $synced_count;
    }

    /**
     * Belirli bir ürünü senkronize et
     *
     * @param string $product_id Kinguin Product ID
     * @return int|WP_Error Post ID veya hata
     */
    public function sync_single_product($product_id) {
        $api = Kinguin_API::get_instance();

        $product_data = $api->get_product($product_id);

        if (is_wp_error($product_data)) {
            return $product_data;
        }

        return Kinguin_CPT::sync_product($product_data);
    }

    /**
     * Kategori bazlı senkronizasyon
     *
     * @param string $category Kategori adı
     * @param int $limit Limit
     * @return int|WP_Error
     */
    public function sync_by_category($category, $limit = 50) {
        $api = Kinguin_API::get_instance();

        $response = $api->get_products(array(
            'category' => $category,
            'limit' => $limit,
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        if (!isset($response['results']) || !is_array($response['results'])) {
            return new WP_Error('invalid_response', 'API yanıtında ürün bulunamadı.');
        }

        $synced_count = 0;

        foreach ($response['results'] as $product_data) {
            $result = Kinguin_CPT::sync_product($product_data);

            if (!is_wp_error($result)) {
                $synced_count++;
            }

            usleep(100000);
        }

        return $synced_count;
    }

    /**
     * Arama bazlı senkronizasyon
     *
     * @param string $query Arama terimi
     * @param int $limit Limit
     * @return int|WP_Error
     */
    public function sync_by_search($query, $limit = 50) {
        $api = Kinguin_API::get_instance();

        $response = $api->search_products($query, array(
            'limit' => $limit,
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        if (!isset($response['results']) || !is_array($response['results'])) {
            return new WP_Error('invalid_response', 'Arama sonucu bulunamadı.');
        }

        $synced_count = 0;

        foreach ($response['results'] as $product_data) {
            $result = Kinguin_CPT::sync_product($product_data);

            if (!is_wp_error($result)) {
                $synced_count++;
            }

            usleep(100000);
        }

        return $synced_count;
    }

    /**
     * Mevcut ürünleri güncelle
     *
     * @return int Güncellenen ürün sayısı
     */
    public function update_existing_products() {
        $args = array(
            'post_type' => 'kinguin_product',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key' => '_kinguin_id',
                    'compare' => 'EXISTS',
                ),
            ),
        );

        $product_ids = get_posts($args);
        $updated_count = 0;

        foreach ($product_ids as $post_id) {
            $kinguin_id = get_post_meta($post_id, '_kinguin_id', true);

            if ($kinguin_id) {
                $result = $this->sync_single_product($kinguin_id);

                if (!is_wp_error($result)) {
                    $updated_count++;
                }

                // Rate limiting
                usleep(200000); // 0.2 saniye
            }
        }

        return $updated_count;
    }

    /**
     * Eski/stoksuz ürünleri temizle
     *
     * @param int $days Kaç gün önce güncellenmemiş
     * @return int Silinen ürün sayısı
     */
    public function cleanup_old_products($days = 30) {
        $date_threshold = date('Y-m-d H:i:s', strtotime("-{$days} days"));

        $args = array(
            'post_type' => 'kinguin_product',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'key' => '_kinguin_last_sync',
                    'value' => $date_threshold,
                    'compare' => '<',
                    'type' => 'DATETIME',
                ),
            ),
        );

        $old_products = get_posts($args);
        $deleted_count = 0;

        foreach ($old_products as $post_id) {
            // Taslağa al (silme yerine)
            wp_update_post(array(
                'ID' => $post_id,
                'post_status' => 'draft',
            ));
            $deleted_count++;
        }

        return $deleted_count;
    }

    /**
     * Stok kontrolü ve güncelleme
     *
     * @param int $post_id WordPress Post ID
     * @return bool
     */
    public function update_product_stock($post_id) {
        $kinguin_id = get_post_meta($post_id, '_kinguin_id', true);

        if (!$kinguin_id) {
            return false;
        }

        $result = $this->sync_single_product($kinguin_id);

        return !is_wp_error($result);
    }
}
