<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 4: Contraindications
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_contraindications_title') ?: 'Противопоказания к лечению';
$subtitle = get_field('direction_contraindications_subtitle') ?: 'Случаи, при которых санаторно-курортное лечение временно не рекомендуется или противопоказано';
$notice = get_field('direction_contraindications_notice') ?: 'Важно: Все заболевания должны быть только в стадии устойчивой компенсации или ремиссии. Перед планированием поездки обязательно проконсультируйтесь с лечащим врачом и оформите санаторно-курортную карту (форма 072/у).';

$items = get_field('direction_contraindications');

if (empty($items) || !is_array($items)) {
    $items = [
        'Острые и подострые инфекционные заболевания, хронические болезни с острогнойными процессами.',
        'Тиреотоксикоз тяжелой степени, тиреотоксическое сердце с нарушением ритма, тяжелый гипотиреоз.',
        'Сахарный диабет тяжелой степени с частыми гипогликемическими комами или кетоацидозом.',
        'Злокачественные новообразования эндокринных желез и состояния после оперативного лечения.',
        'Ожирение с сердечно-сосудистой недостаточностью 2 стадии и выше, легочной недостаточностью, апноэ.',
        'Активная стадия туберкулеза, эпилепсия (ремиссия менее 6 месяцев), расстройства психики в стадии обострения, кахексия.',
        'Неспособность к самостоятельному передвижению и самообслуживанию.',
    ];
}
?>

<section id="direction-contraindications" class="bads-section bads-section--md">
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

        <div class="bads-stack bads-stack--lg" style="margin-top: var(--space-xl);">
            
            <div class="bads-card bads-card--bordered bads-card--padding-lg" style="border-radius: var(--radius-md); background: #ffffff;">
                <ul style="margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: var(--space-sm);">
                    <?php foreach ($items as $item_text): ?>
                        <li style="display: flex; align-items: flex-start; gap: 12px; font-size: 15px; line-height: 1.6; color: var(--color-text-primary);">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background: #fee2e2; color: #dc2626; font-size: 13px; font-weight: 700; flex-shrink: 0; margin-top: 2px;">
                                ✕
                            </span>
                            <span><?= esc_html(is_array($item_text) ? ($item_text['text'] ?? '') : $item_text); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if ($notice): ?>
                <div class="bads-card bads-card--glass bads-card--padding-md" style="border-left: 4px solid #f59e0b; background: rgba(245, 158, 11, 0.06); border-radius: 0 var(--radius-md) var(--radius-md) 0;">
                    <div style="display: flex; align-items: flex-start; gap: 12px;">
                        <span style="font-size: 20px; line-height: 1;">⚠️</span>
                        <p style="margin: 0; font-size: 14.5px; line-height: 1.6; color: var(--color-text-primary); font-weight: 500;">
                            <?= esc_html($notice); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>
