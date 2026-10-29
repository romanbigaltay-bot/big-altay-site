<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Accommodation
 * ============================================================================
 *
 * Блок «Проживание»: описание + галерея-слайдер.
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Title
 * - BADS Slider (components/slider)
 * - BADS Media
 *
 * Данные: ACF — corp_description (текст), corp_description-gallery (repeater).
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$description = get_field('corp_description');

$slides = [];

if (have_rows('corp_description-gallery')) {

    while (have_rows('corp_description-gallery')) :
        the_row();

        $slide_image = get_sub_field('corp_description-gallery-photo');

        if (empty($slide_image)) {
            continue;
        }

        ob_start();
        ?>
        <div class="bads-corp-accommodation__slide">
            <?php
            get_template_part(
                'template-parts/ui/media',
                null,
                [
                    'image'   => $slide_image,
                    'size'    => 'large',
                    'alt'     => 'Проживание — корпоративный отдых в Белокурихе',
                    'fit'     => 'cover',
                    'ratio'   => 'landscape',
                    'rounded' => true,
                ]
            );
            ?>
        </div>
        <?php
        $slides[] = ob_get_clean();

    endwhile;
}

if (empty($slides)) {
    return;
}
?>

<section class="bads-section bads-section--lg bads-corp-accommodation">

    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'           => 'Проживание',
                'subtitle'        => $description,
                'level'           => 'h2',
                'size'            => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
                'class'           => 'bads-corp-accommodation__title',
            ]
        );
        ?>

        <div style="margin-top: var(--space-xl);">
            <?php
            get_template_part(
                'template-parts/components/slider/slider',
                null,
                [
                    'slides'          => $slides,
                    'id'              => 'corp-accommodation-slider',
                    'arrows'          => true,
                    'pagination'      => false,
                    'loop'            => true,
                    'autoplay'        => true,
                    'autoplay_speed'  => 5000,
                    'aria_label'      => 'Галерея вариантов проживания',
                ]
            );
            ?>
        </div>

    </div>

</section>
