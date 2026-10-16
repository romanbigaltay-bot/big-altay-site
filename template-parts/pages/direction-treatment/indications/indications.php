<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 2: Indications & Diseases
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_indications_title') ?: 'Показания к лечению: кому это подходит';
$subtitle = get_field('direction_indications_subtitle') ?: 'Основные группы эндокринных патологий и метаболических нарушений, успешно компенсируемых на курорте Белокуриха';

$items = get_field('direction_indications');

if (empty($items) || !is_array($items)) {
    $items = [
        [
            'title'       => 'Заболевания щитовидной железы',
            'description' => 'Диффузный токсический и эндемический зоб (1–2 степени), аутоиммунный тиреоидит, гипотиреоз и состояния после струмэктомии в стадии компенсации. Санаторное лечение способствует нормализации гормонального фона, снижению воспалительных процессов и улучшению общего самочувствия.',
            'badge'       => 'Щитовидная железа',
        ],
        [
            'title'       => 'Сахарный диабет 1 и 2 типа',
            'description' => 'Легкой и средней тяжести в состоянии устойчивой компенсации, без наклонности к кетоацидозу и гипогликемии. Лечение включает диетотерапию и процедуры, улучшающие микроциркуляцию и снижающие риск развития полинейропатий и ангиопатий.',
            'badge'       => 'Диабет & Сосуды',
        ],
        [
            'title'       => 'Нарушения обмена веществ и ожирение',
            'description' => 'Первичное ожирение I–III степени без декомпенсации кровообращения, дислипидемия, подагра в фазе ремиссии, мочекислый диатез и оксалатурия. Комплексные программы направлены на коррекцию веса, нормализацию липидного и пуринового обмена.',
            'badge'       => 'Метаболизм & Вес',
        ],
    ];
}
?>

<section id="direction-indications" class="bads-section bads-section--md">
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

        <div class="bads-grid bads-grid--3 bads-grid--gap-md" style="margin-top: var(--space-xl);">
            <?php foreach ($items as $item): ?>
                <?php
                $item_title = $item['title'] ?? '';
                $item_desc  = $item['description'] ?? '';
                $item_badge = $item['badge'] ?? '';
                ?>
                <div class="bads-card bads-card--bordered bads-card--padding-lg" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-md); transition: transform 0.2s ease, box-shadow 0.2s ease; background: var(--color-surface, #ffffff);">
                    <div class="bads-stack bads-stack--sm">
                        <?php if ($item_badge): ?>
                            <div>
                                <span class="bads-badge bads-badge--neutral" style="font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: var(--radius-pill);">
                                    <?= esc_html($item_badge); ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-text-primary); font-size: 1.25rem; line-height: 1.35;">
                            <?= esc_html($item_title); ?>
                        </h3>

                        <p style="margin: 0; color: var(--color-text-secondary); font-size: var(--font-size-base, 15px); line-height: 1.6;">
                            <?= esc_html($item_desc); ?>
                        </p>
                    </div>

                    <div style="margin-top: var(--space-md); padding-top: var(--space-sm); border-top: 1px dashed var(--color-border, rgba(0,0,0,0.08));">
                        <a href="#direction-sanatoriums" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--color-primary); text-decoration: none;">
                            Санатории по профилю →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
