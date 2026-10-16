<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Block 10: Consultation & Individual Case Form
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$form_title = get_field('direction_form_title') 
    ?: 'Остались вопросы или у вас сложный медицинский случай?';
$form_subtitle = get_field('direction_form_subtitle') 
    ?: 'Каждый организм уникален: сопутствующие заболевания, противопоказания или недавние операции требуют индивидуального подбора лечебной базы. Врачи-курортологи и эксперты «Большого Алтая» бесплатно разберут вашу ситуацию и подберут оптимальный санаторий.';
$page_topic = get_the_title() ?: 'Санаторно-курортное лечение';
?>

<section id="direction-form" class="bads-section bads-section--xl">
    <div class="bads-container">

        <div class="bads-split bads-split--50-50 bads-split--gap-xl" style="align-items: flex-start;">

            <!-- Левая колонка: Продающий призыв и ценность для пользователя -->
            <div class="bads-stack bads-stack--lg">
                
                <div class="bads-stack bads-stack--sm">
                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title'    => $form_title,
                            'subtitle' => $form_subtitle,
                            'level'    => 'h2',
                            'size'     => 'h2',
                            'divider'  => true,
                        ]
                    );
                    ?>
                </div>

                <!-- Пункты ценности (Что получит пользователь) -->
                <div class="bads-stack bads-stack--md" style="margin-top: 8px;">
                    
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700; font-size: 15px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 2px;">
                                Аудит диагноза и сопутствующих ограничений
                            </div>
                            <div style="font-size: 14px; line-height: 1.5; color: #64748b;">
                                Специалист изучит ваши показания и исключит риски обострений, подобрав совместимые лечебные факторы (радон, грязи, панты, минеральные воды).
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700; font-size: 15px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 2px;">
                                Индивидуальный подбор санатория с самой подходящей медицинской базой
                            </div>
                            <div style="font-size: 14px; line-height: 1.5; color: #64748b;">
                                Сравним специализированные отделения, квалификацию врачей узкого профиля и техническую оснащенность здравниц.
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700; font-size: 15px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 2px;">
                                Прямые цены и официальное бронирование
                            </div>
                            <div style="font-size: 14px; line-height: 1.5; color: #64748b;">
                                Никаких скрытых наценок: сохраняем все акции здравниц, спецпредложения и гарантируем официальное оформление туроператора.
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-weight: 700; font-size: 15px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <div>
                            <div style="font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 2px;">
                                Ответ без спама в течении суток в удобном для вас формате
                            </div>
                            <div style="font-size: 14px; line-height: 1.5; color: #64748b;">
                                Свяжемся именно тем способом, который вы выберете: голосом по телефону, подробным письмом на почту или оперативно в чате MAX.
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Информационная плашка доверия -->
                <div style="padding: 14px 18px; border-radius: 14px; background: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 12px;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00A0E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                    <span style="font-size: 13px; line-height: 1.4; color: #475569;">
                        Гарантируем конфиденциальность медицинских данных. <br> Официальный туроператор по Алтаю (РТО 026357).
                    </span>
                </div>

            </div>

            <!-- Правая колонка: Фирменная карточка BADS с формой -->
            <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-lg">
                
                <div style="margin-bottom: 22px;">
                    <div style="font-size: 19px; font-weight: 700; color: #0f172a; margin-bottom: 5px;">
                        Форма заявки на индивидуальную консультацию
                    </div>
                    <div style="font-size: 14px; color: #64748b;">
                        Выберите удобный способ связи и опишите ваш вопрос
                    </div>
                </div>

                <?php
                get_template_part(
                    'components/forms/b24-consultation-form',
                    null,
                    [
                        'form_id'        => 'direction-consultation',
                        'button_text'    => 'Получить консультацию специалиста',
                        'success_target' => 'direction-consultation-success',
                        'success_url'    => '/thank-you/lechenie/',
                    ]
                );
                ?>
            </div>

        </div>

    </div>
</section>
