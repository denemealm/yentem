<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Load selected header style
dtb_load_component('header');
?>

<!-- Mobile Menu Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
        <span class="drawer-logo"><?php bloginfo('name'); ?></span>
        <button class="drawer-close" onclick="dtbToggleMenu()">&times;</button>
    </div>
    <div class="drawer-body">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'drawer-menu',
            'fallback_cb' => 'dtb_fallback_menu',
        ));
        ?>
    </div>
    <div class="drawer-footer">
        <div class="drawer-social">
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
            <a href="#">LinkedIn</a>
        </div>
    </div>
</div>
<div class="drawer-overlay" id="drawerOverlay" onclick="dtbToggleMenu()"></div>
