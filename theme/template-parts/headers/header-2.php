<?php
/**
 * Header Style 2: Centered - Logo center, menu below
 */
?>
<header class="header header-centered">
    <div class="container">
        <div class="header-top">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </a>
            <p class="tagline"><?php bloginfo('description'); ?></p>
        </div>

        <nav class="nav-centered">
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
</header>

<style>
.header-centered {
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
    padding: 1.5rem 0;
}
.header-centered .header-top {
    text-align: center;
    margin-bottom: 1rem;
}
.header-centered .logo-text {
    font: 800 2rem/1 system-ui;
    letter-spacing: -1px;
    display: block;
    margin-bottom: .5rem;
}
.header-centered .tagline {
    color: var(--gray);
    font-size: .9rem;
}
.header-centered .nav-centered {
    display: flex;
    justify-content: center;
    border-top: 1px solid #e2e8f0;
    padding-top: 1rem;
}
.header-centered .menu {
    display: flex;
    gap: 0;
}
.header-centered .menu li a {
    padding: 8px 20px;
    font: 600 .85rem/1 system-ui;
    text-transform: uppercase;
    letter-spacing: .5px;
    border-right: 1px solid #e2e8f0;
    transition: .2s;
}
.header-centered .menu li:last-child a {
    border-right: none;
}
.header-centered .menu li a:hover {
    color: var(--primary);
    background: #f8fafc;
}
.header-centered .mobile-toggle {
    display: none;
    position: absolute;
    top: 1.5rem;
    right: 1rem;
}
@media(max-width:900px) {
    .header-centered .container { position: relative; }
    .header-centered .nav-centered { display: none; }
    .header-centered .mobile-toggle { display: block; }
}
</style>
