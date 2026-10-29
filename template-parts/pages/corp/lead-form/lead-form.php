<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Page / Corp / Lead Form
 * ============================================================================
 *
 * Блок заявки «Хотите узнать больше?»: контакты + BADS-форма (Bitrix24 AJAX).
 *
 * Использует:
 * - BADS Section / Container
 * - BADS Split
 * - BADS Title
 * - BADS List
 * - components/forms/b24-form (AJAX-лид в Bitrix24, без CF7)
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="anchor"><span id="lead-form"></span></section>

<section class="bads-section bads-section--lg bads-corp-lead">

    <div class="bads-container">

        <div class="bads-split bads-split--wide bads-split--center">

            <div>

                <div class="bads-stack bads-stack--md bads-stack--start">

                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title'           => 'Хотите узнать больше?',
                            'level'           => 'h2',
                            'size'            => 'h2',
                            'divider'         => true,
                            'divider_variant' => 'primary',
                        ]
                    );
                    ?>

                    <?php
                    get_template_part(
                        'template-parts/ui/list',
                        null,
                        [
                            'items' => [
                                'Лично, обратившись в курсовочное бюро: г. Белокуриха, переулок Спортивный д. 5, пом. Н1.',
                                'По телефонам: 8 (800) 500-07-34, 8 (383) 389-39-83.',
                                'В мессенджерах: +7 (960)-948-20-69 Telegram, WhatsApp.',
                                'По электронной почте: info@big-altay.ru.',
                                'Заполнив форму обратной связи на сайте.',
                            ],
                            'variant' => 'check',
                        ]
                    );
                    ?>

                </div>

            </div>

            <div>

                <?php
                get_template_part(
                    'components/forms/b24-form',
                    null,
                    [
                        'form_id'         => 'corp-lead',
                        'form_title'      => 'Заявка на корпоративный отдых (страница «Корпоративный отдых»)',
                        'button_text'     => 'Оставить заявку на расчёт',
                        'success_target'  => 'corp-lead-form',
                        'privacy_variant' => 'multiline',
                    ]
                );
                ?>

            </div>

        </div>

    </div>

</section>
