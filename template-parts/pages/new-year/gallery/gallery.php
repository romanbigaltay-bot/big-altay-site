<?php
/**
 * ============================================================================
 * Big Altay
 * Page / New Year / Atmosphere / Gallery
 * ============================================================================
 *
 * Галерея зимней Белокурихи для страницы Нового года.
 *
 * Использует:
 * - BADS Section
 * - BADS Container
 * - BADS Title
 * - BADS Gallery Layout
 *
 * Изображения заданы напрямую URL, так как BADS Media в текущем API
 * принимает attachment ID или ACF image array.
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$gallery = [

    [
        'url'  => 'https://big-altay.ru/wp-content/uploads/2026/08/g-01.jpg',
        'alt'  => 'Зимняя Белокуриха',
        'class' => 'bads-gallery__item--2x2',
    ],

    [
        'url'  => 'https://big-altay.ru/wp-content/uploads/2026/08/g-02.jpg',
        'alt'  => 'Зимняя природа Белокурихи',
        'class' => 'bads-gallery__item--1x1',
    ],

    [
        'url'  => 'https://big-altay.ru/wp-content/uploads/2026/08/g-03.jpg',
        'alt'  => 'Новогодняя Белокуриха',
        'class' => 'bads-gallery__item--1x1',
    ],

    [
        'url'  => 'https://big-altay.ru/wp-content/uploads/2026/08/g-04.jpg',
        'alt'  => 'Зимний отдых в Белокурихе',
        'class' => 'bads-gallery__item--1x2',
    ],

    [
        'url'  => 'https://big-altay.ru/wp-content/uploads/2026/08/g-05.jpg',
        'alt'  => 'Зимний Алтай',
        'class' => 'bads-gallery__item--2x1',
    ],

];

?>

<section
    class="bads-section bads-section--lg bads-new-year-gallery"
    aria-labelledby="new-year-gallery-title"
>

    <div class="bads-container">

        <div class="bads-new-year-gallery__header">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title'    => 'Зима, которую хочется запомнить',
                    'subtitle' => 'Белокуриха зимой — это заснеженные горы, чистый воздух и особенная атмосфера новогоднего отдыха на Алтае.',
                    'level'    => 'h2',
                    'size'     => 'h2',
                    'divider'  => true,
                    'align'    => 'left',
                    'class'    => 'bads-new-year-gallery__title',
                ]
            );
            ?>

        </div>


        <div class="bads-gallery bads-new-year-gallery__grid">

            <?php foreach ($gallery as $index => $item) : ?>

                <figure
                    class="
                        bads-gallery__item
                        <?= esc_attr($item['class']); ?>
                        bads-new-year-gallery__item
                    "
                    data-gallery-index="<?= esc_attr($index); ?>"
                >

                    <img
                        class="bads-new-year-gallery__image"
                        src="<?= esc_url($item['url']); ?>"
                        alt="<?= esc_attr($item['alt']); ?>"
                        loading="<?= $index === 0 ? 'eager' : 'lazy'; ?>"
                    >

                    <span
                        class="bads-new-year-gallery__overlay"
                        aria-hidden="true"
                    ></span>

                </figure>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<style>
/* ==========================================================================
   New Year / Gallery
   ========================================================================== */

.bads-new-year-gallery{
    position:relative;
}


/*
|--------------------------------------------------------------------------
| Header
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__header{
    max-width:820px;
    margin-bottom:56px;
}


/*
|--------------------------------------------------------------------------
| Gallery
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__grid{
    margin-bottom:0;
}


/*
|--------------------------------------------------------------------------
| Item
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__item{

    position:relative;

    border-radius:24px;

    background:#eef2f4;

    opacity:0;
    transform:translateY(28px);

    box-shadow:
        0 8px 24px rgba(20,40,60,.04);

    transition:
        opacity .7s ease,
        transform .7s cubic-bezier(.22,1,.36,1),
        box-shadow .35s ease;

}


/*
|--------------------------------------------------------------------------
| Visible
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__item.is-visible{
    opacity:1;
    transform:translateY(0);
}


/*
|--------------------------------------------------------------------------
| Image
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__image{

    position:relative;
    z-index:1;

    border-radius:24px;

    transition:
        transform .8s cubic-bezier(.22,1,.36,1);

}


/*
|--------------------------------------------------------------------------
| Overlay
|--------------------------------------------------------------------------
*/

.bads-new-year-gallery__overlay{

    position:absolute;
    inset:0;

    z-index:2;

    pointer-events:none;

    border-radius:24px;

    background:
        linear-gradient(
            180deg,
            rgba(0,0,0,0) 55%,
            rgba(0,0,0,.10) 100%
        );

    opacity:0;

    transition:
        opacity .35s ease;

}


/*
|--------------------------------------------------------------------------
| Hover
|--------------------------------------------------------------------------
*/

@media (hover:hover){

    .bads-new-year-gallery__item:hover{

        box-shadow:
            0 18px 42px rgba(20,40,60,.12);

    }

    .bads-new-year-gallery__item:hover
    .bads-new-year-gallery__image{

        transform:scale(1.035);

    }

    .bads-new-year-gallery__item:hover
    .bads-new-year-gallery__overlay{

        opacity:1;

    }

}


/*
|--------------------------------------------------------------------------
| Tablet
|--------------------------------------------------------------------------
*/

@media (max-width:992px){

    .bads-new-year-gallery__header{
        margin-bottom:44px;
    }

}


/*
|--------------------------------------------------------------------------
| Mobile
|--------------------------------------------------------------------------
*/

@media (max-width:576px){

    .bads-new-year-gallery__header{
        margin-bottom:36px;
    }

    .bads-new-year-gallery__item{
        border-radius:20px;
    }

    .bads-new-year-gallery__image{
        border-radius:20px;
    }

    .bads-new-year-gallery__overlay{
        border-radius:20px;
    }

}


/*
|--------------------------------------------------------------------------
| Reduced motion
|--------------------------------------------------------------------------
*/

@media (prefers-reduced-motion:reduce){

    .bads-new-year-gallery__item{

        opacity:1;
        transform:none;

        transition:none;

    }

    .bads-new-year-gallery__image{
        transition:none;
    }

}
</style>


<script>
(function () {

    /*
    |--------------------------------------------------------------------------
    | Reduced motion
    |--------------------------------------------------------------------------
    */

    if (
        window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        document
            .querySelectorAll('.bads-new-year-gallery__item')
            .forEach(function (item) {
                item.classList.add('is-visible');
            });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Items
    |--------------------------------------------------------------------------
    */

    const items = document.querySelectorAll(
        '.bads-new-year-gallery__item'
    );

    if (!items.length) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Fallback
    |--------------------------------------------------------------------------
    */

    if (!('IntersectionObserver' in window)) {

        items.forEach(function (item) {
            item.classList.add('is-visible');
        });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Observer
    |--------------------------------------------------------------------------
    */

    const observer = new IntersectionObserver(
        function (entries, observerInstance) {

            entries.forEach(function (entry) {

                if (!entry.isIntersecting) {
                    return;
                }

                const item = entry.target;

                const index = Number(
                    item.dataset.galleryIndex || 0
                );

                item.style.transitionDelay =
                    (index * 100) + 'ms';

                item.classList.add('is-visible');

                observerInstance.unobserve(item);

            });

        },
        {
            threshold:0.12,
            rootMargin:'0px 0px -40px 0px'
        }
    );


    items.forEach(function (item) {
        observer.observe(item);
    });

})();
</script>