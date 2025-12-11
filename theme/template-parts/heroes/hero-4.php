<?php
/**
 * Hero Style 4: Video Background
 */
$tag = get_theme_mod('dtb_hero_tag', 'Gündem Özel');
$title = get_theme_mod('dtb_hero_title', 'Teknolojinin Sınırlarını Bugünden Keşfedin');
$desc = get_theme_mod('dtb_hero_description', 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler ve incelemeler.');
$btn_text = get_theme_mod('dtb_hero_button_text', 'Hemen Okumaya Başla');
$btn_url = get_theme_mod('dtb_hero_button_url', '#');
?>
<section class="hero hero-video">
    <div class="video-bg">
        <!-- Using a placeholder image for video fallback -->
        <div class="video-placeholder" style="background-image: url('https://placehold.co/1920x800/0f172a/333?text=Video+Background');"></div>
        <div class="video-overlay"></div>
    </div>

    <div class="container">
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
                    <a href="<?php echo esc_url($btn_url); ?>" class="hero-btn primary">
                        <?php echo esc_html($btn_text); ?>
                    </a>
                <?php endif; ?>
                <button class="hero-btn play" onclick="dtbPlayVideo()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <span>Video İzle</span>
                </button>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <span>Aşağı Kaydır</span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9"></polyline>
        </svg>
    </div>
</section>

<style>
.hero-video {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.hero-video .video-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
}
.hero-video .video-placeholder {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    filter: grayscale(30%);
}
.hero-video .video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(15,23,42,.85) 0%, rgba(37,99,235,.5) 100%);
}
.hero-video .hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
    color: #fff;
    padding: 80px 0;
}
.hero-video .hero-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,.1);
    backdrop-filter: blur(10px);
    padding: 8px 18px;
    border-radius: 50px;
    font: 600 .8rem/1 system-ui;
    text-transform: uppercase;
    margin-bottom: 2rem;
    border: 1px solid rgba(255,255,255,.2);
}
.hero-video .hero-tag::before {
    content: '';
    width: 8px;
    height: 8px;
    background: #22c55e;
    border-radius: 50%;
    animation: pulse 2s infinite;
}
.hero-video .hero-title {
    font: 800 3.5rem/1.1 system-ui;
    margin: 0 0 1.5rem;
    letter-spacing: -2px;
}
.hero-video .hero-desc {
    font: 1.15rem/1.7 system-ui;
    opacity: .85;
    margin-bottom: 2.5rem;
}
.hero-video .hero-actions {
    display: flex;
    gap: 20px;
    align-items: center;
}
.hero-video .hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 30px;
    border-radius: 50px;
    font: 600 .95rem/1 system-ui;
    transition: .3s;
}
.hero-video .hero-btn.primary {
    background: #fff;
    color: var(--dark);
}
.hero-video .hero-btn.primary:hover {
    background: var(--primary);
    color: #fff;
    transform: translateY(-2px);
}
.hero-video .hero-btn.play {
    background: transparent;
    color: #fff;
    border: 2px solid rgba(255,255,255,.3);
}
.hero-video .hero-btn.play:hover {
    border-color: #fff;
    background: rgba(255,255,255,.1);
}
.hero-video .scroll-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    text-align: center;
    font-size: .8rem;
    opacity: .7;
    animation: bounce 2s infinite;
}
.hero-video .scroll-indicator span {
    display: block;
    margin-bottom: 5px;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: .5; }
}
@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(10px); }
}
@media(max-width:768px) {
    .hero-video { min-height: 80vh; }
    .hero-video .hero-title { font-size: 2.5rem; }
    .hero-video .hero-actions { flex-direction: column; align-items: flex-start; }
    .hero-video .scroll-indicator { display: none; }
}
</style>
