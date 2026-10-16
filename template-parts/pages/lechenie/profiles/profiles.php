<?php
/**
 * ============================================================================
 * Treatments
 * Profiles
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$treatments = get_posts([
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_key'       => '_wp_page_template',
    'meta_value'     => 'page-treatment-direction.php',
]);

if (empty($treatments)) {
    return;
}

?>

<section
    id="treatments-list"
    class="bads-section bads-section--md">

    <div class="bads-container">

        <div class="bads-stack bads-stack--xl">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title'    => 'Выберите направление лечения',
                    'subtitle' => 'Все программы лечения санаториев Белокурихи сгруппированы по основным медицинским направлениям.',
                    'level'    => 'h2',
                    'divider'  => true,
                ]
            );
            ?>

            <div class="bads-grid bads-grid--3">

                <?php foreach ($treatments as $treatment) : ?>

                    <div class="bads-card bads-card--glass bads-card--padding-xl">

                        <div class="bads-stack bads-stack--lg bads-stack--fill">

                            <div class="bads-stack bads-stack--md">

                                <?php
                                get_template_part(
                                    'template-parts/ui/title',
                                    null,
                                    [
                                        'title' => get_the_title($treatment),
                                        'level' => 'h4',
                                    ]
                                );
                                ?>

                                <?php if (!empty($item['badge'])) : ?>

                                    <?php
                                    get_template_part(
                                        'template-parts/ui/badge',
                                        null,
                                        [
                                            'text'    => $item['badge'],
                                            'variant' => 'success',
                                        ]
                                    );
                                    ?>

                                <?php endif; ?>

                            </div>

                            <div class="bads-content">

                                <?php if (!empty($item['text'])) : ?>

                                    <p><?= esc_html($item['text']); ?></p>

                                <?php endif; ?>

                            </div>

                            <?php
                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'          => 'Подробнее',
                                    'url'           => get_permalink($treatment),
                                    'variant'       => 'outline',
                                    'icon'          => 'navigation/arrow-right',
                                    'icon_position' => 'right',
                                    'attributes'    => [
                                        'data-treatment-id' => $treatment->ID,
                                    ],
                                ]
                            );
                            ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>