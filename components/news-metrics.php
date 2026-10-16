<?php
/**
 * Backward compatibility wrapper for news-metrics.php -> reactions.php
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

get_template_part('template-parts/components/reactions', null, $args);