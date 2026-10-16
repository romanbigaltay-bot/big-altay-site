<?php
/**
 * UI Component: Input
 * 
 * @param array $args [
 *   'name'         => string (optional),
 *   'id'           => string (optional),
 *   'type'         => 'text'|'tel'|'email'|'number'|'search'|'password'|'date' (default: 'text'),
 *   'value'        => string (optional),
 *   'placeholder'  => string (optional),
 *   'icon'         => 'user'|'phone'|'email'|'search'|'calendar' (optional),
 *   'size'         => 'sm'|'md'|'lg' (default: 'md'),
 *   'radius'       => 'pill'|'md'|'lg' (default: 'pill'),
 *   'state'        => 'default'|'error'|'success' (default: 'default'),
 *   'autocomplete' => string (optional),
 *   'required'     => bool (default: false),
 *   'readonly'     => bool (default: false),
 *   'disabled'     => bool (default: false),
 *   'class'        => string (optional),
 * ]
 */

$name         = $args['name'] ?? '';
$id           = $args['id'] ?? ($name ? 'input-' . sanitize_html_class($name) : wp_unique_id('bads-input-'));
$type         = $args['type'] ?? 'text';
$value        = $args['value'] ?? '';
$placeholder  = $args['placeholder'] ?? '';
$icon         = $args['icon'] ?? '';
$size         = $args['size'] ?? 'md';
$radius       = $args['radius'] ?? 'pill';
$state        = $args['state'] ?? 'default';
$autocomplete = $args['autocomplete'] ?? '';
$ariaLabel    = $args['aria_label'] ?? ($args['aria-label'] ?? '');
$title        = $args['title'] ?? '';
$required     = !empty($args['required']);
$readonly     = !empty($args['readonly']);
$disabled     = !empty($args['disabled']);
$customClass  = $args['class'] ?? '';

$inputClass   = $args['input_class'] ?? '';

$wrapperClasses = ['bads-input'];

if ($size) {
    $wrapperClasses[] = 'bads-input--' . sanitize_html_class($size);
}
if ($radius) {
    $wrapperClasses[] = 'bads-input--radius-' . sanitize_html_class($radius);
}
if ($customClass) {
    $wrapperClasses[] = trim($customClass);
}

$fieldClasses = ['bads-input__field'];

if ($icon) {
    $fieldClasses[] = 'bads-input__field--icon-' . sanitize_html_class($icon);
}
if (in_array($state, ['error', 'success'], true)) {
    $fieldClasses[] = 'bads-input__field--' . $state;
}

$controlClasses = ['bads-input__control'];
if ($inputClass) {
    $controlClasses[] = trim($inputClass);
}
?>

<div class="<?= esc_attr(implode(' ', array_filter($wrapperClasses))); ?>">
    <div class="<?= esc_attr(implode(' ', array_filter($fieldClasses))); ?>">
        <input 
            type="<?= esc_attr($type); ?>"
            class="<?= esc_attr(implode(' ', array_filter($controlClasses))); ?>"
            id="<?= esc_attr($id); ?>"
            <?php if ($name): ?>name="<?= esc_attr($name); ?>"<?php endif; ?>
            <?php if ($value): ?>value="<?= esc_attr($value); ?>"<?php endif; ?>
            <?php if ($placeholder): ?>placeholder="<?= esc_attr($placeholder); ?>"<?php endif; ?>
            <?php if ($autocomplete): ?>autocomplete="<?= esc_attr($autocomplete); ?>"<?php endif; ?>
            <?php if ($ariaLabel): ?>aria-label="<?= esc_attr($ariaLabel); ?>"<?php endif; ?>
            <?php if ($title): ?>title="<?= esc_attr($title); ?>"<?php endif; ?>
            <?php if ($required): ?>required<?php endif; ?>
            <?php if ($readonly): ?>readonly<?php endif; ?>
            <?php if ($disabled): ?>disabled<?php endif; ?>
        >
    </div>
</div>
