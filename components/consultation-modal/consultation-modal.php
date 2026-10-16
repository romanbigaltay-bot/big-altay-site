<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component / Modal / Consultation Modal (Bitrix24)
 * ============================================================================
 * 
 * Global consultation modal with multi-channel lead capture (Phone, Email, MAX).
 */

if (!defined('ABSPATH')) {
    exit;
}

ob_start();
?>
<div class="bads-stack bads-stack--md">
    <?php
    get_template_part(
        'components/forms/b24-consultation-form',
        null,
        [
            'form_id'         => 'global-header-consultation',
            'button_text'     => 'Получить консультацию',
            'success_target'  => 'header-consultation-success',
            'success_url'     => '/thank-you/',
            'privacy_variant' => 'multiline',
        ]
    );
    ?>
</div>
<?php
$consultation_modal_content = ob_get_clean();

get_template_part(
    'template-parts/ui/modal',
    null,
    [
        'id'       => 'bads-consultation-modal',
        'title'    => 'Консультация<br>эксперта',
        'subtitle' => 'Поможем подобрать санаторий, тур или программу оздоровления.',
        'icon'     => 'channel',
        'content'  => $consultation_modal_content,
        'size'     => 'sm',
    ]
);
