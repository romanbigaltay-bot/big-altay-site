<?php
/**
 * ============================================================================
 * Treatments
 * Hero
 * ============================================================================
 */
?>

<section class="bads-section bads-section--md bads-section--hero">

    <div class="bads-container">

        <div class="bads-stack bads-stack--xl">

            <?php
            get_template_part(
                'template-parts/ui/breadcrumbs',
                null,
                [
                    'items' => [
                        [
                            'label' => 'Главная',
                            'url'   => home_url('/'),
                        ],
                        [
                            'label' => 'Лечение',
                        ],
                    ],
                ]
            );
            ?>

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => 'Лечение в санаториях Белокурихи',
                    'level' => 'h1',
                ]
            );
            ?>

            <?php
            get_template_part(
                'template-parts/ui/divider'
            );
            ?>

            <div class="bads-split bads-split--60-40 bads-split--start">

                <!-- =======================================================
                     LEFT
                ======================================================== -->

                <div class="bads-stack bads-stack--lg">

                    <?php
                    get_template_part(
                        'template-parts/ui/title',
                        null,
                        [
                            'title' => 'Подберите программу лечения по своему заболеванию',
                            'level' => 'h2',
                        ]
                    );
                    ?>

                    <div class="bads-cluster">

                        <?php
                        get_template_part(
                            'template-parts/ui/badge',
                            null,
                            [
                                'text' => '9 направлений',
                                'variant' => 'primary',
                            ]
                        );
                        ?>

                        <?php
                        get_template_part(
                            'template-parts/ui/badge',
                            null,
                            [
                                'text' => '12 санаториев',
                                'variant' => 'primary',
                            ]
                        );
                        ?>

                        <?php
                        get_template_part(
                            'template-parts/ui/badge',
                            null,
                            [
                                'text' => 'Индивидуальный подбор',
                                'variant' => 'primary',
                            ]
                        );
                        ?>

                    </div>

                    <div class="bads-content">

                        <p>
                            Белокуриха — крупнейший курорт Алтая, где природные лечебные
                            факторы сочетаются с современной медициной. Мы собрали все
                            направления лечения в одном месте, чтобы вы могли быстро найти
                            подходящую программу.
                        </p>

                    </div>

                    <div class="bads-grid bads-grid--2 bads-grid--gap-sm">

                        <div class="bads-list bads-list--compact">

                            <div class="bads-list__item">
                                <span class="bads-list__icon">✓</span>
                                <span class="bads-list__text">Радоновые ванны</span>
                            </div>

                            <div class="bads-list__item">
                                <span class="bads-list__icon">✓</span>
                                <span class="bads-list__text">Физиотерапия</span>
                            </div>

                        </div>

                        <div class="bads-list bads-list--compact">

                            <div class="bads-list__item">
                                <span class="bads-list__icon">✓</span>
                                <span class="bads-list__text">Лечебные грязи</span>
                            </div>

                            <div class="bads-list__item">
                                <span class="bads-list__icon">✓</span>
                                <span class="bads-list__text">Современная диагностика</span>
                            </div>

                        </div>

                    </div>

                    <div class="bads-cluster">

                        <?php
                        get_template_part(
                            'template-parts/ui/button',
                            null,
                            [
                                'text' => 'Получить консультацию',
                                'url' => '#consultation',
                                'variant' => 'primary',
                            ]
                        );
                        ?>

                        <?php
                        get_template_part(
                            'template-parts/ui/button',
                            null,
                            [
                                'text' => 'Смотреть направления',
                                'url' => '#treatments-list',
                                'variant' => 'outline',
                            ]
                        );
                        ?>

                    </div>

                </div>

                <!-- =======================================================
					 RIGHT
				======================================================== -->

				<div class="treatments-hero__visual">

					<div class="bads-overlap">

						<div class="bads-overlap__back">

							<img
								src="https://big-altay.ru/wp-content/uploads/2026/06/sanatorij-belokuriha-1-scaled.jpg"
								alt="Лечение в Белокурихе"
								loading="eager"
								decoding="async"
							>

						</div>

						<div class="bads-overlap__front
									bads-overlap__front--left
									bads-overlap__front--bottom">

							<div class="bads-card bads-card--glass bads-card--padding-lg">

								<div class="bads-grid bads-grid--3 bads-grid--gap-sm">

									<div class="bads-stack bads-stack--xs bads-stack--center">

										<strong class="treatments-hero__stat-number">
											5 000+
										</strong>

										<span class="treatments-hero__stat-label">
											Процедур
										</span>

									</div>

									<div class="bads-stack bads-stack--xs bads-stack--center">

										<strong class="treatments-hero__stat-number">
											400+
										</strong>

										<span class="treatments-hero__stat-label">
											Специалистов
										</span>

									</div>

									<div class="bads-stack bads-stack--xs bads-stack--center">

										<strong class="treatments-hero__stat-number">
											200+
										</strong>

										<span class="treatments-hero__stat-label">
											Методик
										</span>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

            </div>

        </div>

    </div>

</section>

<style>

.treatments-hero__visual{
    position:relative;
    display:flex;
    justify-content:flex-end;
    align-items:flex-start;
    min-height:540px;
}

.treatments-hero__visual .bads-overlap{
    position:relative;
    width:100%;
    
    height:540px;
}

.treatments-hero__visual .bads-overlap__back{
    position:absolute;
    top:0;
    right:0;
    width:92%;
}

.treatments-hero__visual .bads-overlap__back img{
    display:block;
    width:100%;
    height:470px;
    object-fit:cover;
    border-radius:var(--radius-xl);
}

.treatments-hero__visual .bads-overlap__front{
    position:absolute;
    left:0;
    bottom:0;
    width:82%;
    z-index:3;
}

.treatments-hero__stat-number{
    display:block;
    margin:0;
    color:var(--color-primary);
    font-family:var(--font-family-heading);
    font-size:var(--font-size-h3);
    font-weight:700;
    line-height:1;
    text-align:center;
}

.treatments-hero__stat-label{
    display:block;
    color:var(--color-text-muted);
    font-size:var(--font-size-sm);
    line-height:1.4;
    text-align:center;
}

@media(max-width:991px){

    .treatments-hero__visual{
        min-height:auto;
    }

    .treatments-hero__visual .bads-overlap{
        height:auto;
    }

    .treatments-hero__visual .bads-overlap__back,
    .treatments-hero__visual .bads-overlap__front{
        position:relative;
        inset:auto;
        width:100%;
    }

    .treatments-hero__visual .bads-overlap__back{
        margin-bottom:calc(var(--space-3xl) * -1);
    }

    .treatments-hero__visual .bads-overlap__back img{
        width:100%;
        height:360px;
    }

    .treatments-hero__visual .bads-overlap__front{
        padding-inline:var(--space-lg);
    }

}

</style>