<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Front Page Promotions Block
 * Path: template-parts/front-page/promotions/promotions.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Query published promotions CPT
$promotions_query = new WP_Query([
    'post_type'      => 'promotion',
    'post_status'    => 'publish',
    'posts_per_page' => 10,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$slides = [];

if ($promotions_query->have_posts()) {

    while ($promotions_query->have_posts()) {
        $promotions_query->the_post();

        $post_id           = get_the_ID();
        $title             = get_the_title();
        $permalink         = get_permalink();
        $max_discount      = get_field('promotion_max_discount', $post_id);
        $period            = get_field('promotion_period', $post_id);
        $applies_to        = get_field('promotion_applies_to', $post_id);
        $short_description = get_field('promotion_short_description', $post_id);

        // Fallback description from excerpt if ACF short description is empty
        if (empty($short_description)) {
            $short_description = get_the_excerpt();
        }

        $benefits_list = [];
        if ($applies_to) {
            $lines = preg_split('/\r\n|\r|\n/', trim($applies_to));
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $benefits_list[] = $line;
                }
            }
        }

        ob_start();
        ?>
        <article class="bads-promo-card bads-promotions-row" data-card-link="<?= esc_url($permalink); ?>">

            <!-- Media Image (65% width) -->
            <div class="bads-promo-card__image">
                <a href="<?= esc_url($permalink); ?>" class="bads-promo-card__image-link" aria-label="<?= esc_attr($title); ?>" draggable="false">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(
                            'large',
                            [
                                'class'     => 'bads-promo-card__img',
                                'loading'   => 'lazy',
                                'alt'       => esc_attr($title),
                                'draggable' => 'false',
                            ]
                        ); ?>
                    <?php else : ?>
                        <img
                            src="<?= esc_url(get_template_directory_uri() . '/assets/images/placeholders/image.svg'); ?>"
                            alt="<?= esc_attr($title); ?>"
                            class="bads-promo-card__img"
                            loading="lazy"
                            draggable="false"
                        >
                    <?php endif; ?>
                </a>
            </div>

            <!-- Glass Card Content (44% width, overlapping from right) -->
            <div class="bads-card bads-card--glass bads-card--padding-xl bads-promo-card__card">

                <div class="bads-stack bads-stack--sm bads-stack--fill">
                <a href="<?= esc_url($permalink); ?>" class="bads-promo-card__card-link">
                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title' => $title,
                            'level' => 'h3',
                            'size'  => 'h4',
                            'class' => 'bads-promo-card__title',
                        ]
                    );
                    ?>
                </a>

                <?php if ($max_discount) : ?>
                    <div class="bads-promo-card__discount">
                        <?= sprintf(esc_html__('Скидка %s', 'bigaltay'), esc_html($max_discount)); ?>
                    </div>
                <?php endif; ?>

                <?php if ($period) : ?>
                    <div class="bads-promo-card__period">
                        <?= esc_html($period); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($benefits_list)) : ?>
                    <div>
                        <?php
                        get_template_part(
                            'template-parts/ui/list',
                            null,
                            [
                                'items'   => $benefits_list,
                                'variant' => 'check',
                            ]
                        );
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ($short_description) : ?>
                    <p class="bads-text-body bads-promo-card__description">
                        <?= esc_html($short_description); ?>
                    </p>
                <?php endif; ?>

                <div class="bads-split bads-split--gap-md">
                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Применить скидку',
                            'url'     => '#lead-form',
                            'variant' => 'primary',
                            'size'    => 'md',
                        ]
                    );

                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'          => 'Подробнее',
                            'url'           => $permalink,
                            'variant'       => 'link',
                            'size'          => 'md',
                            'icon'          => 'navigation/arrow-right',
                            'icon_position' => 'right',
                        ]
                    );
                    ?>
                </div>
                </div>
            </div>
        </article>
        <?php
        $slides[] = ob_get_clean();
    }

    wp_reset_postdata();

} elseif (have_rows('main_akczii')) {

    // 2. Fallback for legacy ACF repeater if CPT is not yet populated
    while (have_rows('main_akczii')) {
        the_row();

        $image_id          = get_sub_field('main_akczii-photo');
        $title             = get_sub_field('main_akczii-title');
        $short_description = get_sub_field('main_akczii-description');
        $image_url         = bads_attachment_image_url($image_id, 'large', 'image');

        ob_start();
        ?>
        <article class="bads-promo-card bads-promotions-row" data-card-link="#lead-form">

            <div class="bads-promo-card__image">
                <a href="#lead-form" class="bads-promo-card__image-link" aria-label="<?= esc_attr($title); ?>" draggable="false">
                    <img
                        src="<?= esc_url($image_url); ?>"
                        class="bads-promo-card__img"
                        alt="<?= esc_attr($title); ?>"
                        loading="lazy"
                        draggable="false"
                    >
                </a>
            </div>

            <div class="bads-card bads-card--glass bads-card--padding-xl bads-promo-card__card">
                <div class="bads-stack bads-stack--sm bads-stack--fill">
                <a href="#lead-form" class="bads-promo-card__card-link">
                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title' => $title,
                            'level' => 'h3',
                            'size'  => 'h4',
                            'class' => 'bads-promo-card__title',
                        ]
                    );
                    ?>
                </a>

                <?php if ($short_description) : ?>
                    <p class="bads-text-body bads-promo-card__description">
                        <?= esc_html($short_description); ?>
                    </p>
                <?php endif; ?>

                <div class="bads-split bads-split--gap-md">
                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Применить скидку',
                            'url'     => '#lead-form',
                            'variant' => 'primary',
                            'size'    => 'md',
                        ]
                    );

                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'          => 'Подробнее',
                            'url'           => '#lead-form',
                            'variant'       => 'link',
                            'size'          => 'md',
                            'icon'          => 'navigation/arrow-right',
                            'icon_position' => 'right',
                        ]
                    );
                    ?>
                </div>
                </div>
            </div>
        </article>
        <?php
        $slides[] = ob_get_clean();
    }

}

