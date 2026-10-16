<?php
add_action('wp_ajax_filter_sanatoriums', 'filter_sanatoriums');
add_action('wp_ajax_nopriv_filter_sanatoriums', 'filter_sanatoriums');

function filter_sanatoriums()
{
    try {
        // Получаем значения фильтров
        $starsItems = isset($_POST['sanatorium_stars']) ? $_POST['sanatorium_stars'] : array();
        $foodItems = isset($_POST['sanatorium_filter-food']) ? $_POST['sanatorium_filter-food'] : array();
        $treatmentsItems = isset($_POST['sanatorium_filter-treatment']) ? $_POST['sanatorium_filter-treatment'] : array();
        $poolItems = isset($_POST['sanatorium_filter-pool']) ? $_POST['sanatorium_filter-pool'] : array();
        $childrenTreatmentsItems = isset($_POST['sanatorium_filter-treatment-children']) ? $_POST['sanatorium_filter-treatment-children'] : array();
        $withChildrenItems = isset($_POST['sanatorium_filter-with-children']) ? $_POST['sanatorium_filter-with-children'] : array();
        $infrastructureItems = isset($_POST['sanatorium_filter-infrastructure']) ? $_POST['sanatorium_filter-infrastructure'] : array();
        $rentalItems = isset($_POST['sanatorium_filter-rental']) ? $_POST['sanatorium_filter-rental'] : array();
        $possibilitiesItems = isset($_POST['sanatorium_filter-possibilities']) ? $_POST['sanatorium_filter-possibilities'] : array();
        $distanceItems = isset($_POST['sanatorium_filter-distance']) ? $_POST['sanatorium_filter-distance'] : array();

        $priceFrom = isset($_POST['priceFrom']) ? sanitize_text_field($_POST['priceFrom']) : '';
        $priceTo = isset($_POST['priceTo']) ? sanitize_text_field($_POST['priceTo']) : '';
        $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';
        $limit = isset($_POST['limit']) ? sanitize_text_field($_POST['limit']) : '';

        $args = array(
            'post_type' => type_sanatoriums($type),
            'posts_per_page' => $limit,
            'meta_query' => array(
                'relation' => 'AND',
            ),
        );

        // Цена от
        if (!empty($priceFrom)) {
            $args['meta_query'][] = array(
                'key' => 'sanatorium_price',
                'value' => $priceFrom,
                'compare' => '>=',
                'type' => 'NUMERIC',
            );
        }

        // Цена до
        if (!empty($priceTo)) {
            $args['meta_query'][] = array(
                'key' => 'sanatorium_price',
                'value' => $priceTo,
                'compare' => '<=',
                'type' => 'NUMERIC',
            );
        }

        // Добавляем условия фильтрации, если значения переданы
        add_filter_condition('sanatorium_stars', $starsItems, 'IN', $args);
        add_filter_conditions('sanatorium_filter-food', $foodItems, $args);
        add_filter_conditions('sanatorium_filter-treatment', $treatmentsItems, $args);
        add_filter_conditions('sanatorium_filter-pool', $poolItems, $args);
        add_filter_conditions('sanatorium_filter-treatment-children', $childrenTreatmentsItems, $args);
        add_filter_conditions('sanatorium_filter-with-children', $withChildrenItems, $args);
        add_filter_conditions('sanatorium_filter-infrastructure', $infrastructureItems, $args);
        add_filter_conditions('sanatorium_filter-rental', $rentalItems, $args);
        add_filter_conditions('sanatorium_filter-possibilities', $possibilitiesItems, $args);
        add_filter_conditions('sanatorium_filter-distance', $distanceItems, $args);

        $query = new WP_Query($args);

        // Вывод результатов фильтрации
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/content/sanatorium', get_post_format(),
                    array(
                        'class' => 'swiper-slide',
                    ));
            }
        } else {
            echo '<div style="line-height: 25px;"><strong>Результаты отсутствуют</strong>. <br/>Попробуйте изменить условия фильтрации.</div>';
        }
    } catch (Exception $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }

    die();
}

// Функция для получения значений свойств фильтра
function display_acf_checkbox_values($field_key, $post_id = null)
{
    $field = get_field_object($field_key, $post_id);

    if ($field) { ?>
        <div class="filter__tab ac">
            <button type="button" class="filter__trigger ac-trigger"><?= esc_html($field['label']) ?></button>
            <div class="filter__panel ac-panel">
                <div class="filter__body" id="filter__body">
                    <?php
                    foreach ($field['choices'] as $value => $label) { ?>
                        <label class="filter__checkbox">
                            <input type="checkbox" name="<?= esc_html($field['name']) ?>"
                                   value="<?= esc_html($label) ?>">
                            <span class="filter__checkmark"><?= esc_html($label) ?></span>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}

// Функция для добавления условий фильтрации
function add_filter_condition($key, $value, $compare, &$args)
{
    if (!empty($value)) {
        $args['meta_query'][] = array(
            'key' => $key,
            'value' => $value,
            'compare' => $compare,
        );
    }
}

// Функция для добавления нескольких условий фильтрации
function add_filter_conditions($key, $values, &$args)
{
    if (!empty($values)) {
        foreach ($values as $value) {
            add_filter_condition($key, sprintf('"%s"', $value), 'LIKE', $args);
        }
    }
}

function type_sanatoriums($type) {
    if ($type === 'rest-belokurikha') {
        return 'rest-belokurikha';
    } else if ($type === 'rest-altai-mountains') {
        return 'rest-altai-mountains';
    } else {
        return 'sanatorium';
    }
}