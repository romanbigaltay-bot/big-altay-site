<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 7: Sanatoriums List
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_sanatoriums_title') ?: 'Санатории Белокурихи с лечением эндокринной системы';
$subtitle = get_field('direction_sanatoriums_subtitle') ?: 'Ведущие здравницы курорта, оснащённые современной лечебно-диагностической базой и опытными врачами-эндокринологами';

$custom_sanatoriums = get_field('direction_sanatoriums');

if (empty($custom_sanatoriums) || !is_array($custom_sanatoriums)) {
    $custom_sanatoriums = [
        [
            'name'     => 'Санаторий «Алтай-West»',
            'features' => 'Акцент на климатотерапию, терренкур и прием специализированной минеральной воды «Белокурихинская Восточная №2».',
            'stars'    => 4,
            'price'    => 'от 5 800 ₽/сут',
            'url'      => home_url('/sanatoriums/altay-west/'),
        ],
        [
            'name'     => 'Санаторий «Алтайский Замок»',
            'features' => 'Широкая лечебно-диагностическая база, инновационные процедуры, спелеотерапия (солевая пещера), талассотерапия и озонотерапия.',
            'stars'    => 4,
            'price'    => 'от 5 400 ₽/сут',
            'url'      => home_url('/sanatoriums/altayskiy-zamok/'),
        ],
        [
            'name'     => 'Курортный отель «Беловодье»',
            'features' => 'Комплексное воздействие на обменные процессы с использованием бальнеолечения, диетотерапии и климатолечения.',
            'stars'    => 4,
            'price'    => 'от 5 200 ₽/сут',
            'url'      => home_url('/sanatoriums/belovodye/'),
        ],
        [
            'name'     => 'Санаторий «Белокуриха»',
            'features' => 'Классическая бальнеотерапия, собственный термальный комплекс, расширенное питьевое лечение минеральной водой (3 раза в день).',
            'stars'    => 4,
            'price'    => 'от 5 900 ₽/сут',
            'url'      => home_url('/sanatoriums/belokuriha/'),
        ],
        [
            'name'     => 'Санаторий «Катунь»',
            'features' => 'Комплексный подход к лечению диабета и ожирения, современная аппаратная физиотерапия и термальный бассейн.',
            'stars'    => 4,
            'price'    => 'от 5 600 ₽/сут',
            'url'      => home_url('/sanatoriums/katun/'),
        ],
        [
            'name'     => 'Санаторий «Родник Алтая»',
            'features' => 'Расширенная диагностика (УЗИ, биохимия), иглорефлексотерапия, пивные ванны и термогидротерапия с фиточаем из алтайских трав.',
            'stars'    => 4,
            'price'    => 'от 6 200 ₽/сут',
            'url'      => home_url('/sanatoriums/rodnik-altaya/'),
        ],
        [
            'name'     => 'Санаторий «Россия»',
            'features' => 'Крупнейшее в регионе эндокринологическое отделение, тщательный медико-динамический анализ, малые радоновые процедуры.',
            'stars'    => 5,
            'price'    => 'от 7 100 ₽/сут',
            'url'      => home_url('/sanatoriums/rossiya/'),
        ],
        [
            'name'     => 'Санаторий «Сибирь»',
            'features' => 'Полный спектр классической бальнеотерапии, аппаратной физиотерапии и термальный комплекс для компенсации нарушений обмена веществ.',
            'stars'    => 4,
            'price'    => 'от 5 800 ₽/сут',
            'url'      => home_url('/sanatoriums/sibir/'),
        ],
        [
            'name'     => 'Санаторий «Центросоюз»',
            'features' => 'Разнообразие ванн (йодобромные, рапные, скипидарные), спелеотерапия, фитобочка и бассейн с сауной и хамамом.',
            'stars'    => 3,
            'price'    => 'от 4 900 ₽/сут',
            'url'      => home_url('/sanatoriums/centrosoyuz/'),
        ],
        [
            'name'     => 'Санаторий «Эдем»',
            'features' => 'Специализированные программы для пациентов после струмэктомии, лечение диабетической ангиопатии и невропатии, безлимитный открытый бассейн.',
            'stars'    => 4,
            'price'    => 'от 6 500 ₽/сут',
            'url'      => home_url('/sanatoriums/edem/'),
        ],
    ];
}
?>

<section id="direction-sanatoriums" class="bads-section bads-section--md" style="background: var(--color-surface-container-low, #fbfcfd);">
    <div class="bads-container">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title'    => $title,
                'subtitle' => $subtitle,
                'level'    => 'h2',
                'divider'  => true,
            ]
        );
        ?>

        <div class="bads-grid bads-grid--2 bads-grid--gap-md" style="margin-top: var(--space-xl);">
            <?php foreach ($custom_sanatoriums as $idx => $san): ?>
                <?php
                $s_name     = $san['name'] ?? '';
                $s_features = $san['features'] ?? '';
                $s_stars    = (int) ($san['stars'] ?? 4);
                $s_price    = $san['price'] ?? '';
                $s_url      = $san['url'] ?? '#direction-form';
                ?>
                <div class="bads-card bads-card--bordered bads-card--padding-lg" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-md); background: #ffffff;">
                    <div class="bads-stack bads-stack--xs">
                        <div style="display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap; gap: 6px;">
                            <h3 class="bads-title bads-title--h4" style="margin: 0; font-size: 1.2rem; color: var(--color-text-primary);">
                                <?= esc_html($s_name); ?>
                            </h3>
                            <div style="color: #eab308; font-size: 14px; letter-spacing: 1px;">
                                <?= str_repeat('★', $s_stars); ?>
                            </div>
                        </div>

                        <div style="padding: var(--space-xs) 0;">
                            <span style="font-size: 13px; font-weight: 600; color: var(--color-primary); display: block; margin-bottom: 3px;">Особенности лечения:</span>
                            <p style="margin: 0; font-size: 14px; line-height: 1.55; color: var(--color-text-secondary);">
                                <?= esc_html($s_features); ?>
                            </p>
                        </div>
                    </div>

                    <div style="margin-top: var(--space-md); padding-top: var(--space-sm); border-top: 1px solid var(--color-border, rgba(0,0,0,0.06)); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                        <?php if ($s_price): ?>
                            <span style="font-weight: 700; font-size: 15px; color: var(--color-text-primary);">
                                <?= esc_html($s_price); ?>
                            </span>
                        <?php endif; ?>
                        <div class="bads-cluster bads-cluster--xs" style="display: flex; gap: 8px;">
                            <a href="#direction-form" class="bads-button bads-button--primary bads-button--sm" style="text-decoration: none; font-size: 13px;">
                                Оставить заявку
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
