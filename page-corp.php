<?php get_header(); ?>

<?php
$imagePreview = get_field('corp_promo');
$sizePreview = 'header';
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">Корпоративный отдых</li>
                </ul>
            </div>
        </section>
        <section class="headline-promo">
            <div class="container">
                <h1 class="headline-promo__headline"><? the_title(); ?>
                    <a href="#lead-form" class="btn headline-promo-btn animated-button">Оставить заявку на расчет
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
        <section class="excursion-promo resort-promo">
            <div class="container resort-promo__container">
                <div class="resort-promo__wrapper">
                    <div class="resort-promo__image">
                        <img src="<?= wp_get_attachment_image_url($imagePreview, $sizePreview); ?>"
                             alt="<? the_title(); ?>" class="resort-promo__img" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <section class="corp-events">
            <div class="container corp-events__container">
                <section class="headline-primary headline-primary--flex">
                    <h2 class="headline-primary__headline">«Большой Алтай» предоставляет возможности для
                        проведения:</h2>
                    <div class="corp-events__description">В вашем распоряжении будут не только современные залы для
                        конференций, но и площадки для отдыха.
                    </div>
                </section>

                <? if (have_rows('corp_possibilities')): ?>
                    <div class="corp-events__list">
                        <? while (have_rows('corp_possibilities')) : the_row(); ?>
                            <?
                            $imagePossibilities = get_sub_field('corp_possibilities-photo');
                            $sizePossibilities = 'large';
                            ?>
                            <div class="corp-events__item">
                                <div class="corp-events__image">
                                    <img src="<?= wp_get_attachment_image_url($imagePossibilities, $sizePossibilities); ?>"
                                         alt="<?php the_sub_field('corp_possibilities-title'); ?>"
                                         class="corp-events__img" loading="lazy">
                                </div>
                                <div class="corp-events__title"><?php the_sub_field('corp_possibilities-title'); ?></div>
                            </div>
                        <? endwhile; ?>
                    </div>
                <? endif; ?>
            </div>
        </section>

        <? if (have_rows('corp_advantages')): ?>
            <section class="corp-features">
                <div class="container corp-features__container">
                    <div class="corp-features__list">
                        <? while (have_rows('corp_advantages')) : the_row(); ?>
                            <?
                            $imageAdvantages = get_sub_field('corp_advantages-photo');
                            $sizeAdvantages = 'large';
                            ?>
                            <div class="corp-features__item">
                                <div class="corp-features__text">
                                    <section class="headline-primary">
                                        <h2 class="headline-primary__headline"><?php the_sub_field('corp_advantages-title'); ?></h2>
                                    </section>
                                    <div class="corp-features__description">
                                        <?php the_sub_field('corp_advantages-description'); ?>
                                    </div>
                                </div>
                                <div class="corp-features__image">
                                    <img src="<?= wp_get_attachment_image_url($imageAdvantages, $sizeAdvantages); ?>"
                                         alt="<?php the_sub_field('corp_advantages-title'); ?>"
                                         class="corp-features__img" loading="lazy">
                                </div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <section class="corp-numbers">
            <div class="container corp-numbers__container">
                <section class="headline-primary headline-primary--flex">
                    <div>
                        <h2 class="headline-primary__headline">Проживание</h2>
                        <div class="corp-numbers__description"><?php the_field('corp_description'); ?></div>
                    </div>
                    <div class="navigation navigation--gray">
                        <div class="navigation__prev corp-numbers__prev"></div>
                        <div class="navigation__next corp-numbers__next"></div>
                    </div>
                </section>
                <? if (have_rows('corp_description-gallery')): ?>
                    <div class="corp-numbers__list swiper">
                        <div class="swiper-wrapper">
                            <? while (have_rows('corp_description-gallery')) : the_row(); ?>
                                <?
                                $imageGallery = get_sub_field('corp_description-gallery-photo');
                                $sizeGallery = 'large';
                                ?>
                                <div class="swiper-slide corp-numbers__item">
                                    <img src="<?= wp_get_attachment_image_url($imageGallery, $sizeGallery); ?>"
                                         alt="Проживание" class="corp-numbers__img" loading="lazy">
                                </div>
                            <? endwhile; ?>
                        </div>
                    </div>
                <? endif; ?>
            </div>
        </section>

        <? if (have_rows('corp_features')): ?>
            <section class="corp-features">
                <div class="container corp-features__container">
                    <div class="corp-features__list">
                        <? while (have_rows('corp_features')) : the_row(); ?>
                            <?
                            $imageFeatures = get_sub_field('corp_features-photo');
                            $sizeFeatures = 'large';
                            ?>
                            <div class="corp-features__item">
                                <div class="corp-features__text">
                                    <section class="headline-primary">
                                        <h2 class="headline-primary__headline"><?php the_sub_field('corp_features-title'); ?></h2>
                                    </section>
                                    <div class="corp-features__description"><?php the_sub_field('corp_features-description'); ?></div>
                                </div>
                                <div class="corp-features__image">
                                    <img src="<?= wp_get_attachment_image_url($imageFeatures, $sizeFeatures); ?>"
                                         alt="<?php the_sub_field('corp_features-title'); ?>"
                                         class="corp-features__img" loading="lazy">
                                </div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary lead-form--excursions">
            <div class="container lead-form__container">
                <div class="lead-form__left"><h2 class="lead-form__title">Хотите узнать<br>больше?</h2>
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