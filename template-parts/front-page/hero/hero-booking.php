<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Front Page Hero: Booking Bar Form (Horizontal Filter & Bitrix24 Integration)
 * ============================================================================
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$page_id = get_the_ID();

$hero_button_text = 'Подобрать отдых';
$hero_max_link = 'https://max.ru/id2203004205_bot';
$hero_directions = [
    'Лечение в санатории',
    'Отдых в санатории',
    'Отдых в Белокурихе',
    'Туры на Алтай',
    'Экскурсии',
    'Трансфер',
];

if (function_exists('get_field')) {
    $custom_btn = get_field('hero_button_text', $page_id) ?: get_field('hero_button_text', 'option');
    if (!empty($custom_btn)) {
        $hero_button_text = $custom_btn;
    }

    $custom_max = get_field('hero_max_link', $page_id) ?: get_field('hero_max_link', 'option');
    if (!empty($custom_max)) {
        $hero_max_link = $custom_max;
    }

    $custom_dir = get_field('hero_directions', $page_id) ?: get_field('hero_directions', 'option');
    if (!empty($custom_dir)) {
        if (is_array($custom_dir)) {
            $hero_directions = array_filter(array_column($custom_dir, 'title') ?: $custom_dir);
        } elseif (is_string($custom_dir)) {
            $lines = array_map('trim', explode("\n", $custom_dir));
            $hero_directions = array_values(array_filter($lines));
        }
    }
}
?>

<!-- Split Divider with Label -->
<?php
get_template_part(
    'template-parts/ui/divider',
    null,
    [
        'variant' => 'light',
        'width'   => '100%',
        'text'    => 'МОДУЛЬ БРОНИРОВАНИЯ',
        'class'   => 'bads-hero__booking-divider',
    ]
);
?>

<!-- ========================================================
     BOOKING BAR (3 Rows: Trip Criteria, Contact & Actions)
     Built 100% on BADS UI Components (Accordion, Input, Textarea)
     ======================================================== -->
<form
    class="lead-form-main bads-hero__booking-form"
    id="b24-form-hero-booking"
    data-form-id="hero-booking"
    data-form-title="Модуль бронирования (Главная страница)"
    data-button-text="<?= esc_attr($hero_button_text); ?>"
    data-success-target="hero-booking-success"
    data-success-url="/thank-you/"
    data-page="<?= esc_url(get_permalink()); ?>"
    data-page-title="Главная - модуль бронирования"
