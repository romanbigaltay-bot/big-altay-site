<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Direction Treatment / Quick Consultation Compact Form (Block after Hero)
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$quick_title = get_field('direction_quick_form_title') 
    ?: 'Подберем санаторий и программу лечения именно для вас';
?>

<section class="bads-section bads-section--xl" id="direction-quick-form">
    <div class="bads-container bads-container--md">

        <div class="bads-stack bads-stack--xl bads-stack--text-center">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => $quick_title,
                    'level' => 'h2',
                    'size'  => 'h3',
                    'align' => 'center',
                ]
            );
            ?>

            <?php
            get_template_part(
                'components/forms/b24-form-compact',
                null,
                [
                    'form_id'        => 'direction-quick',
                    'form_title'     => $quick_title,
                    'button_text'    => 'Получить консультацию',
                    'placeholder'    => 'Ваш номер телефона*',
                    'success_target' => 'direction-quick-success',
                    'success_url'    => '/thank-you/',
                ]
            );
            ?>

        </div>

    </div>
</section>
