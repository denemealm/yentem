<?php
/**
 * Posts Style 1: Card Grid - 3 columns
 */
$section_title = get_theme_mod('dtb_posts_title', 'Son Eklenenler');
$posts_count = get_theme_mod('dtb_posts_count', 6);
$posts = dtb_get_sample_posts($posts_count);
$demo_posts = dtb_get_demo_posts($posts_count);
?>
<section class="posts-section posts-grid">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="section-link">Tümü →</a>
        </div>

        <div class="posts-wrapper grid-3">
            <?php if ($posts instanceof WP_Query && $posts->have_posts()) : ?>
                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(null, 'medium_large'); ?>" class="card-img" alt="<?php the_title_attribute(); ?>">
                        <?php else : ?>
                            <img src="https://placehold.co/600x338/e2e8f0/64748b?text=No+Image" class="card-img" alt="">
                        <?php endif; ?>
                        <div class="card-cat"><?php echo get_the_category_list(', '); ?></div>
                        <h3 class="card-title"><?php the_title(); ?></h3>
                        <p class="card-desc"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ($demo_posts as $post) : ?>
                    <a href="#" class="card">
                        <img src="<?php echo esc_url($post['image']); ?>" class="card-img" alt="<?php echo esc_attr($post['title']); ?>">
                        <div class="card-cat"><?php echo esc_html($post['category']); ?></div>
                        <h3 class="card-title"><?php echo esc_html($post['title']); ?></h3>
                        <p class="card-desc"><?php echo esc_html($post['excerpt']); ?></p>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.posts-grid {
    padding: 4rem 0;
}
.posts-grid .card {
    display: flex;
    flex-direction: column;
    transition: .2s;
}
.posts-grid .card:hover {
    transform: translateY(-5px);
}
.posts-grid .card-img {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 12px;
    background: #e2e8f0;
    margin-bottom: 15px;
    transition: .3s;
}
.posts-grid .card:hover .card-img {
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
}
.posts-grid .card-cat {
    font: 700 .75rem/1 system-ui;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 8px;
}
.posts-grid .card-title {
    font: 700 1.1rem/1.4 system-ui;
    margin: 0 0 10px;
    color: var(--dark);
    transition: .2s;
}
.posts-grid .card:hover .card-title {
    color: var(--primary);
}
.posts-grid .card-desc {
    font: .9rem/1.6 system-ui;
    color: var(--gray);
    margin: 0;
}
@media(max-width:900px) {
    .posts-grid .posts-wrapper { grid-template-columns: repeat(2, 1fr); }
}
@media(max-width:600px) {
    .posts-grid .posts-wrapper { grid-template-columns: 1fr; }
}
</style>
