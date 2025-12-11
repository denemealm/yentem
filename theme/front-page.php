<?php
/**
 * Front Page Template
 */
get_header();
?>

<main class="site-main">
    <?php
    // Load Hero Section
    dtb_load_component('hero');

    // Load Posts Section
    dtb_load_component('posts');
    ?>
</main>

<?php get_footer(); ?>
