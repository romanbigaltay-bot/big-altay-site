<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Divisions Page / Division 3: Boutiques "Ty - Priroda"
 * Path: template-parts/pages/divisions/ty-priroda/ty-priroda.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$ty_priroda_gallery = [
    [
        'url' => 'https://big-altay.ru/wp-content/uploads/2026/09/gsh_0727-scaled-1-1800x1000.jpg',
        'alt' => 'Интерьер бутика курортного бренда Ты природа в Белокурихе',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/09/gsh_0686-1024x684.jpg',
        'alt' => 'Теплая коллекция из 100% шерсти мериноса для процедур',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/09/gsh_0790-1024x684.jpg',
        'alt' => 'Базовая курортная одежда из хлопка',
    ],
    [
        'url' => 'https://altaykyrort.ru/wp-content/uploads/2026/09/gsh_0867-1024x684.jpg',
        'alt' => 'Эко-аксессуары, натуральная косметика и подарки',
    ],
];

$boutique_locations = [
    [
        'title' => 'Санаторий «Белокуриха»',
        'desc'  => 'Холл главного корпуса, курортная зона',
        'hours' => 'Ежедневно: 09:00 – 18:00',
    ],
    [
        'title' => 'Санаторий «Сибирь»',
        'desc'  => 'Центральный вестибюль санатория',
        'hours' => 'Пн - Пт: 09:00 – 16:00',
    ],
    [
        'title' => 'Санаторий «Катунь»',
        'desc'  => 'Галерея первого этажа',
        'hours' => 'Пн - Пт: 10:00 – 17:00',
    ],
];

