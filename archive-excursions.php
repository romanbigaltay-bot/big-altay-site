<?php get_header(); ?>

    <main>
        <section class="breadcrumbs">
            <div class="container breadcrumbs__container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="breadcrumbs__item"><?php the_archive_title() ?></li>
                </ul>
            </div>
        </section>
        <section class="excursions">
            <div class="container offers__container">
                <section class="headline-primary">
                    <h1 class="headline-primary__headline"><?php the_archive_title() ?></h1>
                </section>
                <div class="excursions__list">
                    <?
                    $query_args = array(
                        'post_type' => 'excursions',
                        'post_per_page' => 30,
                        'post_status' => 'publish',
                        'showposts' => 30,
                    );
                    ?>
                    <? wp_reset_query();
                    $query = new WP_Query($query_args); ?>
                    <? if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('template-parts/content/excursions', get_post_format());
                        }
                    }
                    ?>
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
                            <li>Лично, обратившись в курсовочное бюро: г.Белокуриха, ул. Славского 29/1.</li>
                            <li>По телефонам: 8 (800) 500-07-34, 8 (383) 389-39-83</li>
                            <li>В мессенджерах: +7 (960)-948-20-69 Telegram, WhatsApp</li>
                            <li>По электронной почте: info@big-altay.ru</li>
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