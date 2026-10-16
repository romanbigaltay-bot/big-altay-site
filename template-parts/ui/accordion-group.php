<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Accordion Group
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    /*
    |--------------------------------------------------------------------------
    | Behaviour
    |--------------------------------------------------------------------------
    */

    'mode'          => 'multiple',   // multiple | single
    'open_first'    => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'gap'           => 'md',

    /*
    |--------------------------------------------------------------------------
    | Items
    |--------------------------------------------------------------------------
    */

    'items'         => [],

    /*
    |--------------------------------------------------------------------------
    | Extra
    |--------------------------------------------------------------------------
    */

    'class'         => '',

]);


$classes = [

    'bads-accordion-group',
    'bads-accordion-group--gap-' . sanitize_html_class($args['gap'])

];

if (!empty($args['class'])) {

    $classes[] = sanitize_html_class($args['class']);

}

$class = implode(' ', $classes);

?>

<div

    class="<?= esc_attr($class); ?>"

    data-bads-accordion-group
    data-mode="<?= esc_attr($args['mode']); ?>"
    data-open-first="<?= $args['open_first'] ? 'true' : 'false'; ?>"

>

<?php

if (!empty($args['items'])) :

    foreach ($args['items'] as $index => $item) :

        $accordion_args = wp_parse_args($item, [

            'title'   => '',
            'content' => '',
            'open'    => false,

        ]);

        if (

            $args['open_first']
            &&

            $index === 0

        ) {

            $accordion_args['open'] = true;

        }

        get_template_part(

            'template-parts/ui/accordion',

            null,

            $accordion_args

        );

    endforeach;

endif;

?>

</div>