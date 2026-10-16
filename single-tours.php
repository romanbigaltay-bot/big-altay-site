<?php get_header(); ?>

<?php
$imagePreview = get_field('tours_promo');
$sizePreview = 'header';
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <a href="/tours/" class="breadcrumbs__link">Туры на Алтай</a>
                    </li>
                    <li class="breadcrumbs__item"><?= the_title(); ?></li>
                </ul>
            </div>
        </section>
        <section class="headline-promo">
            <div class="container">
                <h1 class="headline-promo__headline"><?= the_title(); ?>
                    <a href="#lead-form" class="btn headline-promo-btn animated-button">Забронировать
                        <span class="headline-promo-btn__icon">
                            <picture>
                                <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                        type="image/webp">
                                <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                     alt="Подобрать">
                            </picture>
                        </span>
                    </a>
                </h1>
            </div>
        </section>
        <section class="excursion-promo resort-promo">
            <div class="container resort-promo__container">
                <div class="resort-promo__wrapper">
                    <div class="resort-promo__image">
                        <img src="<?= wp_get_attachment_image_url($imagePreview, $sizePreview); ?>"
                             alt="<?= the_title(); ?>"
                             class="resort-promo__img" loading="lazy">
                    </div>
                    <div class="excursion-promo__block">
                        <div class="resort-promo__description"><?= the_content(); ?></div>
                        <div class="excursion-promo__column">
                            <? if (get_field('tours_group') != '') { ?>
                                <div class="excursion-promo__item">
                                    <div class="excursion-promo__icon">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri(); ?>/img/excursions/users.svg"
                                                    type="image/webp">
                                            <img src="<?= get_template_directory_uri(); ?>/img/excursions/users.svg"
                                                 alt="Количество человек"
                                                 class="excursion-promo__icon-img"></picture>
                                    </div>
                                    <div class="excursion-promo__info">
                                        <div class="excursion-promo__info-text"><? the_field('tours_group'); ?></div>
                                    </div>
                                </div>
                            <? } ?>
                            <? if (get_field('tours_number') != '') { ?>
                                <div class="excursion-promo__item">
                                    <div class="excursion-promo__icon">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri(); ?>/img/excursions/bed.svg"
                                                    type="image/webp">
                                            <img src="<?= get_template_directory_uri(); ?>/img/excursions/bed.svg"
                                                 alt="Размещение"
                                                 class="excursion-promo__icon-img"></picture>
                                    </div>
                                    <div class="excursion-promo__info">
                                        <div class="excursion-promo__info-text"><? the_field('tours_number'); ?></div>
                                    </div>
                                </div>
                            <? } ?>
                            <? if (get_field('tours_age') != '') { ?>
                                <div class="excursion-promo__item">
                                    <div class="excursion-promo__icon">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri(); ?>/img/excursions/age.svg"
                                                    type="image/webp">
                                            <img src="<?= get_template_directory_uri(); ?>/img/excursions/age.svg"
                                                 alt="Возрастная категория"
                                                 class="excursion-promo__icon-img"></picture>
                                    </div>
                                    <div class="excursion-promo__info">
                                        <div class="excursion-promo__info-text"><? the_field('tours_age'); ?></div>
                                    </div>
                                </div>
                            <? } ?>
                            <? if (get_field('tours_date') != '') { ?>
                                <div class="excursion-promo__item">
                                    <div class="excursion-promo__icon">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri(); ?>/img/excursions/calendar.svg"
                                                    type="image/webp">
                                            <img src="<?= get_template_directory_uri(); ?>/img/excursions/calendar.svg"
                                                 alt="Ближайшие даты туров"
                                                 class="excursion-promo__icon-img"></picture>
                                    </div>
                                    <div class="excursion-promo__info">
                                        <div class="excursion-promo__info-title">Ближайшие даты туров</div>
                                        <div class="excursion-promo__info-text"><? the_field('tours_date'); ?></div>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <? if (have_rows('tours_prices')): ?>
            <section class="excursion-price">
                <div class="container">
                    <section class="headline-primary">
                        <h2 class="headline-primary__headline">Стоимость тура</h2>
                    </section>
                    <div class="resort-price-list">
                        <? while (have_rows('tours_prices')) : the_row(); ?>
                            <div class="resort-price-list__item">
                                <div class="resort-price-list__title"><?php the_sub_field('tours_prices-title'); ?></div>
                                <div class="resort-price-list__value">
                                    от <?php the_sub_field('tours_prices-value'); ?></div>
                            </div>
                        <? endwhile; ?>
                    </div>
                    <?php
                    $priceFile = get_field('tours_programs');
                    if ($priceFile): ?>
                        <div class="excursion-price__program">
                            <img src="<?= get_template_directory_uri(); ?>/img/tours/pdf.png" alt="Программа тура" style="width: 40px;">
                            <a href="<?php echo $priceFile; ?>" class="" target="_blank">Программа тура</a>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <? endif; ?>

        <? if (have_rows('tours_program')): ?>
            <section class="tour-program">
                <div class="container">
                    <section class="headline-primary">
                        <h2 class="headline-primary__headline">Программа тура</h2>
                    </section>
                    <div class="tour-program__list accordion-container">
                        <? while (have_rows('tours_program')) : the_row(); ?>
                            <div class="tour-program__item ac">
                                <div class="ac-header">
                                    <button type="button"
                                            class="ac-trigger"><?php the_sub_field('tours_program-title'); ?></button>
                                </div>
                                <div class="ac-panel">
                                    <div><?php the_sub_field('tours_program-description'); ?></div>
                                </div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <? if (have_rows('tours_gallery')): ?>
            <section>
                <div class="container">
                    <section class="headline-primary">
                        <h2 class="headline-primary__headline">Фото с туров</h2>
                    </section>
                    <div class="resort-gallery__list resort-gallery__list--about">
                        <? $imageGalleryNum = 0; ?>
                        <? while (have_rows('tours_gallery')) : the_row(); ?>
                            <?
                            $imageRest = get_sub_field('tours_gallery-photo');
                            $sizeRest = 'large';
                            if ($imageGalleryNum <= 4) { ?>
                                <div class="resort-gallery__item" data-fancybox="gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>">
                                    <img src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>"
                                         alt="<?= the_title(); ?>" class="resort-gallery__img" loading="lazy">
                                </div>
                            <? } else { ?>
                                <div class="resort-gallery__item" data-fancybox="gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>"
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
                            <? while (have_rows('tours_gallery')) : the_row(); ?>
                                <?
                                $imageRest = get_sub_field('tours_gallery-photo');
                                $sizeRest = 'large';
                                ?>
                                <div class="resort-gallery__slider-item swiper-slide"
                                     data-fancybox="slider-gallery"
                                     data-src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>">
                                    <img loading="lazy"
                                         src="<?= wp_get_attachment_image_url($imageRest, $sizeRest); ?>"
                                         alt="<?= the_title(); ?>" class="resort-gallery__slider-img">
                                </div>
                            <? endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <? if (have_rows('tours_tabs')): ?>
            <section class="resort-about-tabs">
                <div class="container">
                    <div class="treatment-page-tabs">
                        <div class="treatment-page-tabs__navigation">
                            <? $treatmentsProceduresNum = 0; ?>
                            <? while (have_rows('tours_tabs')) : the_row(); ?>
                                <div data=".treatment-<?= $treatmentsProceduresNum ?>"
                                     class="treatment-page-tabs__item <? ($treatmentsProceduresNum == 0) ? print 'is-active' : print '' ?>">
                                    <?php the_sub_field('tours_tabs-title'); ?>

                                    <div class="treatment-page-tabs__accordion">
                                        <!--noindex-->
                                        <?php the_sub_field('tours_tabs-description'); ?>
                                        <!--/noindex-->
                                    </div>
                                </div>
                                <? $treatmentsProceduresNum++; ?>
                            <? endwhile; ?>
                        </div>
                        <div class="treatment-page-tabs__body">
                            <? $treatmentsProceduresNum = 0; ?>
                            <? while (have_rows('tours_tabs')) : the_row(); ?>
                                <div class="treatment-page-tabs__content treatment-<?= $treatmentsProceduresNum ?>"
                                     style="<? ($treatmentsProceduresNum != 0) ? print 'display:none' : print '' ?>">
                                    <?php the_sub_field('tours_tabs-description'); ?>
                                </div>
                                <? $treatmentsProceduresNum++; ?>
                            <? endwhile; ?>
                        </div>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary lead-form--excursions">
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <h2 class="lead-form__title">Забронировать<br>тур</h2>
                    <div class="lead-form__description">
                        <ul>
                            <li>Лично, обратившись: г. Белокуриха, переулок Спортивный д. 5, пом. Н1.</li>
                            <li>По телефонам: 8 (800) 500-07-34, 8 (383) 389-39-83</li>
                            <li>В мессенджерах: +7 (960)-948-20-69 Telegram, MAX</li>
                            <li>По электронной почте: info@big-altay.ru</li>
                            <li>Заполнив форму обратной связи на сайте.</li>
                        </ul>
                    </div>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>
        <?
        $query_args = array(
            'post_type' => 'tours',
            'post_per_page' => 3,
            'showposts' => 3,
            'post_status' => 'publish',
            'post__not_in' => array($post->ID),
        );
        ?>
        <? wp_reset_query();
        $query = new WP_Query($query_args); ?>
        <? if ($query->have_posts()) { ?>
            <section>
                <div class="container">
                    <section class="headline-primary">
                        <h2 class="headline-primary__headline">Другие туры</h2>
                    </section>
                    <div class="excursions__list">
                        <?
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('template-parts/content/tours', get_post_format());
                        } ?>
                    </div>
                </div>
            </section>
        <? } ?>
    </main>

<?php get_footer(); ?>