
<?php get_header();
// Template Name: Тест
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/css/swiper-bundle.min.css" />
<style>
    .swiper {
        width: 100%;
        height: 493px;
        border-radius: 30px;
        margin-bottom: 120px;

        background: rgba(248, 245, 240, 0.12);
        border: 1px solid #F3E7E7;
        border-radius: 30px;
    }

    .swiper-slide {
        text-align: center;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 30px;
        padding: 12px;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 30px;
    }
</style>
<style>
    h1 {
        font-size: 45px !important;
        line-height: 1.2 !important;
    }

    h2 {
        font-family: 'Tenor Sans';
        font-style: normal;
        font-weight: 400;
        font-size: 45px !important;
        line-height: 60px;
        color: #000000;
        margin-bottom: 20px;
    }

    .bluep {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 700;
        font-size: 23px;
        line-height: 28px;
        color: #00A1E3;
        margin-bottom: 15px;
    }

    .rs {
        background: #FFFFFF;
        border: 1px solid #00A0E3;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 22px;
        color: #000000;
        padding: 21px;
        margin-bottom: 15px;
    }

    .advantages_tour {
        display: grid;
        grid-template-columns: 60% 38%;
        gap: 10px 20px;
        margin-bottom: 120px;
    }

    .advantages_tour p {
        background: #FFFFFF;
        border: 1px solid #00A0E3;
        border-radius: 20px;
        display: flex;
        justify-content: start;
        align-items: center;
        padding: 20px;
        font-size: 14px;
    }

    .tour-sale {
        width: 83%;
        margin-bottom: 120px;
    }

    .tour-sale p {
        background: #FFFFFF;
        border: 1px solid #C6CCD6;
        border-radius: 18px;
        height: 100%;
        display: flex;
        justify-content: start;
        align-items: center;
        padding: 20px;
    }

    .tour-sale p span {
        color: #00A0E3;
        margin-left: 3px;
        margin-right: 3px;
        font-weight: 600;
    }

    .tour-sale-block {
        padding: 23px 17px;
        border-top: 1px solid #C6CCD6;
        border-bottom: 1px solid #C6CCD6;
        border-left: 1px solid #C6CCD6;
        border-radius: 20px;

        position: relative;
    }

    .tour-sale-block p {
        border: none;
        padding: 0;
        line-height: 1.2;
        height: 100%;
        margin-bottom: 10px;
        display: block;
    }

    .tour-sale-block-img {
        border-left: 1px solid #C6CCD6;
        border-right: 1px solid #C6CCD6;
        border-radius: 0 20px 20px 0;
        width: 250px;
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        display: inline-flex;
        justify-content: center;
        align-items: center;
    }

    @media screen and (max-width: 500px) {
        h1 {
            font-size: 20px !important;
            line-height: 1.2 !important;
        }

        h2 {
            font-size: 20px !important;
            line-height: 1.2 !important;
        }

        .bluep {
            font-size: 16px;
            line-height: 1.2;
            border-radius: 15px;
        }

        .rs {
            font-size: 14px;
            line-height: 22px;
        }

        .swiper {
            width: 100%;
            height: 200px;
            margin-bottom: 40px;

            border: 1px solid #F3E7E7;
            border-radius: 15px;
        }

        .swiper-slide {
            padding: 5px;
            border-radius: 15px;
        }

        .swiper-slide img {
            border-radius: 15px;
        }

        .advantages_tour {
            grid-template-columns: 100%;
            gap: 10px 20px;
            margin-bottom: 40px;
        }

        .advantages_tour p {
            border-radius: 10px;
            height: 100%;
            padding: 10px;
        }

        .tour-sale {
            width: 100%;
            margin-bottom: 40px;
        }

        .tour-sale p {
            background: #FFFFFF;
            border: 1px solid #C6CCD6;
            border-radius: 10px;
            height: 100%;
            display: flex;
            justify-content: start;
            align-items: center;
            padding: 20px;
            line-height: 1.2;
            display: block;
        }

        .tour-sale p span {
            color: #00A0E3;
            margin-left: 3px;
            margin-right: 3px;
            font-weight: 600;
            line-height: 1.2;
            font-size: 14px;
        }

        .tour-sale-block {
            padding: 23px 17px;
            border-top: 1px solid #C6CCD6;
            border-bottom: 1px solid #C6CCD6;
            border-left: 1px solid #C6CCD6;
            border-right: 1px solid #C6CCD6;
            border-radius: 10px;

            position: relative;
        }

        .tour-sale-block p {
            border: none;
            padding: 0;
            line-height: 1.2;
            height: 100%;
            margin-bottom: 10px;
            display: block;
            font-size: 14px;
        }

        .tour-sale-block-img {
            display: none;
        }

    }

    @media screen and (min-width: 500px) and (max-width: 1024px) {
        .tour-sale-block-img {
            display: none;
        }

        .tour-sale-block {
            border-top: 1px solid #C6CCD6;
            border-bottom: 1px solid #C6CCD6;
            border-left: 1px solid #C6CCD6;
            border-right: 1px solid #C6CCD6;
        }

        .tour-sale {
            width: 100%;
        }

        .tour-sale p {
            display: block;
            line-height: 1.2;
            height: 100%;
        }
    }
