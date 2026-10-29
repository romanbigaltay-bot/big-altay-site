<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Possibilities
 * ============================================================================
 *
 * Блок «Что мы проводим»: сетка направлений корпоративных событий.
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Title
 * - BADS Grid (2x2)
 * - BADS UI Card (template-parts/ui/card.php)
 *
 * Данные: ACF repeater corp_possibilities (title + photo).
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!have_rows('corp_possibilities')) {
    return;
}
?>

<section class="bads-section bads-section--lg bads-corp-possibilities">

    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'           => '«Большой Алтай» предоставляет возможности для проведения:',
                'subtitle'        => 'В вашем распоряжении будут не только современные залы для конференций, но и площадки для активного и спокойного отдыха.',
                'level'           => 'h2',
                'size'            => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
            ]
        );
        ?>

        <div class="bads-grid bads-grid--2" style="margin-top: var(--space-xl);">

            <?php
            while (have_rows('corp_possibilities')) :
                the_row();

                $item_title = get_sub_field('corp_possibilities-title');
                $item_image = get_sub_field('corp_possibilities-photo');

                get_template_part(
                    'template-parts/ui/card',
                    null,
                    [
                        'image'  => $item_image,
                        'title'  => $item_title,
                        'radius' => 'lg',
                        'hover'  => 'zoom',
                        'class'  => 'bads-corp-possibilities__card',
                    ]
                );

            endwhile;
            ?>

        </div>

    </div>

</section>
