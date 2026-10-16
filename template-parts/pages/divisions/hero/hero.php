<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * About Page / Hero Section
 * Path: template-parts/pages/divisions/hero/hero.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="bads-section bads-section--hero bads-section--sm" id="hero">
    <div class="bads-stack bads-stack--md">

        <!-- Breadcrumbs -->
        <div>
            <?php
            get_template_part('template-parts/ui/breadcrumbs', null, [
                'items' => [
                    [
                        'label' => 'Главная',
                        'url'   => '/',
                    ],
                    [
                        'label' => 'О нас',
                    ],
                ],
            ]);
            ?>
        </div>

        <!-- Header Content: Title, Divider, Subtitle, Text -->
        <div class="bads-stack bads-stack--sm">
            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'            => 'Туроператор «Большой Алтай»',
                'level'            => 'h1',
                'divider'          => true,
                'divider_variant'  => 'primary',
                'divider_width'    => '90px',
                'subtitle'         => 'Официальный партнёр санаториев, гостиниц и баз отдыха курорта Белокуриха.',
                'subtitle_variant' => 'emphasis',
            ]);
            ?>

            <p class="u-text-muted" style="font-size: 1.125rem; line-height: 1.65; margin: 0;">
                Мы не просто организуем поездки — мы создаём целостную культуру курортного отдыха в Белокурихе. Путешествуя с нами, вы открываете аутентичные гастрономические вкусы сибирской тайги, прикасаетесь к редким предметам алтайской истории и увозите с собой стильные вещи, сохраняющие природную энергию курорта.
            </p>
        </div>

    </div>
</section>
