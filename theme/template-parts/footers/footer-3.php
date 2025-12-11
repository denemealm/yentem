<?php
/**
 * Footer Style 3: Minimal - Single line
 */
$copyright = get_theme_mod('dtb_footer_copyright', '© 2025 ' . get_bloginfo('name') . '. Tüm hakları saklıdır.');
?>
<footer class="footer footer-minimal">
    <div class="container">
        <div class="footer-inner">
            <div class="footer-left">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="footer-logo"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </div>

            <nav class="footer-nav">
                <a href="#">Hakkımızda</a>
                <a href="#">Blog</a>
                <a href="#">İletişim</a>
                <a href="#">Gizlilik</a>
            </nav>

            <div class="footer-right">
                <div class="footer-social">
                    <a href="#" aria-label="Twitter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/></svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-copyright">
            <p><?php echo esc_html($copyright); ?></p>
        </div>
    </div>
</footer>

<style>
.footer-minimal {
    background: #fff;
    border-top: 1px solid #e2e8f0;
    margin-top: 4rem;
    padding: 2rem 0;
}
.footer-minimal .footer-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f1f5f9;
}
.footer-minimal .footer-logo {
    font: 700 1.2rem/1 system-ui;
    color: var(--dark);
}
.footer-minimal .footer-nav {
    display: flex;
    gap: 30px;
}
.footer-minimal .footer-nav a {
    font: 500 .85rem/1 system-ui;
    color: var(--gray);
    transition: .2s;
}
.footer-minimal .footer-nav a:hover {
    color: var(--primary);
}
.footer-minimal .footer-social {
    display: flex;
    gap: 12px;
}
.footer-minimal .footer-social a {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
    border-radius: 50%;
    color: var(--gray);
    transition: .2s;
}
.footer-minimal .footer-social a:hover {
    background: var(--primary);
    color: #fff;
}
.footer-minimal .footer-copyright {
    padding-top: 1.5rem;
    text-align: center;
    font-size: .8rem;
    color: var(--gray);
}
@media(max-width:768px) {
    .footer-minimal .footer-inner {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    .footer-minimal .footer-nav {
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }
}
</style>
