<?php
/**
 * Header Style 5: Transparent - Overlay style (for hero backgrounds)
 */
?>
<header class="header header-transparent">
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

            <div class="header-actions">
                <a href="#" class="btn-header">Abone Ol</a>
                <button class="mobile-toggle" onclick="dtbToggleMenu()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<style>
.header-transparent {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
    background: transparent;
    z-index: 100;
}
.header-transparent.scrolled {
    position: fixed;
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 20px rgba(0,0,0,.1);
}
.header-transparent.scrolled .logo-text,
.header-transparent.scrolled .menu li a,
.header-transparent.scrolled .mobile-toggle svg {
    color: var(--dark);
    stroke: var(--dark);
}
.header-transparent .header-inner {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.header-transparent .logo-text {
    font: 800 1.5rem/1 system-ui;
    color: #fff;
    text-shadow: 0 2px 4px rgba(0,0,0,.2);
}
.header-transparent .menu {
    display: flex;
    gap: 5px;
}
.header-transparent .menu li a {
    padding: 10px 16px;
    font: 600 .9rem/1 system-ui;
    color: #fff;
    border-radius: 6px;
    transition: .2s;
    text-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.header-transparent .menu li a:hover {
    background: rgba(255,255,255,.15);
}
.header-transparent .header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}
.header-transparent .btn-header {
    background: #fff;
    color: var(--dark);
    padding: 10px 20px;
    border-radius: 25px;
    font: 600 .85rem/1 system-ui;
    transition: .2s;
}
.header-transparent .btn-header:hover {
    background: var(--primary);
    color: #fff;
}
.header-transparent.scrolled .btn-header {
    background: var(--primary);
    color: #fff;
}
.header-transparent .mobile-toggle {
    display: none;
}
.header-transparent .mobile-toggle svg {
    stroke: #fff;
}
@media(max-width:900px) {
    .header-transparent .nav-primary { display: none; }
    .header-transparent .btn-header { display: none; }
    .header-transparent .mobile-toggle { display: block; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header-transparent');
    if (header) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
</script>