>
    <div class="bads-booking-bar">

        <!-- Row 1, Col 1: Направление / Курорт (BADS Accordion с Floating Overlay и UI Radio) -->
        <div class="bads-field bads-booking-bar__direction">
            <?php
            $default_dir = $hero_directions[0] ?? 'Белокуриха';

            ob_start();
            ?>
            <div class="bads-stack bads-stack--xs bads-radio-select-list">
                <?php foreach ($hero_directions as $idx => $dir) : ?>
                    <?php
                    get_template_part(
                        'template-parts/ui/radio',
                        null,
                        [
                            'id'      => 'hero-dir-radio-' . $idx,
                            'name'    => 'hero_direction_radio',
                            'value'   => $dir,
                            'label'   => $dir,
                            'checked' => ($idx === 0),
                            'class'   => 'bads-radio-select-item',
                        ]
                    );
                    ?>
                <?php endforeach; ?>
            </div>
            <?php
            $direction_content_html = ob_get_clean();

            get_template_part(
                'template-parts/ui/accordion',
                null,
                [
                    'id'          => 'hero-direction-select',
                    'class'       => 'bads-accordion--direction-select bads-accordion--radio-select',
                    'variant'     => 'select',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'prefix_icon' => 'actions/search',
                    'name'        => 'direction',
                    'trigger'     => 'Направление',
                    'value'       => $default_dir,
                    'aria_label'  => 'Выберите направление отдыха',
                    'content'     => $direction_content_html,
                ]
            );
            ?>
        </div>

        <!-- Row 1, Col 2: Дата заезда (BADS Accordion Select с 3-этапным календарем) -->
        <div class="bads-field bads-booking-bar__date">
            <?php
            ob_start();
            get_template_part('template-parts/ui/date-picker-stepper');
            $stepper_html = ob_get_clean();

            get_template_part(
                'template-parts/ui/accordion',
                null,
                [
                    'id'          => 'hero-date-select',
                    'class'       => 'bads-accordion--date-picker',
                    'variant'     => 'select',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'prefix_icon' => 'calendar',
                    'name'        => 'date',
                    'trigger'     => 'Дата заезда',
                    'value'       => 'В ближайшее время',
                    'aria_label'  => 'Дата заезда',
                    'content'     => $stepper_html,
                ]
            );
            ?>
        </div>

        <!-- Row 1, Col 3: Длительность отдыха (BADS Accordion Select с Range Slider 3-90 дней) -->
        <div class="bads-field bads-booking-bar__duration">
            <?php
            ob_start();
            ?>
            <div class="bads-range bads-duration-range-box">
                <div class="bads-range__header">
                    <span class="bads-range__label-title">Длительность:</span>
                    <span class="bads-range__value"><span id="hero-duration-range-display">14</span> <span id="hero-duration-range-unit">дней</span></span>
                </div>
                <div class="bads-range__track-wrap">
                    <input 
                        type="range" 
                        name="duration" 
                        id="hero-duration-range" 
                        min="3" 
                        max="90" 
                        step="1" 
                        value="14" 
                        class="bads-range__control"
                        aria-label="Длительность отдыха в днях"
                    >
                </div>
                <div class="bads-range__footer">
                    <span>от 3 дней</span>
                    <span>до 90 дней</span>
                </div>
            </div>
            <?php
            $duration_content_html = ob_get_clean();

            get_template_part(
                'template-parts/ui/accordion',
                null,
                [
                    'id'          => 'hero-duration-select',
                    'class'       => 'bads-accordion--duration-select',
                    'variant'     => 'select',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'prefix_icon' => 'clock',
                    'name'        => 'duration_days',
                    'trigger'     => 'Длительность отдыха',
                    'value'       => '14 дней',
                    'aria_label'  => 'Выберите длительность отдыха',
                    'content'     => $duration_content_html,
                ]
            );
            ?>
        </div>

        <!-- Row 2, Col 1: Количество гостей (BADS Accordion Select с UI Radio) -->
        <div class="bads-field bads-booking-bar__persons">
            <?php
            $persons_options = [
                ['value' => '2 взрослых', 'label' => '2 взрослых', 'active' => true],
                ['value' => '1 взрослый', 'label' => '1 взрослый'],
                ['value' => 'Семья с детьми', 'label' => 'Семья с детьми'],
                ['value' => 'Группа от 4 человек', 'label' => 'Группа от 4 человек'],
            ];

            ob_start();
            ?>
            <div class="bads-stack bads-stack--xs bads-radio-select-list">
                <?php foreach ($persons_options as $idx => $opt) : ?>
                    <?php
                    get_template_part(
                        'template-parts/ui/radio',
                        null,
                        [
                            'id'      => 'hero-persons-radio-' . $idx,
                            'name'    => 'hero_persons_radio',
                            'value'   => $opt['value'],
                            'label'   => $opt['label'],
                            'checked' => !empty($opt['active']),
                            'class'   => 'bads-radio-select-item',
                        ]
                    );
                    ?>
                <?php endforeach; ?>
            </div>
            <?php
            $persons_content_html = ob_get_clean();

            get_template_part(
                'template-parts/ui/accordion',
                null,
                [
                    'id'          => 'hero-persons-select',
                    'class'       => 'bads-accordion--persons-select bads-accordion--radio-select',
                    'variant'     => 'select',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'prefix_icon' => 'user',
                    'name'        => 'persons',
                    'trigger'     => 'Количество гостей',
                    'value'       => '2 взрослых',
                    'aria_label'  => 'Количество гостей',
                    'content'     => $persons_content_html,
                ]
            );
            ?>
        </div>

        <!-- Row 2, Col 2: Способ связи (BADS Accordion Select с UI Radio) -->
        <div class="bads-field bads-booking-bar__channel-select">
            <?php
            $channel_options = [
                ['value' => 'phone', 'label' => 'Телефон', 'active' => true],
                ['value' => 'email', 'label' => 'Email'],
                ['value' => 'max', 'label' => 'Мессенджер MAX'],
            ];

            ob_start();
            ?>
            <div class="bads-stack bads-stack--xs bads-radio-select-list">
                <?php foreach ($channel_options as $idx => $opt) : ?>
                    <?php
                    get_template_part(
                        'template-parts/ui/radio',
                        null,
                        [
                            'id'      => 'hero-channel-radio-' . $idx,
                            'name'    => 'hero_channel_radio',
                            'value'   => $opt['value'],
                            'label'   => $opt['label'],
                            'checked' => !empty($opt['active']),
                            'class'   => 'bads-radio-select-item',
                        ]
                    );
                    ?>
                <?php endforeach; ?>
            </div>
            <?php
            $channel_content_html = ob_get_clean();

            get_template_part(
                'template-parts/ui/accordion',
                null,
                [
                    'id'          => 'hero-channel-dropdown',
                    'class'       => 'bads-accordion--channel-select bads-accordion--radio-select',
                    'variant'     => 'select',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'prefix_icon' => 'communication/channel',
                    'name'        => 'channel_type',
                    'trigger'     => 'Способ связи',
                    'value'       => 'Телефон',
                    'aria_label'  => 'Способ связи',
                    'content'     => $channel_content_html,
                ]
            );
            ?>
        </div>

        <!-- Hidden Channel Field for Bitrix24 -->
        <input type="hidden" name="channel" value="phone">

        <!-- Row 2, Col 3: Поле контакта / ссылка мессенджера -->
        <div class="bads-booking-bar__channel-target">
            <!-- 1. Телефон (BADS Input Tel) -->
            <div class="lead-form-channel__panel lead-form-channel__panel--active" data-channel-panel="phone">
                <?php
                get_template_part(
                    'template-parts/ui/input',
                    null,
                    [
                        'id'           => 'hero-phone',
                        'name'         => 'phone',
                        'type'         => 'tel',
                        'icon'         => 'phone',
                        'size'         => 'md',
                        'radius'       => 'pill',
                        'placeholder'  => '+7 (___) ___-__-__',
                        'autocomplete' => 'tel',
                        'aria_label'   => 'Номер телефона для расчета',
                    ]
                );
                ?>
            </div>

            <!-- 2. Email (BADS Input Email) -->
            <div class="lead-form-channel__panel" data-channel-panel="email" hidden>
                <?php
                get_template_part(
                    'template-parts/ui/input',
                    null,
                    [
                        'id'           => 'hero-email',
                        'name'         => 'email',
                        'type'         => 'email',
                        'icon'         => 'email',
                        'size'         => 'md',
                        'radius'       => 'pill',
                        'placeholder'  => 'Ваш email для расчета',
                        'autocomplete' => 'email',
                        'aria_label'   => 'Email для расчета',
                    ]
                );
                ?>
            </div>

            <!-- 3. Мессенджер (Ссылка на чат в MAX) -->
            <div class="lead-form-channel__panel" data-channel-panel="max" hidden>
                <a
                    href="<?= esc_url($hero_max_link); ?>"
                    class="bads-booking-bar__max-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Перейти в чат MAX"
                >
                    <span class="bads-booking-bar__max-icon">
                        <img src="<?= esc_url(get_template_directory_uri() . '/assets/images/brands/max.svg'); ?>" alt="MAX">
                    </span>
                    <span class="bads-booking-bar__max-text">Перейти в чат MAX</span>
                    <span class="bads-booking-bar__max-arrow" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 17l9.2-9.2M17 17V8H8"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <!-- Row 3, Cols 1-2: Поле для свободного комментария (BADS Textarea) -->
        <div class="bads-field bads-booking-bar__comment">
            <?php
            get_template_part(
                'template-parts/ui/textarea',
                null,
                [
                    'id'          => 'hero-comment',
                    'name'        => 'comment',
                    'rows'        => 2,
                    'size'        => 'md',
                    'radius'      => 'lg',
                    'placeholder' => 'Пожелания к отдыху, даты или вопросы...',
                    'aria_label'  => 'Пожелания к отдыху',
                ]
            );
            ?>
        </div>

        <!-- Row 3, Col 3: Кнопка отправки -->
        <div class="bads-booking-bar__submit-col">
            <button
                type="submit"
                class="bads-btn bads-btn--primary bads-btn--md lead-form-main__btn is-disabled"
                id="privacy-btn-hero-booking"
                aria-disabled="true"
            >
                <span><?= esc_html($hero_button_text); ?></span>
                <svg class="bads-btn__icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </div>

        <!-- Row 4: Согласие на обработку персональных данных (152-ФЗ) -->
        <div class="bads-booking-bar__privacy">
            <?php
            get_template_part(
                'template-parts/components/privacy-agreement',
                null,
                [
                    'id'       => 'privacy-hero-booking',
                    'name'     => 'privacy_agreement',
                    'variant'  => 'single',
                    'centered' => true,
                    'checked'  => false,
                    'required' => true,
                ]
            );
            ?>
        </div>

    </div>

    <div class="lead-form-main__message" id="hero-booking-success"></div>
</form>
