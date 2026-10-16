<?php get_header(); ?>

<?php
$content = get_the_content();
$putevka_id = get_the_ID();
?>

<main>
    <!-- 1. Первый экран: Хлебные крошки + Заголовок Н1 + Якорное меню + Кнопка -->
    <section class="breadcrumbs">
        <div class="container breadcrumbs__container">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item">
                    <a href="/" class="breadcrumbs__link">Главная</a>
                </li>
               <!-- <li class="breadcrumbs__item">
                    <a href="/putevki/" class="breadcrumbs__link">Путевки</a>
                </li>-->
                <li class="breadcrumbs__item"><?= get_the_title(); ?></li>
            </ul>
        </div>
    </section>

    <section class="headline">
        <div class="container headline__container">
            <section class="headline-primary">
                <h1 class="headline-primary__headline"><?= get_the_title(); ?></h1>
            </section>
        </div>
    </section>

    <!-- Якорное меню (можно скопировать структуру из resort-menu) -->
    <section class="resort-header">
        <div class="container resort-header__container">
            <nav class="resort-menu">
                <ul class="resort-menu__list">
                    <li class="resort-menu__item is-active"><a href="#about" class="resort-menu__link">О путевке</a></li>
                    <li class="resort-menu__item"><a href="#benefits" class="resort-menu__link">Выгоды</a></li>
                    <li class="resort-menu__item"><a href="#vouchers" class="resort-menu__link">Виды путевок</a></li>
                    <li class="resort-menu__item"><a href="#sanatoriums" class="resort-menu__link">Санатории</a></li>
                    <li class="resort-menu__item"><a href="#prices" class="resort-menu__link">Цены</a></li>
                    <li class="resort-menu__item"><a href="#profiles" class="resort-menu__link">Лечебные профили</a></li>
                    <li class="resort-menu__item"><a href="#reviews" class="resort-menu__link">Отзывы</a></li>
                    <li class="resort-menu__item"><a href="#faq" class="resort-menu__link">FAQ</a></li>
                </ul>
            </nav>
            <div class="resort-header__btn">
                <a href="#lead-form" class="btn resort-header-btn">Оставить заявку
                    <span class="headline-promo-btn__icon">
                        <picture>
                            <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" type="image/webp">
                            <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" alt="Забронировать">
                        </picture>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- 2. Блок-введение -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-section__content">
                <?php if ($content): ?>
                    <div class="about-section__text">
                        <?= apply_filters('the_content', $content); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 3. Блок "Выгоды" -->
<?php if (have_rows('putevka_benefits')): ?>
<section class="main-services" id="benefits" style="margin-top:50px;">
    <div class="container offers__container">
        <section class="headline-primary">
            <h2 class="resort-tab__title">Выгоды</h2>
        </section>
        <div class="excursions__list">
            <?php while (have_rows('putevka_benefits')): the_row();
                $image = get_sub_field('benefit_image');
                $title = get_sub_field('benefit_title');
                $desc = get_sub_field('benefit_description');
                $size = 'large';
            ?>
            <div class="excursions-item">
                <?php if ($image): ?>
                <div class="excursions-item__image">
                    <img style="aspect-ratio: 1/.51;"
                         src="<?= esc_url(wp_get_attachment_image_url($image, $size)); ?>"
                         class="excursions-item__img"
                         alt="<?= esc_attr($title); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
                <div class="excursions-item__body">
                    <div class="excursions-item__title"><?= esc_html($title); ?></div>
                    <div class="excursions-item__description"><?= esc_html($desc); ?></div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <a href="#lead-form" class="btn headline-promo-btn animated-button" style="float:none;margin-left:auto;margin-right:auto;">
        Забронировать со скидкой
        <span class="headline-promo-btn__icon">
            <picture>
                <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" type="image/webp">
                <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" alt="Забронировать со скидкой">
            </picture>
        </span>
    </a>
</section>
<?php endif; ?>

    <!-- 4. Блок "Виды путевок" -->
