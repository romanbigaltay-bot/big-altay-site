<?php get_header(); ?>

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
        <? if (have_rows('about_slider')): ?>
            <section class="main-slider about-slider">
                <div class="container main-slider__container">
                    <div class="swiper main-slider__list">
                        <div class="swiper-wrapper">
                            <? $slidePromo = 0; ?>
                            <? while (have_rows('about_slider')) : the_row(); ?>
                                <?
                                $imagePromo = get_sub_field('about_slider-image');
                                $sizePromo = 'header';
                                ?>
                                <div class="swiper-slide main-slider__item">
                                    <section class="headline-promo">
                                        <?
                                        if ($slidePromo === 0) { ?>
                                            <h1 class="headline-promo__headline"><?php the_sub_field('about_slider-title'); ?></h1>
                                        <? } else { ?>
                                            <h2 class="headline-promo__headline"><?php the_sub_field('about_slider-title'); ?></h2>
                                        <? } ?>
                                        <div class="about-slider__description"><?php the_sub_field('about_slider-description'); ?></div>
                                    </section>
                                    <div class="main-slider__image">
                                        <img src="<?= wp_get_attachment_image_url($imagePromo, $sizePromo); ?>"
                                             alt="Размещение" class="main-slider__img" loading="lazy">
                                    </div>
                                </div>
                                <? $slidePromo++; ?>
                            <? endwhile; ?>
                        </div>
                        <div class="navigation main-slider__navigation">
                            <div class="navigation__prev main-slider__prev"></div>
                            <div class="navigation__next main-slider__next"></div>
                        </div>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <section class="main-about">
            <div class="container main-about__container about__container">
                <div class="main-about__info">
                    <div class="main-about__description">
                        <?= the_content(); ?>
                    </div>
                </div>
                <? if (have_rows('about_advantages')): ?>
                    <div class="main-about__advantages">
                        <? while (have_rows('about_advantages')) : the_row(); ?>
                            <?
                            $imageAdvantagesIcon = get_sub_field('about_advantages-icon');
                            $sizeAdvantagesIcon = 'medium';
                            ?>
                            <div class="main-about-advantage">
                                <div class="main-about-advantage__icon">
                                    <img src="<?= wp_get_attachment_image_url($imageAdvantagesIcon, $sizeAdvantagesIcon); ?>"
                                         alt="<?php the_sub_field('about_advantages-title'); ?>" loading="lazy">
                                </div>
                                <div class="main-about-advantage__description">
                                    <div class="main-about-advantage__title"><?php the_sub_field('about_advantages-title'); ?></div>
                                    <div class="main-about-advantage__text"><?php the_sub_field('about_advantages-description'); ?></div>
                                </div>
                            </div>
                        <? endwhile; ?>
                    </div>
                <? endif; ?>
            </div>
            <div class="container main-about__images-container about__images-container">
                <?
                $gallery1 = get_field('about_gallery-1');
                $gallery2 = get_field('about_gallery-2');
                $sizeGallery = 'large';
                ?>
                <div class="main-about__images">
                    <div class="main-about__image">
                        <img src="<?= wp_get_attachment_image_url($gallery1, $sizeGallery); ?>"
                             class="main-about__img" alt="Курорты в Белокурихе" loading="lazy">
                    </div>
                    <div class="main-about__image">
                        <img src="<?= wp_get_attachment_image_url($gallery2, $sizeGallery); ?>"
                             class="main-about__img" alt="Курорты в Белокурихе" loading="lazy">
                    </div>
                </div>
                <div class="main-about__gallery">
                    <div class="navigation navigation--gray">
                        <div class="navigation__prev main-about__prev"></div>
                        <div class="navigation__next main-about__next"></div>
                    </div>
                    <div class="main-about__list swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide main-about__item">
                                <img src="<?= wp_get_attachment_image_url($gallery1, $sizeGallery); ?>"
                                     alt="Курорты в Белокурихе" class="main-about__item-img" loading="lazy">
                            </div>
                            <div class="swiper-slide main-about__item">
                                <img src="<?= wp_get_attachment_image_url($gallery2, $sizeGallery); ?>"
                                     alt="Курорты в Белокурихе" class="main-about__item-img" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <? if (have_rows('partners_logos', 32)): ?>
            <section class="partners-logos">
                <div class="container partners-logos__container">
                    <section class="headline-primary headline-primary--flex">
                        <h2 class="headline-primary__headline">Наши партнеры</h2>
                        <div class="navigation navigation--gray">
                            <div class="navigation__prev partners-logos__prev"></div>
                            <div class="navigation__next partners-logos__next"></div>
                        </div>
                    </section>
                    <div class="partners-logos__list swiper">
                        <div class="swiper-wrapper">
                            <? while (have_rows('partners_logos', 32)) : the_row(); ?>
                                <?
                                $imageLogo = get_sub_field('partners_logo', 32);
                                $sizeLogo = 'medium';
                                ?>
                                <div class="partners-logos__item swiper-slide">
                                    <img src="<?= wp_get_attachment_image_url($imageLogo, $sizeLogo); ?>"
                                         alt="Сотрудничество" class="partners-logos__img" loading="lazy">
                                </div>
                            <? endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <?
        $query_args = array(
            'post_type' => 'news',
            'post_per_page' => 6,
            'showposts' => 6,
            'post_status' => 'publish'
        );
        ?>
        <? wp_reset_query();
        $query = new WP_Query($query_args); ?>
        <? if ($query->have_posts()) { ?>
            <section class="news main-news">
                <div class="container">
                    <section class="headline-primary headline-primary--flex">
                        <h2 class="headline-primary__headline">Последние новости</h2>
                        <div class="navigation navigation--gray">
                            <div class="navigation__prev news__prev"></div>
                            <div class="navigation__next news__next"></div>
                        </div>
                    </section>
                    <div class="news__list swiper">
                        <div class="swiper-wrapper">
                            <?
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/content/news', get_post_format(),
                                    array(
                                        'class' => 'swiper-slide',
                                    ));
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
        <? } ?>
        <? if (have_rows('main_reviews', 139)): ?>
            <section class="reviews main-reviews">
                <div class="container reviews__container">
                    <section class="headline-primary headline-primary--flex">
                        <h2 class="headline-primary__headline">Отзывы</h2>
                        <div class="navigation navigation--gray">
                            <div class="navigation__prev reviews__prev"></div>
                            <div class="navigation__next reviews__next"></div>
                        </div>
                    </section>
                    <div class="reviews__list swiper">
                        <div class="swiper-wrapper">
                            <? while (have_rows('main_reviews', 139)) : the_row();
                                get_template_part('template-parts/content/reviews-main', get_post_format(),
                                    array(
                                        'class' => 'swiper-slide',
                                    ));
                            endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <section class="resort-about-map mb-0">
            <div class="container">
                <h2 class="resort-about__title">Адрес</h2>
                <div class="resort-about-map__contacts">
                    <div class="resort-about-map__address"><?php the_field('address', 2); ?></div>
                    <div class="resort-about-map__check">Расчетный час – 8:00 (заезд и выезд осуществляется в 8:00)
                    </div>
                </div>
                <div class="resort-about-map__map" id="map" style="width:100%;"></div>
            </div>
        </section>
    </main>

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script>ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {center: [<?php the_field('coordinates', 2); ?>], zoom: 15, controls: []});
            var myGeoObjects = [];
            myGeoObjects = new ymaps.Placemark([<?php the_field('coordinates', 2); ?>], {balloonContentBody: 'Текст в балуне',});
            var clusterer = new ymaps.Clusterer({clusterDisableClickZoom: false, clusterOpenBalloonOnClick: false,});
            clusterer.add(myGeoObjects);
            myMap.geoObjects.add(clusterer);
        }
    </script>

<?php get_footer(); ?>