<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component / B24 Booking Form (Name, Phone, Email, Date, Persons + AJAX B24)
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$form_id        = $args['form_id'] ?? 'booking-form';
$form_title     = $args['form_title'] ?? $args['title'] ?? '';
$button_text    = $args['button_text'] ?? 'Отправить заявку';
$success_target = $args['success_target'] ?? 'booking-success';
$success_url    = $args['success_url'] ?? '/thank-you/';
$page_url       = !empty($args['page_url']) ? $args['page_url'] : (is_singular() ? get_permalink() : home_url($_SERVER['REQUEST_URI'] ?? ''));
$page_title     = !empty($args['page_title']) ? $args['page_title'] : (wp_get_document_title() ?: get_the_title() ?: 'Сайт «Большой Алтай»');
?>

<div class="lead-form__right" id="<?= esc_attr($success_target) ?>">
    <div class="lead-form__box">

        <form
            class="lead-form-main lead-form-main--booking"
            id="b24-form-<?= esc_attr($form_id) ?>"
            data-form-id="<?= esc_attr($form_id) ?>"
            data-form-title="<?= esc_attr($form_title) ?>"
            data-button-text="<?= esc_attr($button_text) ?>"
            data-success-target="<?= esc_attr($success_target) ?>"
            data-success-url="<?= esc_url($success_url) ?>"
            data-page="<?= esc_url($page_url) ?>"
            data-page-title="<?= esc_attr($page_title) ?>"
        >

            <div class="lead-form-main__fields">
                
                <div class="lead-form-main__column">
                    <!-- Имя -->
                    <div class="lead-form-main__field">
                        <input
                            type="text"
                            class="lead-form-main__input lead-form-main__input--name"
                            name="name"
                            placeholder="Ваше имя*"
                            autocomplete="name"
                            required
                        >
                    </div>              

                    <!-- Телефон -->
                    <div class="lead-form-main__field">
                        <input
                            type="tel"
                            class="lead-form-main__input lead-form-main__input--phone"
                            name="phone"
                            placeholder="Ваш телефон*"
                            autocomplete="tel"
                            required
                        >
                    </div>

                    <!-- Email -->
                    <div class="lead-form-main__field">
                        <input
                            type="email"
                            class="lead-form-main__input lead-form-main__input--email"
                            name="email"
                            placeholder="Ваш email"
                            autocomplete="email"
                        >
                    </div>
                </div>  
                
                <div class="lead-form-main__column">
                    <!-- Дата -->
                    <div class="lead-form-main__field">
                        <input
                            type="date"
                            class="lead-form-main__input"
                            name="date"
                            title="Желаемая дата заезда"
                        >
                    </div>

                    <!-- Количество человек -->
                    <div class="lead-form-main__field">
                        <select
                            class="lead-form-main__input"
                            name="persons"
                        >
                            <option value="">Количество человек</option>
                            <option value="1">1 человек</option>
                            <option value="2">2 человека</option>
                            <option value="3">3 человека</option>
                            <option value="4+">4+ человека</option>
                        </select>
                    </div>      

                    <!-- Согласие -->
                    <?php
                    get_template_part(
                        'template-parts/components/privacy-agreement',
                        null,
                        [
                            'id'       => 'privacy-' . $form_id,
                            'name'     => 'privacy_agreement',
                            'variant'  => 'single',
                            'centered' => true,
                            'required' => true,
                        ]
                    );
                    ?>
                </div>
            
            </div>
            
            <button
                type="submit"
                class="btn lead-form-main__btn"
                id="privacy-btn-<?= esc_attr($form_id) ?>"
                disabled
            >
                <?= esc_html($button_text) ?>
            </button>

            <div class="lead-form-main__message"></div>

        </form>

    </div>

    <div class="lead-form-success__message">
        <strong>Спасибо за заявку!</strong><br>
        Она будет обработана в ближайшее время.
    </div>
</div>