<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 6: What's Included in Package
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_included_title') ?: 'Что входит в стоимость путёвки';
$subtitle = get_field('direction_included_subtitle') ?: 'Прозрачные условия отдыха и оздоровления в санаториях Белокурихи';

$included_items = get_field('direction_included_items');
if (empty($included_items) || !is_array($included_items)) {
    $included_items = [
        'Проживание в номере выбранной категории комфортности.',
        '3-разовое сбалансированное или специализированное диетическое питание.',
        'Первичный, динамический и заключительный прием врача-терапевта/эндокринолога.',
        'Базовый комплекс лечебных и бальнеологических процедур по профилю.',
        'Пользование оздоровительной инфраструктурой (бассейн, термальный комплекс, тренажерный зал, терренкуры).',
    ];
}

$extra_items = get_field('direction_extra_items');
if (empty($extra_items) || !is_array($extra_items)) {
    $extra_items = [
        'Индивидуальные лекарственные препараты и узкопрофильные расходные материалы.',
        'Дополнительные медицинские и СПА-процедуры сверх базового стандарта (СПА-капсулы, озонотерапия и т.д.).',
        'Индивидуальный трансфер из аэропорта/вокзала и экскурсионные поездки по Горному Алтаю.',
    ];
}
?>

<section class="bads-section bads-section--md">
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
            
            <!-- Included Column -->
            <div class="bads-card bads-card--bordered bads-card--padding-lg" style="border-radius: var(--radius-md); background: #ffffff; border-top: 4px solid #16a34a;">
                <h3 class="bads-title bads-title--h4" style="margin: 0 0 var(--space-md) 0; color: #15803d; display: flex; align-items: center; gap: 8px;">
                    <span>✓</span> Включено в стоимость
                </h3>
                <ul style="margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: var(--space-sm);">
                    <?php foreach ($included_items as $inc_item): ?>
                        <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14.5px; line-height: 1.55; color: var(--color-text-primary);">
                            <span style="color: #16a34a; font-weight: bold; flex-shrink: 0; font-size: 16px;">✓</span>
                            <span><?= esc_html(is_array($inc_item) ? ($inc_item['text'] ?? '') : $inc_item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Extra Column -->
            <div class="bads-card bads-card--bordered bads-card--padding-lg" style="border-radius: var(--radius-md); background: #ffffff; border-top: 4px solid var(--color-text-muted, #8c8c8c);">
                <h3 class="bads-title bads-title--h4" style="margin: 0 0 var(--space-md) 0; color: var(--color-text-secondary); display: flex; align-items: center; gap: 8px;">
                    <span>+</span> Оплачивается отдельно
                </h3>
                <ul style="margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: var(--space-sm);">
                    <?php foreach ($extra_items as $ext_item): ?>
                        <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14.5px; line-height: 1.55; color: var(--color-text-primary);">
                            <span style="color: var(--color-text-muted); font-weight: bold; flex-shrink: 0; font-size: 16px;">•</span>
                            <span><?= esc_html(is_array($ext_item) ? ($ext_item['text'] ?? '') : $ext_item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

    </div>
</section>
