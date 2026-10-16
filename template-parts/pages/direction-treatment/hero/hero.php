<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 1: Hero + Breadcrumbs + Anchor Navigation
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$page_title = get_the_title();
$hero_title = get_field('direction_hero_title') ?: ($page_title ? $page_title : 'Санаторно-курортное лечение в Белокурихе');
$hero_subtitle = get_field('direction_hero_subtitle') ?: 'Комплексное оздоровление и терапия на Алтае с использованием целебных природных факторов, термальных вод, лечебных грязей и передовой медицинской базы.';
$hero_badge = get_field('direction_hero_badge') ?: 'Профиль лечения Белокурихи';

$breadcrumbs_items = [
    [
        'label' => 'Главная',
        'url'   => home_url('/'),
    ],
    [
        'label' => 'Лечение',
        'url'   => home_url('/lechenie/'),
    ],
    [
        'label'   => $page_title ?: 'Лечение',
        'current' => true,
    ],
];

$nav_anchors = [
    ['label' => 'Заболевания', 'href' => '#direction-indications'],
    ['label' => 'Методы лечения', 'href' => '#direction-methods'],
    ['label' => 'Противопоказания', 'href' => '#direction-contraindications'],
    ['label' => 'Программы', 'href' => '#direction-programs'],
    ['label' => 'Санатории', 'href' => '#direction-sanatoriums'],
    ['label' => 'FAQ', 'href' => '#direction-faq'],
];
?>

<section class="bads-section bads-section--hero">
    <div class="bads-container">

        <!-- Hero Card (BADS Glass Surface) -->
        <div class="bads-card bads-card--glass bads-card--padding-xl">
            <div class="bads-stack bads-stack--lg">

                <!-- Header: Breadcrumbs (Left) + Badge (Right) -->
                <div class="bads-cluster bads-cluster--between bads-cluster--middle">
                    <?php
                    get_template_part(
                        'template-parts/ui/breadcrumbs',
                        null,
                        [
                            'items' => $breadcrumbs_items,
                        ]
                    );
                    ?>

                    <?php if ($hero_badge) : ?>
                        <?php
                        get_template_part(
                            'template-parts/ui/badge',
                            null,
                            [
                                'text'    => $hero_badge,
                                'variant' => 'primary',
                            ]
                        );
                        ?>
                    <?php endif; ?>
                </div>

                <!-- Main Split: Left Content + Right Image Placeholder -->
                <div class="bads-split bads-split--wide bads-split--center">

                    <!-- Left Column: Title, Subtitle, Divider, CTAs -->
                    <div class="bads-stack bads-stack--lg">

                        <!-- Title + Subtitle + Accent Divider -->
                        <?php
                        get_template_part(
                            'template-parts/ui/title',
                            null,
                            [
                                'level'           => 'h1',
                                'size'            => 'h2',
                                'title'           => $hero_title,
                                'subtitle'        => $hero_subtitle,
                                'divider'         => true,
                                'divider_variant' => 'primary',
                                'divider_width'   => '90px',
                                'align'           => 'left',
                            ]
                        );
                        ?>

                        <!-- CTA Actions -->
                        <div class="bads-cluster bads-cluster--sm">
                            <?php
                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'    => 'Профильные санатории',
                                    'url'     => '#direction-sanatoriums',
                                    'type'    => 'link',
                                    'variant' => 'primary',
                                    'size'    => 'sm',
                                ]
                            );

                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'    => 'Программы лечения',
                                    'url'     => '#direction-programs',
                                    'type'    => 'link',
                                    'variant' => 'secondary',
                                    'size'    => 'sm',
                                ]
                            );
                            ?>
                        </div>

                    </div>

                    <!-- Right Column: Media 512x376 Placeholder -->
                    <div class="bads-stack">
                        <?php
                        $hero_image_url = get_field('direction_hero_image');
                        if (is_array($hero_image_url)) {
                            $hero_image_url = $hero_image_url['url'] ?? '';
                        }
                        if (!$hero_image_url) {
                            $hero_image_url = get_template_directory_uri() . '/assets/images/placeholders/image.svg';
                        }
                        ?>
                        <div class="bads-media bads-media--rounded" style="aspect-ratio: 512 / 376; max-width: 512px; width: 100%;">
                            <img
                                class="bads-media__image"
                                src="<?= esc_url($hero_image_url); ?>"
                                alt="<?= esc_attr($hero_title); ?>"
                                width="512"
                                height="376"
                                loading="eager"
                            >
                        </div>
                    </div>

                </div>

                <!-- Section Divider -->
                <?php
                get_template_part(
                    'template-parts/ui/divider',
                    null,
                    [
                        'variant' => 'section',
                    ]
                );
                ?>

                <!-- Fast Anchor Navigation (Left) + Consultation CTA (Right) -->
                <div class="bads-cluster bads-cluster--between bads-cluster--middle">
                    <?php
                    get_template_part(
                        'template-parts/components/anchor-nav/anchor-nav',
                        null,
                        [
                            'items' => $nav_anchors,
                        ]
                    );

                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Получить консультацию',
                            'url'     => '#direction-quick-form',
                            'type'    => 'link',
                            'variant' => 'primary',
                            'size'    => 'md',
                        ]
                    );
                    ?>
                </div>

            </div>
        </div>

    </div>
</section>
