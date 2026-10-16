<?php
/**
 * Lead Form Component (Legacy / Shared)
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

// Определение страницы туров: URL (/tours/...), CPT 'tour'/'tours' или архив
$request_uri  = $_SERVER['REQUEST_URI'] ?? '';
$is_tour_page = false;

if (
    strpos($request_uri, '/tours') !== false ||
    (function_exists('is_singular') && (is_singular('tour') || is_singular('tours'))) ||
    (function_exists('is_post_type_archive') && (is_post_type_archive('tour') || is_post_type_archive('tours'))) ||
    (function_exists('is_tax') && (is_tax('tour_category') || is_tax('tour_tag') || is_tax('tour_type') || is_tax('tours_category'))) ||
    (function_exists('is_page') && (is_page('tours') || is_page('tour'))) ||
    (isset($GLOBALS['post']->post_type) && in_array($GLOBALS['post']->post_type, ['tour', 'tours'], true))
) {
    $is_tour_page = true;
}

// По умолчанию для страниц туров — /thank-you/tours/, для остальных — /thank-you/main/
$success_url = $is_tour_page ? '/thank-you/tours/' : '/thank-you/main/';

// Если передан кастомный success_url (не дефолтный main)
if (!empty($args['success_url']) && $args['success_url'] !== '/thank-you/main/') {
    $success_url = $args['success_url'];
}

$form_id     = !empty($args['form_id']) ? $args['form_id'] : 'front-page-discount';
$button_text = !empty($args['button_text']) ? $args['button_text'] : 'Получить скидку';
?>
<div class="lead-form__right" id="form-contacts">
    <?php
    get_template_part(
        'components/forms/b24-form',
        null,
        [
            'form_id'        => $form_id,
            'button_text'    => $button_text,
            'success_target' => 'form-contacts',
            'success_url'    => $success_url,
            'centered'       => false,
        ]
    );
    ?>
</div>

