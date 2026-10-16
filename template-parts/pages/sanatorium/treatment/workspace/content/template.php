<?php

if (!defined('ABSPATH')) {
    exit;
}

$post_id = absint($args['post_id'] ?? 0);

if (!$post_id) {
    return;
}

$post = get_post($post_id);

if (!$post) {
    return;
}

setup_postdata($post);

?>

<div class="bads-stack bads-stack--xl">

    <?php
    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/content/about/about',
        null,
        [
            'post_id' => $post_id,
        ]
    );
    ?>

    <?php
    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/content/gallery/gallery',
        null,
        [
            'post_id' => $post_id,
        ]
    );
    ?>

    <?php
    get_template_part(
        'template-parts/pages/sanatorium/treatment/workspace/content/procedures/procedures',
        null,
        [
            'post_id' => $post_id,
        ]
    );
    ?>

</div>

<?php

wp_reset_postdata();