<?php
/**
 * ============================================================================
 * Big Altay
 * Page / New Year / Benefits
 * ============================================================================
 *
 * Блок преимуществ раннего планирования новогоднего отдыха.
 *
 * Архитектура:
 *
 * 1. BADS Title
 *    — заголовок
 *    — divider
 *    — subtitle
 *
 * 2. Benefits Grid
 *    — 4 преимущества
 *
 * 3. Local CSS
 *    — только стили этого компонента
 *
 * 4. Local JS
 *    — reveal-анимация карточек при появлении в viewport
 *
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$benefits = [

    [
        'number' => '01',
        'title'  => 'Больше времени для выбора',
        'text'   => 'Можно спокойно сравнить санатории, размещение и варианты отдыха и выбрать тот формат, который подходит именно вам.',
    ],

    [
        'number' => '02',
        'title'  => 'Планы без спешки',
        'text'   => 'Раннее решение позволяет заранее определиться с датами поездки и организовать новогодний отдых без суеты.',
    ],

    [
        'number' => '03',
        'title'  => 'Больше вариантов размещения',
        'text'   => 'Чем раньше начинается планирование, тем шире выбор доступных номеров и вариантов размещения на праздничные даты.',
    ],

    [
        'number' => '04',
        'title'  => 'Праздник начинается заранее',
        'text'   => 'Когда поездка запланирована заранее, остаётся время спокойно подготовиться и продумать отдых до мелочей.',
    ],

];

?>

<section
    class="bads-section bads-section--lg bads-new-year-benefits"
    aria-labelledby="new-year-benefits-title"
>

    <div class="bads-container">

        <div class="bads-new-year-benefits__header">

            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title'    => 'Почему стоит планировать Новый год заранее',
                    'subtitle' => 'Раннее планирование помогает выбрать подходящий вариант отдыха в Белокурихе спокойно и без лишней спешки.',
                    'level'    => 'h2',
                    'size'     => 'h2',
                    'divider'  => true,
                    'align'    => 'left',
                    'class'    => 'bads-new-year-benefits__title',
                ]
            );
            ?>

        </div>


        <div class="bads-new-year-benefits__grid">

            <?php foreach ($benefits as $index => $benefit) : ?>

                <article
                    class="bads-new-year-benefits__card"
                    data-benefit-index="<?= esc_attr($index); ?>"
                >

                    <div class="bads-new-year-benefits__card-top">

                        <span
                            class="bads-new-year-benefits__number"
                            aria-hidden="true"
                        >
                            <?= esc_html($benefit['number']); ?>
                        </span>

                        <span
                            class="bads-new-year-benefits__line"
                            aria-hidden="true"
                        ></span>

                    </div>


                    <div class="bads-new-year-benefits__content">

                        <h3 class="bads-new-year-benefits__card-title">
                            <?= esc_html($benefit['title']); ?>
                        </h3>

                        <p class="bads-new-year-benefits__card-text">
                            <?= esc_html($benefit['text']); ?>
                        </p>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<style>
/* ==========================================================================
   New Year / Benefits
   ========================================================================== */

.bads-new-year-benefits{
    position:relative;
}


/*
|--------------------------------------------------------------------------
| Header
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__header{
    max-width:820px;
    margin-bottom:56px;
}


/*
|--------------------------------------------------------------------------
| Grid
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__grid{
    display:grid;

    grid-template-columns:repeat(4,minmax(0,1fr));

    gap:16px;
}


/*
|--------------------------------------------------------------------------
| Card
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__card{

    position:relative;

    display:flex;
    flex-direction:column;

    min-height:280px;

    padding:28px;

    border:1px solid rgba(1,159,222,.12);
    border-radius:24px;

    background:var(--color-background);

    box-shadow:
        0 8px 24px rgba(20,40,60,.04);

    opacity:0;
    transform:translateY(28px);

    transition:
        opacity .7s ease,
        transform .7s cubic-bezier(.22,1,.36,1),
        box-shadow .3s ease,
        border-color .3s ease;

}


/*
|--------------------------------------------------------------------------
| Visible state
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__card.is-visible{
    opacity:1;
    transform:translateY(0);
}


/*
|--------------------------------------------------------------------------
| Hover
|--------------------------------------------------------------------------
*/

