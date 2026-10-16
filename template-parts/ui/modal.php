<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Modal
 * ============================================================================
 */


$args = wp_parse_args($args ?? [], [
    'id' => '',
    'title' => '',
    'subtitle' => '',
    'icon' => '',
    'content' => '',
    'footer' => '',
    'size' => 'md',
    'closable' => true,
    'close_label' => 'Закрыть',
    'class' => '',
    'hidden' => true,
]);

$allowed_sizes = [
    'sm',
    'md',
    'lg',
    'xl',
];

$size = in_array(
    $args['size'],
    $allowed_sizes,
    true
)

? $args['size']

: 'md';



$id = !empty($args['id'])
    ? sanitize_html_class($args['id'])
    : wp_unique_id('bads-modal-');

$classes = [
    'bads-modal',
    'bads-modal--' . $size,
];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);
?>

<div
    class="<?= esc_attr($class); ?>"
    id="<?= esc_attr($id); ?>"
    data-modal
    aria-hidden="<?= $args['hidden'] ? 'true' : 'false'; ?>"
    <?= $args['hidden'] ? 'hidden' : ''; ?>
>
    <div

        class="bads-modal__overlay"
        data-modal-close

    ></div>

    <div
        class="bads-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="<?= esc_attr($id); ?>-title"
    >

        <?php if ($args['closable']) : ?>
		
            <button
                class="bads-modal__close"
                type="button"
                aria-label="<?= esc_attr($args['close_label']); ?>"
                data-modal-close
            >
                <?php
                get_template_part(
                    'template-parts/ui/icon',
                    null,
                    [
                        'name' => 'actions/close',
                        'size' => 'sm',
                    ]
                );

                ?>
				
            </button>

        <?php endif; ?>

        <?php if (!empty($args['title']) || !empty($args['subtitle']) || !empty($args['icon'])) : ?>
            <div class="bads-modal__header<?= !empty($args['icon']) ? ' bads-modal__header--with-icon' : ''; ?>">
                <?php if (!empty($args['icon']) || !empty($args['title'])) : ?>
                    <div class="bads-modal__header-main">
                        <?php if (!empty($args['icon'])) : ?>
                            <div class="bads-modal__icon" aria-hidden="true">
                                <?php
                                $icon_val = $args['icon'];
                                if (is_string($icon_val) && str_starts_with(trim($icon_val), '<svg')) {
                                    echo $icon_val;
                                } else {
                                    $icon_name = is_string($icon_val) ? basename($icon_val, '.svg') : 'channel';
                                    get_template_part(
                                        'template-parts/ui/icon',
                                        null,
                                        [
                                            'name'       => $icon_name,
                                            'size'       => 'lg',
                                            'decorative' => true,
                                        ]
                                    );
                                }
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($args['title'])) : ?>
                            <h2
                                class="bads-modal__title"
                                id="<?= esc_attr($id); ?>-title"
                            >
                                <?= wp_kses_post($args['title']); ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($args['subtitle'])) : ?>
                    <p class="bads-modal__subtitle">
                        <?= wp_kses_post($args['subtitle']); ?>
                    </p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['content'])) : ?>
		
            <div class="bads-modal__content">
                <?= is_string($args['content']) ? $args['content'] : ''; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($args['footer'])) : ?>
            <div class="bads-modal__footer">
                <?= wp_kses_post($args['footer']); ?>
            </div>
        <?php endif; ?>
    </div>
</div>