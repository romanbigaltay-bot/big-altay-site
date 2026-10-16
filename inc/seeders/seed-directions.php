<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * One-Click Directions Content Seeder
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/directions-data-part1.php';
require_once __DIR__ . '/directions-data-part2.php';
require_once __DIR__ . '/directions-data-part3.php';

/**
 * Execute the directions seeder
 *
 * @return array Array of results with status and details
 */
function bads_run_directions_seeder(): array {
    $data_part1 = function_exists('bads_get_directions_data_part1') ? bads_get_directions_data_part1() : [];
    $data_part2 = function_exists('bads_get_directions_data_part2') ? bads_get_directions_data_part2() : [];
    $data_part3 = function_exists('bads_get_directions_data_part3') ? bads_get_directions_data_part3() : [];

    $all_directions = array_merge($data_part1, $data_part2, $data_part3);
    $results = [];

    foreach ($all_directions as $key => $dir) {
        $slug  = sanitize_title($dir['slug'] ?? $key);
        $title = $dir['title'] ?? 'Направление лечения';

        // 1. Find or create page
        $page = get_page_by_path($slug);
        if (!$page) {
            // Try by title
            $page_obj = get_page_by_title($title);
            if ($page_obj) {
                $page = $page_obj;
            }
        }

        $is_new = false;
        if ($page) {
            $post_id = $page->ID;
            wp_update_post([
                'ID'         => $post_id,
                'post_title' => $title,
                'post_name'  => $slug,
                'post_status'=> 'publish',
            ]);
        } else {
            $post_id = wp_insert_post([
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ]);
            $is_new = true;
        }

        if (is_wp_error($post_id) || !$post_id) {
            $results[] = [
                'status'  => 'error',
                'title'   => $title,
                'message' => 'Не удалось создать или обновить страницу',
            ];
            continue;
        }

        // 2. Set template
        update_post_meta($post_id, '_wp_page_template', 'page-treatment-direction.php');

        // 3. Update ACF Fields if ACF is active
        if (function_exists('update_field')) {
            // Hero
            update_field('direction_hero_title', $dir['hero_title'] ?? $title, $post_id);
            update_field('direction_hero_subtitle', $dir['hero_subtitle'] ?? '', $post_id);
            update_field('direction_hero_badge', $dir['hero_badge'] ?? '', $post_id);

            // Indications
            update_field('direction_indications_title', $dir['indications_title'] ?? 'Показания к лечению: кому это подходит', $post_id);
            update_field('direction_indications', $dir['indications'] ?? [], $post_id);

            // Methods
            update_field('direction_methods_title', $dir['methods_title'] ?? 'Методы лечения', $post_id);
            update_field('direction_methods', $dir['methods'] ?? [], $post_id);

            // Contraindications
            update_field('direction_contraindications_title', $dir['contraindications_title'] ?? 'Противопоказания к лечению', $post_id);
            update_field('direction_contraindications', $dir['contraindications'] ?? [], $post_id);
            update_field('direction_contraindications_notice', $dir['contraindications_notice'] ?? '', $post_id);

            // Programs
            update_field('direction_programs_title', $dir['programs_title'] ?? 'Программы лечения', $post_id);
            update_field('direction_programs_subtitle', $dir['programs_subtitle'] ?? '', $post_id);
            update_field('direction_programs', $dir['programs'] ?? [], $post_id);

            // Included
            update_field('direction_included_title', $dir['included_title'] ?? 'Что входит в стоимость путёвки', $post_id);
            update_field('direction_included_items', $dir['included_items'] ?? [], $post_id);
            update_field('direction_extra_items', $dir['extra_items'] ?? [], $post_id);

            // Sanatoriums
            update_field('direction_sanatoriums_title', $dir['sanatoriums_title'] ?? 'Санатории с лечением', $post_id);
            update_field('direction_sanatoriums', $dir['sanatoriums'] ?? [], $post_id);

            // Other Profiles
            update_field('direction_other_title', 'Другие профили лечения', $post_id);
            update_field('direction_other_profiles', $dir['other_profiles'] ?? [], $post_id);

            // FAQ
            update_field('direction_faq_title', 'Часто задаваемые вопросы', $post_id);
            update_field('direction_faq', $dir['faq'] ?? [], $post_id);

            // Form
            update_field('direction_form_title', $dir['form_title'] ?? 'Подберите идеальную программу лечения', $post_id);
            update_field('direction_form_subtitle', $dir['form_subtitle'] ?? '', $post_id);
        }

        $results[] = [
            'status'  => 'success',
            'action'  => $is_new ? 'создана' : 'обновлена',
            'title'   => $title,
            'slug'    => $slug,
            'id'      => $post_id,
            'url'     => get_permalink($post_id),
        ];
    }

    return $results;
}

/**
 * Handle secret URL triggering or Admin Hook
 */
add_action('init', function () {
    if (isset($_GET['bads_seed_directions']) && $_GET['bads_seed_directions'] === 'bads2026') {
        if (!current_user_can('manage_options') && !defined('WP_CLI')) {
            wp_die('Требуются права администратора или запуск через WP-CLI.');
        }

        $results = bads_run_directions_seeder();

        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>BADS Seeder Results</title>';
        echo '<style>body{font-family:sans-serif;padding:30px;background:#f8fafc;color:#1e293b;} table{border-collapse:collapse;width:100%;max-width:900px;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 4px 6px rgba(0,0,0,0.05);} th,td{padding:12px 16px;text-align:left;border-bottom:1px solid #e2e8f0;} th{background:#f1f5f9;font-weight:600;} .badge-success{color:#15803d;font-weight:bold;} .badge-new{color:#2563eb;font-weight:bold;}</style></head><body>';
        echo '<h2>🎉 BADS Directions Seeder: Успешно заполнено ' . count($results) . ' направлений</h2>';
        echo '<table><thead><tr><th>ID</th><th>Направление</th><th>Статус</th><th>Действие</th><th>Ссылка</th></tr></thead><tbody>';
        foreach ($results as $res) {
            echo '<tr>';
            echo '<td>' . esc_html($res['id'] ?? '-') . '</td>';
            echo '<td><strong>' . esc_html($res['title']) . '</strong></td>';
            echo '<td><span class="badge-success">✓ OK</span></td>';
            echo '<td>' . esc_html($res['action'] ?? '') . '</td>';
            echo '<td><a href="' . esc_url($res['url'] ?? '#') . '" target="_blank">Открыть страницу →</a></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '<p style="margin-top:20px;"><a href="' . admin_url('edit.php?post_type=page') . '" style="display:inline-block;padding:10px 18px;background:#0f172a;color:#fff;text-decoration:none;border-radius:6px;">Перейти в админку (Список страниц)</a></p>';
        echo '</body></html>';
        exit;
    }
});