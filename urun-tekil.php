<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASUS RTX 4070 Ti - TEKNOPOLIS</title>
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

        .main{width:var(--w);margin:15px auto 4rem}
        .bc{font:.8rem/1 system-ui;color:var(--gray);margin-bottom:15px}
        .bc span{color:var(--dark);font-weight:600}

        .container{display:flex;gap:35px}

        .header-mobile{display:none}

        .left{width:50%;background:#fff;border:1px solid var(--border);border-radius:8px;padding:12px 10px;position:sticky;top:80px;height:fit-content}
        .main-img{width:100%;height:auto;border-radius:7px;filter:drop-shadow(0 8px 16px rgba(0,0,0,.1));margin-bottom:10px}
        .thumbs{display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:15px}
        .thumb{width:100%;aspect-ratio:16/9;border:1px solid var(--border);border-radius:5px;cursor:pointer;object-fit:cover;opacity:.8}
        .thumb:hover{opacity:1;border-color:var(--blue)}
        .stock{font:.8rem/1 system-ui;color:#166534;font-weight:700;text-align:center;margin-bottom:12px}

        /* New feature cards for left side */
        .feature-cards{display:grid;grid-template-columns:1fr 1fr;gap:8px}
        .feature-card{background:linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);border:1px solid var(--border);border-radius:6px;padding:8px 10px;text-align:center;box-shadow:0 2px 4px rgba(0,0,0,.05);display:flex;align-items:center;justify-content:center;gap:6px}
        .feature-card-icon{font-size:1rem}
        .feature-card-title{font:600 .8rem/1 system-ui;color:var(--dark)}

        /* Tabbed Content System */
        .tabs-container{margin-top:25px;background:#f8fafc;border:1px solid var(--border);border-radius:8px}
        .tabs{display:flex;border-bottom:1px solid var(--border)}
        .tab{flex:1;padding:12px 15px;background:none;border:none;font:600 .85rem/1 system-ui;color:var(--gray);cursor:pointer;border-bottom:2px solid transparent}
        .tab.active{color:var(--blue);border-bottom-color:var(--blue)}
        .tab:hover{background:#f8fafc}
        .tab-content{padding:15px;background:#fff;border-radius:0 0 8px 8px}
        .tab-panel{display:none}
        .tab-panel.active{display:block}
        .tab-panel h3{font:700 1.1rem/1.3 system-ui;margin-bottom:10px;color:var(--dark)}
        .tab-panel h4{font:600 .95rem/1.3 system-ui;margin:15px 0 8px;color:var(--dark)}
        .tab-panel p{font:.9rem/1.5 system-ui;color:#475569;margin-bottom:12px}
        .tab-panel ul{margin:0 0 15px 20px}
        .tab-panel li{font:.9rem/1.4 system-ui;color:#475569;margin-bottom:5px}

        /* Review Styles */
        .review-summary{text-align:center;padding:15px 0;border-bottom:1px solid var(--border);margin-bottom:15px}
        .rating-big{font:800 2rem/1 system-ui;color:var(--blue)}
        .rating-stars{color:#fbbf24;font:700 1.2rem/1 system-ui;margin:5px 0}
        .review-count{font:.85rem/1 system-ui;color:var(--gray)}
        .review-item{margin-bottom:15px;padding-bottom:15px;border-bottom:1px solid #f1f5f9}
        .review-header{display:flex;justify-content:space-between;margin-bottom:8px}
        .reviewer{font:600 .9rem/1 system-ui;color:var(--dark)}
        .review-rating{color:#fbbf24;font:.85rem/1 system-ui}

        /* Q&A Styles */
        .qa-item{margin-bottom:15px;padding-bottom:15px;border-bottom:1px solid #f1f5f9}
        .question{font:.9rem/1.4 system-ui;color:var(--dark);margin-bottom:8px}
        .answer{font:.9rem/1.4 system-ui;color:#475569}

        .right{width:50%}
        .title{font:800 1.8rem/1.32 system-ui;margin-bottom:8px;letter-spacing:-.5px}
        .rating{color:#fbbf24;font:700 1.02rem/1 system-ui;margin-bottom:15px} /* %20 büyütüldü */
        .price-box{background:#f8fafc;padding:18px;border:1px solid var(--border);border-radius:8px;margin:12px 0 15px} /* margin azaltıldı */
        .price{font:800 2.64rem/1 system-ui;color:var(--blue)} /* %20 büyütüldü */
        .vat{font:.96rem/1 system-ui;color:var(--gray);margin-left:10px} /* %20 büyütüldü */

        /* Buttons moved to right side */
        .btns{display:flex;gap:10px;margin-bottom:25px}
        .btn-add{flex:1;background:var(--dark);color:#fff;border:0;padding:12px;font:700 1rem/1 system-ui;border-radius:8px;cursor:pointer}
        .btn-add:hover{background:var(--blue)}
        .btn-buy{flex:1;background:#fff;color:var(--dark);border:2px solid var(--dark);padding:12px;font:700 1rem/1 system-ui;border-radius:8px;cursor:pointer}
        .btn-buy:hover{background:#f1f5f9}

        .features{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:25px}
        .feat{background:#fff;border:1px solid var(--border);padding:10px 12px;border-radius:8px;font:600 .85rem/1 system-ui;color:#334155;display:flex;align-items:center;gap:8px}
        .desc{font:.95rem/1.5 system-ui;color:#475569;margin-bottom:25px}
        .specs{width:100%;border-collapse:collapse}
        .specs td{padding:8px 0;border-bottom:1px solid var(--border);font:.9rem/1 system-ui}
        .spec-key{font-weight:600;width:40%}

        .ft{background:var(--dark);color:#94a3b8;margin-top:4rem;padding:2rem 0;text-align:center}

        @media(max-width:900px){
            .container{flex-direction:column;gap:15px}
            .header-mobile{display:block;order:1}
            .left{width:100%;position:static;order:2}
            .right{width:100%;order:3}
            .desktop-only{display:none}
        }
    </style>
</head>
<body>

    <header class="hd">
        <div class="hd-in">
            <div class="lg">TEKNO<span>POLIS</span></div>
            <div>SEPET (0)</div>
        </div>
    </header>

    <div class="main">

        <nav class="bc">
            Anasayfa / Donanım / <span>Ekran Kartı</span>
        </nav>

        <div class="container">

            <div class="header-mobile">
                <h1 class="title">ASUS TUF Gaming GeForce RTX 4070 Ti 12GB GDDR6X</h1>
                <div class="rating">★★★★★ 4.9 (42 Değerlendirme)</div>
            </div>

            <div class="left">
                <img src="https://placehold.co/800x450/007bff/ffffff?text=RTX+4070+Ti" alt="ASUS RTX 4070 Ti" class="main-img">

                <div class="thumbs">
                    <img src="https://placehold.co/160x90/eee/333?text=1" class="thumb">
                    <img src="https://placehold.co/160x90/eee/333?text=2" class="thumb">
                    <img src="https://placehold.co/160x90/eee/333?text=3" class="thumb">
                    <img src="https://placehold.co/160x90/eee/333?text=4" class="thumb">
                </div>

                <div class="stock">✓ Stokta Var • Yarın Kargoda</div>

                <div class="feature-cards">
                    <div class="feature-card">
                        <div class="feature-card-icon">🎮</div>
                        <div class="feature-card-title">4K Gaming</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-card-icon">⚡</div>
                        <div class="feature-card-title">DLSS 3</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-card-icon">❄️</div>
                        <div class="feature-card-title">Sessiz Soğutma</div>
                    </div>
                    <div class="feature-card">
                        <div class="feature-card-icon">🌈</div>
                        <div class="feature-card-title">RGB Lighting</div>
                    </div>
                </div>
            </div>

            <div class="right">
                <h1 class="title desktop-only">ASUS TUF Gaming GeForce RTX 4070 Ti 12GB GDDR6X</h1>
                <div class="rating desktop-only">★★★★★ 4.9 (42 Değerlendirme)</div>

                <p class="desc">
                    Oyunlarda çığır açan performans için tasarlandı. Yeni nesil DLSS 3 teknolojisi ile FPS değerlerinizi ikiye katlayın. Metal arka plaka ve güçlendirilmiş çerçeve ile uzun ömürlü kullanım.
                </p>

                <div class="price-box">
                    <span class="price">34.999 TL</span>
                    <span class="vat">KDV Dahil</span>
                </div>

                <div class="btns">
                    <button class="btn-add">Sepete Ekle</button>
                    <button class="btn-buy">Hemen Al</button>
                </div>

                <div class="features">
                    <div class="feat">🚀 12GB GDDR6X</div>
                    <div class="feat">⚡ 2520 MHz Boost</div>
                    <div class="feat">❄️ Tri Frozr Soğutma</div>
                    <div class="feat">🌈 RGB Mystic Light</div>
                </div>

                <table class="specs">
                    <tr><td class="spec-key">GPU</td><td>RTX 4070 Ti</td></tr>
                    <tr><td class="spec-key">Bellek</td><td>12GB GDDR6X</td></tr>
                    <tr><td class="spec-key">Arayüz</td><td>192-bit</td></tr>
                    <tr><td class="spec-key">Güç</td><td>285W</td></tr>
                </table>
            </div>

        </div>

        <!-- Tabbed Content Section - Full Width -->
        <div class="tabs-container">
            <div class="tabs">
                <button class="tab active" data-tab="description">Ürün Açıklaması</button>
                <button class="tab" data-tab="reviews">Değerlendirmeler</button>
                <button class="tab" data-tab="qa">Soru & Cevap</button>
            </div>

            <div class="tab-content">
                <div class="tab-panel active" id="description">
                    <h3>Ürün Detayları</h3>
                    <p>ASUS TUF Gaming GeForce RTX 4070 Ti, oyun dünyasında çığır açan performans sunar. Ada Lovelace mimarisi ile güçlendirilmiş bu ekran kartı, 4K çözünürlükte ultra ayarlarda sorunsuz oyun deneyimi yaşamanızı sağlar.</p>

                    <h4>Öne Çıkan Özellikler:</h4>
                    <ul>
                        <li>12GB GDDR6X bellek ile yüksek bant genişliği</li>
                        <li>DLSS 3 teknolojisi ile yapay zeka destekli performans artışı</li>
                        <li>Tri Frozr soğutma sistemi ile sessiz çalışma</li>
                        <li>Metal arka plaka ile dayanıklılık</li>
                        <li>RGB Mystic Light aydınlatma sistemi</li>
                    </ul>

                    <h4>Teknik Detaylar:</h4>
                    <p>2520 MHz boost clock hızı ile optimize edilmiş performans sunar. 192-bit bellek arayüzü ve 285W güç tüketimi ile verimli çalışır.</p>
                </div>

                <div class="tab-panel" id="reviews">
                    <div class="review-summary">
                        <div class="rating-big">4.9/5</div>
                        <div class="rating-stars">★★★★★</div>
                        <div class="review-count">42 Değerlendirme</div>
                    </div>

                    <div class="review-item">
                        <div class="review-header">
                            <span class="reviewer">Ahmet K.</span>
                            <span class="review-rating">★★★★★</span>
                        </div>
                        <p>"Harika performans! 4K'da tüm oyunlar akıcı çalışıyor. Soğutma sistemi gerçekten sessiz."</p>
                    </div>

                    <div class="review-item">
                        <div class="review-header">
                            <span class="reviewer">Mehmet S.</span>
                            <span class="review-rating">★★★★★</span>
                        </div>
                        <p>"DLSS 3 teknolojisi inanılmaz! FPS değerlerinde ciddi artış var. Kesinlikle tavsiye ederim."</p>
                    </div>
                </div>

                <div class="tab-panel" id="qa">
                    <div class="qa-item">
                        <div class="question">
                            <strong>S:</strong> Bu ekran kartı 650W power supply ile çalışır mı?
                        </div>
                        <div class="answer">
                            <strong>C:</strong> Evet, 650W kaliteli bir power supply yeterli olacaktır. Önerilen minimum 700W'tır.
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="question">
                            <strong>S:</strong> Garanti süresi ne kadar?
                        </div>
                        <div class="answer">
                            <strong>C:</strong> ASUS resmi garantisi 3 yıldır. Türkiye'de geçerli uluslararası garantidir.
                        </div>
                    </div>

                    <div class="qa-item">
                        <div class="question">
                            <strong>S:</strong> Ray tracing performansı nasıl?
                        </div>
                        <div class="answer">
                            <strong>C:</strong> RTX 4070 Ti mükemmel ray tracing performansı sunar. 1440p'de ray tracing açık tüm oyunlar rahatlıkla oynanabilir.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="ft">
        © 2025 Teknopolis. Tüm hakları saklıdır.
    </footer>

    <script>
        // Tab functionality
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                const targetTab = tab.getAttribute('data-tab');

                // Remove active class from all tabs and panels
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));

                // Add active class to clicked tab and corresponding panel
                tab.classList.add('active');
                document.getElementById(targetTab).classList.add('active');
            });
        });
    </script>

</body>
</html>
