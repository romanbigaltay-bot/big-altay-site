<?php
/**
 * Страница «Трансфер в Белокуриху».
 *
 * Маршруты:
 * - Новосибирск → Белокуриха
 * - Барнаул → Белокуриха
 * - Бийск → Белокуриха
 * - Горно-Алтайск → Белокуриха
 */

get_header();

$pageTitle = get_the_title();
$themeUri  = get_template_directory_uri();

/**
 * Формирует URL изображения из любого стандартного формата ACF:
 * Image ID, Image Array или Image URL.
 */
$getImageUrl = static function ($image, $size = 'large') {
    if (is_array($image)) {
        $imageId = $image['ID'] ?? $image['id'] ?? null;

        if ($imageId) {
            $image = $imageId;
        } else {
            $image = $image['url'] ?? '';
        }
    }

    if (is_numeric($image) && (int) $image > 0) {
        return wp_get_attachment_image_url((int) $image, $size) ?: '';
    }

    if (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
        return $image;
    }

    return '';
};

/**
 * Общая конечная точка всех маршрутов — Белокуриха.
 *
 * Значение ruri взято из предоставленных ссылок Яндекс Карт.
 */
$destinationRuri = 'ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzEwNTMyMxI_0KDQvtGB0YHQuNGPLCDQkNC70YLQsNC50YHQutC40Lkg0LrRgNCw0LksINCR0LXQu9C-0LrRg9GA0LjRhdCwIgoNZ_apQhUp-09C';

/**
 * Конфигурация четырёх направлений.
 *
 * center — центр карты;
 * from   — координаты начальной точки;
 * origin — идентификатор начальной точки Яндекса;
 * zoom   — масштаб карты;
 * field  — ACF-поле с описанием маршрута.
 */
$transferRoutes = [
    'nsk' => [
        'label'  => 'Из Новосибирска',
        'field'  => 'transfer_nsk',
        'center' => '84.076831%2C53.540027',
        'from'   => '55.030204%2C82.920430',
        'origin' => 'ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzExODA1OBIk0KDQvtGB0YHQuNGPLCDQndC-0LLQvtGB0LjQsdC40YDRgdC6IgoNQ9elQhXtHlxC',
        'zoom'   => '7.83',
    ],

    'barnaul' => [
        'label'  => 'Из Барнаула',
        'field'  => 'transfer_barnaul',
        'center' => '84.504820%2C52.693842',
        'from'   => '53.346785%2C83.776856',
        'origin' => 'ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzExNzk1MBI50KDQvtGB0YHQuNGPLCDQkNC70YLQsNC50YHQutC40Lkg0LrRgNCw0LksINCR0LDRgNC90LDRg9C7IgoNwY2nQhUcY1VC',
        'zoom'   => '8.99',
    ],

    'biysk' => [
        'label'  => 'Из Бийска',
        'field'  => 'transfer_biysk',
        'center' => '85.107362%2C52.269499',
        'from'   => '52.541811%2C85.220656',
        'origin' => 'ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzEwNjkzMBI10KDQvtGB0YHQuNGPLCDQkNC70YLQsNC50YHQutC40Lkg0LrRgNCw0LksINCR0LjQudGB0LoiCg35cKpCFdAqUkI%2C',
        'zoom'   => '10.35',
    ],

    'altay' => [
        'label'  => 'Из Горно-Алтайска',
        'field'  => 'transfer_altay',
        'center' => '85.470703%2C52.077145',
        'from'   => '51.957804%2C85.960634',
        'origin' => 'ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgg1MzExNTcxNxJI0KDQvtGB0YHQuNGPLCDQoNC10YHQv9GD0LHQu9C40LrQsCDQkNC70YLQsNC5LCDQk9C-0YDQvdC-LdCQ0LvRgtCw0LnRgdC6IgoN2OurQhXL1E9C',
        'zoom'   => '10.97',
    ],
];

/**
 * Формируем адреса карт автоматически.
 *
 * Один набор параметров используется как для iframe,
 * так и для ссылки на открытие маршрута на Яндекс Картах.
 */
foreach ($transferRoutes as $key => $route) {
    $query = 'll=' . $route['center']
        . '&mode=routes'
        . '&rtext=' . $route['from'] . '~51.995273%2C84.981255'
        . '&rtt=auto'
        . '&ruri=' . $route['origin'] . '~' . $destinationRuri
        . '&z=' . $route['zoom'];

    $transferRoutes[$key]['map_url'] =
        'https://yandex.ru/map-widget/v1/?' . $query;

    $transferRoutes[$key]['route_url'] =
        'https://yandex.ru/maps/?' . $query;
}

/**
 * Промоизображение.
 */
$imagePreviewUrl = $getImageUrl(
    get_field('transfer_promo'),
    'header'
);
?>

