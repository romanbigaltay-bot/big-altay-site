<?php
/**
 * Component: Bitrix24 Consultation Form (Enhanced with BADS UI Components)
 * 
 * @param array $args [
 *   'form_id'        => string,
 *   'button_text'    => string,
 *   'success_target' => string,
 *   'success_url'    => string,
 *   'class'          => string,
 *   'show_name'      => bool,
 * ]
 */

if (!defined('ABSPATH')) {
    exit;
}

$form_id        = $args['form_id'] ?? 'consultation-form';
$form_title     = $args['form_title'] ?? $args['title'] ?? '';
$button_text    = $args['button_text'] ?? 'Получить консультацию специалиста';
$success_target = $args['success_target'] ?? '';
$success_url    = $args['success_url'] ?? '/thank-you/';
$custom_class   = $args['class'] ?? '';
$show_name      = $args['show_name'] ?? false;
$privacy_variant = $args['privacy_variant'] ?? 'multiline';
$page_url       = !empty($args['page_url']) ? $args['page_url'] : (is_singular() ? get_permalink() : home_url($_SERVER['REQUEST_URI'] ?? ''));
$page_title     = !empty($args['page_title']) ? $args['page_title'] : (wp_get_document_title() ?: get_the_title() ?: 'Сайт «Большой Алтай»');

// 1. Панель способа связи: Телефон
ob_start();
?>
<div class="lead-form-main__field">
    <?php
    get_template_part('template-parts/ui/input', null, [
        'name'         => 'phone',
        'type'         => 'tel',
        'icon'         => 'phone',
        'size'         => 'md',
        'radius'       => 'pill',
        'placeholder'  => '+7 (___) ___-__-__',
        'autocomplete' => 'tel',
        'aria_label'   => 'Номер телефона',
        'input_class'  => 'lead-form-main__input lead-form-main__input--phone',
    ]);
    ?>
</div>
<?php
$phone_panel = ob_get_clean();

// 2. Панель способа связи: Email
ob_start();
?>
<div class="lead-form-main__field">
    <?php
    get_template_part('template-parts/ui/input', null, [
        'name'         => 'email',
        'type'         => 'email',
        'icon'         => 'email',
        'size'         => 'md',
        'radius'       => 'pill',
        'placeholder'  => 'Ваш адрес электронной почты',
        'autocomplete' => 'email',
        'aria_label'   => 'Email адрес',
        'input_class'  => 'lead-form-main__input lead-form-main__input--email',
    ]);
    ?>
</div>
<?php
$email_panel = ob_get_clean();

// 3. Панель способа связи: Чат MAX
ob_start();
?>
<div class="lead-form-main__field">
    <a
        href="https://max.ru/id2203004205_bot"
        class="bads-booking-bar__max-link lead-form-channel__max-pill"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Перейти в чат MAX"
        data-max-link
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
<?php
$max_panel = ob_get_clean();

// Формируем список табов для BADS UI Tabs
$tab_items = [
    [
        'title'       => 'Телефон',
        'icon'        => '<svg class="lead-form-channel__tab-icon bads-tabs__tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'tab_class'   => 'lead-form-channel__tab lead-form-channel__tab--active',
        'tab_attrs'   => ['data-channel-tab' => 'phone'],
        'panel_class' => 'lead-form-channel__panel lead-form-channel__panel--active',
        'panel_attrs' => ['data-channel-panel' => 'phone'],
        'content'     => $phone_panel,
    ],
    [
        'title'       => 'Email',
        'icon'        => '<svg class="lead-form-channel__tab-icon bads-tabs__tab-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        'tab_class'   => 'lead-form-channel__tab',
        'tab_attrs'   => ['data-channel-tab' => 'email'],
        'panel_class' => 'lead-form-channel__panel',
        'panel_attrs' => ['data-channel-panel' => 'email'],
        'content'     => $email_panel,
    ],
    [
        'title'       => 'Чат MAX',
        'icon'        => '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/brands/max.svg') . '" alt="" class="lead-form-channel__tab-icon bads-tabs__tab-icon">',
        'tab_class'   => 'lead-form-channel__tab',
        'tab_attrs'   => ['data-channel-tab' => 'max'],
        'panel_class' => 'lead-form-channel__panel',
        'panel_attrs' => ['data-channel-panel' => 'max'],
        'content'     => $max_panel,
    ],
];
?>

<form
    class="lead-form-main lead-form-main--consultation bads-stack bads-stack--md <?= esc_attr($custom_class); ?>"
    data-form-id="<?= esc_attr($form_id); ?>"
    data-form-title="<?= esc_attr($form_title); ?>"
    data-button-text="<?= esc_attr($button_text); ?>"
    <?php if ($success_target): ?>data-success-target="<?= esc_attr($success_target); ?>"<?php endif; ?>
    data-success-url="<?= esc_url($success_url); ?>"
    data-page="<?= esc_url($page_url); ?>"
    data-page-title="<?= esc_attr($page_title); ?>"
>
    <!-- Скрытое поле активного канала связи -->
    <input type="hidden" name="channel" value="phone">

    <div class="lead-form-main__fields">
        <?php if ($show_name): ?>
            <!-- Поле "Ваше имя" (BADS UI Input) -->
            <div class="lead-form-main__field">
                <?php
                get_template_part('template-parts/ui/input', null, [
                    'name'         => 'name',
                    'type'         => 'text',
                    'icon'         => 'user',
                    'size'         => 'md',
                    'radius'       => 'pill',
                    'placeholder'  => 'Ваше имя (необязательно)',
                    'autocomplete' => 'name',
                    'aria_label'   => 'Ваше имя',
                    'input_class'  => 'lead-form-main__input lead-form-main__input--name',
                ]);
                ?>
            </div>
        <?php endif; ?>

        <!-- Переключатель способов связи и поля контактов (BADS UI Tabs) -->
        <?php
        get_template_part('template-parts/ui/tabs', null, [
            'items'        => $tab_items,
            'active'       => 0,
            'variant'      => 'segmented',
            'class'        => 'lead-form-channel',
            'nav_class'    => 'lead-form-channel__tabs',
            'panels_class' => 'lead-form-channel__panels',
        ]);
        ?>

        <!-- Текстовая область для комментария / диагноза (BADS UI Textarea) -->
        <div class="lead-form-main__field">
            <?php
            get_template_part('template-parts/ui/textarea', null, [
                'name'        => 'comment',
                'rows'        => 3,
                'size'        => 'md',
                'radius'      => 'lg',
                'placeholder' => 'Опишите ваши симптомы, диагноз, сопутствующие заболевания или пожелания к санаторию...',
                'aria_label'  => 'Симптомы или пожелания к санаторию',
                'class'       => 'lead-form-main__textarea',
            ]);
            ?>
        </div>
    </div>

    <!-- Чекбокс согласия с персональными данными (BADS UI Checkbox) -->
    <?php
    get_template_part('template-parts/components/privacy-agreement', null, [
        'name'     => 'privacy',
        'variant'  => $privacy_variant,
        'centered' => true,
        'required' => true,
    ]);
    ?>

    <!-- Кнопка отправки заявки (BADS UI Button) -->
    <?php
    get_template_part('template-parts/ui/button', null, [
        'text'     => $button_text,
        'type'     => 'submit',
        'variant'  => 'primary',
        'size'     => 'lg',
        'disabled' => true,
        'class'    => 'lead-form-main__btn u-w-full',
    ]);
    ?>

    <div class="lead-form-main__message"></div>
</form>