<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Single Hero (Promotions)
 * Path: template-parts/pages/promotions/single-hero/single-hero.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$subtitle        = get_field('promotion_short_description');
$description     = get_field('promotion_conditions');
$max_discount    = get_field('promotion_max_discount');
$max_applies_to  = get_field('promotion_applies_to');
$period          = get_field('promotion_period');
$status          = get_field('promotion_status');

$status_labels = [
    'active'    => 'Активна',
    'soon'      => 'Скоро стартует',
    'last_days' => 'Последние дни',
    'ended'     => 'Завершена',
];

$breadcrumbs_items = [
    [
        'label' => 'Главная',
        'url'   => home_url('/'),
    ],
    [
        'label' => 'Акции',
        'url'   => home_url('/promotions/'),
    ],
    [
        'label'   => get_the_title(),
        'current' => true,
    ],
];
?>

<section class="bads-section bads-section--hero bads-section--sm">
    <div class="bads-container">

        <!-- Breadcrumbs -->
        <div style="margin-bottom: var(--space-lg);">
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

        <!-- Heading: Title + Status Badge -->
        <div class="bads-cluster bads-cluster--md bads-cluster--middle u-mb-sm">
            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'level'  => 'h1',
                    'size'   => 'h1',
                    'title'  => 'Акция ' . get_the_title(),
                    'class'  => 'u-mb-none',
                ]
            );
            ?>

            <?php if ($status) :
                $badge_variant = match ($status) {
                    'active'    => 'success',
                    'soon'      => 'primary',
                    'last_days' => 'warning',
                    'ended'     => 'neutral',
                    default     => 'primary',
                };
                get_template_part(
                    'template-parts/ui/badge',
                    null,
                    [
                        'text'    => $status_labels[$status] ?? $status,
                        'variant' => $badge_variant,
                    ]
                );
            endif; ?>
        </div>

        <!-- Accent Divider -->
        <div class="u-mb-xl">
            <?php
            get_template_part(
                'template-parts/ui/divider',
                null,
                [
                    'variant' => 'primary',
                    'width'   => '90px',
                ]
            );
            ?>
        </div>

        <!-- Main Overlap Split: Front Content Glass Card (High & Dominant) + Overlapped Media Image -->
        <div class="bads-overlap-split">

            <!-- Front Glass Card (Dominant Height & Content) -->
            <div class="bads-overlap-split__card bads-card bads-card--glass bads-card--padding-xl bads-card--radius-lg">

                <?php if ($subtitle) : ?>
                    <div class="u-mb-md">
                        <?php
                        get_template_part(
                            'template-parts/ui/title',
                            null,
                            [
                                'level' => 'h2',
                                'size'  => 'h3',
                                'title' => $subtitle,
                            ]
                        );
                        ?>
                    </div>

                    <?php if ($max_applies_to) :
                        $items = preg_split('/\r\n|\r|\n/', trim($max_applies_to));
                    ?>
                        <div class="bads-cluster bads-cluster--xs u-mb-lg">
                            <?php foreach ($items as $item) :
                                $item = trim($item);
                                if (empty($item)) continue;
                                get_template_part(
                                    'template-parts/ui/chip',
                                    null,
                                    [
                                        'text'          => $item,
                                        'variant'       => 'success',
                                        'size'          => 'sm',
                                        'icon'          => 'status/check',
                                        'icon_position' => 'left',
                                    ]
                                );
                            endforeach; ?>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="bads-content u-mb-lg" style="font-size: 17px; line-height: 1.8; color: var(--color-text);">
                        <?= wpautop(esc_html($description)); ?>
                    </div>
                <?php endif; ?>

                <!-- Offer Block: Discount + Period -->
                <div class="bads-cluster bads-cluster--md bads-cluster--middle u-mb-xl">
                    <?php if ($max_discount) : ?>
                        <?php
                        get_template_part(
                            'template-parts/ui/badge',
                            null,
                            [
                                'text'    => 'Скидка ' . $max_discount,
                                'variant' => 'accent',
                                'size'    => 'lg',
                            ]
                        );
                        ?>
                    <?php endif; ?>

                    <?php if ($period) : ?>
                        <div style="font-size: 15px; line-height: 1.6; color: var(--color-text-muted);">
                            <?= nl2br(esc_html($period)); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- CTA Button -->
                <div>
                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'text'    => 'Применить акцию',
                            'url'     => '#promotions-form',
                            'variant' => 'primary',
                            'size'    => 'lg',
                        ]
                    );
                    ?>
                </div>

            </div>

            <!-- Side Media Image (Wide Landscape Ratio ~16:9, 460px Height) -->
            <div class="bads-overlap-split__media">
                <div class="bads-media bads-media--rounded-2xl bads-media--ratio-landscape bads-media--fit-cover bads-media--shadow-xl" style="height: 460px; width: 100%;">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(
                            'large',
                            [
                                'class'   => 'bads-media__image',
                                'loading' => 'eager',
                            ]
                        ); ?>
                    <?php else : ?>
                        <img
                            src="<?= esc_url(get_template_directory_uri() . '/assets/images/placeholders/image.svg'); ?>"
                            alt="<?= esc_attr(get_the_title()); ?>"
                            class="bads-media__image"
                        >
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</section>
