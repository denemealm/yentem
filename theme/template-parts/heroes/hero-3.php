<?php
/**
 * Hero Style 3: Slider - Multiple slides with carousel
 */
$tag = get_theme_mod('dtb_hero_tag', 'Gündem Özel');
$title = get_theme_mod('dtb_hero_title', 'Teknolojinin Sınırlarını Bugünden Keşfedin');
$desc = get_theme_mod('dtb_hero_description', 'Yapay zeka devriminden yeni nesil işlemcilere kadar, dijital dünyanın nabzını tutan en güncel analizler.');

$slides = array(
    array(
        'tag' => $tag,
        'title' => $title,
        'desc' => $desc,
        'image' => 'https://placehold.co/1400x600/2563eb/FFF?text=Slide+1',
        'url' => '#'
    ),
    array(
        'tag' => 'Teknoloji',
        'title' => 'Yapay Zeka ile Geleceği Şekillendirin',
        'desc' => 'En son AI gelişmeleri ve uygulamaları hakkında detaylı analizler.',
        'image' => 'https://placehold.co/1400x600/9333ea/FFF?text=Slide+2',
        'url' => '#'
    ),
    array(
        'tag' => 'Donanım',
        'title' => 'Yeni Nesil İşlemciler Test Edildi',
        'desc' => 'AMD ve Intel\'in son işlemcilerinin karşılaştırmalı performans testleri.',
        'image' => 'https://placehold.co/1400x600/dc2626/FFF?text=Slide+3',
        'url' => '#'
    ),
);
?>
<section class="hero hero-slider">
    <div class="slider-container">
        <div class="slides" id="heroSlides">
            <?php foreach ($slides as $index => $slide) : ?>
                <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" style="background-image: url('<?php echo esc_url($slide['image']); ?>');">
                    <div class="slide-overlay"></div>
                    <div class="container">
                        <div class="slide-content">
                            <span class="slide-tag"><?php echo esc_html($slide['tag']); ?></span>
                            <h2 class="slide-title"><?php echo esc_html($slide['title']); ?></h2>
                            <p class="slide-desc"><?php echo esc_html($slide['desc']); ?></p>
                            <a href="<?php echo esc_url($slide['url']); ?>" class="slide-btn">Devamını Oku</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="slider-nav">
            <button class="nav-btn prev" onclick="dtbSlider(-1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <button class="nav-btn next" onclick="dtbSlider(1)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>

        <div class="slider-dots">
            <?php foreach ($slides as $index => $slide) : ?>
                <button class="dot <?php echo $index === 0 ? 'active' : ''; ?>" onclick="dtbGoToSlide(<?php echo $index; ?>)"></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.hero-slider {
    position: relative;
    width: 100%;
}
.hero-slider .slider-container {
    position: relative;
    overflow: hidden;
}
.hero-slider .slides {
    position: relative;
    height: 550px;
}
.hero-slider .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity .5s;
}
.hero-slider .slide.active {
    opacity: 1;
}
.hero-slider .slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,.7) 0%, rgba(0,0,0,.3) 100%);
}
.hero-slider .slide-content {
    position: relative;
    z-index: 2;
    max-width: 650px;
    padding: 100px 0;
    color: #fff;
}
.hero-slider .slide-tag {
    display: inline-block;
    background: var(--primary);
    padding: 6px 16px;
    border-radius: 20px;
    font: 700 .75rem/1 system-ui;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
}
.hero-slider .slide-title {
    font: 800 2.8rem/1.15 system-ui;
    margin: 0 0 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,.3);
}
.hero-slider .slide-desc {
    font: 1.1rem/1.6 system-ui;
    opacity: .9;
    margin-bottom: 2rem;
}
.hero-slider .slide-btn {
    display: inline-block;
    background: #fff;
    color: var(--dark);
    padding: 14px 28px;
    border-radius: 8px;
    font: 600 .9rem/1 system-ui;
    transition: .2s;
}
.hero-slider .slide-btn:hover {
    background: var(--primary);
    color: #fff;
}
.hero-slider .slider-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    pointer-events: none;
}
.hero-slider .nav-btn {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    transition: .2s;
    pointer-events: auto;
    backdrop-filter: blur(5px);
}
.hero-slider .nav-btn:hover {
    background: rgba(255,255,255,.3);
}
.hero-slider .slider-dots {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
}
.hero-slider .dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,.4);
    transition: .2s;
}
.hero-slider .dot.active {
    background: #fff;
    width: 30px;
    border-radius: 6px;
}
@media(max-width:768px) {
    .hero-slider .slides { height: 450px; }
    .hero-slider .slide-title { font-size: 2rem; }
    .hero-slider .slide-content { padding: 60px 0; }
}
</style>

<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slider .slide');
const dots = document.querySelectorAll('.hero-slider .dot');

function dtbSlider(direction) {
    currentSlide += direction;
    if (currentSlide >= slides.length) currentSlide = 0;
    if (currentSlide < 0) currentSlide = slides.length - 1;
    updateSlider();
}

function dtbGoToSlide(index) {
    currentSlide = index;
    updateSlider();
}

function updateSlider() {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === currentSlide);
    });
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentSlide);
    });
}

// Auto slide
setInterval(() => dtbSlider(1), 5000);
</script>
