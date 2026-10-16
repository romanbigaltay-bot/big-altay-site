<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 9: FAQ
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$title = get_field('direction_faq_title') ?: 'Часто задаваемые вопросы';
$subtitle = get_field('direction_faq_subtitle') ?: 'Ответы на популярные вопросы о лечении и пребывании в санаториях Белокурихи';

$faq_items = get_field('direction_faq');

if (empty($faq_items) || !is_array($faq_items)) {
    $faq_items = [
        [
            'question' => 'Какие документы необходимы для заезда на лечение?',
            'answer'   => 'Обязательно наличие паспорта, путевки/ваучера и оформленной санаторно-курортной карты (форма 072/у для взрослых, 076/у для детей). Также рекомендуем взять с собой имеющиеся медицинские выписки и результаты обследований.',
        ],
        [
            'question' => 'Сколько длится оптимальный курс лечения?',
            'answer'   => 'Классический терапевтический курс составляет от 14 до 21 дня. Это позволяет организму пройти период адаптации, получить полный объем бальнеологических процедур и закрепить лечебный эффект.',
        ],
        [
            'question' => 'Обязательно ли заболевание должно быть в стадии компенсации?',
            'answer'   => 'Да, это строгое медицинское требование для всех санаторно-курортных учреждений. При обострении хронических заболеваний или в острой фазе курортное лечение противопоказано.',
        ],
        [
            'question' => 'Входят ли лечебные процедуры в стоимость путевки?',
            'answer'   => 'Да, в базовую лечебную путевку уже включен комплекс процедур, назначенных лечащим врачом с учетом профиля и индивидуальных показаний, а также проживание и 3-разовое сбалансированное питание.',
        ],
    ];
}
?>

<section id="direction-faq" class="bads-section bads-section--md">
    <div class="bads-container bads-container--md">
        <div class="bads-stack bads-stack--xl">

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

            <div class="bads-stack bads-stack--sm">
                <?php foreach ($faq_items as $index => $item): ?>
                    <?php
                    $q = $item['question'] ?? ($item['q'] ?? '');
                    $a = $item['answer'] ?? ($item['a'] ?? '');
                    if (!$q) continue;

                    get_template_part(
                        'template-parts/ui/accordion',
                        null,
                        [
                            'id'      => 'direction-faq-' . $index,
                            'trigger' => $q,
                            'title'   => $q,
                            'content' => '<div class="bads-content"><p>' . nl2br(esc_html($a)) . '</p></div>',
                            'open'    => $index === 0,
                        ]
                    );
                    ?>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>