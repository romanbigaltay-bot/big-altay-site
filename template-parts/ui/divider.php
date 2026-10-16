<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Divider
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [
    'variant' => 'primary',
    'width'   => '90px',
    'offset'  => '',
    'text'    => '',
    'class'   => '',
]);

$classes = [
    'bads-divider',
    'bads-divider--' . sanitize_html_class($args['variant']),
];

if (!empty($args['text'])) {
    $classes[] = 'bads-divider--with-text';
}

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

$styles = [
    sprintf('--bads-divider-width:%s;', esc_attr($args['width'])),
];

if (isset($args['offset']) && $args['offset'] !== '') {
    $styles[] = sprintf('--bads-divider-offset:%s;', esc_attr($args['offset']));
    $styles[] = sprintf('margin-left:%s;', esc_attr($args['offset']));
}

$style = implode('', $styles);

?>

<?php if (!empty($args['text'])) : ?>
    <div
        class="<?= esc_attr($class); ?>"
        style="<?= $style; ?>"
        role="separator"
    >
        <span class="bads-divider__text"><?= esc_html($args['text']); ?></span>
    </div>
<?php else : ?>
    <div
        class="<?= esc_attr($class); ?>"
        style="<?= $style; ?>"
        aria-hidden="true"
    ></div>
<?php endif; ?>