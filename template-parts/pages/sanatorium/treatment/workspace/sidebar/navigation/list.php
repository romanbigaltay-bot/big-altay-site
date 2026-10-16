<?php

if (!defined('ABSPATH')) {
    exit;
}

$treatments = $args['treatments'] ?? [];
$show_icons = $args['show_icons'] ?? true;

if (empty($treatments)) {
    return;
}

?>

<nav
    class="bads-treatment-navigation"
    aria-label="Профили лечения">

    <?php foreach ($treatments as $index => $treatment) : ?>

        <?php

        get_template_part(
            'template-parts/ui/button',
            null,
            [
                'text'    => get_the_title($treatment),
                'type'    => 'button',
                'variant' => 'navigation',
                'size'    => 'xs',

                'icon'          => $show_icons ? 'navigation/arrow-right' : '',
				'icon_position' => 'left',

                'active' => $index === 0,

                'attrs' => [
                    'data-treatment-button' => true,
                    'data-treatment-id'     => $treatment->ID,
                    'aria-selected'         => $index === 0 ? 'true' : 'false',
                ],
            ]
        );

        ?>

    <?php endforeach; ?>

</nav>