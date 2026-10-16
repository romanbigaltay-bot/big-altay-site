<?php get_header(); ?>

<?php
$imagePreview = get_field('pensioners_promo');
$sizePreview = 'header';
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">Пенсионерам</li>
                </ul>
            </div>
        </section>
        <section class="headline-promo">
            <div class="container">
                <h1 class="headline-promo__headline"><? the_title(); ?>
					НЕ АКТУАЛЬНО
                    <a href="#lead-form" class="btn headline-promo-btn animated-button">Оставить заявку
                        <span class="headline-promo-btn__icon">
                            <picture>
                                <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                        type="image/webp">
                                <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                     alt="Оставить заявку на расчет">
                            </picture>
                        </span>
                    </a>
                </h1>
            </div>
        </section>
        <section class="pensioners-promo resort-promo">
            <div class="container resort-promo__container">
                <div class="resort-promo__wrapper">
                    <div class="resort-promo__image">
                        <img src="<?= wp_get_attachment_image_url($imagePreview, $sizePreview); ?>"
                             alt="<? the_title(); ?>" class="resort-promo__img" style="object-position: 74%;" loading="lazy">
                    </div>
                    <div class="resort-promo__description"><?= the_content(); ?></div>
                </div>
            </div>
        </section>
        <section class="resort-about-numbers premium-numbers">
            <div class="container">
                <div class="offers__wrapper--single-column"><h2 class="resort-about__title">Мы предлагаем</h2>
                    <div class="offers__list">
                        <?
                        $query_args = array(
                            'post_type' => 'sanatorium',
                            'post_per_page' => 18,
                            'showposts' => 18,
                            'post_status' => 'publish'
                        );
                        ?>
                        <? wp_reset_query();
                        $query = new WP_Query($query_args); ?>
                        <? if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/content/sanatorium', get_post_format());
                            }
                        }
                        wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="pensioners-treatments">
            <div class="container">
                <h2 class="resort-about__title">Лечение</h2>
                <div class="pensioners-treatments__wrapper">
                    <div class="pensioners-treatments__text"><?php the_field('pensioners_treatments-left'); ?></div>
                    <div class="pensioners-treatments__procedures">
                        <div class="pensioners-treatments__title">Пенсионерам могут быть назначены процедуры:</div>
                        <? if (have_rows('pensioners_treatments-cards')): ?>
                            <div class="pensioners-treatments__list">
                                <? while (have_rows('pensioners_treatments-cards')) : the_row(); ?>
                                    <div class="pensioners-treatment"><?php the_sub_field('pensioners_treatments-cards-description'); ?></div>
                                <? endwhile; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="premium-info">
            <div class="container premium-info__container">
                <div class="premium-info__text"><?php the_field('pensioners_treatments-bottom'); ?></div>
            </div>
        </section>
        <? if (have_rows('pensioners_gallery')): ?>
            <section class="resort-about-gallery pensioners-gallery">
                <div class="container">
                    <h2 class="resort-about__title">Питание</h2>
                    <div class="resort-tab__description">
                        <p>Гостям предлагают различные варианты питания:<br>«шведский стол» или заказное меню.</p>
                    </div>
                    <div class="resort-gallery__list resort-gallery__list--about">
                        <? $imageGalleryNum = 0; ?>
                        <? while (have_rows('pensioners_gallery')) : the_row(); ?>
                            <?
                            $imageGallery = get_sub_field('pensioners_gallery-photo');
                            $sizeGallery = 'large';
                            if ($imageGalleryNum <= 4) { ?>
                                <div class="resort-gallery__item" data-fancybox="gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                    <img src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                         alt="Пенсионерам" class="resort-gallery__img" loading="lazy">
                                </div>
                            <? } else { ?>
                                <div class="resort-gallery__item" data-fancybox="gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                     style="display:none;"></div>
                            <? }
                            $imageGalleryNum++; ?>
                        <? endwhile; ?>
                    </div>


                    <div class="navigation navigation--gray resort-gallery__navigation">
                        <div class="navigation__prev resort-gallery__prev"></div>
                        <div class="navigation__next resort-gallery__next"></div>
                    </div>
                    <div class="swiper resort-gallery__slider">
                        <div class="swiper-wrapper">
                            <? while (have_rows('pensioners_gallery')) : the_row(); ?>
                                <?
                                $imageGallery = get_sub_field('pensioners_gallery-photo');
                                $sizeGallery = 'large';
                                ?>
                                <div class="resort-gallery__slider-item swiper-slide"
                                     data-fancybox="slider-gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                    <img loading="lazy"
                                         src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                         alt="<?= the_title(); ?>" class="resort-gallery__slider-img">
                                </div>
                            <? endwhile; ?>
                        </div>
                    </div>


                </div>
            </section>
        <? endif; ?>
        <section class="pensioners-rest">
            <div class="container">
                <div class="pensioners-rest__wrapper">
                    <div class="pensioners-rest__text">
                        <h2 class="resort-about__title">Отдых</h2>
                        <?php the_field('pensioners_rest-text'); ?>
                    </div>
                    <div class="pensioners-rest__images">
                        <?
                        $imageRest1 = get_field('pensioners_rest-photo1');
                        $imageRest2 = get_field('pensioners_rest-photo2');
                        $sizeRest = 'large';
                        ?>
                        <div class="pensioners-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageRest1, $sizeRest); ?>"
                                 alt="Отдых" class="pensioners-rest__img" loading="lazy">
                        </div>
                        <div class="pensioners-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageRest2, $sizeRest); ?>"
                                 alt="Отдых" class="pensioners-rest__img" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pensioners-factors">
            <div class="container">
                <h2 class="resort-about__title">Благоприятные<br>факторы</h2>
                <div class="pensioners-factors__wrapper">
                    <div class="pensioners-factors__col-left pensioners-factors__col"><?php the_field('pensioners_factors-text-left'); ?></div>
                    <div class="pensioners-factors__col-right pensioners-factors__col"><?php the_field('pensioners_factors-text-right'); ?></div>
                    <?
                    $imageFactors = get_field('pensioners_factors-photo');
                    $sizeFactors = 'header';
                    ?>
                    <div class="pensioners-factors__image">
                        <img src="<?= wp_get_attachment_image_url($imageFactors, $sizeFactors); ?>"
                             alt="Благоприятные факторы" class="pensioners-factors__img" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary lead-form--excursions">
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <h2 class="lead-form__title">Хотите узнать<br>больше?</h2>
                    <div class="lead-form__description">
                        <ul>
                            <li>Лично, обратившись в курсовочное бюро: г. Белокуриха, переулок Спортивный д. 5, пом. Н1.</li>
                            <li>По телефонам: 8 (800) 500-07-34, 8 (383) 389-39-83.</li>
                            <li>В мессенджерах: +7 (960)-948-20-69 Telegram, WhatsApp.</li>
                            <li>По электронной почте: info@big-altay.ru.</li>
                            <li>Заполнив форму обратной связи на сайте.</li>
                        </ul>
                    </div>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>
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
    </main>

<?php get_footer(); ?>