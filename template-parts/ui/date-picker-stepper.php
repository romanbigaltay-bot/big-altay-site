<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Date Picker Stepper (3-Step: Year -> Month -> Day + Presets)
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$years = [2026, 2027, 2028, 2029, 2030];
$months = [
    ['num' => 1, 'name' => 'Январь', 'short' => 'Янв'],
    ['num' => 2, 'name' => 'Февраль', 'short' => 'Фев'],
    ['num' => 3, 'name' => 'Март', 'short' => 'Мар'],
    ['num' => 4, 'name' => 'Апрель', 'short' => 'Апр'],
    ['num' => 5, 'name' => 'Май', 'short' => 'Май'],
    ['num' => 6, 'name' => 'Июнь', 'short' => 'Июн'],
    ['num' => 7, 'name' => 'Июль', 'short' => 'Июл'],
    ['num' => 8, 'name' => 'Август', 'short' => 'Авг'],
    ['num' => 9, 'name' => 'Сентябрь', 'short' => 'Сен'],
    ['num' => 10, 'name' => 'Октябрь', 'short' => 'Окт'],
    ['num' => 11, 'name' => 'Ноябрь', 'short' => 'Ноя'],
    ['num' => 12, 'name' => 'Декабрь', 'short' => 'Дек'],
];
?>

<div class="bads-date-stepper" data-bads-date-stepper>

    <!-- 1. Выбор варианта даты (Радио-кнопки BADS) -->
    <div class="bads-date-stepper__options bads-date-stepper__view bads-date-stepper__view--active bads-radio-select-list" data-date-options>
        <?php
        get_template_part(
            'template-parts/ui/radio',
            null,
            [
                'name'    => 'date_option_choice',
                'id'      => 'date-opt-soon',
                'value'   => 'В ближайшее время',
                'label'   => 'В ближайшее время',
                'checked' => true,
                'class'   => 'bads-date-radio-option',
            ]
        );

        get_template_part(
            'template-parts/ui/radio',
            null,
            [
                'name'    => 'date_option_choice',
                'id'      => 'date-opt-benefit',
                'value'   => 'Максимальная выгода',
                'label'   => 'Максимальная выгода',
                'checked' => false,
                'class'   => 'bads-date-radio-option',
            ]
        );

        get_template_part(
            'template-parts/ui/radio',
            null,
            [
                'name'    => 'date_option_choice',
                'id'      => 'date-opt-custom',
                'value'   => 'custom',
                'label'   => 'Конкретная дата',
                'checked' => false,
                'class'   => 'bads-date-radio-option bads-date-radio-option--custom',
            ]
        );
        ?>
    </div>

    <!-- 2. Шаг 1: Выбор года и месяца (Сетка года + месяцев) -->
    <div class="bads-date-step bads-date-stepper__view bads-date-step--year-month" data-step="1" hidden>
        <div class="bads-date-step__header">
            <button type="button" class="bads-date-step__back" data-back-to="options" aria-label="Назад к выбору варианта">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
                <span>К вариантам</span>
            </button>
            <span class="bads-date-step__title">Год и месяц</span>
        </div>

        <div class="bads-date-step__section-label">Выберите год:</div>
        <div class="bads-date-grid bads-date-grid--years">
            <?php foreach ($years as $y) : ?>
                <button 
                    type="button" 
                    class="bads-date-chip bads-date-chip--year <?= $y === 2026 ? 'bads-date-chip--selected' : ''; ?>" 
                    data-year="<?= esc_attr($y); ?>"
                >
                    <?= esc_html($y); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div class="bads-date-step__section-label" style="margin-top: 6px;">Выберите месяц:</div>
        <div class="bads-date-grid bads-date-grid--months">
            <?php foreach ($months as $m) : ?>
                <button 
                    type="button" 
                    class="bads-date-chip bads-date-chip--month" 
                    data-month-num="<?= esc_attr($m['num']); ?>" 
                    data-month-name="<?= esc_attr($m['name']); ?>"
                >
                    <?= esc_html($m['short']); ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- 3. Шаг 2: Выбор числа (Календарная сетка выбранного месяца и года) -->
    <div class="bads-date-step bads-date-stepper__view bads-date-step--day" data-step="2" hidden>
        <div class="bads-date-step__header">
            <button type="button" class="bads-date-step__back" data-back-to="1" aria-label="Назад к выбору года и месяца">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
                <span class="bads-date-step__back-month-year">Август 2026</span>
            </button>
            <span class="bads-date-step__title">Выберите число</span>
        </div>
        <div class="bads-date-weekdays">
            <span>Пн</span><span>Вт</span><span>Ср</span><span>Чт</span><span>Пт</span><span>Сб</span><span>Вс</span>
        </div>
        <div class="bads-date-grid bads-date-grid--days" data-days-container>
            <!-- Сетка дней генерируется через JS -->
        </div>
    </div>

</div>
