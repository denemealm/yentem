<?php
/**
 * Header Style 4: Topbar - With social icons and secondary info
 */
?>
<div class="topbar">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-left">
                <span class="topbar-date"><?php echo date_i18n('d F Y'); ?></span>
                <a href="#">Hakkımızda</a>
                <a href="#">Reklam</a>
                <a href="#">İletişim</a>
            </div>
            <div class="topbar-right">
                <a href="#" class="social-icon" aria-label="Twitter">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" class="social-icon" aria-label="Instagram">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.069-4.85.069-3.204 0-3.584-.012-4.849-.069-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="social-icon" aria-label="YouTube">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

<header class="header header-topbar">
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

            <div class="header-search">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" name="s" placeholder="Ara...">
                    <button type="submit">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                    </button>
                </form>
            </div>

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
.topbar {
    height: 38px;
    background: var(--dark);
    font-size: 12px;
    color: #94a3b8;
}
.topbar-inner {
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.topbar-left {
    display: flex;
    gap: 20px;
    align-items: center;
}
.topbar-date {
    padding-right: 20px;
    border-right: 1px solid #334155;
}
.topbar-left a:hover {
    color: #fff;
}
.topbar-right {
    display: flex;
    gap: 12px;
}
.social-icon {
    color: #94a3b8;
    transition: .2s;
}
.social-icon:hover {
    color: var(--primary);
}

.header-topbar {
    position: sticky;
    top: 0;
    height: 65px;
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
    z-index: 100;
}
.header-topbar .header-inner {
    height: 100%;
    display: flex;
    align-items: center;
    gap: 30px;
}
.header-topbar .logo-text {
    font: 800 1.3rem/1 system-ui;
}
.header-topbar .menu {
    display: flex;
    gap: 5px;
    flex: 1;
}
.header-topbar .menu li a {
    padding: 8px 14px;
    font: 600 .85rem/1 system-ui;
    border-radius: 6px;
    transition: .2s;
}
.header-topbar .menu li a:hover {
    background: #eff6ff;
    color: var(--primary);
}
.header-search form {
    display: flex;
    background: #f1f5f9;
    border-radius: 25px;
    overflow: hidden;
}
.header-search input {
    border: none;
    background: none;
    padding: 8px 15px;
    width: 180px;
    font-size: .85rem;
}
.header-search input:focus {
    outline: none;
}
.header-search button {
    padding: 8px 12px;
    color: var(--gray);
}
.header-topbar .mobile-toggle {
    display: none;
}
@media(max-width:900px) {
    .topbar { display: none; }
    .header-topbar .nav-primary { display: none; }
    .header-search { display: none; }
    .header-topbar .mobile-toggle { display: block; }
}
</style>
