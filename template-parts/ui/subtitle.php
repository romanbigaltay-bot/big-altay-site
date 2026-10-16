<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Subtitle
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'text'    => '',
    'align'   => 'left',
    'variant' => 'default',
    'class'   => '',

]);

$classes = [

    'bads-subtitle',
    'bads-subtitle--' . sanitize_html_class($args['variant']),
    'bads-subtitle--align-' . sanitize_html_class($args['align']),

];

if (!empty($args['class'])) {

    $classes[] = sanitize_html_class($args['class']);

}

?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">

    <?= esc_html($args['text']); ?>

</div>