<?php

if (!defined('ABSPATH')) {
    exit;
}

$treatments = $args['treatments'] ?? [];

if (empty($treatments)) {
    return;
}

?>

<style>

.bads-treatment-navigation{
	
    display:flex;
    flex-direction:column;
    gap:4px;

}

.bads-treatment-navigation .bads-btn{

    width:100%;
    justify-content:flex-start;
    text-align:left;

}

.bads-treatment-navigation .bads-btn__text{

    width:100%;

}

.bads-treatment-navigation .bads-btn.is-active{

    pointer-events:none;

}

</style>

<div class='bads-stack bads-stack--sm' >
	
<?php

get_template_part(
    'template-parts/ui/title',
    null,
    [
        'title'   => 'Профили лечения',

        /*
         * Семантически это H2,
         * визуально отображается как H4.
         */
        'level'   => 'h2',
        'size'    => 'h4',

        /*
         * Пока оставляем существующий Divider.
         * На следующем этапе усилим сам компонент Divider,
         * после чего здесь ничего менять уже не придется,
         * кроме variant.
         */
        'divider' => true,
		'divider_variant' => 'section',
    ]
);

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
				'size'    => 'sm',

				'icon'          => 'navigation/arrow-right',
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

</div>