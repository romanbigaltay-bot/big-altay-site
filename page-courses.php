<?php get_header(); ?>

<?php
$imagePreview = get_field('courses_promo');
$sizePreview = 'header';
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">Курсовки</li>
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
        <section class="courses-promo pensioners-promo resort-promo">
            <div class="container resort-promo__container">
                <div class="resort-promo__wrapper">
                    <div class="resort-promo__image">
                        <img src="<?= wp_get_attachment_image_url($imagePreview, $sizePreview); ?>"
                             alt="<? the_title(); ?>" class="resort-promo__img" loading="lazy">
                    </div>
                    <div class="resort-promo__description"><?= the_content(); ?></div>
                    <? if (have_rows('courses_promo-advantages')): ?>
                        <div class="courses-promo__list">
                            <? while (have_rows('courses_promo-advantages')) : the_row(); ?>
                                <?
                                $imagePromo = get_sub_field('courses_promo-advantages-icon');
                                $sizePromo = 'large';
                                ?>
                                <div class="courses-promo__item">
                                    <div class="courses-promo__icon">
                                        <img src="<?= wp_get_attachment_image_url($imagePromo, $sizePromo); ?>"
                                             alt="<?php the_sub_field('courses_promo-advantages-title'); ?>"
                                             class="courses-promo__icon-img" loading="lazy">
                                    </div>
                                    <div class="courses-promo__title"><?php the_sub_field('courses_promo-advantages-title'); ?></div>
                                </div>
                            <? endwhile; ?>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </section>
        <section class="courses-directions">
            <div class="container">
                <div class="courses-directions__wrapper">
                    <div class="courses-directions__text">
                        <div class="courses-directions__title"><?php the_field('courses_directions-title'); ?></div>
                        <? if (have_rows('courses_directions-list')): ?>
                            <ul class="courses-directions__list">
                                <? while (have_rows('courses_directions-list')) : the_row(); ?>
                                    <li class="courses-directions__item"><?php the_sub_field('courses_directions-list-item'); ?></li>
                                <? endwhile; ?>
                            </ul>
                        <? endif; ?>
                        <div class="courses-directions__notice"><?php the_field('courses_directions-notice'); ?></div>
                    </div>
                    <div class="courses-directions__image">
                        <?
                        $imageDirections = get_field('courses_directions-photo');
                        $sizeDirections = 'large';
                        ?>
                        <img src="<?= wp_get_attachment_image_url($imageDirections, $sizeDirections); ?>"
                             alt="<?php the_field('courses_directions-title'); ?>" class="courses-directions__img" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <? if (have_rows('courses_treatments')): ?>
            <section class="courses-treatment">
                <div class="container">
                    <h2 class="resort-about__title">Направления</h2>
                    <div class="resort-tab__description">
                        <p>Пока по курсовочному бюро доступны пять направлений лечения (в<br>будущем, этот список будет
                            расширен) это:</p>
                    </div>
                    <div class="resort-treatment__list">
                        <? $treatmentsNum = 0; ?>
                        <? while (have_rows('courses_treatments')) : the_row(); ?>
                            <?
                            $imageTreatments = get_sub_field('courses_treatments-icon');
                            $sizeTreatments = 'large';
                            ?>
                            <? if ($treatmentsNum < 5) { ?>
                                <a href="#" class="resort-treatment__item">
                                    <div class="resort-treatment__icon">
                                        <img src="<?= wp_get_attachment_image_url($imageTreatments, $sizeTreatments); ?>"
                                             alt="<?php the_sub_field('courses_treatments-title'); ?>" loading="lazy">
                                    </div>
                                    <div class="resort-treatment__title"><?php the_sub_field('courses_treatments-title'); ?></div>
                                </a>
                            <? } ?>
                            <? $treatmentsNum++ ?>
                        <? endwhile; ?>
                        <a class="courses-treatment__item courses-treatment__item--more">
                            <div>
                                <span>Все направления, кроме оздоровительного, рассчитаны на 6 и 10 дней</span>. Отдых
                                по оздоровительному направлению начинается от трех дней. Такой вариант идеально подходит
                                для тех гостей, кто не располагает большим количеством времени для отдыха, поэтому может
                                приехать даже просто на выходные.
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <? if (have_rows('courses_services')): ?>
            <section class="corp-events premium-events">
                <div class="container corp-events__container">
                    <h2 class="resort-about__title">Лечебные программы</h2>
                    <div class="resort-tab__description">
                      
                    </div>
                    <div class="corp-events__list">
                        <? while (have_rows('courses_services')) : the_row(); ?>
                            <?
                            $imageServices = get_sub_field('courses_services-photo');
                            $sizeServices = 'large';
                            ?>
                            <div class="corp-events__item">
                                <div class="corp-events__image">
                                    <img src="<?= wp_get_attachment_image_url($imageServices, $sizeServices); ?>"
                                         alt="<?php the_sub_field('courses_services-title'); ?>"
                                         class="corp-events__img" loading="lazy">
                                </div>
                                <div class="corp-events__title"><?php the_sub_field('courses_services-title'); ?></div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>
        <section class="courses-nutrition">
            <div class="container">
                <div class="courses-nutrition__wrapper">
                    <div class="courses-nutrition__text">
                        <h2 class="resort-about__title"><?php the_field('courses_nutrition-title'); ?></h2>
                        <div class="courses-nutrition__description"><?php the_field('courses_nutrition-description'); ?></div>
                    </div>
                    <div class="courses-nutrition__image">
                        <?
                        $imageNutrition = get_field('courses_nutrition-photo');
                        $sizeNutrition = 'large';
                        ?>
                        <img src="<?= wp_get_attachment_image_url($imageNutrition, $sizeNutrition); ?>"
                             alt="<?php the_field('courses_nutrition-title'); ?>" class="courses-nutrition__img" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <section class="courses-rest pensioners-rest">
            <div class="container">
                <div class="courses-rest__wrapper">
                    <div class="courses-rest__images">
                        <?
                        $imageNumbers1 = get_field('courses_numbers-photo1');
                        $imageNumbers2 = get_field('courses_numbers-photo2');
                        $sizeNumbers = 'large';
                        ?>
                        <div class="courses-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageNumbers1, $sizeNumbers); ?>"
                                 alt="<?php the_field('courses_rest-title'); ?>" class="courses-rest__img" loading="lazy">
                        </div>
                        <div class="courses-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageNumbers2, $sizeNumbers); ?>"
                                 alt="<?php the_field('courses_rest-title'); ?>" class="courses-rest__img" loading="lazy">
                        </div>
                    </div>
                    <div class="courses-rest__text">
                        <h2 class="resort-about__title"><?php the_field('courses_numbers-title'); ?></h2>
                        <?php the_field('courses_numbers-description'); ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="pensioners-rest">
            <div class="container">
                <div class="pensioners-rest__wrapper">
                    <div class="pensioners-rest__text">
                        <h2 class="resort-about__title"><?php the_field('courses_rest-title'); ?></h2>
                        <?php the_field('courses_rest-description'); ?>
                    </div>
                    <div class="pensioners-rest__images">
                        <?
                        $imageRest1 = get_field('courses_rest-photo1');
                        $imageRest2 = get_field('courses_rest-photo2');
                        $sizeRest = 'large';
                        ?>
                        <div class="pensioners-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageRest1, $sizeRest); ?>"
                                 alt="<?php the_field('courses_rest-title'); ?>" class="pensioners-rest__img" loading="lazy">
                        </div>
                        <div class="pensioners-rest__image">
                            <img src="<?= wp_get_attachment_image_url($imageRest2, $sizeRest); ?>"
                                 alt="<?php the_field('courses_rest-title'); ?>" class="pensioners-rest__img" loading="lazy">
                        </div>
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