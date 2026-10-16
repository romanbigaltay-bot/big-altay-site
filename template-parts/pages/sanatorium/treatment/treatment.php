<?php

if (!defined('ABSPATH')) {
    exit;
}

$treatments = bads_get_treatments();

if (empty($treatments)) {
    return;
}
?>

<section
    id="treatment"
    class="bads-section bads-section--lg">

    <div class="bads-container">

        <div class="bads-stack bads-stack--xl">

            <?php
				get_template_part(
					'template-parts/pages/sanatorium/treatment/workspace/workspace',
					null,
					[
						'treatments' => $treatments,
					]
				);
            ?>

        </div>

    </div>

</section>