<?php
/**
 * Footer Style 2: 3 Columns - Compact with newsletter
 */
$copyright = get_theme_mod('dtb_footer_copyright', '© 2025 ' . get_bloginfo('name') . '. Tüm hakları saklıdır.');
?>
<footer class="footer footer-compact">
    <div class="container">
        <div class="footer-content">
            <div class="footer-main">
                <div class="footer-brand">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <span class="footer-logo"><?php bloginfo('name'); ?></span>
                    <?php endif; ?>
                </div>

                <nav class="footer-nav">
                    <a href="#">Ana Sayfa</a>
                    <a href="#">Hakkımızda</a>
                    <a href="#">Blog</a>
                    <a href="#">İletişim</a>
                    <a href="#">Gizlilik</a>
                </nav>
            </div>

            <div class="footer-newsletter">
                <h4>Bültenimize Katılın</h4>
                <p>En son haberler ve güncellemeler için abone olun.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="E-posta adresiniz">
                    <button type="submit">Abone Ol</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            <p><?php echo esc_html($copyright); ?></p>
            <div class="footer-social">
                <a href="#" aria-label="Twitter">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<style>
.footer-compact {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    margin-top: 4rem;
}
.footer-compact .footer-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    padding: 3rem 0;
    align-items: center;
}
.footer-compact .footer-logo {
    font: 800 1.4rem/1 system-ui;
    color: var(--dark);
    display: block;
    margin-bottom: 1.5rem;
}
.footer-compact .footer-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.footer-compact .footer-nav a {
    font: 500 .9rem/1 system-ui;
    color: var(--gray);
    transition: .2s;
}
.footer-compact .footer-nav a:hover {
    color: var(--primary);
}
.footer-compact .footer-newsletter h4 {
    font: 700 1.1rem/1 system-ui;
    margin-bottom: .5rem;
}
.footer-compact .footer-newsletter p {
    font-size: .9rem;
    color: var(--gray);
    margin-bottom: 1rem;
}
.footer-compact .newsletter-form {
    display: flex;
    gap: 10px;
}
.footer-compact .newsletter-form input {
    flex: 1;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: .9rem;
}
.footer-compact .newsletter-form input:focus {
    outline: none;
    border-color: var(--primary);
}
.footer-compact .newsletter-form button {
    background: var(--primary);
    color: #fff;
    padding: 12px 24px;
    border-radius: 8px;
    font: 600 .9rem/1 system-ui;
    transition: .2s;
}
.footer-compact .newsletter-form button:hover {
    background: #1e40af;
}
.footer-compact .footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 0;
    border-top: 1px solid #e2e8f0;
    font-size: .85rem;
    color: var(--gray);
}
.footer-compact .footer-social {
    display: flex;
    gap: 15px;
}
.footer-compact .footer-social a {
    color: var(--gray);
    transition: .2s;
}
.footer-compact .footer-social a:hover {
    color: var(--primary);
}
@media(max-width:768px) {
    .footer-compact .footer-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    .footer-compact .footer-bottom {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>