$slides = [];
foreach ($ty_priroda_gallery as $img) {
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

<section class="bads-section bads-section--lg bads-divisions-item" id="ty-priroda" style="scroll-margin-top: 80px;">
    <div class="bads-stack bads-stack--lg">

        <!-- Заголовок, дивидер, сабтайтл -->
        <div class="bads-stack bads-stack--xs">
            <span class="u-text-muted u-font-bold u-uppercase" style="letter-spacing: 0.08em; font-size: 0.8125rem; color: var(--color-primary);">
                Курортный бренд &amp; Осознанное потребление
            </span>

            <?php
            get_template_part('template-parts/ui/title', null, [
                'title'           => 'Бутики бренда «Ты – природа»',
                'level'           => 'h2',
                'divider'         => true,
                'divider_variant' => 'primary',
                'divider_width'   => '72px',
                'subtitle'        => 'Эстетика, гармония Алтая, базовая одежда из 100% хлопка и согревающая серия из шерсти мериноса.',
            ]);
            ?>
        </div>

        <!-- Слайдер баннеров 920x390 ниже заголовка и сабтайтла -->
        <div class="bads-divisions-banner">
            <?php
            get_template_part('template-parts/components/slider/slider', null, [
                'id'             => 'slider-ty-priroda',
                'class'          => 'bads-slider--banner',
                'slides'         => $slides,
                'arrows'         => true,
                'pagination'     => true,
                'loop'           => true,
                'autoplay'       => false,
                'controls_align' => 'center',
                'aria_label'     => 'Фотографии бутиков Ты - природа',
            ]);
            ?>
        </div>

        <!-- Основной контент: каждая карточка во всю ширину -->
        <div class="bads-stack bads-stack--lg">
            
            <p class="u-text-muted" style="font-size: 1.125rem; line-height: 1.65; margin: 0;">
                Сеть бутиков сувенирного бренда «Ты – природа» создана туроператором «Большой Алтай» совместно с АО «Курорт Белокуриха». Мы кардинально переосмыслили курортный шопинг: вместо безликих пылящихся сувениров мы предлагаем эстетичные, долговечные и по-настоящему полезные вещи, в которых живёт дух Алтая.
            </p>

            <!-- Цитата: простое аккуратное оформление без стеклянного эффекта -->
            <div class="bads-card bads-card--bordered bads-card--padding-lg bads-card--radius-lg" style="border-left: 4px solid var(--color-primary); background: rgba(var(--brand-primary-rgb), 0.02);">
                <div class="bads-stack bads-stack--sm">
                    <p style="font-size: 1.0625rem; line-height: 1.65; font-style: italic; margin: 0; color: var(--color-text);">
                        «Нам хотелось уйти от привычного представления о сувенирном магазине и создать пространство с собственной атмосферой. Через каждую вещь бренда проходит одна общая линия — природа Алтая. Это проявляется в натуральных материалах, спокойных природных оттенках и идее осознанного потребления: покупать меньше случайных предметов и выбирать то, чем действительно будешь пользоваться дома, на курорте или в дороге».
                    </p>
                    <div style="padding-top: var(--space-2xs);">
                        <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">Евгения Ежова</div>
                        <div class="u-text-muted" style="font-size: 0.875rem;">Управляющая сети бутиков «Ты – природа»</div>
                    </div>
                </div>
            </div>

            <!-- 3 направления ассортимента: каждое во всю ширину с крупным шрифтом -->
            <div class="bads-stack bads-stack--md">
                
                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Авторская одежда из 100% хлопка
                        </h3>
                        <p class="u-text-muted" style="font-size: 1.0625rem; line-height: 1.65; margin: 0;">
                            Уютные худи, комфортные свитшоты и футболки из премиального плотного хлопка. Спокойная природная палитра — мох, хвоя, туман, гранит — и лаконичная графика, передающая величие алтайских гор и рек. Идеально для прогулок по терренкурам и повседневной жизни.
                        </p>
                    </div>
                </div>

                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Терапевтическая серия из шерсти мериноса
                        </h3>
                        <p class="u-text-muted" style="font-size: 1.0625rem; line-height: 1.65; margin: 0;">
                            Мягкие согревающие носки, эластичные пояса-корсеты и согревающие наколенники из тонкорунной мериносовой шерсти. Незаменимы для сохранения лечебного тепла после гидромассажных ванн, пантовых процедур и сеансов мануальной терапии.
                        </p>
                    </div>
                </div>

                <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                    <div class="bads-stack bads-stack--sm">
                        <h3 class="bads-title bads-title--h4" style="margin: 0; color: var(--color-primary);">
                            Эко-аксессуары и натуральная косметика «Долголетие»
                        </h3>
                        <p class="u-text-muted" style="font-size: 1.0625rem; line-height: 1.65; margin: 0;">
                            Надёжные термокружки для горных прогулок, шерстяные пледы, хлопковые шопперы, уходовая линейка кремов на природных алтайских травах и маслах, а также подарочные наборы, которые приятно привезти близким с курорта.
                        </p>
                    </div>
                </div>

            </div>

            <!-- Адреса бутиков «Ты – природа» в Белокурихе: во всю ширину -->
            <div class="bads-card bads-card--glass bads-card--padding-xl bads-card--radius-xl">
                <div class="bads-stack bads-stack--lg">
                    
                    <h3 class="bads-title bads-title--h4" style="margin: 0;">
                        Адреса бутиков «Ты – природа» в Белокурихе
                    </h3>

                    <div class="bads-stack bads-stack--md">
                        <?php foreach ($boutique_locations as $loc) : ?>
                            <div class="bads-cluster u-justify-between u-items-center" style="padding-bottom: var(--space-sm); border-bottom: 1px solid rgba(var(--brand-primary-rgb), 0.08); flex-wrap: wrap; gap: var(--space-xs);">
                                <div>
                                    <div style="font-weight: 700; font-size: 1.0625rem; color: var(--color-text);">
                                        <?= esc_html($loc['title']); ?>
                                    </div>
                                    <div class="u-text-muted" style="font-size: 0.9375rem; margin-top: 2px;">
                                        <?= esc_html($loc['desc']); ?>
                                    </div>
                                </div>
                                <div style="font-size: 0.875rem; color: var(--color-primary); font-weight: 600; white-space: nowrap;">
                                    <?= esc_html($loc['hours']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Консультация и телефон -->
                    <div class="bads-cluster u-justify-between u-items-center" style="gap: var(--space-md); flex-wrap: wrap;">
                        <div>
                            <div style="font-weight: 700; font-size: 1rem; color: var(--color-text);">
                                Справки по ассортименту и размерам:
                            </div>
                            <div style="font-size: 1.0625rem; margin-top: 4px;">
                                <a href="tel:+79134524303" style="font-weight: 700; color: var(--color-primary); text-decoration: none;">
                                    +7 (913) 452-43-03
                                </a>
                            </div>
                        </div>

                        <div>
                            <button
                                type="button"
                                class="bads-btn bads-btn--primary bads-btn--md"
                                data-modal-trigger
                                data-modal-target="#bads-consultation-modal"
                            >
                                <span class="bads-btn__text">Получить консультацию</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
