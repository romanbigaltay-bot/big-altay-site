<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Component: News Sidebar (Glass Card with 3:2 News Cards & Subscription Modal)
 * ============================================================================
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

$args = wp_parse_args($args ?? [], [
    'title'          => 'Другие новости',
    'count'          => 3,
    'exclude'        => [],
    'all_url'        => get_post_type_archive_link('news') ?: home_url('/news/'),
    'sticky'         => true,
    'show_subscribe' => true,
    'class'          => '',
]);

$news_title      = (string) $args['title'];
$news_count      = max(1, min(6, (int) $args['count']));
$exclude_ids     = array_filter(array_map('intval', (array) $args['exclude']));
$news_all_url    = (string) $args['all_url'];
$is_sticky       = (bool) $args['sticky'];
$show_subscribe  = (bool) $args['show_subscribe'];
$extra_class     = (string) $args['class'];

// Fetch latest news excluding specified posts
$query_args = [
    'post_type'      => 'news',
    'posts_per_page' => $news_count,
    'post_status'    => 'publish',
];

if (!empty($exclude_ids)) {
    $query_args['post__not_in'] = $exclude_ids;
}

$news_query = new WP_Query($query_args);
$news_items = [];
$rendered_ids = [];

if ($news_query->have_posts()) {
    while ($news_query->have_posts()) {
        $news_query->the_post();
        $post_id = get_the_ID();
        $rendered_ids[] = $post_id;

        // 1. Featured image (post thumbnail)
        $image_url = '';
        if (has_post_thumbnail($post_id)) {
            $image_url = get_the_post_thumbnail_url($post_id, 'medium');
        }

        // 2. Custom field 'news_promo' (used in news-importer.php)
        if (empty($image_url)) {
            $promo_id = get_post_meta($post_id, 'news_promo', true);
            if (!empty($promo_id)) {
                $image_url = is_numeric($promo_id) ? wp_get_attachment_image_url((int)$promo_id, 'medium') : $promo_id;
            }
        }

        // 3. ACF field fallback
        if (empty($image_url) && function_exists('get_field')) {
            $acf_img = get_field('image', $post_id) ?: get_field('photo', $post_id) ?: get_field('news_promo', $post_id);
            if (!empty($acf_img)) {
                if (is_array($acf_img) && !empty($acf_img['url'])) {
                    $image_url = $acf_img['sizes']['medium'] ?? $acf_img['url'];
                } elseif (is_numeric($acf_img)) {
                    $image_url = wp_get_attachment_image_url((int)$acf_img, 'medium');
                } elseif (is_string($acf_img)) {
                    $image_url = $acf_img;
                }
            }
        }

        // 4. Safe fallback placeholder
        if (empty($image_url)) {
            $image_url = function_exists('bads_get_placeholder_url')
                ? bads_get_placeholder_url('image')
                : get_template_directory_uri() . '/assets/images/placeholders/image.svg';
        }

        $news_items[] = [
            'id'      => $post_id,
            'title'   => get_the_title(),
            'date'    => get_the_date('d.m.Y'),
            'tag'     => 'Новости',
            'excerpt' => wp_trim_words(get_the_excerpt(), 12, '...'),
            'url'     => get_permalink(),
            'image'   => $image_url,
        ];
    }
    wp_reset_postdata();
}

// Store rendered IDs globally so other template parts (e.g. bottom "Other News" block) can avoid duplicates
$GLOBALS['bads_rendered_sidebar_news_ids'] = $rendered_ids;

// Fallbacks if DB has fewer posts
$placeholder_image = function_exists('bads_get_placeholder_url')
    ? bads_get_placeholder_url('image')
    : get_template_directory_uri() . '/assets/images/placeholders/image.svg';

