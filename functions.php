<?php

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/enqueue/design-system.php';

require_once get_template_directory() . '/inc/ajax/ajax.php';
require_once get_template_directory() . '/inc/gallery/gallery-layout.php';
require_once get_template_directory() . '/inc/treatment/treatment-repository.php';
require_once get_template_directory() . '/inc/sanatoriums/query.php';
require_once get_template_directory() . '/inc/sanatoriums/data.php';
require_once get_template_directory() . '/inc/seeders/seed-directions.php';

add_action('wp_enqueue_scripts', 'theme_add_scripts');
function theme_add_scripts()
{
	// подключаем файл стилей темы
    wp_enqueue_style('style-css', get_template_directory_uri() . '/css/main.min.css?v=2.9');
    wp_enqueue_style('style-swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css');
    wp_enqueue_style('style-fancybox', get_template_directory_uri() . '/css/fancybox.css');
    wp_enqueue_style('style-accordion', get_template_directory_uri() . '/css/accordion.min.css');
	if (file_exists(get_template_directory() . '/assets/css/pages/front-page/hero.css')) {
		wp_enqueue_style('hero-css', get_template_directory_uri() . '/assets/css/pages/front-page/hero.css', array('style-css'), filemtime(get_template_directory() . '/assets/css/pages/front-page/hero.css'));
	}
	if (file_exists(get_template_directory() . '/assets/css/pages/front-page/hero-news.css')) {
		wp_enqueue_style('hero-news-css', get_template_directory_uri() . '/assets/css/pages/front-page/hero-news.css', array('style-css'), filemtime(get_template_directory() . '/assets/css/pages/front-page/hero-news.css'));
	}
	
	wp_enqueue_style(
    'mega-menu-css',
    get_template_directory_uri() . '/assets/css/mega-menu/mega-menu.css',
    [],
    filemtime(
        get_template_directory() . '/assets/css/mega-menu/mega-menu.css'
    )
);
	
	wp_enqueue_style(
    'messenger-button-css',

    get_template_directory_uri()
        . '/assets/css/components/messenger-button/messenger-button.css',
    [],
    filemtime(
        get_template_directory()
        . '/assets/css/components/messenger-button/messenger-button.css'
    )
);
	

    // подключаем js файл темы
    wp_enqueue_script('script-fancybox-lib', get_template_directory_uri() . '/js/fancybox.umd.js', array(), '1.0', true);
    wp_enqueue_script('script-swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '1.0', true);
    wp_enqueue_script('script-accordion', get_template_directory_uri() . '/js/accordion.min.js', array(), '1.0', true);
    wp_enqueue_script('script-js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
    wp_enqueue_script('jquery');
	if (file_exists(get_template_directory() . '/assets/js/pages/front-page/hero.js')) {
		wp_enqueue_script(
			'hero-js',
			get_template_directory_uri() . '/assets/js/pages/front-page/hero.js',
			[],
			filemtime(get_template_directory() . '/assets/js/pages/front-page/hero.js'),
			true
		);
	}
	wp_enqueue_script(
    'news-subscribe-js',
    get_template_directory_uri() . '/assets/js/news-subscribe.js',
    [],
    filemtime(
        get_template_directory()
        . '/assets/js/news-subscribe.js'
    ),
    true
);

wp_enqueue_script(
    'mega-menu-js',
    get_template_directory_uri() . '/assets/js/mega-menu/mega-menu.js',
    [],
    filemtime(
        get_template_directory() . '/assets/js/mega-menu/mega-menu.js'
    ),
    true
);

}
	

function jpeg_quality($arg)
{
    return (int)100;
}

add_filter('jpeg_quality', 'jpeg_quality');

add_theme_support('title-tag');

add_filter('excerpt_more', fn() => '...');
add_filter('excerpt_length', function () {
    return 13;
});

add_theme_support('post-thumbnails');
add_image_size('header', 1800, 1000, true);

//-----------------------------------------------------------------------------------------------------------
# Contact Form 7 выведен из использования: все живые формы темы работают напрямую
# через Bitrix24 REST (AJAX send_b24_lead). Мёртвый код CF7 (wpcf7_* фильтры,
# кастомная валидация custom_wpcf7_validate, JS-события wpcf7invalid/wpcf7mailsent) удалён.
//-----------------------------------------------------------------------------------------------------------

//-----------------------------------------------------------------------------------------------------------
# Добавляет SVG в список разрешенных для загрузки файлов.
add_filter('upload_mimes', 'svg_upload_allow');

function svg_upload_allow($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

// Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});

//news
add_action('init', 'news_register_post_type');

function news_register_post_type()
{
    $labels = array(
        'name' => 'Новости',
        'singular_name' => 'Новость',
        'menu_name' => 'Новости'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('news', $args);
}

//sanatorium
add_action('init', 'sanatorium_register_post_type');

function sanatorium_register_post_type()
{
    $labels = array(
        'name' => 'Санатории Белокурихи',
        'singular_name' => 'Санаторий',
        'menu_name' => 'Санатории'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('sanatorium', $args);
}

//rest belokurikha
add_action('init', 'rest_belokurikha_register_post_type');

function rest_belokurikha_register_post_type()
{
    $labels = array(
        'name' => 'Отдых в Белокурихе',
        'singular_name' => 'База отдыха в Белокурихе',
        'menu_name' => 'Отдых в Белокурихе'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('rest-belokurikha', $args);
}

//rest altai mountains
add_action('init', 'rest_altai_mountains_register_post_type');

function rest_altai_mountains_register_post_type()
{
    $labels = array(
        'name' => 'Отдых в Горном Алтае',
        'singular_name' => 'База отдыха в Горном Алтае',
        'menu_name' => 'Отдых в Горном Алтае'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('rest-altai-mountains', $args);
}

//numbers
add_action('init', 'numbers_register_post_type');

function numbers_register_post_type()
{
    $labels = array(
        'name' => 'Номера',
        'singular_name' => 'Номер',
        'menu_name' => 'Номера'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('numbers', $args);
}


//putevki
add_action('init', 'putevki_register_post_type');

function putevki_register_post_type()
{
    $labels = array(
        'name' => 'Путевки',
        'singular_name' => 'Путевка',
        'menu_name' => 'Путевки'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('putevki', $args);
}




// treatments
add_action('init', 'treatments_register_post_type');

function treatments_register_post_type()
{
    $labels = array(
        'name' => 'Виды лечения',
        'singular_name' => 'Вид лечения',
        'menu_name' => 'Виды лечения'
    );

    $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'has_archive'        => true,
		'rewrite'            => array(
			'slug'       => 'treatments',
			'with_front' => false,
		),
		'menu_icon'          => 'dashicons-heart',
		'menu_position'      => 2,
		'supports'           => array(
			'title',
			'editor',
		),
		'show_in_rest'       => true,
	);

    register_post_type('treatments', $args);
}

//excursions
add_action('init', 'excursions_register_post_type');

function excursions_register_post_type()
{
    $labels = array(
        'name' => 'Экскурсии',
        'singular_name' => 'Экскурсия',
        'menu_name' => 'Экскурсии'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('excursions', $args);
}

//tours
add_action('init', 'tours_register_post_type');

function tours_register_post_type()
{
    $labels = array(
        'name' => 'Туры на Алтай',
        'singular_name' => 'Тур',
        'menu_name' => 'Туры'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-email-alt2',
        'menu_position' => 2,
        'supports' => array('title', 'editor')
    );

    register_post_type('tours', $args);
}

// Добавляем колонку на странице списка номеров
function custom_acf_column_for_custom_post_type($columns)
{
    $columns['acf_field'] = 'Санаторий';
    return $columns;
}

add_filter('manage_edit-numbers_columns', 'custom_acf_column_for_custom_post_type');

function custom_acf_column_content_for_custom_post_type($column, $post_id)
{
    if ('acf_field' === $column) {
        $post_object = get_field('number_sanatorium', $post_id);
        if ($post_object) {
            echo get_the_title($post_object);
        } else {
            echo '—';
        }
    }
}

add_action('manage_numbers_posts_custom_column', 'custom_acf_column_content_for_custom_post_type', 10, 2);

function custom_acf_column_sortable($sortable_columns)
{
    $sortable_columns['acf_field'] = 'acf_field';
    return $sortable_columns;
}

add_filter('manage_edit-numbers_sortable_columns', 'custom_acf_column_sortable');

function custom_acf_column_orderby($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('acf_field' === $orderby) {
        $query->set('meta_key', 'number_sanatorium');
        $query->set('orderby', 'meta_value_num');
    }
}

add_action('pre_get_posts', 'custom_acf_column_orderby');

// Добавляем колонку на странице списка лечений
function custom_acf_column_for_other_post_type($columns)
{
    $columns['acf_field_other'] = 'Другое поле';
    return $columns;
}

add_filter('manage_edit-treatments_columns', 'custom_acf_column_for_other_post_type');

function custom_acf_column_content_for_other_post_type($column, $post_id)
{
    if ('acf_field_other' === $column) {
        $post_object = get_field('treatments_sanatorium', $post_id); // Замените 'other_field' на ключ вашего другого поля
        if ($post_object) {
            echo get_the_title($post_object);
        } else {
            echo '—';
        }
    }
}

add_action('manage_treatments_posts_custom_column', 'custom_acf_column_content_for_other_post_type', 10, 2);

function custom_acf_column_sortable_other($sortable_columns)
{
    $sortable_columns['acf_field_other'] = 'acf_field_other';
    return $sortable_columns;
}

add_filter('manage_edit-treatments_sortable_columns', 'custom_acf_column_sortable_other');

function custom_acf_column_orderby_other($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    $orderby = $query->get('orderby');

    if ('acf_field_other' === $orderby) {
        $query->set('meta_key', 'treatments_sanatorium'); // Замените 'other_field' на ключ вашего другого поля
        $query->set('orderby', 'meta_value_num');
    }
}

add_action('pre_get_posts', 'custom_acf_column_orderby_other');

// Фильтр
require get_template_directory() . '/components/filter.php';

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Контент',
        'menu_title'    => 'Контент на сайте',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}

// AJAX подгрузка новостей
add_action('wp_ajax_load_more_news', 'load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'load_more_news');

function load_more_news() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $query_args = array(
            'post_type' => 'news',
            'posts_per_page' => 9,
            'post_status' => 'publish',
            'paged' => $page,
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content/news', get_post_format());
        }
    }

    wp_die();
}

/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * News Interactions: Likes & Views AJAX
 * ============================================================================
 */
add_action('wp_ajax_bads_toggle_like', 'bads_handle_toggle_like');
add_action('wp_ajax_nopriv_bads_toggle_like', 'bads_handle_toggle_like');

function bads_handle_toggle_like() {
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $toggle_action = isset($_POST['toggle_action']) ? sanitize_key($_POST['toggle_action']) : 'like';

    if (!$post_id || get_post_type($post_id) !== 'news') {
        wp_send_json_error(['message' => 'Invalid post ID']);
    }

    $current_likes = (int) get_post_meta($post_id, '_bads_likes_count', true);

    if ($toggle_action === 'like') {
        $current_likes++;
    } else {
        $current_likes = max(0, $current_likes - 1);
    }

    update_post_meta($post_id, '_bads_likes_count', $current_likes);

    wp_send_json_success([
        'post_id' => $post_id,
        'count'   => $current_likes,
        'action'  => $toggle_action,
    ]);
}

/**
 * Helper function to track and get views for a news item
 */
function bads_get_news_views($post_id) {
    $views = (int) get_post_meta($post_id, '_bads_views_count', true);
    return $views;
}

function bads_get_news_likes($post_id) {
    $likes = (int) get_post_meta($post_id, '_bads_likes_count', true);
    return $likes;
}

/**
 * Helper function to retrieve and optionally isolate the lead paragraph for news posts.
 * Sources in priority order:
 * 1. ACF custom field ('lead' or 'news_lead' or 'subtitle')
 * 2. Explicit post excerpt (if manual)
 * 3. First introductory italicized paragraph (<em>, <i>, or .lead) inside the post content.
 *
 * @param int|WP_Post|null $post Post ID or WP_Post object.
 * @param bool $extract_from_body Whether to extract and remove the lead from body content if matched in content.
 * @return array ['lead' => string, 'content' => string]
 */
function bads_get_news_lead($post = null, $extract_from_body = false) {
    $post = get_post($post);
    if (!$post) {
        return ['lead' => '', 'content' => ''];
    }

    $raw_content = $post->post_content;
    $lead = '';

    // 1. ACF field check
    if (function_exists('get_field')) {
        $acf_lead = get_field('lead', $post->ID) ?: get_field('news_lead', $post->ID);
        if (empty($acf_lead)) {
            $acf_lead = get_field('subtitle', $post->ID);
        }
        if (!empty($acf_lead) && is_string($acf_lead)) {
            $lead = trim(strip_tags($acf_lead));
        }
    }

    // 2. Explicit post excerpt check
    if (empty($lead) && !empty($post->post_excerpt)) {
        $lead = trim(strip_tags($post->post_excerpt));
    }

    // 3. Extract from content if first block is italicized (<em>, <i>, or .lead)
    if (empty($lead) && !empty($raw_content)) {
        // Pattern 1: paragraph with <em> or <i>
        $pattern_em = '/^(\s*(?:<div[^>]*>\s*)*)<p[^>]*>\s*<(?:em|i)[^>]*>(.*?)<\/(?:em|i)>\s*<\/p>/us';
        if (preg_match($pattern_em, $raw_content, $matches)) {
            $lead = trim(strip_tags($matches[2]));
            if ($extract_from_body) {
                $raw_content = preg_replace($pattern_em, '$1', $raw_content, 1);
            }
        } else {
            // Pattern 2: paragraph with class "lead"
            $pattern_lead = '/^(\s*(?:<div[^>]*>\s*)*)<p[^>]*class=[\'"][^\'"]*lead[^\'"]*[\'"][^>]*>(.*?)<\/p>/us';
            if (preg_match($pattern_lead, $raw_content, $matches)) {
                $lead = trim(strip_tags($matches[2]));
                if ($extract_from_body) {
                    $raw_content = preg_replace($pattern_lead, '$1', $raw_content, 1);
                }
            }
        }
    }

    return [
        'lead'    => $lead,
        'content' => $raw_content,
    ];
}

//---------------------------------------------------------------------------------

class CustomEditorButtons {
    private $buttons = [];
    private $styles = [];
    private $js_file;

    public function __construct() {
        $this->js_file = get_template_directory() . '/js/editor-buttons.js';
        add_action('admin_init', [$this, 'init']);
        add_action('admin_head', [$this, 'admin_styles']);
        add_action('wp_head', [$this, 'frontend_styles']);
    }

    public function add_button($slug, $label, $tag = 'span', $class = '', $wrapper = true) {
        $this->buttons[$slug] = [
            'label' => $label,
            'tag' => $tag,
            'class' => $class,
            'wrapper' => $wrapper
        ];

        add_shortcode($slug, function($atts, $content = null) use ($slug, $tag, $class) {
            $atts = shortcode_atts(['type' => ''], $atts, $slug);
            $classes = trim('custom-format ' . $slug . ' ' . $class . ' ' . $atts['type']);
            return '<' . $tag . ' class="' . esc_attr($classes) . '">' . do_shortcode($content) . '</' . $tag . '>';
        });
    }

    public function add_style($selector, $css) {
        $this->styles[$selector] = $css;
    }

    public function init() {
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;

        add_filter('mce_external_plugins', [$this, 'add_tinymce_plugin']);
        add_filter('mce_buttons', [$this, 'register_buttons']);

        if (!file_exists(dirname($this->js_file))) {
            mkdir(dirname($this->js_file), 0755, true);
        }

        if (!file_exists($this->js_file) || $this->js_needs_update()) {
            $this->create_js_file();
        }
    }

    private function js_needs_update() {
        if (!file_exists($this->js_file)) return true;
        $js_content = file_get_contents($this->js_file);
        foreach ($this->buttons as $slug => $button) {
            if (strpos($js_content, "'" . $slug . "'") === false) return true;
        }
        return false;
    }

    private function create_js_file() {
        $js_buttons = [];
        foreach ($this->buttons as $slug => $button) {
            $js_buttons[$slug] = [
                'label' => $button['label'],
                'tag' => $button['tag'],
                'class' => 'custom-format ' . $slug . ' ' . $button['class']
            ];
        }

        $js_content = 'tinymce.PluginManager.add("custombuttons",function(e,t){';
        $js_content .= 'var btns=' . json_encode($js_buttons) . ';';
        $js_content .= 'Object.keys(btns).forEach(function(slug){';
        $js_content .= 'e.addButton(slug,{text:btns[slug].label,tooltip:btns[slug].label,';
        $js_content .= 'onclick:function(){var n=e.selection.getContent({format:"html"});';
        $js_content .= 'if(n){e.selection.setContent("<"+btns[slug].tag+" class=\""+btns[slug].class+"\">"+n+"</"+btns[slug].tag+">")}';
        $js_content .= 'else{e.insertContent("<"+btns[slug].tag+" class=\""+btns[slug].class+"\">текст</"+btns[slug].tag+">")}}})})});';

        file_put_contents($this->js_file, $js_content);
    }

    public function add_tinymce_plugin($plugins) {
        $plugins['custombuttons'] = get_template_directory_uri() . '/js/editor-buttons.js';
        return $plugins;
    }

    public function register_buttons($buttons) {
        return array_merge($buttons, array_keys($this->buttons));
    }

    public function admin_styles() {
        echo '<style>';
        echo '.mce-content-body .custom-format{background:#fff9c4!important;padding:2px 6px!important;border-radius:3px!important;border-left:3px solid #ff9800!important;font-weight:600!important}';
        echo '</style>';
    }

    public function frontend_styles() {
        if (empty($this->styles)) return;

        echo '<style>';
        foreach ($this->styles as $selector => $css) {
            echo $selector . '{' . $css . '}';
        }
        echo '</style>';
    }
}

$editor_buttons = new CustomEditorButtons();

$editor_buttons->add_button('highlight', '🌟 Выделить', 'span', 'highlight-main');

$editor_buttons->add_style('.custom-format.highlight-main',
    'background: #ffe1bfff !important;
    //  border-top:2px solid #2196f3!important;
     padding:8px 12px!important;
     margin:5px 0!important;
     border-radius:5px!important');

$editor_buttons->add_style('.custom-format',
    'display:inline-block;
     transition:all 0.2s ease;
     box-shadow:0 1px 3px rgba(0,0,0,0.1)');



function add_custom_styles_to_tinymce($mce_css) {
    $custom_css = get_stylesheet_directory_uri() . '/css/editor-content.css';

    if (!empty($mce_css)) {
        $mce_css .= ',';
    }
    $mce_css .= $custom_css;

    return $mce_css;
}
add_filter('mce_css', 'add_custom_styles_to_tinymce');

//----------------------------------------------------------------------------------------

class FAQ_TinyMCE_Simple {

    public function __construct() {
        add_action('admin_init', [$this, 'init']);
        add_filter('the_content', [$this, 'process_faq_output'], 20);
    }

    public function init() {
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        if (get_user_option('rich_editing') == 'true') {
            $this->create_mce_js();
            add_filter('mce_external_plugins', [$this, 'add_tinymce_plugin']);
            add_filter('mce_buttons', [$this, 'add_tinymce_button']);
        }

        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
    }

    public function add_tinymce_plugin($plugins) {
        $plugins['faq_simple'] = get_template_directory_uri() . '/js/faq-simple.js?v=' . time();
        return $plugins;
    }

    public function add_tinymce_button($buttons) {
        array_push($buttons, 'faq_simple');
        return $buttons;
    }

    public function enqueue_admin_styles() {
        wp_add_inline_style('wp-admin', '
            .wp-faq-item {
                border: 1px dashed #ccc;
                margin: 10px 0;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 4px;
            }
            .wp-faq-question {
                font-weight: bold;
                margin-bottom: 10px;
                color: #333;
            }
            .wp-faq-answer {
                color: #555;
            }
        ');
    }

    public function create_mce_js() {
        $js_path = get_template_directory() . '/js/faq-simple.js';
        $js_dir = dirname($js_path);

        if (!file_exists($js_dir)) {
            mkdir($js_dir, 0755, true);
        }

        if (file_exists($js_path)) {
            unlink($js_path);
        }

        $js_content = <<<'JS'
(function() {
    tinymce.PluginManager.add('faq_simple', function(editor, url) {
        editor.addButton('faq_simple', {
            text: 'FAQ',
            icon: false,
            tooltip: 'Добавить вопрос FAQ',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Добавить вопрос FAQ',
                    body: [
                        {
                            type: 'textbox',
                            name: 'question',
                            label: 'Вопрос',
                            value: ''
                        },
                        {
                            type: 'textbox',
                            name: 'answer',
                            label: 'Ответ',
                            multiline: true,
                            minHeight: 120,
                            value: ''
                        },
                        {
                            type: 'checkbox',
                            name: 'expanded',
                            label: 'Развернут по умолчанию',
                            checked: false
                        }
                    ],
                    onsubmit: function(e) {
                        var question = e.data.question.trim();
                        var answer = e.data.answer.trim();
                        var expanded = e.data.expanded;

                        if (!question) question = 'Ваш вопрос?';
                        if (!answer) answer = 'Ваш ответ...';

                        var faqHTML;
                        if (expanded) {
                            faqHTML =
                                '<div class="wp-faq-item wp-faq-item-expanded" data-mce-style="border: 1px dashed #ccc; margin: 10px 0; padding: 15px; background: #f9f9f9; border-radius: 4px;">' +
                                '<div class="wp-faq-question" data-mce-style="font-weight: bold; margin-bottom: 10px; color: #333;">' + question + '</div>' +
                                '<div class="wp-faq-answer" data-mce-style="color: #555;">' + answer + '</div>' +
                                '</div>';
                        } else {
                            faqHTML =
                                '<div class="wp-faq-item" data-mce-style="border: 1px dashed #ccc; margin: 10px 0; padding: 15px; background: #f9f9f9; border-radius: 4px;">' +
                                '<div class="wp-faq-question" data-mce-style="font-weight: bold; margin-bottom: 10px; color: #333;">' + question + '</div>' +
                                '<div class="wp-faq-answer" data-mce-style="color: #555;">' + answer + '</div>' +
                                '</div>';
                        }

                        editor.insertContent(faqHTML);
                    }
                });
            }
        });
    });
})();
JS;

        file_put_contents($js_path, $js_content);
    }

    public function process_faq_output($content) {
        if (empty($content) || strpos($content, 'wp-faq-item') === false) {
            return $content;
        }

        $pattern_expanded = '/<div\s+class="wp-faq-item\s+wp-faq-item-expanded"[^>]*>.*?<div\s+class="wp-faq-question"[^>]*>(.*?)<\/div>.*?<div\s+class="wp-faq-answer"[^>]*>(.*?)<\/div>.*?<\/div>/is';

        $replacement_expanded = '
        <div class="faq-item">
            <div class="faq-question active">
                <h3>$1</h3>
                <span class="faq-icon">
                    <span class="faq-plus">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect></rect> <path d="M12 6V18" stroke="#171717" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 12H18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>
                    <span class="faq-minus">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect></rect> <path d="M6 12H18" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>
                </span>
            </div>
            <div class="faq-answer" style="display: block;">
                <div class="faq-content">$2</div>
            </div>
        </div>';

        $content = preg_replace($pattern_expanded, $replacement_expanded, $content);

        $pattern_regular = '/<div\s+class="wp-faq-item"[^>]*>.*?<div\s+class="wp-faq-question"[^>]*>(.*?)<\/div>.*?<div\s+class="wp-faq-answer"[^>]*>(.*?)<\/div>.*?<\/div>/is';

        $replacement_regular = '
        <div class="faq-item">
            <div class="faq-question">
                <h3>$1</h3>
                <span class="faq-icon">
                    <span class="faq-plus">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect></rect> <path d="M12 6V18" stroke="#171717" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 12H18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>
                    <span class="faq-minus">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect></rect> <path d="M6 12H18" stroke="#171717" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </span>
                </span>
            </div>
            <div class="faq-answer">
                <div class="faq-content">$2</div>
            </div>
        </div>';

        $content = preg_replace($pattern_regular, $replacement_regular, $content);

        if (strpos($content, 'faq-item') !== false) {
            $content = '<div class="faq-container"><div class="faq-items">' . $content . '</div></div>';
        }

        return $content;
    }
}

new FAQ_TinyMCE_Simple();

add_action('wp_head', function() {
    ?>
    <style>
        .faq-container {

        }

        .faq-items {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .faq-item {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            overflow: hidden;
            border: 1px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 6px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .faq-question {
            padding: 24px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: #fff;
            transition: background-color 0.3s;
            position: relative;
        }

        .faq-question:hover {
            background-color: #fafafa;
        }

        .faq-question.active {
            background-color: #f8f9fa;
        }

        .faq-question h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            flex: 1;
            padding-right: 40px;
            line-height: 1.4;
        }

        .faq-icon {
            position: relative;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            border-radius: 50%;
            transition: all 0.3s;
        }

        .faq-question:hover .faq-icon {
            background: #00A0E3;
        }

        .faq-question.active .faq-icon {
            background: #00A0E3;
        }

        .faq-plus, .faq-minus {
            position: absolute;
            transition: all 0.3s;
            font-size: 20px;
            color: #666;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .faq-question:hover .faq-plus,
        .faq-question:hover .faq-minus {
            color: white;
        }

        .faq-question.active .faq-plus,
        .faq-question.active .faq-minus {
            color: white;
        }

        .faq-plus {
            opacity: 1;
        }

        .faq-minus {
            opacity: 0;
            transform: rotate(90deg);
        }

        .faq-question.active .faq-plus {
            opacity: 0;
            transform: rotate(90deg);
        }

        .faq-question.active .faq-minus {
            opacity: 1;
            transform: rotate(0);
        }

        .faq-answer {
            display: none;
            padding: 0 30px;
            border-top: 1px solid #f0f0f0;
            overflow: hidden;
        }

        .faq-question.active + .faq-answer {
            display: block;
        }

        .faq-content {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
            padding: 24px 0;
        }

        .faq-content p {
            margin: 0 0 15px 0;
        }

        .faq-content p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .faq-container {
                margin: 20px auto;
            }

            .faq-question {
                padding: 18px 20px;
            }

            .faq-question h3 {
                font-size: 16px;
                padding-right: 35px;
            }

            .faq-content {
                padding: 18px 0;
                font-size: 15px;
            }

            .faq-answer {
                padding: 0 20px;
            }
        }
    </style>
    <?php
}, 999);

add_action('wp_footer', function() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function initFAQ() {
            document.querySelectorAll('.faq-question').forEach(function(question) {
                if (question.classList.contains('faq-initialized')) return;

                question.classList.add('faq-initialized');

                question.addEventListener('click', function() {
                    const isActive = this.classList.contains('active');
                    const container = this.closest('.faq-items');

                    if (container) {
                        container.querySelectorAll('.faq-question.active').forEach(function(activeQuestion) {
                            if (activeQuestion !== this) {
                                activeQuestion.classList.remove('active');
                                const answer = activeQuestion.nextElementSibling;
                                if (answer) {
                                    answer.style.display = 'none';
                                }
                            }
                        }.bind(this));
                    }

                    this.classList.toggle('active');
                    const answer = this.nextElementSibling;

                    if (answer) {
                        if (this.classList.contains('active')) {
                            answer.style.display = 'block';
                        } else {
                            answer.style.display = 'none';
                        }
                    }
                });
            });
        }

        initFAQ();

        if (typeof MutationObserver !== 'undefined') {
            const observer = new MutationObserver(function(mutations) {
                let shouldReinit = false;
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList') {
                        mutation.addedNodes.forEach(function(node) {
                            if (node.nodeType === 1 && node.querySelector && node.querySelector('.wp-faq-item, .faq-item')) {
                                shouldReinit = true;
                            }
                        });
                    }
                });

                if (shouldReinit) {
                    setTimeout(initFAQ, 100);
                }
            });

            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }
    });
    </script>
    <?php
});


// Добавляем ID санатория к названию лечебного профиля в списке выбора
add_filter('acf/fields/post_object/result', 'custom_post_object_result', 10, 4);
function custom_post_object_result($text, $post, $field, $post_id) {
    // Получаем ID санатория, связанного с этим лечебным профилем
    $sanatorium_id = get_field('treatments_sanatorium', $post->ID); // замените на ваше поле связи

    if ($sanatorium_id) {
        $sanatorium_title = get_the_title($sanatorium_id);
        $text .= ' (' . $sanatorium_title . ')';
    }

    return $text;
}

// Про формы 27-05-26
// AJAX Bitrix24 форма

add_action('wp_ajax_send_b24_lead', 'send_b24_lead');
add_action('wp_ajax_nopriv_send_b24_lead', 'send_b24_lead');

function send_b24_lead() {

    $name         = sanitize_text_field($_POST['name'] ?? '');
    $phone        = sanitize_text_field($_POST['phone'] ?? '');
    $email        = sanitize_email($_POST['email'] ?? '');
    $channel      = sanitize_text_field($_POST['channel'] ?? '');
    $comment_text = sanitize_textarea_field($_POST['comment'] ?? $_POST['message'] ?? '');
    $page         = esc_url_raw($_POST['page'] ?? '');
    $page_title   = sanitize_text_field($_POST['page_title'] ?? '');
    $page_path    = sanitize_text_field($_POST['page_path'] ?? '');
    $form_title   = sanitize_text_field($_POST['form_title'] ?? '');
    $form_id      = sanitize_text_field($_POST['form_id'] ?? '');
    $referrer     = esc_url_raw($_POST['referrer'] ?? '');
    $direction    = sanitize_text_field($_POST['direction'] ?? '');
    $date         = sanitize_text_field($_POST['date'] ?? '');
    $persons      = sanitize_text_field($_POST['persons'] ?? '');
    $duration     = sanitize_text_field($_POST['duration'] ?? '');

    // Fallback для адреса страницы
    if (empty($page)) {
        $page = !empty($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url();
    }

    $raw_utm = $_POST['utm'] ?? '{}';
    $utm = is_array($raw_utm) ? $raw_utm : json_decode(stripslashes($raw_utm), true);
    if (!is_array($utm)) {
        $utm = [];
    }

    $utm_source   = sanitize_text_field($utm['source'] ?? $_POST['utm_source'] ?? '');
    $utm_medium   = sanitize_text_field($utm['medium'] ?? $_POST['utm_medium'] ?? '');
    $utm_campaign = sanitize_text_field($utm['campaign'] ?? $_POST['utm_campaign'] ?? '');
    $utm_content  = sanitize_text_field($utm['content'] ?? $_POST['utm_content'] ?? '');
    $utm_term     = sanitize_text_field($utm['term'] ?? $_POST['utm_term'] ?? '');

    // Валидация: должен быть указан либо телефон, либо email, либо обращение через MAX
    if (!$phone && !$email && $channel !== 'max' && $channel !== 'chat' && $channel !== 'Чат MAX') {
        wp_send_json_error('Заполните контактные данные');
    }

    // ТВОЙ WEBHOOK https://bolshoyaltay.bitrix24.ru/rest/52/fj2psswcrggsqg45 - ГАЛЯ https://bolshoyaltay.bitrix24.ru/rest/1292/3xbygdj1rqq3isz4 - РОМА 
    $webhook = 'https://bolshoyaltay.bitrix24.ru/rest/52/fj2psswcrggsqg45';

    // =====================================
    // СОЗДАЕМ ЛИД
    // =====================================

    $contactLabel = !empty($phone) ? $phone : (!empty($email) ? $email : 'Чат MAX');
    
    // Определение контекста страницы / заголовка
    if (is_front_page() || $page === home_url('/') || $page === home_url() || $form_id === 'hero-booking') {
        $pageContext = 'Главная - модуль бронирования';
    } else {
        $pageContext = !empty($page_title) ? $page_title : (!empty($form_title) ? $form_title : 'Страница сайта');
    }

    // Очищаем заголовок страницы от суффикса названия компании, чтобы не перегружать заголовок лида в Битрикс24
    $pageContext = preg_replace('/[\s\-\|—–]+Туроператор Большой Алтай$/iu', '', $pageContext);
    $pageContext = trim($pageContext);

    // Формирование заголовка лида:
    // Если имя есть: "Имя | Телефон - Заявка с сайта - Заголовок"
    // Если имени нет: "Телефон - Заявка с сайта - Заголовок"
    if (!empty($name)) {
        $leadTitle = $name . ' | ' . $contactLabel . ' — Заявка с сайта — ' . $pageContext;
    } else {
        $leadTitle = $contactLabel . ' — Заявка с сайта — ' . $pageContext;
    }

    $leadFields = [
        'TITLE'              => $leadTitle,
        'SOURCE_ID'          => 'WEB',
        'SOURCE_DESCRIPTION' => $page,
    ];

    if (!empty($name)) {
        $leadFields['NAME'] = $name;
    }

    if (!empty($utm_source)) {
        $leadFields['UTM_SOURCE'] = $utm_source;
    }
    if (!empty($utm_medium)) {
        $leadFields['UTM_MEDIUM'] = $utm_medium;
    }
    if (!empty($utm_campaign)) {
        $leadFields['UTM_CAMPAIGN'] = $utm_campaign;
    }
    if (!empty($utm_content)) {
        $leadFields['UTM_CONTENT'] = $utm_content;
    }
    if (!empty($utm_term)) {
        $leadFields['UTM_TERM'] = $utm_term;
    }

    if (!empty($phone)) {
        $leadFields['PHONE'] = [
            [
                'VALUE'      => $phone,
                'VALUE_TYPE' => 'WORK'
            ]
        ];
    }

    if (!empty($email)) {
        $leadFields['EMAIL'] = [
            [
                'VALUE'      => $email,
                'VALUE_TYPE' => 'WORK'
            ]
        ];
    }

    $leadData = [
        'fields' => $leadFields
    ];

    $response = wp_remote_post(
        $webhook . '/crm.lead.add.json',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body'    => json_encode($leadData),
            'timeout' => 20
        ]
    );

    if (is_wp_error($response)) {
        wp_send_json_error('Ошибка подключения к CRM');
    }

    $body = json_decode(
        wp_remote_retrieve_body($response),
        true
    );

    $leadId = $body['result'] ?? 0;

    if (!$leadId) {
        wp_send_json_error('Не удалось создать лид');
    }

    // =====================================
    // СОЗДАЕМ КОММЕНТАРИЙ В TIMELINE      |
    // =====================================

    $comment = "📌 ДЕТАЛИ ЗАЯВКИ С САЙТА\n";
    $comment .= "----------------------------------------\n";

    if (!empty($name)) {
        $comment .= "👤 Имя: {$name}\n";
    }

    if (!empty($phone)) {
        $comment .= "📞 Телефон: {$phone}\n";
    }

    if (!empty($email)) {
        $comment .= "📧 Email: {$email}\n";
    }

    if (!empty($channel)) {
        $channel_labels = [
            'phone' => 'Телефон',
            'email' => 'Email',
            'max'   => 'Чат MAX',
            'chat'  => 'Чат MAX',
        ];
        $channel_display = $channel_labels[$channel] ?? $channel;
        $comment .= "💬 Канал связи: {$channel_display}\n";
    }

    if (!empty($direction)) {
        $comment .= "🏔 Направление / Курорт: {$direction}\n";
    }

    if (!empty($date)) {
        $comment .= "📅 Дата заезда: {$date}\n";
    }

    if (!empty($duration)) {
        $comment .= "⏳ Длительность: {$duration}\n";
    }

    if (!empty($persons)) {
        $comment .= "👥 Количество человек: {$persons}\n";
    }

    if (!empty($comment_text)) {
        $comment .= "📝 Комментарий / Пожелания: {$comment_text}\n";
    }

    $comment .= "\n----------------------------------------\n";
    $comment .= "📍 СТРАНИЦА И ИСТОЧНИК\n";
    $comment .= "----------------------------------------\n";

    $comment .= "📄 Страница: {$pageContext}\n";
    $comment .= "🌐 URL: {$page}\n";

    if (!empty($form_title) || !empty($form_id)) {
        $fName = !empty($form_title) ? $form_title : $form_id;
        $comment .= "📋 Форма: {$fName}\n";
    }

    if (!empty($referrer) && $referrer !== $page) {
        $comment .= "🔗 Реферер: {$referrer}\n";
    }

    $comment .= "\n----------------------------------------\n";

    $has_utm = !empty($utm_source) || !empty($utm_medium) || !empty($utm_campaign) || !empty($utm_content) || !empty($utm_term);

    if ($has_utm) {
        $comment .= "🎯 UTM МЕТКИ\n";
        $comment .= "----------------------------------------\n";
        if (!empty($utm_source))   $comment .= "• Источник (utm_source): {$utm_source}\n";
        if (!empty($utm_medium))   $comment .= "• Канал (utm_medium): {$utm_medium}\n";
        if (!empty($utm_campaign)) $comment .= "• Кампания (utm_campaign): {$utm_campaign}\n";
        if (!empty($utm_content))  $comment .= "• Содержание (utm_content): {$utm_content}\n";
        if (!empty($utm_term))     $comment .= "• Ключевое слово (utm_term): {$utm_term}\n";
        $comment .= "----------------------------------------\n";
    } else {
        $comment .= "🎯 UTM метки: отсутствуют (прямой заход / органика)\n";
        $comment .= "----------------------------------------\n";
    }

    $comment .= "🕒 Время заявки: " . current_time('d.m.Y H:i:s') . " (МСК)";

    // =====================================
    // ОТПРАВЛЯЕМ КОММЕНТАРИЙ
    // =====================================

    wp_remote_post(
        $webhook . '/crm.timeline.comment.add.json',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'fields' => [
                    'ENTITY_ID' => $leadId,
                    'ENTITY_TYPE' => 'lead',
                    'COMMENT' => $comment
                ]
            ]),
            'timeout' => 20
        ]
    );

    wp_send_json_success();

}

