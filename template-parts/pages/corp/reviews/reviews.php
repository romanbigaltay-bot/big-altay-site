<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Reviews
 * ============================================================================
 *
 * Блок «Отзывы»: слайдер отзывов, данных которых берутся из ACF-группы
 * главной страницы (main_reviews, post id 139) — как и раньше.
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Title
 * - BADS Slider
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$reviews_source_id = 139;

if (!have_rows('main_reviews', $reviews_source_id)) {
    return;
}

$slides = [];

while (have_rows('main_reviews', $reviews_source_id)) :
    the_row();

    $review_image = get_sub_field('main_reviews-photo');
    $review_title = get_sub_field('main_reviews-title');
    $review_text  = get_sub_field('main_reviews-text');

    ob_start();
    ?>
    <article class="bads-corp-reviews__card">

        <?php if ($review_image) : ?>
            <div class="bads-corp-reviews__image">
                <?php
                get_template_part(
                    'template-parts/ui/media',
                    null,
                    [
                        'image'   => $review_image,
                        'size'    => 'medium',
                        'alt'     => $review_title,
                        'fit'     => 'cover',
                        'rounded' => 'lg',
                    ]
                );
                ?>
            </div>
        <?php endif; ?>

        <div class="bads-corp-reviews__body">

            <h3 class="bads-corp-reviews__title"><?= esc_html($review_title); ?></h3>

            <div class="bads-corp-reviews__text"><?= esc_html($review_text); ?></div>

        </div>

    </article>
    <?php
    $slides[] = ob_get_clean();

endwhile;
?>

<section class="bads-section bads-section--lg bads-corp-reviews">

    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'           => 'Отзывы',
                'level'           => 'h2',
                'size'            => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
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
                    'id'              => 'corp-reviews-slider',
                    'arrows'          => true,
                    'pagination'      => false,
                    'loop'            => true,
                    'autoplay'        => false,
                    'aria_label'      => 'Отзывы клиентов',
                ]
            );
            ?>
        </div>

    </div>

</section>


<style>
/* ==========================================================================
   Corp / Reviews
   ========================================================================== */

.bads-corp-reviews__card {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    padding: 28px;
    border: 1px solid rgba(1, 159, 222, .12);
    border-radius: 24px;
    background: var(--color-background);
    box-shadow: 0 8px 24px rgba(20, 40, 60, .04);
}

.bads-corp-reviews__image {
    flex: 0 0 96px;
    width: 96px;
}

.bads-corp-reviews__body {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.bads-corp-reviews__title {
    margin: 0;
    color: var(--color-text);
    font-family: var(--font-family-heading);
    font-size: var(--font-size-h5);
    font-weight: var(--font-weight-bold);
    line-height: 1.25;
}

.bads-corp-reviews__text {
    margin: 0;
    color: var(--color-text-muted);
    font-size: var(--font-size-body);
    line-height: var(--line-height-body);
}

@media (max-width: 767px) {
    .bads-corp-reviews__card {
        flex-direction: column;
        padding: 22px;
    }
}
</style>
