<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component / B24 Form Standard (Name + Phone + Privacy + AJAX Bitrix24)
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$form_id        = $args['form_id'] ?? 'default-form'; 
$form_title     = $args['form_title'] ?? $args['title'] ?? '';
$button_text    = $args['button_text'] ?? 'Получить консультацию';
$success_target = $args['success_target'] ?? 'form-success';
$success_url    = $args['success_url'] ?? '/thank-you/';
$centered        = !empty($args['centered']);
$privacy_variant = $args['privacy_variant'] ?? 'multiline';
$page_url        = !empty($args['page_url']) ? $args['page_url'] : (is_singular() ? get_permalink() : home_url($_SERVER['REQUEST_URI'] ?? ''));
$page_title     = !empty($args['page_title']) ? $args['page_title'] : (wp_get_document_title() ?: get_the_title() ?: 'Сайт «Большой Алтай»');

// Автоматический редирект на специализированную страницу "Спасибо" для туров
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
$is_tour_context = (
    strpos($request_uri, '/tours') !== false ||
    (function_exists('is_singular') && (is_singular('tour') || is_singular('tours'))) ||
    (function_exists('is_post_type_archive') && (is_post_type_archive('tour') || is_post_type_archive('tours'))) ||
    (isset($GLOBALS['post']->post_type) && in_array($GLOBALS['post']->post_type, ['tour', 'tours'], true))
);
if ($is_tour_context && in_array($success_url, ['/thank-you/', '/thank-you', '/thank-you/main/', '/thank-you/main'], true)) {
    $success_url = '/thank-you/tours/';
}
?>

<div class="lead-form__box" id="<?= esc_attr($success_target) ?>">
    <form
        class="lead-form-main <?= $centered ? 'lead-form-main--centered' : '' ?> bads-stack bads-stack--md"
        id="b24-form-<?= esc_attr($form_id) ?>"
        data-form-id="<?= esc_attr($form_id) ?>"
        data-form-title="<?= esc_attr($form_title) ?>"
        data-button-text="<?= esc_attr($button_text) ?>"
        data-success-target="<?= esc_attr($success_target) ?>"
        data-success-url="<?= esc_url($success_url) ?>"  
        data-page="<?= esc_url($page_url) ?>"
        data-page-title="<?= esc_attr($page_title) ?>"
    >
        <div class="lead-form-main__fields bads-stack bads-stack--sm">
            <div class="lead-form-main__field">
                <?php
                get_template_part(
                    'template-parts/ui/input',
                    null,
                    [
                        'id'           => 'name-' . $form_id,
                        'name'         => 'name',
                        'type'         => 'text',
                        'icon'         => 'user',
                        'size'         => 'lg',
                        'radius'       => 'pill',
                        'placeholder'  => 'Ваше имя',
                        'autocomplete' => 'name',
                        'required'     => false,
                        'aria_label'   => 'Ваше имя',
                        'input_class'  => 'lead-form-main__input lead-form-main__input--name',
                    ]
                );
                ?>
            </div>
            <div class="lead-form-main__field">
                <?php
                get_template_part(
                    'template-parts/ui/input',
                    null,
                    [
                        'id'           => 'phone-' . $form_id,
                        'name'         => 'phone',
                        'type'         => 'tel',
                        'icon'         => 'phone',
                        'size'         => 'lg',
                        'radius'       => 'pill',
                        'placeholder'  => 'Ваш телефон*',
                        'autocomplete' => 'tel',
                        'required'     => true,
                        'aria_label'   => 'Номер телефона',
                        'input_class'  => 'lead-form-main__input lead-form-main__input--phone',
                    ]
                );
                ?>
            </div>
        </div>

        <?php
        get_template_part(
            'template-parts/components/privacy-agreement',
            null,
            [
                'id'       => 'privacy-' . $form_id,
                'name'     => 'privacy_agreement',
                'variant'  => $privacy_variant,
                'centered' => true,
                'checked'  => false,
                'required' => true,
            ]
        );
        ?>

        <div class="lead-form-main__action <?= $centered ? 'u-text-center' : '' ?>">
            <?php
            get_template_part(
                'template-parts/ui/button',
                null,
                [
                    'id'       => 'privacy-btn-' . $form_id,
                    'type'     => 'submit',
                    'text'     => $button_text,
                    'variant'  => 'primary',
                    'size'     => 'lg',
                    'class'    => 'lead-form-main__btn is-disabled u-w-full',
                    'attrs'    => [
                        'aria-disabled'     => 'true',
                        'data-default-text' => $button_text,
                    ],
                ]
            );
            ?>
        </div>

        <div class="lead-form-main__message"></div>
    </form>

    <div class="lead-form-success__message">
        <strong>Спасибо за заявку!</strong><br>
        Наш специалист свяжется с вами в течение 10-15 минут.
    </div>
</div>
