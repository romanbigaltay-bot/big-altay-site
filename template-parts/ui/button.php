<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Button
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    'text' => '',

    /*
    |--------------------------------------------------------------------------
    | Action
    |--------------------------------------------------------------------------
    */

    'url'    => '',
    'type'   => 'link', // link | button | submit
    'target' => '',

    /*
    |--------------------------------------------------------------------------
    | Appearance
    |--------------------------------------------------------------------------
    */

    'variant' => 'primary',
    'size'    => 'md',

    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    */

    'icon'          => '',
    'icon_size'     => 'sm',
    'icon_position' => 'left',

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    'disabled' => false,

    /*
    |--------------------------------------------------------------------------
    | HTML
    |--------------------------------------------------------------------------
    */

    'class' => '',
    'attrs' => [],

]);

/*
|--------------------------------------------------------------------------
| Classes
|--------------------------------------------------------------------------
*/

$classes = [

    'bads-btn',
    'bads-btn--' . sanitize_html_class($args['variant']),
    'bads-btn--' . sanitize_html_class($args['size']),

];

if (!empty($args['icon'])) {

    $classes[] = 'bads-btn--with-icon';
    $classes[] = 'bads-btn--icon-' . sanitize_html_class($args['icon_position']);

}

if (!empty($args['class'])) {
    $classes[] = trim($args['class']);
}

$class = implode(' ', array_filter($classes));

/*
|--------------------------------------------------------------------------
| Attributes
|--------------------------------------------------------------------------
*/

$attributes = [];

if (is_array($args['attrs'])) {

    foreach ($args['attrs'] as $name => $value) {

        $name = trim((string) $name);

        if ($name === '') {
            continue;
        }

        $name = preg_replace('/[^a-zA-Z0-9_\-:]/', '', $name);

        if ($name === '') {
            continue;
        }

        if ($value === false || $value === null) {
            continue;
        }

        if ($value === true) {

            $attributes[] = esc_attr($name);

            continue;

        }

        $attributes[] = sprintf(
            '%s="%s"',
            esc_attr($name),
            esc_attr((string) $value)
        );

    }

}

$attributes_html = '';

if (!empty($attributes)) {

    $attributes_html = ' ' . implode(' ', $attributes);

}

/*
|--------------------------------------------------------------------------
| Common
|--------------------------------------------------------------------------
*/

$text = esc_html($args['text']);

$disabled = (bool) $args['disabled'];

/*
|--------------------------------------------------------------------------
| Icon renderer
|--------------------------------------------------------------------------
*/

$render_icon = static function ($name, $size) {

    if (empty($name)) {
        return;
    }

    get_template_part(
        'template-parts/ui/icon',
        null,
        [
            'name'  => $name,
            'size'  => $size,
            'class' => 'bads-btn__icon',
        ]
    );

};

?>

<?php if ($args['type'] === 'link') : ?>

<a
    class="<?= esc_attr($class); ?>"
    href="<?= esc_url($args['url']); ?>"
    <?= $attributes_html; ?>
    <?php if (!empty($args['target'])) : ?>
        target="<?= esc_attr($args['target']); ?>"
    <?php endif; ?>
>

    <?php if (!empty($args['icon']) && $args['icon_position'] === 'left') : ?>

        <?php $render_icon($args['icon'], $args['icon_size']); ?>

    <?php endif; ?>

    <?php if (!empty($text)) : ?>
    <span class="bads-btn__text"><?= $text; ?></span>
    <?php endif; ?>

    <?php if (!empty($args['icon']) && $args['icon_position'] === 'right') : ?>

        <?php $render_icon($args['icon'], $args['icon_size']); ?>

    <?php endif; ?>

</a>

<?php else : ?>

<button
    class="<?= esc_attr($class); ?>"
    type="<?= esc_attr($args['type']); ?>"
    <?php disabled($disabled); ?>
    <?= $attributes_html; ?>
>

    <?php if (!empty($args['icon']) && $args['icon_position'] === 'left') : ?>

        <?php $render_icon($args['icon'], $args['icon_size']); ?>

    <?php endif; ?>

    <?php if (!empty($text)) : ?>
    <span class="bads-btn__text"><?= $text; ?></span>
    <?php endif; ?>

    <?php if (!empty($args['icon']) && $args['icon_position'] === 'right') : ?>

        <?php $render_icon($args['icon'], $args['icon_size']); ?>

    <?php endif; ?>

</button>


<?php endif; ?>