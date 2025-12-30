# Kinguin API Integration - WordPress Plugin

WordPress sitenize Kinguin dijital ürünlerini entegre etmenizi sağlayan güçlü bir plugin.

## 🎮 Özellikler

- ✅ **Kinguin API v2** tam entegrasyonu
- ✅ **Otomatik ürün senkronizasyonu** (Cron job ile)
- ✅ **Modern, responsive tasarım** (3:4 aspect ratio ile)
- ✅ **Platform ve tür filtreleme**
- ✅ **Metacritic skorları**
- ✅ **Stok takibi**
- ✅ **Cache sistemi** (performans için)
- ✅ **Hata yönetimi ve logging**
- ✅ **Custom Post Type** (SEO dostu)
- ✅ **Responsive grid sistem** (mobil uyumlu)

## 📋 Gereksinimler

- WordPress 5.0 veya üzeri
- PHP 7.4 veya üzeri
- Kinguin API Key
- cURL aktif olmalı

## 🚀 Kurulum

### 1. Plugin Dosyalarını Yükleyin

**Yöntem 1: FTP ile**
```bash
1. kinguin-api-integration klasörünü wp-content/plugins/ dizinine yükleyin
2. WordPress Admin Panel'e gidin
3. Eklentiler > Yüklü Eklentiler
4. "Kinguin API Integration" eklentisini aktif edin
```

**Yöntem 2: WordPress Admin Panel**
```bash
1. kinguin-api-integration klasörünü .zip olarak sıkıştırın
2. WordPress Admin > Eklentiler > Yeni Ekle > Eklenti Yükle
3. .zip dosyasını seçip yükleyin
4. Eklentiyi aktif edin
```

### 2. API Key Ayarlayın

```bash
1. Sol menüden "Kinguin Ürünler > Ayarlar" sayfasına gidin
2. API Key alanına Kinguin'den aldığınız anahtarı girin
3. "Ayarları Kaydet" butonuna tıklayın
```

**API Key nasıl alınır?**
- https://www.kinguin.net/integration adresine gidin
- Kayıt olun
- API Key'inizi alın

### 3. İlk Senkronizasyonu Yapın

```bash
1. Ayarlar sayfasında "Şimdi Senkronize Et" butonuna tıklayın
2. Ürünlerin yüklenmesini bekleyin
3. Sol menüden "Kinguin Ürünler > Tüm Ürünler" ile kontrol edin
```

## ⚙️ Ayarlar

### Otomatik Senkronizasyon

Plugin, belirttiğiniz aralıklarda otomatik olarak ürünleri günceller:

- **Saatlik**: Her saat başı
- **Günde 2 Kez**: Sabah ve akşam
- **Günlük**: Günde bir kez

### Senkronizasyon Başına Ürün

API'den her seferinde kaç ürün çekileceğini belirler (10-200 arası).

**Öneri**: İlk kurulumda 50, sonrasında 100 yapabilirsiniz.

## 📱 Kullanım

### Ürün Sayfalarını Görüntüleme

Plugin aktif olduktan sonra:

- **Ana liste**: `siteniz.com/oyunlar/`
- **Platform filtresi**: `siteniz.com/platform/steam/`
- **Tür filtresi**: `siteniz.com/tur/aksiyon/`
- **Tek ürün**: `siteniz.com/oyunlar/urun-adi/`

### Shortcode Kullanımı

Herhangi bir sayfaya/yazıya ürün listesi ekleyin:

```php
// Basit kullanım
[kinguin_products]

// Limit ile
[kinguin_products limit="12"]

// Belirli platform
[kinguin_products platform="steam" limit="8"]

// Belirli tür
[kinguin_products genre="aksiyon" limit="12"]
```

**Not**: Shortcode fonksiyonu eklenmesi gerekiyorsa aşağıdaki kodu functions.php'ye ekleyin:

```php
function kinguin_products_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 12,
        'platform' => '',
        'genre' => '',
    ), $atts);

    $args = array(
        'post_type' => 'kinguin_product',
        'posts_per_page' => intval($atts['limit']),
    );

    if (!empty($atts['platform'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'kinguin_platform',
            'field' => 'slug',
            'terms' => $atts['platform'],
        );
    }

    if (!empty($atts['genre'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'kinguin_genre',
            'field' => 'slug',
            'terms' => $atts['genre'],
        );
    }

    $query = new WP_Query($args);

    ob_start();
    if ($query->have_posts()) {
        echo '<div class="kinguin-products-grid">';
        while ($query->have_posts()) {
            $query->the_post();
            // Template kısmı buraya gelecek
        }
        echo '</div>';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('kinguin_products', 'kinguin_products_shortcode');
```

## 🎨 Tema Uyumluluğu

Plugin, mevcut temanızla uyumlu çalışır:

- `get_header()` ve `get_footer()` kullanır
- Tema renklerine müdahale etmez
- Kendi CSS'ini yükler (gerekirse override edebilirsiniz)

