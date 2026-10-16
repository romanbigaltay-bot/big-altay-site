<?php
/**
 * BADS Meta Bar Component (Date + Reactions / Meta Information)
 * Standard layout bar for single posts, articles, and reviews.
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id     = $args['post_id'] ?? get_the_ID();
$title       = $args['title'] ?? get_the_title($post_id);
$permalink   = $args['url'] ?? get_permalink($post_id);
$date        = $args['date'] ?? get_the_date('d.m.Y', $post_id);
$date_iso    = $args['date_iso'] ?? get_the_date('c', $post_id);
$size        = $args['size'] ?? '2x'; // 'default', '2x'
$extra_class = $args['class'] ?? '';
$has_border  = $args['border_top'] ?? false;

$is_large = ($size === '2x' || $size === 'lg');
$icon_size = $is_large ? 'md' : 'xs';
?>

<div class="bads-meta-bar <?= $is_large ? 'bads-meta-bar--2x' : ''; ?> bads-cluster u-items-center u-justify-between u-w-full <?= $has_border ? 'bads-meta-bar--bordered u-pt-lg u-mt-lg' : 'u-py-sm'; ?> <?= esc_attr($extra_class); ?>">
    <!-- Left: Publication date (with 24px left indent) -->
    <div class="bads-meta-bar__date bads-cluster u-items-center u-text-muted u-pl-lg">
        <span class="u-text-primary" style="display: inline-flex; align-items: center;">
            <?php
            get_template_part('template-parts/ui/icon', null, [
                'name'       => 'calendar',
                'size'       => $icon_size,
                'decorative' => true,
            ]);
            ?>
        </span>
        <time datetime="<?= esc_attr($date_iso); ?>">
            <?= esc_html($date); ?>
        </time>
    </div>

    <!-- Right: Reactions panel (Likes, Shares, Views with 24px right indent) -->
    <div class="bads-meta-bar__reactions u-pr-lg">
        <?php
        get_template_part('template-parts/components/reactions', null, [
            'post_id' => $post_id,
            'title'   => $title,
            'url'     => $permalink,
            'size'    => $size,
        ]);
        ?>
    </div>
</div>