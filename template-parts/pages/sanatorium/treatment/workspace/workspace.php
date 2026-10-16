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

.bads-treatment-workspace{
    display:grid;
    grid-template-columns:442px minmax(0,1fr);
    gap:16px;
    align-items:start;
}

.bads-treatment-sidebar{
    position:sticky;
    top:100px;
    display:flex;
    flex-direction:column;
    gap:16px;
    align-self:start;
    z-index:9999;
}

.bads-treatment-content{
    min-width:0;
    padding-left:16px;
}

.bads-treatment-content > *{
    width:100%;
}

/* ==========================================================
   Mobile consultation
   ========================================================== */

.bads-treatment-consultation--mobile{
    display:none;
    margin-top:24px;
}

@media (max-width:992px){

    .bads-treatment-workspace{
        grid-template-columns:1fr;
    }

    .bads-treatment-sidebar{
        position:sticky;
		top:84px;
    }

    .bads-treatment-content{
        padding-left:0;
    }

    .bads-treatment-consultation--mobile{
        display:block;
    }

}
	
	.bads-treatment-consultation--desktop{
    display:block;
}

@media (max-width:992px){

    .bads-treatment-consultation--desktop{
        display:none;
    }

}

</style>

<div
    class="bads-treatment-workspace"
    data-treatment-workspace>

    <?php
    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/sidebar/sidebar',
        null,
        [
            'treatments' => $treatments,
        ]
    );
    ?>

    <div class="bads-treatment-content">

        <?php
        get_template_part(
            'template-parts/pages/sanatorium/treatment/workspace/content/content'
        );
        ?>

        <div class="bads-treatment-consultation--mobile">

            <div class="bads-card bads-card--glass bads-card--padding-lg">

                <?php
                get_template_part(
                    'template-parts/pages/sanatorium/treatment/workspace/sidebar/consultation'
                );
                ?>

            </div>

        </div>

    </div>

</div>