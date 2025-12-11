<?php
/**
 * Header Style 3: Minimal - Hamburger menu always visible
 */
?>
<header class="header header-minimal">
    <div class="container">
        <div class="header-inner">
            <button class="hamburger" onclick="dtbToggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>

            <div class="header-actions">
                <button class="search-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="M21 21l-4.35-4.35"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<div class="side-menu" id="sideMenu">
    <div class="side-menu-header">
        <span class="logo-text"><?php bloginfo('name'); ?></span>
        <button class="close-btn" onclick="dtbToggleMenu()">&times;</button>
    </div>
    <nav class="side-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'side-menu-list',
            'fallback_cb' => 'dtb_fallback_menu',
        ));
        ?>
    </nav>
</div>
<div class="overlay" id="menuOverlay" onclick="dtbToggleMenu()"></div>

<style>
.header-minimal {
    position: sticky;
    top: 0;
    height: 60px;
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
    z-index: 100;
}
.header-minimal .header-inner {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.header-minimal .hamburger {
    width: 24px;
    height: 18px;
    position: relative;
    cursor: pointer;
}
.header-minimal .hamburger span {
    display: block;
    position: absolute;
    height: 2px;
    width: 100%;
    background: var(--dark);
    left: 0;
    transition: .3s;
}
.header-minimal .hamburger span:nth-child(1) { top: 0; }
.header-minimal .hamburger span:nth-child(2) { top: 8px; }
.header-minimal .hamburger span:nth-child(3) { top: 16px; }
.header-minimal .logo-text {
    font: 800 1.3rem/1 system-ui;
}
.header-minimal .search-btn {
    color: var(--gray);
    transition: .2s;
}
.header-minimal .search-btn:hover {
    color: var(--primary);
}

/* Side Menu */
.side-menu {
    position: fixed;
    top: 0;
    left: -300px;
    width: 300px;
    height: 100vh;
    background: #fff;
    z-index: 1001;
    transition: .3s;
    box-shadow: 2px 0 20px rgba(0,0,0,.1);
}
.side-menu.active { left: 0; }
.side-menu-header {
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e2e8f0;
}
.side-menu-header .logo-text {
    font: 700 1.2rem/1 system-ui;
}
.side-menu-header .close-btn {
    font-size: 28px;
    color: var(--gray);
}
.side-menu-list {
    padding: 20px;
}
.side-menu-list li a {
    display: block;
    padding: 12px 0;
    font: 500 1rem/1 system-ui;
    border-bottom: 1px solid #f1f5f9;
    transition: .2s;
}
.side-menu-list li a:hover {
    color: var(--primary);
    padding-left: 10px;
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.5);
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: .3s;
}
.overlay.active {
    opacity: 1;
    visibility: visible;
}
</style>
