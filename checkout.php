<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme - TEKNOPOLIS</title>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font:16px/1.5 system-ui,sans-serif;color:#0f172a;background:#f8fafc}
        a{color:inherit;text-decoration:none}
        img{max-width:100%;display:block}
        input, select, textarea{font:inherit}

        :root{
            --blue:#2563eb;
            --dark:#0f172a;
            --gray:#64748b;
            --border:#e2e8f0;
            --red:#ef4444;
            --green:#10b981;
            --w:min(94vw,1200px)
        }

        .hd{position:sticky;top:0;height:60px;background:rgba(255,255,255,.98);border-bottom:1px solid var(--border);z-index:100;display:flex;align-items:center}
        .hd-in{width:var(--w);margin:0 auto;display:flex;justify-content:space-between;font-weight:700}
        .lg{font:800 1.3rem/1 system-ui;letter-spacing:-.5px}
        .lg span{color:var(--blue)}

        .main{width:var(--w);margin:15px auto 4rem}
        .bc{font:.8rem/1 system-ui;color:var(--gray);margin-bottom:15px}
        .bc span{color:var(--dark);font-weight:600}

        .page-title{font:800 1.8rem/1.32 system-ui;margin-bottom:20px;letter-spacing:-.5px}

        .digital-info{background:linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);border:1px solid #0ea5e9;border-radius:8px;padding:15px;margin-bottom:20px;font:.9rem/1.4 system-ui;color:#0369a1}
        .digital-info strong{color:#0c4a6e}

        .checkout-container{display:flex;gap:30px}
        .checkout-left{flex:2}
        .checkout-right{flex:1}

        .section{background:#fff;border:1px solid var(--border);border-radius:8px;padding:20px;margin-bottom:20px}
        .section-title{font:700 1.2rem/1.3 system-ui;margin-bottom:15px;color:var(--dark);display:flex;align-items:center;gap:8px}
        .section-number{background:var(--blue);color:#fff;font:.8rem/1 system-ui;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center}

        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px}
        .form-grid.single{grid-template-columns:1fr}
        .form-group{display:flex;flex-direction:column;gap:5px}
        .form-group.full{grid-column:1/-1}
        .form-label{font:600 .9rem/1 system-ui;color:var(--dark)}
        .form-input{padding:12px;border:1px solid var(--border);border-radius:6px;font:.9rem/1 system-ui}
        .form-input:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px rgba(37,99,235,.1)}
        .form-select{padding:12px;border:1px solid var(--border);border-radius:6px;font:.9rem/1 system-ui;background:#fff}

        .guest-option{background:#f8fafc;border:1px solid var(--border);border-radius:8px;padding:15px;margin-bottom:15px}
        .guest-toggle{display:flex;align-items:center;gap:10px;margin-bottom:10px}
        .guest-info{font:.85rem/1.3 system-ui;color:var(--gray)}

        .checkbox-group{display:flex;align-items:flex-start;gap:10px;margin:15px 0}
        .checkbox{width:18px;height:18px;margin-top:2px}
        .checkbox-label{font:.9rem/1.4 system-ui;color:var(--gray)}
        .checkbox-label a{color:var(--blue);text-decoration:underline}

        .payment-methods{display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px}
        .payment-method{border:2px solid var(--border);border-radius:8px;padding:20px;text-align:center;cursor:pointer;background:#fff}
        .payment-method.active{border-color:var(--blue);background:#f0f7ff}
        .payment-icon{font-size:2rem;margin-bottom:8px}
        .payment-name{font:.95rem/1 system-ui;font-weight:600}
        .payment-desc{font:.8rem/1.2 system-ui;color:var(--gray);margin-top:4px}

        .card-form{display:none;margin-top:15px}
        .card-form.active{display:block}
        .card-row{display:flex;gap:10px}
        .card-row .form-group{flex:1}

        .order-summary{background:#fff;border:1px solid var(--border);border-radius:8px;padding:20px;position:sticky;top:80px}
        .summary-title{font:700 1.2rem/1.3 system-ui;margin-bottom:15px;color:var(--dark)}
        .summary-item{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border)}
        .item-info{display:flex;align-items:center;gap:10px}
        .item-img{width:50px;height:28px;border-radius:4px;object-fit:cover;border:1px solid var(--border)}
        .item-details{font:.85rem/1.2 system-ui}
        .item-name{font-weight:600;color:var(--dark)}
        .item-qty{color:var(--gray)}
        .item-price{font:600 .9rem/1 system-ui;color:var(--dark)}

        .summary-totals{margin-top:15px}
        .summary-row{display:flex;justify-content:space-between;margin-bottom:8px;font:.9rem/1 system-ui}
        .summary-row.total{border-top:1px solid var(--border);padding-top:10px;margin-top:15px;font:700 1.1rem/1 system-ui;color:var(--dark)}

        .submit-btn{width:100%;background:var(--green);color:#fff;border:0;padding:15px;font:700 1rem/1 system-ui;border-radius:8px;cursor:pointer;margin-top:15px}
        .submit-btn:hover{background:#059669}
        .submit-btn:disabled{background:var(--gray);cursor:not-allowed}

        .security-info{background:#f0f7ff;border:1px solid #bfdbfe;border-radius:6px;padding:12px;margin-top:15px;font:.85rem/1.3 system-ui;color:#1e40af}

        .delivery-info{background:#f0fdf4;border:1px solid #16a34a;border-radius:6px;padding:12px;margin-top:15px;font:.85rem/1.3 system-ui;color:#15803d}

        .auto-account{background:#fef3c7;border:1px solid #f59e0b;border-radius:6px;padding:12px;margin-top:10px;font:.85rem/1.3 system-ui;color:#92400e}

        @media(max-width:900px){
            .checkout-container{flex-direction:column;gap:15px}
            .form-grid{grid-template-columns:1fr;gap:10px}
            .payment-methods{grid-template-columns:1fr}
            .card-row{flex-direction:column;gap:10px}
        }
    </style>
</head>
<body>

    <header class="hd">
        <div class="hd-in">
            <div class="lg">TEKNO<span>POLIS</span></div>
            <div>DİJİTAL ÜRÜN SATIŞI</div>
        </div>
    </header>

    <div class="main">

        <nav class="bc">
            <a href="#">Anasayfa</a> / <a href="#">Sepet</a> / <span>Ödeme</span>
        </nav>

        <h1 class="page-title">Ödeme</h1>

        <div class="checkout-container">
            <div class="checkout-left">

                <!-- Misafir Alışveriş Seçeneği -->
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">1</span>
                        Alışveriş Türü
                    </h2>

                    <div class="guest-option">
                        <div class="guest-toggle">
                            <input type="checkbox" id="guest-checkout" class="checkbox">
                            <label for="guest-checkout" class="checkbox-label">
                                <strong>Misafir olarak alışveriş yap</strong>
                            </label>
                        </div>
                        <div class="guest-info">
                            Misafir alışverişte hesap açmadan ödeme yapabilirsiniz.
                            Ürünler e-posta adresinize gönderilir ve gelecekte erişim için otomatik hesap oluşturulur.
                        </div>
                    </div>

                    <div class="auto-account">
                        <strong>🔐 Otomatik Hesap Oluşturma:</strong>
                        Ödeme sonrasında size otomatik olarak hesap açılacak ve giriş bilgileriniz e-posta ile gönderilecektir.
                        Böylece gelecekte satın aldığınız ürünlere kolayca erişebilirsiniz.
                    </div>
                </div>

                <!-- İletişim Bilgileri -->
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">2</span>
                        İletişim Bilgileri
                    </h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Ad</label>
                            <input type="text" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Soyad</label>
                            <input type="text" class="form-input" required>
                        </div>
                        <div class="form-group full">
                            <label class="form-label">E-posta Adresi *</label>
                            <input type="email" class="form-input" required>
                            <small style="color:var(--gray);font-size:.8rem">Ürünler bu e-posta adresine teslim edilecektir</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Telefon *</label>
                            <input type="tel" class="form-input" required>
                            <small style="color:var(--gray);font-size:.8rem">Satın alımınızla ilgili size ulaşmamız gerekiyor</small>
                        </div>
                    </div>
                </div>

                <!-- Ödeme Yöntemi -->
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">3</span>
                        Ödeme Yöntemi
                    </h2>

                    <div class="payment-methods">
                        <div class="payment-method active" data-method="card">
                            <div class="payment-icon">💳</div>
                            <div class="payment-name">Kredi/Banka Kartı</div>
                            <div class="payment-desc">Anında ödeme ve teslimat</div>
                        </div>
                        <div class="payment-method" data-method="bank">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-name">Havale/EFT</div>
                            <div class="payment-desc">1-2 iş günü içinde teslimat</div>
                        </div>
                    </div>

                    <!-- Kredi Kartı Formu -->
                    <div class="card-form active" id="card-form">
                        <div class="form-grid">
                            <div class="form-group full">
                                <label class="form-label">Kart Üzerindeki İsim</label>
                                <input type="text" class="form-input" placeholder="JOHN DOE" required>
                            </div>
                            <div class="form-group full">
                                <label class="form-label">Kart Numarası</label>
                                <input type="text" class="form-input" placeholder="1234 5678 9012 3456" maxlength="19" required>
                            </div>
                            <div class="card-row">
                                <div class="form-group">
                                    <label class="form-label">Son Kullanma Tarihi</label>
                                    <input type="text" class="form-input" placeholder="MM/YY" maxlength="5" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-input" placeholder="123" maxlength="4" required>
                                </div>
                            </div>
                        </div>

                        <div class="security-info">
                            <strong>🔒 Güvenlik:</strong> Ödeme bilgileriniz 256-bit SSL şifrelemesi ile korunmaktadır.
                            Kart bilgileriniz hiçbir zaman sunucularımızda saklanmaz.
                        </div>
                    </div>

                    <!-- Havale/EFT Bilgisi -->
                    <div class="card-form" id="bank-form">
                        <div class="security-info">
                            <div class="security-icon">🏦</div>
                            <strong>Havale/EFT Bilgileri:</strong><br>
                            Banka: Türkiye İş Bankası<br>
                            Hesap Sahibi: TEKNOPOLIS BİLİŞİM LTD. ŞTİ.<br>
                            IBAN: TR12 0006 4000 0011 2345 6789 01<br><br>
                            <strong>Önemli:</strong> Havale açıklama kısmına e-posta adresinizi yazınız.
                            Ödeme onaylandıktan sonra ürünler 1-2 iş günü içinde e-postanıza gönderilecektir.
                        </div>
                    </div>
                </div>

                <!-- Şartlar ve Koşullar -->
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-number">4</span>
                        Onaylar ve Sözleşmeler
                    </h2>

                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" class="checkbox" required>
                        <label for="terms" class="checkbox-label">
                            <a href="#" target="_blank">Dijital Ürün Satış Sözleşmesi</a>'ni ve
                            <a href="#" target="_blank">Mesafeli Satış Sözleşmesi</a>'ni okudum, onaylıyorum.
                        </label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="privacy" class="checkbox" required>
                        <label for="privacy" class="checkbox-label">
                            <a href="#" target="_blank">Kişisel Verilerin Korunması</a> ve
                            <a href="#" target="_blank">Gizlilik Politikası</a>'nı okudum, onaylıyorum.
                        </label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="digital-goods" class="checkbox" required>
                        <label for="digital-goods" class="checkbox-label">
                            Dijital ürünler için <strong>cayma hakkı</strong> bulunmadığını kabul ediyorum.
                        </label>
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="newsletter" class="checkbox">
                        <label for="newsletter" class="checkbox-label">
                            Kampanya ve duyurulardan e-posta ile haberdar olmak istiyorum. (İsteğe bağlı)
                        </label>
                    </div>
                </div>

            </div>

            <div class="checkout-right">
                <div class="order-summary">
                    <h2 class="summary-title">Sipariş Özeti</h2>

                    <div class="summary-item">
                        <div class="item-info">
                            <img src="https://placehold.co/100x56/007bff/ffffff?text=WP" alt="WordPress Plugin" class="item-img">
                            <div class="item-details">
                                <div class="item-name">Premium WP Plugin</div>
                                <div class="item-qty">Adet: 1</div>
                            </div>
                        </div>
                        <div class="item-price">299 TL</div>
                    </div>

                    <div class="summary-item">
                        <div class="item-info">
                            <img src="https://placehold.co/100x56/28a745/ffffff?text=JS" alt="JavaScript Course" class="item-img">
                            <div class="item-details">
                                <div class="item-name">JavaScript Masterclass</div>
                                <div class="item-qty">Adet: 1</div>
                            </div>
                        </div>
                        <div class="item-price">199 TL</div>
                    </div>

                    <div class="summary-item">
                        <div class="item-info">
                            <img src="https://placehold.co/100x56/6c757d/ffffff?text=PDF" alt="E-book" class="item-img">
                            <div class="item-details">
                                <div class="item-name">Web Design E-book</div>
                                <div class="item-qty">Adet: 2</div>
                            </div>
                        </div>
                        <div class="item-price">98 TL</div>
                    </div>

                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Ara Toplam</span>
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
                    </div>

                    <button type="submit" class="submit-btn" id="complete-order" disabled>
                        Ödemeni Tamamla
                    </button>

                    <div class="auto-account" style="margin-top:15px;font-size:.8rem">
                        <strong>Ödeme sonrası:</strong><br>
                        • Ürünler e-postanıza gönderilir<br>
                        • Otomatik hesap açılır<br>
                        • Profil sayfasına yönlendirilirsiniz
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', () => {
                // Remove active class from all methods
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
                document.querySelectorAll('.card-form').forEach(f => f.classList.remove('active'));

                // Add active class to clicked method
                method.classList.add('active');
                const methodType = method.getAttribute('data-method');
                const form = document.getElementById(`${methodType}-form`);
                if (form) form.classList.add('active');
            });
        });

        // Form validation
        const requiredCheckboxes = document.querySelectorAll('input[type="checkbox"][required]');
        const submitBtn = document.getElementById('complete-order');

        function validateForm() {
            const allChecked = Array.from(requiredCheckboxes).every(cb => cb.checked);
            submitBtn.disabled = !allChecked;
        }

        requiredCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', validateForm);
        });

        // Card number formatting
        const cardInput = document.querySelector('input[placeholder="1234 5678 9012 3456"]');
        if (cardInput) {
            cardInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\s/g, '');
                value = value.replace(/(.{4})/g, '$1 ');
                e.target.value = value.trim();
            });
        }

        // Expiry date formatting
        const expiryInput = document.querySelector('input[placeholder="MM/YY"]');
        if (expiryInput) {
            expiryInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                e.target.value = value;
            });
        }

        // Submit form
        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!submitBtn.disabled) {
                alert('Ödemeniz işleniyor...\n\nÖdeme sonrası:\n• Ürünler e-postanıza gönderilecek\n• Otomatik hesabınız açılacak\n• Profil sayfasına yönlendirileceksiniz');
            }
        });

        // Guest checkout toggle
        const guestCheckbox = document.getElementById('guest-checkout');
        guestCheckbox.addEventListener('change', (e) => {
            if (e.target.checked) {
                console.log('Misafir alışverişi seçildi');
            } else {
                console.log('Hesaplı alışverişi seçildi');
            }
        });
    </script>

</body>
</html>
