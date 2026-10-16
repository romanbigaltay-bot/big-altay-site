<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Pagination
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [
    'items'      => [],
    'aria_label' => 'Навигация по страницам',
    'class'      => '',
]);

if (empty($args['items']) || !is_array($args['items'])) {
    return;
}

$classes = [
    'bads-pagination',
];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

?>

<nav
    class="<?= esc_attr($class); ?>"
    aria-label="<?= esc_attr($args['aria_label']); ?>"
>

    <ul class="bads-pagination__list">

        <?php foreach ($args['items'] as $item) :

            $item = wp_parse_args($item, [
                'type'     => 'page',
                'label'    => '',
                'url'      => '',
                'current'  => false,
                'disabled' => false,
                'attrs'    => [],
            ]);

            $allowed_types = [
                'page',
                'prev',
                'next',
                'ellipsis',
            ];

            if (!in_array($item['type'], $allowed_types, true)) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Ellipsis
            |--------------------------------------------------------------------------
            */

            if ($item['type'] === 'ellipsis') : ?>

                <li class="bads-pagination__item">

                    <span
                        class="bads-pagination__ellipsis"
                        aria-hidden="true"
                    >
                        &hellip;
                    </span>

                </li>

                <?php
                continue;

            endif;

            /*
            |--------------------------------------------------------------------------
            | Classes
            |--------------------------------------------------------------------------
            */

            $item_classes = [
                'bads-pagination__link',
            ];

            if ($item['current']) {
                $item_classes[] = 'is-current';
            }

            if ($item['disabled']) {
                $item_classes[] = 'is-disabled';
            }

            $item_class = implode(' ', $item_classes);

            /*
            |--------------------------------------------------------------------------
            | Extra Attributes
            |--------------------------------------------------------------------------
            */

            $extra_attributes = [];

            if (is_array($item['attrs'])) {

                foreach ($item['attrs'] as $name => $value) {

                    $name = trim((string) $name);

                    if ($name === '' || $value === null || $value === false) {
                        continue;
                    }

                    $name = preg_replace('/[^a-zA-Z0-9_\-:]/', '', $name);

                    if ($name === '') {
                        continue;
                    }

                    if ($value === true) {

                        $extra_attributes[] = esc_attr($name);

                    } else {

                        $extra_attributes[] = sprintf(
                            '%s="%s"',
                            esc_attr($name),
                            esc_attr((string) $value)
                        );

                    }

                }

            }

            $extra_attributes_html = !empty($extra_attributes)
                ? ' ' . implode(' ', $extra_attributes)
                : '';

            ?>

            <li class="bads-pagination__item">

                <?php if ($item['disabled']) : ?>

                    <span
                        class="<?= esc_attr($item_class); ?>"
                        aria-disabled="true"
                    >

                        <?php
                        switch ($item['type']) {

                            case 'prev':

                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => 'navigation/chevron-left',
                                        'size' => 'sm',
                                    ]
                                );

                                break;

                            case 'next':

                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => 'navigation/chevron-right',
                                        'size' => 'sm',
                                    ]
                                );

                                break;

                            default:

                                echo esc_html($item['label']);

                        }
                        ?>

                    </span>

                <?php else : ?>

                    <a
                        class="<?= esc_attr($item_class); ?>"
                        href="<?= esc_url($item['url']); ?>"
                        <?= $extra_attributes_html; ?>

                        <?php if ($item['current']) : ?>
                            aria-current="page"
                        <?php endif; ?>
                    >

                        <?php

                        switch ($item['type']) {

                            case 'prev':

                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => 'navigation/chevron-left',
                                        'size' => 'sm',
                                    ]
                                );

                                break;

                            case 'next':

                                get_template_part(
                                    'template-parts/ui/icon',
                                    null,
                                    [
                                        'name' => 'navigation/chevron-right',
                                        'size' => 'sm',
                                    ]
                                );

                                break;

                            default:

                                echo esc_html($item['label']);

                        }

                        ?>

                    </a>

                <?php endif; ?>

            </li>

        <?php endforeach; ?>

    </ul>

</nav>