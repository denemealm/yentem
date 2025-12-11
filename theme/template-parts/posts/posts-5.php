<?php
/**
 * Posts Style 5: Magazine Layout - Featured + grid
 */
$section_title = get_theme_mod('dtb_posts_title', 'Son Eklenenler');
$posts_count = get_theme_mod('dtb_posts_count', 6);
$posts = dtb_get_sample_posts($posts_count);
$demo_posts = dtb_get_demo_posts($posts_count);
?>
<section class="posts-section posts-magazine">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="section-link">Tümü →</a>
        </div>

        <div class="magazine-grid">
            <?php if ($posts instanceof WP_Query && $posts->have_posts()) : ?>
                <?php $counter = 0; while ($posts->have_posts()) : $posts->the_post(); ?>
                    <?php if ($counter === 0) : ?>
                        <!-- Featured Post -->
                        <a href="<?php the_permalink(); ?>" class="magazine-featured">
                            <div class="featured-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php else : ?>
                                    <img src="https://placehold.co/800x600/2563eb/FFF?text=Featured" alt="">
                                <?php endif; ?>
                                <div class="featured-overlay">
                                    <span class="featured-cat"><?php echo get_the_category_list(', '); ?></span>
                                    <h3 class="featured-title"><?php the_title(); ?></h3>
                                    <p class="featured-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    <div class="featured-meta">
                                        <span><?php echo get_the_author(); ?></span>
                                        <span>•</span>
                                        <span><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="magazine-sidebar">
                    <?php else : ?>
                        <!-- Sidebar Posts -->
                        <a href="<?php the_permalink(); ?>" class="sidebar-item">
                            <div class="sidebar-thumb">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(null, 'thumbnail'); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php else : ?>
                                    <img src="https://placehold.co/100x100/e2e8f0/64748b?text=<?php echo $counter; ?>" alt="">
                                <?php endif; ?>
                            </div>
                            <div class="sidebar-content">
                                <span class="sidebar-cat"><?php echo get_the_category_list(', '); ?></span>
                                <h4 class="sidebar-title"><?php the_title(); ?></h4>
                                <span class="sidebar-date"><?php echo get_the_date(); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php $counter++; endwhile; ?>
                        </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <?php foreach ($demo_posts as $index => $post) : ?>
                    <?php if ($index === 0) : ?>
                        <!-- Featured Post -->
                        <a href="#" class="magazine-featured">
                            <div class="featured-image">
                                <img src="https://placehold.co/800x600/2563eb/FFF?text=Featured" alt="<?php echo esc_attr($post['title']); ?>">
                                <div class="featured-overlay">
                                    <span class="featured-cat"><?php echo esc_html($post['category']); ?></span>
                                    <h3 class="featured-title"><?php echo esc_html($post['title']); ?></h3>
                                    <p class="featured-excerpt"><?php echo esc_html($post['excerpt']); ?></p>
                                    <div class="featured-meta">
                                        <span>Yazar Adı</span>
                                        <span>•</span>
                                        <span><?php echo date_i18n('d F Y'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="magazine-sidebar">
                    <?php else : ?>
                        <a href="#" class="sidebar-item">
                            <div class="sidebar-thumb">
                                <img src="<?php echo esc_url($post['image']); ?>" alt="<?php echo esc_attr($post['title']); ?>">
                            </div>
                            <div class="sidebar-content">
                                <span class="sidebar-cat"><?php echo esc_html($post['category']); ?></span>
                                <h4 class="sidebar-title"><?php echo esc_html($post['title']); ?></h4>
                                <span class="sidebar-date"><?php echo date_i18n('d F Y'); ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                        </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.posts-magazine {
    padding: 4rem 0;
}
.posts-magazine .magazine-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: 30px;
}
/* Featured */
.posts-magazine .magazine-featured {
    display: block;
    border-radius: 20px;
    overflow: hidden;
}
.posts-magazine .featured-image {
    position: relative;
    height: 100%;
    min-height: 500px;
}
.posts-magazine .featured-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .4s;
}
.posts-magazine .magazine-featured:hover img {
    transform: scale(1.05);
}
.posts-magazine .featured-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 80px 30px 30px;
    background: linear-gradient(to top, rgba(0,0,0,.9) 0%, transparent 100%);
    color: #fff;
}
.posts-magazine .featured-cat {
    display: inline-block;
    background: var(--primary);
    padding: 5px 14px;
    border-radius: 20px;
    font: 700 .7rem/1 system-ui;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.posts-magazine .featured-title {
    font: 800 1.8rem/1.3 system-ui;
    margin: 0 0 12px;
}
.posts-magazine .featured-excerpt {
    font: .95rem/1.6 system-ui;
    opacity: .85;
    margin: 0 0 15px;
}
.posts-magazine .featured-meta {
    font-size: .85rem;
    opacity: .7;
    display: flex;
    gap: 8px;
}
/* Sidebar */
.posts-magazine .magazine-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.posts-magazine .sidebar-item {
    display: flex;
    gap: 15px;
    padding: 15px;
    background: #f8fafc;
    border-radius: 12px;
    transition: .2s;
}
.posts-magazine .sidebar-item:hover {
    background: #fff;
    box-shadow: 0 5px 20px rgba(0,0,0,.08);
}
.posts-magazine .sidebar-thumb {
    width: 90px;
    height: 90px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
}
.posts-magazine .sidebar-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.posts-magazine .sidebar-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.posts-magazine .sidebar-cat {
    font: 700 .7rem/1 system-ui;
    color: var(--primary);
    text-transform: uppercase;
    margin-bottom: 6px;
}
.posts-magazine .sidebar-title {
    font: 600 .95rem/1.4 system-ui;
    margin: 0 0 6px;
    color: var(--dark);
}
.posts-magazine .sidebar-item:hover .sidebar-title {
    color: var(--primary);
}
.posts-magazine .sidebar-date {
    font-size: .8rem;
    color: var(--gray);
}
@media(max-width:900px) {
    .posts-magazine .magazine-grid {
        grid-template-columns: 1fr;
    }
    .posts-magazine .featured-image {
        min-height: 350px;
    }
}
</style>