### CSS Özelleştirme

Temanızın `style.css` dosyasına ekleyerek özelleştirin:

```css
/* Ürün kartı renk değişikliği */
.kinguin-product-card {
    border: 2px solid #your-color;
}

/* Fiyat rengi */
.kinguin-price {
    color: #your-brand-color;
}

/* Buton stilleri */
.kinguin-btn-primary {
    background: #your-button-color;
}
```

## 🔧 Gelişmiş Kullanım

### Manuel Ürün Ekleme

Admin panelden manuel ürün de ekleyebilirsiniz:

```bash
1. Kinguin Ürünler > Yeni Ekle
2. Ürün bilgilerini girin
3. Görseli yükleyin
4. Platform ve türü seçin
5. Yayınla
```

### Cache Temizleme

API istekleri 1 saat boyunca cache'lenir. Manuel temizleme:

```bash
Ayarlar sayfasında "Cache Temizle" butonuna tıklayın
```

### Hata Logları

API hatalarını görmek için:

```bash
Ayarlar sayfasının altında "Son Hatalar" bölümünü kontrol edin
```

## 🖼️ Görsel Yönetimi

### 3:4 Aspect Ratio

Plugin, tüm ürün kapakları için **3:4 oran** kullanır:

- Farklı boyutlardaki görseller aynı oranda gösterilir
- `object-fit: cover` ile kırpmadan doldurulur
- Mobil uyumlu responsive tasarım

### Önerilen Görsel Boyutları

- **Liste sayfası**: 300x400px (otomatik thumbnail)
- **Detay sayfası**: 600x800px veya daha büyük
- **Format**: JPG veya PNG

## 📊 Performans İpuçları

1. **Cache kullanın**: Otomatik aktiftir, temizlemeyin
2. **Senkronizasyon sınırı**: İlk kurulumda 50, sonra 100
3. **Lazy loading**: Otomatik aktif
4. **CDN kullanın**: Görseller için
5. **Cron ayarı**: Düşük trafikli saatlerde çalıştırın

## ❓ Sık Sorulan Sorular

### Ürünler görünmüyor?

1. API Key'i doğru mu kontrol edin
2. "Şimdi Senkronize Et" butonuna tıklayın
3. Hata loglarını kontrol edin
4. Permalink'leri güncelleyin (Ayarlar > Kalıcı Bağlantılar > Kaydet)

### Görseller yüklenmiyor?

1. WordPress klasörlerine yazma yetkisi var mı kontrol edin
2. `wp-content/uploads/` klasörü yazılabilir olmalı
3. PHP `allow_url_fopen` aktif olmalı

### Satın alma özelliği yok?

Bu plugin **yalnızca ürün gösterimi** yapar. Satın alma için:

- WooCommerce entegrasyonu yapın
- Veya Kinguin Order API'sini entegre edin
- Ödeme gateway'i ekleyin

## 🔐 Güvenlik

- API Key güvenli şekilde veritabanında saklanır
- SQL Injection koruması var
- XSS koruması var
- Nonce verification kullanılır
- Capability check yapılır

## 🛠️ Teknik Detaylar

### Dosya Yapısı

```
kinguin-api-integration/
├── kinguin-api-integration.php  (Ana plugin dosyası)
├── includes/
│   ├── class-kinguin-api.php    (API sınıfı)
│   ├── class-kinguin-cpt.php    (Custom Post Type)
│   ├── class-kinguin-admin.php  (Admin sayfası)
│   └── class-kinguin-sync.php   (Senkronizasyon)
├── templates/
│   ├── archive-kinguin_product.php  (Liste şablonu)
│   └── single-kinguin_product.php   (Detay şablonu)
└── assets/
    ├── css/
    │   └── kinguin-products.css
    └── js/
        └── kinguin-products.js
```

### Veritabanı

Plugin, WordPress'in standart tablolarını kullanır:

- `wp_posts` (ürünler için)
- `wp_postmeta` (ürün meta verileri)
- `wp_terms` (kategoriler/platformlar)
- `wp_options` (ayarlar ve cache)

### API Endpoints Kullanılan

- `GET /products` - Ürün listesi
- `GET /products/{id}` - Tek ürün
- `GET /products/categories` - Kategoriler

## 📝 Changelog

### Version 1.0.0 (2024)
- İlk sürüm
- Kinguin API v2 entegrasyonu
- Otomatik senkronizasyon
- Responsive tasarım
- 3:4 aspect ratio görsel yönetimi

## 🤝 Destek

Sorun yaşıyorsanız:

1. Hata loglarını kontrol edin
2. WordPress Debug modunu aktif edin
3. API Key'inizi kontrol edin
4. GitHub'da issue açın

## 📄 Lisans

GPL v2 veya üzeri

## 👨‍💻 Geliştirici

Yentem Digital Solutions

---

**Not**: Bu plugin, Kinguin'in resmi bir ürünü değildir. Bağımsız bir entegrasyon plugin'idir.
