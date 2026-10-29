<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Hero
 * ============================================================================
 *
 * Первый экран страницы «Корпоративный отдых».
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Breadcrumbs
 * - BADS Badge
 * - BADS Title
 * - BADS Button
 * - BADS Media
 *
 * Данные: ACF-поля страницы (corp_promo).
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$promo_image = get_field('corp_promo');
?>

<section class="bads-section bads-section--lg bads-corp-hero">

    <div class="bads-container">

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
                        'label'   => 'Корпоративный отдых',
                        'current' => true,
                    ],
                ],
            ]
        );
        ?>

        <div class="bads-split bads-split--wide bads-split--start" style="margin-top: var(--space-lg);">

            <div>

                <div class="bads-stack bads-stack--lg bads-stack--start">

                    <?php
                    get_template_part(
                        'template-parts/ui/badge',
                        null,
                        [
                            'text'    => 'Корпоративный отдых',
                            'variant' => 'primary',
                            'size'    => 'md',
                        ]
                    );
                    ?>

                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title'           => get_the_title(),
                            'subtitle'        => 'Организуем для вашей команды корпоративный отдых, конференции, коворкинги и нетворкинг-события в Белокурихе — под ключ, с размещением, питанием и деловой программой.',
                            'level'           => 'h1',
                            'size'            => 'h1',
                            'divider'         => true,
                            'divider_variant' => 'primary',
                        ]
                    );
                    ?>

                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'          => 'Оставить заявку на расчёт',
                            'url'           => '#lead-form',
                            'variant'       => 'primary',
                            'size'          => 'lg',
                            'icon'          => 'navigation/arrow-right',
                            'icon_position' => 'right',
                        ]
                    );
                    ?>

                </div>

            </div>

            <?php if ($promo_image) : ?>

                <div>

                    <?php
                    get_template_part(
                        'template-parts/ui/media',
                        null,
                        [
                            'image'     => $promo_image,
                            'size'      => 'large',
                            'alt'       => get_the_title(),
                            'fit'       => 'cover',
                            'ratio'     => 'landscape',
                            'rounded'   => '2xl',
                            'loading'   => 'eager',
                        ]
                    );
                    ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>
