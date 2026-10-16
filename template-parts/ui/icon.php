<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Icon
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'name'        => '',
    'size'        => 'md',
    'class'       => '',
    'decorative'  => true,

]);

if (empty($args['name'])) {
    return;
}

/*
|--------------------------------------------------------------------------
| Classes
|--------------------------------------------------------------------------
*/

$classes = [

    'bads-icon',
    'bads-icon--' . sanitize_html_class($args['size']),

];

if (!empty($args['class'])) {
    $classes[] = sanitize_html_class($args['class']);
}

$class = implode(' ', $classes);

/*
|--------------------------------------------------------------------------
| File
|--------------------------------------------------------------------------
*/

$icon = trim((string) $args['name'], "/\\");

/*
|--------------------------------------------------------------------------
| Allow only:
| a-z
| A-Z
| 0-9
| /
| _
| -
|--------------------------------------------------------------------------
*/

$icon = preg_replace('#[^a-zA-Z0-9/_-]#', '', $icon);

$icons_dir = wp_normalize_path(
    get_template_directory() . '/assets/images/icons/'
);

$file = wp_normalize_path(
    $icons_dir . $icon . '.svg'
);

/*
|--------------------------------------------------------------------------
| Security
|--------------------------------------------------------------------------
*/

if (
    strpos($file, $icons_dir) !== 0 ||
    !is_file($file) ||
    !is_readable($file)
) {
    return;
}

$svg = file_get_contents($file);

if ($svg === false) {
    return;
}

/*
|--------------------------------------------------------------------------
| Accessibility
|--------------------------------------------------------------------------
*/

if ($args['decorative']) {

    $svg = preg_replace(
        '/<svg\b/',
        '<svg aria-hidden="true" focusable="false"',
        $svg,
        1
    );

}

?>

<span class="<?= esc_attr($class); ?>">

    <?= $svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

</span>