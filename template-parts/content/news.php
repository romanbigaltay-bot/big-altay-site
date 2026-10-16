<?php
/**
 * BADS News Item Template Part
 *
 * @package BADS
 */

$extra_class = $args['class'] ?? '';
$post_id = get_the_ID();
$title = get_the_title() ?: 'Старт продаж авторских туров сезона 2026';
$date = get_the_date('d.m.Y') ?: '15.05.2026';
$excerpt = get_the_excerpt() ?: 'Открыто бронирование экспедиций на Телецкое озеро, Шавлинские озера и долину реки Чулышман.';

// Metrics data
$views_count = function_exists('bads_get_news_views') ? bads_get_news_views($post_id) : (int) get_post_meta($post_id, '_bads_views_count', true);
$likes_count = function_exists('bads_get_news_likes') ? bads_get_news_likes($post_id) : (int) get_post_meta($post_id, '_bads_likes_count', true);

// 1. Featured image (thumbnail)
$image_url = '';
if ($post_id && has_post_thumbnail($post_id)) {
    $image_url = get_the_post_thumbnail_url($post_id, 'large') ?: get_the_post_thumbnail_url($post_id, 'full');
}

// 2. Custom field 'news_promo' (legacy importer)
if (empty($image_url) && $post_id) {
    $promo_id = get_post_meta($post_id, 'news_promo', true);
    if (!empty($promo_id)) {
        $image_url = is_numeric($promo_id) ? wp_get_attachment_image_url((int)$promo_id, 'large') : $promo_id;
    }
}

// 3. ACF field fallback
if (empty($image_url) && $post_id && function_exists('get_field')) {
    $acf_img = get_field('image', $post_id) ?: get_field('photo', $post_id) ?: get_field('news_promo', $post_id);
    if (!empty($acf_img)) {
        if (is_array($acf_img) && !empty($acf_img['url'])) {
            $image_url = $acf_img['sizes']['large'] ?? $acf_img['url'];
        } elseif (is_numeric($acf_img)) {
            $image_url = wp_get_attachment_image_url((int)$acf_img, 'large');
        } elseif (is_string($acf_img)) {
            $image_url = $acf_img;
        }
    }
}

// 4. Safe fallback placeholder
if (empty($image_url)) {
    $image_url = function_exists('bads_get_placeholder_url') 
        ? bads_get_placeholder_url('image') 
        : get_template_directory_uri() . '/assets/images/placeholders/image.svg';
}
?>

<article class="bads-card bads-card--default bads-card--outline bads-card--radius-xl bads-card--padding-md bads-card--hover-zoom u-w-full <?= esc_attr($extra_class); ?>">
    <a href="<?= esc_url(get_permalink()); ?>" class="u-block u-min-w-0" style="border-radius: var(--radius-lg, 16px); overflow: hidden; isolation: isolate;">
        <div class="bads-media bads-media--ratio-landscape bads-media--fit-cover bads-media--rounded-lg">
            <img 
                src="<?= esc_url($image_url); ?>" 
                alt="<?= esc_attr($title); ?>"
                class="bads-media__image"
                loading="lazy"
            >
        </div>
    </a>

    <div class="bads-stack bads-stack--none u-flex-1 u-mt-md">
        <!-- Date with icon immediately below image -->
        <div class="bads-cluster u-items-center u-text-xs u-text-muted" style="--bads-cluster-gap: 6px;">
            <span class="u-text-primary" style="display: inline-flex; align-items: center;">
                <?php
                get_template_part('template-parts/ui/icon', null, [
                    'name'       => 'calendar',
                    'size'       => 'xs',
                    'decorative' => true,
                ]);
                ?>
            </span>
            <time datetime="<?= esc_attr(get_the_date('c', $post_id)); ?>"><?= esc_html($date); ?></time>
        </div>

        <!-- Title: turns blue on hover, fixed height clamp for uniform cards -->
        <h3 class="bads-card__title bads-card__title--hover-primary u-clamp-2 u-text-lg u-text-bold u-leading-tight u-mt-xs">
            <a href="<?= esc_url(get_permalink()); ?>" class="u-text-dark u-transition-colors">
                <?= esc_html($title); ?>
            </a>
        </h3>

        <!-- Excerpt: fixed height clamp for uniform cards -->
        <div class="u-clamp-3 u-text-sm u-text-muted u-mt-xs">
            <?= esc_html($excerpt); ?>
        </div>
        
        <!-- Card Footer: Left side contains metrics (likes, shares, views), Right side contains "Читать новость ->" -->
        <div class="bads-card__footer">
            <!-- Left Corner: Interactive & Informational Metrics -->
            <div class="bads-card__footer-start">
                <?php
                get_template_part('template-parts/components/reactions', null, [
                    'post_id' => $post_id,
                    'title'   => $title,
                    'url'     => get_permalink(),
                ]);
                ?>
            </div>

            <!-- Right Corner: "Читать новость ->" using UI Button variant link -->
            <div class="bads-card__footer-end bads-card__action bads-card__action--reveal">
                <?php
                get_template_part('template-parts/ui/button', null, [
                    'text'          => 'Читать новость',
                    'url'           => get_permalink(),
                    'type'          => 'link',
                    'variant'       => 'link',
                    'size'          => 'sm',
                    'icon'          => 'navigation/arrow-right',
                    'icon_size'     => 'sm',
                    'icon_position' => 'right',
                    'class'         => 'u-text-bold',
                ]);
                ?>
            </div>
        </div>
    </div>
</article>
