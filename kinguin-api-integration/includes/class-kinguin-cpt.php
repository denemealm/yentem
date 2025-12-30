<?php
/**
 * Kinguin Custom Post Type Sınıfı
 *
 * Kinguin ürünleri için custom post type ve taxonomies
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kinguin_CPT {

    /**
     * Singleton instance
     */
    private static $instance = null;

    /**
     * Post type slug
     */
    const POST_TYPE = 'kinguin_product';

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
        add_action('init', array($this, 'register_post_type'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
    }

    /**
     * Custom Post Type kaydet
     */
    public static function register_post_type() {
        $labels = array(
            'name'                  => 'Kinguin Ürünleri',
            'singular_name'         => 'Kinguin Ürünü',
            'menu_name'             => 'Kinguin Ürünler',
            'name_admin_bar'        => 'Kinguin Ürün',
            'add_new'               => 'Yeni Ekle',
            'add_new_item'          => 'Yeni Ürün Ekle',
            'new_item'              => 'Yeni Ürün',
            'edit_item'             => 'Ürünü Düzenle',
            'view_item'             => 'Ürünü Görüntüle',
            'all_items'             => 'Tüm Ürünler',
            'search_items'          => 'Ürün Ara',
            'parent_item_colon'     => 'Üst Ürün:',
            'not_found'             => 'Ürün bulunamadı.',
            'not_found_in_trash'    => 'Çöp kutusunda ürün bulunamadı.',
        );

        $args = array(
            'labels'                => $labels,
            'description'           => 'Kinguin API\'den senkronize edilen ürünler',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'query_var'             => true,
            'rewrite'               => array('slug' => 'oyunlar'),
            'capability_type'       => 'post',
            'has_archive'           => true,
            'hierarchical'          => false,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-games',
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
            'show_in_rest'          => true,
        );

        register_post_type(self::POST_TYPE, $args);
    }

    /**
     * Taxonomies kaydet
     */
    public function register_taxonomies() {
        // Platform taxonomy
        $platform_labels = array(
            'name'              => 'Platformlar',
            'singular_name'     => 'Platform',
            'search_items'      => 'Platform Ara',
            'all_items'         => 'Tüm Platformlar',
            'parent_item'       => 'Üst Platform',
            'parent_item_colon' => 'Üst Platform:',
            'edit_item'         => 'Platformu Düzenle',
            'update_item'       => 'Platformu Güncelle',
            'add_new_item'      => 'Yeni Platform Ekle',
            'new_item_name'     => 'Yeni Platform Adı',
            'menu_name'         => 'Platformlar',
        );

        register_taxonomy('kinguin_platform', array(self::POST_TYPE), array(
            'hierarchical'      => true,
            'labels'            => $platform_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'platform'),
            'show_in_rest'      => true,
        ));

        // Genre taxonomy
        $genre_labels = array(
            'name'              => 'Türler',
            'singular_name'     => 'Tür',
            'search_items'      => 'Tür Ara',
            'all_items'         => 'Tüm Türler',
            'parent_item'       => 'Üst Tür',
            'parent_item_colon' => 'Üst Tür:',
            'edit_item'         => 'Türü Düzenle',
            'update_item'       => 'Türü Güncelle',
            'add_new_item'      => 'Yeni Tür Ekle',
            'new_item_name'     => 'Yeni Tür Adı',
            'menu_name'         => 'Türler',
        );

        register_taxonomy('kinguin_genre', array(self::POST_TYPE), array(
            'hierarchical'      => true,
            'labels'            => $genre_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'tur'),
            'show_in_rest'      => true,
        ));
    }

    /**
     * Meta box'ları ekle
     */
    public function add_meta_boxes() {
        add_meta_box(
            'kinguin_product_details',
            'Ürün Detayları',
            array($this, 'render_product_details_meta_box'),
            self::POST_TYPE,
            'normal',
            'high'
        );

        add_meta_box(
            'kinguin_product_pricing',
            'Fiyatlandırma',
            array($this, 'render_pricing_meta_box'),
            self::POST_TYPE,
            'side',
            'high'
        );
    }

    /**
     * Ürün detayları meta box
     */
    public function render_product_details_meta_box($post) {
        wp_nonce_field('kinguin_product_meta', 'kinguin_product_meta_nonce');

        $kinguin_id = get_post_meta($post->ID, '_kinguin_id', true);
        $product_id = get_post_meta($post->ID, '_kinguin_product_id', true);
        $platform = get_post_meta($post->ID, '_kinguin_platform', true);
        $release_date = get_post_meta($post->ID, '_kinguin_release_date', true);
        $developers = get_post_meta($post->ID, '_kinguin_developers', true);
        $publishers = get_post_meta($post->ID, '_kinguin_publishers', true);
        $age_rating = get_post_meta($post->ID, '_kinguin_age_rating', true);
        $metacritic = get_post_meta($post->ID, '_kinguin_metacritic_score', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="kinguin_id">Kinguin ID</label></th>
                <td>
                    <input type="text" id="kinguin_id" name="kinguin_id" value="<?php echo esc_attr($kinguin_id); ?>" class="regular-text" readonly>
                    <p class="description">Kinguin API'den otomatik alınır.</p>
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_product_id">Product ID</label></th>
                <td>
                    <input type="text" id="kinguin_product_id" name="kinguin_product_id" value="<?php echo esc_attr($product_id); ?>" class="regular-text" readonly>
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_platform">Platform</label></th>
                <td>
                    <input type="text" id="kinguin_platform" name="kinguin_platform" value="<?php echo esc_attr($platform); ?>" class="regular-text">
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_release_date">Çıkış Tarihi</label></th>
                <td>
                    <input type="date" id="kinguin_release_date" name="kinguin_release_date" value="<?php echo esc_attr($release_date); ?>">
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_developers">Geliştiriciler</label></th>
                <td>
                    <input type="text" id="kinguin_developers" name="kinguin_developers" value="<?php echo esc_attr($developers); ?>" class="regular-text">
                    <p class="description">Virgülle ayırın.</p>
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_publishers">Yayıncılar</label></th>
                <td>
                    <input type="text" id="kinguin_publishers" name="kinguin_publishers" value="<?php echo esc_attr($publishers); ?>" class="regular-text">
                    <p class="description">Virgülle ayırın.</p>
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_age_rating">Yaş Sınırı</label></th>
                <td>
                    <input type="text" id="kinguin_age_rating" name="kinguin_age_rating" value="<?php echo esc_attr($age_rating); ?>" class="small-text">
                </td>
            </tr>
            <tr>
                <th><label for="kinguin_metacritic">Metacritic Skoru</label></th>
                <td>
                    <input type="number" id="kinguin_metacritic" name="kinguin_metacritic" value="<?php echo esc_attr($metacritic); ?>" class="small-text" min="0" max="100">
                </td>
            </tr>
        </table>
        <?php
    }

    /**
     * Fiyatlandırma meta box
     */
    public function render_pricing_meta_box($post) {
        $price = get_post_meta($post->ID, '_kinguin_price', true);
        $currency = get_post_meta($post->ID, '_kinguin_currency', true);
        $stock = get_post_meta($post->ID, '_kinguin_stock', true);
        $last_sync = get_post_meta($post->ID, '_kinguin_last_sync', true);
        ?>
        <p>
            <label for="kinguin_price"><strong>Fiyat</strong></label><br>
            <input type="number" id="kinguin_price" name="kinguin_price" value="<?php echo esc_attr($price); ?>" step="0.01" style="width: 100%;">
        </p>
        <p>
            <label for="kinguin_currency"><strong>Para Birimi</strong></label><br>
            <input type="text" id="kinguin_currency" name="kinguin_currency" value="<?php echo esc_attr($currency ?: 'EUR'); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="kinguin_stock"><strong>Stok</strong></label><br>
            <input type="number" id="kinguin_stock" name="kinguin_stock" value="<?php echo esc_attr($stock); ?>" style="width: 100%;">
        </p>
        <?php if ($last_sync): ?>
        <p>
            <small><strong>Son Senkronizasyon:</strong><br><?php echo esc_html($last_sync); ?></small>
        </p>
        <?php endif; ?>
        <?php
    }

    /**
     * Meta box verilerini kaydet
     */
    public function save_meta_boxes($post_id) {
        // Nonce kontrolü
        if (!isset($_POST['kinguin_product_meta_nonce']) || !wp_verify_nonce($_POST['kinguin_product_meta_nonce'], 'kinguin_product_meta')) {
            return;
        }

        // Autosave kontrolü
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Yetki kontrolü
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Meta verileri kaydet
        $fields = array(
            'kinguin_id',
            'kinguin_product_id',
            'kinguin_platform',
            'kinguin_release_date',
            'kinguin_developers',
            'kinguin_publishers',
            'kinguin_age_rating',
            'kinguin_metacritic',
            'kinguin_price',
            'kinguin_currency',
            'kinguin_stock',
        );

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
            }
        }
    }

    /**
     * Ürün kaydı güncelle/oluştur
     *
     * @param array $product_data Kinguin API'den gelen ürün verisi
     * @return int|WP_Error Post ID veya hata
     */
    public static function sync_product($product_data) {
        if (empty($product_data['kinguinId'])) {
            return new WP_Error('invalid_data', 'Ürün verisi geçersiz: kinguinId eksik');
        }

        // Mevcut ürünü ara
        $existing = get_posts(array(
            'post_type' => self::POST_TYPE,
            'meta_key' => '_kinguin_id',
            'meta_value' => $product_data['kinguinId'],
            'posts_per_page' => 1,
            'post_status' => 'any',
        ));

        $post_id = null;
        if ($existing) {
            $post_id = $existing[0]->ID;
        }

        // Post verisi hazırla
        $post_data = array(
            'post_title'    => sanitize_text_field($product_data['name']),
            'post_content'  => wp_kses_post($product_data['description'] ?? ''),
            'post_status'   => 'publish',
            'post_type'     => self::POST_TYPE,
        );

        if ($post_id) {
            $post_data['ID'] = $post_id;
            wp_update_post($post_data);
        } else {
            $post_id = wp_insert_post($post_data);
        }

        if (is_wp_error($post_id)) {
            return $post_id;
        }

        // Meta verileri kaydet
        update_post_meta($post_id, '_kinguin_id', $product_data['kinguinId']);
        update_post_meta($post_id, '_kinguin_product_id', $product_data['productId'] ?? '');
        update_post_meta($post_id, '_kinguin_price', $product_data['price'] ?? 0);
        update_post_meta($post_id, '_kinguin_currency', 'EUR');
        update_post_meta($post_id, '_kinguin_platform', $product_data['platform'] ?? '');
        update_post_meta($post_id, '_kinguin_release_date', $product_data['releaseDate'] ?? '');
        update_post_meta($post_id, '_kinguin_developers', implode(', ', $product_data['developers'] ?? array()));
        update_post_meta($post_id, '_kinguin_publishers', implode(', ', $product_data['publishers'] ?? array()));
        update_post_meta($post_id, '_kinguin_age_rating', $product_data['ageRating'] ?? '');
        update_post_meta($post_id, '_kinguin_metacritic_score', $product_data['metacriticScore'] ?? 0);
        update_post_meta($post_id, '_kinguin_last_sync', current_time('mysql'));

        // Stok bilgisi
        if (isset($product_data['offers']) && is_array($product_data['offers'])) {
            $total_stock = 0;
            foreach ($product_data['offers'] as $offer) {
                $total_stock += intval($offer['qty'] ?? 0);
            }
            update_post_meta($post_id, '_kinguin_stock', $total_stock);
        }

        // Kapak görseli kaydet
        $api = Kinguin_API::get_instance();
        $cover_url = $api->get_image_url($product_data, 'cover', false);
        if ($cover_url) {
            self::set_featured_image_from_url($post_id, $cover_url);
        }

        // Taxonomies
        if (!empty($product_data['platform'])) {
            wp_set_object_terms($post_id, $product_data['platform'], 'kinguin_platform');
        }

        if (!empty($product_data['genres']) && is_array($product_data['genres'])) {
            wp_set_object_terms($post_id, $product_data['genres'], 'kinguin_genre');
        }

        return $post_id;
    }

    /**
     * URL'den featured image ayarla
     *
     * @param int $post_id Post ID
     * @param string $image_url Görsel URL
     */
    private static function set_featured_image_from_url($post_id, $image_url) {
        // Mevcut thumbnail varsa atla
        if (has_post_thumbnail($post_id)) {
            return;
        }

        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $image_id = media_sideload_image($image_url, $post_id, null, 'id');

        if (!is_wp_error($image_id)) {
            set_post_thumbnail($post_id, $image_id);
        }
    }
}