function big_altay_enqueue_b24_form_assets() {

    wp_enqueue_style(
        'b24-form-style',
        get_template_directory_uri() . '/assets/css/b24-form.css',
        [],
        filemtime(get_template_directory() . '/assets/css/b24-form.css')
    );

    wp_enqueue_script(
        'b24-form-script',
        get_template_directory_uri() . '/assets/js/b24-form.js',
        [],
        filemtime(get_template_directory() . '/assets/js/b24-form.js'),
        true
    );
}

add_action('wp_enqueue_scripts', 'big_altay_enqueue_b24_form_assets');

add_action(
    'wp_ajax_send_b24_news_subscriber',
    'send_b24_news_subscriber'
);

add_action(
    'wp_ajax_nopriv_send_b24_news_subscriber',
    'send_b24_news_subscriber'
);


/*
-----------------------------------------------------------------------------|
ПОДПИСКА НА НОВОСТИ
-----------------------------------------------------------------------------|
*/

function send_b24_news_subscriber() {

    $name = sanitize_text_field(
        $_POST['name'] ?? ''
    );

    $email = sanitize_email(
        $_POST['email'] ?? ''
    );

    if (
        empty($email)
        || !is_email($email)
    ) {

        wp_send_json_error(
            'Введите корректный email'
        );

    }

    $webhook =
        'https://bolshoyaltay.bitrix24.ru/rest/1292/3xbygdj1rqq3isz4';

    /*
    ===================================
    Проверяем дубль по email
    ===================================
    */

    $duplicateResponse = wp_remote_post(
        $webhook . '/crm.duplicate.findbycomm.json',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'type'   => 'EMAIL',
                'values' => [$email]
            ]),
            'timeout' => 20
        ]
    );

    if (!is_wp_error($duplicateResponse)) {

        $duplicateBody = json_decode(
            wp_remote_retrieve_body(
                $duplicateResponse
            ),
            true
        );

        if (
            !empty(
                $duplicateBody['result']['CONTACT']
            )
        ) {

            wp_send_json_success([
                'message' =>
                    'Спасибо! Подписка активна.'
            ]);

        }

    }

    /*
    ===================================
    Создаем контакт
    ===================================
    */

    $contactResponse = wp_remote_post(
        $webhook . '/crm.contact.add.json',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'fields' => [

                    'NAME' =>
                        !empty($name)
                            ? $name
                            : 'Подписчик сайта',

                    'SOURCE_ID' =>
                        'WEB',

                    'TYPE_ID' =>
                        'CLIENT',

                    'EMAIL' => [
                        [
                            'VALUE' => $email,
                            'VALUE_TYPE' => 'WORK'
                        ]
                    ]

                ]
            ]),
            'timeout' => 20
        ]
    );

    if (
        is_wp_error($contactResponse)
    ) {

        wp_send_json_error(
            'Ошибка подключения к CRM'
        );

    }

    $contactBody = json_decode(
        wp_remote_retrieve_body(
            $contactResponse
        ),
        true
    );

    $contactId =
        $contactBody['result'] ?? 0;

    if (!$contactId) {

        wp_send_json_error(
            'Не удалось создать контакт'
        );

    }

    /*
    ===================================
    Комментарий в таймлайн
    ===================================
    */

    $comment =
        "Подписка на новости сайта Big Altay\n\n";

    if (!empty($name)) {

        $comment .=
            "Имя: {$name}\n";

    }

    $comment .=
        "Email: {$email}\n";

    $comment .=
        "Дата: "
        . current_time('d.m.Y H:i');

    wp_remote_post(
        $webhook . '/crm.timeline.comment.add.json',
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'fields' => [

                    'ENTITY_ID' =>
                        $contactId,

                    'ENTITY_TYPE' =>
                        'contact',

                    'COMMENT' =>
                        $comment

                ]
            ]),
            'timeout' => 20
        ]
    );

    wp_send_json_success([
        'message' =>
            'Спасибо за подписку!'
    ]);

}

