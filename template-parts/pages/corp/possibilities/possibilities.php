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
 * - BADS Grid
 * - BADS Media
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
                ?>

                <article class="bads-corp-possibilities__card">

                    <?php
                    get_template_part(
                        'template-parts/ui/media',
                        null,
                        [
                            'image'   => $item_image,
                            'size'    => 'large',
                            'alt'     => $item_title,
                            'fit'     => 'cover',
                            'ratio'   => 'landscape',
                            'rounded' => true,
                        ]
                    );
                    ?>

                    <h3 class="bads-corp-possibilities__card-title">
                        <?= esc_html($item_title); ?>
                    </h3>

                </article>

            <?php endwhile; ?>

        </div>

    </div>

</section>


<style>
/* ==========================================================================
   Corp / Possibilities
   ========================================================================== */

.bads-corp-possibilities__card {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.bads-corp-possibilities__card-title {
    margin: 0;
    color: var(--color-text);
    font-family: var(--font-family-heading);
    font-size: var(--font-size-h4);
    font-weight: var(--font-weight-bold);
    line-height: 1.2;
}

@media (max-width: 767px) {
    .bads-corp-possibilities__card-title {
        font-size: var(--font-size-h5);
    }
}
</style>
