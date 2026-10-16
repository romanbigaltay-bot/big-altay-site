<?php get_header(); ?>

<main>
    <?php
get_template_part(
    'template-parts/front-page/hero/hero'
);
?>

<?php
get_template_part(
    'template-parts/front-page/promotions/promotions'
);
?>

    <section style="width: 100%; overflow: hidden;">
        <div class="container" style="max-width: 100% !important; padding-left: 15px !important; padding-right: 15px !important;">
<div style="width: 100%; max-width: 100%;">
            <script type="text/javascript" charset="utf-8" src="https://stells.info/assets/js/partner.fire.js"></script>
            <div class="s-partnership" style="display:none;">SgpnsClaWPTyH62N8lvEzZ966H7ZblFR71clDZ%2FCCzM%3D</div>
			</div>
        </div>
    </section>



    <section class="anchor"><span id="main-offers" style="top: 120px"></span></section>
    <section class="offers main-offers">
        <div class="container offers__container">
            <section class="headline-primary headline-primary--flex">
                <h2 class="headline-primary__headline">Мы предлагаем</h2>
            </section>
            <div class="offers__wrapper">
                <div class="filter">
                    <div class="filter__categories">
                        <?php $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : ''; ?>
                        <a href="/#main-offers"
                           class="filter__category <?php $type == '' ? print 'filter__category--active' : print ''; ?>">Санатории
                            в Белокурихе</a>
                        <a href="/?type=rest-belokurikha#main-offers"
                           class="filter__category <?php $type == 'rest-belokurikha' ? print 'filter__category--active' : print ''; ?>">Отдых
                            в Белокурихе</a>
                        <a href="/?type=rest-altai-mountains#main-offers"
                           class="filter__category <?php $type == 'rest-altai-mountains' ? print 'filter__category--active' : print ''; ?>">Отдых
                            в Горном Алтае</a>
                    </div>
                    <div class="filter__navigation">
                        <div class="filter__button" id="filterOpen">
                            <img src="<?= get_template_directory_uri(); ?>/img/main/filter.svg" alt="Фильтр">
                        </div>
                        <div class="navigation navigation--gray">
                            <div class="navigation__prev offers__prev"></div>
                            <div class="navigation__next offers__next"></div>
                        </div>
                    </div>

                    <div class="filter__wrapper" id="filter">
                        <div class="filter__button-close" id="filterClose">
                            <img src="<?= get_template_directory_uri(); ?>/img/main/close.svg" alt="Закрыть">
                        </div>
                        <div class="filter__title">Фильтр</div>
                        <div class="filter__tab ac">
                            <button type="button" class="filter__trigger ac-trigger">Цена</button>
                            <div class="filter__panel ac-panel">
                                <div class="filter__body filter__body--price">
                                    <input type="number" name="priceFrom" value="2000" placeholder="от 2000" min="1000"
                                           max="20000" step="100">
                                    <input type="number" name="priceTo" value="10000" placeholder="до 10000" min="1000"
                                           max="20000" step="100">
                                </div>
                            </div>
                        </div>
                        <?php display_acf_checkbox_values('sanatorium_stars', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-food', 598); ?>
                        <?php if ($type == '') {
                            display_acf_checkbox_values('sanatorium_filter-treatment', 598);
                            display_acf_checkbox_values('sanatorium_filter-treatment-children', 598);
                        } ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-pool', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-with-children', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-infrastructure', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-rental', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-possibilities', 598); ?>
                        <?php display_acf_checkbox_values('sanatorium_filter-distance', 598); ?>
                    </div>
                </div>

                <script>
                    function sendAjaxRequest() {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    // Обработка успешного ответа от сервера
                                    updateResults(xhr.responseText);
                                } else {
                                    // Обработка ошибки
                                    console.error('Ошибка при отправке запроса');
                                }
                            }
                        };

                        var formData = new FormData();
                        var filterInputs = document.querySelectorAll('.filter__body input');
                        var checkboxValues = {};

                        filterInputs.forEach(function (input) {
                            if (input.type === 'checkbox') {
                                if (!checkboxValues[input.name]) {
                                    checkboxValues[input.name] = [];
                                }

                                if (input.checked) {
                                    checkboxValues[input.name].push(input.value);
                                }
                            } else {
                                formData.append(input.name, input.value);
                            }
                        });

                        var urlParams = new URLSearchParams(window.location.search);
                        var typeParam = urlParams.get('type');
                        if (typeParam) {
                            formData.append('type', typeParam);
                        }

                        formData.append('limit', 4);

                        Object.keys(checkboxValues).forEach(function (name) {
                            checkboxValues[name].forEach(function (value) {
                                formData.append(name + '[]', value);
                            });
                        });

                        formData.append('action', 'filter_sanatoriums');

                        xhr.open('POST', '/wp-admin/admin-ajax.php', true);
                        xhr.send(formData);
                    }

                    function updateResults(results) {
                        var filterResults = document.getElementById('filter-results');
                        filterResults.innerHTML = results;
                    }

                    function handleFormChanges() {
                        var filterForms = document.querySelectorAll('.filter__body');
                        filterForms.forEach(function (filterForm) {
                            filterForm.addEventListener('input', function () {
                                sendAjaxRequest();
                            });
                        });
                    }

                    handleFormChanges();
                </script>

                <div class="offers__list swiper">
                    <div class="swiper-wrapper" id="filter-results">
                        <?php
                        $query_args = array(
                            'post_type' => type_sanatoriums($type),
                            'post_per_page' => 4,
                            'showposts' => 4,
                            'post_status' => 'publish'
                        );
                        ?>
                        <?php wp_reset_query();
                        $query = new WP_Query($query_args); ?>
                        <?php if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                get_template_part('template-parts/content/sanatorium', get_post_format(),
                                    array(
                                        'class' => 'swiper-slide',
                                    ));
                            }
                        }
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
            <div class="offers__footer">
                <a href="/<?= type_sanatoriums($type) ?>/" class="btn headline-promo-btn animated-button">Смотреть все
                    <span class="headline-promo-btn__icon">
                        <picture>
                            <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                    type="image/webp">
                            <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg"
                                 alt="Смотреть все">
                        </picture>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("filterOpen").addEventListener("click", function () {
            document.getElementById("filter").classList.add("filter__wrapper--open");
        });
        document.getElementById("filterClose").addEventListener("click", function () {
            document.getElementById("filter").classList.remove("filter__wrapper--open");
        });
    </script>

    <?php if (have_rows('main_services')): ?>
        <section class="main-services">
            <div class="container main-services__container">
                <section class="headline-primary">
                    <h2 class="headline-primary__headline">Наши услуги</h2>
                </section>
                <div class="main-services__list">
                    <?php while (have_rows('main_services')) : the_row(); ?>
                        <?php
                        $imageServices = get_sub_field('main_services-photo');
                        $sizeServices = 'large';
                        ?>
                        <div class="main-service">
                            <div class="main-service__image">
                                <a href="<?php the_sub_field('main_services-link'); ?>" target="_blank"
                                   class="main-service__link">
                                    <img src="<?= wp_get_attachment_image_url($imageServices, $sizeServices); ?>"
                                         class="main-service__img" alt="<?php the_sub_field('main_services-title'); ?>" loading="lazy">
                                </a>
                            </div>
                            <div class="main-service__body">
                                <a href="<?php the_sub_field('main_services-link'); ?>" target="_blank"
                                   class="main-service__title"><?php the_sub_field('main_services-title'); ?></a>
                                <div class="main-service__description"><?php the_sub_field('main_services-description'); ?></div>
                                <a href="<?php the_sub_field('main_services-link'); ?>" target="_blank"
                                   class="main-service__more">Подробнее</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php $mainVideo = get_field('main_video');
    if ($mainVideo):
        $imageMainVideo = get_field('main_video-promo');
        $sizeMainVideo = 'large';
        ?>
        <section class="main-video">
            <div class="container main-video__container">
                <section class="headline-primary">
                    <h2 class="headline-primary__headline">Видео</h2>
                </section>
                <div class="main-video__wrapper">
                    <video class="main-video__video" controls
                           poster="<?= wp_get_attachment_image_url($imageMainVideo, $sizeMainVideo); ?>">
                        <source src="<?= $mainVideo; ?>" type="video/mp4">
                    </video>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="anchor"><span id="lead-form"></span></section>
    <section class="lead-form">
        <div class="container lead-form__container">
            <div class="lead-form__left">
                <h2 class="lead-form__title">Хотите <br>забронировать<br> тур со <span
                            class="lead-form__badge">скидкой?</span></h2>
                <div class="lead-form__description">Заполните форму, мы свяжемся с вами в ближайшее время и предложим
                    <span>индивидуальное предложение</span>.
                </div>
            </div>
            <?php get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '6',)); ?>
        </div>
    </section>
    <section class="main-about">
        <div class="container main-about__container">
            <div class="main-about__info">
                <div class="main-about__title"><?php the_field('main_about-title'); ?></div>
                <div class="main-about__description"><?php the_field('main_about-description'); ?></div>
            </div>
            <?php if (have_rows('main_about-advantages')): ?>
                <div class="main-about__advantages">
                    <?php while (have_rows('main_about-advantages')) : the_row(); ?>
                        <?php
                        $imageAboutIcon = get_sub_field('main_about-advantages-icon');
                        $sizeAboutIcon = 'medium';
                        ?>
                        <div class="main-about-advantage">
                            <div class="main-about-advantage__icon">
                                <img src="<?= wp_get_attachment_image_url($imageAboutIcon, $sizeAboutIcon); ?>"
                                     alt="<?php the_sub_field('main_about-advantages-title'); ?>" loading="lazy">
                            </div>
                            <div class="main-about-advantage__description">
                                <div class="main-about-advantage__title"><?php the_sub_field('main_about-advantages-title'); ?></div>
                                <div class="main-about-advantage__text"><?php the_sub_field('main_about-advantages-description'); ?></div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="container main-about__images-container">
            <div class="main-about__images">
                <?php
                $imageAbout1 = get_field('main_about-photo1');
                $imageAbout2 = get_field('main_about-photo2');
                $sizeAbout = 'header';
                ?>
                <div class="main-about__image">
                    <img src="<?= wp_get_attachment_image_url($imageAbout1, $sizeAbout); ?>"
                         class="main-about__img" alt="Курорты в Белокурихе" loading="lazy">
                </div>
                <div class="main-about__image">
                    <img src="<?= wp_get_attachment_image_url($imageAbout2, $sizeAbout); ?>"
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
                            <img src="<?= wp_get_attachment_image_url($imageAbout1, $sizeAbout); ?>"
                                 alt="Курорты в Белокурихе" class="main-about__item-img" loading="lazy">
                        </div>
                        <div class="swiper-slide main-about__item">
                            <img src="<?= wp_get_attachment_image_url($imageAbout2, $sizeAbout); ?>"
                                 alt="Курорты в Белокурихе" class="main-about__item-img" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    get_template_part(
        'template-parts/front-page/divisions/divisions'
    );
    ?>

    <?php if (have_rows('main_reviews', 139)): ?>
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
                        <?php while (have_rows('main_reviews', 139)) : the_row();
                            get_template_part('template-parts/content/reviews-main', get_post_format(),
                                array(
                                    'class' => 'swiper-slide',
                                ));
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="main-info">
        <div class="container main-info__container">
            <div class="main-info__lines">
                <div class="main-info__line">
                    <div class="main-info__title"><?php the_field('main_info-title1'); ?></div>
                    <div class="main-info__text"><?php the_field('main_info-description1'); ?></div>
                </div>
                <div class="main-info__line">
                    <div class="main-info__title"><?php the_field('main_info-title2'); ?></div>
                    <div class="main-info__text"><?php the_field('main_info-description2'); ?></div>
                </div>
            </div>
            <div class="main-info__images">
                <?php
                $imageInfo1 = get_field('main_info-photo1');
                $imageInfo2 = get_field('main_info-photo2');
                $imageInfo3 = get_field('main_info-photo3');
                $sizeInfo = 'large';
                ?>
                <div class="main-info__image">
                    <img src="<?= wp_get_attachment_image_url($imageInfo1, $sizeInfo); ?>" class="main-info__img"
                         alt="Курорты в Белокурихе" loading="lazy">
                </div>
                <div class="main-info__image">
                    <img src="<?= wp_get_attachment_image_url($imageInfo2, $sizeInfo); ?>" class="main-info__img"
                         alt="Курорты в Белокурихе" loading="lazy">
                </div>
                <div class="main-info__image">
                    <img src="<?= wp_get_attachment_image_url($imageInfo3, $sizeInfo); ?>" class="main-info__img"
                         alt="Курорты в Белокурихе" loading="lazy">
                </div>
            </div>
            <div class="main-info__gallery">
                <div class="navigation navigation--gray">
                    <div class="navigation__prev main-info__prev"></div>
                    <div class="navigation__next main-info__next"></div>
                </div>
                <div class="main-info__list swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide main-info__item">
                            <img src="<?= wp_get_attachment_image_url($imageInfo1, $sizeInfo); ?>"
                                 alt="Курорты в Белокурихе" class="main-info__item-img" loading="lazy">
                        </div>
                        <div class="swiper-slide main-info__item">
                            <img src="<?= wp_get_attachment_image_url($imageInfo2, $sizeInfo); ?>"
                                 alt="Курорты в Белокурихе" class="main-info__item-img" loading="lazy">
                        </div>
                        <div class="swiper-slide main-info__item">
                            <img src="<?= wp_get_attachment_image_url($imageInfo3, $sizeInfo); ?>"
                                 alt="Курорты в Белокурихе" class="main-info__item-img" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $query_args = array(
        'post_type' => 'news',
        'posts_per_page' => 3,
        'post_status' => 'publish'
    );
    wp_reset_query();
    $query = new WP_Query($query_args);
    if ($query->have_posts()) { ?>
        <section class="bads-section bads-section--lg">
            <div class="bads-container">
                <div class="bads-stack bads-stack--lg">
                    <div class="bads-cluster u-justify-between u-items-center">
                        <?php get_template_part('template-parts/ui/title', null, ['level' => 'h2', 'title' => 'Актуальные новости']); ?>
                        <?php
                        get_template_part('template-parts/ui/button', null, [
                            'text'          => 'Все новости',
                            'url'           => get_post_type_archive_link('news'),
                            'type'          => 'link',
                            'variant'       => 'link',
                            'size'          => 'md',
                            'icon'          => 'navigation/arrow-right',
                            'icon_position' => 'right',
                        ]);
                        ?>
                    </div>
                    
                    <div class="bads-grid bads-grid--3">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part('template-parts/content/news');
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>
