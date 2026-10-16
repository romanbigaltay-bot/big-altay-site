<?php
/**
 * Template Name: Promotions Archive
 * Template: archive-promotion.php
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();


get_template_part(
    'template-parts/pages/promotions/archive-hero/archive-hero'
);

get_template_part(
    'template-parts/pages/promotions/promotion-cta/promotion-cta'
);

get_template_part(
    'template-parts/pages/promotions/archive-list/archive-list'
);

get_template_part(
    'template-parts/pages/promotions/single-form/single-form'
);

get_template_part(
    'template-parts/pages/promotions/advantages/advantages'
);

get_footer();
