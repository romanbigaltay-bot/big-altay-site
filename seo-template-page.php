<?php get_header();
//Template name: Шаблон-дубль Главной
?>
<style>
    .widget-online .container,
    .widget-online {
        height: fit-content;
    }

    .main-offers {
        margin: 70px 0;
    }

    .offer__body {
        height: fit-content;
        min-height: 70px;
    }
</style>
<main>
    <section class="widget-online">
        <div class="container">
            <script type="text/javascript" charset="utf-8" src="https://stells.info/assets/js/partner.fire.js"></script>
            <div class="s-partnership" style="display:none;">SgpnsClaWPTyH62N8lvEzZ966H7ZblFR71clDZ%2FCCzM%3D</div>
        </div>
    </section>

    <section class="anchor"><span id="main-offers" style="top: 120px"></span></section>
    <section class="offers main-offers">
        <div class="container offers__container">
            <section class="headline-primary headline-primary--flex">
                <h1 class="headline-primary__headline"><?php the_title();?></h1>
            </section>
            <div class="offers__wrapper">
                <div class="filter">
                    <div class="filter__categories">
                        <? $type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : ''; ?>
                        <a href="/#main-offers"
                            class="filter__category <? $type == '' ? print 'filter__category--active' : print ''; ?>">Санатории
                            в Белокурихе</a>
                        <a href="/?type=rest-belokurikha#main-offers"
                            class="filter__category <? $type == 'rest-belokurikha' ? print 'filter__category--active' : print ''; ?>">Отдых
                            в Белокурихе</a>
                        <a href="/?type=rest-altai-mountains#main-offers"
                            class="filter__category <? $type == 'rest-altai-mountains' ? print 'filter__category--active' : print ''; ?>">Отдых
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
                        <? display_acf_checkbox_values('sanatorium_stars', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-food', 598); ?>
                        <? if ($type == '') {
                            display_acf_checkbox_values('sanatorium_filter-treatment', 598);
                            display_acf_checkbox_values('sanatorium_filter-treatment-children', 598);
                        } ?>
                        <? display_acf_checkbox_values('sanatorium_filter-pool', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-with-children', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-infrastructure', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-rental', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-possibilities', 598); ?>
                        <? display_acf_checkbox_values('sanatorium_filter-distance', 598); ?>
                    </div>
                </div>



                <div class="offers__list swiper">
                    <div class="swiper-wrapper" id="filter-results">
                        <?php
                        // Получаем значение поля sanatorii-same
                        $posts = get_field('sanatorii-same');

                        // Проверяем, есть ли данные
                        if ($posts) :
                            // Если поле возвращает массив записей
                            if (is_array($posts)) :
                                foreach ($posts as $post_object) :
                                    // Настраиваем глобальные переменные поста
                                    setup_postdata($post_object);

                                    // Получаем данные поста
                                    $imageOfferPreview = get_field('sanatorium_promo', $post_object->ID);
                                    $sizeOfferPreview = 'large';
                        ?>
                                    <div class="offer <?php echo (array_key_exists('class', $args)) ? esc_attr($args['class']) : ''; ?>">
                                        <div class="offer__image">
                                            <?php if (get_field('bejdzhik_s_akcziej', $post_object->ID)) { ?>
                                                <div class="badge-sale">
                                                    <a href="<?php echo get_permalink($post_object->ID); ?>?tab=sale#"><?php echo get_field('bejdzhik_s_akcziej', $post_object->ID); ?></a>
                                                </div>
                                            <?php } ?>
                                            <a href="<?php echo get_permalink($post_object->ID); ?>" class="offer__link">
                                                <?php if ($imageOfferPreview) : ?>
                                                    <img src="<?php echo wp_get_attachment_image_url($imageOfferPreview, $sizeOfferPreview); ?>" class="offer__img"
                                                        alt="<?php echo get_the_title($post_object->ID); ?>" loading="lazy">
                                                <?php else : ?>
                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" class="offer__img"
                                                        alt="<?php echo get_the_title($post_object->ID); ?>" loading="lazy">
                                                <?php endif; ?>
                                                <span class="offer__stars">
                                                    <?php
                                                    $stars = get_field_object('sanatorium_stars', $post_object->ID);
                                                    if ($stars && isset($stars['value'])) {
                                                        for ($i = 1; $i <= $stars['value']; $i++) { ?>
                                                            <span class="offer__star">
                                                                <picture>
                                                                    <source srcset="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                                                        type="image/webp">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                                                        alt="Рейтинг">
                                                                </picture>
                                                            </span>
                                                    <?php }
                                                    } ?>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="offer__body">
                                            <a href="<?php echo get_permalink($post_object->ID); ?>" class="offer__title"><?php echo get_the_title($post_object->ID); ?></a>
                                        </div>
                                        <div class="offer__bottom">
                                            <div class="offer__price">
                                                <?php
                                                $price = get_field('sanatorium_price', $post_object->ID);
                                                if ($price) { ?>
                                                    от <?php echo $price; ?><span>руб./сутки</span>
                                                <?php } else { ?>
                                                    -<span>руб./сутки</span>
                                                <?php } ?>
                                            </div>
                                            <a style="cursor:pointer" data-fancybox data-src="#same-page" class="offer__reserve">Оставить заявку</a>
                                        </div>
                                    </div>
                                <?php
                                    // Сбрасываем глобальные переменные поста
                                    wp_reset_postdata();
                                endforeach;
                            else :
                                // Если поле возвращает один объект записи
                                $post_object = $posts;
                                setup_postdata($post_object);

                                $imageOfferPreview = get_field('sanatorium_promo', $post_object->ID);
                                $sizeOfferPreview = 'large';
                                ?>
                                <div class="offer <?php echo (array_key_exists('class', $args)) ? esc_attr($args['class']) : ''; ?>">
                                    <div class="offer__image">
                                        <?php if (get_field('bejdzhik_s_akcziej', $post_object->ID)) { ?>
                                            <div class="badge-sale">
                                                <a href="<?php echo get_permalink($post_object->ID); ?>?tab=sale#"><?php echo get_field('bejdzhik_s_akcziej', $post_object->ID); ?></a>
                                            </div>
                                        <?php } ?>
                                        <a href="<?php echo get_permalink($post_object->ID); ?>" class="offer__link">
                                            <?php if ($imageOfferPreview) : ?>
                                                <img src="<?php echo wp_get_attachment_image_url($imageOfferPreview, $sizeOfferPreview); ?>" class="offer__img"
                                                    alt="<?php echo get_the_title($post_object->ID); ?>" loading="lazy">
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" class="offer__img"
                                                    alt="<?php echo get_the_title($post_object->ID); ?>" loading="lazy">
                                            <?php endif; ?>
                                            <span class="offer__stars">
                                                <?php
                                                $stars = get_field_object('sanatorium_stars', $post_object->ID);
                                                if ($stars && isset($stars['value'])) {
                                                    for ($i = 1; $i <= $stars['value']; $i++) { ?>
                                                        <span class="offer__star">
                                                            <picture>
                                                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                                                    type="image/webp">
                                                                <img src="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                                                    alt="Рейтинг">
                                                            </picture>
                                                        </span>
                                                <?php }
                                                } ?>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="offer__body">
                                        <a href="<?php echo get_permalink($post_object->ID); ?>" class="offer__title"><?php echo get_the_title($post_object->ID); ?></a>
                                    </div>
                                    <div class="offer__bottom">
                                        <div class="offer__price">
                                            <?php
                                            $price = get_field('sanatorium_price', $post_object->ID);
                                            if ($price) { ?>
                                                от <?php echo $price; ?><span>руб./сутки</span>
                                            <?php } else { ?>
                                                -<span>руб./сутки</span>
                                            <?php } ?>
                                        </div>
                                        <a href="#lead-form" class="offer__reserve">Оставить заявку</a>
                                    </div>
                                </div>
                        <?php
                                wp_reset_postdata();
                            endif;
                        else :
                            // Если данных нет, выводим сообщение (для отладки)
                            echo '<div class="swiper-slide">Нет данных в поле Санатории</div>';
                        endif;
                        ?>
                    </div>
                </div>

                <style>
                    .badge-sale {
                        background: #E6353F;
                        position: absolute;
                        left: 20px;
                        top: 20px;
                        z-index: 3;
                        color: #fff;
                        padding: 5px 10px;
                        border-radius: 3px;
                        transition: all .3s ease 0s;
                    }

                    .badge-sale:hover {
                        background: #0CA4E4;
                    }

                    .badge-sale a {
                        color: #fff;
                    }

                    .offer__image {
                        position: relative;
                    }
                </style>

                    <?php
                        $posts = get_field('sanatorii-same');
                         // Массив для хранения ID записей
                        $selected_post_ids = [];
                        if ($posts) :
                            foreach ($posts as $post_object) :
                                $selected_post_ids[] = $post_object->ID; // Добавляем ID в массив
                                // Остальной код вывода записей
                            endforeach;
                        endif;

                        $selected_post_ids
                    ?>
                    <script>
                    var selectedPostIds = <?php echo json_encode($selected_post_ids); ?>;
                    function sendAjaxRequest() {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    updateResults(xhr.responseText);
                                } else {
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

                        // Передаем ID записей, которые выводятся на странице
                        selectedPostIds.forEach(function (id) {
                            formData.append('selected_ids[]', id);
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
                        filterForms.forEach(function(filterForm) {
                            filterForm.addEventListener('input', function() {
                                sendAjaxRequest();
                            });
                        });
                    }

                    handleFormChanges();
                </script>
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
        document.getElementById("filterOpen").addEventListener("click", function() {
            document.getElementById("filter").classList.add("filter__wrapper--open");
        });
        document.getElementById("filterClose").addEventListener("click", function() {
            document.getElementById("filter").classList.remove("filter__wrapper--open");
        });
    </script>

    <? if (have_rows('main_services')): ?>
        <section class="main-services">
            <div class="container main-services__container">
                <section class="headline-primary">
                    <h2 class="headline-primary__headline">Наши услуги</h2>
                </section>
                <div class="main-services__list">
                    <? while (have_rows('main_services')) : the_row(); ?>
                        <?
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
                    <? endwhile; ?>
                </div>
            </div>
        </section>
    <? endif; ?>

    <? $mainVideo = get_field('main_video');
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
    <? endif; ?>

    <section class="anchor"><span id="lead-form"></span></section>
    <section class="lead-form">
        <div class="container lead-form__container">
            <div class="lead-form__left">
                <h2 class="lead-form__title"><?php the_field('zagolovok_form') ?></h2>
                <div class="lead-form__description">Заполните форму, мы свяжемся с вами в ближайшее время и предложим
                    <span>индивидуальное предложение</span>.
                </div>
            </div>
            <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '6',)); ?>
        </div>
    </section>
    <section class="main-about">
        <div class="container main-about__container">
            <div class="main-about__info">
                <div class="main-about__title"><?php the_field('main_about-title'); ?></div>
                <div class="main-about__description"><?php the_field('main_about-description'); ?></div>
            </div>
            <? if (have_rows('main_about-advantages')): ?>
                <div class="main-about__advantages">
                    <? while (have_rows('main_about-advantages')) : the_row(); ?>
                        <?
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
                    <? endwhile; ?>
                </div>
            <? endif; ?>
        </div>
        <div class="container main-about__images-container">
            <div class="main-about__images">
                <?
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
    <? if (have_rows('main_reviews')): ?>
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
                        <? while (have_rows('main_reviews')) : the_row();
                            get_template_part(
                                'template-parts/content/reviews-main',
                                get_post_format(),
                                array(
                                    'class' => 'swiper-slide',
                                )
                            );
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <? endif; ?>
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
                <?
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
    <?
    $query_args = array(
        'post_type' => 'news',
        'post_per_page' => 6,
        'showposts' => 6,
        'post_status' => 'publish'
    );
    ?>
    <? wp_reset_query();
    $query = new WP_Query($query_args); ?>
    <? if ($query->have_posts()) { ?>
        <section class="news main-news">
            <div class="container">
                <section class="headline-primary headline-primary--flex">
                    <h2 class="headline-primary__headline">Последние новости</h2>
                    <div class="navigation navigation--gray">
                        <div class="navigation__prev news__prev"></div>
                        <div class="navigation__next news__next"></div>
                    </div>
                </section>
                <div class="news__list swiper">
                    <div class="swiper-wrapper">
                        <?
                        while ($query->have_posts()) {
                            $query->the_post();
                            get_template_part(
                                'template-parts/content/news',
                                get_post_format(),
                                array(
                                    'class' => 'swiper-slide',
                                )
                            );
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <? } ?>
</main>

<?php get_footer(); ?>
