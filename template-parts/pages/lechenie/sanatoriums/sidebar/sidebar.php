<?php

if (!defined('ABSPATH')) {
    exit;
}

?>

<aside class="bads-sidebar__aside--sticky">

    <div class="bads-stack bads-stack--lg">

        <?php
        get_template_part(
            'template-parts/pages/lechenie/sanatoriums/sidebar/filters/filters'
        );
        ?>

        <?php
        get_template_part(
            'template-parts/pages/lechenie/sanatoriums/sidebar/consultation/consultation'
        );
        ?>

    </div>

</aside>