@media (hover:hover){

    .bads-new-year-benefits__card:hover{

        transform:translateY(-5px);

        border-color:rgba(1,159,222,.24);

        box-shadow:
            0 16px 38px rgba(20,40,60,.08);

    }

}


/*
|--------------------------------------------------------------------------
| Card top
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__card-top{

    display:flex;
    align-items:center;

    gap:14px;

    margin-bottom:32px;

}


/*
|--------------------------------------------------------------------------
| Number
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__number{

    display:flex;
    align-items:center;
    justify-content:center;

    width:44px;
    height:44px;

    flex:0 0 44px;

    border-radius:50%;

    background:rgba(1,159,222,.08);

    color:var(--color-primary);

    font-family:var(--font-family-base);

    font-size:13px;
    font-weight:600;

    line-height:1;

}


/*
|--------------------------------------------------------------------------
| Decorative line
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__line{

    display:block;

    width:100%;
    height:1px;

    background:
        linear-gradient(
            90deg,
            rgba(1,159,222,.22),
            rgba(1,159,222,0)
        );

}


/*
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__content{

    display:flex;
    flex-direction:column;

    gap:14px;

}


/*
|--------------------------------------------------------------------------
| Card title
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__card-title{

    margin:0;

    color:var(--color-text);

    font-family:var(--font-family-heading);

    font-size:var(--font-size-h4);

    font-weight:var(--font-weight-bold);

    line-height:1.2;

}


/*
|--------------------------------------------------------------------------
| Card text
|--------------------------------------------------------------------------
*/

.bads-new-year-benefits__card-text{

    margin:0;

    max-width:34ch;

    color:var(--color-text-muted);

    font-size:var(--font-size-body);

    line-height:var(--line-height-body);

}


/*
|--------------------------------------------------------------------------
| Tablet
|--------------------------------------------------------------------------
*/

@media (max-width:1199px){

    .bads-new-year-benefits__grid{
        grid-template-columns:repeat(2,minmax(0,1fr));
    }

}


/*
|--------------------------------------------------------------------------
| Mobile
|--------------------------------------------------------------------------
*/

@media (max-width:767px){

    .bads-new-year-benefits__header{
        margin-bottom:36px;
    }

    .bads-new-year-benefits__grid{
        grid-template-columns:1fr;

        gap:12px;
    }

    .bads-new-year-benefits__card{
        min-height:240px;

        padding:24px;
    }

    .bads-new-year-benefits__card-top{
        margin-bottom:28px;
    }

    .bads-new-year-benefits__card-title{
        font-size:var(--font-size-h5);
    }

}


/*
|--------------------------------------------------------------------------
| Reduced motion
|--------------------------------------------------------------------------
*/

@media (prefers-reduced-motion:reduce){

    .bads-new-year-benefits__card{

        opacity:1;
        transform:none;

        transition:none;

    }

    .bads-new-year-benefits__card.is-visible{
        transform:none;
    }

}
</style>


<script>
(function () {

    /*
    |--------------------------------------------------------------------------
    | Respect reduced motion
    |--------------------------------------------------------------------------
    */

    if (
        window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches
    ) {
        document
            .querySelectorAll('.bads-new-year-benefits__card')
            .forEach(function (card) {
                card.classList.add('is-visible');
            });

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Cards
    |--------------------------------------------------------------------------
    */

    const cards = document.querySelectorAll(
        '.bads-new-year-benefits__card'
    );

    if (!cards.length) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Intersection Observer
    |--------------------------------------------------------------------------
    */

    if (!('IntersectionObserver' in window)) {

        cards.forEach(function (card) {
            card.classList.add('is-visible');
        });

        return;
    }


    const observer = new IntersectionObserver(
        function (entries, observerInstance) {

            entries.forEach(function (entry) {

                if (!entry.isIntersecting) {
                    return;
                }

                const card = entry.target;
                const index = Number(card.dataset.benefitIndex || 0);

                card.style.transitionDelay = (index * 100) + 'ms';

                card.classList.add('is-visible');

                observerInstance.unobserve(card);

            });

        },
        {
            threshold:0.15,
            rootMargin:'0px 0px -40px 0px'
        }
    );


    cards.forEach(function (card) {
        observer.observe(card);
    });

})();
</script>