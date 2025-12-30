/**
 * Kinguin Products JavaScript
 *
 * Frontend interaktif fonksiyonlar
 */

(function($) {
    'use strict';

    $(document).ready(function() {

        /**
         * Lazy Loading için Intersection Observer
         */
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            observer.unobserve(img);
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        /**
         * Smooth scroll
         */
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 600);
            }
        });

        /**
         * Sepete ekle fonksiyonu (placeholder)
         * Gerçek implementasyon için WooCommerce veya özel sepet sistemi gerekir
         */
        $('.kinguin-add-to-cart').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');
            const $button = $(this);

            // Button state
            $button.prop('disabled', true).text('Ekleniyor...');

            // AJAX isteği (örnek)
            // Bu kısım WooCommerce veya özel sepet API'si ile entegre edilmeli
            console.log('Sepete eklenecek ürün ID:', productId);

            // Simulated delay
            setTimeout(function() {
                $button.prop('disabled', false).html('<span class="dashicons dashicons-cart"></span> Sepete Ekle');
                alert('Sepet fonksiyonu henüz entegre edilmedi.\n\nBu özellik için:\n- WooCommerce entegrasyonu\n- Veya özel sepet sistemi gereklidir.');
            }, 500);
        });

        /**
         * Hemen satın al fonksiyonu (placeholder)
         */
        $('.kinguin-buy-now').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');

            console.log('Satın alınacak ürün ID:', productId);

            alert('Satın alma fonksiyonu henüz entegre edilmedi.\n\nBu özellik için:\n- Kinguin Order API entegrasyonu\n- Ödeme gateway entegrasyonu gereklidir.');
        });

        /**
         * Filtre toggle (mobil için)
         */
        if (window.innerWidth < 768) {
            const $filterGroups = $('.kinguin-filter-group');

            $filterGroups.each(function() {
                const $group = $(this);
                const $label = $group.find('label');

                $label.css('cursor', 'pointer').on('click', function() {
                    $group.find('.kinguin-filter-buttons').slideToggle(200);
                });
            });
        }

        /**
         * Görsel hata yönetimi
         */
        $('.kinguin-product-image img').on('error', function() {
            const $container = $(this).parent();
            $(this).hide();

            if (!$container.find('.kinguin-no-image').length) {
                $container.append('<div class="kinguin-no-image"><span class="dashicons dashicons-games"></span></div>');
            }
        });

        /**
         * Toast notification sistemi (opsiyonel)
         */
        window.kinguinToast = function(message, type = 'info') {
            const toast = $('<div class="kinguin-toast kinguin-toast-' + type + '">' + message + '</div>');

            $('body').append(toast);

            setTimeout(function() {
                toast.addClass('show');
            }, 100);

            setTimeout(function() {
                toast.removeClass('show');
                setTimeout(function() {
                    toast.remove();
                }, 300);
            }, 3000);
        };

        /**
         * Ürün karşılaştırma (gelecek özellik)
         */
        let compareProducts = [];

        $('.kinguin-compare-btn').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');

            if (compareProducts.includes(productId)) {
                compareProducts = compareProducts.filter(id => id !== productId);
                $(this).removeClass('active');
            } else {
                if (compareProducts.length >= 4) {
                    alert('En fazla 4 ürün karşılaştırabilirsiniz.');
                    return;
                }
                compareProducts.push(productId);
                $(this).addClass('active');
            }

            console.log('Karşılaştırma listesi:', compareProducts);
        });

        /**
         * Quick View Modal (gelecek özellik placeholder)
         */
        $('.kinguin-quick-view').on('click', function(e) {
            e.preventDefault();
            const productId = $(this).data('product-id');

            console.log('Quick view:', productId);
            // Modal açılacak
        });

    });

})(jQuery);

/**
 * CSS for toast notifications
 */
const toastStyles = `
<style>
.kinguin-toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 16px 24px;
    background: #212529;
    color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 9999;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s;
}

.kinguin-toast.show {
    opacity: 1;
    transform: translateY(0);
}

.kinguin-toast-success {
    background: #28a745;
}

.kinguin-toast-error {
    background: #dc3545;
}

.kinguin-toast-warning {
    background: #ffc107;
    color: #000;
}

.kinguin-toast-info {
    background: #0d6efd;
}
</style>
`;

if (typeof document !== 'undefined') {
    document.head.insertAdjacentHTML('beforeend', toastStyles);
}
