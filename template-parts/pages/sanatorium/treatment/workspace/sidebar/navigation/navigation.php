<?php

if (!defined('ABSPATH')) {
    exit;
}

$treatments = $args['treatments'] ?? [];

if (empty($treatments)) {
    return;
}

$is_mobile = wp_is_mobile();

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

/* ==========================================================
   Mobile Trigger
   ========================================================== */

.bads-treatment-navigation-trigger{

    display:flex;
    flex-direction:column;
    gap:4px;

}

.bads-treatment-navigation-trigger__label{

    font-size:var(--font-size-body-sm);
    color:var(--color-text-secondary);

}

.bads-treatment-navigation-trigger__current{

    font-family:var(--font-family-heading);
    font-size:var(--font-size-h5);
    font-weight:var(--font-weight-semibold);
    color:var(--color-text);

}
	
@media (max-width:992px){

    .bads-treatment-navigation .bads-btn{

        padding-inline:16px;

    }

}

</style>

<?php if (!$is_mobile) : ?>

	<div class='bads-stack bads-stack--sm' >
	
    <?php

    get_template_part(
        'template-parts/ui/title',
        null,
        [
            'title'           => 'Профили лечения',
            'level'           => 'h2',
            'size'            => 'h4',
            'divider'         => true,
            'divider_variant' => 'section',
        ]
    );

    ?>

    <?php

    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/sidebar/navigation/list',
        null,
        [
            'treatments' => $treatments,
			'show_icons' => true,
        ]
    );

    ?>

	</div>
	
<?php else : ?>

    <?php

    ob_start();

    ?>

    <div class="bads-treatment-navigation-trigger">

        <div class="bads-treatment-navigation-trigger__label">

            Профили лечения

        </div>

        <div
            class="bads-treatment-navigation-trigger__current"
            data-treatment-current>

            <?= esc_html(get_the_title($treatments[0])); ?>

        </div>

    </div>

    <?php

    $trigger = ob_get_clean();

    ob_start();

    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/sidebar/navigation/list',
        null,
        [
            'treatments' => $treatments,
			'show_icons' => false,
        ]
    );

    $content = ob_get_clean();

    get_template_part(
        'template-parts/ui/accordion',
        null,
        [
            'trigger' => $trigger,
            'content' => $content,
            'class'   => 'bads-treatment-navigation-accordion',
        ]
    );

    ?>

<?php endif; ?>