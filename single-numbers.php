<?php get_header(); ?>

<?php
$content = get_the_content();
$number = get_field('number_sanatorium');

$customPostType = $number->post_type;
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">
                        <? if ($customPostType === 'sanatorium') {
                            print '<a href="/sanatorium/" class="breadcrumbs__link">Лечение в Белокурихе</a>';
                        } elseif ($customPostType === 'rest-belokurikha') {
                            print '<a href="/rest-belokurikha/" class="breadcrumbs__link">Отдых в Белокурихе</a>';
                        } elseif ($customPostType === 'rest-altai-mountains') {
                            print '<a href="/rest-altai-mountains/" class="breadcrumbs__link">Отдых в Горном Алтае</a>';
                        } ?>
                    </li>
                    <li class="breadcrumbs__item"><?= get_the_title($number); ?></li>
                </ul>
            </div>
        </section>
        <section class="headline">
            <div class="container headline__container">
                <section class="headline-primary headline-primary--flex headline-stars">
                    <h1 class="headline-primary__headline"><?= get_the_title($number); ?></h1>
                    <div class="resort-stars resort-stars--desktop">
                        <? for ($i = 1; $i <= get_field('sanatorium_stars', $number); $i++) { ?>
                            <div class="resort-stars__star">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri(); ?>/img/resort/star.svg"
                                            type="image/webp">
                                    <img src="<?= get_template_directory_uri(); ?>/img/resort/star.svg" alt="Рейтинг">
                                </picture>
                            </div>
                        <? } ?>
                    </div>
                </section>
            </div>
        </section>
        <section class="resort" data-params="no-tabs" id="tabs">
            <section class="resort-header">
                <div class="container resort-header__container">
                    <nav class="resort-menu">
                        <ul class="resort-menu__list">
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>"
                                   class="resort-menu__link"><? ($customPostType == 'sanatorium') ? print 'О санатории' : print 'О базе' ?></a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>?tab=food" class="resort-menu__link">Питание</a>
                            </li>
                            <li class="resort-menu__item is-active">
                                <a href="<?= get_the_permalink($number); ?>?tab=numbers" class="resort-menu__link">Проживание</a>
                            </li>
                            <? if ($customPostType === 'sanatorium') { ?>
                                <li class="resort-menu__item">
                                    <a href="<?= get_the_permalink($number); ?>?tab=treatment" class="resort-menu__link">Лечение</a>
                                </li>
                            <? } ?>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>?tab=gallery" class="resort-menu__link">Галерея</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>?tab=price" class="resort-menu__link">Цены</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>?tab=fun" class="resort-menu__link">Досуг</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($number); ?>?tab=reviews" class="resort-menu__link">Отзывы</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="resort-stars resort-stars--mobile">
                        <? for ($i = 1; $i <= get_field('sanatorium_stars', $number); $i++) { ?>
                            <div class="resort-stars__star">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri(); ?>/img/resort/star.svg"
                                            type="image/webp">
                                    <img src="<?= get_template_directory_uri(); ?>/img/resort/star.svg" alt="Рейтинг">
                                </picture>
                            </div>
                        <? } ?>
                    </div>
                    <div class="resort-header__btn">
                        <a href="#lead-form" class="btn resort-header-btn">Забронировать
                            <span class="headline-promo-btn__icon">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                            type="image/webp">
                                    <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                         alt="Забронировать">
                                </picture>
                            </span>
                        </a>
                    </div>
                </div>
            </section>
            <section class="number-page">
                <div class="container">
                    <div class="number-page__title number-page__title--mobile"><?= the_title(); ?></div>
                </div>
                <div class="container number-page__container">
                    <? if (have_rows('number_gallery')): ?>
                        <div class="number-page__images">
                            <? $imageGalleryNum = 0; ?>
                            <? while (have_rows('number_gallery')) : the_row(); ?>
                                <?
                                $imageGallery = get_sub_field('number_gallery-photo');
                                $sizeGallery = 'large';
                                if ($imageGalleryNum <= 2) { ?>
                                    <div class="number-page__image" data-fancybox="gallery"
                                         data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                        <img loading="lazy"
                                             src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                             alt="<?= the_title(); ?> - <?= get_the_title($number); ?>"
                                             class="number-page__img">
                                    </div>
                                <? } else { ?>
                                    <div class="number-page__image" data-fancybox="gallery"
                                         data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                         style="display:none;"></div>
                                <? }
                                $imageGalleryNum++; ?>
                            <? endwhile; ?>
                        </div>
                        <div class="navigation navigation--gray resort-gallery__navigation">
                            <div class="navigation__prev number-page__prev"></div>
                            <div class="navigation__next number-page__next"></div>
                        </div>
                        <div class="swiper number-page__slider">
                            <div class="swiper-wrapper">
                                <? while (have_rows('number_gallery')) : the_row(); ?>
                                    <?
                                    $imageSlider = get_sub_field('number_gallery-photo');
                                    $sizeSlider = 'large'; ?>
                                    <div class="resort-gallery__slider-item swiper-slide"
                                         data-fancybox="slider"
                                         data-src="<?= wp_get_attachment_image_url($imageSlider, $sizeSlider); ?>">
                                        <img loading="lazy"
                                             src="<?= wp_get_attachment_image_url($imageSlider, $sizeSlider); ?>"
                                             alt="<?= the_title(); ?>" class="number-page__slider-img">
                                    </div>
                                <? endwhile; ?>
                            </div>
                        </div>
                    <? endif; ?>
                    <div class="number-page__info">
                        <h2 class="number-page__title"><?= the_title(); ?></h2>
                        <div class="number-page__price"><? the_field('number_price'); ?> руб. сутки</div>
                        <? if ($content !== '') { ?>
                            <div class="number-page__description">
                                <?= the_content(); ?>
                            </div>
                        <? } ?>

                        <?php
                        $equipments = get_field('number_equipment');
                        if ($equipments): ?>
                            <ul class="number-page__list">
                                <?php foreach ($equipments as $equipment): ?>
                                    <li class="number-page__item"><?= $equipment; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </section>

        <section class="anchor"><span id="lead-form"></span></section>
        <? get_template_part('template-parts/components/online-booking', get_post_format(), array('id' => '562',)); ?>
    </main>

<?php get_footer(); ?>