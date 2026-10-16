# AGENTS.md

## Обзор проекта

Это **пользовательская тема WordPress** для сайта туристического бренда **«Большой Алтай»** (Big Altay) — санаторно-курортного направления Алтая (пансионаты, туры, экскурсии, лечение, акции, новости). Репозиторий содержит только код темы (без ядра WordPress, без `composer.json`/`package.json`, без системы сборки) — файлы размещаются в `wp-content/themes/<theme>/` действующего сайта.

README: «WP сайт Большого Алтая / Big Altat Site».

## Технологический стек

- **PHP** (шаблоны WordPress, `functions.php` ~72 КБ — основная логика темы)
- **WordPress Theme API**: шаблоны иерархии (`front-page.php`, `page-*.php`, `single-*.php`, `archive-*.php`, `header.php`, `footer.php`, `404.php`)
- **ACF (Advanced Custom Fields)**: поля через `get_field()/the_field()`, локальные группы полей в `acf-json/`
- ~~CF7 (Contact Form 7)~~: **выведен из использования** — все живые формы работают напрямую через Bitrix24 REST; мёртвый CF7-код удалён из `functions.php`, попап в футере переведён на BADS-форму `components/forms/b24-form.php`. Плагин можно деактивировать в админке.
- **Bitrix24 REST API**: лиды и подписки отправляются через AJAX-обработчики темы в воронку CRM (`bolshoyaltay.bitrix24.ru`, webhook с ID пользователя 52 зашит прямо в `functions.php`)
- **Сторонние JS-библиотеки** (vendored в `/js`): Swiper, @fancyapps/ui (Fancybox), vanilla-web-accordion, jQuery
- Собственная дизайн-система **BADS (Big Altay Design System)** с токенами и UI-компонентами

## Структура проекта

```
/workspace
├── functions.php          # Ядро темы: CPT, enqueue, AJAX, Bitrix24, шорткоды, редактор
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
- Contact Form 7 больше не используется: формы — нативные BADS (`components/forms/b24-form.php`) с AJAX-отправкой `send_b24_lead` в Bitrix24. Остатки CF7-шорткодов допускаются только на архивных/устаревших страницах (контент в БД, не в коде темы).
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
2. Для локального просмотра нужен WordPress: скопируйте тему в `wp-content/themes/` и активируйте; требуется плагин **ACF (Pro)**; Contact Form 7 более не требуется (формы — нативные BADS + Bitrix24).
3. Новые UI-элементы добавляйте как компонент/блок BADS (папки `components/` или `blocks/` + CSS/JS в `assets/` + регистрация в соответствующем `inc/enqueue/*.php`), а не инлайн-стилями.
4. Перед коммитом проверяйте, что не сломаны хуки `init` (CPT) и `wp_ajax_*` обработчики.

---

## Рабочий процесс (стандартная процедура для каждой задачи)

Этот раздел — обязательный алгоритм. Агент должен выполнять ВСЕ шаги ниже в ответ на одну задачу пользователя, чтобы пользователю не приходилось допрашивать деталями.

### Шаг 1. Работа с git (репозиторий: https://github.com/romanbigaltay-bot/big-altay-site.git)

1. Перед началом работы синхронизироваться с актуальным `main`:
   `git fetch origin && git checkout main && git pull --ff-only origin main`
2. Создать feature-ветку с префиксом области изменений: `bads/<краткое-имя>` (например `bads/hero-badge`).
3. Внести правки, проверить синтаксис (`php -l` для каждого изменённого PHP-файла).
4. Сделать коммит(ы) с понятным сообщением на русском (conventional-префикс: `feat(...)`, `fix(...)`, `refactor(...)`).
5. Запушить ветку: `git push origin bads/<имя>`.
6. Создать Pull Request через GitHub API (для этого у токена должны быть права **Contents: Read and write** + **Pull requests: Read and write**):
   ```bash
   curl -s -X POST \
     -H "Authorization: Bearer $GITHUB_TOKEN" \
     -H "Accept: application/vnd.github+json" \
     https://api.github.com/repos/romanbigaltay-bot/big-altay-site/pulls \
     -d '{"title":"...","head":"bads/<имя>","base":"main"}'
   ```
   Если создание PR невозможно (нет прав) — обязательно дать готовую ссылку:
   `https://github.com/romanbigaltay-bot/big-altay-site/pull/new/<имя-ветки>`
7. После мержа PR пользователем (или если пользователь попросил мержить агента) — смёржить PR:
   `curl -s -X PUT .../pulls/<N>/merge -d '{"merge_method":"merge"}'`

Токен GitHub пользователь передаёт в начале сессии; при ошибке 403 — точно сказать, каких разрешений не хватает (Contents / Pull requests).

### Шаг 2. Инструкция по переносу на тестовый прод (обязательно в финальном ответе)

Финальный ответ агента после выполнения задачи ВСЕГДА содержит раздел «Как применить на тестовом проде» со следующими пунктами:

1. **Список изменённых файлов** — явно, с путями относительно корня темы (например `template-parts/front-page/hero/hero-header.php`). Если менялись CSS/JS — перечислить их отдельно.
2. **Способ применения**, один из (выбрать подходящий и написать конкретной командой):
   - Если на тестовом проде тема под git:
     `cd /путь/к/wp-content/themes/<тема> && git pull origin main`
   - Если без git: скачать файлы из вкладки Code репозитория (или `curl -L https://raw.githubusercontent.com/romanbigaltay-bot/big-altay-site/main/<путь-файла> -o <путь-файла>`) и положить по тем же путям.
3. **Проверка синтаксиса на сервере** (если тронуты PHP-файлы):
   `php -l <изменённый-файл>`
4. **Кэш**: напомнить сбросить кэш страниц/плагинов (LiteSpeed/WP Rocket/CDN) и проверить в инкогнито/Ctrl+F5.
5. **Что именно проверить визуально**: конкретный URL сайта и ожидаемый результат (например: «главная → в hero над заголовком голубой бейдж „…“»).
6. **Откат** (на случай проблем): чем откатить — `git checkout <предыдущий-коммит> -- <файл>` или резервная копия файла перед заменой.

### Шаг 3. Цикл обратной связи

- Пользователь проверяет на тестовом проде и либо возвращает доработки (тогда новый коммит в ту же ветку → обновление PR → повтор инструкции), либо подтверждает результат и применяет на настоящем проде тем же способом (git pull / копия файлов).
- Настоящий прод агентом НЕ трогается никогда — туда пользователь приносит изменения сам.

### Чек-лист финального ответа агента (должен содержать всё)

- [ ] Что сделано (кратко, по сути задачи)
- [ ] Изменённые файлы (полные пути)
- [ ] Хеш(-и) коммита(-ов) и ссылка на PR (или ссылка на ветку, если PR не создан)
- [ ] Пошаговая инструкция для тестового прода (Шаг 2 выше)
- [ ] Инструкция по откату
