<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component / B24 Form Compact (Inline Phone + Button + Privacy)
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$form_id        = $args['form_id'] ?? 'compact-form';
$form_title     = $args['form_title'] ?? $args['title'] ?? '';
$button_text    = $args['button_text'] ?? 'Получить консультацию';
$success_target = $args['success_target'] ?? 'form-success';
$success_url    = $args['success_url'] ?? '/thank-you/';
$placeholder     = $args['placeholder'] ?? '+7 (___) ___-__-__';
$privacy_variant = $args['privacy_variant'] ?? 'single';
$page_url        = !empty($args['page_url']) ? $args['page_url'] : (is_singular() ? get_permalink() : home_url($_SERVER['REQUEST_URI'] ?? ''));
$page_title     = !empty($args['page_title']) ? $args['page_title'] : (wp_get_document_title() ?: get_the_title() ?: 'Сайт «Большой Алтай»');
?>

<div class="lead-form-compact" id="<?= esc_attr($success_target) ?>">

    <form
        class="lead-form-main lead-form-main--compact"
        id="b24-form-<?= esc_attr($form_id) ?>"
        data-form-id="<?= esc_attr($form_id) ?>"
        data-form-title="<?= esc_attr($form_title) ?>"
        data-button-text="<?= esc_attr($button_text) ?>"
        data-success-target="<?= esc_attr($success_target) ?>"
        data-success-url="<?= esc_url($success_url) ?>"
        data-page="<?= esc_url($page_url) ?>"
        data-page-title="<?= esc_attr($page_title) ?>"
    >

        <div class="lead-form-main__fields bads-grid bads-grid--2 bads-grid--gap-sm bads-grid--center">

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
                        'placeholder'  => $placeholder,
                        'autocomplete' => 'tel',
                        'aria_label'   => 'Номер телефона',
                        'input_class'  => 'lead-form-main__input lead-form-main__input--phone',
                    ]
                );
                ?>
            </div>

            <div class="lead-form-main__action">
                <?php
                get_template_part(
                    'template-parts/ui/button',
                    null,
                    [
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

        <div class="lead-form-main__message"></div>

    </form>

    <div class="lead-form-success__message">
        <strong>Спасибо за заявку!</strong><br>
        Наш специалист свяжется с вами в течение 10-15 минут.
    </div>

</div>