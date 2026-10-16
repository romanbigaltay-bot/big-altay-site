<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Front Page Hero: Header (SEO Title, Subtitle, Trust Features)
 * ============================================================================
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$page_id = get_the_ID();

// 1. ACF Titles & SEO Presentation
$hero_title = '';
$hero_subtitle = '';

if (function_exists('get_field')) {
    $hero_title = get_field('hero_title', $page_id) ?: get_field('hero_title', 'option');
    $hero_subtitle = get_field('hero_subtitle', $page_id) ?: get_field('hero_subtitle', 'option');
}

if (empty($hero_title)) {
    $hero_title = 'Отдых и лечение в Белокурихе';
}

if (empty($hero_subtitle)) {
    $hero_subtitle = 'Большой Алтай — официальный партнер санаториев, гостиниц и баз отдыха курорта Белокуриха. Подберем для вас выгодный во всех отношениях вариант отдыха и лечения, с учетом всех требований и пожеланий по размещению и профилю заболевания.';
}

// 2. Trust Features
$feature_icons = [
    'shield'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>',
    'tag'      => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>',
    'mountain' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m8 3 4 8 5-5 5 15H2L8 3z"/></svg>',
    'heart'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
    'star'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'check'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
];

$hero_features = [];
if (function_exists('get_field')) {
    $acf_features = get_field('hero_features', $page_id) ?: get_field('hero_features', 'option');
    if (!empty($acf_features) && is_array($acf_features)) {
        foreach ($acf_features as $feat) {
            if (!empty($feat['title'])) {
                $hero_features[] = [
                    'title'       => $feat['title'],
                    'description' => $feat['description'] ?? '',
                    'icon'        => $feat['icon'] ?? 'shield',
                ];
            }
        }
    }
}

if (empty($hero_features)) {
    $hero_features = [
        [
            'title'       => 'Мы в реестре туроператоров',
            'description' => 'ООО «Большой Алтай», РТО 026357',
            'icon'        => 'shield',
        ],
        [
            'title'       => 'Прямые цены здравниц',
            'description' => 'Путевки без наценок и переплат',
            'icon'        => 'tag',
        ],
    ];
}

// Strictly limit to 2 features to maintain clean visual balance
$hero_features = array_slice($hero_features, 0, 2);
?>

<!-- Presentation & SEO Section -->
<div class="bads-hero__presentation bads-stack bads-stack--lg">

    <!-- SEO Title & Subtitle via BADS UI Title -->
    <?php
    get_template_part(
        'template-parts/ui/title',
        null,
        [
            'level'           => 'h1',
            'size'            => 'h2',
            'title'           => $hero_title,
            'subtitle'        => $hero_subtitle,
            'divider'         => true,
            'divider_variant' => 'primary',
            'divider_width'   => '72px',
            'align'           => 'left',
        ]
    );
    ?>

    <!-- Trust & Safety Feature Grid (ACF Repeater or Defaults) -->
    <div class="bads-grid bads-grid--2 bads-grid--gap-sm bads-hero__trust-grid">
        <?php foreach ($hero_features as $feature) : ?>
            <div class="bads-trust-item">
                <div class="bads-trust-item__icon" aria-hidden="true">
                    <?= $feature_icons[$feature['icon']] ?? $feature_icons['shield']; ?>
                </div>
                <div class="bads-trust-item__content">
                    <h3 class="bads-trust-item__title"><?= esc_html($feature['title']); ?></h3>
                    <p class="bads-trust-item__desc"><?= esc_html($feature['description']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>