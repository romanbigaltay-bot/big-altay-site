<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * Big Altay
 * Sanatorium Data
 * ============================================================================
 *
 * Нормализует данные санатория в единый массив для UI-компонентов.
 *
 * Источники:
 *
 * - post_title
 * - post_content
 * - sanatorium_promo
 * - sanatorium_stars
 * - sanatorium_price
 * - sanatorium_filter-treatment
 * - sanatorium_filter-infrastructure
 *
 * ============================================================================
 */

function bads_sanatorium_get_data(int $post_id): array
{
    $post = get_post($post_id);

    if (!$post || $post->post_type !== 'sanatorium') {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Image
    |--------------------------------------------------------------------------
    |
    | sanatorium_promo — ACF Image.
    |
    | Возвращаем URL изображения. В дальнейшем при необходимости здесь
    | можно централизованно перейти на массив ACF или attachment ID.
    |
    */

    $promo = get_field(
        'sanatorium_promo',
        $post_id
    );

    $image_url = '';

    if (is_array($promo)) {

        $image_url = $promo['url'] ?? '';

    } elseif (is_numeric($promo)) {

        $image_url = wp_get_attachment_image_url(
            (int) $promo,
            'large'
        );

    } elseif (is_string($promo)) {

        $image_url = $promo;
    }

    /*
    |--------------------------------------------------------------------------
    | Stars
    |--------------------------------------------------------------------------
    */

    $stars = get_field(
        'sanatorium_stars',
        $post_id
    );

    $stars = is_string($stars)
        ? trim($stars)
        : '';

    /*
    |--------------------------------------------------------------------------
    | Price
    |--------------------------------------------------------------------------
    */

    $price = get_field(
        'sanatorium_price',
        $post_id
    );

    $price = is_string($price)
        ? trim($price)
        : '';

    /*
    |--------------------------------------------------------------------------
    | Treatment Profiles
    |--------------------------------------------------------------------------
    */

    $treatments = get_field(
        'sanatorium_filter-treatment',
        $post_id
    );

    if (!is_array($treatments)) {
        $treatments = [];
    }

    $treatments = array_values(
        array_filter(
            array_map(
                static function ($item) {
                    return is_string($item)
                        ? trim($item)
                        : '';
                },
                $treatments
            )
        )
    );

    /*
    |--------------------------------------------------------------------------
    | Infrastructure
    |--------------------------------------------------------------------------
    */

    $infrastructure = get_field(
        'sanatorium_filter-infrastructure',
        $post_id
    );

    if (!is_array($infrastructure)) {
        $infrastructure = [];
    }

    $infrastructure = array_values(
        array_filter(
            array_map(
                static function ($item) {
                    return is_string($item)
                        ? trim($item)
                        : '';
                },
                $infrastructure
            )
        )
    );

    /*
    |--------------------------------------------------------------------------
    | Description
    |--------------------------------------------------------------------------
    |
    | Описание хранится в основном содержимом CPT.
    |
    | Здесь используем стандартный WordPress content filter, чтобы сохранить
    | существующую обработку контента.
    |
    */

    $description = apply_filters(
        'the_content',
        $post->post_content
    );

    /*
    |--------------------------------------------------------------------------
    | Return
    |--------------------------------------------------------------------------
    */

    return [
        'id' => $post_id,

        'title' => get_the_title($post_id),

        'url' => get_permalink($post_id),

        'image' => [
            'url' => $image_url,
            'alt' => get_the_title($post_id),
        ],

        'stars' => $stars,

        'price' => $price,

        'description' => $description,

        'treatments' => $treatments,

        'infrastructure' => $infrastructure,
    ];
}