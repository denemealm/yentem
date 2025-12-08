<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim - TEKNOPOLIS</title>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font:16px/1.5 system-ui,sans-serif;color:#0f172a;background:#f8fafc}
        a{color:inherit;text-decoration:none}
        img{max-width:100%;display:block}

        :root{
            --blue:#2563eb;
            --dark:#0f172a;
            --gray:#64748b;
            --border:#e2e8f0;
            --w:min(94vw,1200px)
        }

        .hd{position:sticky;top:0;height:60px;background:rgba(255,255,255,.98);border-bottom:1px solid var(--border);z-index:100;display:flex;align-items:center}
        .hd-in{width:var(--w);margin:0 auto;display:flex;justify-content:space-between;font-weight:700}
        .lg{font:800 1.3rem/1 system-ui;letter-spacing:-.5px}
        .lg span{color:var(--blue)}
        .cart-count{background:var(--blue);color:#fff;font:.75rem/1 system-ui;padding:4px 8px;border-radius:12px;margin-left:8px}

        .main{width:var(--w);margin:15px auto 4rem}
        .bc{font:.8rem/1 system-ui;color:var(--gray);margin-bottom:15px}
        .bc span{color:var(--dark);font-weight:600}

        .page-title{font:800 1.8rem/1.32 system-ui;margin-bottom:10px;letter-spacing:-.5px}

        .digital-info{background:linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);border:1px solid #0ea5e9;border-radius:8px;padding:15px;margin-bottom:20px;font:.9rem/1.4 system-ui;color:#0369a1}
        .digital-info strong{color:#0c4a6e}

        .cart-container{display:flex;gap:30px}
        .cart-left{flex:2}
        .cart-right{flex:1}

        .cart-item{background:#fff;border:1px solid var(--border);border-radius:8px;padding:20px;margin-bottom:20px;display:flex;gap:20px;align-items:flex-start}
        .item-img{width:160px;height:90px;border-radius:8px;object-fit:cover;border:1px solid var(--border);flex-shrink:0}
        .item-details{flex:1;display:flex;flex-direction:column;gap:8px}
        .item-name{font:700 1.1rem/1.3 system-ui;color:var(--dark);margin:0}
        .item-features{font:.85rem/1.3 system-ui;color:var(--gray);margin:0}
        .item-type{font:.75rem/1 system-ui;color:var(--blue);background:#f0f7ff;padding:4px 10px;border-radius:12px;display:inline-block;width:fit-content}
        .item-controls{display:flex;align-items:center;gap:15px;margin-top:auto}
        .quantity{display:flex;align-items:center;gap:8px}
        .qty-btn{width:30px;height:30px;border:1px solid var(--border);background:#f8fafc;border-radius:4px;cursor:pointer;display:flex;align-items:center;justify-content:center;font:600 .9rem/1 system-ui}
        .qty-btn:hover{background:var(--blue);color:#fff;border-color:var(--blue)}
        .qty-input{width:50px;text-align:center;border:1px solid var(--border);border-radius:4px;padding:6px;font:.9rem/1 system-ui}
        .remove-btn{background:none;border:none;color:var(--gray);cursor:pointer;font:.8rem/1 system-ui;padding:5px}
        .remove-btn:hover{color:#ef4444}

        .summary{background:#fff;border:1px solid var(--border);border-radius:8px;padding:20px;position:sticky;top:80px}
        .summary-title{font:700 1.2rem/1.3 system-ui;margin-bottom:15px;color:var(--dark)}
        .summary-row{display:flex;justify-content:space-between;margin-bottom:10px;font:.9rem/1 system-ui}
        .summary-row.total{border-top:1px solid var(--border);padding-top:10px;margin-top:15px;font:700 1.1rem/1 system-ui;color:var(--dark)}
        .checkout-btn{width:100%;background:var(--dark);color:#fff;border:0;padding:15px;font:700 1rem/1 system-ui;border-radius:8px;cursor:pointer;margin-top:15px}
        .checkout-btn:hover{background:var(--blue)}
        .continue-shopping{display:block;text-align:center;font:.9rem/1 system-ui;color:var(--blue);margin-top:10px;padding:10px}
        .continue-shopping:hover{text-decoration:underline}

        .item-price{text-align:right;align-self:flex-start;margin-left:auto}
        .price-current{font:800 1.3rem/1 system-ui;color:var(--blue)}

        .delivery-note{background:#f0fdf4;border:1px solid #16a34a;border-radius:6px;padding:10px;margin-top:15px;font:.8rem/1.2 system-ui;color:#15803d}

        .empty-cart{text-align:center;padding:40px 20px;background:#fff;border:1px solid var(--border);border-radius:8px}
        .empty-icon{font-size:3rem;margin-bottom:15px;opacity:.5}
        .empty-title{font:700 1.2rem/1.3 system-ui;margin-bottom:8px;color:var(--dark)}
        .empty-desc{font:.9rem/1.4 system-ui;color:var(--gray);margin-bottom:20px}

        .ft{background:var(--dark);color:#94a3b8;margin-top:4rem;padding:2rem 0;text-align:center}

        @media(max-width:900px){
            .cart-container{flex-direction:column;gap:15px}
            .cart-item{flex-direction:column;text-align:left;align-items:stretch;padding:15px}
            .item-img{width:100%;height:180px;margin:0 0 15px}
            .item-controls{justify-content:flex-start}
            .item-price{text-align:left;margin-left:0;align-self:stretch}
        }
    </style>
</head>
<body>

    <header class="hd">
        <div class="hd-in">
            <div class="lg">TEKNO<span>POLIS</span></div>
            <div>SEPET<span class="cart-count">3</span></div>
        </div>
    </header>

    <div class="main">

        <nav class="bc">
            <a href="#">Anasayfa</a> / <span>Sepetim</span>
        </nav>

        <h1 class="page-title">Sepetim</h1>

        <div class="cart-container">
            <div class="cart-left">

                <div class="cart-item">
                    <img src="https://placehold.co/320x180/007bff/ffffff?text=Premium+Plugin" alt="Premium Plugin" class="item-img">
                    <div class="item-details">
                        <h3 class="item-name">Premium E-ticaret Plugin Paketi</h3>
                        <p class="item-features">WooCommerce Eklentileri • Tema Dahil • 1 Yıl Güncelleme</p>
                        <div class="item-controls">
                            <div class="quantity">
                                <button class="qty-btn">-</button>
                                <input type="number" value="1" min="1" class="qty-input">
                                <button class="qty-btn">+</button>
                            </div>
                            <button class="remove-btn">Sil</button>
                        </div>
                    </div>
                    <div class="item-price">
                        <div class="price-current">299 TL</div>
                    </div>
                </div>

                <div class="cart-item">
                    <img src="https://placehold.co/320x180/28a745/ffffff?text=JavaScript+Course" alt="JavaScript Course" class="item-img">
                    <div class="item-details">
                        <h3 class="item-name">JavaScript Masterclass - Sıfırdan İleri Seviye</h3>
                        <p class="item-features">40 Saat Video • Proje Örnekleri • Sertifika • Yaşam Boyu Erişim</p>
                        <div class="item-controls">
                            <div class="quantity">
                                <button class="qty-btn">-</button>
                                <input type="number" value="1" min="1" class="qty-input">
                                <button class="qty-btn">+</button>
                            </div>
                            <button class="remove-btn">Sil</button>
                        </div>
                    </div>
                    <div class="item-price">
                        <div class="price-current">199 TL</div>
                    </div>
                </div>

                <div class="cart-item">
                    <img src="https://placehold.co/320x180/6c757d/ffffff?text=Web+Design+Book" alt="Web Design E-book" class="item-img">
                    <div class="item-details">
                        <h3 class="item-name">Modern Web Tasarım Rehberi 2024</h3>
                        <p class="item-features">PDF Format • 250 Sayfa • Kod Örnekleri • Bonus Şablonlar</p>
                        <div class="item-controls">
                            <div class="quantity">
                                <button class="qty-btn">-</button>
                                <input type="number" value="2" min="1" class="qty-input">
                                <button class="qty-btn">+</button>
                            </div>
                            <button class="remove-btn">Sil</button>
                        </div>
                    </div>
                    <div class="item-price">
                        <div class="price-current">49 TL</div>
                    </div>
                </div>

            </div>

            <div class="cart-right">
                <div class="summary">
                    <h2 class="summary-title">Sipariş Özeti</h2>

                    <div class="summary-row">
                        <span>Ürün Tutarı (4 adet)</span>
                        <span>596 TL</span>
                    </div>
                    <div class="summary-row">
                        <span>KDV (%18)</span>
                        <span>107,28 TL</span>
                    </div>

                    <div class="summary-row total">
                        <span>Toplam</span>
                        <span>703,28 TL</span>
                    </div>

                    <button class="checkout-btn">Ödeme Sayfasına Git</button>
                    <a href="#" class="continue-shopping">Alışverişe Devam Et</a>

                    <div class="delivery-note">
                        <strong>📦 Anında Teslimat:</strong><br>
                        Ödeme sonrası ürünler anında e-postanıza gönderilir.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="ft">
        © 2025 Teknopolis. Tüm hakları saklıdır.
    </footer>

    <script>
        // Quantity controls
        document.querySelectorAll('.qty-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const input = btn.parentNode.querySelector('.qty-input');
                const isIncrement = btn.textContent === '+';
                let value = parseInt(input.value);

                if (isIncrement) {
                    value++;
                } else if (value > 1) {
                    value--;
                }

                input.value = value;
                updateTotals();
            });
        });

        // Remove item
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (confirm('Bu ürünü sepetten çıkarmak istediğinizden emin misiniz?')) {
                    btn.closest('.cart-item').remove();
                    updateTotals();
                }
            });
        });

        function updateTotals() {
            // Bu fonksiyon gerçek projede backend ile iletişime geçer
            console.log('Toplam güncellendi');
        }
    </script>

</body>
</html>
