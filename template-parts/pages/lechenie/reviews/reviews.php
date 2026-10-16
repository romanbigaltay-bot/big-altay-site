<?php
if (!defined('ABSPATH')) { exit; }

$reviews = [
    [
        'author' => 'Елена Смирнова',
        'date'   => 'Октябрь 2025',
        'rating' => 5,
        'text'   => 'Отправляла маму на лечение суставов. Эффект потрясающий! Радоновые ванны сотворили чудо, боли прошли, подвижность восстановилась. Огромное спасибо туроператору за идеальный подбор санатория.',
    ],
    [
        'author' => 'Михаил В.',
        'date'   => 'Август 2025',
        'rating' => 5,
        'text'   => 'Проходил программу детокса и лечения ЖКТ. Отличная медицинская база, всё чётко по расписанию. Очень порадовал сервис и питание. Обязательно вернусь через год.',
    ],
    [
        'author' => 'Семья Ковалевых',
        'date'   => 'Июнь 2025',
        'rating' => 5,
        'text'   => 'Приехали в Белокуриху впервые по совету менеджеров Большого Алтая. Уровень санаториев приятно удивил — ничем не уступает европейским курортам, а природа даже лучше.',
    ]
];
?>
<section class="bads-section bads-section--lg" id="reviews">
    <div class="bads-container">
        <div class="bads-stack bads-stack--xl">
            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'    => 'Отзывы наших клиентов',
                'subtitle' => 'Реальные истории людей, которые доверили нам организацию своего лечения.',
                'level'    => 'h2',
                'divider'  => true,
            ]);
            ?>
            <div class="bads-grid bads-grid--3 bads-grid--gap-md">
                <?php foreach ($reviews as $review) : ?>
                    <?php get_template_part('template-parts/components/cards/review-card', null, $review); ?>
                <?php endforeach; ?>
            </div>
            <div class="bads-cluster bads-cluster--center">
                <?php
                get_template_part('template-parts/ui/button', null, [
                    'text'    => 'Читать все отзывы',
                    'url'     => '/reviews/',
                    'variant' => 'outline',
                ]);
                ?>
            </div>
        </div>
    </div>
</section>
