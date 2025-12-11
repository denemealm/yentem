<?php
/**
 * Main Template
 */
get_header();
?>

<main class="site-main">
    <?php
    // Load Hero Section (only on front page)
    if (is_front_page() || is_home()) {
        dtb_load_component('hero');
    }
    ?>

    <?php
    // Load Posts Section
    dtb_load_component('posts');
    ?>
</main>

<?php get_footer(); ?>
