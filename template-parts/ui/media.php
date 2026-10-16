<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Media
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    'image' => null,
    'size'  => 'full',
    'alt'   => '',

    /*
    |--------------------------------------------------------------------------
    | Appearance
    |--------------------------------------------------------------------------
    */

    'fit'      => 'cover',     // cover | contain
    'height'   => 'auto',      // auto | hero | banner
    'ratio'    => '',          // square | landscape | portrait | banner
    'rounded'  => false,       // bool or '2xl' | 'xl' | 'lg' | 'md'
    'shadow'   => '',          // sm | md | lg | xl

    /*
    |--------------------------------------------------------------------------
    | HTML
    |--------------------------------------------------------------------------
    */

    'width'            => '',
    'height_attr'      => '',
    'loading'          => 'lazy',
    'class'            => '',
    'placeholder_type' => 'image',

]);

$image = $args['image'];
$image_url = '';
$image_alt = $args['alt'];

if (is_array($image)) {

    $image_url = $image['sizes'][$args['size']] ?? $image['url'] ?? '';

    if (empty($image_alt)) {
        $image_alt = $image['alt'] ?? '';
    }

} elseif (is_numeric($image) && $image > 0) {

    $image_url = wp_get_attachment_image_url(
        $image,
        $args['size']
    );

    if (empty($image_alt)) {

        $image_alt = get_post_meta(
            $image,
            '_wp_attachment_image_alt',
            true
        );

    }

} elseif (is_string($image) && !empty($image)) {
    $image_url = $image;
}

if (!$image_url) {
    if (function_exists('bads_get_placeholder_url')) {
        $image_url = bads_get_placeholder_url($args['placeholder_type'] ?? 'image');
    } else {
        $image_url = get_template_directory_uri() . '/assets/images/placeholders/image.svg';
    }
    if (empty($image_alt)) {
        $image_alt = 'Медиа BADS';
    }
}

$classes = [

    'bads-media',

    'bads-media--fit-' . sanitize_html_class($args['fit']),

];

if (!empty($args['height'])) {

    $classes[] = 'bads-media--height-' . sanitize_html_class($args['height']);

}

if (!empty($args['ratio'])) {

    $classes[] = 'bads-media--ratio-' . sanitize_html_class($args['ratio']);

}

if ($args['rounded'] === '2xl') {

    $classes[] = 'bads-media--rounded-2xl';

} elseif ($args['rounded']) {

    $classes[] = 'bads-media--rounded';

}

if (!empty($args['shadow'])) {

    $classes[] = 'bads-media--shadow-' . sanitize_html_class($args['shadow']);

}

if (!empty($args['class'])) {

    $classes[] = sanitize_html_class($args['class']);

}

$width_attr = !empty($args['width']) ? ' width="' . esc_attr($args['width']) . '"' : '';
$height_attr = !empty($args['height_attr']) ? ' height="' . esc_attr($args['height_attr']) . '"' : '';
?>

<div class="<?= esc_attr(implode(' ', $classes)); ?>">

    <img
        class="bads-media__image"
        src="<?= esc_url($image_url); ?>"
        alt="<?= esc_attr($image_alt); ?>"
        <?= $width_attr; ?>
        <?= $height_attr; ?>
        loading="<?= esc_attr($args['loading']); ?>"
    >

</div>