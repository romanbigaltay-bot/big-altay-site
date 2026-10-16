<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page / Global CTA & Contacts
 * Path: template-parts/pages/divisions/cta/cta.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$phone = get_field('phone_1', 2) ?: '8 800 500-07-34';
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);
?>

<section class="bads-section bads-section--lg bads-divisions-cta" id="contact" style="scroll-margin-top: 80px;">
    <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl" style="text-align: center;">
        <div class="bads-stack bads-stack--lg" style="max-width: 820px; margin: 0 auto;">
            
            <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.08em; font-size: 0.8125rem; color: var(--color-primary);">
                Гостеприимство &amp; Партнёрство
            </span>

            <div class="bads-stack bads-stack--xs">
                <?php
                get_template_part('template-parts/ui/title', null, [
                    'title'   => 'Планируете визит или хотите задать вопрос?',
                    'level'   => 'h2',
                    'size'    => 'h3',
                    'align'   => 'center',
                    'divider' => false,
                ]);
                ?>

                <p class="u-text-muted" style="font-size: 1.0625rem; line-height: 1.6; margin: 0;">
                    Мы всегда рады гостям в Центре сибирского мёда, на Антикварной ярмарке и в бутиках «Ты – природа», а также открыты к сотрудничеству с алтайскими мастерами, ремесленниками и художниками.
                </p>
            </div>

            <!-- Кнопки действий -->
            <div class="bads-cluster u-justify-center" style="gap: var(--space-md); padding-top: var(--space-xs);">
                <button
                    type="button"
                    class="bads-btn bads-btn--primary bads-btn--lg"
                    data-modal-trigger
                    data-modal-target="#bads-consultation-modal"
                >
                    <span class="bads-btn__text">Получить консультацию</span>
                </button>

                <button
                    type="button"
                    class="bads-btn bads-btn--outline bads-btn--lg"
                    data-modal-trigger
                    data-modal-target="#bads-consultation-modal"
                >
                    <span class="bads-btn__text">Узнать подробнее</span>
                </button>
            </div>

            <!-- Быстрые контакты -->
            <div class="bads-cluster u-justify-center u-items-center" style="gap: var(--space-lg); padding-top: var(--space-md); border-top: 1px dashed rgba(var(--brand-primary-rgb), 0.15); font-size: 0.9375rem;">
                <div>
                    <span class="u-text-muted">Бесплатный звонок по России:</span>
                    <a href="tel:<?= esc_attr($phone_clean); ?>" style="font-weight: 700; color: var(--color-primary); text-decoration: none; margin-left: 6px;">
                        <?= esc_html($phone); ?>
                    </a>
                </div>
                <div>
                    <span class="u-text-muted">Куратор проектов:</span>
                    <a href="tel:+79134524303" style="font-weight: 700; color: var(--color-primary); text-decoration: none; margin-left: 6px;">
                        +7 (913) 452-43-03
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
