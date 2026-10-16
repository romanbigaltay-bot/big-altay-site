<?php get_header(); ?>

<?php
$imagePreview = get_field('sanatorium_promo');
$sizePreview = 'header';

$content = get_the_content();

//getting numbers list
$numbers = get_posts(array(
    'post_type' => 'numbers',
    'meta_query' => array(
        array(
            'key' => 'number_sanatorium',
            'value' => get_the_ID(),
            'compare' => '='
        )
    ),
    'posts_per_page' => 30,
));

//getting treatments list
$treatments = get_posts(array(
    'post_type' => 'treatments',
    'meta_query' => array(
        array(
            'key' => 'treatments_sanatorium',
            'value' => get_the_ID(),
            'compare' => '='
        )
    ),
    'posts_per_page' => 30,
));

//current object
$postObject = get_queried_object();
$customPostType = $postObject->post_type;
?>


	<?php
		get_template_part(
			'template-parts/pages/sanatorium/page-intro/page-intro'
		);
	?>

	<?php
		get_template_part(
			'template-parts/pages/sanatorium/navigation/navigation'
		);
	?>
	
	<?php
		get_template_part(
			'template-parts/pages/sanatorium/about/about'
		);
	?>

<!--     <section class="resort">
                
        <div class="resort-body"> -->

            
<!--ФОРМА -------------------------- -->
				<section class="anchor"><span id="lead-form"></span></section>
    				<? get_template_part('template-parts/components/online-booking', get_post_format(), array('id' => '562', 'booking_id' => get_field('sanatorium_booking'))); ?>
<!-- --- --------------------------- -->


<!--Лечение ------------------------ -->			
			<?php

				if (get_post_type() === 'sanatorium') {

					get_template_part(
						'template-parts/pages/sanatorium/treatment/treatment'
					);

				}
			?>
			
			
						
			
