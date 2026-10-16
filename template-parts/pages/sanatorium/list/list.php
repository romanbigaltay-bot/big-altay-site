<?php
/**
 * ============================================================================
 * Treatments
 * List
 * ============================================================================
 */

$treatments = [

    [
        'title' => 'Опорно-двигательный аппарат',
        'text'  => 'Лечение заболеваний позвоночника, суставов, последствий травм и хронических болевых синдромов.',
        'badge' => '120+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Сердечно-сосудистая система',
        'text'  => 'Комплексные программы восстановления при заболеваниях сердца и сосудов.',
        'badge' => '95+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Нервная система',
        'text'  => 'Реабилитация после стрессов, хронической усталости и неврологических заболеваний.',
        'badge' => '80+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Органы дыхания',
        'text'  => 'Лечение хронических заболеваний дыхательной системы и восстановление после болезней.',
        'badge' => '70+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Желудочно-кишечный тракт',
        'text'  => 'Современные методы санаторно-курортного лечения заболеваний пищеварительной системы.',
        'badge' => '110+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Эндокринная система',
        'text'  => 'Программы восстановления обмена веществ и лечения эндокринных заболеваний.',
        'badge' => '60+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Гинекология',
        'text'  => 'Комплексное лечение и профилактика заболеваний женской репродуктивной системы.',
        'badge' => '75+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Урология',
        'text'  => 'Лечение хронических заболеваний мочеполовой системы современными методиками.',
        'badge' => '65+ процедур',
        'url'   => '#',
    ],

    [
        'title' => 'Общее оздоровление',
        'text'  => 'Программы укрепления иммунитета, восстановления сил и профилактики заболеваний.',
        'badge' => '150+ процедур',
        'url'   => '#',
    ],

];

?>

<section
    id="treatments-list"
    class="bads-section bads-section--lg">

    <div class="bads-container">

        <div class="bads-stack bads-stack--xl">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title'    => 'Выберите направление лечения',
                    'subtitle' => 'Все программы лечения санаториев Белокурихи сгруппированы по основным медицинским направлениям.',
                    'level'    => 'h2',
                ]
            );
            ?>

            <div class="bads-grid bads-grid--3">

                <?php foreach ($treatments as $item) : ?>

                    <div class="bads-card bads-card--glass bads-card--padding-xl">

                        <div class="bads-stack bads-stack--lg">

                            <div class="bads-cluster bads-cluster--between bads-cluster--top">

                                <?php
                                get_template_part(
                                    'template-parts/ui/title',
                                    null,
                                    [
                                        'title' => $item['title'],
                                        'level' => 'h4',
                                    ]
                                );
                                ?>

                                <?php
                                get_template_part(
                                    'template-parts/ui/badge',
                                    null,
                                    [
                                        'text'    => $item['badge'],
                                        'variant' => 'success',
                                    ]
                                );
                                ?>

                            </div>

                            <div class="bads-content">

                                <p>

                                    <?= esc_html($item['text']); ?>

                                </p>

                            </div>

                            <?php
                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'          => 'Подробнее',
                                    'url'           => $item['url'],
                                    'variant'       => 'outline',
                                    'icon'          => 'navigation/arrow-right',
                                    'icon_position' => 'right',
                                ]
                            );
                            ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>