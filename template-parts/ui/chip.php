<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Chip
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'text'          => '',
    'url'           => '',
    'variant'       => 'default',
    'size'          => 'md',

    'icon'          => '',
    'icon_position' => 'left',

    'type'          => 'span', // span | link | button

    'class'         => '',
    'disabled'      => false,

]);

$classes = [

    'bads-chip',
    'bads-chip--' . sanitize_html_class($args['variant']),
    'bads-chip--' . sanitize_html_class($args['size']),

];

if (!empty($args['icon'])) {

    $classes[] = 'bads-chip--with-icon';
    $classes[] = 'bads-chip--icon-' . sanitize_html_class($args['icon_position']);

}

if (!empty($args['class'])) {

    $classes[] = sanitize_html_class($args['class']);

}

$class = implode(' ', $classes);

$text = esc_html($args['text']);

ob_start();

if (!empty($args['icon']) && $args['icon_position'] === 'left') {

    get_template_part(
        'template-parts/ui/icon',
        null,
        [
            'name'  => $args['icon'],
            'size'  => 'sm',
            'class' => 'bads-chip__icon',
        ]
    );

}

?>

<span class="bads-chip__text">

    <?= $text; ?>

</span>

<?php

if (!empty($args['icon']) && $args['icon_position'] === 'right') {

    get_template_part(
        'template-parts/ui/icon',
        null,
        [
            'name'  => $args['icon'],
            'size'  => 'sm',
            'class' => 'bads-chip__icon',
        ]
    );

}

$content = ob_get_clean();

switch ($args['type']) :

    case 'link':
?>

<a
    class="<?= esc_attr($class); ?>"
    href="<?= esc_url($args['url']); ?>"
>

    <?= $content; ?>

</a>

<?php
        break;

    case 'button':
?>

<button
    class="<?= esc_attr($class); ?>"
    type="button"
    <?php disabled($args['disabled']); ?>
>

    <?= $content; ?>

</button>

<?php
        break;

    default:
?>

<span class="<?= esc_attr($class); ?>">

    <?= $content; ?>

</span>

<?php endswitch; ?>