<!--НОМЕРА -------------------------- -->	
			<? if ($numbers) { ?>
			<section id="numbers" class="resort-about-numbers">
                    <div class="container">
                        <div class="offers__wrapper--single-column">
                            <h2 class="resort-about__title">Номера</h2>
                            <? if ($numbers) { ?>
                                <div class="offers__list">
                                    <? for ($i = 0; $i < min(count($numbers), 6); $i++) { ?>
                                        <?
                                        $imageNumber = get_field('number_promo', $numbers[$i]->ID);
                                        $sizeNumber = 'large';
                                        ?>
                                        <div class="offer">
                                            <div class="offer__image">
                                                <a href="<?= get_permalink($numbers[$i]->ID); ?>" class="offer__link">
                                                    <img src="<?= wp_get_attachment_image_url($imageNumber, $sizeNumber); ?>" class="offer__img" alt="<?= get_the_title($numbers[$i]->ID); ?> - <?= the_title(); ?>" loading="lazy">
                                                </a>
                                            </div>
                                            <div class="offer__body">
                                                <a href="<?= get_permalink($numbers[$i]->ID); ?>" class="offer__title"><?= get_the_title($numbers[$i]->ID); ?></a>
                                                <a href="<?= get_permalink($numbers[$i]->ID); ?>" class="offer__more">Подробнее</a>
                                            </div>
                                            <div class="offer__bottom">
                                                <div class="offer__price">
                                                    от <? the_field('number_price', $numbers[$i]->ID); ?>
                                                    <span>руб./сутки</span>
                                                </div>
                                                <a href="#lead-form" class="offer__reserve">Оставить заявку</a>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            <? } else { ?>
                                Номера пока не добавлены
                            <? } ?>
                        </div>
                    </div>
                </section>
			<? } ?>
			
			<div class="resort-tab fun" >
                <section id="fun" class="resort-fun">
                    <div class="container resort-fun__container">
                        <h2 class="resort-tab__title">Досуг</h2>
                        <div class="resort-fun__list">
                            <? if (have_rows('sanatorium_rest')) : ?>
                                <? while (have_rows('sanatorium_rest')) : the_row(); ?>
                                    <?
                                    $imageRest = get_sub_field('sanatorium_rest-photo');
                                    $sizeRest = 'large';
                                    ?>
                                    <div class="resort-fun__item">
                                        <div class="resort-fun__image">
                                            <img src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>" alt="<?php the_sub_field('sanatorium_rest-title'); ?>" class="resort-fun__img" loading="lazy">
                                        </div>
                                        <div class="resort-fun__body">
                                            <div class="resort-fun__title"><?php the_sub_field('sanatorium_rest-title'); ?></div>
                                            <div class="resort-fun__text">
                                                <?php the_sub_field('sanatorium_rest-description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <? endwhile; ?>
                            <? else :; ?>
                                Информации пока нет.
                            <? endif; ?>
                        </div>
                    </div>
                </section>
            </div>
			
			 <div class="resort-tab food" >
                <section id="food" class="resort-food">
                    <div class="container resort-food__container">
                        <h2 class="resort-tab__title">Питание</h2>
                        <?
                        $foodText = get_field('sanatorium_food-text');
                        if ($foodText != '') { ?>
                            <div class="resort-tab__description"><?= $foodText; ?></div>
                        <? } ?>
                        <div class="resort-gallery__list resort-gallery__list--food">
                            <? if (have_rows('sanatorium_food')) : ?>
                                <? $imageFoodNum = 0; ?>
                                <? while (have_rows('sanatorium_food')) : the_row(); ?>
                                    <?
                                    $imageFood = get_sub_field('sanatorium_food-photo');
                                    $sizeFood = 'large';
                                    if ($imageFoodNum <= 4) { ?>
                                        <div class="resort-gallery__item" data-fancybox="gallery-food" data-src="<?= wp_get_attachment_image_url($imageFood, $sizeFood); ?>">
                                            <img loading="lazy" src="<?= wp_get_attachment_image_url($imageFood, $sizeFood); ?>" alt="Фотография" class="resort-gallery__img">
                                        </div>
                                    <? } else { ?>
                                        <div class="resort-gallery__item" data-fancybox="gallery-food" data-src="<?= wp_get_attachment_image_url($imageFood, $sizeFood); ?>" style="display:none;"></div>
                                    <? }
                                    $imageFoodNum++; ?>
                                <? endwhile; ?>
                            <? else :; ?>
                                Информации пока нет.
                            <? endif; ?>
                        </div>
                        <div class="navigation navigation--gray resort-gallery__navigation">
                            <div class="navigation__prev resort-gallery__prev"></div>
                            <div class="navigation__next resort-gallery__next"></div>
                        </div>
                        <div class="swiper resort-gallery__slider">
                            <div class="swiper-wrapper">
                                <? while (have_rows('sanatorium_food')) : the_row(); ?>
                                    <?
                                    $imageFood = get_sub_field('sanatorium_food-photo');
                                    $sizeFood = 'large';
                                    ?>
                                    <div class="resort-gallery__slider-item swiper-slide" data-fancybox="slider-food" data-src="<?= wp_get_attachment_image_url($imageFood, $sizeFood); ?>">
                                        <img loading="lazy" src="<?= wp_get_attachment_image_url($imageFood, $sizeFood); ?>" alt="<?= the_title(); ?>" class="resort-gallery__slider-img">
                                    </div>
                                <? endwhile; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
			
<!--Галерея -------------------------- -->			
			<?php
// 				get_template_part(
// 					'template-parts/pages/sanatorium/gallery/gallery'
// 				);
			?>
			
			 <div class="resort-tab gallery" >
                <section id="gallery" class="resort-gallery">
                    <div class="container resort-gallery__container">
                        <h2 class="resort-tab__title">Галерея</h2>
                        <div class="resort-gallery__list">
                            <? if (have_rows('sanatorium_gallery')) : ?>
                                <? $imageGalleryNum = 0; ?>
                                <? while (have_rows('sanatorium_gallery')) : the_row(); ?>
                                    <?
                                    $imageGallery = get_sub_field('sanatorium_gallery-photo');
                                    $sizeGallery = 'large';
                                    if ($imageGalleryNum <= 9) { ?>
                                        <div class="resort-gallery__item" data-fancybox="gallery-tab" data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                            <img loading="lazy" src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>" alt="Фотография" class="resort-gallery__img">
                                        </div>
                                    <? } else { ?>
                                        <div class="resort-gallery__item" data-fancybox="gallery-tab" data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>" style="display:none;">										</div>
                                    <? }
                                    $imageGalleryNum++; ?>
                                <? endwhile; ?>
                            <? else :; ?>
                                Фотографий пока нет.
                            <? endif; ?>
                        </div>
                        <div class="navigation navigation--gray resort-gallery__navigation">
                            <div class="navigation__prev resort-gallery__prev"></div>
                            <div class="navigation__next resort-gallery__next"></div>
                        </div>
                        <div class="swiper resort-gallery__slider">
                            <div class="swiper-wrapper">
                                <? while (have_rows('sanatorium_gallery')) : the_row(); ?>
                                    <?
                                    $imageGallery = get_sub_field('sanatorium_gallery-photo');
                                    $sizeGallery = 'large';
                                    ?>
                                    <div class="resort-gallery__slider-item swiper-slide" data-fancybox="slider-gallery" data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                        <img loading="lazy" src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>" alt="<?= the_title(); ?>" class="resort-gallery__slider-img">
                                    </div>
                                <? endwhile; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
			
 <!--СТАРЫЕ ТАБЫ -------------------------- -->               
                <? if ($customPostType === 'sanatorium') { ?>
                    <section class="resort-about-tabs">
                        <div class="container">
                            <div class="treatment-page-tabs">
                                <div class="treatment-page-tabs__navigation">
                                    <div data=".treatment-0" class="treatment-page-tabs__item is-active">
                                        Расположение
                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_field('sanatorium_accordion_location'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                    <div data=".treatment-1" class="treatment-page-tabs__item">
                                        Лечебная база
                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_field('sanatorium_accordion_medical_base'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                    <div data=".treatment-2" class="treatment-page-tabs__item">
                                        Номера
                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_field('sanatorium_accordion_numbers'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                    <div data=".treatment-3" class="treatment-page-tabs__item">
                                        Питание
                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_field('sanatorium_accordion_nutrition'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                    <div data=".treatment-4" class="treatment-page-tabs__item">
                                        Инфраструктура
                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_field('sanatorium_accordion_infrastructure'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                </div>
                                <div class="treatment-page-tabs__body">
                                    <div class="treatment-page-tabs__content treatment-0" style="">
                                        <?php the_field('sanatorium_accordion_location'); ?>
                                    </div>
                                    <div class="treatment-page-tabs__content treatment-1" style="display: none">
                                        <?php the_field('sanatorium_accordion_medical_base'); ?>
                                    </div>
                                    <div class="treatment-page-tabs__content treatment-2" style="display: none">
                                        <?php the_field('sanatorium_accordion_numbers'); ?>
                                    </div>
                                    <div class="treatment-page-tabs__content treatment-3" style="display: none">
                                        <?php the_field('sanatorium_accordion_nutrition'); ?>
                                    </div>
                                    <div class="treatment-page-tabs__content treatment-4" style="display: none">
                                        <?php the_field('sanatorium_accordion_infrastructure'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <? } ?>

<!--Цены -------------------------- -->				
			<div class="resort-tab price">
                <section id="price" class="resort-price">
                    <div class="container resort-price__container">
                        <h2 class="resort-tab__title">Цены на услуги</h2>
                        <?
                        $priceText = get_field('sanatorium_prices-text');
                        if ($priceText != '') { ?>
                            <div class="resort-tab__description"><?= $priceText; ?></div>
                        <? } ?>
                        <div class="resort-price__wrapper">
                            <div class="resort-price-list">
                                <? if (have_rows('sanatorium_prices')) : ?>
                                    <? while (have_rows('sanatorium_prices')) : the_row(); ?>
                                        <div class="resort-price-list__item">
                                            <div class="resort-price-list__title"><?php the_sub_field('sanatorium_prices-title'); ?></div>
                                            <div class="resort-price-list__value">
                                                от <?php the_sub_field('sanatorium_prices-value'); ?></div>
                                        </div>
                                    <? endwhile; ?>
                                <? else :; ?>
                                    Информации пока нет.
                                <? endif; ?>
                            </div>
							
							
							<div class="resort-price-panel">
								<?php
								$priceFile = get_field('sanatorium_prices-file');
								$showDownloadButton = get_field('knopka_skachat_vklvykl'); // вернёт 'ВКЛ' или 'ВЫКЛ'
								?>

								<?php if ($showDownloadButton === 'ВКЛ' && $priceFile) : ?>
									<a href="<?php echo $priceFile; ?>" class="resort-price-panel__item resort-price-panel__item--btn" target="_blank">Скачать полный Прайс-лист</a>
								<?php endif; ?>

								<?php if (have_rows('sanatorium_prices-card')) : ?>
									<?php while (have_rows('sanatorium_prices-card')) : the_row(); ?>
										<div class="resort-price-panel__item"><?php the_sub_field('sanatorium_prices-card-title'); ?></div>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
                        </div>
                        <div class="resort-price-info">
                            <div class="resort-tab__title">Документы, необходимые для заезда:</div>
                            <? if (have_rows('sanatorium_prices-docs')) : ?>
                                <? while (have_rows('sanatorium_prices-docs')) : the_row(); ?>
                                    <div class="resort-price-info__title"><?php the_sub_field('sanatorium_prices-docs-title'); ?></div>
                                    <div class="resort-price-info__text">
                                        <?php the_sub_field('sanatorium_prices-docs-list'); ?>
                                    </div>
                                <? endwhile; ?>
                            <? else :; ?>
                                Информации пока нет.
                            <? endif; ?>
                        </div>
                    </div>
                </section>
            </div>

<!--Отзывы -------------------------- -->				
                <? if (have_rows('sanatorium_reviews')) : ?>
                    <section id="reviews" class="resort-about-reviews main-reviews">
                        <div class="container">
                            <section class="headline-primary headline-primary--flex">
                                <h2 class="headline-primary__headline">Отзывы</h2>
                                <div class="navigation navigation--gray">
                                    <div class="navigation__prev reviews__prev"></div>
                                    <div class="navigation__next reviews__next"></div>
                                </div>
                            </section>
                            <div class="reviews__list swiper">
                                <div class="swiper-wrapper">
                                    <? while (have_rows('sanatorium_reviews')) : the_row();
                                        get_template_part(
                                            'template-parts/content/reviews',
                                            get_post_format(),
                                            array(
                                                'class' => 'swiper-slide',
                                            )
                                        );
                                    endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <? endif; ?>
			
<!--Карта -------------------------- -->				
                <?php if (get_field('sanatorium_coordinates')) { ?>
                    <section class="resort-about-map">
                        <div class="container">
                            <h2 class="resort-about__title">Адрес</h2>
                            <div class="resort-about-map__contacts">
                                <div class="resort-about-map__address"><?php the_field('sanatorium_address'); ?></div>
                                <div class="resort-about-map__check"><?php the_field('sanatorium_hour'); ?></div>
                            </div>
                            <div class="resort-about-map__map" id="map" style="width:100%;"></div>
                        </div>
                    </section>
                <? } ?>
               
		            
	<!--Убрать -------------------------- -->	
		
            <div class="resort-tab reviews" style="display: none">
                <section class="resort-reviews">
                    <div class="container resort-reviews__container">
                        <h2 class="resort-tab__title">Отзывы</h2>
                        <div class="reviews__list">
                            <? if (have_rows('sanatorium_reviews')) : ?>
                                <? while (have_rows('sanatorium_reviews')) : the_row();
                                    get_template_part('template-parts/content/reviews', get_post_format());
                                endwhile; ?>
                            <? else :; ?>
                                Отзывов пока нет.
                            <? endif; ?>
                        </div>
                    </div>
                </section>
            </div>
			
			
            <div class="resort-tab sale" style="display: none">				
				<section class="resort-reviews">
					<div class="container resort-reviews__container">
						<h2 class="resort-tab__title">Акции</h2>
						<div class="sale">
							<?php
							$current_page_id = get_the_ID();

							$has_valid_rows = false;
							$table_rows = array();

							if (have_rows('dobavit_akcziyu', $current_page_id)) :
								while (have_rows('dobavit_akcziyu', $current_page_id)) : the_row();
									$date_field = get_sub_field('data_zaezda1');
									$show_table = get_sub_field('vklyuchit_tabliczu_na_stranicze_akczii');


									if (!empty($date_field) && $show_table) {
										$has_valid_rows = true;
										$table_rows[] = array(
											'date' => $date_field,
											'duration' => get_sub_field('srok_prebyvaniya1'),
											'category' => get_sub_field('kategoriya_nomera1'),
											'tour' => get_sub_field('putevka1'),
											'price' => get_sub_field('stoimost_rub1'),
											'discount_price' => get_sub_field('stoimost_s_rub1'),
											'benefit' => get_sub_field('vygoda1')
										);
									}
								endwhile;
							endif;

							if ($has_valid_rows) : ?>

								<div class="row-container" style="margin-bottom: 30px;">
									<div class="table-wrap">
										<table>
											<thead>
												<tr>
													<th>Дата заезда</th>
													<th>Срок пребывания</th>
													<th>Категория номера</th>
													<th>Путевка</th>
													<th>Стоимость</th>
													<th>Стоимость со скидкой</th>
													<th>Выгода</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($table_rows as $row) : ?>
													<tr>
														<td data-label="Дата заезда"><?php echo $row['date']; ?></td>
														<td data-label="Срок пребывания"><?php echo $row['duration']; ?></td>
														<td data-label="Категория номера"><?php echo $row['category']; ?></td>
														<td data-label="Путевка"><?php echo $row['tour']; ?></td>
														<td data-label="Стоимость"><?php echo $row['price']; ?> </td>
														<td data-label="Стоимость со скидкой"><?php echo $row['discount_price']; ?> </td>
														<td data-label="Выгода"><?php echo $row['benefit']; ?></td>
														<td data-label=""><a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjM1MTQiLCJ0b2dnbGUiOmZhbHNlfQ%3D%3D" class="btn resort-header-btn animated-button">Заказать</a></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							<?php
							else :
								?>
								<p style="text-align: center; padding: 20px;">На данный момент акций нет.</p>
							<?php endif; ?>
						</div>
					</div>
				</section>
            </div>
			
<!-- 			
        </div>
    </section>
	 -->
	
    <section class="anchor"><span id="lead-form"></span></section>
    <? get_template_part('template-parts/components/online-booking', get_post_format(), array('id' => '562', 'booking_id' => get_field('sanatorium_booking'))); ?>
	
	


<?php if (get_field('sanatorium_coordinates')) { ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script>
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                center: [<?php the_field('sanatorium_coordinates'); ?>],
                zoom: 15,
                controls: []
            });
            var myGeoObjects = [];
            myGeoObjects = new ymaps.Placemark([<?php the_field('sanatorium_coordinates'); ?>], {
                balloonContentBody: '<?= the_title(); ?>',
            });
            var clusterer = new ymaps.Clusterer({
                clusterDisableClickZoom: false,
                clusterOpenBalloonOnClick: false,
            });
            clusterer.add(myGeoObjects);
            myMap.geoObjects.add(clusterer);
        }
    </script>
<?php } ?>



<?php get_footer(); ?>