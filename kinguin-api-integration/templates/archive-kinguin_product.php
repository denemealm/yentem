<?php
/**
 * Kinguin Ürün Arşiv Şablonu
 *
 * Ürün listesi sayfası
 */

get_header(); ?>

<div class="kinguin-archive-wrapper">
    <div class="kinguin-container">

        <!-- Başlık ve Filtreler -->
        <div class="kinguin-archive-header">
            <h1 class="kinguin-page-title">
                <?php
                if (is_tax('kinguin_platform')) {
                    single_term_title();
                    echo ' Oyunları';
                } elseif (is_tax('kinguin_genre')) {
                    single_term_title();
                    echo ' Türü';
                } else {
                    echo 'Tüm Oyunlar';
                }
                ?>
            </h1>

            <?php
            // Ürün sayısı
            global $wp_query;
            if ($wp_query->found_posts > 0) {
                echo '<p class="kinguin-results-count">' . $wp_query->found_posts . ' ürün bulundu</p>';
            }
            ?>
        </div>

        <!-- Filtre Bölümü -->
        <div class="kinguin-filters">
            <div class="kinguin-filter-group">
                <label>Platform:</label>
                <?php
                $platforms = get_terms(array(
                    'taxonomy' => 'kinguin_platform',
                    'hide_empty' => true,
                ));

                if (!empty($platforms) && !is_wp_error($platforms)) {
                    echo '<div class="kinguin-filter-buttons">';
                    echo '<a href="' . get_post_type_archive_link('kinguin_product') . '" class="kinguin-filter-btn">Tümü</a>';
                    foreach ($platforms as $platform) {
                        $active = is_tax('kinguin_platform', $platform->slug) ? 'active' : '';
                        echo '<a href="' . get_term_link($platform) . '" class="kinguin-filter-btn ' . $active . '">' . esc_html($platform->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>

            <div class="kinguin-filter-group">
                <label>Tür:</label>
                <?php
                $genres = get_terms(array(
                    'taxonomy' => 'kinguin_genre',
                    'hide_empty' => true,
                    'number' => 10,
                ));

                if (!empty($genres) && !is_wp_error($genres)) {
                    echo '<div class="kinguin-filter-buttons">';
                    foreach ($genres as $genre) {
                        $active = is_tax('kinguin_genre', $genre->slug) ? 'active' : '';
                        echo '<a href="' . get_term_link($genre) . '" class="kinguin-filter-btn ' . $active . '">' . esc_html($genre->name) . '</a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <?php if (have_posts()): ?>

        <!-- Ürün Grid -->
        <div class="kinguin-products-grid">
            <?php while (have_posts()): the_post();
                $price = get_post_meta(get_the_ID(), '_kinguin_price', true);
                $currency = get_post_meta(get_the_ID(), '_kinguin_currency', true);
                $platform = get_post_meta(get_the_ID(), '_kinguin_platform', true);
                $stock = get_post_meta(get_the_ID(), '_kinguin_stock', true);
                $metacritic = get_post_meta(get_the_ID(), '_kinguin_metacritic_score', true);
            ?>

            <article class="kinguin-product-card">
                <a href="<?php the_permalink(); ?>" class="kinguin-product-link">

                    <!-- Görsel Konteyneri (3:4 Aspect Ratio) -->
                    <div class="kinguin-product-image">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                        <?php else: ?>
                            <div class="kinguin-no-image">
                                <span class="dashicons dashicons-games"></span>
                            </div>
                        <?php endif; ?>

                        <!-- Stok Badge -->
                        <?php if ($stock && $stock > 0): ?>
                            <span class="kinguin-badge kinguin-badge-stock">Stokta</span>
                        <?php else: ?>
                            <span class="kinguin-badge kinguin-badge-out">Tükendi</span>
                        <?php endif; ?>

                        <!-- Metacritic Skoru -->
                        <?php if ($metacritic && $metacritic > 0): ?>
                            <span class="kinguin-badge kinguin-badge-score" style="background: <?php echo $metacritic >= 75 ? '#6c3' : ($metacritic >= 50 ? '#fc3' : '#f00'); ?>">
                                <?php echo esc_html($metacritic); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Ürün Bilgileri -->
                    <div class="kinguin-product-info">
                        <?php if ($platform): ?>
                            <span class="kinguin-platform"><?php echo esc_html($platform); ?></span>
                        <?php endif; ?>

                        <h2 class="kinguin-product-title"><?php the_title(); ?></h2>

                        <?php if (has_excerpt()): ?>
                            <p class="kinguin-product-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></p>
                        <?php endif; ?>

                        <!-- Fiyat -->
                        <div class="kinguin-product-footer">
                            <?php if ($price): ?>
                                <span class="kinguin-price">
                                    <?php echo number_format($price, 2, ',', '.'); ?>
                                    <small><?php echo esc_html($currency ?: 'EUR'); ?></small>
                                </span>
                            <?php endif; ?>
                            <span class="kinguin-view-btn">Detaylar →</span>
                        </div>
                    </div>

                </a>
            </article>

            <?php endwhile; ?>
        </div>

        <!-- Sayfalama -->
        <div class="kinguin-pagination">
            <?php
            echo paginate_links(array(
                'prev_text' => '← Önceki',
                'next_text' => 'Sonraki →',
                'type' => 'list',
            ));
            ?>
        </div>

        <?php else: ?>

        <!-- Ürün Bulunamadı -->
        <div class="kinguin-no-products">
            <span class="dashicons dashicons-games" style="font-size: 64px; opacity: 0.3;"></span>
            <h2>Ürün Bulunamadı</h2>
            <p>Aradığınız kriterlere uygun ürün bulunamadı.</p>
            <a href="<?php echo get_post_type_archive_link('kinguin_product'); ?>" class="button">Tüm Ürünleri Görüntüle</a>
        </div>

        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>
