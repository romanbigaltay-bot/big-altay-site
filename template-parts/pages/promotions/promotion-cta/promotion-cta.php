<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Promotion CTA (Promotions)
 * Path: template-parts/pages/promotions/promotion-cta/promotion-cta.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="bads-section bads-section--lg">
    <div class="bads-container bads-container--md">
        <div class="bads-stack bads-stack--xl bads-stack--text-center">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'level' => 'h2',
                    'size'  => 'h3',
                    'title' => 'Подберем самое выгодное предложение именно для вас!',
                    'align' => 'center',
                ]
            );

            get_template_part(
                'components/forms/b24-form-compact',
                null,
                [
                    'form_id'         => 'promotion-archive',
                    'form_title'      => 'Подбор выгодного предложения (Акции)',
                    'button_text'     => 'Получить специальное предложение',
                    'success_target'  => 'promotion-archive-form',
                    'success_url'     => '/thank-you/promotions/',
                    'privacy_variant' => 'single',
                ]
            );
            ?>

        </div>
    </div>
</section>
