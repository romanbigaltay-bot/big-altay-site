<?php
/**
 * UI Component: Checkbox
 * 
 * @param array $args [
 *   'name'     => string (optional),
 *   'id'       => string (optional),
 *   'value'    => string (default: '1'),
 *   'label'    => string (required),
 *   'checked'  => bool (default: false),
 *   'required' => bool (default: false),
 *   'disabled' => bool (default: false),
 *   'class'    => string (optional),
 * ]
 */

$name        = $args['name'] ?? '';
$id          = $args['id'] ?? ($name ? sanitize_html_class($name) : wp_unique_id('bads-checkbox-'));
$value       = $args['value'] ?? '1';
$label       = $args['label'] ?? '';
$checked     = !empty($args['checked']);
$required    = !empty($args['required']);
$disabled    = !empty($args['disabled']);
$customClass = $args['class'] ?? '';

$classes = ['bads-checkbox'];

if ($customClass) {
    $classes[] = sanitize_html_class($customClass);
}

?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">
    <label class="bads-checkbox__label" for="<?= esc_attr($id); ?>">
        <input 
            type="checkbox" 
            class="bads-checkbox__control"
            id="<?= esc_attr($id); ?>"
            <?php if ($name): ?>name="<?= esc_attr($name); ?>"<?php endif; ?>
            value="<?= esc_attr($value); ?>"
            <?php if ($checked): ?>checked<?php endif; ?>
            <?php if ($required): ?>required<?php endif; ?>
            <?php if ($disabled): ?>disabled<?php endif; ?>
        >
        <span class="bads-checkbox__box"></span>
        <?php if ($label): ?>
            <span class="bads-checkbox__text"><?= wp_kses_post($label); ?></span>
        <?php endif; ?>
    </label>
</div>