# AGENTS.md

## Обзор проекта

Это **пользовательская тема WordPress** для сайта туристического бренда **«Большой Алтай»** (Big Altay) — санаторно-курортного направления Алтая (пансионаты, туры, экскурсии, лечение, акции, новости). Репозиторий содержит только код темы (без ядра WordPress, без `composer.json`/`package.json`, без системы сборки) — файлы размещаются в `wp-content/themes/<theme>/` действующего сайта.

README: «WP сайт Большого Алтая / Big Altat Site».

## Технологический стек

- **PHP** (шаблоны WordPress, `functions.php` ~72 КБ — основная логика темы)
- **WordPress Theme API**: шаблоны иерархии (`front-page.php`, `page-*.php`, `single-*.php`, `archive-*.php`, `header.php`, `footer.php`, `404.php`)
- **ACF (Advanced Custom Fields)**: поля через `get_field()/the_field()`, локальные группы полей в `acf-json/`
- **CF7 (Contact Form 7)**: кастомная валидация и обработка форм (`wpcf7_*` фильтры/события)
- **Bitrix24 REST API**: лиды и подписки отправляются через AJAX-обработчики темы в воронку CRM (`bolshoyaltay.bitrix24.ru`, webhook с ID пользователя 52 зашит прямо в `functions.php`)
- **Сторонние JS-библиотеки** (vendored в `/js`): Swiper, @fancyapps/ui (Fancybox), vanilla-web-accordion, jQuery
- Собственная дизайн-система **BADS (Big Altay Design System)** с токенами и UI-компонентами

## Структура проекта

```
/workspace
├── functions.php          # Ядро темы: CPT, enqueue, AJAX, CF7, Bitrix24, шорткоды, редактор
├── header.php / footer.php
├── front-page.php         # Главная страница
├── page-*.php             # Шаблоны страниц (about, contacts, corp, courses, premium,
│                          #   pensioners, partners, pay, transfer, new-year, treatments,
│                          #   lechenie, divisions, treatment-direction, thank-you,
│                          #   design-system — витрина компонентов BADS)
├── single-*.php           # Шаблоны записей CPT (news, tours, excursions, promotions,
│                          #   treatments, putevki, sanatorium, numbers...)
├── archive-*.php          # Шаблоны архивов CPT
├── seo-template-page.php  # SEO-шаблон страницы
├── index.php, style.css   # Пустые заглушки (внимание!)
├── inc/
│   ├── ajax/              # AJAX-обработчики (ajax.php, treatment-direction.php)
│   ├── enqueue/           # Подключение ассетов: design-system.php (BADS), pages.php,
│   │                    # admin.php, legacy.php
│   ├── gallery/           # Раскладка галереи
│   ├── news/importer/     # Импорт новостей
│   ├── sanatoriums/       # Запросы и данные пансионатов
│   ├── seeders/           # One-click сидер контента «направления лечения»
│   └── treatment/         # TreatmentRepository
├── blocks/                # Блоки BADS: cta, hero, list, seo (рендерятся как PHP-блоки)
├── components/            # Компоненты: mega-menu, main-menu, anchor-nav, формы b24-*,
│                          #   consultation-modal, lead-form, slider, messenger-button,
│                          #   online-booking, page-intro, reactions и др.
├── layouts/               # Макеты: cta, form, hero, split
├── template-parts/        # content/, front-page/, pages/, ui/ (accordion, modal, tabs,
│                          #   button, field, badge, breadcrumbs, pagination и т.д.)
├── assets/
│   ├── css/               # BADS: foundation/ (токены: colors, breakpoints, motion,
│   │                      #   radius, shadow, sizes...), ui/, blocks/, components/,
│   │                      #   layouts/, pages/
│   ├── js/                # Модульный JS по блокам/компонентам/страницам
│   └── images/            # brands, icons, placeholders
├── css/, js/, fonts/      # Легаси-ассеты темы (main.min.css, main.js, swiper, fancybox)
└── acf-json/              # Локальные JSON-группы ACF
```

## Ключевая функциональность

### Пользовательские типы записей (регистрируются в `functions.php`)
`news`, `sanatorium`, `rest-belokurikha`, `rest-altai-mountains`, `numbers`, `putevki` (путёвки), `treatments`, `excursions`, `tours`, `promotion`.

### AJAX-обработчики (`wp_ajax[_nopriv]_*`)
- `send_b24_lead` — создание лида в Bitrix24 (+ комментарий в timeline сделки)
- `send_b24_news_subscriber` — подписка на рассылку новостей
- `load_more_news` — догрузка новостей
- `bads_toggle_like` — лайки/реакции записей

### Design System (BADS)
- Основа — модульность: блоки (`blocks/`), компоненты (`components/`), макеты (`layouts/`), UI-парты (`template-parts/ui/`) подключаются инклюдами/рендером с `$args` через `wp_parse_args`.
- Страница-витрина всех компонентов: `page-design-system.php`.
- Токены CSS в `assets/css/foundation/`, подключение списком в `inc/enqueue/design-system.php`.
- В BADS-файлах используется шапка-комментарий вида `Big Altay Design System (BADS) / <назначение>` — придерживайтесь этого стиля при создании новых файлов системы.

### Прочее
- Интеграция CF7: кастомная валидация, снятие обёрток `wpcf7-form-control-wrap`, JS-события.
- Класс кастомных кнопок/форматирований TinyMCE (`js/custom-editor-button.js`, `faq-mce.js`, шорткоды генерируются динамически через `add_shortcode`).
- Сидер направлений лечения: `inc/seeders/seed-directions.php` + данные в трёх частях.
- Репозиторий git: одна ветка `main`, история урезана (grafted).

## Соглашения и особенности

- Все PHP-файлы темы начинаются с проверки `if (!defined('ABSPATH')) exit;`.
- Ассеты подключаются с `filemtime()` как версию (кэширование по модификации файла); многие `wp_enqueue_*` guarded by `file_exists()`.
- Легаси (`css/main.min.css`, `js/main.js`, старые классы) сосуществует с новой BADS-структурой (`assets/css|js/...`) — не удаляйте легаси без проверки, часть страниц всё ещё зависит от него (`inc/enqueue/legacy.php`).
- Webhook Bitrix24 захардкожен в `functions.php` (~строка 1315) — при рефакторинге выносите в конфиг.
- `style.css` пуст (нет заголовка темы — WordPress так не определит; правьте осторожно), `index.php` пуст (заглушка безопасности), файл `single` (без расширения) — фактически шаблон single-записи, `Base` — заметка.
- Комментарии и текст интерфейса — на русском языке.
- `test.php` в корне — черновик/экспериментальный код (не является точкой входа темы).

## Как разрабатывать / проверять

1. Системной сборки нет: правки PHP/CSS/JS применяются напрямую; убедитесь, что синтаксис валиден:
   `php -l path/to/file.php`
2. Для локального просмотра нужен WordPress: скопируйте тему в `wp-content/themes/` и активируйте; требуются плагины **ACF (Pro)**, **Contact Form 7**.
3. Новые UI-элементы добавляйте как компонент/блок BADS (папки `components/` или `blocks/` + CSS/JS в `assets/` + регистрация в соответствующем `inc/enqueue/*.php`), а не инлайн-стилями.
4. Перед коммитом проверяйте, что не сломаны хуки `init` (CPT) и `wp_ajax_*` обработчики.
