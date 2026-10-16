<?php
/**
 * BADS Reactions Component (Likes, Reposts/Shares, Views)
 * Universal social feedback widget for posts, cards, articles, and reviews.
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id     = $args['post_id'] ?? get_the_ID();
$title       = $args['title'] ?? get_the_title($post_id);
$permalink   = $args['url'] ?? get_permalink($post_id);
$size        = $args['size'] ?? 'default'; // 'sm', 'default', 'lg', '2x'
$extra_class = $args['class'] ?? '';

$views_count = function_exists('bads_get_news_views') 
    ? bads_get_news_views($post_id) 
    : (int) get_post_meta($post_id, '_bads_views_count', true);

$likes_count = function_exists('bads_get_news_likes') 
    ? bads_get_news_likes($post_id) 
    : (int) get_post_meta($post_id, '_bads_likes_count', true);

// Size modifier mapping
$size_class = '';
$icon_size  = 'xs';
if ($size === 'lg' || $size === '2x') {
    $size_class = 'bads-reactions--2x';
    $icon_size  = 'md';
} elseif ($size === 'sm') {
    $size_class = 'bads-reactions--sm';
    $icon_size  = 'xs';
}
?>

<div class="bads-reactions <?= esc_attr(trim($size_class . ' ' . $extra_class)); ?>">
    <!-- Like Action Button (Heart) -->
    <button 
        type="button" 
        class="bads-reactions__btn bads-reactions__btn--like bads-card__metric-btn--like" 
        data-post-id="<?= esc_attr($post_id); ?>"
        aria-label="<?= esc_attr__('Поставить отметку «Нравится»', 'bads'); ?>"
        title="<?= esc_attr__('Нравится', 'bads'); ?>"
    >
        <?php
        get_template_part('template-parts/ui/icon', null, [
            'name'       => 'actions/heart',
            'size'       => $icon_size,
            'decorative' => true,
        ]);
        ?>
        <span class="bads-reactions__count bads-card__metric-count"><?= esc_html($likes_count); ?></span>
    </button>

    <!-- Share / Repost Action Button (Forward Arrow) -->
    <button 
        type="button" 
        class="bads-reactions__btn bads-reactions__btn--share bads-card__metric-btn--share" 
        data-url="<?= esc_url($permalink); ?>"
        data-title="<?= esc_attr($title); ?>"
        aria-label="<?= esc_attr__('Поделиться новостью', 'bads'); ?>"
        title="<?= esc_attr__('Поделиться', 'bads'); ?>"
    >
        <?php
        get_template_part('template-parts/ui/icon', null, [
            'name'       => 'actions/share',
            'size'       => $icon_size,
            'decorative' => true,
        ]);
        ?>
    </button>

    <!-- Views Indicator (Eye) -->
    <div class="bads-reactions__item bads-reactions__item--views bads-card__metric-item--views" title="<?= esc_attr__('Количество просмотров', 'bads'); ?>">
        <?php
        get_template_part('template-parts/ui/icon', null, [
            'name'       => 'actions/eye',
            'size'       => $icon_size,
            'decorative' => true,
        ]);
        ?>
        <span class="bads-reactions__count bads-card__metric-count"><?= esc_html($views_count); ?></span>
    </div>
</div>