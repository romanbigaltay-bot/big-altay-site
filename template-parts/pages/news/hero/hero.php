<?php
/**
 * BADS News Hero Section
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$vk_url = function_exists('get_field') ? (get_field('vk', 2) ?: 'https://vk.com/big_altay') : 'https://vk.com/big_altay';
?>

<section class="bads-section bads-section--lg bads-section--hero">
    <div class="bads-container">
        <!-- Breadcrumbs at the very top -->
        <?php get_template_part('template-parts/ui/breadcrumbs', null, [
            'items' => [
                ['label' => 'Главная', 'url' => home_url('/')],
                ['label' => 'Новости', 'current' => true]
            ]
        ]); ?>

        <!-- Hero Content: Split layout with Left (Title, Divider, Subtitle, Socials) and Right (Subscription Form) -->
        <div class="bads-split bads-split--wide bads-split--start u-mt-xl">
            <!-- Left Column -->
            <div class="bads-stack bads-stack--md">
                <?php get_template_part('template-parts/ui/title', null, [
                    'level'           => 'h1',
                    'title'           => get_the_archive_title() ?: 'Новости',
                    'divider'         => true,
                    'divider_variant' => 'primary',
                    'divider_width'   => '90px',
                    'subtitle'        => 'Оставайтесь в курсе самых важных событий! Подпишитесь на нашу рассылку или присоединяйтесь к нам в социальных сетях.',
                ]); ?>

                <!-- Socials placed right under subtitle, bigger in scale with clean zoom hover -->
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

            <!-- Right Column: Inline Subscription Form (Dropped down by 100px) -->
            <div class="u-w-full" style="margin-top: 0px;">
                <div class="bads-card bads-card--glass-opaque bads-card--radius-xl bads-card--padding-lg">
                    <form data-news-subscribe-form class="bads-stack bads-stack--md">
                        <!-- Header with Icon, larger Title and Subtitle -->
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
                                <div class="u-text-xl u-text-bold u-text-dark" style="line-height: 1.25;">Подписка на новости</div>
                                <div class="u-text-sm u-text-muted">Оставьте свой адрес электронной почты.</div>
                            </div>
                        </div>

                        <!-- Inputs & Submit Button -->
                        <div class="bads-cluster u-items-stretch" style="--bads-cluster-gap: var(--space-xs);">
                            <div class="u-flex-1">
                                <?php
                                get_template_part('template-parts/ui/input', null, [
                                    'id'          => 'news-inline-email',
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
                            'id'       => 'news-inline-privacy',
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
</section>
