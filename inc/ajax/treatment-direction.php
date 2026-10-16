<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ============================================================================
 * Load Treatment Content
 * ============================================================================
 */

add_action(
    'wp_ajax_load_treatment_direction',
    'bads_load_treatment_direction'
);

add_action(
    'wp_ajax_nopriv_load_treatment_direction',
    'bads_load_treatment_direction'
);

function bads_load_treatment_direction(): void
{
    $post_id = absint($_POST['post_id'] ?? 0);

    if (!$post_id) {

        wp_send_json_error([
            'message' => 'Missing post ID.',
        ]);

    }

    $post = get_post($post_id);

    if (!$post) {

        wp_send_json_error([
            'message' => 'Post not found.',
        ]);

    }

    ob_start();

    /*
    |--------------------------------------------------------------------------
    | Источник контента
    |--------------------------------------------------------------------------
    */

    if (
        defined('BADS_TREATMENT_SOURCE')
        && BADS_TREATMENT_SOURCE === 'POSTS'
    ) {

        get_template_part(
    		'template-parts/pages/sanatorium/treatment/workspace/content/template',
            null,
            [
                'post_id' => $post_id,
            ]
        );

    } else {

        get_template_part(
    		'template-parts/pages/sanatorium/treatment/workspace/content/template',
            null,
            [
                'post_id' => $post_id,
            ]
        );

    }

    wp_send_json_success([
        'html' => ob_get_clean(),
    ]);
}