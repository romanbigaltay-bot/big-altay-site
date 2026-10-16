<?php get_header(); ?>

<?php
$imagePreview = get_field('partners_promo');
$sizePreview = 'header';
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
        <section class="headline-promo">
            <div class="container">
                <h1 class="headline-promo__headline">Приглашаем менеджеров по туризму стать нашими партнерами
                    <a href="#lead-form" class="btn headline-promo-btn animated-button">Стать партнером
                        <span class="headline-promo-btn__icon">
                            <picture>
                                <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                        type="image/webp">
                                <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                     alt="Стать партнером">
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
        <? if (have_rows('partners_advantages')): ?>
            <section class="partners-advantages">
                <div class="container partners-advantages__container">
                    <section class="headline-primary">
                        <h2 class="headline-primary__headline">Почему выгодно работать с нами?</h2>
                        <div class="partners__subtitle">Рассмотрите наши предложения для партнеров</div>
                    </section>
                    <div class="partners-advantages__list">
                        <? while (have_rows('partners_advantages')) : the_row(); ?>
                            <div class="partners-advantages__item">
                                <div class="partners-advantages__icon">
                                    <picture>
                                        <source srcset="<?= get_template_directory_uri(); ?>/img/partners/advantage.svg"
                                                type="image/webp">
                                        <img src="<?= get_template_directory_uri(); ?>/img/partners/advantage.svg"
                                             alt="<?php the_sub_field('partners_advantage-title'); ?>"
                                             class="partners-advantages__icon-img">
                                    </picture>
                                </div>
                                <div class="partners-advantages__title"><?php the_sub_field('partners_advantage-title'); ?></div>
                                <div class="partners-advantages__description"><?php the_sub_field('partners_advantage-description'); ?></div>
                            </div>
                        <? endwhile; ?>
                    </div>
                </div>
            </section>
        <? endif; ?>

        <? if (have_rows('partners_logos')): ?>
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
                            <? while (have_rows('partners_logos')) : the_row(); ?>
                                <?
                                $imageLogo = get_sub_field('partners_logo');
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

        <section class="anchor"><span id="lead-form"></span></section>
        <section class="lead-form lead-form--secondary lead-form--excursions" style="margin-bottom: -120px">
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <h2 class="lead-form__title">Хотите стать нашим<br>партнером?</h2>
                    <div class="lead-form__description">
                        <ul>
                            <li>Мы предлагаем индивидуальные условия сотрудничества для турагентств.</li>
                            <li>Свяжитесь с нашим менеджером для обсуждения деталей договора о совместной работе.</li>
                        </ul>
                    </div>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>
    </main>

<?php get_footer(); ?>