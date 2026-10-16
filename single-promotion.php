<?php
/**
 * Template Name: Promotion Single
 * Template: single-promotion.php
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();


get_template_part(
    'template-parts/pages/promotions/single-hero/single-hero'
);

get_template_part(
    'template-parts/pages/promotions/single-content/single-content'
);

get_template_part(
    'template-parts/pages/promotions/single-form/single-form'
);

get_footer();
