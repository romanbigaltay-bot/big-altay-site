<?php

if (!defined('ABSPATH')) {
    exit;
}

$treatments = $args['treatments'] ?? [];

?>

<div class="bads-treatment-sidebar">

    <div class="bads-card bads-card--glass bads-card--padding-lg">

        <?php

        get_template_part(
            'template-parts/pages/sanatorium/treatment/workspace/sidebar/navigation/navigation',
            null,
            [
                'treatments'=>$treatments,
            ]
        );

        ?>

    </div>

    <div class="bads-card bads-card--glass bads-card--padding-lg bads-treatment-consultation--desktop">

        <?php

        get_template_part(
            'template-parts/pages/sanatorium/treatment/workspace/sidebar/consultation'
        );

        ?>

    </div>

</div>