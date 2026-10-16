<?php
/**
 * UI Layout Component: Field
 * 
 * Вспомогательный враппер для форм. Выводит лейбл, хинт и обертку 
 * для самого инпута. Позволяет не дублировать код лейблов в формах.
 * 
 * @param array $args [
 *   'label'       => string (optional),
 *   'for'         => string (optional),
 *   'hint'        => string (optional),
 *   'error'       => string (optional),
 *   'required'    => bool (default: false),
 *   'class'       => string (optional),
 *   'input_args'  => array (optional, renders child bads-input),
 * ]
 */

$label       = $args['label'] ?? '';
$for         = $args['for'] ?? '';
$hint        = $args['hint'] ?? '';
$error       = $args['error'] ?? '';
$required    = !empty($args['required']);
$customClass = $args['class'] ?? '';
$inputArgs   = $args['input_args'] ?? null;

$classes = ['bads-field'];

if ($customClass) {
    $classes[] = sanitize_html_class($customClass);
}

// Если есть ошибка, можем добавить модификатор к полю для стилей
if ($error) {
    $classes[] = 'bads-field--has-error';
}

?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">
    
    <?php if ($label): ?>
        <label class="bads-field__label" <?php if ($for): ?>for="<?= esc_attr($for); ?>"<?php endif; ?>>
            <?= esc_html($label); ?>
            <?php if ($required): ?>
                <span class="bads-field__asterisk" aria-hidden="true">*</span>
            <?php endif; ?>
        </label>
    <?php endif; ?>

    <?php if ($inputArgs && is_array($inputArgs)): ?>
        <div class="bads-field__control">
            <?php get_template_part('template-parts/ui/input', null, $inputArgs); ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="bads-field__error" role="alert"><?= wp_kses_post($error); ?></p>
    <?php elseif ($hint): ?>
        <p class="bads-field__hint"><?= wp_kses_post($hint); ?></p>
    <?php endif; ?>

</div>