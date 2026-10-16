<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Title
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    'prefix'           => '',
    'seo_prefix'       => '',
    'title'            => '',
    'subtitle'         => '',
    'subtitle_variant' => 'default',
    'level'            => 'h2',

    /*
    |--------------------------------------------------------------------------
    | Appearance
    |--------------------------------------------------------------------------
    */

    'size'             => '',

    'divider'          => false,
    'divider_variant'  => 'primary',
    'divider_width'    => '90px',
    'divider_offset'   => '',

    'align'            => 'left',
    'variant'          => 'default',

    /*
    |--------------------------------------------------------------------------
    | HTML
    |--------------------------------------------------------------------------
    */

    'class' => '',

]);

/*
|--------------------------------------------------------------------------
| Heading Level
|--------------------------------------------------------------------------
*/

$allowed_levels = [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
];

$level = in_array($args['level'], $allowed_levels, true)
    ? $args['level']
    : 'h2';

/*
|--------------------------------------------------------------------------
| Visual Size
|--------------------------------------------------------------------------
|
| Если size не указан — используется HTML-уровень.
|
*/

$allowed_sizes = [
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
];

$size = $args['size'];

if ($size === '') {
    $size = $level;
}

if (!in_array($size, $allowed_sizes, true)) {
    $size = $level;
}

/*
|--------------------------------------------------------------------------
| Classes
|--------------------------------------------------------------------------
*/

$classes = [

    'bads-title',

    'bads-title--' . sanitize_html_class($args['variant']),

    'bads-title--align-' . sanitize_html_class($args['align']),

    'bads-title--size-' . sanitize_html_class($size),

];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

/*
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
*/

$prefix = trim((string) $args['prefix']);
$seo_prefix = trim((string) $args['seo_prefix']);
$title = trim((string) $args['title']);
$subtitle = trim((string) $args['subtitle']);

?>

<div class="<?= esc_attr($class); ?>">

    <?php if ($title !== '') : ?>

        <<?= $level; ?> class="bads-title__heading">

            <?php if ($prefix !== '') : ?>

                <span class="bads-title__prefix">

                    <?= esc_html($prefix); ?>

                </span>

            <?php endif; ?>

            <?php if ($seo_prefix !== '') : ?>

                <span class="u-visually-hidden">

                    <?= esc_html($seo_prefix); ?>&nbsp;

                </span>

            <?php endif; ?>

            <span class="bads-title__text">

                <?= wp_kses($title, [
                    'br'     => [],
                    'span'   => ['class' => [], 'style' => []],
                    'strong' => [],
                    'em'     => [],
                    'b'      => [],
                    'i'      => [],
                ]); ?>

            </span>

        </<?= $level; ?>>

    <?php endif; ?>

    <?php if ($args['divider'] && $title !== '') : ?>

        <?php
        get_template_part(
            'template-parts/ui/divider',
            null,
            [
                'variant' => $args['divider_variant'],
                'width'   => $args['divider_width'],
                'offset'  => $args['divider_offset'] ?? '',
            ]
        );
        ?>

    <?php endif; ?>

    <?php if ($subtitle !== '') : ?>

        <?php
        get_template_part(
            'template-parts/ui/subtitle',
            null,
            [
                'text'    => $subtitle,
                'align'   => $args['align'],
                'variant' => $args['subtitle_variant'] ?? 'default',
            ]
        );
        ?>

    <?php endif; ?>

</div>