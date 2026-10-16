<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Components / Main Menu
 * ============================================================================
 *
 * Главное навигационное меню сайта с поддержкой выпадающих списков (Dropdowns)
 * и мобильного навигационного ящика (Drawer).
 * 
 * В мобильной версии подменю выводятся через штатный BADS UI компонент
 * template-parts/ui/accordion.
 */

if (!defined('ABSPATH')) {
    exit;
}

$current_uri = trim($_SERVER['REQUEST_URI'] ?? '', '/');
$part = $args['part'] ?? 'all';
$render_nav = in_array($part, ['nav', 'all'], true);
$render_drawer = in_array($part, ['drawer', 'all'], true);

// Структура пунктов меню
$menu_items = [
    [
        'label' => 'О нас',
        'url'   => '/divisions/',
    ],
    [
        'label'    => 'Санатории',
        'url'      => '/sanatorium/',
        'children' => [
            ['label' => 'Санаторий «Белокуриха»', 'url' => '/sanatorium/belokuriha/'],
            ['label' => 'Санаторий «Сибирь»',     'url' => '/sanatorium/sibir/'],
            ['label' => 'Санаторий «Катунь»',     'url' => '/sanatorium/katun/'],
            ['label' => 'Санаторий «Современник-18»', 'url' => '/sanatorium/sovremennik-18/'],
            ['label' => 'Все санатории',         'url' => '/sanatorium/', 'is_all' => true],
        ],
    ],
    [
        'label' => 'Лечение',
        'url'   => '/lechenie/',
    ],
    [
        'label'    => 'Отдых',
        'url'      => '/rest-belokurikha/',
        'children' => [
            ['label' => 'Калина красная',  'url' => '/rest-belokurikha/baza-otdyha-kalina-krasnaya/'],
            ['label' => 'Отдых в Белокурихе',  'url' => '/rest-belokurikha/'],
            ['label' => 'Отдых в Горном Алтае', 'url' => '/rest-altai-mountains/'],
        ],
    ],
    [
        'label'    => 'Услуги',
        'url'      => '',
        'children' => [
            ['label' => 'Туры',      'url' => '/tours/'],
            ['label' => 'Экскурсии', 'url' => '/excursions/'],
            ['label' => 'Трансфер',  'url' => '/transfer/'],
        ],
    ],
    [
        'label' => 'Новый год в Белокурихе',
        'url'   => '/new-year/',
    ],
    [
        'label' => 'Акции',
        'url'   => '/promotions/',
    ],
    [
        'label' => 'Новости',
        'url'   => '/news/',
    ],
    [
        'label' => 'Партнерам',
        'url'   => '/partners/',
    ],
    [
        'label' => 'Контакты',
        'url'   => '/contacts/',
    ],
];
?>

