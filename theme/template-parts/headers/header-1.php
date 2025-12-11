<?php
/**
 * Header Style 1: Classic - Logo left, menu right
 */
?>
<header class="header header-classic">
    <div class="container">
        <div class="header-inner">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>

            <nav class="nav-primary">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'menu',
                    'fallback_cb' => 'dtb_fallback_menu',
                ));
                ?>
            </nav>

            <button class="mobile-toggle" onclick="dtbToggleMenu()">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>
</header>

<style>
.header-classic {
    position: sticky;
    top: 0;
    height: 70px;
    background: rgba(255,255,255,.98);
    backdrop-filter: blur(8px);
    border-bottom: 1px solid #e2e8f0;
    z-index: 100;
}
.header-classic .header-inner {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.header-classic .logo-text {
    font: 800 1.4rem/1 system-ui;
    letter-spacing: -0.5px;
}
.header-classic .menu {
    display: flex;
    gap: 5px;
    align-items: center;
}
.header-classic .menu li a {
    padding: 8px 14px;
    font: 600 .9rem/1 system-ui;
    border-radius: 6px;
    transition: .2s;
}
.header-classic .menu li a:hover {
    background: #eff6ff;
    color: var(--primary);
}
.header-classic .mobile-toggle {
    display: none;
}
@media(max-width:900px) {
    .header-classic .nav-primary { display: none; }
    .header-classic .mobile-toggle { display: block; }
}
</style>
