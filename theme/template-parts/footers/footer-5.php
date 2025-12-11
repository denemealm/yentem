<?php
/**
 * Footer Style 5: Dark - Modern gradient style
 */
$copyright = get_theme_mod('dtb_footer_copyright', '© 2025 ' . get_bloginfo('name') . '. Tüm hakları saklıdır.');
?>
<footer class="footer footer-dark">
    <div class="footer-wave">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
            <path fill="currentColor" d="M0,0 C480,100 960,100 1440,0 L1440,100 L0,100 Z"></path>
        </svg>
    </div>

    <div class="footer-main">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="footer-logo"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                    <p class="footer-desc"><?php bloginfo('description'); ?></p>

                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>İstanbul, Türkiye</span>
                        </div>
                        <div class="contact-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            <span>info@example.com</span>
                        </div>
                    </div>
                </div>

                <div class="footer-links-group">
                    <h4>Keşfet</h4>
                    <ul>
                        <li><a href="#">Ana Sayfa</a></li>
                        <li><a href="#">Hakkımızda</a></li>
                        <li><a href="#">Kategoriler</a></li>
                        <li><a href="#">Son Yazılar</a></li>
                    </ul>
                </div>

                <div class="footer-links-group">
                    <h4>Destek</h4>
                    <ul>
                        <li><a href="#">SSS</a></li>
                        <li><a href="#">İletişim</a></li>
                        <li><a href="#">Reklam</a></li>
                        <li><a href="#">Kariyer</a></li>
                    </ul>
                </div>

                <div class="footer-social-section">
                    <h4>Bizi Takip Edin</h4>
                    <div class="social-grid">
                        <a href="#" class="social-card">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            <span>Twitter</span>
                        </a>
                        <a href="#" class="social-card">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="social-card">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                            <span>YouTube</span>
                        </a>
                        <a href="#" class="social-card">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                            <span>LinkedIn</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="bottom-inner">
                <p><?php echo esc_html($copyright); ?></p>
                <div class="footer-legal">
                    <a href="#">Gizlilik</a>
                    <a href="#">Şartlar</a>
                    <a href="#">KVKK</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.footer-dark {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    margin-top: 4rem;
    position: relative;
    color: #94a3b8;
}
.footer-dark .footer-wave {
    position: absolute;
    top: -50px;
    left: 0;
    width: 100%;
    color: #0f172a;
}
.footer-dark .footer-wave svg {
    width: 100%;
    height: 50px;
}
.footer-dark .footer-main {
    padding: 4rem 0;
}
.footer-dark .footer-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
    gap: 40px;
}
.footer-dark .footer-logo {
    font: 800 1.5rem/1 system-ui;
    color: #fff;
    display: block;
    margin-bottom: 1rem;
}
.footer-dark .footer-desc {
    font-size: .9rem;
    line-height: 1.7;
    margin-bottom: 1.5rem;
}
.footer-dark .contact-info {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.footer-dark .contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: .9rem;
}
.footer-dark .footer-links-group h4,
.footer-dark .footer-social-section h4 {
    color: #fff;
    font: 700 .9rem/1 system-ui;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 1.2rem;
}
.footer-dark .footer-links-group ul li {
    padding: 8px 0;
}
.footer-dark .footer-links-group ul li a {
    font-size: .9rem;
    transition: .2s;
}
.footer-dark .footer-links-group ul li a:hover {
    color: #fff;
    padding-left: 5px;
}
.footer-dark .social-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}
.footer-dark .social-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 15px;
    background: rgba(255,255,255,.05);
    border-radius: 10px;
    font-size: .85rem;
    transition: .2s;
}
.footer-dark .social-card:hover {
    background: var(--primary);
    color: #fff;
    transform: translateY(-2px);
}
.footer-dark .footer-bottom {
    border-top: 1px solid rgba(255,255,255,.1);
    padding: 1.5rem 0;
}
.footer-dark .bottom-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: .85rem;
}
.footer-dark .footer-legal {
    display: flex;
    gap: 20px;
}
.footer-dark .footer-legal a {
    transition: .2s;
}
.footer-dark .footer-legal a:hover {
    color: #fff;
}
@media(max-width:900px) {
    .footer-dark .footer-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media(max-width:600px) {
    .footer-dark .footer-grid {
        grid-template-columns: 1fr;
    }
    .footer-dark .bottom-inner {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>
