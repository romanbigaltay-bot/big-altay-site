<?php
/**
 * ============================================================================
 * Big Altay
 * New Year Page / Hero
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$hero_image_url = 'https://big-altay.ru/wp-content/uploads/2026/08/ng-hero-01.jpg';

$hero_image = attachment_url_to_postid($hero_image_url);

?>

<section class="bads-section bads-section--lg">

    <div class="bads-container">

        <div class="bads-split bads-split--equal">

            <div>

                <div class="bads-stack bads-stack--lg bads-stack--start">

                    <?php
                    get_template_part(
                        'template-parts/ui/breadcrumbs',
                        null,
                        [
                            'items' => [
                                [
                                    'label' => 'Главная',
                                    'url'   => home_url('/'),
                                ],
                                [
                                    'label'  => 'Новый год',
                                    'current' => true,
                                ],
                            ],
                        ]
                    );
                    ?>

                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title'    => 'Новый год в Белокурихе лучше планировать заранее',
                            'subtitle' => 'Отдых, лечение и оздоровление в зимней Белокурихе. Забронируйте поездку заранее, чтобы спокойно выбрать санаторий, даты и условия отдыха.',
                            'level'    => 'h1',
                            'size'     => 'h1',
                            'divider'  => true,
                            'divider_variant' => 'primary',
                        ]
                    );
                    ?>

                    <div class="bads-grid bads-grid--2">

                        <?php
                        get_template_part(
                            'template-parts/ui/list',
                            null,
                            [
                                'items' => [
                                    'Больше вариантов санаториев',
                                    'Удобный выбор дат',
                                ],
                                'variant' => 'check',
                            ]
                        );
                        ?>

                        <?php
                        get_template_part(
                            'template-parts/ui/list',
                            null,
                            [
                                'items' => [
                                    'Планирование лечения заранее',
                                    'Спокойная подготовка к праздникам',
                                ],
                                'variant' => 'check',
                            ]
                        );
                        ?>

                    </div>

                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Подобрать отдых на Новый год',
                            'url'     => '#new-year-form',
                            'variant' => 'primary',
                            'size'    => 'lg',
                        ]
                    );
                    ?>

                </div>

            </div>

            <?php if ($hero_image) : ?>

                <div>

                    <?php
                    get_template_part(
                        'template-parts/ui/media',
                        null,
                        [
                            'image'   => $hero_image,
                            'size'    => 'full',
                            'fit'     => 'cover',
                            'ratio'   => 'landscape',
                            'rounded' => true,
                            'loading' => 'eager',
                        ]
                    );
                    ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>