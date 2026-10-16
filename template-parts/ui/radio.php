<?php
/**
 * UI Component: Radio
 * 
 * @param array $args [
 *   'name'     => string (required),
 *   'id'       => string (optional),
 *   'value'    => string (required),
 *   'label'    => string (required),
 *   'checked'  => bool (default: false),
 *   'required' => bool (default: false),
 *   'disabled' => bool (default: false),
 *   'class'    => string (optional),
 * ]
 */

$name        = $args['name'] ?? '';
$value       = $args['value'] ?? '';
$id          = $args['id'] ?? (($name && $value) ? sanitize_html_class($name . '-' . $value) : wp_unique_id('bads-radio-'));
$label       = $args['label'] ?? '';
$checked     = !empty($args['checked']);
$required    = !empty($args['required']);
$disabled    = !empty($args['disabled']);
$customClass = $args['class'] ?? '';

$classes = ['bads-radio'];

if ($customClass) {
    $classes[] = sanitize_html_class($customClass);
}

?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">
    <label class="bads-radio__label" for="<?= esc_attr($id); ?>">
        <input 
            type="radio" 
            class="bads-radio__control"
            id="<?= esc_attr($id); ?>"
            <?php if ($name): ?>name="<?= esc_attr($name); ?>"<?php endif; ?>
            value="<?= esc_attr($value); ?>"
            <?php if ($checked): ?>checked<?php endif; ?>
            <?php if ($required): ?>required<?php endif; ?>
            <?php if ($disabled): ?>disabled<?php endif; ?>
        >
        <span class="bads-radio__circle"></span>
        <?php if ($label): ?>
            <span class="bads-radio__text"><?= wp_kses_post($label); ?></span>
        <?php endif; ?>
    </label>
</div>