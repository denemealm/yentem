<?php
/**
 * Hero Style 1: Centered - Title and CTA button
 */
$tag = get_theme_mod('dtb_hero_tag', 'Gündem Özel');
$title = get_theme_mod('dtb_hero_title', 'Teknolojinin Sınırlarını Bugünden Keşfedin');
$desc = get_theme_mod('dtb_hero_description', 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.');
$btn_text = get_theme_mod('dtb_hero_button_text', 'Hemen Okumaya Başla');
$btn_url = get_theme_mod('dtb_hero_button_url', '#');
?>
<section class="hero hero-centered">
    <div class="container">
        <div class="hero-inner">
            <?php if ($tag) : ?>
                <span class="hero-tag"><?php echo esc_html($tag); ?></span>
            <?php endif; ?>
            <h1 class="hero-title">
                <?php
                $words = explode(' ', $title);
                $half = ceil(count($words) / 2);
                echo esc_html(implode(' ', array_slice($words, 0, $half)));
                ?>
                <br>
                <span class="text-gradient"><?php echo esc_html(implode(' ', array_slice($words, $half))); ?></span>
            </h1>
            <?php if ($desc) : ?>
                <p class="hero-desc"><?php echo esc_html($desc); ?></p>
            <?php endif; ?>
            <?php if ($btn_text) : ?>
                <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn"><?php echo esc_html($btn_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.hero-centered {
    width: 100%;
    background: radial-gradient(circle at top center, #f8fafc 0%, #eff6ff 40%, #fff 100%);
    padding: 5rem 0;
    text-align: center;
}
.hero-centered .hero-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.hero-centered .hero-tag {
    background: #fff;
    border: 1px solid #e2e8f0;
    padding: 6px 18px;
    border-radius: 50px;
    font: 700 .7rem/1 system-ui;
    color: var(--primary);
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    box-shadow: 0 2px 8px rgba(0,0,0,.03);
}
.hero-centered .hero-title {
    font: 800 3.2rem/1.1 system-ui;
    margin: 0 0 1.5rem;
    letter-spacing: -1.5px;
}
.hero-centered .text-gradient {
    background: linear-gradient(135deg, var(--primary) 0%, #9333ea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-centered .hero-desc {
    font: 1.1rem/1.7 system-ui;
    color: var(--gray);
    max-width: 600px;
    margin-bottom: 2rem;
}
.hero-centered .hero-btn {
    background: var(--primary);
    color: #fff;
    padding: 14px 28px;
    border-radius: 50px;
    font: 600 .95rem/1 system-ui;
    transition: .2s;
    box-shadow: 0 4px 15px rgba(37,99,235,.3);
}
.hero-centered .hero-btn:hover {
    background: #1e40af;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37,99,235,.4);
}
@media(max-width:768px) {
    .hero-centered { padding: 3rem 0; }
    .hero-centered .hero-title { font-size: 2.2rem; }
    .hero-centered .hero-desc { font-size: 1rem; }
}
</style>
