<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 5: Treatment Programs
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_programs_title') ?: 'Программы лечения';
$subtitle = get_field('direction_programs_subtitle') ?: 'Точный перечень процедур определяется врачом на основании медицинских документов. Ниже указаны рекомендуемые стандарты для профиля.';

$programs = get_field('direction_programs');

if (empty($programs) || !is_array($programs)) {
    $programs = [
        [
            'duration'    => '14 дней',
            'title'       => 'Базовый оздоровительный курс',
            'badge'       => 'Популярный выбор',
            'description' => 'Оптимальная длительность для первичной адаптации, прохождения основных диагностических и бальнеологических процедур.',
            'features'    => [
                'Консультация и наблюдение врача-куратора',
                'Базовый курс бальнеотерапии и минеральных ванн',
                'Аппаратная физиотерапия и ЛФК',
                'Специализированное диетическое питание',
                'Питьевое лечение минеральными водами',
            ],
            'price_note'  => 'Рассчитывается индивидуально в зависимости от выбранного санатория',
        ],
        [
            'duration'    => '21 день',
            'title'       => 'Углублённый терапевтический курс',
            'badge'       => 'Рекомендуемый медицинский стандарт',
            'is_featured' => true,
            'description' => 'Медицинский стандарт для эндокринологических и хронических профилей. Позволяет закрепить эффект и достичь стойкой ремиссии.',
            'features'    => [
                'Все опции базового курса',
                'Расширенный комплекс грязелечения и теплолечения',
                'Курс лечебного массажа и рефлексотерапии',
                'Углубленная лабораторная диагностика и мониторинг',
                'Персональная программа поддержки после выезда',
            ],
            'price_note'  => 'Рассчитывается индивидуально в зависимости от выбранного санатория',
        ],
    ];
}
?>

<section id="direction-programs" class="bads-section bads-section--md" style="background: var(--color-surface-container-low, #fbfcfd);">
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

        <div class="bads-grid bads-grid--2 bads-grid--gap-lg" style="margin-top: var(--space-xl);">
            <?php foreach ($programs as $prog): ?>
                <?php
                $p_dur      = $prog['duration'] ?? '';
                $p_title    = $prog['title'] ?? '';
                $p_badge    = $prog['badge'] ?? '';
                $p_desc     = $prog['description'] ?? '';
                $p_features = (array) ($prog['features'] ?? []);
                $p_price    = $prog['price_note'] ?? 'По запросу';
                $is_feat    = !empty($prog['is_featured']);
                ?>
                <div class="bads-card <?= $is_feat ? 'bads-card--bordered' : 'bads-card--bordered'; ?>" 
                     style="display: flex; flex-direction: column; justify-content: space-between; border-radius: var(--radius-lg); padding: var(--space-xl); background: #ffffff; position: relative; border-color: <?= $is_feat ? 'var(--color-primary)' : 'var(--color-border, rgba(0,0,0,0.08))'; ?>; box-shadow: <?= $is_feat ? 'var(--shadow-md)' : 'var(--shadow-sm)'; ?>;">
                    
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-sm); flex-wrap: wrap; gap: 8px;">
                            <span style="font-size: 1.5rem; font-weight: 800; color: var(--color-primary);">
                                <?= esc_html($p_dur); ?>
                            </span>
                            <?php if ($p_badge): ?>
                                <span class="bads-badge <?= $is_feat ? 'bads-badge--primary' : 'bads-badge--neutral'; ?>" style="font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: var(--radius-pill);">
                                    <?= esc_html($p_badge); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3 class="bads-title bads-title--h3" style="font-size: 1.35rem; margin: 0 0 var(--space-xs) 0; color: var(--color-text-primary);">
                            <?= esc_html($p_title); ?>
                        </h3>

                        <p style="color: var(--color-text-secondary); font-size: 14.5px; line-height: 1.6; margin: 0 0 var(--space-md) 0;">
                            <?= esc_html($p_desc); ?>
                        </p>

                        <div style="font-size: 13px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--space-xs);">
                            Что включено в курс:
                        </div>

                        <ul style="margin: 0 0 var(--space-lg) 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 8px;">
                            <?php foreach ($p_features as $feat): ?>
                                <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 14px; line-height: 1.5; color: var(--color-text-primary);">
                                    <span style="color: var(--color-primary); font-weight: bold; flex-shrink: 0;">✓</span>
                                    <span><?= esc_html(is_array($feat) ? ($feat['text'] ?? '') : $feat); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div style="padding-top: var(--space-md); border-top: 1px solid var(--color-border, rgba(0,0,0,0.06)); display: flex; flex-direction: column; gap: var(--space-sm);">
                        <div style="font-size: 13px; color: var(--color-text-secondary);">
                            <span style="font-weight: 600; color: var(--color-text-primary);">Стоимость:</span> <?= esc_html($p_price); ?>
                        </div>
                        <a href="#direction-form" class="bads-button <?= $is_feat ? 'bads-button--primary' : 'bads-button--secondary'; ?> bads-button--full" style="text-decoration: none; text-align: center;">
                            Подобрать путёвку на <?= esc_html($p_dur); ?>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
