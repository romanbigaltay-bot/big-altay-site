<?php get_header(); ?>

<?php
$content = get_the_content();
$treatment = get_field('treatments_sanatorium');

$customPostType = $treatment->post_type;
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
                    <li class="breadcrumbs__item"><?= get_the_title($treatment); ?></li>
                </ul>
            </div>
        </section>
        <section class="headline">
            <div class="container headline__container">
                <section class="headline-primary headline-primary--flex headline-stars">
                    <h1 class="headline-primary__headline"><?= get_the_title($treatment); ?></h1>
                    <div class="resort-stars resort-stars--desktop">
                        <? for ($i = 1; $i <= get_field('sanatorium_stars', $treatment); $i++) { ?>
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
                                <a href="<?= get_the_permalink($treatment); ?>"
                                   class="resort-menu__link"><? ($customPostType == 'sanatorium') ? print 'О санатории' : print 'О базе' ?></a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=food" class="resort-menu__link">Питание</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=numbers" class="resort-menu__link">Проживание</a>
                            </li>
                            <? if ($customPostType === 'sanatorium') { ?>
                                <li class="resort-menu__item is-active">
                                    <a href="<?= get_the_permalink($treatment); ?>?tab=treatment"
                                       class="resort-menu__link">Лечение</a>
                                </li>
                            <? } ?>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=gallery" class="resort-menu__link">Галерея</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=price" class="resort-menu__link">Цены</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=fun" class="resort-menu__link">Досуг</a>
                            </li>
                            <li class="resort-menu__item">
                                <a href="<?= get_the_permalink($treatment); ?>?tab=reviews" class="resort-menu__link">Отзывы</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="resort-stars resort-stars--mobile">
                        <? for ($i = 1; $i <= get_field('sanatorium_stars', $treatment); $i++) { ?>
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
                        <a href="#lead-form" class="btn resort-header-btn">Оставить заявку
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
			
			
            <section class="treatment-page">
                <div class="container treatment-page__container">
                    <div class="resort-tab__title"><?= the_title(); ?></div>
                    <? if ($content !== '') { ?>
                        <div class="resort-tab__description"><?= the_content(); ?></div>
                    <? } ?>
                    <? if (have_rows('treatments_gallery')): ?>
                        <div class="treatment-page__images">
                            <? $imageGalleryNum = 0; ?>
                            <? while (have_rows('treatments_gallery')) : the_row(); ?>
                                <?
                                $imageGallery = get_sub_field('treatments_gallery-image');
                                $sizeGallery = 'large';
                                if ($imageGalleryNum <= 2) { ?>
                                    <div class="treatment-page__image" data-fancybox="gallery"
                                         data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                        <img loading="lazy"
                                             src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                             alt="<?= the_title(); ?> - <?= get_the_title($treatment); ?>"
                                             class="treatment-page__img">
                                    </div>
                                <? } else { ?>
                                    <div class="treatment-page__image" data-fancybox="gallery"
                                         data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                         style="display:none;"></div>
                                <? }
                                $imageGalleryNum++; ?>
                            <? endwhile; ?>
                        </div>
                        <div class="navigation navigation--gray resort-gallery__navigation">
                            <div class="navigation__prev treatment-page__prev"></div>
                            <div class="navigation__next treatment-page__next"></div>
                        </div>
                        <div class="treatment-page__slider swiper">
                            <div class="swiper-wrapper">
                                <? while (have_rows('treatments_gallery')) : the_row(); ?>
                                    <?
                                    $imageGallery = get_sub_field('treatments_gallery-image');
                                    $sizeGallery = 'large';
                                    ?>
                                    <div class="swiper-slide treatment-page__slider-item" data-fancybox="slider"
                                         data-src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>">
                                        <img loading="lazy"
                                             src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                             alt="<?= the_title(); ?> - <?= get_the_title($treatment); ?>"
                                             class="treatment-page__img">
                                    </div>
                                <? endwhile; ?>
                            </div>
                        </div>
                    <? endif; ?>

                    <? if (have_rows('treatments_procedures')): ?>
                        <div class="treatment-page-tabs">
                            <div class="treatment-page-tabs__navigation">
                                <? $treatmentsProceduresNum = 0; ?>
                                <? while (have_rows('treatments_procedures')) : the_row(); ?>
                                    <div data=".treatment-<?= $treatmentsProceduresNum ?>"
                                         class="treatment-page-tabs__item <? ($treatmentsProceduresNum == 0) ? print 'is-active' : print '' ?>">
                                        <?php the_sub_field('treatments_procedures-name'); ?>

                                        <div class="treatment-page-tabs__accordion">
                                            <!--noindex-->
                                            <?php the_sub_field('treatments_procedures-description'); ?>
                                            <!--/noindex-->
                                        </div>
                                    </div>
                                    <? $treatmentsProceduresNum++; ?>
                                <? endwhile; ?>
                            </div>
                            <div class="treatment-page-tabs__body">
                                <? $treatmentsProceduresNum = 0; ?>
                                <? while (have_rows('treatments_procedures')) : the_row(); ?>
                                    <div class="treatment-page-tabs__content treatment-<?= $treatmentsProceduresNum ?>"
                                         style="<? ($treatmentsProceduresNum != 0) ? print 'display:none' : print '' ?>">
                                        <?php the_sub_field('treatments_procedures-description'); ?>
                                    </div>
                                    <? $treatmentsProceduresNum++; ?>
                                <? endwhile; ?>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </section>
        </section>

        <section class="anchor"><span id="lead-form"></span></section>
        <? get_template_part('template-parts/components/online-booking', get_post_format(), array('id' => '562',)); ?>
    </main>

<?php get_footer(); ?>