<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="<?= get_template_directory_uri(); ?>/img/favicon/favicon.svg">
    <link rel="apple-touch-icon" href="<?= get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/img/favicon/manifest.json">
    <?php wp_head(); ?>
    <meta name="google-site-verification" content="Ajtc4M3d4PYcC8EWvC5oiX0p5sx5QMb-kiHG4_SVCEw" />
</head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MH6DG2M');</script>
<!-- End Google Tag Manager -->
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MH6DG2M"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php
$postObject = get_queried_object();
$customPostType = $postObject->post_type ?? '';
$phone = get_field('phone_1', 2) ?: '8 800 500-07-34';
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
$vk_url = get_field('vk', 2) ?: 'https://vk.com/bolshoyaltay';
?>
<div class="wrapper <?= in_array($customPostType, ['sanatorium', 'rest-belokurikha', 'rest-altai-mountains'], true) ? 'wrapper-sanatorium' : ''; ?>" id="top">
    <!-- Header: Pure BADS Section / Container Layout Orchestrator -->
    <header class="bads-header bads-section bads-section--none u-mb-sm" id="site-header">
        <div class="bads-container bads-header__container u-py-xs">
            <div class="bads-cluster bads-cluster--between bads-cluster--middle bads-cluster--nowrap bads-cluster--xl bads-header__inner">
                <!-- Brand / Logo (Left Column across 2 rows, scaled to 80px desktop / 60px sticky / responsive mobile) -->
                <a href="<?= is_front_page() ? '#top' : '/'; ?>" class="bads-header__logo-link u-flex bads-cluster--middle u-shrink-0" aria-label="<?= esc_attr__('Большой Алтай — Главная', 'bigaltay'); ?>">
                    <picture>
                        <source srcset="<?= get_template_directory_uri(); ?>/img/header/logo.webp" type="image/webp">
                        <img 
                            src="<?= get_template_directory_uri(); ?>/img/header/logo.png" 
                            alt="<?= esc_attr__('Большой Алтай', 'bigaltay'); ?>"
                            class="bads-header__logo-img"
                            width="280"
                            height="80"
                        >
                    </picture>
                </a>

                <!-- Right Column: 2-Row Stack Orchestrator -->
                <div class="bads-stack bads-stack--xs bads-header__right-stack u-w-full u-min-w-0">
                    <!-- Top Row: Primary Bar (Registry, Phone, Socials, Consultation CTA, Mobile Hamburger) -->
                    <div class="bads-cluster bads-cluster--between bads-cluster--middle bads-cluster--nowrap bads-cluster--sm bads-header__top-row u-pb-xs">
                        <!-- Registry Badge (Desktop Only) -->
                        <a 
                            href="https://ev.economy.gov.ru/lk_exp/registry/to/50d74ccd-d2ab-4bb3-98d4-8dd97d517f31"
                            class="bads-cluster bads-cluster--xs bads-cluster--middle bads-header__registry u-text-muted u-no-underline hover:u-text-primary u-shrink-0 u-hidden-mobile"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="<?= esc_attr__('Реестр туроператоров Минэкономразвития РФ', 'bigaltay'); ?>"
                        >
                            <img 
                                src="<?= get_template_directory_uri(); ?>/img/header/eagle.png" 
                                alt=""
                                width="42"
                                height="42"
                                class="bads-header__eagle-img"
                                style="width: 42px; height: 42px; object-fit: contain;"
                                loading="lazy"
                            >
                            <span class="u-text-2xs u-leading-tight bads-header__registry-text">
                                Мы в реестре туроператоров:<br/>
                                <strong class="u-text-dark">ООО «Большой Алтай», РТО 026357</strong>
                            </span>
                        </a>

                        <!-- Phone Link -->
                        <a 
                            href="tel:<?= esc_attr($phone_clean); ?>" 
                            class="bads-cluster bads-cluster--xs bads-cluster--middle bads-header__phone u-text-dark hover:u-text-primary u-no-underline u-shrink-0"
                            aria-label="<?= esc_attr(sprintf(__('Позвонить по номеру %s', 'bigaltay'), $phone)); ?>"
                        >
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="bads-header__phone-icon u-shrink-0" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <span class="bads-header__phone-text u-text-base u-text-bold u-leading-none" style="font-size: 16px; letter-spacing: -0.01em;"><?= esc_html($phone); ?></span>
                        </a>

                        <!-- Right Actions Cluster (Socials, CTA, Hamburger) -->
                        <div class="bads-cluster bads-cluster--sm bads-cluster--middle bads-cluster--nowrap u-shrink-0">
                            <!-- Socials Group (Desktop Only) -->
                            <div class="bads-cluster bads-cluster--xs bads-cluster--middle u-shrink-0 u-hidden-mobile">
                                <!-- MAX Bot -->
                                <a 
                                    href="https://max.ru/id2203004205_bot" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="bads-btn bads-btn--icon-only bads-btn--icon-32"
                                    aria-label="<?= esc_attr__('Открыть чат с ботом MAX', 'bigaltay'); ?>"
                                    title="<?= esc_attr__('Оперативный чат в MAX', 'bigaltay'); ?>"
                                >
                                    <span 
                                        class="bads-brand-icon bads-brand-icon--max" 
                                        style="--brand-mask: url('<?= get_template_directory_uri(); ?>/assets/images/brands/max.svg');"
                                        aria-hidden="true"
                                    ></span>
                                </a>

                                <!-- VK -->
                                <a 
                                    href="<?= esc_url($vk_url); ?>" 
                                    target="_blank" 
                                    rel="noopener noreferrer" 
                                    class="bads-btn bads-btn--icon-only bads-btn--icon-32"
                                    aria-label="<?= esc_attr__('Сообщество ВКонтакте', 'bigaltay'); ?>"
                                    title="<?= esc_attr__('ВКонтакте', 'bigaltay'); ?>"
                                >
                                    <span 
                                        class="bads-brand-icon bads-brand-icon--vk" 
                                        style="--brand-mask: url('<?= get_template_directory_uri(); ?>/assets/images/brands/vk.svg');"
                                        aria-hidden="true"
                                    ></span>
                                </a>
                            </div>

                            <!-- Consultation Button (Desktop Only, with extra separation from socials) -->
                            <div class="u-hidden-mobile u-ml-xs">
                                <?php 
                                get_template_part('template-parts/ui/button', null, [
                                    'text'    => 'Получить консультацию',
                                    'variant' => 'primary',
                                    'size'    => 'xs',
                                    'type'    => 'button',
                                    'attrs'   => [
                                        'data-modal-target'  => '#bads-consultation-modal',
                                        'data-modal-trigger' => '',
                                    ],
                                ]);
                                ?>
                            </div>

                            <!-- Mobile Hamburger Trigger (Mobile Only) -->
                            <div class="u-hidden-desktop">
                                <button 
                                    type="button" 
                                    class="bads-btn bads-btn--icon-only js-bads-hamburger" 
                                    aria-label="<?= esc_attr__('Открыть меню', 'bigaltay'); ?>"
                                    title="<?= esc_attr__('Меню', 'bigaltay'); ?>"
                                >
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <line x1="3" y1="12" x2="21" y2="12"></line>
                                        <line x1="3" y1="18" x2="21" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row: Navigation Menu Component (Desktop) -->
                    <div class="u-w-full">
                        <?php get_template_part('template-parts/components/main-menu/main-menu', null, ['part' => 'nav']); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function(m,e,t,r,i,k,a){
                m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();
                for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
                k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
            })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=109878207', 'ym');

            ym(109878207, 'init', {ssr:true, webvisor:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/109878207" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </header>

    <!-- Mobile Navigation Drawer (Rendered outside header to guarantee full viewport stacking context) -->
    <?php get_template_part('template-parts/components/main-menu/main-menu', null, ['part' => 'drawer']); ?>

    <!-- Floating Messenger Button (MAX) -->
    <?php get_template_part('template-parts/components/messenger-button/messenger-button'); ?>