<section class="main-about" id="vouchers">
    <div class="container main-about__container">
        <?php
        $title = get_field('type_title');
        $description = get_field('type_description');
        ?>
        <?php if ($title || $description): ?>
        <div class="main-about__info">
            <?php if ($title): ?>
            <div class="main-about__title"><?= esc_html($title); ?></div>
            <?php endif; ?>
            <?php if ($description): ?>
            <div class="main-about__description"><?= wp_kses_post($description); ?></div>
            <?php endif; ?>

        <a href="#lead-form" class="btn headline-promo-btn animated-button" style="float:none;margin-left:auto;margin-right:auto;margin-top:30px;">
        Забронировать со скидкой
        <span class="headline-promo-btn__icon">
            <picture>
                <source srcset="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" type="image/webp">
                <img src="<?= get_template_directory_uri(); ?>/img/other/right-arrow.svg" alt="Забронировать со скидкой">
            </picture>
        </span>
    </a>
        </div>
        <?php endif; ?>

        <?php if (have_rows('type_advantages')): ?>
        <div class="main-about__advantages">
            <?php while (have_rows('type_advantages')): the_row();
                $icon = get_sub_field('type_advantages-icon');
                $adv_title = get_sub_field('type_advantages-title');
                $adv_description = get_sub_field('type_advantages-description');
                $size = 'medium';
            ?>
            <div class="main-about-advantage">
                <?php if ($icon): ?>
                <div class="main-about-advantage__icon">
                    <img src="<?= esc_url(wp_get_attachment_image_url($icon, $size)); ?>"
                         alt="<?= esc_attr($adv_title); ?>"
                         loading="lazy">
                </div>
                <?php endif; ?>
                <div class="main-about-advantage__description">
                    <div class="main-about-advantage__title"><?= esc_html($adv_title); ?></div>
                    <div class="main-about-advantage__text"><?= wp_kses_post($adv_description); ?></div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>


</section>

    <!-- 5. Блок "Санатории" -->
<?php if (have_rows('putevka_sanatoriums')): ?>
<section class="resort-about-numbers" id="sanatoriums">
    <div class="container">
        <div class="offers__wrapper--single-column">
            <h2 class="resort-tab__title">Санатории</h2>
            <div class="offers__list">
                <?php while (have_rows('putevka_sanatoriums')): the_row();
                    $sanatorium = get_sub_field('sanatorium');
                    if ($sanatorium):
                        $title = get_the_title($sanatorium->ID);
                        $link = get_permalink($sanatorium->ID);
                        $promo_image = get_field('sanatorium_promo', $sanatorium->ID);
                        $image = wp_get_attachment_image_url($promo_image, 'large');
                        $price = get_sub_field('custom_price') ?: 'По запросу'; // если хотите свою цену
                ?>
                <div class="offer">
                    <?php if ($image): ?>
                    <div class="offer__image">
                        <a href="<?= esc_url($link); ?>" class="offer__link">
                            <img src="<?= esc_url($image); ?>"
                                 class="offer__img"
                                 alt="<?= esc_attr($title); ?>"
                                 loading="lazy">
                        </a>
                    </div>
                    <?php endif; ?>

                    <div class="offer__body">
                        <a href="<?= esc_url($link); ?>" class="offer__title"><?= esc_html($title); ?></a>
                        <a href="<?= esc_url($link); ?>" class="offer__more">Подробнее</a>
                    </div>

                    <div class="offer__bottom">
                        <div class="offer__price">
                            <a href="#lead-form" class="offer__reserve">Забронировать со скидкой</a>
                        </div>

                    </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

    <!-- 6. Блок "Цены" -->
    <section class="resort-price" id="prices">
                    <div class="container resort-price__container">
                        <h2 class="resort-tab__title">Цены на услуги</h2>
                        <?
                        $priceText = get_field('putevka_prices-text');
                        if ($priceText != '') { ?>
                            <div class="resort-tab__description"><?= $priceText; ?></div>
                        <? } ?>
                        <div class="resort-price__wrapper">
                            <div class="resort-price-list">
                                <? if (have_rows('putevka_prices')) : ?>
                                    <? while (have_rows('putevka_prices')) : the_row(); ?>
                                        <div class="resort-price-list__item">
                                            <div class="resort-price-list__title"><?php the_sub_field('putevka_prices-title'); ?></div>
                                            <div class="resort-price-list__value">
                                                от <?php the_sub_field('putevka_prices-value'); ?></div>
                                        </div>
                                    <? endwhile; ?>
                                <? else :; ?>
                                    Информации пока нет.
                                <? endif; ?>
                            </div>
                            <div class="resort-price-panel">
                                <?php
                                $priceFile = get_field('putevka_prices-file');
                                if ($priceFile) : ?>
                                    <a href="<?php echo $priceFile; ?>" class="resort-price-panel__item resort-price-panel__item--btn" target="_blank">Скачать полный Прайс-лист</a>
                                <?php endif; ?>

                                <? if (have_rows('putevka_prices-card')) : ?>
                                    <? while (have_rows('putevka_prices-card')) : the_row(); ?>
                                        <div class="resort-price-panel__item"><?php the_sub_field('putevka_prices-card-title'); ?></div>
                                    <? endwhile; ?>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="resort-price-info">
                            <div class="resort-tab__title">Документы, необходимые для заезда:</div>
                            <? if (have_rows('putevka_prices-docs')) : ?>
                                <? while (have_rows('putevka_prices-docs')) : the_row(); ?>
                                    <div class="resort-price-info__title"><?php the_sub_field('putevka_prices-docs-title'); ?></div>
                                    <div class="resort-price-info__text">
                                        <?php the_sub_field('putevka_prices-docs-list'); ?>
                                    </div>
                                <? endwhile; ?>
                            <? else :; ?>
                                Информации пока нет.
                            <? endif; ?>
                        </div>
                    </div>
                </section>

    <!-- 7. Блок "Оставить заявку" -->
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
            <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '6',)); ?>
        </div>
    </section>

    <!-- 8. Блок "Лечебные профили" -->