// If no promotions found, do not render block
if (empty($slides)) {
    return;
}
?>

<section class="bads-section bads-section--lg" id="front-promotions">
    <div class="bads-container">

        <!-- Header: Title with Divider on Left + Slider Controls (Arrows & Pagination) on Right -->
        <div style="display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: var(--space-md); margin-bottom: var(--space-2xl);">
            <div>
                <?php
                get_template_part(
                    'template-parts/ui/title',
                    null,
                    [
                        'level'           => 'h2',
                        'size'            => 'h2',
                        'title'           => 'Акции и бонусы нашим клиентам',
                        'divider'         => true,
                        'divider_variant' => 'primary',
                        'divider_width'   => '90px',
                    ]
                );
                ?>
            </div>

            <!-- External Slider Controls Container aligned to right edge -->
            <div id="front-promotions-slider-controls" class="bads-slider__controls bads-slider__controls--end" style="margin-top: 0; margin-bottom: var(--space-xs);">
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

                <div
                    class="bads-slider__pagination"
                    role="tablist"
                    aria-label="<?= esc_attr__('Навигация по слайдам', 'bigaltay'); ?>"
                    data-slider-pagination
                >
                    <?php foreach ($slides as $index => $_) : 
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

                <div class="bads-slider__counter" data-slider-counter aria-hidden="true">
                    <span class="bads-slider__counter-current">01</span>
                    <span class="bads-slider__counter-divider">/</span>
                    <span class="bads-slider__counter-total"><?= sprintf('%02d', count($slides)); ?></span>
                </div>

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
            </div>
        </div>

        <!-- Single Item Slider linked to external controls header -->
        <?php
        get_template_part(
            'template-parts/components/slider/slider',
            null,
            [
                'slides'          => $slides,
                'id'              => 'front-promotions-slider',
                'controls_target' => '#front-promotions-slider-controls',
                'arrows'          => false,
                'pagination'      => false,
                'counter'         => false,
                'loop'            => true,
                'autoplay'        => true,
                'autoplay_speed'  => 5000,
                'aria_label'      => 'Акции и специальные предложения туроператора',
            ]
        );
        ?>

        <!-- Bottom Action: "Смотреть все акции ->" Button -->
        <div style="display: flex; justify-content: center; margin-top: var(--space-2xl);">
            <?php
            get_template_part(
                'template-parts/ui/button',
                null,
                [
                    'text'      => 'Смотреть все акции',
                    'url'       => '/promotions/',
                    'variant'   => 'outline',
                    'size'      => 'md',
                    'icon'      => 'navigation/arrow-right',
                    'icon_pos'  => 'right',
                ]
            );
            ?>
        </div>

    </div>
</section>
