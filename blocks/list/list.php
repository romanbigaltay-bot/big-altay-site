<?php

$promotions = new WP_Query([
    'post_type'      => 'promotion',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if (!$promotions->have_posts()) {
    return;
}
?>

<section
    class="promotions-list"
    id="promotions-list"
>
    <div class="container">

        <h2 class="promotions-list__title">
            Актуальные акции
        </h2>

        <div class="promotions-list__divider"></div>

        <?php
        $counter = 0;

        while ($promotions->have_posts()) :
            $promotions->the_post();

            $counter++;

            $is_reversed = $counter % 2 === 0;
        ?>

            <article
                class="promotion-row <?php echo $is_reversed ? 'promotion-row--reverse' : ''; ?>"
            >

                <div class="promotion-row__image">

                    <a href="<?php the_permalink(); ?>">

                        <?php if (has_post_thumbnail()) : ?>

                            <?php the_post_thumbnail(
                                'large',
                                [
                                    'class' => 'promotion-row__img'
                                ]
                            ); ?>

                        <?php endif; ?>

                    </a>

                </div>

                <div class="promotion-row__content">

					<a
						href="<?php the_permalink(); ?>"
						class="promotion-row__content-link"
					>

						<h3 class="promotion-row__title">
							<?php the_title(); ?>
						</h3>
						
							<?php
							$max_discount = get_field(
								'promotion_max_discount'
							);

							if ($max_discount) :
							?>

								<div class="promotion-row__discount">
									Скидка <?php echo esc_html($max_discount); ?>
								</div>

							<?php endif; ?>
						
							<?php
								$period = get_field(
									'promotion_period'
								);

								if ($period) :
								?>

									<div class="promotion-row__period">

										<?php echo esc_html($period); ?>

									</div>

								<?php endif; ?>
						
								<?php
									$applies_to = get_field(
										'promotion_applies_to'
									);

									if ($applies_to) :
									?>

										<div class="promotion-row__benefits">

											<?php
											$items = explode(
												"\n",
												$applies_to
											);

											foreach ($items as $item) :

												$item = trim($item);

												if (!$item) {
													continue;
												}
											?>

												<div class="promotion-row__benefit">
													<?php echo esc_html($item); ?>
												</div>

											<?php endforeach; ?>

										</div>

									<?php endif; ?>

						<div class="promotion-row__description">

							<?php
							echo esc_html(
								get_field('promotion_short_description')
							);
							?>

						</div>

					</a>

					<div class="promotion-row__actions">

						<a
							href="#promotions-form"
							class="promotion-row__button"
						>
							Применить скидку
						</a>

					</div>

				</div>

            </article>

        <?php endwhile; ?>

    </div>
</section>

<?php wp_reset_postdata(); ?>