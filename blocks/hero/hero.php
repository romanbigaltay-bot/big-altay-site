<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Block / Hero
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    /*
    |--------------------------------------------------------------------------
    | General
    |--------------------------------------------------------------------------
    */

    'variant' => 'default',

    'class' => '',


    /*
    |--------------------------------------------------------------------------
    | Slots
    |--------------------------------------------------------------------------
    */

    'header' => '',

    'content' => '',

    'aside' => '',

    'footer' => '',


    /*
    |--------------------------------------------------------------------------
    | Background
    |--------------------------------------------------------------------------
    */

    'background' => '',

    'overlay' => false,

]);


$allowed_variants = [

    'default',
    'light',
    'dark',
    'compact',

];


$variant = in_array(
    $args['variant'],
    $allowed_variants,
    true
)

? $args['variant']

: 'default';



$classes = [

    'bads-hero',

    'bads-hero--' . sanitize_html_class($variant),

];


if (!empty($args['background'])) {

    $classes[] = 'bads-hero--background';

}


if ($args['overlay']) {

    $classes[] = 'bads-hero--overlay';

}


if (!empty($args['class'])) {

    $classes[] = sanitize_html_class($args['class']);

}


$class = implode(' ', $classes);



?>

<section class="<?= esc_attr($class); ?>">

    <?php if (!empty($args['background'])) : ?>

        <div
            class="bads-hero__background"
            style="background-image:url('<?= esc_url($args['background']); ?>')"
            aria-hidden="true"
        ></div>

    <?php endif; ?>


    <div class="bads-container">

        <div class="bads-hero__layout">


            <div class="bads-hero__main">


                <?php if (!empty($args['header'])) : ?>

                    <div class="bads-hero__header">

                        <?= $args['header']; ?>

                    </div>

                <?php endif; ?>



                <?php if (!empty($args['content'])) : ?>

                    <div class="bads-hero__content">

                        <?= $args['content']; ?>

                    </div>

                <?php endif; ?>



                <?php if (!empty($args['footer'])) : ?>

                    <div class="bads-hero__footer">

                        <?= $args['footer']; ?>

                    </div>

                <?php endif; ?>


            </div>



            <?php if (!empty($args['aside'])) : ?>

                <aside class="bads-hero__aside">

                    <?= $args['aside']; ?>

                </aside>

            <?php endif; ?>


        </div>

    </div>


</section>