<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Single News Template
 * Template: single-news.php
 * ============================================================================
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (have_posts()) {
    the_post();
}

$current_id = get_the_ID();

// Increment views count safely for the current news post
if ($current_id && !is_admin()) {
    $views = (int) get_post_meta($current_id, '_bads_views_count', true);
    update_post_meta($current_id, '_bads_views_count', $views + 1);
}

// 1. Unified Title & Lead Extraction
$title_full = get_the_title();

// Extract lead paragraph (from ACF, excerpt, or introductory italicized lead in post content)
// When extracted from post content, the opening lead is removed from the body flow to prevent duplication
$news_data = function_exists('bads_get_news_lead') 
    ? bads_get_news_lead($current_id, true) 
    : ['lead' => '', 'content' => get_the_content()];

$article_lead    = $news_data['lead'];
$article_content = $news_data['content'];


// 2. Banner cover image detection (ACF news_promo -> Post Thumbnail -> Placeholder)
$imagePreview = get_field('news_promo');
$sizePreview  = 'header';
$cover_url    = '';

if (!empty($imagePreview)) {
    $cover_url = is_numeric($imagePreview) 
        ? wp_get_attachment_image_url((int)$imagePreview, $sizePreview) 
        : $imagePreview;
} elseif (has_post_thumbnail($current_id)) {
    $cover_url = get_the_post_thumbnail_url($current_id, 'full');
}
?>

<main>
    <section class="bads-section u-pt-md">
        <div class="bads-container bads-container--xl">
            <!-- 2-Column Editorial Grid: Left (920px) + Gap (32px) + Right (440px) = 1392px content (1440px container) -->
            <div class="bads-sidebar bads-sidebar--right bads-sidebar--xl bads-sidebar--editorial">
                
                <!-- Left Column: Main Article Flow (920px max width) -->
                <div class="bads-sidebar__main bads-stack bads-stack--xl">
                    
                    <!-- 1. Breadcrumbs -->
                    <?php get_template_part('template-parts/ui/breadcrumbs', null, [
                        'items' => [
                            ['label' => 'Главная', 'url' => home_url('/')],
                            ['label' => 'Новости', 'url' => get_post_type_archive_link('news') ?: '/news/'],
                            ['label' => $title_full, 'current' => true]
                        ]
                    ]); ?>

                    <!-- 2. Banner Cover (Aspect Ratio 21:9 / Wide, Rounded-2xl) -->
                    <?php if (!empty($cover_url)) : ?>
                        <div class="bads-media bads-media--ratio-wide bads-media--fit-cover u-w-full" style="border-radius: var(--radius-2xl);">
                            <img src="<?= esc_url($cover_url); ?>"
                                 alt="<?= esc_attr($title_full); ?>"
                                 class="bads-media__image"
                                 loading="eager"
                                 fetchpriority="high">
                        </div>
                    <?php endif; ?>

                    <!-- 3. Title & Lead Component with Brand Primary Cyan Divider (24px offset) -->
                    <?php
                    get_template_part('template-parts/ui/title', null, [
                        'level'           => 'h1',
                        'size'            => 'h1',
                        'title'           => $title_full,
                        'subtitle'        => $article_lead,
                        'divider'         => true,
                        'divider_variant' => 'primary', // Brand Primary Cyan/Blue (#019FDE)
                        'divider_width'   => '90px',
                        'divider_offset'  => '24px',
                        'align'           => 'left',
                    ]);
                    ?>

                    <!-- 4. Top News Meta Bar: Date on left (24px indent), Reactions on right (24px indent) -->
                    <?php
                    get_template_part('template-parts/components/meta-bar', null, [
                        'post_id' => $current_id,
                        'title'   => $title_full,
                        'url'     => get_permalink(),
                        'size'    => '2x',
                    ]);
                    ?>

                    <!-- 5. Main Article Body Content with Strict Spacing -->
                    <div class="bads-content bads-content--article">
                        <?php echo apply_filters('the_content', $article_content); ?>
                    </div>

                    <!-- 6. Bottom News Meta Bar (Reactions & Shares Duplicate before Other News) -->
                    <?php
                    get_template_part('template-parts/components/meta-bar', null, [
                        'post_id'    => $current_id,
                        'title'      => $title_full,
                        'url'        => get_permalink(),
                        'size'       => '2x',
                        'border_top' => true,
                    ]);
                    ?>

                </div>

                <!-- Right Column: Sticky News Sidebar (440px width, 3 cards) -->
                <?php
                get_template_part('template-parts/components/news-sidebar', null, [
                    'title'          => 'Другие новости',
                    'count'          => 3,
                    'exclude'        => [$current_id],
                    'sticky'         => true,
                    'show_subscribe' => true,
                ]);
                ?>

            </div>

            <!-- News Subscription & Socials Hero Replica: "Будем на связи!" -->
            <?php
            get_template_part('template-parts/pages/news/subscribe-cta/subscribe-cta', null, [
                'title'          => 'Будем на связи!',
                'subtitle'       => 'Оставайтесь в курсе самых важных событий! Подпишитесь на нашу рассылку или присоединяйтесь к нам в социальных сетях.',
                'divider'        => true,
                'divider_width'  => '90px',
                'divider_offset' => '24px',
                'border_top'     => true,
            ]);
            ?>

            <!-- Bottom Section: "Другие новости" Grid (3 cards, excluding current article & sidebar items) -->
            <?php
            $sidebar_rendered_ids = $GLOBALS['bads_rendered_sidebar_news_ids'] ?? [];
            $bottom_exclude = array_unique(array_filter(array_merge([$current_id], (array) $sidebar_rendered_ids)));

            $bottom_query_args = [
                'post_type'      => 'news',
                'posts_per_page' => 3,
                'post_status'    => 'publish',
                'post__not_in'   => $bottom_exclude,
            ];

            $bottom_query = new WP_Query($bottom_query_args);

            // Graceful fallback if database has few news posts and all were in sidebar
            if (!$bottom_query->have_posts()) {
                $bottom_query = new WP_Query([
                    'post_type'      => 'news',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'post__not_in'   => [$current_id],
                ]);
            }

            if ($bottom_query->have_posts()) : ?>
                <div class="bads-stack bads-stack--md u-pt-xl" style="border-top: 1px solid var(--color-border);">
                    <div class="bads-cluster u-justify-between u-items-center">
                        <?php get_template_part('template-parts/ui/title', null, ['level' => 'h3', 'title' => 'Другие новости']); ?>
                        <?php
                        get_template_part('template-parts/ui/button', null, [
                            'text'          => 'Все новости',
                            'url'           => get_post_type_archive_link('news') ?: '/news/',
                            'type'          => 'link',
                            'variant'       => 'link',
                            'size'          => 'md',
                            'icon'          => 'navigation/arrow-right',
                            'icon_position' => 'right',
                        ]);
                        ?>
                    </div>
                    <div class="bads-grid bads-grid--3">
                        <?php
                        while ($bottom_query->have_posts()) {
                            $bottom_query->the_post();
                            get_template_part('template-parts/content/news');
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php get_footer(); ?>
