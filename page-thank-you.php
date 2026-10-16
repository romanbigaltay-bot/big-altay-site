<?php
/**
 * Template Name: Страница «Спасибо»
 * Description: Шаблон страницы благодарности за заявку туроператора «Большой Алтай»
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

// Определение страницы, на которой была заполнена форма (для хлебных крошек)
$source_title = '';
$source_url   = '';

// 1. Попытка определить страницу по Referer
$referrer = wp_get_referer();
if ($referrer) {
    $ref_path = wp_parse_url($referrer, PHP_URL_PATH);
    $current_path = wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

    if ($ref_path && $ref_path !== $current_path) {
        $source_id = url_to_postid($referrer);
        if ($source_id) {
            $source_title = get_the_title($source_id);
            $source_url   = get_permalink($source_id);
        }
    }
}

// 2. Если Referer не определен или заголовок пуст — контекстный фоллбэк по URL
if (empty($source_title)) {
    $uri = trim($_SERVER['REQUEST_URI'] ?? '', '/');
    if (strpos($uri, 'tours') !== false) {
        $source_title = 'Туры';
        $source_url   = home_url('/tours/');
    } elseif (strpos($uri, 'lechenie') !== false || strpos($uri, 'sanator') !== false) {
        $source_title = 'Лечение';
        $source_url   = home_url('/lechenie/');
    } elseif (strpos($uri, 'promotion') !== false || strpos($uri, 'promo') !== false) {
        $source_title = 'Акции';
        $source_url   = home_url('/promotions/');
    } elseif (strpos($uri, 'new-year') !== false) {
        $source_title = 'Новый год';
        $source_url   = home_url('/new-year/');
    } else {
        $source_title = 'Услуги и отдых';
        $source_url   = home_url('/');
    }
}
?>

<!-- Хлебные крошки (Главная -> Страница с формой -> Спасибо за заявку) -->
<section class="bads-section bads-section--sm u-bg-surface-subtle">
    <div class="bads-container bads-container--xl">
        <div class="bads-stack bads-stack--sm">
            <?php
            if (function_exists('get_template_part')) {
                get_template_part('template-parts/ui/breadcrumbs', null, [
                    'items' => [
                        ['label' => 'Главная', 'url' => home_url('/')],
                        ['label' => $source_title, 'url' => $source_url],
                        ['label' => 'Спасибо за заявку', 'current' => true],
                    ],
                ]);
            }
            ?>
        </div>
    </div>
</section>

<style>
.thank-you-page {
    min-height: calc(100vh - 220px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 20px;
}

.thank-you-card {
    width: 100%;
    max-width: 760px;

    background: #fff;

    border-radius: 32px;

    padding: 60px 50px;

    text-align: center;

    border: 2px solid rgba(1, 159, 222, .15);

    box-shadow:
        0 20px 60px rgba(0,0,0,.08);
}

.thank-you-icon {
    width: 110px;
    height: 110px;

    margin: 0 auto 30px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #019fde,
        #38bdf8
    );

    display: flex;
    align-items: center;
    justify-content: center;

    color: #fff;

    font-size: 52px;
    font-weight: 700;
}

.thank-you-title {
    margin: 0 0 20px;

    color: #111;

    font-size: 46px;
    font-weight: 700;
    line-height: 1.2;
}

.thank-you-text {
    max-width: 560px;

    margin: 0 auto 35px;

    color: rgba(0,0,0,.7);

    font-size: 20px;
    line-height: 1.7;
}

.thank-you-divider {
    width: 80px;
    height: 4px;

    margin: 0 auto 35px;

    border-radius: 999px;

    background: #D02457;
}

.thank-you-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    min-width: 280px;
    height: 60px;

    padding: 0 36px;

    border-radius: 40px;

    background: #D02457;

    color: #fff !important;

    text-decoration: none;
    font-size: 18px;
    font-weight: 600;

    transition: .25s ease;
}

.thank-you-btn:hover {
    background: #b11d4a;
    color: #fff !important;

    transform: translateY(-2px);
}

.thank-you-note {
    margin-top: 25px;

    color: rgba(0,0,0,.5);

    font-size: 14px;
}

@media (max-width: 768px) {

    .thank-you-page {
        min-height: calc(100vh - 160px);
        padding: 40px 16px;
    }

    .thank-you-card {
        padding: 40px 25px;
        border-radius: 24px;
    }

    .thank-you-icon {
        width: 90px;
        height: 90px;
        font-size: 42px;
    }

    .thank-you-title {
        font-size: 32px;
    }

    .thank-you-text {
        font-size: 17px;
    }

    .thank-you-btn {
        width: 100%;
        min-width: auto;
    }

}
</style>

<div class="thank-you-page">
    <div class="thank-you-card">
        <div class="thank-you-icon">
            ✓
        </div>

        <h1 class="thank-you-title">
            Спасибо за заявку!
        </h1>

        <div class="thank-you-divider"></div>

        <p class="thank-you-text">
            Мы получили ваше обращение и уже передали его специалисту.
            В ближайшее время с вами свяжется менеджер для уточнения деталей.
        </p>
    </div>
</div>

<?php
get_footer();