require_once get_template_directory() . '/inc/news/importer/news-importer.php';


/**
 * Акции новые
 */
add_action('init', 'register_promotions_post_type');

function register_promotions_post_type()
{
    register_post_type('promotion', [
        'labels' => [
            'name'               => 'Акции',
            'singular_name'      => 'Акция',
            'add_new'            => 'Добавить акцию',
            'add_new_item'       => 'Добавить акцию',
            'edit_item'          => 'Редактировать акцию',
            'new_item'           => 'Новая акция',
            'view_item'          => 'Просмотреть акцию',
            'search_items'       => 'Поиск акций',
            'not_found'          => 'Акции не найдены',
            'menu_name'          => 'Акции',
        ],

        'public'             => true,
        'has_archive'        => 'promotions',

        'rewrite' => [
            'slug' => 'promotions',
            'with_front' => false,
        ],

        'menu_icon' => 'dashicons-megaphone',

        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt'
        ],

        'show_in_rest' => true,
    ]);
}

/**
 * ============================================================================
 * Treatment Pages Redirect
 * ============================================================================
 *
 * Перенаправляет старые записи CPT `treatments`
 * на новые универсальные страницы лечения.
 *
 * Структура:
 * - одна категория = множество старых slug'ов;
 * - один target = одна новая страница.
 */

