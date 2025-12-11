<?php
/**
 * Posts Style 3: Vertical List - Clean list style
 */
$section_title = get_theme_mod('dtb_posts_title', 'Son Eklenenler');
$posts_count = get_theme_mod('dtb_posts_count', 6);
$posts = dtb_get_sample_posts($posts_count);
$demo_posts = dtb_get_demo_posts($posts_count);
?>
<section class="posts-section posts-list-style">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="section-link">Tümü →</a>
        </div>

        <div class="posts-list">
            <?php if ($posts instanceof WP_Query && $posts->have_posts()) : ?>
                <?php $counter = 1; while ($posts->have_posts()) : $posts->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="list-item">
                        <span class="item-number"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                        <div class="item-content">
                            <div class="item-meta">
                                <span class="item-cat"><?php echo get_the_category_list(', '); ?></span>
                                <span class="item-date"><?php echo get_the_date(); ?></span>
                            </div>
                            <h3 class="item-title"><?php the_title(); ?></h3>
                            <p class="item-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        </div>
                        <div class="item-thumb">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(null, 'thumbnail'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="https://placehold.co/100x100/e2e8f0/64748b?text=<?php echo $counter; ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </a>
                <?php $counter++; endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php $counter = 1; foreach ($demo_posts as $post) : ?>
                    <a href="#" class="list-item">
                        <span class="item-number"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></span>
                        <div class="item-content">
                            <div class="item-meta">
                                <span class="item-cat"><?php echo esc_html($post['category']); ?></span>
                                <span class="item-date"><?php echo date_i18n('d F Y'); ?></span>
                            </div>
                            <h3 class="item-title"><?php echo esc_html($post['title']); ?></h3>
                            <p class="item-excerpt"><?php echo esc_html($post['excerpt']); ?></p>
                        </div>
                        <div class="item-thumb">
                            <img src="<?php echo esc_url($post['image']); ?>" alt="<?php echo esc_attr($post['title']); ?>">
                        </div>
                    </a>
                <?php $counter++; endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.posts-list-style {
    padding: 4rem 0;
}
.posts-list-style .posts-list {
    display: flex;
    flex-direction: column;
}
.posts-list-style .list-item {
    display: flex;
    align-items: center;
    gap: 25px;
    padding: 25px 0;
    border-bottom: 1px solid #e2e8f0;
    transition: .2s;
}
.posts-list-style .list-item:first-child {
    padding-top: 0;
}
.posts-list-style .list-item:hover {
    padding-left: 10px;
}
.posts-list-style .item-number {
    font: 800 2.5rem/1 system-ui;
    color: #e2e8f0;
    min-width: 60px;
    transition: .2s;
}
.posts-list-style .list-item:hover .item-number {
    color: var(--primary);
}
.posts-list-style .item-content {
    flex: 1;
}
.posts-list-style .item-meta {
    display: flex;
    gap: 15px;
    font-size: .8rem;
    margin-bottom: 8px;
}
.posts-list-style .item-cat {
    color: var(--primary);
    font-weight: 700;
    text-transform: uppercase;
}
.posts-list-style .item-date {
    color: var(--gray);
}
.posts-list-style .item-title {
    font: 700 1.2rem/1.4 system-ui;
    margin: 0 0 8px;
    color: var(--dark);
    transition: .2s;
}
.posts-list-style .list-item:hover .item-title {
    color: var(--primary);
}
.posts-list-style .item-excerpt {
    font: .9rem/1.5 system-ui;
    color: var(--gray);
    margin: 0;
}
.posts-list-style .item-thumb {
    width: 100px;
    height: 100px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}
.posts-list-style .item-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
@media(max-width:600px) {
    .posts-list-style .item-number { display: none; }
    .posts-list-style .item-thumb { width: 80px; height: 80px; }
    .posts-list-style .list-item { gap: 15px; }
}
</style>
