<?php
/**
 * UI Component: Textarea
 * 
 * @param array $args [
 *   'name'         => string (optional),
 *   'id'           => string (optional),
 *   'value'        => string (optional),
 *   'placeholder'  => string (optional),
 *   'rows'         => int (default: 5),
 *   'size'         => 'sm'|'md'|'lg' (optional),
 *   'radius'       => 'pill'|'md'|'lg' (optional),
 *   'state'        => 'default'|'error'|'success' (default: 'default'),
 *   'autocomplete' => string (optional),
 *   'aria_label'   => string (optional),
 *   'required'     => bool (default: false),
 *   'readonly'     => bool (default: false),
 *   'disabled'     => bool (default: false),
 *   'class'        => string (optional),
 * ]
 */

$name         = $args['name'] ?? '';
$id           = $args['id'] ?? ($name ? 'textarea-' . sanitize_html_class($name) : wp_unique_id('bads-textarea-'));
$value        = $args['value'] ?? '';
$placeholder  = $args['placeholder'] ?? '';
$rows         = isset($args['rows']) ? (int)$args['rows'] : 5;
$size         = $args['size'] ?? '';
$radius       = $args['radius'] ?? '';
$state        = $args['state'] ?? 'default';
$autocomplete = $args['autocomplete'] ?? '';
$ariaLabel    = $args['aria_label'] ?? ($args['aria-label'] ?? '');
$required     = !empty($args['required']);
$readonly     = !empty($args['readonly']);
$disabled     = !empty($args['disabled']);
$customClass  = $args['class'] ?? '';

$classes = ['bads-textarea'];

if ($size) {
    $classes[] = 'bads-textarea--' . sanitize_html_class($size);
}
if ($radius) {
    $classes[] = 'bads-textarea--radius-' . sanitize_html_class($radius);
}
if (in_array($state, ['error', 'success'], true)) {
    $classes[] = 'bads-textarea--' . $state;
}
if ($customClass) {
    $classes[] = sanitize_html_class($customClass);
}

?>

<textarea
    class="<?= esc_attr(implode(' ', $classes)); ?>"
    id="<?= esc_attr($id); ?>"
    <?php if ($name): ?>name="<?= esc_attr($name); ?>"<?php endif; ?>
    <?php if ($rows): ?>rows="<?= esc_attr($rows); ?>"<?php endif; ?>
    <?php if ($placeholder): ?>placeholder="<?= esc_attr($placeholder); ?>"<?php endif; ?>
    <?php if ($ariaLabel): ?>aria-label="<?= esc_attr($ariaLabel); ?>"<?php endif; ?>
    <?php if ($autocomplete): ?>autocomplete="<?= esc_attr($autocomplete); ?>"<?php endif; ?>
    <?php if ($required): ?>required<?php endif; ?>
    <?php if ($readonly): ?>readonly<?php endif; ?>
    <?php if ($disabled): ?>disabled<?php endif; ?>
><?= esc_textarea($value); ?></textarea>
