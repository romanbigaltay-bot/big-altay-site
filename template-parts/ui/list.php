<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / List
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'items'   => [],
    'variant' => 'default',
    'class'   => '',

]);

if (empty($args['items']) || !is_array($args['items'])) {
    return;
}

$classes = [

    'bads-list',
    'bads-list--' . sanitize_html_class($args['variant']),

];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

$icons = [

    'check'   => 'status/check',
    'warning' => 'status/warning',
    'arrow'   => 'navigation/arrow-right',

];

?>

<ul class="<?= esc_attr($class); ?>">

    <?php foreach ($args['items'] as $item) : ?>

        <li class="bads-list__item">

            <?php if (isset($icons[$args['variant']])) : ?>

                <span class="bads-list__icon">

                    <?php
                    get_template_part(
                        'template-parts/ui/icon',
                        null,
                        [
                            'name' => $icons[$args['variant']],
                            'size' => 'sm',
                        ]
                    );
                    ?>

                </span>

            <?php endif; ?>

            <span class="bads-list__text">

                <?= esc_html($item); ?>

            </span>

        </li>

    <?php endforeach; ?>

</ul>