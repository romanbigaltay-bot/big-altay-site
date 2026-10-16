<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Accordion
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [

    /**
     * -------------------------------------------------------------------------
     * Slots
     * -------------------------------------------------------------------------
     */

    'trigger'     => '',
    'title'       => '',
    'question'    => '',
    'value'       => '',
    'content'     => '',

    /**
     * -------------------------------------------------------------------------
     * State
     * -------------------------------------------------------------------------
     */

    'open'        => false,
    'disabled'    => false,

    /**
     * -------------------------------------------------------------------------
     * Appearance & Identity
     * -------------------------------------------------------------------------
     */

    'id'           => '',
    'icon'         => 'navigation/chevron-down',
    'prefix_icon'  => '',
    'variant'      => 'default',
    'radius'       => '',
    'size'         => '',
    'class'        => '',
    'aria_label'   => '',
    'options'      => [],
    'name'         => '',
    'input_id'     => '',
    'target_input' => '',

]);

$id = !empty($args['id']) ? sanitize_html_class($args['id']) : wp_unique_id('bads-accordion-');

$content_id = $id . '-content';

$options = (array)($args['options'] ?? []);
$name    = $args['name'] ?? '';
$input_id = $args['input_id'] ?? ($name ? 'input-' . sanitize_html_class($name) : '');

$trigger_text = $args['trigger'] !== '' 
    ? $args['trigger'] 
    : ($args['title'] !== '' 
        ? $args['title'] 
        : ($args['question'] !== '' ? $args['question'] : ''));

if (empty($trigger_text) && !empty($options)) {
    $first_opt = reset($options);
    $trigger_text = is_array($first_opt) ? ($first_opt['label'] ?? ($first_opt['value'] ?? '')) : (string)$first_opt;
}

$classes = [

    'bads-accordion',
    'bads-accordion--' . sanitize_html_class($args['variant']),

];

if (!empty($args['radius'])) {
    $classes[] = 'bads-accordion--radius-' . sanitize_html_class($args['radius']);
}

if (!empty($args['size'])) {
    $classes[] = 'bads-accordion--' . sanitize_html_class($args['size']);
}

if ($args['open']) {
    $classes[] = 'bads-accordion--open';
}

if ($args['disabled']) {
    $classes[] = 'bads-accordion--disabled';
}

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

$data_attrs = '';
if (!empty($args['target_input'])) {
    $data_attrs .= ' data-target-input="' . esc_attr($args['target_input']) . '"';
}
?>

<div class="<?= esc_attr($class); ?>" id="<?= esc_attr($id); ?>"<?= $data_attrs; ?>>

    <?php if (!empty($name)) : ?>
        <input 
            type="hidden" 
            name="<?= esc_attr($name); ?>" 
            <?php if ($input_id): ?>id="<?= esc_attr($input_id); ?>"<?php endif; ?>
            value="<?= esc_attr(!empty($args['value']) ? $args['value'] : $trigger_text); ?>"
        >
    <?php endif; ?>

    <button
        class="bads-accordion__trigger"
        type="button"

        aria-expanded="<?= $args['open'] ? 'true' : 'false'; ?>"
        aria-controls="<?= esc_attr($content_id); ?>"
        <?php if (!empty($args['aria_label'])) : ?>aria-label="<?= esc_attr($args['aria_label']); ?>"<?php endif; ?>

        <?php disabled($args['disabled']); ?>

    >

        <?php if (!empty($args['prefix_icon'])) : ?>
            <span class="bads-accordion__prefix-icon" aria-hidden="true">
                <?php
                get_template_part(
                    'template-parts/ui/icon',
                    null,
                    [
                        'name' => $args['prefix_icon'],
                        'size' => $args['size'] === 'sm' ? 'xs' : 'sm',
                    ]
                );
                ?>
            </span>
        <?php endif; ?>

        <div class="bads-accordion__trigger-content">

			<?php if (!empty($args['value'])) : ?>

				<span class="bads-accordion__trigger-label">
					<?= wp_kses_post($trigger_text); ?>
				</span>

				<span class="bads-accordion__trigger-value">
					<?= wp_kses_post($args['value']); ?>
				</span>

			<?php else : ?>

				<span class="bads-accordion__trigger-title">
					<?= wp_kses_post($trigger_text); ?>
				</span>

			<?php endif; ?>

		</div>

        <span class="bads-accordion__icon">

            <?php

            get_template_part(
                'template-parts/ui/icon',
                null,
                [
                    'name' => $args['icon'],
                    'size' => 'sm',
                ]
            );

            ?>

        </span>

    </button>

    <div
        id="<?= esc_attr($content_id); ?>"
        class="bads-accordion__content"
        role="region"
        aria-hidden="<?= $args['open'] ? 'false' : 'true'; ?>"
    >

        <div class="bads-accordion__body">

            <?php if (!empty($options)) : ?>
                <div class="bads-select-list">
                    <?php 
                    $current_val = !empty($args['value']) ? $args['value'] : $trigger_text;
                    foreach ($options as $opt_key => $opt) : 
                        if (is_array($opt)) {
                            $opt_val = $opt['value'] ?? (string)$opt_key;
                            $opt_lbl = $opt['label'] ?? $opt_val;
                            $opt_active = !empty($opt['active']) || $opt_val === $current_val || $opt_lbl === $current_val;
                        } else {
                            $opt_val = (string)$opt;
                            $opt_lbl = (string)$opt;
                            $opt_active = $opt_val === $current_val;
                        }
                    ?>
                        <div
                            class="bads-select-option <?= $opt_active ? 'bads-select-option--active' : ''; ?>"
                            data-value="<?= esc_attr($opt_val); ?>"
                            data-label="<?= esc_attr($opt_lbl); ?>"
                            role="option"
                            aria-selected="<?= $opt_active ? 'true' : 'false'; ?>"
                        >
                            <?= esc_html($opt_lbl); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?= $args['content']; ?>

        </div>

    </div>

</div>
