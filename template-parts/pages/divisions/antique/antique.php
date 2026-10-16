<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page / Division 1: Antique Fair
 * Path: template-parts/pages/divisions/antique/antique.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$antique_gallery = [
    [
        'url' => 'https://big-altay.ru/wp-content/uploads/2026/08/img_4402-scaled-1-1800x1000.jpg',
        'alt' => 'Антикварная лавка и ярмарка мастеров в Белокурихе',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_4401-2-1024x683.jpg',
        'alt' => 'Латунные самовары и старинный быт Сибири',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_4253-1-1024x683.jpg',
        'alt' => 'Медные монеты времен Екатерины II',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/08/img_4408-1-1024x683.jpg',
        'alt' => 'Павильон алтайских мастеров и живописи',
    ],
];

$slides = [];
foreach ($antique_gallery as $img) {
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

<section class="bads-section bads-section--lg bads-divisions-item" id="antique" style="scroll-margin-top: 80px;">
    <div class="bads-stack bads-stack--lg">

        <!-- Заголовок, дивидер, сабтайтл -->
        <div class="bads-stack bads-stack--xs">
            <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.08em; font-size: 0.8125rem; color: var(--color-primary);">
                Культурное пространство &amp; Павильон ремёсел
            </span>

            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'           => 'Антикварная ярмарка',
                'level'           => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
                'divider_width'   => '72px',
                'subtitle'        => 'Живая история Алтая, сибирские раритеты от 50 лет и бесплатная площадка для мастеров и художников.',
            ]);
            ?>
        </div>

        <!-- Слайдер баннеров 920x390 ниже заголовка и сабтайтла -->
        <div class="bads-divisions-banner">
            <?php
            get_template_part('template-parts/components/slider/slider', null, [
                'id'             => 'slider-antique',
                'class'          => 'bads-slider--banner',
                'slides'         => $slides,
                'arrows'         => true,
                'pagination'     => true,
                'loop'           => true,
                'autoplay'       => false,
                'controls_align' => 'center',
                'aria_label'     => 'Фотографии Антикварной ярмарки',
            ]);
            ?>
        </div>

        <!-- Основной контент: каждая карточка во всю ширину -->
        <div class="bads-stack bads-stack--lg">
            
            <p class="u-text-muted" style="font-size: 1.125rem; line-height: 1.65; margin: 0;">
                На территории гастробара «Барон» (ул. Объездная, 45) туроператор «Большой Алтай» открыл уникальный проект, объединяющий подлинную сибирскую старину и современное ремесленное творчество. Здесь история оживает в вещах, а алтайские художники и мастера находят благодарную аудиторию среди гостей курорта Белокуриха.
            </p>

            <!-- Цитаты: простое аккуратное оформление без стеклянного эффекта, во всю ширину -->
            <div class="bads-stack bads-stack--md">
                
                <!-- Цитата: Александр Петрович Ежов -->
                <div class="bads-card bads-card--bordered bads-card--padding-lg bads-card--radius-lg" style="border-left: 4px solid var(--color-primary); background: rgba(var(--brand-primary-rgb), 0.02);">
                    <div class="bads-stack bads-stack--sm">
                        <p style="font-size: 1.0625rem; line-height: 1.65; font-style: italic; margin: 0; color: var(--color-text);">
                            «Мы заинтересованы во всех, кто делает что-то своими руками: художниках, мастерах вышивки, гончарах – нет никаких ограничений на творчество! Площадка вмещает до 30 мастеров единовременно. Для ремесленников это абсолютно бесплатно: не нужно платить за аренду стола или делать взносы. Мы организуем рекламу по санаториям курорта и гарантируем посещение ярмарки гостями».
                        </p>
                        <div style="padding-top: var(--space-2xs);">
                            <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">Александр Петрович Ежов</div>
                            <div class="u-text-muted" style="font-size: 0.875rem;">Генеральный директор туроператора «Большой Алтай»</div>
                        </div>
                    </div>
                </div>

                <!-- Цитата: Владимир Анатольевич Злобин -->
                <div class="bads-card bads-card--bordered bads-card--padding-lg bads-card--radius-lg" style="border-left: 4px solid rgba(var(--brand-primary-rgb), 0.5); background: rgba(var(--brand-primary-rgb), 0.02);">
                    <div class="bads-stack bads-stack--sm">
                        <p style="font-size: 1.0625rem; line-height: 1.65; font-style: italic; margin: 0; color: var(--color-text);">
                            «Наши специалисты ездят в историко-этнографические экспедиции по дальним селам Горного Алтая — Мульта, Нижний Комар, Куяган. Мы находим предметы с живой историей: от увесистых медных пятаков времен Екатерины II до пузатых латунных самоваров и резных прялок. Каждая вещь в антикварном павильоне проходит строгую экспертную оценку на историческую ценность».
                        </p>
                        <div style="padding-top: var(--space-2xs);">
                            <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">Владимир Анатольевич Злобин</div>
                            <div class="u-text-muted" style="font-size: 0.875rem;">Эксперт антикварной лавки, историк и краевед</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Условия: каждая карточка во всю ширину с крупным шрифтом -->
            <div class="bads-stack bads-stack--md">
                
                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Для гостей и коллекционеров
                        </h3>
                        <ul class="bads-list bads-list--check" style="font-size: 1.0625rem; line-height: 1.65;">
                            <li class="bads-list__item">Редкие медные монеты Екатерины II и сибирская нумизматика</li>
                            <li class="bads-list__item">Пузатые латунные самовары, купеческая утварь, иконы и прялки</li>
                            <li class="bads-list__item">Живопись алтайских художников, авторская керамика и декор</li>
                            <li class="bads-list__item">Строгий экспертный отбор раритетов старше 50 лет</li>
                        </ul>
                    </div>
                </div>

                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Для мастеров и художников
                        </h3>
                        <ul class="bads-list bads-list--check" style="font-size: 1.0625rem; line-height: 1.65;">
                            <li class="bads-list__item">0 ₽ за аренду выставочного места и полное отсутствие оргвзносов</li>
                            <li class="bads-list__item">Вместимость теплого павильона до 30 мастеров единовременно</li>
                            <li class="bads-list__item">Широкая рекламная поддержка по санаториям курорта Белокуриха</li>
                            <li class="bads-list__item">Постоянный поток заинтересованных гостей и туристов круглый год</li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
