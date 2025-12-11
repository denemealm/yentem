<?php
/**
 * Footer Style 4: Centered - Logo focus
 */
$copyright = get_theme_mod('dtb_footer_copyright', '© 2025 ' . get_bloginfo('name') . '. Tüm hakları saklıdır.');
?>
<footer class="footer footer-centered">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="footer-logo"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
                <p class="footer-tagline"><?php bloginfo('description'); ?></p>
            </div>

            <nav class="footer-nav">
                <a href="#">Ana Sayfa</a>
                <a href="#">Hakkımızda</a>
                <a href="#">Kategoriler</a>
                <a href="#">Blog</a>
                <a href="#">İletişim</a>
            </nav>

            <div class="footer-social">
                <a href="#" aria-label="Twitter">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                </a>
                <a href="#" aria-label="Facebook">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" aria-label="YouTube">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>

            <div class="footer-legal">
                <a href="#">Gizlilik Politikası</a>
                <span>•</span>
                <a href="#">Kullanım Şartları</a>
                <span>•</span>
                <a href="#">KVKK</a>
            </div>

            <p class="footer-copyright"><?php echo esc_html($copyright); ?></p>
        </div>
    </div>
</footer>

<style>
.footer-centered {
    background: linear-gradient(180deg, #f8fafc 0%, #fff 100%);
    border-top: 1px solid #e2e8f0;
    margin-top: 4rem;
    padding: 4rem 0 2rem;
}
.footer-centered .footer-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}
.footer-centered .footer-brand {
    margin-bottom: 2rem;
}
.footer-centered .footer-logo {
    font: 800 2rem/1 system-ui;
    color: var(--dark);
    display: block;
    margin-bottom: .75rem;
}
.footer-centered .footer-tagline {
    color: var(--gray);
    font-size: .95rem;
}
.footer-centered .footer-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    margin-bottom: 2rem;
}
.footer-centered .footer-nav a {
    font: 500 .9rem/1 system-ui;
    color: var(--dark);
    transition: .2s;
}
.footer-centered .footer-nav a:hover {
    color: var(--primary);
}
.footer-centered .footer-social {
    display: flex;
    gap: 15px;
    margin-bottom: 2rem;
}
.footer-centered .footer-social a {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 50%;
    color: var(--gray);
    transition: .2s;
}
.footer-centered .footer-social a:hover {
    background: var(--primary);
    border-color: var(--primary);
    color: #fff;
    transform: translateY(-3px);
}
.footer-centered .footer-legal {
    display: flex;
    gap: 15px;
    margin-bottom: 1.5rem;
    font-size: .85rem;
    color: var(--gray);
}
.footer-centered .footer-legal a {
    color: var(--gray);
    transition: .2s;
}
.footer-centered .footer-legal a:hover {
    color: var(--primary);
}
.footer-centered .footer-copyright {
    font-size: .8rem;
    color: #94a3b8;
}
@media(max-width:600px) {
    .footer-centered .footer-nav {
        gap: 15px;
    }
}
</style>
