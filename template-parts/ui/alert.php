<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Alert
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [
    'variant'       => 'info',     // info | success | warning | error
    'title'         => '',
    'text'          => '',
    'icon'          => '',         // optional override, otherwise auto by variant
    'closable'      => false,
    'role'          => '',         // optional override
    'class'         => '',
    'dismiss_label' => 'Закрыть',
	'id'     		=> '',
	'hidden' 		=> false,
]);

$allowed_variants = ['info', 'success', 'warning', 'error'];

$variant = in_array($args['variant'], $allowed_variants, true)
    ? $args['variant']
    : 'info';

$variant_map = [
    'info'    => [
        'icon'      => 'status/info',
        'role'      => 'status',
        'aria_live'  => 'polite',
    ],
    'success' => [
        'icon'      => 'status/check',
        'role'      => 'status',
        'aria_live'  => 'polite',
    ],
    'warning' => [
        'icon'      => 'status/warning',
        'role'      => 'alert',
        'aria_live'  => 'polite',
    ],
    'error'   => [
        'icon'      => 'status/error',
        'role'      => 'alert',
        'aria_live'  => 'assertive',
    ],
];

$icon = !empty($args['icon'])
    ? $args['icon']
    : $variant_map[$variant]['icon'];

$role = !empty($args['role'])
    ? $args['role']
    : $variant_map[$variant]['role'];

$aria_live = $variant_map[$variant]['aria_live'];

$classes = [
    'bads-alert',
    'bads-alert--' . sanitize_html_class($variant),
];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

if (empty($icon)) {
    $classes[] = 'bads-alert--no-icon';
}

if ($args['closable']) {
    $classes[] = 'bads-alert--closable';
}

if ($args['hidden']) {
    $classes[] = 'is-hidden';
}

$class = implode(' ', $classes);
?>

<div
    class="<?= esc_attr($class); ?>"
    role="<?= esc_attr($role); ?>"
    aria-live="<?= esc_attr($aria_live); ?>"
    aria-atomic="true"
    data-alert
    data-alert-variant="<?= esc_attr($variant); ?>"
	id="<?= esc_attr($args['id']); ?>"
	<?php if ($args['hidden']) : ?>hidden<?php endif; ?>
	aria-hidden="<?= $args['hidden'] ? 'true' : 'false'; ?>"
>

    <?php if (!empty($icon)) : ?>
        <div class="bads-alert__icon" aria-hidden="true">
            <?php
            get_template_part(
                'template-parts/ui/icon',
                null,
                [
                    'name'  => $icon,
                    'size'  => 'md',
                    'class' => 'bads-alert__icon-inner',
                ]
            );
            ?>
        </div>
    <?php endif; ?>

    <div class="bads-alert__body">

        <?php if (!empty($args['title'])) : ?>
            <div class="bads-alert__title">
                <?= esc_html($args['title']); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['text'])) : ?>
            <div class="bads-alert__text">
                <?= wp_kses_post($args['text']); ?>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($args['closable']) : ?>
        <button
            class="bads-alert__close"
            type="button"
            aria-label="<?= esc_attr($args['dismiss_label']); ?>"
            data-alert-close
        >
            <?php
            get_template_part(
                'template-parts/ui/icon',
                null,
                [
                    'name'  => 'actions/close',
                    'size'  => 'sm',
                    'class' => 'bads-alert__close-icon',
                ]
            );
            ?>
        </button>
    <?php endif; ?>

</div>