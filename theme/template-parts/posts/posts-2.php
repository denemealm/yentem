<?php
/**
 * Posts Style 2: Horizontal - Image left, content right
 */
$section_title = get_theme_mod('dtb_posts_title', 'Son Eklenenler');
$posts_count = get_theme_mod('dtb_posts_count', 6);
$posts = dtb_get_sample_posts($posts_count);
$demo_posts = dtb_get_demo_posts($posts_count);
?>
<section class="posts-section posts-horizontal">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="section-link">Tümü →</a>
        </div>

        <div class="posts-list">
            <?php if ($posts instanceof WP_Query && $posts->have_posts()) : ?>
                <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="post-item">
                        <div class="post-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(null, 'medium'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="https://placehold.co/400x300/e2e8f0/64748b?text=No+Image" alt="">
                            <?php endif; ?>
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-cat"><?php echo get_the_category_list(', '); ?></span>
                                <span class="post-date"><?php echo get_the_date(); ?></span>
                            </div>
                            <h3 class="post-title"><?php the_title(); ?></h3>
                            <p class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <span class="read-more">Devamını Oku →</span>
                        </div>
                    </a>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ($demo_posts as $post) : ?>
                    <a href="#" class="post-item">
                        <div class="post-image">
                            <img src="<?php echo esc_url($post['image']); ?>" alt="<?php echo esc_attr($post['title']); ?>">
                        </div>
                        <div class="post-content">
                            <div class="post-meta">
                                <span class="post-cat"><?php echo esc_html($post['category']); ?></span>
                                <span class="post-date"><?php echo date_i18n('d F Y'); ?></span>
                            </div>
                            <h3 class="post-title"><?php echo esc_html($post['title']); ?></h3>
                            <p class="post-excerpt"><?php echo esc_html($post['excerpt']); ?></p>
                            <span class="read-more">Devamını Oku →</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.posts-horizontal {
    padding: 4rem 0;
    background: #f8fafc;
}
.posts-horizontal .posts-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}
.posts-horizontal .post-item {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 30px;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    transition: .3s;
    border: 1px solid #e2e8f0;
}
.posts-horizontal .post-item:hover {
    box-shadow: 0 10px 40px rgba(0,0,0,.1);
    transform: translateY(-3px);
}
.posts-horizontal .post-image {
    height: 200px;
    overflow: hidden;
}
.posts-horizontal .post-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .3s;
}
.posts-horizontal .post-item:hover .post-image img {
    transform: scale(1.05);
}
.posts-horizontal .post-content {
    padding: 25px 25px 25px 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.posts-horizontal .post-meta {
    display: flex;
    gap: 15px;
    font-size: .8rem;
    margin-bottom: 10px;
}
.posts-horizontal .post-cat {
    color: var(--primary);
    font-weight: 700;
    text-transform: uppercase;
}
.posts-horizontal .post-date {
    color: var(--gray);
}
.posts-horizontal .post-title {
    font: 700 1.25rem/1.4 system-ui;
    margin: 0 0 10px;
    color: var(--dark);
}
.posts-horizontal .post-item:hover .post-title {
    color: var(--primary);
}
.posts-horizontal .post-excerpt {
    font: .9rem/1.6 system-ui;
    color: var(--gray);
    margin: 0 0 15px;
}
.posts-horizontal .read-more {
    font: 600 .85rem/1 system-ui;
    color: var(--primary);
}
@media(max-width:768px) {
    .posts-horizontal .post-item {
        grid-template-columns: 1fr;
    }
    .posts-horizontal .post-image {
        height: 180px;
    }
    .posts-horizontal .post-content {
        padding: 20px;
    }
}
</style>
