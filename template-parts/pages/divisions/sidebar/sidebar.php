<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page / Right Navigation Sidebar (440px)
 * Path: template-parts/pages/divisions/sidebar/sidebar.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$nav_items = [
    [
        'id'    => '#antique',
        'title' => 'Антикварная ярмарка',
    ],
    [
        'id'    => '#honey',
        'title' => 'Центр сибирского мёда',
    ],
    [
        'id'    => '#ty-priroda',
        'title' => 'Бутики «Ты – природа»',
    ],
    [
        'id'    => '#contact',
        'title' => 'Контакты и обратная связь',
    ],
];
?>

<div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
    <div class="bads-stack bads-stack--lg">

        <!-- Header -->
        <h3 class="bads-title bads-title--h4" style="margin: 0;">
            Наши проекты
        </h3>

        <!-- Vertical Navigation: clean list of names -->
        <nav class="bads-stack bads-stack--xs" aria-label="Проекты компании">
            <?php foreach ($nav_items as $item) : ?>
                <a
                    href="<?= esc_url($item['id']); ?>"
                    class="bads-anchor-nav__link"
                    style="display: block; padding: 12px 16px; border-radius: var(--radius-lg); text-decoration: none; font-weight: 700; font-size: 0.9375rem; color: var(--color-text); border: 1px solid rgba(var(--brand-primary-rgb), 0.08); background: rgba(255, 255, 255, 0.4); transition: all 0.25s ease;"
                    onmouseover="this.style.background='rgba(var(--brand-primary-rgb), 0.07)'; this.style.borderColor='rgba(var(--brand-primary-rgb), 0.25)'; this.style.transform='translateX(4px)';"
                    onmouseout="this.style.background='rgba(255, 255, 255, 0.4)'; this.style.borderColor='rgba(var(--brand-primary-rgb), 0.08)'; this.style.transform='none';"
                >
                    <?= esc_html($item['title']); ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <!-- Consultation Action -->
        <div class="bads-stack bads-stack--sm" style="padding-top: var(--space-md); border-top: 1px dashed rgba(var(--brand-primary-rgb), 0.18);">
            <div class="bads-stack bads-stack--3xs">
                <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">
                    Появились вопросы?
                </div>
                <p class="u-text-muted" style="font-size: 0.875rem; line-height: 1.5; margin: 0;">
                    Ответим на любые вопросы! Звоните на номер <a href="tel:88005000734" style="font-weight: 700; color: var(--color-primary); text-decoration: none; white-space: nowrap;">8 (800) 500-07-34</a> (бесплатно по РФ) или оставьте заявку на консультацию.
                </p>
            </div>

            <button
                type="button"
                class="bads-btn bads-btn--primary bads-btn--md u-w-full"
                data-modal-trigger
                data-modal-target="#bads-consultation-modal"
            >
                <span class="bads-btn__text">Получить консультацию</span>
            </button>
        </div>

    </div>
</div>
