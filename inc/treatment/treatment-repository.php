<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * BADS
 * Treatment Repository
 * ============================================================================
 */

/*
|--------------------------------------------------------------------------
| Source
|--------------------------------------------------------------------------
|
| PAGE  - страницы направлений лечения
| POSTS - записи treatments конкретного санатория
|
*/

const BADS_TREATMENT_SOURCE = 'POSTS';
// const BADS_TREATMENT_SOURCE = 'PAGE';

/**
 * ============================================================================
 * Public API
 * ============================================================================
 */

function bads_get_treatments(): array
{
    if (BADS_TREATMENT_SOURCE === 'PAGE') {
        return bads_get_treatment_direction_pages();
    }

    return bads_get_sanatorium_treatments();
}

/**
 * ============================================================================
 * Pages
 * ============================================================================
 */

function bads_get_treatment_direction_pages(): array
{
    static $pages = null;

    if ($pages !== null) {
        return $pages;
    }

    $pages = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'page-treatment-direction.php',
    ]);

    return $pages;
}

/**
 * ============================================================================
 * Treatments of current sanatorium
 * ============================================================================
 */

function bads_get_sanatorium_treatments(): array
{
    static $cache = [];

    $sanatorium_id = get_the_ID();

    if (!$sanatorium_id) {
        return [];
    }

    if (isset($cache[$sanatorium_id])) {
        return $cache[$sanatorium_id];
    }

    $cache[$sanatorium_id] = bads_sort_treatments(
    get_posts([

        'post_type'      => 'treatments',
        'post_status'    => 'publish',

        'posts_per_page' => -1,

        'orderby'        => 'menu_order',
        'order'          => 'ASC',

        'meta_query' => [
            [
                'key'     => 'treatments_sanatorium',
                'value'   => $sanatorium_id,
                'compare' => '=',
            ],
        ],

    ])

);

    return $cache[$sanatorium_id];
}

/**
 * ============================================================================
 * Sort Treatments By Title Length
 * ============================================================================
 */

function bads_sort_treatments(array $treatments): array
{
    usort(
        $treatments,
        static function ($a, $b) {

            $aLength = mb_strlen(trim($a->post_title));
            $bLength = mb_strlen(trim($b->post_title));

            if ($aLength === $bLength) {
                return strnatcasecmp($a->post_title, $b->post_title);
            }

            return $bLength <=> $aLength;

        }
    );

    return $treatments;
}