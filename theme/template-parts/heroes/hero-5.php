<?php
/**
 * Hero Style 5: Minimal - Just text, clean and simple
 */
$tag = get_theme_mod('dtb_hero_tag', 'Gündem Özel');
$title = get_theme_mod('dtb_hero_title', 'Teknolojinin Sınırlarını Bugünden Keşfedin');
$desc = get_theme_mod('dtb_hero_description', 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.');
$btn_text = get_theme_mod('dtb_hero_button_text', 'Hemen Okumaya Başla');
$btn_url = get_theme_mod('dtb_hero_button_url', '#');
?>
<section class="hero hero-minimal">
    <div class="container">
        <div class="hero-content">
            <div class="hero-meta">
                <span class="date"><?php echo date_i18n('d F Y'); ?></span>
                <span class="divider">•</span>
                <span class="category"><?php echo esc_html($tag); ?></span>
            </div>
            <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
            <div class="hero-line"></div>
            <?php if ($desc) : ?>
                <p class="hero-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
            <div class="hero-cta">
                <?php if ($btn_text) : ?>
                    <a href="<?php echo esc_url($btn_url); ?>" class="hero-link">
                        <?php echo esc_html($btn_text); ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
.hero-minimal {
    padding: 6rem 0;
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
}
.hero-minimal .hero-content {
    max-width: 800px;
}
.hero-minimal .hero-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 2rem;
    font: 500 .85rem/1 system-ui;
    color: var(--gray);
}
.hero-minimal .hero-meta .category {
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: .5px;
}
.hero-minimal .hero-title {
    font: 800 3.5rem/1.1 system-ui;
    margin: 0 0 2rem;
    letter-spacing: -2px;
    color: var(--dark);
}
.hero-minimal .hero-line {
    width: 60px;
    height: 4px;
    background: var(--primary);
    margin-bottom: 2rem;
}
.hero-minimal .hero-desc {
    font: 1.2rem/1.8 system-ui;
    color: var(--gray);
    margin-bottom: 2.5rem;
    max-width: 650px;
}
.hero-minimal .hero-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font: 600 1rem/1 system-ui;
    color: var(--primary);
    padding-bottom: 5px;
    border-bottom: 2px solid var(--primary);
    transition: .2s;
}
.hero-minimal .hero-link svg {
    transition: .2s;
}
.hero-minimal .hero-link:hover {
    gap: 15px;
}
.hero-minimal .hero-link:hover svg {
    transform: translateX(5px);
}
@media(max-width:768px) {
    .hero-minimal { padding: 4rem 0; }
    .hero-minimal .hero-title { font-size: 2.5rem; }
    .hero-minimal .hero-desc { font-size: 1.05rem; }
}
</style>
