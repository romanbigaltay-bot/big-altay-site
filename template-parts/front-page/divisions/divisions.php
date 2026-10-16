<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Front Page Divisions Block (Экосистема подразделений и проектов)
 * Path: template-parts/front-page/divisions/divisions.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$divisions = [
    [
        'id'          => 'antique',
        'kicker'      => 'Культура & Ремесла',
        'title'       => 'Антикварная ярмарка',
        'subtitle'    => 'Живая история Алтая и павильон мастеров',
        'description' => 'Подлинные сибирские раритеты от 50 лет, экспедиционные находки из дальних сел Алтая, а также бесплатная павильонная площадка для местных мастеров и художников.',
        'image'       => 'https://big-altay.ru/wp-content/uploads/2026/08/img_4402-scaled-1-1800x1000.jpg',
        'alt'         => 'Антикварная ярмарка и лавка Белокурихи',
        'features'    => [
            'Раритеты от 50 лет: самовары, монеты Екатерины II, утварь',
            'Бесплатный павильон для 30 мастеров и ремесленников',
            'г. Белокуриха, ул. Объездная, 45 (гастробар «Барон»)',
        ],
        'link'        => '/divisions/#antique',
        'link_label'  => 'Узнать подробнее',
    ],
    [
        'id'          => 'honey',
        'kicker'      => 'Гастрономия & Здоровье',
        'title'       => 'Центр сибирского мёда',
        'subtitle'    => 'Подлинное «Алтайское золото» с собственных пасек',
        'description' => 'Дегустационный дом натурального алтайского мёда с диких медоносов тайги и предгорий, чай из самовара на горных травах и практические мастер-классы от пчеловодов.',
        'image'       => 'https://big-altay.ru/wp-content/uploads/2026/08/img_6072-scaled-1-1800x1000.jpg',
        'alt'         => 'Центр сибирского мёда в Белокурихе',
        'features'    => [
            'Редкие сорта: дягилевый, донниковый, высокогорный таёжный',
            'Свежий мёд в сотах прямо с пасек без сиропа и примесей',
            'Дегустационный дом и экспресс-мастер-классы от экспертов',
        ],
        'link'        => '/divisions/#honey',
        'link_label'  => 'Узнать подробнее',
    ],
    [
        'id'          => 'ty-priroda',
        'kicker'      => 'Стиль & Осознанный отдых',
        'title'       => 'Бутики бренда «Ты – природа»',
        'subtitle'    => 'Курортная одежда, меринос и полезные сувениры',
        'description' => 'Пространство осознанного шопинга: авторская коллекция из 100% хлопка, согревающая терапевтическая серия из шерсти мериноса для процедур и подарки с душой Алтая.',
        'image'       => 'https://big-altay.ru/wp-content/uploads/2026/09/gsh_0727-scaled-1-1800x1000.jpg',
        'alt'         => 'Бутики сувенирного бренда Ты природа',
        'features'    => [
            '100% шерсть мериноса: защита после санаторных процедур',
            'Стильная базовая одежда из хлопка и косметика «Долголетие»',
            '3 бутика: санатории «Белокуриха», «Сибирь», «Катунь»',
        ],
        'link'        => '/divisions/#ty-priroda',
        'link_label'  => 'Узнать подробнее',
    ],
];
?>

<section class="bads-section bads-section--lg bads-divisions" id="divisions">
    <div class="bads-container">
        <div class="bads-stack bads-stack--xl">

            <!-- Заголовочная секция блока -->
            <div class="bads-stack bads-stack--sm u-text-center">
                <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.08em; font-size: 0.8125rem;">
                    Экосистема гостеприимства
                </span>

                <?php
                get_template_part('template-parts/ui/title', null, [
                    'title'           => 'Проекты «Большой Алтай»',
                    'level'           => 'h2',
                    'align'           => 'center',
                    'divider'         => true,
                    'divider_variant' => 'primary',
                    'divider_width'   => '72px',
                ]);
                ?>

                <p class="u-text-muted" style="max-width: 760px; margin: 0 auto; font-size: 1.0625rem; line-height: 1.55;">
                    Помимо санаторного лечения и путешествий, мы развиваем собственные знаковые пространства в Белокурихе: от коллекций сибирских древностей и редких сортов мёда до авторского курортного бренда одежды и подарков.
                </p>
            </div>

            <!-- Сетка карточек 3 подразделений -->
            <div class="bads-grid bads-grid--3 bads-grid--gap-md">
                <?php foreach ($divisions as $division) : ?>
                    <article class="bads-card bads-card--glass bads-card--hover-zoom bads-card--radius-lg">
                        
                        <!-- Превью изображение -->
                        <div class="bads-frame bads-frame--ratio bads-card__media">
                            <a href="<?= esc_url($division['link']); ?>" aria-label="<?= esc_attr($division['title']); ?>" tabindex="-1">
                                <img
                                    src="<?= esc_url($division['image']); ?>"
                                    alt="<?= esc_attr($division['alt']); ?>"
                                    class="bads-media__image"
                                    loading="lazy"
                                >
                            </a>
                        </div>

                        <!-- Тело карточки -->
                        <div class="bads-card__body bads-stack bads-stack--md bads-card--padding-lg bads-stack--fill">
                            
                            <div class="bads-stack bads-stack--xs">
                                <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.06em; font-size: 0.75rem; color: var(--color-primary);">
                                    <?= esc_html($division['kicker']); ?>
                                </span>

                                <a href="<?= esc_url($division['link']); ?>" class="bads-card__title bads-card__title--hover-primary" style="text-decoration: none; color: inherit;">
                                    <?php
                                    get_template_part('template-parts/ui/title', null, [
                                        'title' => $division['title'],
                                        'level' => 'h3',
                                        'size'  => 'h4',
                                    ]);
                                    ?>
                                </a>

                                <div class="u-text-muted" style="font-size: 0.875rem; font-weight: 500;">
                                    <?= esc_html($division['subtitle']); ?>
                                </div>
                            </div>

                            <p class="u-text-muted" style="font-size: 0.9375rem; line-height: 1.5; margin: 0;">
                                <?= esc_html($division['description']); ?>
                            </p>

                            <!-- Ключевые преимущества подразделения -->
                            <div style="margin-top: auto; padding-top: var(--space-xs);">
                                <?php
                                get_template_part('template-parts/ui/list', null, [
                                    'items'   => $division['features'],
                                    'variant' => 'check',
                                ]);
                                ?>
                            </div>

                            <!-- Футер карточки -->
                            <div class="bads-card__footer" style="padding-top: var(--space-sm); border-top: 1px dashed rgba(var(--brand-primary-rgb), 0.15);">
                                <?php
                                get_template_part('template-parts/ui/button', null, [
                                    'text'          => $division['link_label'],
                                    'url'           => $division['link'],
                                    'type'          => 'link',
                                    'variant'       => 'link',
                                    'size'          => 'sm',
                                    'icon'          => 'navigation/arrow-right',
                                    'icon_position' => 'right',
                                ]);
                                ?>
                            </div>

                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Нижняя панель действий -->
            <div class="bads-cluster u-justify-center u-items-center" style="padding-top: var(--space-sm);">
                <?php
                get_template_part('template-parts/ui/button', null, [
                    'text'          => 'Узнать подробнее',
                    'url'           => '/divisions/',
                    'type'          => 'link',
                    'variant'       => 'primary',
                    'size'          => 'lg',
                    'icon'          => 'navigation/arrow-right',
                    'icon_position' => 'right',
                ]);
                ?>
            </div>

        </div>
    </div>
</section>
