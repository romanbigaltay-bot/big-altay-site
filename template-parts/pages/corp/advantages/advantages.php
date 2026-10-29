<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Advantages
 * ============================================================================
 *
 * Блок «Почему выбирают нас»: чередующиеся секции изображение + текст.
 * Используется для repeater-блоков corp_advantages и corp_features.
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Split
 * - BADS Title
 * - BADS Media
 *
 * Аргументы ($args):
 * - 'repeater' => (string) имя ACF repeater с полями {name}-title,
 *                 {name}-description, {name}-photo.
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$repeater = $args['repeater'] ?? '';

if (empty($repeater) || !have_rows($repeater)) {
    return;
}
?>

<section class="bads-section bads-section--lg bads-corp-advantages">

    <div class="bads-container bads-stack bads-stack--xl">

        <?php
        $index = 0;

        while (have_rows($repeater)) :
            the_row();

            $item_title       = get_sub_field($repeater . '-title');
            $item_description = get_sub_field($repeater . '-description');
            $item_image       = get_sub_field($repeater . '-photo');
            $is_reversed      = ($index % 2 === 1);
            $index++;
            ?>

            <div class="bads-split bads-split--wide<?= $is_reversed ? ' bads-corp-advantages__row--reversed' : '' ?>">

                <div>

                    <div class="bads-stack bads-stack--md bads-stack--start">

                        <?php
                        get_template_part(
                            'template-parts/ui/title',
                            null,
                            [
                                'title'           => $item_title,
                                'subtitle'        => $item_description,
                                'level'           => 'h3',
                                'size'            => 'h3',
                                'divider'         => true,
                                'divider_variant' => 'primary',
                            ]
                        );
                        ?>

                    </div>

                </div>

                <?php if ($item_image) : ?>

                    <div>

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
                                'rounded' => '2xl',
                            ]
                        );
                        ?>

                    </div>

                <?php endif; ?>

            </div>

        <?php endwhile; ?>

    </div>

</section>


<style>
/* ==========================================================================
   Corp / Advantages
   ========================================================================== */

.bads-corp-advantages__row--reversed > :first-child {
    order: 2;
}

@media (max-width: 767px) {
    .bads-corp-advantages__row--reversed > :first-child {
        order: 0;
    }
}
</style>
