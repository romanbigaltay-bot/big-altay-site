<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Breadcrumbs
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'items' => [],

    'aria_label' => 'Хлебные крошки',

    'separator' => 'navigation/chevron-right',

    'class' => '',

]);


if (empty($args['items']) || !is_array($args['items'])) {
    return;
}


$classes = [
    'bads-breadcrumbs',
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

    <ol class="bads-breadcrumbs__list">


        <?php foreach ($args['items'] as $index => $item) : ?>


            <?php

            if (empty($item['label'])) {
                continue;
            }


            $is_current = !empty($item['current']);


            ?>


            <li class="bads-breadcrumbs__item">


                <?php if ($is_current) : ?>


                    <span
                        class="bads-breadcrumbs__current"
                        aria-current="page"
                    >
                        <?= esc_html($item['label']); ?>
                    </span>


                <?php elseif (!empty($item['url'])) : ?>


                    <a
                        class="bads-breadcrumbs__link"
                        href="<?= esc_url($item['url']); ?>"
                    >
                        <?= esc_html($item['label']); ?>
                    </a>


                <?php else : ?>


                    <span class="bads-breadcrumbs__text">
                        <?= esc_html($item['label']); ?>
                    </span>


                <?php endif; ?>



                <?php if ($index < count($args['items']) - 1) : ?>


                    <span
                        class="bads-breadcrumbs__separator"
                        aria-hidden="true"
                    >


                        <?php

                        get_template_part(
                            'template-parts/ui/icon',
                            null,
                            [
                                'name'  => $args['separator'],
                                'size'  => 'sm',
                            ]
                        );

                        ?>


                    </span>


                <?php endif; ?>


            </li>


        <?php endforeach; ?>


    </ol>


</nav>