if (count($news_items) < $news_count) {
    $fallback_news = [
        [
            'id'      => 0,
            'title'   => 'Открытие раннего бронирования сезона 2026 в санаториях Белокурихи',
            'date'    => '28.08.2026',
            'tag'     => 'Белокуриха',
            'excerpt' => 'Специальные условия и скидки до 15% на оздоровительные путевки и санаторно-курортные программы.',
            'url'     => home_url('/news/'),
            'image'   => $placeholder_image,
        ],
        [
            'id'      => 0,
            'title'   => 'МЧС России обновило регламент безопасности тургрупп на маршрутах Алтая',
            'date'    => '24.08.2026',
            'tag'     => 'Безопасность',
            'excerpt' => 'Все экскурсии и активные маршруты туроператора «Большой Алтай» проходят обязательную регистрацию.',
            'url'     => home_url('/news/'),
            'image'   => $placeholder_image,
        ],
        [
            'id'      => 0,
            'title'   => 'Новые экскурсионные программы по Чуйскому тракту и долинам рек',
            'date'    => '19.08.2026',
            'tag'     => 'Экспедиции',
            'excerpt' => 'Комфортные мини-группы, проверенные гиды-инструкторы и обновленный парк премиального транспорта.',
            'url'     => home_url('/news/'),
            'image'   => $placeholder_image,
        ],
    ];

    while (count($news_items) < $news_count && !empty($fallback_news)) {
        $news_items[] = array_shift($fallback_news);
    }
}

$aside_classes = [
    'bads-sidebar__aside',
];

if ($is_sticky) {
    $aside_classes[] = 'bads-sidebar__aside--sticky';
}

if (!empty($extra_class)) {
    $aside_classes[] = $extra_class;
}

$aside_class = implode(' ', $aside_classes);
?>

