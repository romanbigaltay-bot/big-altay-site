<?php get_header(); ?>

<?
$whatsApp = get_field('whatsapp');
$whatsAppLink = str_replace(array('(', ')', '+', ' ', '-'), '', $whatsApp);
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item"><? the_title(); ?></li>
                </ul>
            </div>
        </section>
        <section class="contacts">
            <div class="container">
                <section class="headline-primary">
                    <h1 class="headline-primary__headline"><? the_title(); ?></h1>
                </section>
                <section class="contacts-body">
                    <div class="contacts-body__left-column">
                        <div class="contacts-body__list">
                            <div class="contacts-body__item contacts-body__item--icon contacts-body__item--phone">
                                <div>
                                    <a href="tel:<?php the_field('phone_1'); ?>"><?php the_field('phone_1'); ?></a>
                                    - звонки по РФ бесплатно
                                </div>
                            </div>
                            <div class="contacts-body__item contacts-body__item--icon contacts-body__item--phone">
                                <div>
                                    <a href="tel:<?php the_field('phone_2'); ?>"><?php the_field('phone_2'); ?></a>
                                </div>
                            </div>
							<div class="contacts-body__item contacts-body__item--icon contacts-body__item--phone">
								<div>
									<a href="tel:<?php the_field('phone_3'); ?>"><?php the_field('phone_3'); ?></a>
									- Партнерам
								</div>
							</div>
							<div class="contacts-body__item contacts-body__item--icon contacts-body__item--phone">
								<div>
									<a href="tel:<?php the_field('phone_4'); ?>"><?php the_field('phone_4'); ?></a>
									- заказ Трансфера
								</div>
							</div>
                            <div class="contacts-body__item contacts-body__item--icon contacts-body__item--phone">
                                <div><a href="https://max.ru/u/f9LHodD0cOJxzJCEldaY4BTH3pF50_TJCq3Bh_AH4rJ0nxICZEWOXqZLmJA" target="_blank"><?= $whatsApp ?></a> -
                                    MAX 
                                </div>
                            </div>
                            <div class="contacts-body__item contacts-body__item--icon contacts-body__item--message">
                                <div>
                                    <a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a>
                                </div>
                            </div>
                            <div class="contacts-body__item contacts-body__item--icon contacts-body__item--location">
                                <div><?php the_field('address'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="contacts-body__right-column">
                        <? if (have_rows('props')): ?>
                            <div class="contacts-body__list">
                                <? while (have_rows('props')) : the_row(); ?>
                                    <div class="contacts-body__item"><?php the_sub_field('prop'); ?></div>
                                <? endwhile; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </section>
                <section class="contacts-map" id="map" style="width:100%;"></section>
            </div>
        </section>

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--tertiary lead-form--secondary lead-form--excursions">
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <h2 class="lead-form__title">У вас есть<br>вопросы?</h2>
                    <div class="lead-form__description">Напишите нам и мы ответим на любые вопросы<br>в ближайшее время
                    </div>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>
    </main>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script>ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {center: [<?php the_field('coordinates'); ?>], zoom: 13, controls: []});
            var myGeoObjects = [];
            myGeoObjects = new ymaps.Placemark([<?php the_field('coordinates'); ?>], {balloonContentBody: 'Большой Алтай',});
            var clusterer = new ymaps.Clusterer({clusterDisableClickZoom: false, clusterOpenBalloonOnClick: false,});
            clusterer.add(myGeoObjects);
            myMap.geoObjects.add(clusterer);
        }
    </script>

<?php get_footer(); ?>