<?php if (have_rows('putevka_treatments')): ?>
<section class="profiles-section" id="profiles">
    <div class="container">
        <div class="resort-treatment__wrapper">
            <h2 class="resort-tab__title">Направления лечения</h2>
            <div class="resort-treatment__list">
                <?php while (have_rows('putevka_treatments')): the_row();
                    $treatment = get_sub_field('treatment');
                    if ($treatment):
                        $treatment_id = $treatment->ID;
                        $treatment_title = get_the_title($treatment_id);
                        $treatment_link = get_permalink($treatment_id);
                        $treatment_icon = get_field('treatments_icons', $treatment_id);
                        $size = 'large';
                ?>
                <a href="<?= esc_url($treatment_link); ?>" class="resort-treatment__item">
                    <?php if ($treatment_icon): ?>
                    <div class="resort-treatment__icon">
                        <img src="<?= esc_url(wp_get_attachment_image_url($treatment_icon, $size)); ?>"
                             alt="<?= esc_attr($treatment_title); ?>"
                             loading="lazy">
                    </div>
                    <?php endif; ?>
                    <div class="resort-treatment__title"><?= esc_html($treatment_title); ?></div>
                </a>
                <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

    <!-- 9. Блок "Что входит в путевку" -->
<section class="includes-section" id="includes">
    <div class="container">
        <?php
        $zagolovok = get_field('zagolovok_bloka');
        if ($zagolovok):
        ?>
        <h2 class="resort-tab__title"><?= esc_html($zagolovok); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('nadpisi_v_obvodke')): ?>
        <div class="advantages_tour">
            <?php while (have_rows('nadpisi_v_obvodke')): the_row();
                $tekst = get_sub_field('nadpisi_v_obvodke-tekst');
            ?>
                <?php if ($tekst): ?>
                <p><?= esc_html($tekst); ?></p>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

    <!-- 10. Блок "Сделаем все за вас" -->
<?php if (have_rows('putevka_possibilities')): ?>
<section class="corp-events">
    <div class="container corp-events__container">
        <section class="headline-primary headline-primary--flex">
            <h2 class="resort-tab__title">Сделаем все за вас</h2>
        </section>

        <div class="corp-events__list">
            <?php while (have_rows('putevka_possibilities')): the_row();
                $image = get_sub_field('putevka_possibilities-photo');
                $title = get_sub_field('putevka_possibilities-title');
                $size = 'large';
            ?>
            <div class="corp-events__item">
                <?php if ($image): ?>
                <div class="corp-events__image">
                    <img src="<?= esc_url(wp_get_attachment_image_url($image, $size)); ?>"
                         alt="<?= esc_attr($title); ?>"
                         class="corp-events__img"
                         loading="lazy">
                </div>
                <?php endif; ?>
                <?php if ($title): ?>
                <div class="corp-events__title"><?= esc_html($title); ?></div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

    <!-- 11. Блок "Схема работы" -->
<?php if (have_rows('putevka_advantages')): ?>
<section class="partners-advantages">
    <div class="container partners-advantages__container">
        <h2 class="resort-tab__title">Схема работы</h2>
        <div class="partners-advantages__list">
            <?php
            $step_number = 1;
            while (have_rows('putevka_advantages')): the_row();
                $title = get_sub_field('putevka_advantage-title');
                $description = get_sub_field('putevka_advantage-description');
            ?>
            <div class="partners-advantages__item">
                <div class="partners-advantages__icon">
                    <span class="partners-advantages__number"><?= $step_number; ?></span>
                </div>

                <?php if ($title): ?>
                <div class="partners-advantages__title"><?= esc_html($title); ?></div>
                <?php endif; ?>

                <?php if ($description): ?>
                <div class="partners-advantages__description"><?= esc_html($description); ?></div>
                <?php endif; ?>
            </div>
            <?php
            $step_number++;
            endwhile;
            ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- 12. Блок "Отзывы с Fancybox" -->