<aside class="<?= esc_attr($aside_class); ?>">
    <div class="bads-card bads-card--glass bads-card--radius-lg bads-card--padding-lg bads-hero__sidebar">
        
        <div class="bads-stack bads-stack--md">
            <!-- Sidebar Header: Title + Subscription Button -->
            <div class="bads-cluster bads-cluster--between bads-cluster--middle bads-hero__sidebar-header">
                <h3 class="bads-title bads-hero__sidebar-title"><?= esc_html($news_title); ?></h3>
                <?php if ($show_subscribe) : ?>
                    <?php
                    get_template_part(
                        'template-parts/ui/button',
                        null,
                        [
                            'type'          => 'button',
                            'variant'       => 'outline',
                            'size'          => 'xs',
                            'text'          => 'Подписаться',
                            'icon'          => 'communication/email',
                            'icon_position' => 'right',
                            'class'         => 'bads-hero__subscribe-btn',
                            'attrs'         => [
                                'data-modal-target'  => '#bads-news-subscribe-modal',
                                'data-modal-trigger' => true,
                            ],
                        ]
                    );
                    ?>
                <?php endif; ?>
            </div>

            <!-- 3:2 Ratio News Items Grid -->
            <div class="bads-hero__news-list">
                <?php foreach ($news_items as $item) : 
                    $item_id = $item['id'] ?? 0;
                ?>
                    <article class="bads-news-card">
                        <div class="bads-news-card__media">
                            <a href="<?= esc_url($item['url']); ?>" class="bads-news-card__img-link" tabindex="-1" aria-hidden="true">
                                <img 
                                    src="<?= esc_url($item['image']); ?>" 
                                    alt="<?= esc_attr($item['title']); ?>"
                                    loading="lazy"
                                    class="bads-news-card__img"
                                >
                            </a>
                            <div class="bads-card bads-news-card__card">
                                <h4 class="bads-news-card__title">
                                    <a href="<?= esc_url($item['url']); ?>" class="bads-news-card__title-link">
                                        <?= esc_html($item['title']); ?>
                                    </a>
                                </h4>
                                <div class="bads-news-card__action">
                                    <div class="bads-news-card__action-start">
                                        <?php
                                        get_template_part('template-parts/components/reactions', null, [
                                            'post_id' => $item_id,
                                            'title'   => $item['title'],
                                            'url'     => $item['url'],
                                            'size'    => 'sm',
                                        ]);
                                        ?>
                                    </div>
                                    <div class="bads-news-card__action-end">
                                        <?php
                                        get_template_part('template-parts/ui/button', null, [
                                            'text'          => 'Читать новость',
                                            'url'           => $item['url'],
                                            'type'          => 'link',
                                            'variant'       => 'link',
                                            'size'          => 'xs',
                                            'icon'          => 'navigation/arrow-right',
                                            'icon_size'     => 'xs',
                                            'icon_position' => 'right',
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Bottom Link: Все новости -->
        <div class="bads-hero__sidebar-footer">
            <?php
            get_template_part(
                'template-parts/ui/button',
                null,
                [
                    'type'          => 'link',
                    'variant'       => 'link',
                    'url'           => $news_all_url,
                    'text'          => 'Смотреть ещё',
                    'icon'          => 'navigation/arrow-right',
                    'icon_position' => 'right',
                    'class'         => 'bads-hero__news-more-link',
                ]
            );
            ?>
        </div>

    </div>
</aside>

<?php
// Render subscription modal once per request
static $bads_news_modal_rendered = false;
if (!$bads_news_modal_rendered && $show_subscribe) :
    $bads_news_modal_rendered = true;
    ob_start();
?>
<div class="bads-stack bads-stack--md">
    <form data-news-subscribe-form class="lead-form-main bads-stack bads-stack--md" id="bads-news-subscribe-form">
        <div class="bads-field">
            <?php
            get_template_part(
                'template-parts/ui/input',
                null,
                [
                    'id'          => 'news-sub-email',
                    'name'        => 'email',
                    'type'        => 'email',
                    'icon'        => 'email',
                    'size'        => 'md',
                    'radius'      => 'pill',
                    'placeholder' => 'Ваш email',
                    'required'    => true,
                    'aria_label'  => 'Email',
                ]
            );
            ?>
        </div>

        <?php
        get_template_part(
            'template-parts/components/privacy-agreement',
            null,
            [
                'id'       => 'news-sub-privacy',
                'name'     => 'privacy_agreement',
                'variant'  => 'multiline',
                'centered' => true,
                'required' => true,
            ]
        );
        ?>

        <div data-subscribe-feedback hidden></div>

        <?php
        get_template_part(
            'template-parts/ui/button',
            null,
            [
                'type'          => 'submit',
                'variant'       => 'primary',
                'size'          => 'md',
                'text'          => 'Подписаться на новости',
                'icon'          => 'communication/email',
                'icon_position' => 'right',
                'class'         => 'bads-btn--block lead-form-main__btn is-disabled',
                'attrs'         => [
                    'aria-disabled' => 'true',
                ],
            ]
        );
        ?>
    </form>

    <div data-subscribe-success hidden style="display: none; text-align: center; padding: var(--space-xl) var(--space-md);" class="bads-alert bads-alert--success bads-stack bads-stack--sm">
        <div style="font-size: 28px; line-height: 1;">✓</div>
        <div style="font-weight: 700; font-size: var(--font-size-h4); color: var(--color-text);">Спасибо! Вы успешно подписаны на наши новости!</div>
        <p style="margin: 0; font-size: var(--font-size-small); color: var(--color-text-muted);">
            Мы обещаем присылать только важные новости на указанный email.
        </p>
    </div>
</div>
<?php
    $modal_content = ob_get_clean();

    $render_modal_fn = static function () use ($modal_content) {
        get_template_part(
            'template-parts/ui/modal',
            null,
            [
                'id'       => 'bads-news-subscribe-modal',
                'title'    => 'Подписка<br>на новости',
                'subtitle' => 'Будьте в курсе наших новостей. <br>Оставьте свой адрес электронной почты.',
                'icon'     => 'news',
                'content'  => $modal_content,
                'size'     => 'sm',
            ]
        );
    };

    if (did_action('wp_footer')) {
        $render_modal_fn();
    } else {
        add_action('wp_footer', $render_modal_fn, 50);
    }
endif;
