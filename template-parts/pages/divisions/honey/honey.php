<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page / Division 2: Siberian Honey Center
 * Path: template-parts/pages/divisions/honey/honey.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$honey_gallery = [
    [
        'url' => 'https://big-altay.ru/wp-content/uploads/2026/08/img_6072-scaled-1-1800x1000.jpg',
        'alt' => 'Дегустационный зал Центра сибирского меда Белокуриха',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_6096-1024x683.jpg',
        'alt' => 'Свежий алтайский мёд в сотах',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_6076-1024x683.jpg',
        'alt' => 'Коллекция сортов натурального алтайского мёда',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_6104-1024x683.jpg',
        'alt' => 'Чаепитие из самовара и дегустация мёда',
    ],
];

$slides = [];
foreach ($honey_gallery as $img) {
    ob_start();
    ?>
    <div class="bads-frame" style="width: 100%; aspect-ratio: 920 / 390; border-radius: var(--radius-xl); overflow: hidden; background: rgba(var(--brand-primary-rgb), 0.05);">
        <img
            src="<?= esc_url($img['url']); ?>"
            alt="<?= esc_attr($img['alt']); ?>"
            style="width: 100%; height: 100%; object-fit: cover; display: block;"
            loading="lazy"
        >
    </div>
    <?php
    $slides[] = ob_get_clean();
}
?>

<section class="bads-section bads-section--lg bads-divisions-item" id="honey" style="scroll-margin-top: 80px;">
    <div class="bads-stack bads-stack--lg">

        <!-- Заголовок, дивидер, сабтайтл -->
        <div class="bads-stack bads-stack--xs">
            <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.08em; font-size: 0.8125rem; color: var(--color-primary);">
                Гастрономия &amp; Пасечные традиции
            </span>

            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'           => 'Центр сибирского мёда',
                'level'           => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
                'divider_width'   => '72px',
                'subtitle'        => 'Подлинное «Алтайское золото» с собственных пасек, дегустационный дом и травяной чай из самовара.',
            ]);
            ?>
        </div>

        <!-- Слайдер баннеров 920x390 ниже заголовка и сабтайтла -->
        <div class="bads-divisions-banner">
            <?php
            get_template_part('template-parts/components/slider/slider', null, [
                'id'             => 'slider-honey',
                'class'          => 'bads-slider--banner',
                'slides'         => $slides,
                'arrows'         => true,
                'pagination'     => true,
                'loop'           => true,
                'autoplay'       => false,
                'controls_align' => 'center',
                'aria_label'     => 'Фотографии Центра сибирского мёда',
            ]);
            ?>
        </div>

        <!-- Основной контент: каждая карточка во всю ширину -->
        <div class="bads-stack bads-stack--lg">
            
            <p class="u-text-muted" style="font-size: 1.125rem; line-height: 1.65; margin: 0;">
                Открытие Центра сибирского мёда на Объездной улице в Белокурихе стало долгожданным событием для ценителей подлинного природного продукта. Холдинг «Большой Алтай» объединил здесь урожай с собственных предгорных пасек и диких медоносов сибирской тайги, создав уютное дегустационное пространство с горячим травяным чаем из самовара.
            </p>

            <!-- Отзыв гостя: простое аккуратное оформление без стеклянного эффекта -->
            <div class="bads-card bads-card--bordered bads-card--padding-lg bads-card--radius-lg" style="border-left: 4px solid var(--color-primary); background: rgba(var(--brand-primary-rgb), 0.02);">
                <div class="bads-stack bads-stack--sm">
                    <p style="font-size: 1.0625rem; line-height: 1.65; font-style: italic; margin: 0; color: var(--color-text);">
                        «Сложно сейчас настоящий мёд найти: часто продают мешаный сироп. А приехали в Центр сибирского мёда — во-первых, увидели свежий мёд прямо в сотах, значит, сами качают! Во-вторых, попробовали — сказка, жена такой только в детстве в деревне у дедушки ела. Набрали себе и родственникам — десять килограммов алтайского золота везём домой!»
                    </p>
                    <div style="padding-top: var(--space-2xs);">
                        <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">Игорь Володин</div>
                        <div class="u-text-muted" style="font-size: 0.875rem;">Гость курорта Белокуриха, участник дегустации</div>
                    </div>
                </div>
            </div>

            <!-- Сорта мёда и программа: каждая карточка во всю ширину строго по фактам из статьи -->
            <div class="bads-stack bads-stack--md">
                
                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Сорта алтайского мёда на дегустации
                        </h3>
                        <ul class="bads-list bads-list--check" style="font-size: 1.0625rem; line-height: 1.65;">
                            <li class="bads-list__item"><strong>Светлый донниковый мёд</strong> — классический нежный вкус с деликатным цветочным ароматом</li>
                            <li class="bads-list__item"><strong>Терпкий дягилевый мёд</strong> — насыщенный природный вкус с благородной терпкостью</li>
                            <li class="bads-list__item"><strong>Редкие высокогорные вариации</strong> — полифлорный сбор с диких лугов предгорий и кедровой тайги</li>
                            <li class="bads-list__item"><strong>Свежий мёд в сотах</strong> — гарантия подлинности и откачки без термической обработки и сиропа</li>
                        </ul>
                    </div>
                </div>

                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Программа и впечатления в Центре
                        </h3>
                        <ul class="bads-list bads-list--check" style="font-size: 1.0625rem; line-height: 1.65;">
                            <li class="bads-list__item"><strong>Открытая дегустация</strong> — знакомство с пасечными вкусами вприкуску с горячим алтайским травяным чаем</li>
                            <li class="bads-list__item"><strong>Экспресс-мастер-класс</strong> — эксперт центра рассказывает о тонкостях пчеловодства, правилах выбора натурального продукта и условиях его хранения</li>
                            <li class="bads-list__item"><strong>Покупка свежего мёда</strong> — возможность приобрести понравившиеся сорта в баночках для домашнего чаепития и подарков близким</li>
                            <li class="bads-list__item"><strong>Бесплатный трансфер от туроператора</strong> — удобная доставка отдыхающих из санаториев «Белокуриха», «Сибирь» и «Катунь»</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
