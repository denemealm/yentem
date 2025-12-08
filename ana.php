<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEKNOPOLIS - Teknoloji Haberleri</title>
    <style>
        /* RESET & BASE */
        *{box-sizing:border-box;margin:0;padding:0}
        body{font:16px/1.5 system-ui,sans-serif;background:#f8fafc;color:#0f172a}
        a{color:inherit;text-decoration:none}
        ul{list-style:none}
        button{font:inherit;border:0;background:0;cursor:pointer}
        img{max-width:100%;display:block}

        /* VARIABLES */
        :root{
            --blue:#2563eb;
            --dark:#0f172a;
            --gray:#64748b;
            --light:#f1f5f9;
            --w:min(94vw,1200px)
        }

        /* TOP BAR */
        .tb{height:35px;background:var(--light);font-size:12px;color:var(--gray);border-bottom:1px solid #e2e8f0}
        .tb-in{width:var(--w);margin:0 auto;display:flex;justify-content:space-between;align-items:center;height:100%}
        .tb-nav{display:flex;gap:15px}
        .tb-nav a:hover{color:var(--blue)}
        .tb-soc{display:flex;gap:10px;align-items:center}
        .ico{width:14px;height:14px;fill:currentColor}

        /* HEADER */
        .hd{position:sticky;top:0;height:60px;background:rgba(255,255,255,.98);backdrop-filter:blur(8px);border-bottom:1px solid #e2e8f0;z-index:100}
        .hd-in{width:var(--w);margin:0 auto;height:100%;display:flex;align-items:center;justify-content:space-between}
        .lg{font:800 1.3rem/1 system-ui;letter-spacing:-.5px}
        .lg span{color:var(--blue)}

        /* NAV */
        .nv{display:flex;gap:5px;align-items:center;height:100%}
        .nv a{padding:6px 12px;font:600 .9rem/1 system-ui;border-radius:6px}
        .nv a:hover{background:#eff6ff;color:var(--blue)}

        /* DROPDOWN */
        .dd{position:relative;height:100%;display:flex;align-items:center}
        .dd-menu{position:absolute;top:100%;left:50%;transform:translateX(-50%) translateY(10px);width:200px;background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:5px;box-shadow:0 4px 15px rgba(0,0,0,.05);opacity:0;visibility:hidden;pointer-events:none;transition:.2s}
        .dd:hover .dd-menu{opacity:1;visibility:visible;transform:translateX(-50%);pointer-events:auto}
        .dd-item{display:block;padding:8px 10px;color:var(--gray);font-size:.85rem;border-radius:5px}
        .dd-item:hover{background:#f8fafc;color:var(--blue)}

        /* MOBILE */
        .mb{display:none}
        .drawer{position:fixed;top:0;left:0;width:100%;height:100vh;background:#fff;z-index:1000;transform:translateX(100%);transition:.3s;display:flex;flex-direction:column}
        .drawer.on{transform:translateX(0)}
        .dr-hd{height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 20px;border-bottom:1px solid #e2e8f0}
        .cl{font-size:24px}
        .dr-bd{padding:20px;overflow-y:auto;flex:1}
        .m-link{display:block;padding:12px 0;font:600 1.1rem/1 system-ui;border-bottom:1px solid #f1f5f9}
        .m-sub{padding-left:15px;font-size:.95rem;color:var(--gray);font-weight:500}
        .dr-ft{padding:20px;background:#f8fafc;border-top:1px solid #e2e8f0}
        .df-links{display:flex;gap:15px;margin-bottom:15px;font-size:.9rem;flex-wrap:wrap}
        .df-links a{color:var(--gray)}

        /* HERO SECTION */
        .hero{width:100%;background:radial-gradient(circle at top center,#f8fafc 0%,#eff6ff 40%,#fff 100%);padding:4rem 0;text-align:center;margin-bottom:3rem}
        .hero-in{width:var(--w);margin:0 auto;display:flex;flex-direction:column;align-items:center}
        .hero-tag{background:#fff;border:1px solid #e2e8f0;padding:5px 15px;border-radius:50px;font:.7rem/1 system-ui;font-weight:700;color:var(--blue);margin-bottom:1.5rem;display:inline-block;box-shadow:0 2px 5px rgba(0,0,0,.03);text-transform:uppercase}
        .hero-title{font:800 3rem/1.1 system-ui;margin:0 0 1.5rem;letter-spacing:-1.5px}
        .text-gradient{background:linear-gradient(135deg,#2563eb 0%,#9333ea 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent}
        .hero-desc{font:1.1rem/1.6 system-ui;color:var(--gray);max-width:600px;margin-bottom:2rem}
        .btn-hero{background:var(--blue);color:#fff;padding:12px 24px;border-radius:50px;font:.9rem/1 system-ui;font-weight:600}
        .btn-hero:hover{background:#1e40af;transform:translateY(-1px)}

        /* MAIN CONTENT */
        .main{width:var(--w);margin:0 auto 4rem}

        /* SECTION HEADERS */
        .sec-hd{display:flex;justify-content:space-between;align-items:center;border-left:4px solid var(--blue);padding-left:15px;margin-bottom:2rem}
        .sec-title{font:800 1.5rem/1 system-ui;margin:0}
        .sec-link{color:var(--blue);font:600 .9rem/1 system-ui}
        .sec-link:hover{text-decoration:underline}

        /* GRID LAYOUTS */
        .grid-3{display:grid;grid-template-columns:repeat(3,1fr);gap:30px;margin-bottom:3rem}
        .grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap:30px;margin-bottom:3rem}

        /* CARD DESIGN */
        .card{display:flex;flex-direction:column;transition:.2s}
        .card:hover{transform:translateY(-2px)}
        .card-img{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:8px;background:#e2e8f0;margin-bottom:12px;transition:.3s}
        .card:hover .card-img{transform:scale(1.02)}
        .card-cat{font:.75rem/1 system-ui;font-weight:700;color:var(--blue);text-transform:uppercase;margin-bottom:5px;letter-spacing:.5px}
        .card-title{font:700 1.1rem/1.4 system-ui;margin:0 0 8px;color:var(--dark)}
        .card-desc{font:.9rem/1.6 system-ui;color:var(--gray);margin:0}

        /* BANNER AREAS */
        .banner{width:100%;height:140px;background:#f8fafc;border:2px dashed #cbd5e1;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#94a3b8;font:600 1rem/1 system-ui;margin-bottom:3rem;text-align:center}
        .banner-2{height:200px}

        /* FOOTER */
        .ft{background:var(--dark);color:#94a3b8;font:.9rem/1.5 system-ui;margin-top:4rem}
        .ft-in{width:var(--w);margin:0 auto;padding:3rem 0 2rem}
        .ft-grd{display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;margin-bottom:2.5rem}
        .ft-t{color:#fff;font:700 .95rem/1 system-ui;margin-bottom:1rem;text-transform:uppercase;letter-spacing:.5px}
        .ft-links li{padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05)}
        .ft-links li:last-child{border:0}
        .ft-links a{display:block;color:#94a3b8}
        .ft-links a:hover{color:#fff}
        .ft-bot{border-top:1px solid #1e293b;padding-top:1.5rem;text-align:center;font-size:.85rem}
        .ft-info{margin-bottom:1rem}
        .soc{margin-top:1rem}
        .soc a{color:#94a3b8;margin:0 10px}
        .soc a:hover{color:#fff}

        /* RESPONSIVE */
        @media(max-width:900px){
            .nv{display:none}
            .mb{display:block}
            .tb{display:none}
            .grid-3{grid-template-columns:repeat(2,1fr)}
            .ft-grd{grid-template-columns:1fr 1fr}
            .hero-title{font-size:2.5rem}
        }
        @media(max-width:600px){
            .grid-3,.grid-2{grid-template-columns:1fr}
            .main{width:92%}
            .ft-grd{grid-template-columns:1fr}
            .ft-bot{text-align:center}
            .soc a{margin:0 10px}
            .hero-title{font-size:2rem}
            .hero{padding:3rem 0}
            .banner{height:100px;font-size:.9rem}
            .banner-2{height:120px}
        }
    </style>
</head>
<body>

    <div class="tb">
        <div class="tb-in">
            <div class="tb-nav">
                <a href="#">Hakkımızda</a>
                <a href="#">Reklam</a>
                <a href="#">İletişim</a>
            </div>
            <div class="tb-soc">
                <svg class="ico" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                <svg class="ico" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </div>
        </div>
    </div>

    <header class="hd">
        <div class="hd-in">
            <a href="#" class="lg">TEKNO<span>POLIS</span></a>

            <nav class="nv">
                <a href="#">Gündem</a>

                <div class="dd">
                    <a href="#">
                        Teknoloji
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="dd-menu">
                        <a href="#" class="dd-item">Yapay Zeka</a>
                        <a href="#" class="dd-item">Yazılım & Kod</a>
                        <a href="#" class="dd-item">Mobil Cihazlar</a>
                    </div>
                </div>

                <div class="dd">
                    <a href="#">
                        Yaşam
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="dd-menu">
                        <a href="#" class="dd-item">Seyahat</a>
                        <a href="#" class="dd-item">Sağlık</a>
                    </div>
                </div>

                <a href="#">Video</a>
            </nav>

            <button class="mb" onclick="toggleMenu()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            </button>
        </div>
    </header>

    <div class="drawer" id="drawer">
        <div class="dr-hd">
            <span class="lg">TEKNO<span>POLIS</span></span>
            <button class="cl" onclick="toggleMenu()">&times;</button>
        </div>
        <div class="dr-bd">
            <a href="#" class="m-link">Gündem</a>

            <div class="m-link" style="border:none;padding-bottom:5px">Teknoloji</div>
            <a href="#" class="m-link m-sub">Yapay Zeka</a>
            <a href="#" class="m-link m-sub">Yazılım</a>
            <a href="#" class="m-link m-sub">Donanım</a>

            <div class="m-link" style="border:none;padding-bottom:5px;margin-top:10px">Yaşam</div>
            <a href="#" class="m-link m-sub">Seyahat</a>
            <a href="#" class="m-link m-sub">Sağlık</a>
        </div>
        <div class="dr-ft">
            <div class="df-links">
                <a href="#">Hakkımızda</a>
                <a href="#">Reklam</a>
                <a href="#">Künye</a>
            </div>
            <div class="tb-soc" style="color:#64748b">
                <svg class="ico" style="width:20px;height:20px" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                <svg class="ico" style="width:20px;height:20px" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.40z"/></svg>
            </div>
        </div>
    </div>

    <section class="hero">
        <div class="hero-in">
            <span class="hero-tag">Gündem Özel</span>
            <h1 class="hero-title">
                Teknolojinin Sınırlarını <br>
                <span class="text-gradient">Bugünden Keşfedin</span>
            </h1>
            <p class="hero-desc">
                Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.
            </p>
            <a href="#" class="btn-hero">Hemen Okumaya Başla</a>
        </div>
    </section>

    <main class="main">

        <section>
            <div class="sec-hd">
                <h2 class="sec-title">Son Eklenenler</h2>
                <a href="#" class="sec-link">Tümü →</a>
            </div>

            <div class="grid-3">
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/2563eb/FFF?text=Yazılım" class="card-img" alt="Clean Code Prensipleri">
                    <div class="card-cat">Yazılım</div>
                    <h3 class="card-title">Clean Code Prensipleriyle Daha İyi Kod Yazın</h3>
                    <p class="card-desc">Sürdürülebilir projeler için uymanız gereken 5 temel kural ve pratik örnekler.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/1e40af/FFF?text=Donanım" class="card-img" alt="NVIDIA RTX 5000">
                    <div class="card-cat">Donanım</div>
                    <h3 class="card-title">NVIDIA RTX 5000 Serisi Sızıntıları</h3>
                    <p class="card-desc">Yeni nesil ekran kartlarının performans testleri ve fiyat tahminleri ortaya çıktı.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/0f172a/FFF?text=Mobile" class="card-img" alt="iOS 18 AI">
                    <div class="card-cat">Mobil</div>
                    <h3 class="card-title">iOS 18 ile Gelecek Yapay Zeka Özellikleri</h3>
                    <p class="card-desc">Siri artık çok daha akıllı olacak. İşte beklenen yenilikler ve çıkış tarihi.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/dc2626/FFF?text=Kripto" class="card-img" alt="Bitcoin Halving">
                    <div class="card-cat">Kripto</div>
                    <h3 class="card-title">Bitcoin Halving Sonrası Piyasa Analizi</h3>
                    <p class="card-desc">Uzmanların 2025 sonu için fiyat tahminleri ve yatırım önerileri.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/16a34a/FFF?text=Oyun" class="card-img" alt="GTA VI">
                    <div class="card-cat">Oyun</div>
                    <h3 class="card-title">GTA VI Haritası Hakkında Yeni Detaylar</h3>
                    <p class="card-desc">Vice City'nin modern hali düşündüğünüzden çok daha büyük olacak.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/9333ea/FFF?text=Bilim" class="card-img" alt="Mars Kolonisi">
                    <div class="card-cat">Bilim</div>
                    <h3 class="card-title">Mars Kolonisi İçin İlk Büyük Adım</h3>
                    <p class="card-desc">SpaceX'in yeni roketi başarıyla test edildi. İşte detaylar ve sonraki adımlar.</p>
                </a>
            </div>
        </section>

        <div class="banner">
            REKLAM ALANI (1200x140px)
        </div>

        <section>
            <div class="sec-hd">
                <h2 class="sec-title">Editörün Seçimi</h2>
                <a href="#" class="sec-link">Tümü →</a>
            </div>
            <div class="grid-3">
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/dbeafe/1e40af?text=Seçim+1" class="card-img" alt="Dijital Minimalizm">
                    <div class="card-cat">Yaşam</div>
                    <h3 class="card-title">Dijital Minimalizm Rehberi</h3>
                    <p class="card-desc">Teknoloji bağımlılığından kurtulmanın yolları ve pratik öneriler.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/fce7f3/9d174d?text=Seçim+2" class="card-img" alt="Remote Çalışma">
                    <div class="card-cat">Kariyer</div>
                    <h3 class="card-title">Remote Çalışma Kültürü 2025</h3>
                    <p class="card-desc">Uzaktan çalışmanın geleceği ve şirketlerin yeni stratejileri.</p>
                </a>
                <a href="#" class="card">
                    <img src="https://placehold.co/600x338/dcfce7/166534?text=Seçim+3" class="card-img" alt="Sürdürülebilir Teknoloji">
                    <div class="card-cat">Çevre</div>
                    <h3 class="card-title">Sürdürülebilir Teknoloji Trendleri</h3>
                    <p class="card-desc">Çevreye duyarlı teknoloji çözümleri ve yeşil inovasyon örnekleri.</p>
                </a>
            </div>
        </section>

        <div class="grid-2">
            <div class="banner banner-2">REKLAM ALANI 2<br>(600x200px)</div>
            <div class="banner banner-2">REKLAM ALANI 3<br>(600x200px)</div>
        </div>

        <div class="banner" style="margin-bottom:0">
            SON REKLAM ALANI (1200x140px)
        </div>

    </main>

    <footer class="ft">
        <div class="ft-in">

            <div class="ft-grd">

                <div>
                    <h6 class="ft-t">Hakkımızda</h6>
                    <ul class="ft-links">
                        <li><a href="#">Şirket Bilgileri</a></li>
                        <li><a href="#">Misyonumuz</a></li>
                        <li><a href="#">Ekibimiz</a></li>
                        <li><a href="#">Basın</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="ft-t">Kategoriler</h6>
                    <ul class="ft-links">
                        <li><a href="#">Yazılım</a></li>
                        <li><a href="#">Donanım</a></li>
                        <li><a href="#">Yapay Zeka</a></li>
                        <li><a href="#">Mobil</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="ft-t">Hizmetler</h6>
                    <ul class="ft-links">
                        <li><a href="#">Reklam</a></li>
                        <li><a href="#">Sponsorluk</a></li>
                        <li><a href="#">İletişim</a></li>
                        <li><a href="#">Kariyer</a></li>
                    </ul>
                </div>

                <div>
                    <h6 class="ft-t">Yasal</h6>
                    <ul class="ft-links">
                        <li><a href="#">Gizlilik Politikası</a></li>
                        <li><a href="#">Kullanım Şartları</a></li>
                        <li><a href="#">Çerezler</a></li>
                        <li><a href="#">KVKK</a></li>
                    </ul>
                </div>

            </div>

            <div class="ft-bot">
                <div class="ft-info">
                    <div><strong>TEKNO<span style="color:#3b82f6">POLIS</span></strong></div>
                    <div>Maslak, İstanbul • info@teknopolis.com</div>
                    <div>© 2025 Teknopolis. Tüm hakları saklıdır.</div>
                </div>
                <div class="soc">
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                    <a href="#">LinkedIn</a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        function toggleMenu() {
            const d = document.getElementById('drawer');
            d.classList.toggle('on');
            document.body.style.overflow = d.classList.contains('on') ? 'hidden' : 'auto';
        }
    </script>

</body>
</html>
