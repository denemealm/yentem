<?php
/**
 * Posts Style 4: Masonry Grid - Pinterest style
 */
$section_title = get_theme_mod('dtb_posts_title', 'Son Eklenenler');
$posts_count = get_theme_mod('dtb_posts_count', 6);
$posts = dtb_get_sample_posts($posts_count);
$demo_posts = dtb_get_demo_posts($posts_count);

$heights = array('tall', 'short', 'medium', 'short', 'tall', 'medium');
?>
<section class="posts-section posts-masonry">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="section-link">Tümü →</a>
        </div>

        <div class="masonry-grid">
            <?php if ($posts instanceof WP_Query && $posts->have_posts()) : ?>
                <?php $i = 0; while ($posts->have_posts()) : $posts->the_post(); $height = $heights[$i % 6]; ?>
                    <a href="<?php the_permalink(); ?>" class="masonry-item <?php echo $height; ?>">
                        <div class="masonry-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php else : ?>
                                <img src="https://placehold.co/600x<?php echo $height === 'tall' ? '800' : ($height === 'short' ? '400' : '600'); ?>/e2e8f0/64748b?text=<?php echo $i + 1; ?>" alt="">
                            <?php endif; ?>
                            <div class="masonry-overlay">
                                <span class="masonry-cat"><?php echo get_the_category_list(', '); ?></span>
                                <h3 class="masonry-title"><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </a>
                <?php $i++; endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php $i = 0; foreach ($demo_posts as $post) : $height = $heights[$i % 6]; ?>
                    <a href="#" class="masonry-item <?php echo $height; ?>">
                        <div class="masonry-image">
                            <img src="https://placehold.co/600x<?php echo $height === 'tall' ? '800' : ($height === 'short' ? '400' : '600'); ?>/<?php echo substr(md5($post['title']), 0, 6); ?>/FFF?text=<?php echo urlencode($post['category']); ?>" alt="<?php echo esc_attr($post['title']); ?>">
                            <div class="masonry-overlay">
                                <span class="masonry-cat"><?php echo esc_html($post['category']); ?></span>
                                <h3 class="masonry-title"><?php echo esc_html($post['title']); ?></h3>
                            </div>
                        </div>
                    </a>
                <?php $i++; endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.posts-masonry {
    padding: 4rem 0;
    background: #f8fafc;
}
.posts-masonry .masonry-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-auto-rows: 100px;
    gap: 20px;
}
.posts-masonry .masonry-item {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
}
.posts-masonry .masonry-item.tall { grid-row: span 4; }
.posts-masonry .masonry-item.medium { grid-row: span 3; }
.posts-masonry .masonry-item.short { grid-row: span 2; }
.posts-masonry .masonry-image {
    width: 100%;
    height: 100%;
    position: relative;
}
.posts-masonry .masonry-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .4s;
}
.posts-masonry .masonry-item:hover img {
    transform: scale(1.1);
}
.posts-masonry .masonry-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 30px 20px 20px;
    background: linear-gradient(to top, rgba(0,0,0,.8) 0%, transparent 100%);
    color: #fff;
    transform: translateY(20px);
    opacity: 0;
    transition: .3s;
}
.posts-masonry .masonry-item:hover .masonry-overlay {
    transform: translateY(0);
    opacity: 1;
}
.posts-masonry .masonry-cat {
    display: inline-block;
    background: var(--primary);
    padding: 4px 12px;
    border-radius: 15px;
    font: 700 .7rem/1 system-ui;
    text-transform: uppercase;
    margin-bottom: 10px;
}
.posts-masonry .masonry-title {
    font: 700 1rem/1.3 system-ui;
    margin: 0;
}
@media(max-width:900px) {
    .posts-masonry .masonry-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media(max-width:600px) {
    .posts-masonry .masonry-grid {
        grid-template-columns: 1fr;
        grid-auto-rows: auto;
    }
    .posts-masonry .masonry-item,
    .posts-masonry .masonry-item.tall,
    .posts-masonry .masonry-item.medium,
    .posts-masonry .masonry-item.short {
        grid-row: span 1;
        height: 250px;
    }
    .posts-masonry .masonry-overlay {
        transform: translateY(0);
        opacity: 1;
    }
}
</style>