<main>

    <!-- Хлебные крошки -->
    <section class="breadcrumbs">
        <div class="container breadcrumbs__container">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item">
                    <a href="/" class="breadcrumbs__link">Главная</a>
                </li>

                <li class="breadcrumbs__item">
                    <?php echo esc_html($pageTitle); ?>
                </li>
            </ul>
        </div>
    </section>


    <!-- Первый экран -->
    <section class="headline-promo">
        <div class="container">
            <h1 class="headline-promo__headline">
                Трансфер в Белокуриху с<br>комфортом

                <a
                    href="#lead-form"
                    class="btn headline-promo-btn animated-button"
                >
                    Заказать

                    <span class="headline-promo-btn__icon">
                        <img
                            src="<?php echo esc_url($themeUri . '/img/other/right-arrow.svg'); ?>"
                            alt=""
                            aria-hidden="true"
                        >
                    </span>
                </a>
            </h1>
        </div>
    </section>


    <!-- Промоизображение -->
    <?php if ($imagePreviewUrl) : ?>
        <section class="courses-promo pensioners-promo resort-promo">
            <div class="container resort-promo__container">
                <div class="resort-promo__wrapper">
                    <div class="resort-promo__image">
                        <img
                            src="<?php echo esc_url($imagePreviewUrl); ?>"
                            alt="<?php echo esc_attr($pageTitle); ?>"
                            class="resort-promo__img"
                            style="object-position: 21%;"
                            loading="lazy"
                        >
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- Маршруты трансфера -->
    <section class="transfer-tabs">
        <div class="container">

            <!-- Переключение направлений -->
            <div class="transfer-tabs__header">

                <?php foreach ($transferRoutes as $key => $route) : ?>
                    <div
                        class="transfer-tabs__item<?php echo $key === 'nsk' ? ' is-active' : ''; ?>"
                        data=".<?php echo esc_attr($key); ?>"
                    >
                        <?php echo esc_html($route['label']); ?>
                    </div>
                <?php endforeach; ?>

            </div>


            <!-- Содержимое вкладок -->
            <div class="transfer-tabs__wrapper">

                <?php foreach ($transferRoutes as $key => $route) : ?>

                    <div
                        class="transfer-tab <?php echo esc_attr($key); ?>"
                        <?php echo $key !== 'nsk' ? 'style="display: none;"' : ''; ?>
                    >

                        <!-- Описание направления из ACF -->
                        <div class="transfer-tab__info">
                            <?php
                            echo wp_kses_post(
                                get_field($route['field']) ?: ''
                            );
                            ?>
                        </div>


                        <!-- Яндекс Карты -->
                        <div class="transfer-tab__map">
                            <div style="position: relative; overflow: hidden;">

                                <a
                                    href="https://yandex.ru/maps?utm_medium=mapframe&amp;utm_source=maps"
                                    style="color: #eee; font-size: 12px; position: absolute; top: 0;"
                                >
                                    Яндекс Карты
                                </a>

                                <a
                                    href="<?php echo esc_url($route['route_url']); ?>"
                                    style="color: #eee; font-size: 12px; position: absolute; top: 14px;"
                                >
                                    <?php echo esc_html($route['label']); ?>
                                    — маршрут до Белокурихи
                                </a>

                                <iframe
                                    src="<?php echo esc_url($route['map_url']); ?>"
                                    width="100%"
                                    height="368"
                                    frameborder="0"
                                    allowfullscreen="true"
                                    loading="lazy"
                                    title="<?php echo esc_attr($route['label'] . ' — маршрут до Белокурихи'); ?>"
                                    style="position: relative; border: 0;"
                                ></iframe>

                            </div>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </section>


    <!-- Преимущества трансфера из ACF Repeater -->
    <?php if (have_rows('transfer_cards')) : ?>
        <section class="corp-features">
            <div class="container corp-features__container">
                <div class="corp-features__list">

                    <?php while (have_rows('transfer_cards')) : the_row(); ?>

                        <?php
                        $cardTitle = get_sub_field('transfer_cards-title');

                        $cardDescription = get_sub_field(
                            'transfer_cards-description'
                        );

                        $cardImageUrl = $getImageUrl(
                            get_sub_field('transfer_cards-image'),
                            'large'
                        );
                        ?>

                        <div class="corp-features__item">

                            <div class="corp-features__text">
                                <section class="headline-primary">
                                    <h2 class="headline-primary__headline">
                                        <?php echo esc_html($cardTitle ?: ''); ?>
                                    </h2>
                                </section>

                                <div class="corp-features__description">
                                    <?php
                                    echo wp_kses_post(
                                        $cardDescription ?: ''
                                    );
                                    ?>
                                </div>
                            </div>

                            <?php if ($cardImageUrl) : ?>
                                <div class="corp-features__image">
                                    <img
                                        src="<?php echo esc_url($cardImageUrl); ?>"
                                        alt="<?php echo esc_attr($cardTitle ?: ''); ?>"
                                        class="corp-features__img"
                                        loading="lazy"
                                    >
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php endwhile; ?>

                </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- Форма бронирования -->
    <section
        id="lead-form"
        class="lead-form lead-form--secondary lead-form--excursions mb-0"
    >
        <div class="container lead-form__container">

            <div class="lead-form__left">
                <h2 class="lead-form__title">
                    Бронирование<br>трансфера
                </h2>

                <div class="lead-form__description">
                    Оставьте заявку, и мы свяжемся с вами в ближайшее время.
                </div>
            </div>

            <?php
            get_template_part(
                'template-parts/components/lead-form',
                get_post_format(),
                [
                    'id' => '537',
                ]
            );
            ?>

        </div>
    </section>

</main>

<?php get_footer(); ?>