<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Single Content (Promotions)
 * Path: template-parts/pages/promotions/single-content/single-content.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$content = get_the_content();
if (empty(trim((string) $content))) {
    return;
}
?>

<section class="bads-section bads-section--sm">
    <div class="bads-container bads-container--md">
        <div class="bads-card bads-card--default bads-card--padding-xl bads-content">
            <?php the_content(); ?>
        </div>
    </div>
</section>
