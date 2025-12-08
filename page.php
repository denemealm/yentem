<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gizlilik Politikası - TEKNOPOLIS</title>
    <style>
        /* --- GENEL AYARLAR (Mevcut CSS'in) --- */
        :root {
            --primary: #2563eb;
            --text-main: #0f172a;
            --text-light: #64748b;
            --max-w: 1200px;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, -apple-system, sans-serif; color: var(--text-main); line-height: 1.6; background: #f8fafc; }
        a { text-decoration: none; color: inherit; }

        /* HEADER & FOOTER (Standart) */
        .site-header { position: sticky; top: 0; height: 65px; background: rgba(255,255,255,0.95); border-bottom: 1px solid #e2e8f0; display:flex; align-items:center; justify-content: center;}
        .header-inner { width: 94%; max-width: var(--max-w); display: flex; justify-content: space-between; font-weight:bold;}
        .site-footer { background: #0f172a; color: #94a3b8; margin-top: 5rem; padding: 3rem 0; text-align: center;}


        /* --- LEGAL SAYFA ÖZEL TASARIMI --- */

        /* 1. DIŞ KAPLAYICI (1200px) */
        /* Bu, header ile aynı hizada durmasını sağlar ama içini doldurmayız */
        .legal-wrapper {
            width: 94%;
            max-width: var(--max-w);
            margin: 3rem auto 5rem auto;
        }

        /* 2. İÇ KAPLAYICI (800px - OKUMA ALANI) */
        /* Metni merkeze toplar ve okunabilir kılar */
        .legal-content {
            max-width: 800px;
            margin: 0 auto; /* Ortala */
            background: #ffffff;
            padding: 3rem; /* İç boşluk ferah olsun */
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        /* 3. BAŞLIK ALANI */
        .legal-header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .legal-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-main);
            margin: 0 0 10px 0;
            letter-spacing: -1px;
        }

        .last-updated {
            font-size: 0.9rem;
            color: var(--text-light);
            background: #f1f5f9;
            padding: 5px 12px;
            border-radius: 50px;
            display: inline-block;
        }

        /* 4. METİN STİLLERİ (Tipografi) */
        .legal-text h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: var(--text-main);
        }

        .legal-text h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .legal-text p {
            margin-bottom: 1.5rem;
            color: #334155; /* Biraz daha yumuşak siyah */
            font-size: 1.05rem; /* Rahat okuma boyutu */
        }

        .legal-text ul {
            margin-bottom: 1.5rem;
            padding-left: 20px;
            list-style-type: disc;
            color: #334155;
        }

        .legal-text li {
            margin-bottom: 8px;
        }

        /* Vurgulu Alanlar (Örn: İletişim) */
        .highlight-box {
            background: #eff6ff;
            border-left: 4px solid var(--primary);
            padding: 20px;
            margin: 2rem 0;
            border-radius: 0 8px 8px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .legal-content {
                padding: 1.5rem; /* Mobilde iç boşluğu azalt */
            }
            .legal-title { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="header-inner">
            <div>TEKNO<span style="color:#2563eb">POLIS</span></div>
            <div>MENU</div>
        </div>
    </header>

    <main class="legal-wrapper">

        <article class="legal-content">

            <div class="legal-header">
                <h1 class="legal-title">Gizlilik Politikası</h1>
                <span class="last-updated">Son Güncelleme: 08 Aralık 2025</span>
            </div>

            <div class="legal-text">
                <p>
                    Teknopolis ("Şirket") olarak, ziyaretçilerimizin gizliliğine saygı duyuyor ve verilerinizin güvenliğini önemsiyoruz. Bu Gizlilik Politikası, web sitemizi kullandığınızda verilerinizin nasıl toplandığını, kullanıldığını ve korunduğunu açıklar.
                </p>

                <h2>1. Toplanan Veriler</h2>
                <p>Hizmetlerimizi kullandığınızda aşağıdaki bilgileri toplayabiliriz:</p>
                <ul>
                    <li><strong>Kimlik Bilgileri:</strong> Ad, soyad (sadece kayıt olursanız).</li>
                    <li><strong>İletişim Bilgileri:</strong> E-posta adresi, telefon numarası.</li>
                    <li><strong>Teknik Veriler:</strong> IP adresi, tarayıcı türü, cihaz bilgisi.</li>
                </ul>

                <h2>2. Çerezlerin Kullanımı (Cookies)</h2>
                <p>
                    Kullanıcı deneyimini geliştirmek için çerezler kullanıyoruz. Çerezler, tarayıcınız tarafından cihazınızda saklanan küçük metin dosyalarıdır.
                </p>
                <h3>Zorunlu Çerezler</h3>
                <p>Sitenin çalışması için teknik olarak gereklidir.</p>
                <h3>Analiz Çerezleri</h3>
                <p>Ziyaretçi trafiğini analiz etmek için Google Analytics kullanıyoruz.</p>

                <h2>3. Veri Güvenliği</h2>
                <p>
                    Verileriniz, yetkisiz erişime karşı korunmak amacıyla SSL (Secure Socket Layer) teknolojisi ile şifrelenerek aktarılmaktadır. Sunucularımızda güncel güvenlik duvarları kullanılmaktadır.
                </p>

                <div class="highlight-box">
                    <strong>İletişim:</strong> Bu politika hakkında sorularınız varsa veya KVKK kapsamındaki haklarınızı kullanmak istiyorsanız, bize <a href="mailto:hukuk@teknopolis.com" style="color:#2563eb; font-weight:bold;">hukuk@teknopolis.com</a> adresinden ulaşabilirsiniz.
                </div>

                <h2>4. Değişiklikler</h2>
                <p>
                    Bu politika zaman zaman güncellenebilir. Değişiklikler bu sayfada yayınlandığı tarihte yürürlüğe girer.
                </p>
            </div>

        </article>

    </main>

    <footer class="site-footer">
        © 2025 Teknopolis Legal
    </footer>

</body>
</html>