<?php if ($render_nav) : ?>
<!-- Desktop Navigation Menu -->
<nav class="bads-main-menu" aria-label="<?= esc_attr__('Главное меню сайта', 'bigaltay'); ?>">
    <ul class="bads-main-menu__list">
        <?php foreach ($menu_items as $item) : 
            $has_children = !empty($item['children']);
            $item_url = $item['url'] ?? '';
            $has_link = !empty($item_url) && $item_url !== '#';
            $item_slug = trim($item_url, '/');

            // Item is active if current URL matches item slug, or any of its children matches current URL
            $is_active = ($item_slug !== '' && str_starts_with($current_uri, $item_slug));
            if (!$is_active && $has_children) {
                foreach ($item['children'] as $child) {
                    $child_slug = trim($child['url'] ?? '', '/');
                    if ($child_slug !== '' && ($current_uri === $child_slug || str_starts_with($current_uri, $child_slug . '/'))) {
                        $is_active = true;
                        break;
                    }
                }
            }

            $url_attr = $has_link 
                ? 'href="' . esc_url($item_url) . '"' 
                : 'href="#" onclick="event.preventDefault(); return false;" role="button" aria-haspopup="true" aria-expanded="false"';
        ?>
            <li class="bads-main-menu__item<?= $has_children ? ' has-dropdown' : ''; ?><?= $is_active ? ' is-active' : ''; ?>">
                <a <?= $url_attr; ?> class="bads-main-menu__link">
                    <span><?= esc_html($item['label']); ?></span>
                    <?php if ($has_children) : ?>
                        <span class="bads-main-menu__arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </span>
                    <?php endif; ?>
                </a>

                <?php if ($has_children) : ?>
                    <ul class="bads-main-menu__dropdown" aria-label="<?= esc_attr($item['label']); ?>">
                        <?php foreach ($item['children'] as $child) : 
                            $child_slug = trim($child['url'] ?? '', '/');
                            $is_child_active = ($child_slug !== '' && ($current_uri === $child_slug || str_starts_with($current_uri, $child_slug . '/')));
                            $is_all_class = !empty($child['is_all']) ? ' bads-main-menu__sublink--all' : '';
                        ?>
                            <li class="bads-main-menu__subitem<?= $is_child_active ? ' is-active' : ''; ?>">
                                <a href="<?= esc_url($child['url']); ?>" class="bads-main-menu__sublink<?= $is_all_class; ?>">
                                    <?= esc_html($child['label']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
<?php endif; ?>

<?php if ($render_drawer) : ?>
<!-- Mobile Navigation Drawer -->
<?php 
    $phone = get_field('phone_1', 2) ?: '8 800 500-07-34';
    $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
    $vk_url = get_field('vk', 2) ?: 'https://vk.com/bolshoyaltay';
?>
<div class="bads-mobile-drawer js-bads-drawer" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?= esc_attr__('Мобильное меню', 'bigaltay'); ?>">
    <div class="bads-mobile-drawer__backdrop js-bads-drawer-backdrop"></div>
    <div class="bads-mobile-drawer__panel">
        <!-- Drawer Header: Mirrors the site header on mobile (Logo - Centered Phone - Close Cross) -->
        <div class="bads-mobile-drawer__header">
            <a href="<?= is_front_page() ? '#top' : '/'; ?>" class="bads-mobile-drawer__logo" aria-label="<?= esc_attr__('Главная страница', 'bigaltay'); ?>">
                <img 
                    src="<?= get_template_directory_uri(); ?>/img/header/logo.webp" 
                    alt="<?= esc_attr__('Большой Алтай', 'bigaltay'); ?>"
                    class="bads-mobile-drawer__logo-img bads-header__logo-img"
                    onerror="this.onerror=null;this.src='<?= get_template_directory_uri(); ?>/img/header/logo.png';"
                >
            </a>

            <a 
                href="tel:<?= esc_attr($phone_clean); ?>" 
                class="bads-mobile-drawer__phone bads-header__phone u-text-dark hover:u-text-primary u-no-underline"
                aria-label="<?= esc_attr(sprintf(__('Позвонить по номеру %s', 'bigaltay'), $phone)); ?>"
            >
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="bads-header__phone-icon u-shrink-0" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span class="bads-header__phone-text u-text-base u-text-bold u-leading-none" style="font-size: 16px; letter-spacing: -0.01em;"><?= esc_html($phone); ?></span>
            </a>

            <button 
                type="button" 
                class="bads-btn bads-btn--icon-only bads-mobile-drawer__close js-bads-drawer-close" 
                aria-label="<?= esc_attr__('Закрыть меню', 'bigaltay'); ?>"
                title="<?= esc_attr__('Закрыть', 'bigaltay'); ?>"
            >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="bads-mobile-drawer__body">
            <ul class="bads-mobile-menu__list">
                <?php foreach ($menu_items as $item) : 
                    $has_children = !empty($item['children']);
                    $item_url = $item['url'] ?? '';
                    $item_slug = trim($item_url, '/');
                    $is_active = ($item_slug !== '' && str_starts_with($current_uri, $item_slug));

                    if (!$is_active && $has_children) {
                        foreach ($item['children'] as $child) {
                            $child_slug = trim($child['url'] ?? '', '/');
                            if ($child_slug !== '' && ($current_uri === $child_slug || str_starts_with($current_uri, $child_slug . '/'))) {
                                $is_active = true;
                                break;
                            }
                        }
                    }
                ?>
                    <li class="bads-mobile-menu__item<?= $is_active ? ' is-active' : ''; ?>">
                        <?php if (!$has_children) : ?>
                            <a href="<?= esc_url($item_url); ?>" class="bads-mobile-menu__link">
                                <?= esc_html($item['label']); ?>
                            </a>
                        <?php else : 
                            // Render submenu via standard BADS UI Accordion
                            ob_start();
                            foreach ($item['children'] as $child) : 
                                $child_slug = trim($child['url'] ?? '', '/');
                                $is_child_active = ($child_slug !== '' && ($current_uri === $child_slug || str_starts_with($current_uri, $child_slug . '/')));
                            ?>
                                <a href="<?= esc_url($child['url']); ?>" class="bads-mobile-menu__sublink<?= $is_child_active ? ' is-active' : ''; ?>">
                                    <?= esc_html($child['label']); ?>
                                </a>
                            <?php endforeach;
                            $submenu_content = ob_get_clean();

                            get_template_part('template-parts/ui/accordion', null, [
                                'title'   => $item['label'],
                                'content' => $submenu_content,
                                'open'    => $is_active,
                            ]);
                        ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Drawer Footer: Vertical column stack (Socials -> Consult CTA Button -> Registry) -->
        <div class="bads-mobile-drawer__footer">
            <!-- 1. Socials Cluster -->
            <div class="bads-cluster bads-cluster--center bads-cluster--middle bads-cluster--sm u-w-full">
                <!-- MAX Bot Link -->
                <a 
                    href="https://max.ru/id2203004205_bot" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="bads-cluster bads-cluster--xs bads-cluster--middle bads-mobile-drawer__social-btn bads-mobile-drawer__social-btn--max"
                    aria-label="<?= esc_attr__('Открыть чат с ботом MAX', 'bigaltay'); ?>"
                >
                    <img 
                        src="<?= get_template_directory_uri(); ?>/assets/images/brands/max.svg" 
                        alt="MAX" 
                        width="24" 
                        height="24"
                        style="width: 24px; height: 24px; object-fit: contain;"
                    >
                    <span>Чат в MAX</span>
                </a>

                <!-- VK Link -->
                <a 
                    href="<?= esc_url($vk_url); ?>" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="bads-cluster bads-cluster--xs bads-cluster--middle bads-mobile-drawer__social-btn bads-mobile-drawer__social-btn--vk"
                    aria-label="<?= esc_attr__('Сообщество ВКонтакте', 'bigaltay'); ?>"
                >
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M15.684 0H8.316C3.592 0 0 3.592 0 8.316v7.368C0 20.408 3.592 24 8.316 24h7.368C20.408 24 24 20.408 24 15.684V8.316C24 3.592 20.408 0 15.684 0zm4.512 17.294h-1.92c-.728 0-.95-.578-2.257-1.884-1.14-1.115-1.644-1.258-1.923-1.258-.392 0-.503.112-.503.644v1.815c0 .463-.146.683-1.37.683-2.022 0-4.267-1.229-5.85-3.518-2.388-3.388-3.04-5.932-3.04-6.452 0-.236.09-.456.533-.456h1.92c.396 0 .546.182.698.604 1.054 3.036 2.81 5.702 3.535 5.702.274 0 .4-.124.4-.803V10.87c-.06-1.438-.84-1.558-.84-2.072 0-.246.2-.494.526-.494h2.98c.414 0 .564.218.564.71v3.834c0 .414.186.558.308.558.246 0 .45-.144.908-.602 1.39-1.564 2.378-3.95 2.378-3.95.132-.27.35-.454.764-.454h1.92c.576 0 .7.296.576.71-.24 1.11-2.58 4.412-2.69 4.582-.228.36-.318.522 0 .948.228.306 1.002.978 1.518 1.572.95 1.08 1.688 1.986 1.884 2.61.198.618-.108.924-.534.924z"/>
                    </svg>
                    <span>ВКонтакте</span>
                </a>
            </div>

            <!-- 2. Consultation Action Button -->
            <div class="u-w-full">
                <?php 
                get_template_part('template-parts/ui/button', null, [
                    'text'    => 'Получить консультацию',
                    'variant' => 'primary',
                    'size'    => 'md',
                    'pill'    => true,
                    'type'    => 'button',
                    'class'   => 'u-w-full',
                    'attrs'   => [
                        'data-modal-target'  => '#bads-consultation-modal',
                        'data-modal-trigger' => '',
                    ],
                ]);
                ?>
            </div>

            <!-- 3. Registry Badge -->
            <div class="bads-cluster bads-cluster--center u-w-full">
                <a 
                    href="https://ev.economy.gov.ru/lk_exp/registry/to/50d74ccd-d2ab-4bb3-98d4-8dd97d517f31" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="bads-cluster bads-cluster--xs bads-cluster--middle bads-mobile-drawer__registry u-text-muted u-no-underline hover:u-text-primary"
                    aria-label="<?= esc_attr__('Реестр туроператоров Минэкономразвития РФ', 'bigaltay'); ?>"
                >
                    <img 
                        src="<?= get_template_directory_uri(); ?>/img/header/eagle.png" 
                        alt="" 
                        width="32" 
                        height="32"
                        style="width: 32px; height: 32px; object-fit: contain;"
                        loading="lazy"
                    >
                    <span class="u-text-2xs u-leading-tight" style="font-size: 11px;">
                        Мы в реестре туроператоров:<br/>
                        <strong class="u-text-dark">ООО «Большой Алтай», РТО 026357</strong>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
