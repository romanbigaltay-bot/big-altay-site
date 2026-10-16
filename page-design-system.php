<?php
/*
Template Name: Design System
*/

get_header();
?>

<section class="ds-page">
		
	     <section class="bads-section bads-section--lg">

			<div class="bads-container bads-container--xl">

				<div class="bads-split bads-split--wide">

					<!-- Левая колонка -->

					<div class="bads-stack bads-stack--lg bads-stack--start">

						<?php
						get_template_part(
							'template-parts/ui/badge',
							null,
							[
								'text'    => 'Big Altay Design System',
								'variant' => 'primary',
							]
						);
						?>
						
						<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'prefix' => 'Санаторий',
									'title'  => 'Белокуриха',
									'level'  => 'h1',
								]
							);
						?>
						

						<?php
						get_template_part(
							'template-parts/ui/title',
							null,
							[
								'title'   => 'Компоненты и правила разработки интерфейсов',
								'level'   => 'h1',
								'divider' => true,
							]
						);
						?>

						<p>

							Единая дизайн-система проекта «Большой Алтай».<br>
							Здесь собраны фундаментальные компоненты, Layout,
							правила их использования и готовые примеры.

						</p>

						<div class="bads-cluster bads-cluster--md">

							<?php
							get_template_part(
								'template-parts/ui/button',
								null,
								[
									'text' => 'UI Components',
									'url' => '#',
									'variant' => 'primary',
								]
							);
							?>

							<?php
							get_template_part(
								'template-parts/ui/button',
								null,
								[
									'text' => 'Layouts',
									'url' => '#',
									'variant' => 'outline',
								]
							);
							?>

						</div>

					</div>


					<!-- Правая колонка -->

					<div>

						<div class="bads-card bads-card--glass bads-card--padding-xl">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Структура BADS',
									'level' => 'h3',
								]
							);
							?>


						</div>

					</div>

				</div>

			</div>

		</section>
		
		<!-- =======================================================
			 UI Components
		======================================================== -->

		<section class="bads-section">

			<div class="bads-container">

				<div class="bads-stack bads-stack--xl">

					<?php
					get_template_part(
						'template-parts/ui/title',
						null,
						[
							'title' => 'UI Components',
							'subtitle' => 'Базовые элементы интерфейса. Из них строятся Layout, Blocks и страницы.',
							'level' => 'h2',
							'divider' => true,
						]
					);
					?>

					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Button',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>

									Основной компонент для любых действий пользователя.

								</p>

							</div>

							<div class="bads-cluster">

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Primary',
										'url' => '#',
										'variant' => 'primary',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Secondary',
										'url' => '#',
										'variant' => 'secondary',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Outline',
										'url' => '#',
										'variant' => 'outline',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Ghost',
										'url' => '#',
										'variant' => 'ghost',
									]
								);
								?>

							</div>
							
							<div class="bads-cluster">

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Позвонить',
										'url' => '#',
										'variant' => 'primary',
										'icon' => 'communication/phone',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Написать',
										'url' => '#',
										'variant' => 'secondary',
										'icon' => 'communication/email',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Поиск',
										'url' => '#',
										'variant' => 'outline',
										'icon' => 'actions/search',
									]
								);
								?>

								</div>
							
							<div class="bads-cluster">

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Подробнее',
										'url' => '#',
										'variant' => 'primary',
										'icon' => 'navigation/arrow-right',
										'icon_position' => 'right',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Назад',
										'url' => '#',
										'variant' => 'outline',
										'icon' => 'navigation/arrow-left',
										'icon_position' => 'left',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/button',
									null,
									[
										'text' => 'Развернуть',
										'url' => '#',
										'variant' => 'ghost',
										'icon' => 'navigation/chevron-down',
										'icon_position' => 'right',
									]
								);
								?>

								</div>
							
							<div class="bads-cluster">

								<?php
								foreach (['sm', 'md', 'lg'] as $size) {

									get_template_part(
										'template-parts/ui/button',
										null,
										[
											'text' => strtoupper($size),
											'url' => '#',
											'variant' => 'primary',
											'size' => $size,
											'icon' => 'navigation/arrow-right',
											'icon_position' => 'right',
										]
									);

								}
								?>

								</div>
							
							<div class="bads-cluster">

								<?php

								$variants = [
									'primary',
									'secondary',
									'outline',
									'ghost',
									'link',
								];

								foreach ($variants as $variant) {

									get_template_part(
										'template-parts/ui/button',
										null,
										[
											'text' => ucfirst($variant),
											'url' => '#',
											'variant' => $variant,
											'icon' => 'navigation/arrow-right',
											'icon_position' => 'right',
										]
									);

								}

								?>

								</div>

						</div>

					</div>

					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'List',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-grid bads-grid--2">

								<?php
								get_template_part(
									'template-parts/ui/list',
									null,
									[
										'variant' => 'default',
										'items' => [
											'Первый пункт',
											'Второй пункт',
											'Третий пункт',
										],
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/list',
									null,
									[
										'variant' => 'check',
										'items' => [
											'Первый пункт',
											'Второй пункт',
											'Третий пункт',
										],
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/list',
									null,
									[
										'variant' => 'warning',
										'items' => [
											'Первый пункт',
											'Второй пункт',
											'Третий пункт',
										],
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/list',
									null,
									[
										'variant' => 'arrow',
										'items' => [
											'Первый пункт',
											'Второй пункт',
											'Третий пункт',
										],
									]
								);
								?>

							</div>

						</div>

					</div>

					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Badge',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>

									Компактный элемент для маркировки информации.

								</p>

							</div>

							<div class="bads-cluster">

								<?php
								get_template_part(
									'template-parts/ui/badge',
									null,
									[
										'text' => 'Primary',
										'variant' => 'primary',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/badge',
									null,
									[
										'text' => 'Accent',
										'variant' => 'accent',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/badge',
									null,
									[
										'text' => 'Success',
										'variant' => 'success',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/badge',
									null,
									[
										'text' => 'Warning',
										'variant' => 'warning',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/badge',
									null,
									[
										'text' => 'Neutral',
										'variant' => 'neutral',
									]
								);
								?>

							</div>
							
						</div>
						
					</div>
						
					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Chip',
									'level' => 'h3',
								]
							);
							?>						
							
							<div class="bads-cluster">
									
								<?php
									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Default',
										]
									);

									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Primary',
											'variant' => 'primary',
										]
									);

									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Accent',
											'variant' => 'accent',
										]
									);

									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Outline',
											'variant' => 'outline',
										]
									);

									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Phone',
											'variant' => 'primary',
											'icon' => 'communication/phone',
										]
									);

									get_template_part(
										'template-parts/ui/chip',
										null,
										[
											'text' => 'Search',
											'variant' => 'outline',
											'icon' => 'actions/search',
											'icon_position' => 'right',
										]
									);
								?>
								
							</div>
							
						</div>
							
					</div>
					
					
					
					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Accordion',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>

									Универсальный раскрывающийся компонент для FAQ, меню, фильтров и любых сворачиваемых блоков.

								</p>

							</div>

							<div class="bads-stack">

								<?php

								get_template_part(
									'template-parts/ui/accordion',
									null,
									[
										'title'   => 'Можно ли приехать с детьми?',
										'content' => '
											<p>Да. Большинство наших санаториев принимает гостей с детьми. Для каждого санатория условия могут отличаться.</p>
										',
									]
								);

								get_template_part(
									'template-parts/ui/accordion',
									null,
									[
										'title'   => 'Какие документы необходимы?',
										'open'    => true,
										'content' => '
											<ul>
												<li>Паспорт</li>
												<li>Полис ОМС или ДМС (при необходимости)</li>
												<li>Санаторно-курортная карта</li>
											</ul>
										',
									]
								);

								get_template_part(
									'template-parts/ui/accordion',
									null,
									[
										'title'   => 'Есть ли парковка?',
										'variant' => 'bordered',
										'content' => '
											<p>Да, возле каждого санатория имеется бесплатная парковка для гостей.</p>
										',
									]
								);

								get_template_part(
									'template-parts/ui/accordion',
									null,
									[
										'title'   => 'Возможен ли поздний заезд?',
										'variant' => 'filled',
										'content' => '
											<p>Да. Просто предупредите менеджера заранее, чтобы мы подготовили номер к вашему прибытию.</p>
										',
									]
								);

								get_template_part(
									'template-parts/ui/accordion',
									null,
									[
										'title'    => 'Недоступный Accordion',
										'disabled' => true,
										'content'  => '
											<p>Этот текст никогда не откроется.</p>
										',
									]
								);

								?>

							</div>

						</div>

					</div>

				<!-- =======================================================
					 Accordion Group / Multiple
				========================================================= -->

				<div class="bads-card bads-card--glass bads-card--padding-xl">

					<div class="bads-stack bads-stack--xl">

						<?php
						get_template_part(
							'template-parts/ui/title',
							null,
							[
								'title' => 'Несколько независимых групп',
								'level' => 'h3',
							]
						);
						?>

						<div class="bads-grid bads-grid--2">

							<div>

								<?php
								get_template_part(
									'template-parts/ui/subtitle',
									null,
									[
										'text' => 'Документы',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/accordion-group',
									null,
									[
										'items' => [

											[
												'title'   => 'Паспорт',
												'content' => '<p>Необходим оригинал паспорта.</p>',
											],

											[
												'title'   => 'Полис',
												'content' => '<p>Возьмите действующий полис ОМС.</p>',
											],

										],
									]
								);
								?>

							</div>

							<div>

								<?php
								get_template_part(
									'template-parts/ui/subtitle',
									null,
									[
										'text' => 'Оплата',
									]
								);
								?>

								<?php
								get_template_part(
									'template-parts/ui/accordion-group',
									null,
									[
										'items' => [

											[
												'title'   => 'Онлайн',
												'content' => '<p>Оплата банковской картой.</p>',
											],

											[
												'title'   => 'В офисе',
												'content' => '<p>Наличными или картой.</p>',
											],

										],
									]
								);
								?>

							</div>

						</div>

					</div>

				</div>
					
					<!-- =======================================================
						 Accordion Group / Rich Content
					========================================================= -->

					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Accordion с произвольным контентом',
									'level' => 'h3',
								]
							);
							?>

							<?php
							get_template_part(
								'template-parts/ui/accordion-group',
								null,
								[
									'items' => [

										[

											'title' => 'Что входит в программу',

											'content' => '

												<ul class="bads-list bads-list--check">

													<li>Консультация врача</li>

													<li>Проживание</li>

													<li>Питание</li>

													<li>Процедуры</li>

												</ul>

											',

										],

										[

											'title' => 'Дополнительная информация',

											'content' => '

												<p>

													Для каждого гостя составляется индивидуальная программа лечения.

												</p>

												<p>

													Перед приездом рекомендуется проконсультироваться с менеджером.

												</p>

											',

										],

									],
								]
							);
							?>

						</div>

					</div>
					
					<!-- =======================================================
						 Tabs
					========================================================= -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">

								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Tabs',
										'subtitle' => 'Компонент для переключения между связанными разделами контента.',
										'level' => 'h2',
										'divider' => true,
									]
								);
								?>

								<!-- ===================================================
									 Example 1
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Базовый Tabs',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs',
											null,
											[
												'items' => [

													[
														'title' => 'Описание',
														'content' => '<p>Описание санатория, услуги и преимущества.</p>',
													],

													[
														'title' => 'Лечение',
														'content' => '<p>Большой список лечебных программ.</p>',
													],

													[
														'title' => 'Отзывы',
														'content' => '<p>Отзывы наших гостей.</p>',
													],

												],
											]
										);
										?>

									</div>

								</div>

								<!-- ===================================================
									 Example 2
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Большой объем контента',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs',
											null,
											[
												'items' => [

													[
														'title' => 'О санатории',
														'content' => '
															<p>Первый абзац.</p>
															<p>Второй абзац.</p>
															<p>Третий абзац.</p>
														',
													],

													[
														'title' => 'Размещение',
														'content' => '
															<ul>
																<li>Стандарт</li>
																<li>Комфорт</li>
																<li>Люкс</li>
															</ul>
														',
													],

													[
														'title' => 'Питание',
														'content' => '
															<p>Трехразовое питание по системе заказного меню.</p>
														',
													],

												],
											]
										);
										?>

									</div>

								</div>

								<!-- ===================================================
									 Example 3
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Пять вкладок',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs',
											null,
											[
												'items' => [

													[
														'title' => 'Услуги',
														'content' => '<p>Контент первой вкладки.</p>',
													],

													[
														'title' => 'Цены',
														'content' => '<p>Контент второй вкладки.</p>',
													],

													[
														'title' => 'Документы',
														'content' => '<p>Контент третьей вкладки.</p>',
													],

													[
														'title' => 'Вопросы',
														'content' => '<p>Контент четвертой вкладки.</p>',
													],

													[
														'title' => 'Контакты',
														'content' => '<p>Контент пятой вкладки.</p>',
													],

												],
											]
										);
										?>

									</div>

								</div>

							</div>

						</div>

					</section>
					
					<!-- =======================================================
						 Tabs Group
					========================================================= -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">

								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Tabs Group',
										'subtitle' => 'Обёртка для нескольких независимых Tabs-компонентов на одной странице.',
										'level' => 'h2',
										'divider' => true,
									]
								);
								?>

								<!-- ===================================================
									 Example 1
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Одна группа Tabs с одним набором вкладок',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs-group',
											null,
											[
												'groups' => [

													[
														'title' => 'Санаторий',
														'subtitle' => 'Основная информация',
														'tabs' => [

															[
																'title' => 'Описание',
																'content' => '<p>Описание санатория, его преимущества и общая информация.</p>',
															],

															[
																'title' => 'Номера',
																'content' => '<p>Варианты размещения и категории номеров.</p>',
															],

															[
																'title' => 'Контакты',
																'content' => '<p>Адрес, телефон, схема проезда.</p>',
															],

														],
													],

												],
											]
										);
										?>

									</div>

								</div>

								<!-- ===================================================
									 Example 2
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Одна группа Tabs с двумя независимыми Tabs-компонентами',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs-group',
											null,
											[
												'groups' => [

													[
														'title' => 'Документы',
														'tabs' => [

															[
																'title' => 'Паспорт',
																'content' => '<p>Нужен оригинал паспорта.</p>',
															],

															[
																'title' => 'Полис',
																'content' => '<p>Действующий полис ОМС.</p>',
															],

														],
													],

													[
														'title' => 'Оплата',
														'tabs' => [

															[
																'title' => 'Онлайн',
																'content' => '<p>Оплата банковской картой на сайте.</p>',
															],

															[
																'title' => 'В офисе',
																'content' => '<p>Оплата наличными или картой в офисе.</p>',
															],

														],
													],

												],
											]
										);
										?>

									</div>

								</div>

								<!-- ===================================================
									 Example 3
								==================================================== -->

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<?php
										get_template_part(
											'template-parts/ui/subtitle',
											null,
											[
												'text' => 'Одна группа Tabs с тремя наборами и сложным контентом',
											]
										);
										?>

										<?php
										get_template_part(
											'template-parts/ui/tabs-group',
											null,
											[
												'groups' => [

													[
														'title' => 'Лечение',
														'tabs' => [

															[
																'title' => 'Показания',
																'content' => '
																	<ul class="bads-list bads-list--check">
																		<li>Заболевания опорно-двигательного аппарата</li>
																		<li>Болезни нервной системы</li>
																		<li>Проблемы дыхательной системы</li>
																	</ul>
																',
															],

															[
																'title' => 'Противопоказания',
																'content' => '
																	<ul class="bads-list bads-list--warning">
																		<li>Острые инфекционные заболевания</li>
																		<li>Обострение хронических процессов</li>
																		<li>Некоторые тяжелые формы заболеваний</li>
																	</ul>
																',
															],

														],
													],

													[
														'title' => 'Проживание',
														'tabs' => [

															[
																'title' => 'Стандарт',
																'content' => '<p>Уютные номера для комфортного отдыха.</p>',
															],

															[
																'title' => 'Комфорт',
																'content' => '<p>Улучшенные номера с расширенным набором удобств.</p>',
															],

															[
																'title' => 'Люкс',
																'content' => '<p>Просторные номера премиального уровня.</p>',
															],

														],
													],

													[
														'title' => 'Дополнительно',
														'tabs' => [

															[
																'title' => 'Питание',
																'content' => '<p>Трехразовое питание по системе заказного меню.</p>',
															],

															[
																'title' => 'Досуг',
																'content' => '<p>Экскурсии, прогулки, культурные программы.</p>',
															],

														],
													],

												],
											]
										);
										?>

									</div>

								</div>

							</div>

						</div>

					</section>
					
					<!-- =======================================================
					 Pagination
					======================================================== -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">

								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Pagination',
										'subtitle' => 'Универсальная навигация по страницам BADS без привязки к источнику данных.',
										'level' => 'h3',
									]
								);
								?>


								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">


										<div class="bads-content">

											<p>
												Компонент принимает готовую структуру страниц
												и может использоваться в любых блоках:
												новости, акции, каталоги, поиск и другие разделы.
											</p>

										</div>


										<?php
										get_template_part(
											'template-parts/ui/pagination',
											null,
											[
												'items' => [

													[
														'type' => 'prev',
														'url' => '#',
													],

													[
														'type' => 'page',
														'label' => '1',
														'url' => '#',
													],

													[
														'type' => 'page',
														'label' => '2',
														'url' => '#',
													],

													[
														'type' => 'page',
														'label' => '3',
														'url' => '#',
														'current' => true,
													],

													[
														'type' => 'page',
														'label' => '4',
														'url' => '#',
													],

													[
														'type' => 'ellipsis',
													],

													[
														'type' => 'page',
														'label' => '12',
														'url' => '#',
													],

													[
														'type' => 'next',
														'url' => '#',
													],

												],
											]
										);
										?>


									</div>

								</div>


								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Pagination states',
												'level' => 'h4',
											]
										);
										?>


										<?php
										get_template_part(
											'template-parts/ui/pagination',
											null,
											[
												'items' => [

													[
														'type' => 'prev',
														'disabled' => true,
													],

													[
														'type' => 'page',
														'label' => '1',
														'current' => true,
														'url' => '#',
													],

													[
														'type' => 'page',
														'label' => '2',
														'url' => '#',
													],

													[
														'type' => 'page',
														'label' => '3',
														'url' => '#',
													],

													[
														'type' => 'next',
														'url' => '#',
													],

												],
											]
										);
										?>


									</div>

								</div>


							</div>

						</div>

					</section>
					
					
					<!-- =======================================================
					 Breadcrumbs
					======================================================== -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">


								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Breadcrumbs',
										'subtitle' => 'Навигационная цепочка BADS для страниц, архивов и вложенных разделов.',
										'level' => 'h3',
									]
								);
								?>


								<!-- =======================================================
									 Default
								======================================================== -->


								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Default',
												'level' => 'h4',
											]
										);
										?>


										<?php
										get_template_part(
											'template-parts/ui/breadcrumbs',
											null,
											[
												'items' => [

													[
														'label' => 'Главная',
														'url' => '#',
													],

													[
														'label' => 'Санатории',
														'url' => '#',
													],

													[
														'label' => 'Белокуриха',
														'url' => '#',
													],

													[
														'label' => 'Номера',
														'current' => true,
													],

												],
											]
										);
										?>


									</div>

								</div>



								<!-- =======================================================
									 Long chain
								======================================================== -->


								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Long navigation',
												'level' => 'h4',
											]
										);
										?>


										<?php
										get_template_part(
											'template-parts/ui/breadcrumbs',
											null,
											[
												'items' => [

													[
														'label' => 'Главная',
														'url' => '#',
													],

													[
														'label' => 'Отдых',
														'url' => '#',
													],

													[
														'label' => 'Алтай',
														'url' => '#',
													],

													[
														'label' => 'Санатории',
														'url' => '#',
													],

													[
														'label' => 'Лечебные программы',
														'url' => '#',
													],

													[
														'label' => 'Восстановление после стресса',
														'current' => true,
													],

												],
											]
										);
										?>


									</div>

								</div>



								<!-- =======================================================
									 Light version
								======================================================== -->


								<div
									class="bads-card"
									style="
										background:#243447;
										padding:32px;
										border-radius:24px;
									"
								>

									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Light version',
												'level' => 'h4',
												'class' => 'bads-title--light',
											]
										);
										?>


										<?php
										get_template_part(
											'template-parts/ui/breadcrumbs',
											null,
											[
												'class' => 'bads-breadcrumbs--light',

												'items' => [

													[
														'label' => 'Главная',
														'url' => '#',
													],

													[
														'label' => 'Акции',
														'url' => '#',
													],

													[
														'label' => 'Летнее предложение',
														'current' => true,
													],

												],
											]
										);
										?>


									</div>

								</div>


							</div>

						</div>

					</section>
					
					<!-- =======================================================
						 Alert
					======================================================== -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">


								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Alert',
										'subtitle' => 'Системные уведомления и сообщения пользователю.',
										'level' => 'h2',
										'divider' => true,
									]
								);
								?>



								<div class="bads-card bads-card--glass bads-card--padding-xl">


									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Variants',
												'level' => 'h3',
											]
										);
										?>



										<div class="bads-stack bads-stack--md">


											<?php
											get_template_part(
												'template-parts/ui/alert',
												null,
												[

													'variant' => 'primary',

													'title' => 'Информация',

													'text' => 'Это информационное сообщение.',

													'icon' => 'status/check',

												]
											);
											?>



											<?php
											get_template_part(
												'template-parts/ui/alert',
												null,
												[

													'variant' => 'success',

													'title' => 'Успешно',

													'text' => 'Ваша заявка успешно отправлена.',

													'icon' => 'status/check',

												]
											);
											?>



											<?php
											get_template_part(
												'template-parts/ui/alert',
												null,
												[

													'variant' => 'warning',

													'title' => 'Внимание',

													'text' => 'Проверьте введенные данные перед отправкой.',

													'icon' => 'status/warning',

												]
											);
											?>



											<?php
											get_template_part(
												'template-parts/ui/alert',
												null,
												[

													'variant' => 'danger',

													'title' => 'Ошибка',

													'text' => 'Не удалось выполнить действие. Попробуйте еще раз.',

													'icon' => 'status/warning',

												]
											);
											?>


										</div>


									</div>


								</div>								
								
								<div class="bads-card bads-card--glass bads-card--padding-xl">


									<div class="bads-stack bads-stack--lg">


										<?php
										get_template_part(
											'template-parts/ui/title',
											null,
											[
												'title' => 'Closable',
												'level' => 'h3',
											]
										);
										?>



										<?php
										get_template_part(
											'template-parts/ui/alert',
											null,
											[

												'variant' => 'warning',

												'title' => 'Закрываемое уведомление',

												'text' => 'Этот компонент подготовлен для управления через JavaScript.',

												'icon' => 'status/warning',

												'closable' => true,

											]
										);
										?>


									</div>

								</div>



							</div>


						</div>


					</section>
					
					<!-- =======================================================
						 Modal
					======================================================== -->

					<section class="bads-section">

						<div class="bads-container">

							<div class="bads-stack bads-stack--xl">

								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Modal',
										'subtitle' => 'Универсальное модальное окно BADS. Любой компонент системы может открыть его без собственного JavaScript.',
										'level' => 'h3',
									]
								);
								?>

								<div class="bads-card bads-card--glass bads-card--padding-xl">

									<div class="bads-stack bads-stack--lg">

										<div class="bads-content">

											<p>

												Modal является самостоятельным UI-компонентом.
												Для открытия достаточно передать два data-атрибута
												в любую кнопку BADS.

											</p>

										</div>

										<div class="bads-cluster">

											<?php
											get_template_part(
												'template-parts/ui/button',
												null,
												[
													'text' => 'Открыть модальное окно',
													'type' => 'button',
													'variant' => 'primary',
													'icon' => 'actions/plus',
													'icon_position' => 'right',
													'attrs' => [
														'data-modal-trigger' => true,
														'data-modal-target' => '#demo-modal',
													],
												]
											);
											?>

										</div>
									</div>

								</div>

							</div>

						</div>

					</section>

					<?php

					/*
					|--------------------------------------------------------------------------
					| Modal Content
					|--------------------------------------------------------------------------
					*/

					ob_start();

					?>

					<div class="bads-stack bads-stack--lg">

						<?php
						get_template_part(
							'template-parts/ui/alert',
							null,
							[
								'variant' => 'success',
								'title' => 'BADS Modal',
								'text' => 'Modal способен отображать любые компоненты дизайн-системы.',
							]
						);
						?>

						<div class="bads-content">

							<p>

								Внутри модального окна могут располагаться формы,
								аккордеоны, вкладки, карточки, списки, таблицы,
								галереи и любые будущие компоненты BADS.

							</p>

						</div>

						<div class="bads-cluster">

							<?php
							get_template_part(
								'template-parts/ui/chip',
								null,
								[
									'text' => 'Modal',
									'variant' => 'primary',
								]
							);
							?>

							<?php
							get_template_part(
								'template-parts/ui/chip',
								null,
								[
									'text' => 'Alert',
									'variant' => 'success',
								]
							);
							?>

							<?php
							get_template_part(
								'template-parts/ui/chip',
								null,
								[
									'text' => 'Button',
									'variant' => 'secondary',
								]
							);
							?>

						</div>

					</div>

					<?php

					$content = ob_get_clean();

					/*
					|--------------------------------------------------------------------------
					| Modal Footer
					|--------------------------------------------------------------------------
					*/

					ob_start();

					?>

					<div class="bads-cluster">

						<?php
						get_template_part(
							'template-parts/ui/button',
							null,
							[
								'text' => 'Закрыть',
								'type' => 'button',
								'variant' => 'outline',

								'attrs' => [

									'data-modal-close' => true,

								],

							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/button',
							null,
							[
								'text' => 'Сохранить',
								'type' => 'button',
								'variant' => 'primary',
								'icon' => 'actions/check',
								'icon_position' => 'right',
							]
						);
						?>

					</div>

					<?php

					$footer = ob_get_clean();

					/*
					|--------------------------------------------------------------------------
					| Modal
					|--------------------------------------------------------------------------
					*/

					get_template_part(
						'template-parts/ui/modal',
						null,
						[
							'id' => 'demo-modal',
							'title' => 'Демонстрация компонента Modal',
							'content' => $content,
							'footer' => $footer,
							'size' => 'md',
						]
					);

					?>

				
					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Title',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>

									Универсальный компонент заголовков дизайн-системы.

								</p>

							</div>

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Типовой заголовок',
									'subtitle' => 'Пример использования компонента Title.',
									'divider' => true,
									'level' => 'h2',
								]
							);
							?>

						</div>

					</div>
					
					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Subtitle',
									'level' => 'h3',
								]
							);
							?>

							<?php
							get_template_part(
								'template-parts/ui/subtitle',
								null,
								[
									'text' => 'Subtitle — самостоятельный UI-компонент для поясняющего текста. Может использоваться как отдельно, так и внутри компонента Title.',
								]
							);
							?>

						</div>

					</div>


					<div class="bads-card bads-card--glass bads-card--padding-xl">

						<div class="bads-stack bads-stack--lg">

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Divider',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>

									Декоративный разделитель, используемый совместно с заголовками.

								</p>

							</div>

							<?php
							get_template_part(
								'template-parts/ui/divider',
								null,
								[
									'variant' => 'primary',
								]
							);
							?>

						</div>

					</div>
					
					<h2>Frame</h2>


						<div class="bads-frame bads-frame--ratio">

							<img 
								src="https://big-altay.ru/wp-content/uploads/2023/12/dsc_7083-1800x1000.jpg"
								alt=""
							>

						</div>
					
					<h2>Overlap</h2>


						<div class="bads-overlap">


							<div class="bads-overlap__back">

								<div class="bads-frame bads-frame--ratio">

									<img 
										src="https://big-altay.ru/wp-content/uploads/2023/12/dsc_7083-1800x1000.jpg"
										alt=""
									>

								</div>

							</div>


							<div 
								class="
									bads-overlap__front
									bads-overlap__front--right
									bads-overlap__front--center
								"
							>

								<div class="bads-card bads-card--glass bads-card--padding-lg">

									<?php
									get_template_part(
										'template-parts/ui/title',
										null,
										[
											'title' => 'Overlap пример',
											'level' => 'h3',
										]
									);
									?>


									<p class="bads-content">

										Карточка находится поверх изображения.

									</p>


								</div>

							</div>

						</div>
					
					<h2>Grid</h2>

						<div class="bads-grid bads-grid--3">

							<?php for ($i = 1; $i <= 6; $i++) : ?>

								<div class="bads-card bads-card--glass bads-card--padding-md">

									<?php
									get_template_part(
										'template-parts/ui/title',
										null,
										[
											'title' => 'Карточка ' . $i,
											'level' => 'h4',
										]
									);
									?>

									<div class="bads-content">

										<p>

											Пример содержимого карточки.

										</p>

									</div>

								</div>

							<?php endfor; ?>

						</div>
					
					<h2>Sidebar</h2>

					<div class="bads-sidebar bads-sidebar--right">

						<div>

							<?php
							get_template_part(
								'template-parts/ui/title',
								null,
								[
									'title' => 'Основной контент',
									'level' => 'h3',
								]
							);
							?>

							<div class="bads-content">

								<p>
									Здесь располагается основной текст страницы.
								</p>

								<p>
									Sidebar ничего не знает о содержимом.
									Он только раскладывает две области.
								</p>

								<p>
									Это может быть статья, описание санатория,
									лечение, акция или любой другой контент.
								</p>

							</div>

						</div>


						<aside class="bads-sidebar__aside bads-sidebar__aside--sticky">

							<div class="bads-card bads-card--glass bads-card--padding-lg">

								<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'title' => 'Sidebar',
										'level' => 'h4',
									]
								);
								?>

								<div class="bads-content">

									<p>

										Любой контент.

									</p>

								</div>

							</div>

						</aside>

					</div>
					
					<h2>Input</h2>

					<div class="bads-grid bads-grid--2">

						<div class="bads-field">

							<label class="bads-field__label">
								Имя *
							</label>

							<?php
							get_template_part(
								'template-parts/ui/input',
								null,
								[
									'name'        => 'name',
									'type'        => 'text',
									'placeholder' => 'Иван Иванов',
									'icon'        => 'user',
									'required'    => true,
									'autocomplete'=> 'name',
								]
							);
							?>

							<div class="bads-field__hint">
								Обычное текстовое поле.
							</div>

						</div>

						<div class="bads-field">

							<label class="bads-field__label">
								Телефон
							</label>

							<?php
							get_template_part(
								'template-parts/ui/input',
								null,
								[
									'name'         => 'phone',
									'type'         => 'tel',
									'placeholder'  => '+7 (___) ___-__-__',
									'icon'         => 'phone',
									'autocomplete' => 'tel',
								]
							);
							?>

						</div>

						<div class="bads-field">

							<label class="bads-field__label">
								Email
							</label>

							<?php
							get_template_part(
								'template-parts/ui/input',
								null,
								[
									'name'         => 'email',
									'type'         => 'email',
									'placeholder'  => 'example@mail.ru',
									'icon'         => 'email',
									'state'        => 'success',
									'autocomplete' => 'email',
								]
							);
							?>

							<div class="bads-field__hint">
								Поле прошло проверку.
							</div>

						</div>

						<div class="bads-field">

							<label class="bads-field__label">
								Телефон
							</label>

							<?php
							get_template_part(
								'template-parts/ui/input',
								null,
								[
									'name'         => 'phone_error',
									'type'         => 'tel',
									'placeholder'  => '+7 (___) ___-__-__',
									'icon'         => 'phone',
									'state'        => 'error',
									'autocomplete' => 'tel',
								]
							);
							?>

							<div class="bads-field__error">
								Некорректный номер телефона.
							</div>

						</div>

					</div>



					<h2>Checkbox</h2>

					<div class="bads-grid bads-grid--2">

						<?php
						get_template_part(
							'template-parts/ui/checkbox',
							null,
							[
								'name'  => 'checkbox-default',
								'label' => 'Обычный чекбокс',
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/checkbox',
							null,
							[
								'name'    => 'checkbox-checked',
								'label'   => 'Выбранный чекбокс',
								'checked' => true,
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/checkbox',
							null,
							[
								'name'     => 'checkbox-required',
								'label'    => 'Я принимаю условия обработки персональных данных',
								'required' => true,
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/checkbox',
							null,
							[
								'name'     => 'checkbox-disabled',
								'label'    => 'Недоступный чекбокс',
								'disabled' => true,
							]
						);
						?>

					</div>



					<h2>Textarea</h2>

					<div class="bads-field">

						<label class="bads-field__label">
							Сообщение
						</label>

						<?php
						get_template_part(
							'template-parts/ui/textarea',
							null,
							[
								'name'         => 'message',
								'placeholder'  => 'Напишите сообщение...',
								'autocomplete' => 'off',
							]
						);
						?>

						<div class="bads-field__hint">
							Максимум 1000 символов.
						</div>

					</div>
					
					<h2>Radio</h2>

					<div class="bads-grid bads-grid--2">

						<?php
						get_template_part(
							'template-parts/ui/radio',
							null,
							[
								'name'    => 'gender',
								'value'   => 'male',
								'label'   => 'Мужчина',
								'checked' => true,
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/radio',
							null,
							[
								'name'  => 'gender',
								'value' => 'female',
								'label' => 'Женщина',
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/radio',
							null,
							[
								'name'     => 'room',
								'value'    => 'standard',
								'label'    => 'Стандарт',
								'required' => true,
							]
						);
						?>

						<?php
						get_template_part(
							'template-parts/ui/radio',
							null,
							[
								'name'     => 'room',
								'value'    => 'lux',
								'label'    => 'Люкс (недоступно)',
								'disabled' => true,
							]
						);
						?>

					</div>
					
				</div>

			</div>

		</section>

</section>

    
<?php
get_footer();