</style>
<style>
    h1 {
        margin-bottom: 15px;
    }

    .table-wrap {
        text-align: center;
        display: inline-block;
        background-color: #fff;
        color: #000;
    }

    table {
        border: 1px solid #ccc;
        width: 100%;
        margin: 0;
        padding: 0;
        border-collapse: collapse;
        border-spacing: 0;
    }

    table tr {
        border: 1px solid #ddd;
        padding: 5px;
    }

    table th,
    table td {
        padding: 10px;
        text-align: center;
        border-right: 1px solid #ddd;
    }

    table th {
        color: #fff;
        background-color: #0CA4E4;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }


    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table thead {
            display: none;
        }

        table tr {
            margin-bottom: 10px;
            display: block;
            border-bottom: 2px solid #ddd;
        }

        table td {
            display: block;
            text-align: right;
            font-size: 13px;
            border-bottom: 1px dotted #ccc;
            border-right: 1px solid transparent;
        }

        table td:last-child {
            border-bottom: 0;
        }

        table td:before {
            content: attr(data-label);
            float: left;
            text-transform: uppercase;
            font-weight: bold;
        }
    }




    .item-a {
        font-size: 24px;
        margin-bottom: 15px;
        display: inline-flex;
    }

    .row-container {
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        margin-bottom: 35px;
    }

    .row-container p {
        padding: 5px 10px;

    }

    .row-container p span {
        color: grey;
    }

    @media screen and (max-width: 486px) {
        .item-a {
            font-size: 20px;
            margin-top: 15px;
        }
    }
</style>
<div class="container">
    <h1 class="headline-primary__headline"><?php the_field('zagolovok'); ?></h1>
    <p class="bluep"><?php the_field('tekst_v_obvodke_pod_zagolovkom') ?></p>

    <div class="rs">
        <?php the_field('bigdescribe'); ?>
    </div>

    <?php if (have_rows('slajder')): ?>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php while (have_rows('slajder')): the_row(); ?>
                    <div class="swiper-slide"><img src="<?php the_sub_field('kartinka'); ?>" title="Фото курорта" alt="Фото курорта"></div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <h2><?php the_field('zagolovok_vtorogo_bloka'); ?></h2>

    <?php if (have_rows('nadpisi_v_obvodke_mnogo_shtuk')): ?>
        <div class="advantages_tour">
            <?php while (have_rows('nadpisi_v_obvodke_mnogo_shtuk')): the_row(); ?>
                <p><?php the_sub_field('tekst'); ?></p>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <h2><?php the_field('zagolovok_3_bloka'); ?></h2>

    <div class="tour-sale">
        <p><?php the_field('pervaya_podpis_odinochnaya'); ?></p>

        <?php if (have_rows('blok_podpisej')): ?>
            <div class="tour-sale-block">
                <?php while (have_rows('blok_podpisej')): the_row(); ?>
                    <p><?php the_sub_field('tekst'); ?></p>
                <?php endwhile; ?>
                <div class="tour-sale-block-img">
                    <img src="<?php echo get_template_directory_uri() ?>/img/Frame41.svg" alt="">
                </div>
            </div>
            <span style="display: inline-flex; font-style: italic; margin-top: 10px; margin-left: 20px">Администрация оставляет за собой право прекратить акцию досрочно.</span>
        <?php endif; ?>

    </div>







