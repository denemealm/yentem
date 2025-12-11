<?php
/**
 * Hero Style 2: Split - Image right, text left
 */
$tag = get_theme_mod('dtb_hero_tag', 'Gündem Özel');
$title = get_theme_mod('dtb_hero_title', 'Teknolojinin Sınırlarını Bugünden Keşfedin');
$desc = get_theme_mod('dtb_hero_description', 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.');
$btn_text = get_theme_mod('dtb_hero_button_text', 'Hemen Okumaya Başla');
$btn_url = get_theme_mod('dtb_hero_button_url', '#');
?>
<section class="hero hero-split">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <?php if ($tag) : ?>
                    <span class="hero-tag"><?php echo esc_html($tag); ?></span>
                <?php endif; ?>
                <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                <?php if ($desc) : ?>
                    <p class="hero-desc"><?php echo esc_html($desc); ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <?php if ($btn_text) : ?>
                        <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn primary"><?php echo esc_html($btn_text); ?></a>
                    <?php endif; ?>
                    <a href="#" class="hero-btn secondary">Daha Fazla</a>
                </div>
                <div class="hero-stats">
                    <div class="stat">
                        <strong>10K+</strong>
                        <span>Okuyucu</span>
                    </div>
                    <div class="stat">
                        <strong>500+</strong>
                        <span>Makale</span>
                    </div>
                    <div class="stat">
                        <strong>50+</strong>
                        <span>Yazar</span>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://placehold.co/600x500/2563eb/FFF?text=Hero+Image" alt="Hero">
                <div class="floating-card card-1">
                    <span class="icon">🚀</span>
                    <span>Yeni Teknolojiler</span>
                </div>
                <div class="floating-card card-2">
                    <span class="icon">💡</span>
                    <span>İnovasyon</span>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-split {
    padding: 4rem 0;
    background: linear-gradient(135deg, #f8fafc 0%, #fff 100%);
}
.hero-split .hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}
.hero-split .hero-content {
    max-width: 550px;
}
.hero-split .hero-tag {
    display: inline-block;
    background: #eff6ff;
    color: var(--primary);
    padding: 6px 14px;
    border-radius: 20px;
    font: 700 .75rem/1 system-ui;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}
.hero-split .hero-title {
    font: 800 2.8rem/1.15 system-ui;
    letter-spacing: -1px;
    margin: 0 0 1.2rem;
}
.hero-split .hero-desc {
    font: 1.05rem/1.7 system-ui;
    color: var(--gray);
    margin-bottom: 2rem;
}
.hero-split .hero-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 2.5rem;
}
.hero-split .hero-btn {
    padding: 14px 26px;
    border-radius: 8px;
    font: 600 .9rem/1 system-ui;
    transition: .2s;
}
.hero-split .hero-btn.primary {
    background: var(--primary);
    color: #fff;
}
.hero-split .hero-btn.primary:hover {
    background: #1e40af;
}
.hero-split .hero-btn.secondary {
    background: #f1f5f9;
    color: var(--dark);
}
.hero-split .hero-btn.secondary:hover {
    background: #e2e8f0;
}
.hero-split .hero-stats {
    display: flex;
    gap: 40px;
}
.hero-split .stat {
    display: flex;
    flex-direction: column;
}
.hero-split .stat strong {
    font: 700 1.5rem/1 system-ui;
    color: var(--primary);
}
.hero-split .stat span {
    font-size: .85rem;
    color: var(--gray);
}
.hero-split .hero-image {
    position: relative;
}
.hero-split .hero-image img {
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0,0,0,.15);
}
.hero-split .floating-card {
    position: absolute;
    background: #fff;
    padding: 12px 18px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,.1);
    display: flex;
    align-items: center;
    gap: 10px;
    font: 600 .85rem/1 system-ui;
    animation: float 3s ease-in-out infinite;
}
.hero-split .card-1 {
    top: 20%;
    left: -30px;
}
.hero-split .card-2 {
    bottom: 20%;
    right: -30px;
    animation-delay: 1.5s;
}
.hero-split .floating-card .icon {
    font-size: 1.2rem;
}
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}
@media(max-width:900px) {
    .hero-split .hero-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    .hero-split .hero-image {
        order: -1;
    }
    .hero-split .floating-card {
        display: none;
    }
    .hero-split .hero-title {
        font-size: 2.2rem;
    }
}
</style>
