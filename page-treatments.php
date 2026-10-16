<?php
/**
 * ============================================================================
 * Archive / Treatments
 * ============================================================================
 */

get_header();
?>

<main>

    <?php
//     get_template_part(
//         'template-parts/pages/treatments/hero/hero'
//     );
    ?>

    <?php
    get_template_part(
        'template-parts/pages/treatments/list/list'
    );
    ?>

    <?php
    get_template_part(
        'template-parts/pages/treatments/cta/cta'
    );
    ?>

    <?php
//     get_template_part(
//         'template-parts/pages/treatments/sanatorium/sanatorium'
//     );
    ?>

</main>

<?php
get_footer();