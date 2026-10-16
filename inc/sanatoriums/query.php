<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * Big Altay
 * Sanatoriums Query
 * ============================================================================
 *
 * Универсальный запрос санаториев.
 *
 * Используется:
 *
 * 1. На общей странице /lechenie/
 *    — без фильтра лечения;
 *
 * 2. На странице конкретного профиля
 *    — с фильтром treatment;
 *
 * 3. В дальнейшем
 *    — с дополнительными фильтрами инфраструктуры и т.д.
 *
 * Возвращает экземпляр WP_Query.
 *
 * ============================================================================
 *
 * Аргументы:
 *
 * [
 *     'treatment'      => '',
 *     'infrastructure' => [],
 *     'paged'          => 1,
 *     'posts_per_page' => 12,
 * ]
 *
 * ============================================================================
 */

function bads_sanatoriums_query(array $args = []): WP_Query
{
    $args = wp_parse_args(
        $args,
        [
            'treatment'      => '',
            'infrastructure' => [],
            'paged'          => 1,
            'posts_per_page' => 12,
        ]
    );

    /*
    |--------------------------------------------------------------------------
    | Base Query
    |--------------------------------------------------------------------------
    */

    $query_args = [
        'post_type'      => 'sanatorium',
        'post_status'    => 'publish',
        'posts_per_page' => (int) $args['posts_per_page'],
        'paged'          => max(1, (int) $args['paged']),

        'orderby' => 'menu_order title',
        'order'   => 'ASC',
    ];

    /*
    |--------------------------------------------------------------------------
    | Meta Query
    |--------------------------------------------------------------------------
    */

    $meta_query = [
        'relation' => 'AND',
    ];

    /*
    |--------------------------------------------------------------------------
    | Treatment
    |--------------------------------------------------------------------------
    |
    | ACF field:
    |
    | sanatorium_filter-treatment
    |
    | Тип:
    | Checkbox
    |
    | ACF сохраняет checkbox как массив значений в postmeta.
    |
    | Поэтому используем LIKE.
    |
    */

    $treatment = trim((string) $args['treatment']);

    if ($treatment !== '') {

        $meta_query[] = [
            'key'     => 'sanatorium_filter-treatment',
            'value'   => $treatment,
            'compare' => 'LIKE',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Infrastructure
    |--------------------------------------------------------------------------
    |
    | ACF field:
    |
    | sanatorium_filter-infrastructure
    |
    | Тип:
    | Checkbox
    |
    | Несколько выбранных фильтров работают через AND:
    |
    | Санаторий должен иметь ВСЕ выбранные характеристики.
    |
    */

    $infrastructure = array_filter(
        array_map(
            'sanitize_text_field',
            (array) $args['infrastructure']
        )
    );

    foreach ($infrastructure as $item) {

        $meta_query[] = [
            'key'     => 'sanatorium_filter-infrastructure',
            'value'   => $item,
            'compare' => 'LIKE',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Apply Meta Query
    |--------------------------------------------------------------------------
    */

    if (count($meta_query) > 1) {
        $query_args['meta_query'] = $meta_query;
    }

    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    return new WP_Query($query_args);
}