<?php
$args = array(
    'post_type' => array('rest-altai-mountains', 'sanatorium', 'rest-belokurikha'),
    'posts_per_page' => -1
);

$pages = get_posts($args);

// Флаг для проверки наличия хотя бы одной таблицы
$has_any_table = false;

// Сначала проходим по всем страницам, чтобы проверить наличие таблиц
foreach ($pages as $page) {
    if (have_rows('dobavit_akcziyu', $page->ID)) :
        while (have_rows('dobavit_akcziyu', $page->ID)) : the_row();
            $date_field = get_sub_field('data_zaezda1');
            $show_table = get_sub_field('vklyuchit_tabliczu_na_stranicze_akczii');

            if (!empty($date_field) && $show_table) {
                $has_any_table = true;
                break 2; // Выходим из обоих циклов, если нашли хотя бы одну таблицу
            }
        endwhile;
    endif;
}

// Сбрасываем данные пост-полей после первой проверки
reset_rows();

// Выводим заголовок только если есть хотя бы одна таблица
if ($has_any_table) : ?>
    <h2><?php the_field('zagolovok_akcii', 'option');?></h2>
<?php endif; ?>

<?php
// Теперь основной вывод таблиц
foreach ($pages as $page) {
    $has_valid_rows = false;
    $table_rows = array();

    if (have_rows('dobavit_akcziyu', $page->ID)) :
        while (have_rows('dobavit_akcziyu', $page->ID)) : the_row();
            $date_field = get_sub_field('data_zaezda1');
            $show_table = get_sub_field('vklyuchit_tabliczu_na_stranicze_akczii');

            if (!empty($date_field) && $show_table) {
                $has_valid_rows = true;
                $table_rows[] = array(
                    'date' => $date_field,
                    'duration' => get_sub_field('srok_prebyvaniya1'),
                    'category' => get_sub_field('kategoriya_nomera1'),
                    'tour' => get_sub_field('putevka1'),
                    'price' => get_sub_field('stoimost_rub1'),
                    'discount_price' => get_sub_field('stoimost_s_rub1'),
                    'benefit' => get_sub_field('vygoda1')
                );
            }
        endwhile;
    endif;

    if ($has_valid_rows) : ?>
        <div class="row-container">
            <span><?php echo "<a class='item-a' href=" . get_permalink($page->ID) . ">" . get_the_title($page->ID) . "</a> "; ?></span>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Дата заезда</th>
                            <th>Срок пребывания</th>
                            <th>Категория номера</th>
                            <th>Путевка</th>
                            <th>Стоимость</th>
                            <th>Стоимость со скидкой</th>
                            <th>Выгода</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($table_rows as $row) : ?>
                            <tr>
                                <td data-label="Дата заезда"><?php echo $row['date']; ?></td>
                                <td data-label="Срок пребывания"><?php echo $row['duration']; ?></td>
                                <td data-label="Категория номера"><?php echo $row['category']; ?></td>
                                <td data-label="Путевка"><?php echo $row['tour']; ?></td>
                                <td data-label="Стоимость"><?php echo $row['price']; ?> </td>
                                <td data-label="Стоимость со скидкой"><?php echo $row['discount_price']; ?> </td>
                                <td data-label="Выгода"><?php echo $row['benefit']; ?></td>
                                <td data-label=""><a href="#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjM1MTQiLCJ0b2dnbGUiOmZhbHNlfQ%3D%3D" class="btn resort-header-btn animated-button">Заказать</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif;
}
?>
</div>
<?php echo do_shortcode('[elementor-template id="3514"]') ?>



<!-- Swiper JS -->
<script src="<?php echo get_template_directory_uri()?>/js/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
    });
</script>
<?php get_footer(); ?>