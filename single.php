<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimal & Hızlı Blog</title>
    <style>
        /* RESET & BASE */
        *{box-sizing:border-box;margin:0;padding:0}
        body{font:16px/1.5 system-ui,sans-serif;background:#f8fafc;color:#0f172a}
        a{color:inherit;text-decoration:none}
        ul{list-style:none}
        button{font:inherit;border:0;background:0;cursor:pointer}

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

        /* CONTENT */
        .cnt{width:90%;max-width:42rem;margin:1.5rem auto 4rem}
        h1{font:2rem/1.2 system-ui;margin:0 0 1rem;letter-spacing:-1px;color:#111}
        p{font:1.1rem/1.6 system-ui;color:#334155;margin-bottom:1.2rem}

        /* RELATED */
        .rel{margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid #e2e8f0}
        .rel-t{font:700 1.2rem/1 system-ui;margin-bottom:1.5rem;display:flex;align-items:center;gap:8px}
        .grd{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem}
        .crd{display:flex;flex-direction:column}
        .crd img{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:8px;background:#e2e8f0;margin-bottom:.75rem}
        .crd:hover img{opacity:.9}
        .crd-t{font:600 1rem/1.4 system-ui;color:var(--dark)}
        .crd-m{font:.8rem/1 system-ui;color:var(--gray);margin-top:5px}

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
            .ft-grd{grid-template-columns:1fr 1fr}
        }
        @media(max-width:600px){
            .grd{grid-template-columns:1fr}
            .cnt{margin-top:1rem;width:92%}
            .ft-grd{grid-template-columns:1fr}
            .ft-bot{text-align:center}
            .soc a{margin:0 10px}
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

    <main class="cnt">
        <article>
            <h1>%70 Daha Az CSS Kodu ile Aynı Görünüm</h1>

            <p>Orijinal kodda 300+ satır CSS vardı. Şimdi sadece 120 satır ile aynı işlevselliği sağlıyoruz. Kısa sınıf isimleri (.tb, .hd, .nv), tek satır tanımlar ve tarayıcı varsayılanlarının maksimum kullanımı.</p>

            <p>Font shorthand: "font:600 .9rem/1 system-ui" yerine ayrı ayrı font-weight, font-size, line-height yazmak. Gereksiz transition animasyonları çıkarıldı.</p>

            <p>CSS custom properties tek yerde tanımlandı, her yerde --blue, --dark gibi kısa isimlerle kullanıldı. Grid, flexbox ve modern CSS özellikleri doğru şekilde kullanıldı.</p>
        </article>

        <section class="rel">
            <h4 class="rel-t">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"></path></svg>
                İlginizi Çekebilir
            </h4>

            <div class="grd">
                <a href="#" class="crd">
                    <img src="https://placehold.co/600x338/2563eb/FFF?text=Optimize" alt="CSS Optimizasyon Teknikleri">
                    <div class="crd-t">CSS Optimizasyon Teknikleri</div>
                    <div class="crd-m">3 dk okuma</div>
                </a>

                <a href="#" class="crd">
                    <img src="https://placehold.co/600x338/1e40af/FFF?text=Hız" alt="Web Sitesi Hız Optimizasyonu">
                    <div class="crd-t">Web Sitesi Hız Optimizasyonu</div>
                    <div class="crd-m">5 dk okuma</div>
                </a>

                <a href="#" class="crd">
                    <img src="https://placehold.co/600x338/0f172a/FFF?text=Modern" alt="Modern CSS Özellikleri">
                    <div class="crd-t">Modern CSS Özellikleri</div>
                    <div class="crd-m">4 dk okuma</div>
                </a>

                <a href="#" class="crd">
                    <img src="https://placehold.co/600x338/475569/FFF?text=Minimal" alt="Minimal Tasarım İlkeleri">
                    <div class="crd-t">Minimal Tasarım İlkeleri</div>
                    <div class="crd-m">6 dk okuma</div>
                </a>
            </div>
        </section>
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
