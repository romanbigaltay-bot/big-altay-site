<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Archive Hero (Promotions)
 * Path: template-parts/pages/promotions/archive-hero/archive-hero.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$breadcrumbs_items = [
    [
        'label' => 'Главная',
        'url'   => home_url('/'),
    ],
    [
        'label'   => 'Акции',
        'current' => true,
    ],
];

$features = [
    'Официальный представитель',
    'Поддержка на всех этапах',
    'Прямые договоры с санаториями',
    'Специальные тарифы',
];

$hero_image_url = 'https://big-altay.ru/wp-content/uploads/2026/07/promotion_hero_img.png';
?>

<section class="bads-section bads-section--hero bads-section--sm">
    <div class="bads-container">

        <!-- Breadcrumbs -->
        <div class="u-mb-lg">
            <?php
            get_template_part(
                'template-parts/ui/breadcrumbs',
                null,
                [
                    'items' => $breadcrumbs_items,
                ]
            );
            ?>
        </div>

        <!-- Main Title with BADS Accent Divider -->
        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'level'           => 'h1',
                'size'            => 'h1',
                'title'           => 'Акции и специальные предложения',
                'divider'         => true,
                'divider_variant' => 'primary',
                'divider_width'   => '90px',
                'align'           => 'left',
            ]
        );
        ?>

        <!-- Hero Content Split: Left Info + Right Media -->
        <div class="bads-split bads-split--wide bads-split--start u-mt-xl">

            <!-- Left Column: Badges, Title, Description, Features, Buttons -->
            <div class="bads-stack bads-stack--lg">

                <!-- Heading -->
                <?php
                get_template_part(
                    'template-parts/ui/title',
                    null,
                    [
                        'level' => 'h2',
                        'size'  => 'h2',
                        'title' => 'Оздоровление и отдых <br>на выгодных условиях!',
                    ]
                );
                ?>

                <!-- Badges -->
                <div class="bads-cluster bads-cluster--sm">
                    <?php
                    get_template_part(
                        'template-parts/ui/badge',
                        null,
                        [
                            'text'    => 'Лучшие предложения сезона',
                            'variant' => 'primary',
                        ]
                    );

                    get_template_part(
                        'template-parts/ui/badge',
                        null,
                        [
                            'text'    => 'Гарантированное бронирование',
                            'variant' => 'primary',
                        ]
                    );
                    ?>
                </div>

                <!-- Description -->
                <p class="bads-text-body u-m-0" style="font-size: 18px; line-height: 1.7; max-width: 720px;">
                    Подберите выгодный вариант отдыха, получите специальные условия бронирования, скидки и эксклюзивные предложения от туроператора «Большой Алтай»
                </p>

                <!-- Features with Status Checkmarks -->
                <div class="bads-grid bads-grid--2 bads-grid--gap-sm" style="max-width: 680px;">
                    <?php foreach ($features as $feature) : ?>
                        <div class="bads-cluster bads-cluster--xs bads-cluster--nowrap" style="align-items: center;">
                            <span style="color: var(--color-success, #28a745); font-weight: 800; font-size: 20px; line-height: 1; flex-shrink: 0;">✓</span>
                            <span class="u-text-semibold" style="font-size: 17px; line-height: 1.35; color: var(--color-text);"><?= esc_html($feature); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- CTA Actions -->
                <div class="bads-cluster bads-cluster--md">
                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Получить предложение',
                            'url'     => '#promotions-form',
                            'variant' => 'primary',
                            'size'    => 'lg',
                        ]
                    );

                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Смотреть акции',
                            'url'     => '#promotions-list',
                            'variant' => 'outline',
                            'size'    => 'lg',
                        ]
                    );
                    ?>
                </div>

            </div>

            <!-- Right Column: Media Image -->
            <div class="bads-stack bads-stack--center">
                <div class="bads-media bads-media--rounded-2xl bads-media--ratio-square bads-media--shadow-lg" style="width: 100%; max-width: 520px; aspect-ratio: 1 / 1; border-radius: var(--radius-2xl, 32px); overflow: hidden; box-shadow: var(--shadow-lg, 0 10px 25px rgba(0, 0, 0, .08)); isolation: isolate;">
                    <img
                        class="bads-media__image"
                        src="<?= esc_url($hero_image_url); ?>"
                        alt="Акции и специальные предложения"
                        width="520"
                        height="520"
                        loading="eager"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit; display: block;"
                    >
                </div>
            </div>

        </div>

    </div>
</section>

