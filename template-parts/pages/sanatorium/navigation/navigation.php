<?php
/**
 * ============================================================================
 * Sanatorium
 * Navigation
 * ============================================================================
 */

$post_type = get_post_type();
$stars     = (int) get_field('sanatorium_stars');

?>

<section class="resort-header bads-section bads-section--sm">

    <div class="container">

        <div class="resort-header__container">

        <!-- ==========================================================
             Navigation
        =========================================================== -->

        <nav class="resort-menu">

            <ul class="resort-menu__list">

                <li class="resort-menu__item">

                    <a
                        href="#about"
                        class="resort-menu__link"
                    >

                        <?= $post_type === 'sanatorium'
                            ? 'О САНАТОРИИ'
                            : 'О БАЗЕ'; ?>

                    </a>

                </li>
				
				<?php if ($post_type === 'sanatorium') : ?>

                    <li class="resort-menu__item">

                        <a
                            href="#treatment"
                            class="resort-menu__link"
                        >
                            ЛЕЧЕНИЕ
                        </a>

                    </li>

                <?php endif; ?>
				
				<li class="resort-menu__item">

                    <a
                        href="#numbers"
                        class="resort-menu__link"
                    >
                        ПРОЖИВАНИЕ
                    </a>

                </li>
				
				<li class="resort-menu__item">

                    <a
                        href="#fun"
                        class="resort-menu__link"
                    >
                        ДОСУГ
                    </a>

                </li>

                <li class="resort-menu__item">

                    <a
                        href="#food"
                        class="resort-menu__link"
                    >
                        ПИТАНИЕ
                    </a>

                </li>                

                <li class="resort-menu__item">

                    <a
                        href="#gallery"
                        class="resort-menu__link"
                    >
                        ГАЛЕРЕЯ
                    </a>

                </li>

                <li class="resort-menu__item">

                    <a
                        href="#price"
                        class="resort-menu__link"
                    >
                        ЦЕНЫ
                    </a>

                </li>                

                <li class="resort-menu__item">

                    <a
                        href="#reviews"
                        class="resort-menu__link"
                    >
                        ОТЗЫВЫ
                    </a>

                </li>                

            </ul>

        </nav>

        

        <!-- ==========================================================
             Lead Button
        =========================================================== -->

			<div class="resort-header__btn">

				<?php
				get_template_part(
					'template-parts/ui/button',
					null,
					[
						'text'          => 'ОСТАВИТЬ ЗАЯВКУ',
						'url'           => '#lead-form',
						'variant'       => 'primary',
						'icon'          => 'navigation/arrow-right',
						'icon_position' => 'right',
					]
				);
				?>

			</div>

    	</div>
		
	</div>

</section>