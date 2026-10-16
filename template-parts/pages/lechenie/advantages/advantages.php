<?php
if (!defined('ABSPATH')) { exit; }

// Мок-данные. В будущем могут тянуться из ACF Repeater поля
$advantages = [
    [
        'icon'  => '🌿',
        'title' => 'Природные факторы',
        'text'  => 'Уникальные радоновые источники, целебные грязи и горный климат Белокурихи работают эффективнее многих лекарств.',
    ],
    [
        'icon'  => '⚕️',
        'title' => 'Сильная мед. база',
        'text'  => 'Санатории оснащены новейшим диагностическим и физиотерапевтическим оборудованием мирового уровня.',
    ],
    [
        'icon'  => '👨‍⚕️',
        'title' => 'Врачи-эксперты',
        'text'  => 'Консультации и лечение проводят врачи высшей категории, кандидаты и доктора медицинских наук.',
    ],
    [
        'icon'  => '🎯',
        'title' => 'Персональный подход',
        'text'  => 'Программа процедур составляется строго индивидуально на основе вашей санаторно-курортной карты.',
    ]
];
?>
<section class="bads-section bads-section--lg" id="advantages">
    <div class="bads-container">
        <div class="bads-stack bads-stack--xl">
            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'    => 'Почему лечение в Белокурихе настолько эффективно?',
                'subtitle' => 'Синергия алтайской природы и достижений современной медицины.',
                'level'    => 'h2',
                'divider'  => true,
            ]);
            ?>
            <div class="bads-grid bads-grid--4 bads-grid--gap-md">
                <?php foreach ($advantages as $adv) : ?>
                    <?php get_template_part('template-parts/components/cards/feature-card', null, $adv); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
