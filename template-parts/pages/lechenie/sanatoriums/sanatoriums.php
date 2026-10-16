<?php 

if (!defined('ABSPATH')) { exit; } 

/** 
* ============================================================================ 
* Big Altay 
* Sanatoriums 
* ============================================================================ 
* 
* Оркестратор секции: 
* 
* - заголовок; 
* - BADS sidebar layout; 
* - sidebar; 
* - grid санаториев; 
* - реальные карточки санаториев. 
* 
* ============================================================================ 
*/
?>

<div class="bads-section bads-section--md">

	<div class="bads-container">

		<?php
		get_template_part(
			'template-parts/ui/title',
			null,
			[
				'title'    => 'Подберите санаторий',
				'subtitle' => 'Используйте фильтры, чтобы найти оптимальный вариант лечения.',
				'level'    => 'h2',
				'divider'  => true,
			]
		);
		?>
		
<!--
|--------------------------------------------------------------------------
| Sidebar
|--------------------------------------------------------------------------
-->

		<div
			class="bads-sidebar bads-sidebar--left bads-sidebar--xl bads-sidebar--filters"
			style="margin-top:var(--space-xl);">

			<?php
			get_template_part(
				'template-parts/pages/lechenie/sanatoriums/sidebar/sidebar'
			);
			?>

			<div class="bads-grid bads-grid--2 bads-grid--gap-sm">

				<?php

					$sanatoriums_query = bads_sanatoriums_query(
						[
							'paged'          => max(
								1,
								(int) get_query_var('paged')
							),
							'posts_per_page' => 12,
						]
					);

					?>

					<?php if ($sanatoriums_query->have_posts()) : ?>

						<?php while ($sanatoriums_query->have_posts()) : ?>

							<?php
							$sanatoriums_query->the_post();

							get_template_part(
								'template-parts/pages/lechenie/sanatoriums/card',
								null,
								[
									'sanatorium' => get_post(),
								]
							);
							?>

						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

					<?php else : ?>

						<div class="bads-content">

							<p>
								Санатории не найдены.
							</p>

						</div>

					<?php endif; ?>

		</div>

	</div>
	
</div>