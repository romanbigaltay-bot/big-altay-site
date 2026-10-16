<?php
/**
 * ============================================================================
 * BADS
 * Component / Page Intro
 * ============================================================================
 */

$args = wp_parse_args($args ?? [], [

    'title' => '',

    'breadcrumbs' => [],

]);

?>

<section class="bads-section">

    <div class="bads-container">

        <div class="bads-stack bads-stack--xl">

            <?php
            get_template_part(
                'template-parts/ui/breadcrumbs',
                null,
                [
                    'items' => $args['breadcrumbs'],
                ]
            );
            ?>

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => $args['title'],
                    'level' => 'h1',
                ]
            );
            ?>

            <?php
            get_template_part(
                'template-parts/ui/divider'
            );
            ?>

        </div>

    </div>

</section>