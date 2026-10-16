<?php
/**
 * ============================================================================
 * Sanatorium
 * About
 * ============================================================================
 */

?>

<section
    id="about"
    class="bads-section bads-section--lg"
>

    <div class="bads-container">

        <div class="bads-stack bads-stack--lg">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => get_post_type() === 'sanatorium'
                        ? 'Почему выбирают этот санаторий?'
                        : 'Почему выбирают именно это место?',
                    'level' => 'h2',
                ]
            );
            ?>

            <div
				class="bads-content"
				style="max-width: 760px;"
			>

				<?php the_content(); ?>

			</div>

        </div>

    </div>

</section>