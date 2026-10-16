<?php

if (!defined('ABSPATH')) {
    exit;
}

$content = get_the_content();

?>

<div class="bads-stack bads-stack--lg">

    <?php
    get_template_part(
        'template-parts/ui/title',
        null,
        [
            'title' => get_the_title(),
            'level' => 'h2',
            'size' => 'sm',
            'divider' => true,
            'divider_variant' => 'primary',
        ]
    );
    ?>

    <?php if (!empty($content)) : ?>

	<div class="bads-container--md" >
        <div class="bads-content">

            <?php the_content(); ?>

        </div>
	</div>
    <?php endif; ?>

</div>