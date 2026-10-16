<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 3: Treatment Methods
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_methods_title') ?: 'Методы лечения эндокринной системы в Белокурихе';
$subtitle = get_field('direction_methods_subtitle') ?: 'Сбалансированное сочетание природных факторов курорта и передовых физиотерапевтических технологий';

$methods = get_field('direction_methods');

if (empty($methods) || !is_array($methods)) {
    $methods = [
        [
            'title'       => 'Бальнеотерапия',
            'description' => 'Ванны с азотно-кремнистыми, слаборадоновыми, йодобромными, морскими и минеральными водами.',
            'benefit'     => 'Улучшают микроциркуляцию, нормализуют обмен веществ и функцию щитовидной железы, оказывают противовоспалительное действие.',
            'status'      => 'Входит в базовую путёвку',
        ],
        [
            'title'       => 'Питьевое лечение',
            'description' => 'Прием минеральной лечебно-столовой воды (в т.ч. «Белокурихинская Восточная №2») по индивидуальной схеме.',
            'benefit'     => 'Нормализует работу ЖКТ, улучшает углеводный и липидный обмен, способствует детоксикации.',
            'status'      => 'Входит в базовую путёвку',
        ],
        [
            'title'       => 'Аппаратная физиотерапия и рефлексотерапия',
            'description' => 'Магнитотерапия, лазеротерапия, электрофорез лекарственных средств, иглорефлексотерапия (акупунктура).',
            'benefit'     => 'Снимают воспаление, улучшают проводимость нервных волокон при диабетических нейропатиях, стимулируют иммунитет.',
            'status'      => 'Входит в базовую путёвку',
        ],
        [
            'title'       => 'Грязелечение и теплолечение',
            'description' => 'Аппликации с лечебной грязью, парафином, бишофитом, димексидом, фитобочки с алтайскими травами.',
            'benefit'     => 'Оказывают глубокое прогревающее и противовоспалительное действие, улучшают трофику тканей.',
            'status'      => 'Входит в базовую путёвку',
        ],
        [
            'title'       => 'Климатотерапия и терренкур',
            'description' => 'Дозированные прогулки на горном воздухе, солнечные и воздушные ванны, спелеотерапия (солевые пещеры).',
            'benefit'     => 'Повышают общий тонус организма, улучшают оксигенацию тканей и устойчивость к внешним стрессам.',
            'status'      => 'Входит в базовую путёвку',
        ],
    ];
}
?>

<section id="direction-methods" class="bads-section bads-section--md" style="background: var(--color-surface-container-low, #fbfcfd);">
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
            <?php foreach ($methods as $method): ?>
                <?php
                $m_title   = $method['title'] ?? '';
                $m_desc    = $method['description'] ?? '';
                $m_benefit = $method['benefit'] ?? '';
                $m_status  = $method['status'] ?? 'Входит в базовую путёвку';
                ?>
                <div class="bads-card bads-card--bordered bads-card--padding-lg" style="display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-md); background: #ffffff;">
                    <div class="bads-stack bads-stack--sm">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-xs); flex-wrap: wrap;">
                            <h3 class="bads-title bads-title--h4" style="margin: 0; font-size: 1.2rem; color: var(--color-text-primary);">
                                <?= esc_html($m_title); ?>
                            </h3>
                            <span class="bads-badge bads-badge--primary" style="font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: var(--radius-pill); white-space: nowrap;">
                                ✓ <?= esc_html($m_status); ?>
                            </span>
                        </div>

                        <p style="margin: 0; color: var(--color-text-secondary); font-size: 14.5px; line-height: 1.6;">
                            <?= esc_html($m_desc); ?>
                        </p>

                        <?php if ($m_benefit): ?>
                            <div style="padding: var(--space-sm) var(--space-md); background: rgba(34, 197, 94, 0.06); border-left: 3px solid #16a34a; border-radius: 0 var(--radius-sm) var(--radius-sm) 0; margin-top: var(--space-xs);">
                                <span style="font-size: 13px; font-weight: 700; color: #15803d; display: block; margin-bottom: 2px;">Лечебный эффект:</span>
                                <span style="font-size: 13.5px; color: var(--color-text-primary); line-height: 1.5;"><?= esc_html($m_benefit); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
