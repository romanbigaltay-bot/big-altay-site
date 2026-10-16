<?php
if (!defined('ABSPATH')) { exit; }
?>
<section class="bads-section bads-section--lg" id="lead-form">
    <div class="bads-container">
        <div class="bads-card bads-card--glass bads-card--padding-xl" style="background-color: var(--color-surface-hover);">
            <div class="bads-split bads-split--50-50 bads-split--center bads-split--gap-xl">
                
                <div class="bads-stack bads-stack--lg">
                    <?php
                    get_template_part('template-parts/ui/title', null, [
                        'title'    => 'Не знаете, какой санаторий выбрать?',
                        'subtitle' => 'Оставьте заявку, и наш врач-курортолог бесплатно проконсультирует вас, изучит показания и подберет 2-3 оптимальных варианта.',
                        'level'    => 'h2',
                        'size'     => 'h3',
                    ]);
                    ?>
                    <div class="bads-list bads-list--compact">
                        <div class="bads-list__item">
                            <span class="bads-list__icon" style="color: var(--brand-success);">✓</span>
                            <span class="bads-list__text">Подбор по диагнозу и бюджету</span>
                        </div>
                        <div class="bads-list__item">
                            <span class="bads-list__icon" style="color: var(--brand-success);">✓</span>
                            <span class="bads-list__text">Проверка наличия мест за 10 минут</span>
                        </div>
                        <div class="bads-list__item">
                            <span class="bads-list__icon" style="color: var(--brand-success);">✓</span>
                            <span class="bads-list__text">Цены без наценок (официальный прайс)</span>
                        </div>
                    </div>
                </div>

                <div class="bads-card bads-card--padding-lg" style="background: var(--color-surface); border: 1px solid var(--color-border); border-radius: var(--radius-lg);">
                    <div class="bads-stack bads-stack--md">
                        <!-- Здесь будет вызов реальной формы B24 -->
                        <?php
                        get_template_part('components/forms/b24-form-compact', null, [
                            'form_id'        => 'treatment-selection',
                            'button_text'    => 'Подобрать санаторий',
                            'success_target' => 'treatment-selection-form',
                            'success_url'    => '/thank-you/lechenie/',
                        ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
