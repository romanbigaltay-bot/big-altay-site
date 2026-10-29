<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template / Page / Corporate Rest ("page-corp")
 * ============================================================================
 *
 * Страница «Корпоративный отдых». Шаблон — тонкая композиция BADS-блоков:
 *
 * 1. Hero          — хлебные крошки, бейдж, заголовок, CTA, промо-изображение
 * 2. Possibilities — сетка направлений («что мы проводим»)
 * 3. Advantages    — чередующиеся split-блоки (repeater corp_advantages)
 * 4. Accommodation — «Проживание»: описание + слайдер галереи
 * 5. Features      — те же split-блоки (repeater corp_features)
 * 6. Lead Form     — контакты + BADS-форма заявки (AJAX → Bitrix24)
 * 7. Reviews       — слайдер отзывов (ACF-группа главной страницы, id 139)
 *
 * Контент редактируется через ACF без изменения кода.
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main>

    <?php get_template_part('template-parts/pages/corp/hero/hero'); ?>

    <?php get_template_part('template-parts/pages/corp/possibilities/possibilities'); ?>

    <?php
    get_template_part(
        'template-parts/pages/corp/advantages/advantages',
        null,
        ['repeater' => 'corp_advantages']
    );
    ?>

    <?php get_template_part('template-parts/pages/corp/accommodation/accommodation'); ?>

    <?php
    get_template_part(
        'template-parts/pages/corp/advantages/advantages',
        null,
        ['repeater' => 'corp_features']
    );
    ?>

    <?php get_template_part('template-parts/pages/corp/lead-form/lead-form'); ?>

    <?php get_template_part('template-parts/pages/corp/reviews/reviews'); ?>

</main>

<?php
get_footer();