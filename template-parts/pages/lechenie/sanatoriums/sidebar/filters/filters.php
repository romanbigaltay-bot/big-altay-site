<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * Big Altay
 * Sanatorium Filters (BADS Accordion Slots)
 * ============================================================================
 */

$filters = [
    [
        'id'      => 'price',
        'label'   => 'Стоимость проживания',
        'value'   => 'до 8 000 ₽',
        'content' => '
            <div class="bads-range">
                <div class="bads-range__header">
                    <span>от 3 500 ₽</span>
                    <span class="bads-range__value">до <span id="price-slider-display">8 000</span> ₽</span>
                </div>
                <input 
                    type="range" 
                    id="bads-filter-price"
                    min="3500" 
                    max="15000" 
                    step="100" 
                    value="8000" 
                    class="bads-range__control"
                >
                <div class="bads-range__footer">
                    <span>3 500 ₽</span>
                    <span>15 000 ₽</span>
                </div>
            </div>
        ',
    ],
    [
        'id'      => 'stars',
        'label'   => 'Категория санатория',
        'value'   => '4★, 5★',
        'content' => '
            <div class="bads-stack bads-stack--xs">
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-star" value="5" checked>
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">5 Звезд ⭐⭐⭐⭐⭐</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-star" value="4" checked>
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">4 Звезды ⭐⭐⭐⭐</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-star" value="3" checked>
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">3 Звезды ⭐⭐⭐</span>
                    </label>
                </div>
            </div>
        ',
    ],
    [
        'id'      => 'treatments',
        'label'   => 'Профиль лечения',
        'value'   => 'Сердечно-сосудистая система, нервная система, опорно-двигательный аппарат',
        'content' => '
            <div class="bads-stack bads-stack--xs" style="max-height: 200px; overflow-y: auto; padding-right: 4px;">
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Опорно-двигательный аппарат">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Опорно-двигательный аппарат</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Сердечно-сосудистая система">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Сердечно-сосудистая система</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Нервная система">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Нервная система</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Эндокринная система">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Эндокринная система</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Гинекология">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Гинекология</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Урология">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Урология</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Кожа и подкожная клетчатка">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Кожа и подкожная клетчатка</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Органы дыхания">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Органы дыхания</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-treatment" value="Желудочно-кишечный тракт">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Желудочно-кишечный тракт</span>
                    </label>
                </div>
            </div>
        ',
    ],
    [
        'id'      => 'infra',
        'label'   => 'Инфраструктура',
        'value'   => 'Бассейн, SPA, лечебная база',
        'content' => '
            <div class="bads-stack bads-stack--xs">
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="Крытый бассейн (25м)">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Крытый бассейн (25м)</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="Радонолечебница">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Радонолечебница</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="СПА-комплекс и сауна">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">СПА-комплекс и сауна</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="Открытый бассейн с подогревом">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Открытый бассейн с подогревом</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="Детская комната">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Детская комната / анимация</span>
                    </label>
                </div>
                <div class="bads-checkbox">
                    <label class="bads-checkbox__label">
                        <input type="checkbox" class="bads-checkbox__control bads-filter-infra" value="Собственный парк">
                        <span class="bads-checkbox__box"></span>
                        <span class="bads-checkbox__text">Собственный парк / терренкур</span>
                    </label>
                </div>
            </div>
        ',
    ],
    [
        'id'      => 'location',
        'label'   => 'Расположение',
        'value'   => 'Курортная зона',
        'content' => '
            <div class="bads-stack bads-stack--xs">
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_loc" value="all" class="bads-radio__control" checked>
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Вся курортная зона</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_loc" value="Центр курортной зоны" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Центр курортной зоны</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_loc" value="У канатной дороги" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">У канатной дороги (Церковка)</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_loc" value="В лесном массиве" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">В тихом лесном массиве</span>
                    </label>
                </div>
            </div>
        ',
    ],
    [
        'id'      => 'food',
        'label'   => 'Тип питания',
        'value'   => 'Шведский стол',
        'content' => '
            <div class="bads-stack bads-stack--xs">
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_food" value="all" class="bads-radio__control" checked>
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Любой тип питания</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_food" value="Шведский стол" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Шведский стол (3-разовое)</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_food" value="Заказное" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Заказное диетическое меню</span>
                    </label>
                </div>
                <div class="bads-radio">
                    <label class="bads-radio__label">
                        <input type="radio" name="filter_food" value="завтрак" class="bads-radio__control">
                        <span class="bads-radio__circle"></span>
                        <span class="bads-radio__text">Только завтраки (BB)</span>
                    </label>
                </div>
            </div>
        ',
    ],
];

?>

<div class="bads-card bads-card--glass bads-card--padding-lg">

    <div class="bads-stack bads-stack--sm">

        <?php
        get_template_part(
            'template-parts/ui/title',
            null,
            [
                'title' => 'Фильтры',
                'level' => 'h4',
            ]
        );
        ?>

        <?php foreach ($filters as $filter) : ?>

            <div data-filter-trigger="<?= esc_attr($filter['id']); ?>">
                <?php
                get_template_part(
                    'template-parts/ui/accordion',
                    null,
                    [
                        'trigger' => $filter['label'],
                        'value'   => $filter['value'],
                        'content' => $filter['content'],
                        'variant' => 'compact',
                    ]
                );
                ?>
            </div>

        <?php endforeach; ?>

    </div>

</div>
