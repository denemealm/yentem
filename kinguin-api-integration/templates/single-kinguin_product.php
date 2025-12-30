<?php
/**
 * Kinguin Ürün Detay Şablonu
 *
 * Tek ürün detay sayfası
 */

get_header();

while (have_posts()): the_post();
    // Meta verileri al
    $price = get_post_meta(get_the_ID(), '_kinguin_price', true);
    $currency = get_post_meta(get_the_ID(), '_kinguin_currency', true);
    $platform = get_post_meta(get_the_ID(), '_kinguin_platform', true);
    $stock = get_post_meta(get_the_ID(), '_kinguin_stock', true);
    $release_date = get_post_meta(get_the_ID(), '_kinguin_release_date', true);
    $developers = get_post_meta(get_the_ID(), '_kinguin_developers', true);
    $publishers = get_post_meta(get_the_ID(), '_kinguin_publishers', true);
    $age_rating = get_post_meta(get_the_ID(), '_kinguin_age_rating', true);
    $metacritic = get_post_meta(get_the_ID(), '_kinguin_metacritic_score', true);
    $kinguin_id = get_post_meta(get_the_ID(), '_kinguin_id', true);
?>

<article class="kinguin-single-product">
    <div class="kinguin-container">

        <!-- Breadcrumb -->
        <div class="kinguin-breadcrumb">
            <a href="<?php echo home_url(); ?>">Ana Sayfa</a>
            <span>/</span>
            <a href="<?php echo get_post_type_archive_link('kinguin_product'); ?>">Oyunlar</a>
            <span>/</span>
            <span><?php the_title(); ?></span>
        </div>

        <!-- Ürün Ana Bölümü -->
        <div class="kinguin-product-main">

            <!-- Sol Kolon: Görsel ve Galeri -->
            <div class="kinguin-product-media">
                <?php if (has_post_thumbnail()): ?>
                    <div class="kinguin-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php else: ?>
                    <div class="kinguin-no-image-large">
                        <span class="dashicons dashicons-games"></span>
                    </div>
                <?php endif; ?>

                <!-- Galeri (Screenshot'lar API'den geldiyse) -->
                <?php
                // Not: Screenshot'ları meta olarak kaydetmek gerekebilir
                // Şimdilik featured image kullanıyoruz
                ?>
            </div>

            <!-- Sağ Kolon: Ürün Bilgileri ve Satın Alma -->
            <div class="kinguin-product-sidebar">

                <h1 class="kinguin-single-title"><?php the_title(); ?></h1>

                <!-- Platform ve Metacritic -->
                <div class="kinguin-meta-badges">
                    <?php if ($platform): ?>
                        <span class="kinguin-badge kinguin-badge-platform"><?php echo esc_html($platform); ?></span>
                    <?php endif; ?>

                    <?php if ($metacritic && $metacritic > 0): ?>
                        <span class="kinguin-badge kinguin-badge-metacritic"
                              style="background: <?php echo $metacritic >= 75 ? '#6c3' : ($metacritic >= 50 ? '#fc3' : '#f00'); ?>">
                            Metacritic: <?php echo esc_html($metacritic); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($age_rating): ?>
                        <span class="kinguin-badge kinguin-badge-age"><?php echo esc_html($age_rating); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Fiyat ve Stok -->
                <div class="kinguin-price-box">
                    <?php if ($price): ?>
                        <div class="kinguin-price-large">
                            <?php echo number_format($price, 2, ',', '.'); ?>
                            <span class="kinguin-currency"><?php echo esc_html($currency ?: 'EUR'); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($stock && $stock > 0): ?>
                        <p class="kinguin-stock-status in-stock">✓ Stokta mevcut</p>
                    <?php else: ?>
                        <p class="kinguin-stock-status out-of-stock">✗ Stokta yok</p>
                    <?php endif; ?>
                </div>

                <!-- Satın Alma Butonu -->
                <div class="kinguin-purchase-actions">
                    <?php if ($stock && $stock > 0): ?>
                        <button class="kinguin-btn kinguin-btn-primary kinguin-add-to-cart" data-product-id="<?php echo get_the_ID(); ?>">
                            <span class="dashicons dashicons-cart"></span>
                            Sepete Ekle
                        </button>
                        <button class="kinguin-btn kinguin-btn-secondary kinguin-buy-now" data-product-id="<?php echo get_the_ID(); ?>">
                            Hemen Satın Al
                        </button>
                    <?php else: ?>
                        <button class="kinguin-btn kinguin-btn-disabled" disabled>
                            Stokta Yok
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Ürün Özellikleri -->
                <div class="kinguin-product-features">
                    <h3>Ürün Özellikleri</h3>
                    <ul>
                        <?php if ($release_date): ?>
                            <li><strong>Çıkış Tarihi:</strong> <?php echo date('d.m.Y', strtotime($release_date)); ?></li>
                        <?php endif; ?>

                        <?php if ($developers): ?>
                            <li><strong>Geliştirici:</strong> <?php echo esc_html($developers); ?></li>
                        <?php endif; ?>

                        <?php if ($publishers): ?>
                            <li><strong>Yayıncı:</strong> <?php echo esc_html($publishers); ?></li>
                        <?php endif; ?>

                        <?php
                        $genres = get_the_terms(get_the_ID(), 'kinguin_genre');
                        if ($genres && !is_wp_error($genres)):
                        ?>
                            <li>
                                <strong>Tür:</strong>
                                <?php
                                $genre_names = array();
                                foreach ($genres as $genre) {
                                    $genre_names[] = $genre->name;
                                }
                                echo implode(', ', $genre_names);
                                ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Sosyal Paylaşım -->
                <div class="kinguin-social-share">
                    <p><strong>Paylaş:</strong></p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="kinguin-share-btn facebook">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="kinguin-share-btn twitter">
                        Twitter
                    </a>
                    <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_permalink()); ?>" target="_blank" class="kinguin-share-btn whatsapp">
                        WhatsApp
                    </a>
                </div>

            </div>

        </div>

        <!-- Alt Bölüm: Açıklama ve Detaylar -->
        <div class="kinguin-product-details">

            <!-- Tab Navigasyon -->
            <div class="kinguin-tabs">
                <button class="kinguin-tab-btn active" data-tab="description">Açıklama</button>
                <button class="kinguin-tab-btn" data-tab="details">Detaylar</button>
                <button class="kinguin-tab-btn" data-tab="reviews">Değerlendirmeler</button>
            </div>

            <!-- Tab İçerikleri -->
            <div class="kinguin-tab-content active" id="tab-description">
                <div class="kinguin-description">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="kinguin-tab-content" id="tab-details">
                <table class="kinguin-details-table">
                    <tbody>
                        <?php if ($kinguin_id): ?>
                            <tr>
                                <th>Kinguin ID</th>
                                <td><?php echo esc_html($kinguin_id); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($platform): ?>
                            <tr>
                                <th>Platform</th>
                                <td><?php echo esc_html($platform); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($release_date): ?>
                            <tr>
                                <th>Çıkış Tarihi</th>
                                <td><?php echo date('d F Y', strtotime($release_date)); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($developers): ?>
                            <tr>
                                <th>Geliştiriciler</th>
                                <td><?php echo esc_html($developers); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($publishers): ?>
                            <tr>
                                <th>Yayıncılar</th>
                                <td><?php echo esc_html($publishers); ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($age_rating): ?>
                            <tr>
                                <th>Yaş Sınırı</th>
                                <td><?php echo esc_html($age_rating); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="kinguin-tab-content" id="tab-reviews">
                <div class="kinguin-reviews">
                    <?php if ($metacritic && $metacritic > 0): ?>
                        <div class="kinguin-metacritic-score">
                            <h3>Metacritic Puanı</h3>
                            <div class="score-circle" style="background: <?php echo $metacritic >= 75 ? '#6c3' : ($metacritic >= 50 ? '#fc3' : '#f00'); ?>">
                                <?php echo esc_html($metacritic); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    // WordPress yorumları
                    if (comments_open() || get_comments_number()):
                        comments_template();
                    endif;
                    ?>
                </div>
            </div>

        </div>

        <!-- İlgili Ürünler -->
        <?php
        $related_args = array(
            'post_type' => 'kinguin_product',
            'posts_per_page' => 4,
            'post__not_in' => array(get_the_ID()),
            'tax_query' => array(),
        );

        // Aynı platformdan ürünler
        if ($platform) {
            $related_args['meta_query'] = array(
                array(
                    'key' => '_kinguin_platform',
                    'value' => $platform,
                    'compare' => '=',
                ),
            );
        }

        $related = new WP_Query($related_args);

        if ($related->have_posts()):
        ?>
        <div class="kinguin-related-products">
            <h2>Benzer Ürünler</h2>
            <div class="kinguin-products-grid">
                <?php while ($related->have_posts()): $related->the_post();
                    $rel_price = get_post_meta(get_the_ID(), '_kinguin_price', true);
                    $rel_currency = get_post_meta(get_the_ID(), '_kinguin_currency', true);
                ?>
                <article class="kinguin-product-card">
                    <a href="<?php the_permalink(); ?>">
                        <div class="kinguin-product-image">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else: ?>
                                <div class="kinguin-no-image"><span class="dashicons dashicons-games"></span></div>
                            <?php endif; ?>
                        </div>
                        <div class="kinguin-product-info">
                            <h3 class="kinguin-product-title"><?php the_title(); ?></h3>
                            <?php if ($rel_price): ?>
                                <span class="kinguin-price"><?php echo number_format($rel_price, 2, ',', '.'); ?> <?php echo esc_html($rel_currency ?: 'EUR'); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</article>

<?php endwhile; ?>

<?php get_footer(); ?>

<script>
// Tab sistemi
jQuery(document).ready(function($) {
    $('.kinguin-tab-btn').on('click', function() {
        var tab = $(this).data('tab');

        $('.kinguin-tab-btn').removeClass('active');
        $(this).addClass('active');

        $('.kinguin-tab-content').removeClass('active');
        $('#tab-' + tab).addClass('active');
    });

    // Sepete ekle (placeholder)
    $('.kinguin-add-to-cart').on('click', function() {
        alert('Sepet fonksiyonu henüz entegre edilmedi. Bu, WooCommerce veya özel sepet sistemi gerektirir.');
    });

    $('.kinguin-buy-now').on('click', function() {
        alert('Satın alma fonksiyonu henüz entegre edilmedi. Kinguin API ile sipariş entegrasyonu gerekir.');
    });
});
</script>
