<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Badge
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [
    'text'    => '',
    'variant' => 'primary',
    'size'    => 'md',
    'icon'    => '',
    'class'   => '',
]);

$classes = [
    'bads-badge',
    'bads-badge--' . sanitize_html_class($args['variant']),
    'bads-badge--' . sanitize_html_class($args['size']),
];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

$text = esc_html($args['text']);
$icon = $args['icon'];

?>

<span class="<?= esc_attr($class); ?>">

    <?php if ($icon) : ?>

        <span class="bads-badge__icon">

            <?= wp_kses_post($icon); ?>

        </span>

    <?php endif; ?>

    <span class="bads-badge__text">

        <?= $text; ?>

    </span>

</span>