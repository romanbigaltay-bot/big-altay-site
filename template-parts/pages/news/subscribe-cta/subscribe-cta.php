<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * News / Subscribe & Socials CTA Block (Hero Replica)
 * Template: template-parts/pages/news/subscribe-cta/subscribe-cta.php
 * ============================================================================
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [
    'title'          => 'Будем на связи!',
    'subtitle'       => 'Оставайтесь в курсе самых важных событий! Подпишитесь на нашу рассылку или присоединяйтесь к нам в социальных сетях.',
    'divider'        => true,
    'divider_width'  => '90px',
    'divider_offset' => '24px',
    'form_title'     => 'Подписка на новости',
    'form_subtitle'  => 'Оставьте свой адрес электронной почты.',
    'email_id'       => 'news-subscribe-cta-email',
    'privacy_id'     => 'news-subscribe-cta-privacy',
    'border_top'     => true,
    'class'          => '',
]);

$vk_url = function_exists('get_field') ? (get_field('vk', 2) ?: 'https://vk.com/big_altay') : 'https://vk.com/big_altay';

$wrapper_classes = ['bads-news-cta', 'u-py-5xl'];
if ($args['border_top']) {
    $wrapper_classes[] = 'u-mt-xl';
}
if (!empty($args['class'])) {
    $wrapper_classes[] = sanitize_html_class($args['class']);
}
$wrapper_class = implode(' ', $wrapper_classes);
$wrapper_style = $args['border_top'] ? 'border-top: 1px solid var(--color-border);' : '';
?>

<div class="<?= esc_attr($wrapper_class); ?>" <?php if ($wrapper_style) : ?>style="<?= esc_attr($wrapper_style); ?>"<?php endif; ?>>
    <div class="bads-split bads-split--wide bads-split--start">
        
        <!-- Left Column: Title, Divider, Subtitle, VK Social Link -->
        <div class="bads-stack bads-stack--md">
            <?php
            get_template_part('template-parts/ui/title', null, [
                'level'           => 'h2',
                'size'            => 'h2',
                'title'           => $args['title'],
                'divider'         => (bool) $args['divider'],
                'divider_variant' => 'primary',
                'divider_width'   => $args['divider_width'],
                'divider_offset'  => $args['divider_offset'],
                'subtitle'        => $args['subtitle'],
            ]);
            ?>

            <!-- Socials placed right under subtitle with clean zoom hover -->
            <div class="bads-cluster u-items-center u-mt-sm" style="--bads-cluster-gap: var(--space-md);">
                <span class="u-text-base u-text-bold u-text-dark">Наши соцсети:</span>
                <a href="<?= esc_url($vk_url); ?>" target="_blank" rel="noopener noreferrer" class="bads-btn bads-btn--zoom bads-cluster u-items-center" style="--bads-cluster-gap: 8px;">
                    <span class="bads-btn__icon" style="width: 34px; height: 34px; min-width: 34px;">
                        <img src="<?= get_template_directory_uri(); ?>/assets/images/brands/vk.svg" alt="ВКонтакте" width="34" height="34" style="border-radius: 8px; display: block;">
                    </span>
                    <span class="bads-btn__label u-text-base u-text-bold">ВКонтакте</span>
                </a>
            </div>
        </div>

        <!-- Right Column: Inline Subscription Form in Glass Opaque Card -->
        <div class="u-w-full">
            <div class="bads-card bads-card--glass-opaque bads-card--radius-xl bads-card--padding-lg">
                <form data-news-subscribe-form class="bads-stack bads-stack--md">
                    <!-- Header with Icon, Title and Subtitle -->
                    <div class="bads-cluster u-items-center" style="--bads-cluster-gap: var(--space-md);">
                        <div class="bads-modal__icon" aria-hidden="true" style="width: 58px; height: 58px; min-width: 58px; border-radius: var(--radius-lg, 16px);">
                            <?php
                            get_template_part('template-parts/ui/icon', null, [
                                'name'       => 'news',
                                'size'       => 'md',
                                'decorative' => true,
                            ]);
                            ?>
                        </div>
                        <div class="bads-stack bads-stack--2xs">
                            <div class="u-text-xl u-text-bold u-text-dark" style="line-height: 1.25;"><?= esc_html($args['form_title']); ?></div>
                            <div class="u-text-sm u-text-muted"><?= esc_html($args['form_subtitle']); ?></div>
                        </div>
                    </div>

                    <!-- Inputs & Submit Button -->
                    <div class="bads-cluster u-items-stretch" style="--bads-cluster-gap: var(--space-xs);">
                        <div class="u-flex-1">
                            <?php
                            get_template_part('template-parts/ui/input', null, [
                                'id'          => $args['email_id'],
                                'name'        => 'email',
                                'type'        => 'email',
                                'size'        => 'md',
                                'placeholder' => 'Ваш email',
                                'required'    => true,
                            ]);
                            ?>
                        </div>
                        <div>
                            <?php
                            get_template_part('template-parts/ui/button', null, [
                                'type'    => 'submit',
                                'variant' => 'primary',
                                'size'    => 'md',
                                'text'    => 'Подписаться',
                            ]);
                            ?>
                        </div>
                    </div>

                    <?php
                    get_template_part('template-parts/components/privacy-agreement', null, [
                        'id'       => $args['privacy_id'],
                        'name'     => 'privacy_agreement',
                        'required' => true,
                    ]);
                    ?>
                    <div data-subscribe-feedback hidden class="u-text-sm"></div>
                </form>
            </div>
        </div>

    </div>
</div>
