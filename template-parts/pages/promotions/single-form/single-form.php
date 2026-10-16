<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Single Form (Promotions)
 * Path: template-parts/pages/promotions/single-form/single-form.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$section_id    = $args['id'] ?? 'free-consultation';
$title         = $args['title'] ?? 'Бесплатная консультация!';
$description   = $args['description'] ?? 'Расскажем, какие акции действуют на интересующие вас даты, проверим возможность получения дополнительных скидок и бесплатно проконсультируем по всем условиям бронирования';
$form_benefits = $args['benefits'] ?? [
    'Проверим все действующие акции',
    'Подскажем наиболее выгодные даты заезда',
    'Рассчитаем стоимость отдыха с учетом скидок',
    'Ответим на любые вопросы по акциям',
];
?>

<section class="bads-section bads-section--lg" id="<?= esc_attr($section_id); ?>">
    <?php if ($section_id !== 'promotions-form') : ?>
        <span id="promotions-form" class="anchor" style="display: block; position: relative; top: -80px; visibility: hidden;"></span>
    <?php endif; ?>
    <div class="bads-container bads-container--inset-lg">

        <div class="bads-split bads-split--wide bads-split--center bads-split--gap-xl">

            <!-- Left Column: Content, Title, Description, Benefits -->
            <div class="bads-stack bads-stack--lg">

                <?php
                get_template_part(
                    'template-parts/ui/title',
                    null,
                    [
                        'level'           => 'h2',
                        'size'            => 'h2',
                        'title'           => $title,
                        'divider'         => true,
                        'divider_variant' => 'primary',
                        'divider_width'   => '90px',
                    ]
                );
                ?>

                <p class="bads-text-body" style="max-width: 600px; font-size: 19px; line-height: 1.8; color: var(--color-text);">
                    <?= esc_html($description); ?>
                </p>

                <ul class="bads-list bads-list--check">
                    <?php foreach ($form_benefits as $benefit) : ?>
                        <li class="bads-list__item">
                            <span class="bads-list__icon" style="color: var(--color-success); font-size: 18px; font-weight: 800; line-height: 1;">✓</span>
                            <span class="bads-list__text" style="font-size: 17px; font-weight: 500;"><?= esc_html($benefit); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>

            <!-- Right Column: Glass Form Card -->
            <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-lg">

                <div class="bads-cluster bads-cluster--center u-mb-md">
                    <?php
                    get_template_part(
                        'template-parts/ui/badge',
                        null,
                        [
                            'text'    => 'Прямая связь с менеджером',
                            'variant' => 'success',
                        ]
                    );
                    ?>
                </div>

                <?php
                get_template_part(
                    'template-parts/ui/title',
                    null,
                    [
                        'level'  => 'h3',
                        'size'   => 'h4',
                        'title'  => 'Заполните форму',
                        'align'  => 'center',
                        'class'  => 'u-mb-lg',
                    ]
                );
                ?>

                <?php
                get_template_part(
                    'components/forms/b24-form',
                    null,
                    [
                        'form_id'         => 'promotions',
                        'form_title'      => 'Бесплатная консультация (Страница Акции)',
                        'button_text'     => 'Получить консультацию',
                        'success_target'  => 'promotions-form',
                        'success_url'     => '/thank-you/promotions/',
                        'centered'        => true,
                        'privacy_variant' => 'multiline',
                    ]
                );
                ?>

            </div>

        </div>

    </div>
</section>