add_action('template_redirect', function () {

    /**
     * Работаем только с single-записями CPT `treatments`.
     */
    if (!is_singular('treatments')) {
        return;
    }

    /**
     * Получаем slug текущей записи.
     */
    $slug = get_post_field(
        'post_name',
        get_queried_object_id()
    );

    /**
     * Группы редиректов.
     *
     * В каждой группе:
     *
     * `slugs`  — множество старых URL;
     * `target` — единый новый URL.
     */
    $redirect_groups = [

        // =========================================================================
        // Лечение эндокринной системы
        // =========================================================================

        [
            'slugs' => [
                'endokrinnaya-sistema',
                'endokrinnaya-sistema-2',
                'endokrinnaya-sistema-3',
                'endokrinnaya-sistema-4',
                'endokrinnaya-sistema-5',
                'endokrinnaya-sistema-6',
                'endokrinnaya-sistema-7',
                'endokrinnaya-sistema-8',
                'endokrinnaya-sistema-9',
                'lechenie-endokrinnoj-sistemy-i-obmena-veshhestv',
            ],
            'target' => '/lechenie/lechenie-endokrinnoy-sistemy/',
        ],

        // =========================================================================
        // Лечение гинекологических заболеваний
        // =========================================================================

        [
            'slugs' => [
                'ginekologicheskie-zabolevaniya',
                'ginekologicheskie-zabolevaniya-2',
                'ginekologiya',
                'ginekologiya-2',
                'ginekologiya-3',
                'ginekologiya-4',
                'ginekologiya-5',
                'ginekologiya-6',
                'ginekologiya-7',
                'lechenie-ginekologicheskih-zabolevanij',
            ],
            'target' => '/lechenie/lechenie-ginekologicheskih-zabolevaniy/',
        ],

        // =========================================================================
        // Лечение кожных заболеваний
        // =========================================================================

        [
            'slugs' => [
                'kozha',
                'kozha-i-podkozhnaya-kletchatka',
                'kozha-i-podkozhnaya-kletchatka-2',
                'kozha-i-podkozhnaya-kletchatka-3',
                'kozha-i-podkozhnaya-kletchatka-4',
                'kozha-i-podkozhnaya-kletchatka-5',
                'kozha-i-podkozhnaya-kletchatka-6',
                'zabolevaniya-kozhi-i-podkozhnoj-kletchatki',
                'zabolevaniya-kozhi',
            ],
            'target' => '/lechenie/lechenie-kozhnyh-zabolevaniy/',
        ],

        // =========================================================================
        // Лечение мочеполовой системы
        // =========================================================================

        [
            'slugs' => [
                'mochepolovaya-sistema',
                'mochepolovaya-sistema-2',
                'mochepolovaya-sistema-3',
            ],
            'target' => '/lechenie/lechenie-mochepolovoy-sistemy/',
        ],

        // =========================================================================
        // Лечение нервной системы
        // =========================================================================

        [
            'slugs' => [
                'nervnaya-sistema',
                'nervnaya-sistema-2',
                'nervnaya-sistema-3',
                'nervnaya-sistema-4',
                'nervnaya-sistema-5',
                'nervnaya-sistema-6',
                'nervnaya-sistema-7',
                'nervnaya-sistema-8',
                'nervnaya-sistema-9',
                'nervnaya-sistema-10',
                'nervnaya-sistema-11',
                'lechenie-nervnoj-sistemy',
            ],
            'target' => '/lechenie/lechenie-nervnoy-sistemy/',
        ],

        // =========================================================================
        // Лечение опорно-двигательного аппарата
        // =========================================================================

        [
            'slugs' => [
                'oporno-dvigatelnyj-apparat',
                'oporno-dvigatelnyj-apparat-2',
                'oporno-dvigatelnyj-apparat-3',
                'oporno-dvigatelnyj-apparat-4',
                'oporno-dvigatelnyj-apparat-5',
                'oporno-dvigatelnyj-apparat-6',
                'oporno-dvigatelnyj-apparat-7',
                'oporno-dvigatelnyj-apparat-8',
                'oporno-dvigatelnyj-apparat-9',
                'oporno-dvigatelnyj-apparat-10',
                'oporno-dvigatelnyj-apparat-11',
                'oporno-dvigatelnyj-apparat-12',
                'lechenie-oporno-dvigatelnogo-apparata',
            ],
            'target' => '/lechenie/lechenie-oporno-dvigatelnogo-apparata/',
        ],

        // =========================================================================
        // Лечение органов дыхания
        // =========================================================================

        [
            'slugs' => [
                'organy-dyhaniya',
                'organy-dyhaniya-2',
                'organy-dyhaniya-3',
                'organy-dyhaniya-4',
                'organy-dyhaniya-5',
                'organy-dyhaniya-6',
                'organy-dyhaniya-7',
                'organy-dyhaniya-8',
                'organy-dyhaniya-9',
                'organy-dyhaniya-10',
                'organy-dyhaniya-reabilitacziya-posle-covid-19',
                'dyhatelnaya-sistema',
            ],
            'target' => '/lechenie/lechenie-organov-dyhaniya/',
        ],

        // =========================================================================
        // Лечение сердечно-сосудистой системы
        // =========================================================================

        [
            'slugs' => [
                'serdechno-sosudistaya-sistema',
                'serdechno-sosudistaya-sistema-2',
                'serdechno-sosudistaya-sistema-3',
                'serdechno-sosudistaya-sistema-4',
                'serdechno-sosudistaya-sistema-5',
                'serdechno-sosudistaya-sistema-6',
                'serdechno-sosudistaya-sistema-7',
                'serdechno-sosudistaya-sistema-8',
                'serdechno-sosudistaya-sistema-9',
                'serdechno-sosudistaya-sistema-10',
                'serdechno-sosudistye-zabolevaniya',
                'serdechno-sosudistye-zabolevaniya-2',
                'serdechno-sosudistye-zabolevaniya-3',
            ],
            'target' => '/lechenie/lechenie-serdechno-sosudistoy-sistemy/',
        ],

        // =========================================================================
        // Лечение урологических заболеваний
        // =========================================================================

        [
            'slugs' => [
                'urologiya',
                'urologicheskie-zabolevaniya',
                'urologiya-2',
                'urologiya-3',
                'urologiya-4',
                'urologiya-5',
                'urologiya-6',
            ],
            'target' => '/lechenie/lechenie-urologicheskih-zabolevaniy/',
        ],

        // =========================================================================
        // Лечение желудочно-кишечного тракта
        // =========================================================================

        [
            'slugs' => [
                'zheludochno-kishechnyj-trakt',
                'zheludochno-kishechnyj-trakt-2',
                'zheludochno-kishechnyj-trakt-3',
                'zheludochno-kishechnyj-trakt-4',
                'zheludochno-kishechnyj-trakt-5',
                'zheludochno-kishechnyj-trakt-6',
                'zheludochno-kishechnyj-trakt-7',
                'organy-pishhevareniya',
                'organy-pishhevareniya-2',
            ],
            'target' => '/lechenie/lechenie-zheludochno-kishechnogo-trakta/',
        ],

        // =========================================================================
        // DETOX
        // =========================================================================

        [
            'slugs' => [
                'detox-programma',
            ],
            'target' => '/lechenie/detox-programma-belovodye/',
        ],

        // =========================================================================
        // ЛОР
        // =========================================================================

        [
            'slugs' => [
                'lor-organy',
            ],
            'target' => '/lechenie/lechenie-lor-zabolevaniy-altay-west/',
        ],

        // =========================================================================
        // Оздоровление и лечение детей
        // =========================================================================

        [
            'slugs' => [
                'ozdorovlenie-i-lechenie-detej',
            ],
            'target' => '/lechenie/ozdorovlenie-i-lechenie-detey-rodnik-altaya/',
        ],

        // =========================================================================
        // Постковидное лечение
        // =========================================================================

        [
            'slugs' => [
                'postkovidnoe-lechenie',
            ],
            'target' => '/lechenie/postkovidnoe-lechenie-belovodye/',
        ],

        // =========================================================================
        // Профессиональные заболевания
        // =========================================================================

        [
            'slugs' => [
                'professionalnye-zabolevaniya',
            ],
            'target' => '/lechenie/lechenie-professionalnyh-zabolevaniy-rodnik-altaya/',
        ],

        // =========================================================================
        // Общее укрепление здоровья
        // =========================================================================

        [
            'slugs' => [
                'obshchee-ukreplenie-zdorov-ya-v-sanatorii',
            ],
            'target' => '/lechenie/obshchee-ukreplenie-zdorovya-sovremennik/',
        ],
    ];

    /**
     * Ищем текущий slug среди групп.
     */
    foreach ($redirect_groups as $group) {

        if (!in_array($slug, $group['slugs'], true)) {
            continue;
        }

        /**
         * Нашли соответствующую группу —
         * выполняем 301 редирект.
         */
        wp_safe_redirect(
            home_url($group['target']),
            301
        );

        exit;
    }

});

/**
 * ============================================================================
 * Автоматическое подключение шаблона страницы «Спасибо» (Thank You Page)
 * для URL /thank-you/ и любых дочерних страниц /thank-you/*
 * ============================================================================
 */
add_filter('template_include', function ($template) {
    if (is_page()) {
        $post = get_queried_object();
        if (!$post instanceof WP_Post) {
            return $template;
        }

        $template_slug = get_page_template_slug($post);

        // Если шаблон не задан явно или указан дефолтный
        if (empty($template_slug) || $template_slug === 'default') {
            $uri = trim($_SERVER['REQUEST_URI'] ?? '', '/');
            $slug = $post->post_name ?? '';

            if (
                $slug === 'thank-you' ||
                strpos($slug, 'thank-you') === 0 ||
                strpos($uri, 'thank-you') === 0 ||
                strpos($uri, '/thank-you') !== false
            ) {
                $thank_you_template = get_template_directory() . '/page-thank-you.php';
                if (file_exists($thank_you_template)) {
                    return $thank_you_template;
                }
            }
        }
    }

    return $template;
});
