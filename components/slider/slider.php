<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Components / Slider
 * Path: template-parts/components/slider/slider.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [
    'slides'          => [],
    'id'              => '',
    'class'           => '',
    'arrows'          => true,
    'pagination'      => true,
    'counter'         => false,
    'loop'            => true,
    'autoplay'        => false,
    'autoplay_speed'  => 5000,
    'controls_align'  => 'center',
    'controls_target' => '', // Optional selector if controls should be rendered or linked elsewhere
    'aria_label'      => 'Слайдер контента',
]);

if (empty($args['slides']) || !is_array($args['slides'])) {
    return;
}

$total_slides = count($args['slides']);

// Unique slider ID
$slider_id = !empty($args['id']) 
    ? sanitize_html_class($args['id']) 
    : 'bads-slider-' . wp_unique_id();

// Classes
$slider_classes = ['bads-slider'];
if (!empty($args['class'])) {
    $slider_classes[] = esc_attr($args['class']);
}

// Controls modifier
$controls_classes = ['bads-slider__controls'];
if (!empty($args['controls_align']) && in_array($args['controls_align'], ['start', 'end', 'center', 'between'], true)) {
    $controls_classes[] = 'bads-slider__controls--' . sanitize_html_class($args['controls_align']);
}
?>

<div
    class="<?= esc_attr(implode(' ', $slider_classes)); ?>"
    id="<?= esc_attr($slider_id); ?>"
    role="region"
    aria-roledescription="carousel"
    aria-label="<?= esc_attr($args['aria_label']); ?>"
    data-bads-slider
    <?= !empty($args['controls_target']) ? 'data-controls-target="' . esc_attr($args['controls_target']) . '"' : ''; ?>
    data-loop="<?= $args['loop'] ? 'true' : 'false'; ?>"
    data-autoplay="<?= $args['autoplay'] ? 'true' : 'false'; ?>"
    data-autoplay-speed="<?= esc_attr((int) $args['autoplay_speed']); ?>"
>
    <!-- Viewport & Sliding Track -->
    <div class="bads-slider__viewport">
        <div class="bads-slider__track" role="list">
            <?php foreach ($args['slides'] as $index => $slide_content) : 
                $is_first = ($index === 0);
            ?>
                <div
                    class="bads-slider__slide<?= $is_first ? ' is-active' : ''; ?>"
                    role="group"
                    aria-roledescription="slide"
                    aria-label="<?= sprintf(esc_attr__('Слайд %1$d из %2$d', 'bigaltay'), $index + 1, $total_slides); ?>"
                    aria-hidden="<?= $is_first ? 'false' : 'true'; ?>"
                    data-slide-index="<?= (int) $index; ?>"
                >
                    <?= $slide_content; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Controls: Arrows, Pagination & Counter -->
    <?php if (empty($args['controls_target']) && $total_slides > 1 && ($args['arrows'] || $args['pagination'] || $args['counter'])) : ?>
        <div class="<?= esc_attr(implode(' ', $controls_classes)); ?>">

            <?php if ($args['arrows']) : ?>
                <button
                    type="button"
                    class="bads-slider__arrow bads-slider__arrow--prev"
                    aria-label="<?= esc_attr__('Предыдущий слайд', 'bigaltay'); ?>"
                    data-slider-prev
                >
                    <?php
                    get_template_part(
                        'template-parts/ui/icon',
                        null,
                        [
                            'name' => 'navigation/chevron-left',
                            'size' => 'md',
                        ]
                    );
                    ?>
                </button>
            <?php endif; ?>

            <?php if ($args['pagination']) : ?>
                <div
                    class="bads-slider__pagination"
                    role="tablist"
                    aria-label="<?= esc_attr__('Навигация по слайдам', 'bigaltay'); ?>"
                    data-slider-pagination
                >
                    <?php foreach ($args['slides'] as $index => $_) : 
                        $is_first = ($index === 0);
                        $is_down = ($index % 2 === 0);
                        $default_icon = $is_down ? 'triangle-down' : 'triangle-up';
                        $active_icon  = $is_down ? 'triangle-down-active' : 'triangle-up-active';
                    ?>
                        <button
                            type="button"
                            role="tab"
                            class="bads-slider__dot<?= $is_first ? ' is-active' : ''; ?>"
                            aria-selected="<?= $is_first ? 'true' : 'false'; ?>"
                            aria-label="<?= sprintf(esc_attr__('Перейти к слайду %d', 'bigaltay'), $index + 1); ?>"
                            data-slide-to="<?= (int) $index; ?>"
                        >
                            <span class="bads-slider__dot-icon bads-slider__dot-icon--default">
                                <?php
                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => $default_icon,
                                        'size' => 'custom',
                                    ]
                                );
                                ?>
                            </span>
                            <span class="bads-slider__dot-icon bads-slider__dot-icon--active">
                                <?php
                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => $active_icon,
                                        'size' => 'custom',
                                    ]
                                );
                                ?>
                            </span>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($args['counter']) : ?>
                <div class="bads-slider__counter" data-slider-counter aria-hidden="true">
                    <span class="bads-slider__counter-current">01</span>
                    <span class="bads-slider__counter-divider">/</span>
                    <span class="bads-slider__counter-total"><?= sprintf('%02d', $total_slides); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($args['arrows']) : ?>
                <button
                    type="button"
                    class="bads-slider__arrow bads-slider__arrow--next"
                    aria-label="<?= esc_attr__('Следующий слайд', 'bigaltay'); ?>"
                    data-slider-next
                >
                    <?php
                    get_template_part(
                        'template-parts/ui/icon',
                        null,
                        [
                            'name' => 'navigation/chevron-right',
                            'size' => 'md',
                        ]
                    );
                    ?>
                </button>
            <?php endif; ?>

        </div>
    <?php endif; ?>
</div>
