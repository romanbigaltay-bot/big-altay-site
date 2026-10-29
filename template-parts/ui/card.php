<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Card
 * ============================================================================
 *
 * Базовый UI-компонент «Карточка».
 *
 * Собирается из примитивов BADS:
 * - Токены   (--radius, --space, typography)
 * - ЛAYOUTS  (bads-frame — рамка-контейнер с aspect-ratio)
 * - UI       (bads-media, badge, title, button, divider...)
 *
 * Структура карточки (slot-модель):
 *   [media]   — превью-изображение (через bads-media) или произвольный HTML
 *   [body]    — контент: kicker + title + subtitle/text + произвольный inner
 *   [footer]  — нижняя зона (обычно кнопка/мета)
 *
 * Args:
 *
 *   content
 *   - image          (array|int|string|null) изображение для bads-media
 *   - image_size     (string)                 размер WP, по умолчанию 'large'
 *   - image_ratio    (string)                  ratio для bads-media ('landscape' = 3:2)
 *   - media_html     (string)                  готовый HTML вместо image (slot media)
 *   - link           (string)                  URL — оборачивает media и title в ссылку
 *
 *   - kicker         (string)                  надзаголовок (мелкий акцентный текст)
 *   - title          (string)                  заголовок карточки
 *   - title_level    (string)                  h2..h6, по умолчанию 'h3'
 *   - title_size     (string)                  визуальный размер (по умолчанию = level)
 *   - text           (string)                  описание (subtitle-стиль)
 *   - inner_html     (string)                  доп. HTML внутри body после текста
 *   - footer_html    (string)                  HTML слота footer
 *   - action_text    (string)                  подпись кнопки действия (если не задан footer_html)
 *
 *   appearance
 *   - surface        (string)   default | glass | glass-solid | outline | flat | elevated
 *   - hover          (string)   none | lift | glow | zoom
 *   - radius         (string)   sm | md | lg
 *   - padding        (string)   none | sm | md | lg | xl
 *   - stacked        (bool)     true — media без отступов (картинка прилегает к краям)
 *
 *   html
 *   - tag            (string)   article|div|li, по умолчанию 'article'
 *   - class          (string)   дополнительные классы
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [

    /* Content */
    'image'       => null,
    'image_size'  => 'large',
    'image_ratio' => '3-2',
    'media_html'  => '',
    'link'        => '',

    'kicker'      => '',
    'title'       => '',
    'title_level' => 'h3',
    'title_size'  => '',
    'text'        => '',
    'inner_html'  => '',
    'footer_html' => '',
    'action_text' => '',

    /* Appearance */
    'surface' => 'default',
    'hover'   => 'none',
    'radius'  => 'lg',
    'padding' => 'md',
    'stacked' => true,

    /* HTML */
    'tag'   => 'article',
    'class' => '',
]);

/*
|--------------------------------------------------------------------------
| Tag
|--------------------------------------------------------------------------
*/

$allowed_tags = ['article', 'div', 'li'];
$tag = in_array($args['tag'], $allowed_tags, true) ? $args['tag'] : 'article';

/*
|--------------------------------------------------------------------------
| Classes
|--------------------------------------------------------------------------
*/

$classes = [
    'bads-card',
    'bads-card--' . sanitize_html_class($args['surface']),
    'bads-card--hover-' . sanitize_html_class($args['hover']),
    'bads-card--radius-' . sanitize_html_class($args['radius']),
];

if ($args['stacked']) {
    $classes[] = 'bads-card--stacked';
} else {
    $classes[] = 'bads-card--padding-' . sanitize_html_class($args['padding']);
}

if (!empty($args['class'])) {
    $classes[] = $args['class'];
}

$class = implode(' ', $classes);

/*
|--------------------------------------------------------------------------
| Slots
|--------------------------------------------------------------------------
*/

$title      = trim((string) $args['title']);
$kicker     = trim((string) $args['kicker']);
$text       = trim((string) $args['text']);
$link       = trim((string) $args['link']);
$has_media  = !empty($args['media_html']) || !empty($args['image']);
$has_footer = !empty($args['footer_html']) || !empty($args['action_text']);

$title_level = in_array($args['title_level'], ['h2', 'h3', 'h4', 'h5', 'h6'], true)
    ? $args['title_level']
    : 'h3';

$title_size = $args['title_size'] !== '' ? $args['title_size'] : $title_level;

?>

<<?= esc_attr($tag); ?> class="<?= esc_attr($class); ?>">

    <?php if ($has_media) : ?>

        <div class="bads-card__media">

            <?php if (!empty($args['media_html'])) : ?>

                <?= $args['media_html']; // phpcs:ignore WordPress.Security.EscapeOutput -- slot HTML передан разработчиком ?>

            <?php else : ?>

                <?php if ($link !== '') : ?><a href="<?= esc_url($link); ?>" tabindex="-1" aria-hidden="true"><?php endif; ?>

                <?php
                get_template_part(
                    'template-parts/ui/media',
                    null,
                    [
                        'image'   => $args['image'],
                        'size'    => $args['image_size'],
                        'alt'     => $title,
                        'fit'     => 'cover',
                        'ratio'   => $args['image_ratio'],
                        'rounded' => false,
                    ]
                );
                ?>

                <?php if ($link !== '') : ?></a><?php endif; ?>

            <?php endif; ?>

        </div>

    <?php endif; ?>

    <?php if ($title !== '' || $kicker !== '' || $text !== '' || !empty($args['inner_html'])) : ?>

        <div class="bads-card__body bads-stack bads-stack--sm">

            <?php if ($kicker !== '') : ?>

                <span class="bads-card__kicker"><?= esc_html($kicker); ?></span>

            <?php endif; ?>

            <?php if ($title !== '') : ?>

                <<?= esc_attr($title_level); ?> class="bads-card__title bads-card__title--size-<?= esc_attr(sanitize_html_class($title_size)); ?>">
                    <?php if ($link !== '') : ?>
                        <a class="bads-card__title-link" href="<?= esc_url($link); ?>"><?= esc_html($title); ?></a>
                    <?php else : ?>
                        <?= esc_html($title); ?>
                    <?php endif; ?>
                </<?= esc_attr($title_level); ?>>

            <?php endif; ?>

            <?php if ($text !== '') : ?>

                <p class="bads-card__text"><?= esc_html($text); ?></p>

            <?php endif; ?>

            <?= $args['inner_html']; // phpcs:ignore WordPress.Security.EscapeOutput -- slot HTML передан разработчиком ?>

        </div>

    <?php endif; ?>

    <?php if ($has_footer) : ?>

        <div class="bads-card__footer">

            <?php if (!empty($args['footer_html'])) : ?>

                <?= $args['footer_html']; // phpcs:ignore WordPress.Security.EscapeOutput -- slot HTML передан разработчиком ?>

            <?php elseif ($args['action_text'] !== '' && $link !== '') : ?>

                <?php
                get_template_part(
                    'template-parts/ui/button',
                    null,
                    [
                        'text'          => $args['action_text'],
                        'url'           => $link,
                        'type'          => 'link',
                        'variant'       => 'link',
                        'size'          => 'sm',
                        'icon'          => 'navigation/arrow-right',
                        'icon_position' => 'right',
                    ]
                );
                ?>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</<?= esc_attr($tag); ?>>
