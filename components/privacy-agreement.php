<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component: Privacy Agreement (Согласие на обработку персональных данных)
 * ============================================================================
 *
 * Переиспользуемый компонент согласия на обработку и хранение персональных данных (152-ФЗ).
 * Включает в себя стилизованный чекбокс BADS и согласованный текст согласия.
 *
 * @param array $args [
 *   'name'     => string (default: 'privacy_agreement'),
 *   'id'       => string (optional, auto-generated if empty),
 *   'variant'  => 'single' | 'multiline' (default: 'single'),
 *                 - 'single': однострочный вариант без переноса
 *                 - 'multiline': двухстрочный вариант ("Даю согласие на обработку и хранение <br> персональных данных")
 *   'centered' => bool (default: true), центрировать ли компонент в контейнере
 *   'checked'  => bool (default: false),
 *   'required' => bool (default: true),
 *   'disabled' => bool (default: false),
 *   'class'    => string (optional additional classes),
 * ]
 */

if (!defined('ABSPATH')) {
    exit;
}

$name     = $args['name'] ?? 'privacy_agreement';
$id       = $args['id'] ?? ($name ? sanitize_html_class($name) : wp_unique_id('bads-privacy-'));
$variant  = ($args['variant'] ?? 'single') === 'multiline' ? 'multiline' : 'single';
$centered = $args['centered'] ?? true;
$checked  = !empty($args['checked']);
$required = array_key_exists('required', $args) ? !empty($args['required']) : true;
$disabled = !empty($args['disabled']);
$custom   = $args['class'] ?? '';

// Текст согласия в зависимости от варианта
if ($variant === 'multiline') {
    $privacy_text = 'Даю согласие на обработку и хранение<br>персональных данных';
} else {
    $privacy_text = 'Даю согласие на обработку и хранение персональных данных';
}

// Формирование классов для обертки чекбокса
$classes = [
    'bads-checkbox',
    'bads-checkbox--privacy',
];

// Для двухстрочного варианта чекбокс выравнивается по центру относительно строк
if ($variant === 'multiline') {
    $classes[] = 'bads-checkbox--align-center';
}

// Центрирование компонента в контейнере (по умолчанию включено)
if ($centered) {
    $classes[] = 'bads-checkbox--center';
}

if ($custom) {
    $classes[] = sanitize_html_class($custom);
}
?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">
    <label class="bads-checkbox__label" for="<?= esc_attr($id); ?>">
        <input 
            type="checkbox" 
            class="bads-checkbox__control"
            id="<?= esc_attr($id); ?>"
            name="<?= esc_attr($name); ?>"
            value="1"
            <?php if ($checked): ?>checked<?php endif; ?>
            <?php if ($required): ?>required<?php endif; ?>
            <?php if ($disabled): ?>disabled<?php endif; ?>
        >
        <span class="bads-checkbox__box"></span>
        <span class="bads-checkbox__text"><?= wp_kses_post($privacy_text); ?></span>
    </label>
</div>