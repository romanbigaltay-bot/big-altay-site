<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Range Slider Component
 * ============================================================================
 * 
 * @param array $args [
 *   'name'        => string (optional),
 *   'id'          => string (optional),
 *   'min'         => int|float (default: 0),
 *   'max'         => int|float (default: 100),
 *   'step'        => int|float (default: 1),
 *   'value'       => int|float (default: 50),
 *   'label_min'   => string (optional),
 *   'label_max'   => string (optional),
 *   'unit'        => string (default: ''),
 *   'prefix'      => string (default: ''),
 *   'show_values' => bool (default: true),
 *   'class'       => string (optional),
 * ]
 */

if (!defined('ABSPATH')) {
    exit;
}

$name        = $args['name'] ?? '';
$id          = $args['id'] ?? ($name ? sanitize_html_class($name) : wp_unique_id('bads-range-'));
$min         = isset($args['min']) ? (float)$args['min'] : 0;
$max         = isset($args['max']) ? (float)$args['max'] : 100;
$step        = isset($args['step']) ? (float)$args['step'] : 1;
$value       = isset($args['value']) ? (float)$args['value'] : $min;
$label_min   = $args['label_min'] ?? number_format($min, 0, '', ' ') . ($args['unit'] ?? '');
$label_max   = $args['label_max'] ?? number_format($max, 0, '', ' ') . ($args['unit'] ?? '');
$unit        = $args['unit'] ?? '';
$prefix      = $args['prefix'] ?? '';
$show_values = $args['show_values'] ?? true;
$customClass = $args['class'] ?? '';

$classes = ['bads-range'];
if ($customClass) {
    $classes[] = sanitize_html_class($customClass);
}

$formatted_value = number_format($value, 0, '', ' ');
?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">
    <?php if ($show_values): ?>
        <div class="bads-range__header">
            <span><?= esc_html($label_min); ?></span>
            <span class="bads-range__value">
                <?= esc_html($prefix); ?><span id="<?= esc_attr($id); ?>-display"><?= esc_html($formatted_value); ?></span> <?= esc_html($unit); ?>
            </span>
        </div>
    <?php endif; ?>

    <input 
        type="range"
        class="bads-range__control"
        id="<?= esc_attr($id); ?>"
        <?php if ($name): ?>name="<?= esc_attr($name); ?>"<?php endif; ?>
        min="<?= esc_attr($min); ?>"
        max="<?= esc_attr($max); ?>"
        step="<?= esc_attr($step); ?>"
        value="<?= esc_attr($value); ?>"
        data-unit="<?= esc_attr($unit); ?>"
        data-prefix="<?= esc_attr($prefix); ?>"
    >

    <?php if ($show_values): ?>
        <div class="bads-range__footer">
            <span><?= esc_html($label_min); ?></span>
            <span><?= esc_html($label_max); ?></span>
        </div>
    <?php endif; ?>
</div>