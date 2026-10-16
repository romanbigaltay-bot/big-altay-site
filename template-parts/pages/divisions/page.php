<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page Orchestrator
 * Path: template-parts/pages/divisions/page.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="bads-divisions-page" style="padding-top: var(--space-xl); padding-bottom: var(--space-4xl);">
    <div class="bads-container bads-container--xl">
        <div class="bads-sidebar bads-sidebar--editorial">
            
            <!-- Main Content Column (920px on the left, starting from Hero) -->
            <main class="bads-sidebar__main">
                <?php
                /**
                 * 1. Hero Block: Breadcrumbs, Title H1 & Subtitle
                 */
                get_template_part('template-parts/pages/divisions/hero/hero');

                /**
                 * 2. Division 1: Antique Fair
                 */
                get_template_part('template-parts/pages/divisions/antique/antique');

                /**
                 * 3. Division 2: Siberian Honey Center
                 */
                get_template_part('template-parts/pages/divisions/honey/honey');

                /**
                 * 4. Division 3: Souvenir Boutiques "Ty - Priroda"
                 */
                get_template_part('template-parts/pages/divisions/ty-priroda/ty-priroda');

                /**
                 * 5. Global CTA & Contacts
                 */
                get_template_part('template-parts/pages/divisions/cta/cta');
                ?>
            </main>

            <!-- Sticky Navigation Sidebar (440px on the right, starts directly from Hero) -->
            <aside class="bads-sidebar__aside bads-sidebar__aside--sticky">
                <?php get_template_part('template-parts/pages/divisions/sidebar/sidebar'); ?>
            </aside>

        </div>
    </div>
</div>
