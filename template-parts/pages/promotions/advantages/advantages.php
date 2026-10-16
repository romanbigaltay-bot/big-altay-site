<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Advantages (Promotions)
 * Path: template-parts/pages/promotions/advantages/advantages.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$advantages = [
    [
        'number' => 1,
        'icon'   => 'shild',
        'title'  => 'Проверяем каждую акцию',
        'text'   => 'Перед подтверждением заявки менеджер вручную проверяет все условия, чтобы вы действительно получили обещанную скидку.',
    ],
    [
        'number' => 2,
        'icon'   => 'percent',
        'title'  => 'Подбираем максимальную выгоду',
        'text'   => 'Если существует более выгодный вариант отдыха, мы обязательно предложим его.',
    ],
    [
        'number' => 3,
        'icon'   => 'garniture',
        'title'  => 'Сопровождаем бронирование',
        'text'   => 'Остаёмся на связи от первой консультации до момента вашего заезда.',
    ],
    [
        'number' => 4,
        'icon'   => 'doc',
        'title'  => 'Официальный туроператор',
        'text'   => 'Работаем напрямую с санаториями Алтая без посредников.',
    ],
];
?>

<section class="bads-section bads-section--lg bads-promotions-advantages">
    <div class="bads-container">

        <!-- Title with Accent Divider -->
        <div style="margin-bottom: var(--space-3xl);">
            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'level'           => 'h2',
                    'size'            => 'h2',
                    'title'           => 'Оформлять через нас выгодно!',
                    'divider'         => true,
                    'divider_variant' => 'primary',
                    'divider_width'   => '90px',
                ]
            );
            ?>
        </div>

        <!-- Advantages Grid -->
        <div class="bads-grid bads-grid--2 bads-grid--gap-xl bads-promotions-advantages__grid">
            <?php foreach ($advantages as $adv) : ?>
                <article class="bads-card bads-card--default bads-promotions-advantage">

                    <!-- Watermark Number -->
                    <span class="bads-promotions-advantage__number">
                        <?= esc_html($adv['number']); ?>
                    </span>

                    <!-- Icon -->
                    <div class="bads-promotions-advantage__icon">
                        <?php
                        get_template_part(
                            'template-parts/ui/icon',
                            null,
                            [
                                'name' => $adv['icon'],
                                'size' => 'lg',
                            ]
                        );
                        ?>
                    </div>

                    <!-- Title -->
                    <h3 class="bads-title bads-title--h4 bads-promotions-advantage__title">
                        <?= esc_html($adv['title']); ?>
                    </h3>

                    <!-- Text -->
                    <p class="bads-text-body bads-promotions-advantage__text">
                        <?= esc_html($adv['text']); ?>
                    </p>

                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<style>
.bads-promotions-advantages__grid {
    gap: 32px;
}
.bads-promotions-advantage {
    position: relative;
    padding: 42px;
    border-radius: 28px;
    background: #F5F7FA;
    border: 1px solid rgba(var(--brand-primary-rgb), .10);
    transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
    overflow: hidden;
}
.bads-promotions-advantage::before {
    content: "";
    position: absolute;
    top: -70px;
    right: -70px;
    width: 170px;
    height: 170px;
    border-radius: 50%;
    background: radial-gradient(rgba(var(--brand-primary-rgb), .10), transparent 70%);
    transition: transform .35s ease;
    pointer-events: none;
}
.bads-promotions-advantage:hover {
    transform: translateY(-8px);
    border-color: rgba(var(--brand-primary-rgb), .25);
    box-shadow: 0 18px 50px rgba(0, 0, 0, .08);
}
.bads-promotions-advantage:hover::before {
    transform: scale(1.25);
}
.bads-promotions-advantage__number {
    position: absolute;
    top: 24px;
    right: 28px;
    font-size: 72px;
    font-weight: 900;
    line-height: 1;
    color: rgba(var(--brand-primary-rgb), .08);
    user-select: none;
    pointer-events: none;
}
.bads-promotions-advantage__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 76px;
    height: 76px;
    margin-bottom: 28px;
    border-radius: 18px;
    background: rgba(var(--brand-primary-rgb), .10);
    color: var(--color-primary);
    transition: background .35s ease, transform .35s ease;
}
.bads-promotions-advantage__icon svg,
.bads-promotions-advantage__icon img {
    width: 34px;
    height: 34px;
    transition: transform .35s ease;
}
.bads-promotions-advantage:hover .bads-promotions-advantage__icon {
    background: var(--color-primary);
    color: #ffffff;
    transform: scale(1.08);
}
.bads-promotions-advantage:hover .bads-promotions-advantage__icon svg {
    filter: brightness(0) invert(1);
}
.bads-promotions-advantage__title {
    font-size: 22px;
    line-height: 1.3;
    font-weight: 700;
    margin: 0 0 14px;
    color: var(--color-text);
}
.bads-promotions-advantage__text {
    font-size: 16px;
    line-height: 1.7;
    color: #555555;
    margin: 0;
}

@media (max-width: 991px) {
    .bads-promotions-advantages__grid {
        grid-template-columns: 1fr !important;
        gap: var(--space-xl) !important;
    }
    .bads-promotions-advantage {
        padding: var(--space-xl);
    }
}
</style>
