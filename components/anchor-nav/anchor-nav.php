<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Components / Anchor Navigation
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [
    'items'   => [],
    'class'   => '',
    'variant' => 'default',
]);

if (empty($args['items']) || !is_array($args['items'])) {
    return;
}

$nav_classes = ['bads-anchor-nav'];

if (!empty($args['variant']) && $args['variant'] !== 'default') {
    $nav_classes[] = 'bads-anchor-nav--' . sanitize_html_class($args['variant']);
}

if (!empty($args['class'])) {
    $nav_classes[] = esc_attr($args['class']);
}
?>

<nav class="<?= esc_attr(implode(' ', $nav_classes)); ?>" aria-label="<?= esc_attr__('Навигация по разделам страницы', 'bigaltay'); ?>">
    <?php foreach ($args['items'] as $item) : 
        $label = $item['label'] ?? '';
        $href  = $item['href'] ?? ($item['url'] ?? '#');
        $is_active = !empty($item['active']);

        if (!$label) {
            continue;
        }
    ?>
        <a 
            href="<?= esc_url($href); ?>" 
            class="bads-anchor-nav__link<?= $is_active ? ' is-active' : ''; ?>"
        >
            <?= esc_html($label); ?>
        </a>
    <?php endforeach; ?>
</nav>