<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Front Page Hero Block (Orchestrator)
 * ============================================================================
 *
 * Decomposed architecture:
 * 1. hero-header.php  — SEO Title, Subtitle, Trust Feature signals
 * 2. hero-booking.php — Horizontal Filter Booking Bar with Bitrix24 sync
 * 3. hero-sidebar.php — News Column Glass Card + Subscription Modal
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="bads-section bads-section--hero bads-hero" id="hero">
    <div class="bads-container bads-container--xl">
        <!-- Main Sidebar Grid Layout: 1fr + 442px Desktop with Centered Vertical Alignment -->
        <div class="bads-sidebar bads-sidebar--right bads-sidebar--xl bads-sidebar--center">

            <!-- ========================================================
                 LEFT COLUMN: SEO, Trust Signals & Horizontal Booking Bar
                 (No Outer Containers — Pure Clean Flow Layout)
                 ======================================================== -->
            <div class="bads-hero__main bads-stack bads-stack--xl">
                <?php
                // 1. Presentation & SEO Section + 2 Trust Features
                get_template_part('template-parts/front-page/hero/hero-header');

                // 2. Booking Bar (3 Rows)
                get_template_part('template-parts/front-page/hero/hero-booking');
                ?>
            </div>

            <!-- ========================================================
                 RIGHT COLUMN: News Column Wrapped in Glass Card
                 ======================================================== -->
            <?php
            // 3. News Sidebar + Subscription Modal
            get_template_part('template-parts/front-page/hero/hero-sidebar');
            ?>

        </div>
    </div>
</section>