<?php if (have_rows('putevka_reviews')): ?>
<section class="reviews-section" id="reviews">
    <div class="container">
        <h2 class="resort-tab__title">Отзывы</h2>
        <div class="reviews-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
            <?php
            $review_index = 0;
            while (have_rows('putevka_reviews')): the_row();
                $screenshot = get_sub_field('review_screenshot');
                $source = get_sub_field('review_source');
                $size = 'full';
                $review_index++;
            ?>
            <div class="review-card" style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                <?php if ($screenshot): ?>
                <div class="review-card__image" style="position: relative; cursor: pointer;">
                    <!-- Оборачиваем в ссылку для fancybox -->
                    <a href="<?= esc_url(wp_get_attachment_image_url($screenshot, 'full')); ?>"
                       data-fancybox="reviews-gallery"
                       data-caption="<?= $source ? 'Отзыв с ' . $source : 'Отзыв'; ?>"
                       class="review-card__link">
                        <img src="<?= esc_url(wp_get_attachment_image_url($screenshot, $size)); ?>"
                             alt="<?= $source ? esc_attr($source) : 'Отзыв'; ?>"
                             style="width: 100%; height: auto; display: block;"
                             loading="lazy">
                    </a>

                    <?php if ($source): ?>
                    <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px; z-index: 1; pointer-events: none;">
                        <?= esc_html($source); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (get_sub_field('review_text')): ?>
                <div class="review-card__content" style="padding: 15px;">
                    <p style="margin: 0; font-size: 14px; line-height: 1.5;"><?= esc_html(get_sub_field('review_text')); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 13. Блок "FAQ (частые вопросы)" -->
<?php if (have_rows('putevka_faq')): ?>
<section class="faq-section" id="faq">
    <div class="container">
        <h2 class="resort-tab__title">Частые вопросы</h2>
        <div class="faq-accordion">
            <?php
            $faq_index = 0;
            while (have_rows('putevka_faq')): the_row();
                $question = get_sub_field('faq_question');
                $answer = get_sub_field('faq_answer');
                $faq_index++;
            ?>
            <div class="faq-accordion__item" style="margin-bottom: 10px; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
                <div class="faq-accordion__question"
                     style="padding: 15px 20px; background: #f5f5f5; cursor: pointer; font-weight: bold; display: flex; justify-content: space-between; align-items: center;"
                     onclick="toggleFaq(<?= $faq_index; ?>)">
                    <span><?= esc_html($question); ?></span>
                    <span class="faq-accordion__icon" style="font-size: 20px;">+</span>
                </div>
                <div id="faq-answer-<?= $faq_index; ?>" class="faq-accordion__answer"
                     style="display: none; padding: 20px; background: #fff;">
                    <?= wp_kses_post($answer); ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script>
var currentOpenFaq = null;

function toggleFaq(index) {
    var answer = document.getElementById('faq-answer-' + index);
    var question = document.querySelector('.faq-accordion__question[onclick*="' + index + '"]');
    var icon = question.querySelector('.faq-accordion__icon');

    // Закрываем предыдущий вопрос
    if (currentOpenFaq !== null && currentOpenFaq !== index) {
        var prevAnswer = document.getElementById('faq-answer-' + currentOpenFaq);
        var prevQuestion = document.querySelector('.faq-accordion__question[onclick*="' + currentOpenFaq + '"]');
        var prevIcon = prevQuestion.querySelector('.faq-accordion__icon');

        prevAnswer.classList.remove('open');
        prevAnswer.style.display = 'none';
        prevIcon.textContent = '+';
    }

    // Открываем/закрываем текущий вопрос
    if (!answer.classList.contains('open')) {
        // Закрываем все остальные (дополнительная проверка)
        var allAnswers = document.querySelectorAll('[id^="faq-answer-"]');
        var allIcons = document.querySelectorAll('.faq-accordion__icon');

        allAnswers.forEach(function(item) {
            item.classList.remove('open');
            item.style.display = 'none';
        });

        allIcons.forEach(function(item) {
            item.textContent = '+';
        });

        // Открываем текущий
        answer.classList.add('open');
        answer.style.display = 'block';
        icon.textContent = '−';
        currentOpenFaq = index;
    } else {
        // Закрываем текущий
        answer.classList.remove('open');
        answer.style.display = 'none';
        icon.textContent = '+';
        currentOpenFaq = null;
    }
}
</script>
<?php endif; ?>

    <!-- 14. Блок "Остались вопросы?" -->
    <section class="anchor"><span id="lead-form-question"></span></section>
        <section class="lead-form lead-form--tertiary lead-form--secondary lead-form--excursions">
            <div class="container lead-form__container">
                <div class="lead-form__left">
                    <h2 class="lead-form__title">У вас есть<br>вопросы?</h2>
                    <div class="lead-form__description">Напишите нам и мы ответим на любые вопросы<br>в ближайшее время
                    </div>
                </div>
                <? get_template_part('template-parts/components/lead-form', get_post_format(), array('id' => '537',)); ?>
            </div>
        </section>

</main>

<?php get_footer(); ?>