<?php get_header(); ?>

<?php
$imagePreview = get_field('premium_promo');
$sizePreview = 'header';
?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item">Премиум отдых</li>
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
                             alt="<? the_title(); ?>" class="resort-promo__img" style="object-position:left;" loading="lazy">
                    </div>
                </div>
            </div>
        </section>
        <? if (have_rows('premium_advantages')): ?>
            <section class="corp-events premium-events">
                <div class="container corp-events__container">
                    <section class="headline-primary headline-primary--flex">
                        <h2 class="headline-primary__headline">Отдохните с<br>максимальной пользой!</h2>
                    </section>
                    <div class="corp-events__list">
                        <? while (have_rows('premium_advantages')) : the_row(); ?>
                            <?
                            $imageAdvantages = get_sub_field('premium_advantages-photo');
                            $sizeAdvantages = 'large';
                            ?>
                            <div class="corp-events__item corp-events__item--text">
                                <div class="corp-events__image">
                                    <img src="<?= wp_get_attachment_image_url($imageAdvantages, $sizeAdvantages); ?>"
                                         alt="<?php the_sub_field('premium_advantages-title'); ?>"
                                         class="corp-events__img" loading="lazy">
                                </div>
                                <div class="corp-events__title"><?php the_sub_field('premium_advantages-title'); ?></div>
                                <div class="corp-events__text"><?php the_sub_field('premium_advantages-description'); ?></div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <?
        $premiumAdvantagesText = get_field('premium_advantages-bottom');
        if ($premiumAdvantagesText != '') { ?>
            <section class="premium-info">
                <div class="container premium-info__container">
                    <div class="premium-info__text"><?= $premiumAdvantagesText; ?></div>
                </div>
            </section>
        <? } ?>

        <? if (have_rows('premium_treatments')): ?>
            <section class="resort-about-treatment">
                <div class="container">
                    <h2 class="resort-about__title">Направления лечения</h2>
                    <div class="resort-treatment__list">
                        <? while (have_rows('premium_treatments')) : the_row(); ?>
                            <?
                            $imageTreatments = get_sub_field('premium_treatments-icon');
                            $sizeTreatments = 'large';
                            ?>
                            <a class="resort-treatment__item">
                                <div class="resort-treatment__icon">
                                    <img src="<?= wp_get_attachment_image_url($imageTreatments, $sizeTreatments); ?>"
                                         alt="<?php the_sub_field('premium_treatments-title'); ?>" loading="lazy">
                                </div>
                                <div class="resort-treatment__title"><?php the_sub_field('premium_treatments-title'); ?></div>
                            </a>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <?php
        $premiumNumbers = get_field('premium_numbers');
        if ($premiumNumbers): ?>
            <section class="resort-about-numbers premium-numbers">
                <div class="container">
                    <div class="offers__wrapper--single-column">
                        <h2 class="resort-about__title">Номера повышенной комфортности</h2>
                        <div class="offers__list">
                            <?php foreach ($premiumNumbers as $post):
                                setup_postdata($post); ?>
                                <? get_template_part('template-parts/content/numbers', get_post_format()); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>

        <?php
        $premiumVideo = get_field('premium_video');
        if ($premiumVideo): ?>
            <section class="premium-presentation">
                <div class="premium-presentation__container container">
                    <section class="headline-primary headline-primary--flex">
                        <h2 class="headline-primary__headline">Узнайте больше о наших лучших путевках — посмотрите
                            презентацию.</h2>
                    </section>
                    <div class="premium-presentation__wrapper">
                        <div class="premium-presentation__video">
                            <video class="" controls loop="loop"
                                   poster="<?= get_template_directory_uri(); ?>/img/premium/video.jpg">
                                <source src="<?php echo $premiumVideo ?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="premium-presentation__text"><?php the_field('premium_video-description'); ?></div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php
        $premiumSanatorium = get_field('premium_sanatorium');
        if ($premiumSanatorium): ?>
            <section class="resort-about-numbers premium-numbers">
                <div class="container">
                    <div class="offers__wrapper--single-column">
                        <h2 class="resort-about__title">Премиум в санаториях</h2>
                        <div class="offers__list">
                            <?php foreach ($premiumSanatorium as $post):
                                setup_postdata($post); ?>
                                <? get_template_part('template-parts/content/sanatorium', get_post_format()); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            wp_reset_postdata(); ?>
        <?php endif; ?>

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