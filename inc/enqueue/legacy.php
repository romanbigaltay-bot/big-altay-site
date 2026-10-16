add_action('wp_enqueue_scripts', 'theme_add_scripts');
function theme_add_scripts()
{
	
	
    // подключаем файл стилей темы
    wp_enqueue_style('style-css', get_template_directory_uri() . '/css/main.min.css?v=2.9');
    wp_enqueue_style('style-swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css');
    wp_enqueue_style('style-fancybox', get_template_directory_uri() . '/css/fancybox.css');
    wp_enqueue_style('style-accordion', get_template_directory_uri() . '/css/accordion.min.css');
	wp_enqueue_style('hero-css', get_template_directory_uri() . '/assets/css/pages/front-page/hero.css', array('style-css'), filemtime(get_template_directory() . '/assets/css/pages/front-page/hero.css')
    );
	wp_enqueue_style(
    'hero-news-css',
    get_template_directory_uri() . '/assets/css/pages/front-page/hero-news.css',
    array('hero-css'),
    filemtime(
        get_template_directory() . '/assets/css/pages/front-page/hero-news.css'
    )
);
	wp_enqueue_style(
    'promotions-single-form-css',
    get_template_directory_uri()
        . '/assets/css/pages/promotions/single-form.css',
    [],
    filemtime(
        get_template_directory()
        . '/assets/css/pages/promotions/single-form.css'
    )
);
	wp_enqueue_style(
    'promotions-advantages-css',
    get_template_directory_uri() . '/assets/css/pages/promotions/advantages.css',
    [],
    filemtime(
        get_template_directory() . '/assets/css/pages/promotions/advantages.css'
    )
);
	
	wp_enqueue_style(
    'promotions-single-hero-css',
    get_template_directory_uri()
        . '/assets/css/pages/promotions/single-hero.css',
    [],
    filemtime(
        get_template_directory()
        . '/assets/css/pages/promotions/single-hero.css'
    )
);
	
	wp_enqueue_style(
    'mega-menu-css',
    get_template_directory_uri() . '/assets/css/mega-menu/mega-menu.css',
    [],
    filemtime(
        get_template_directory() . '/assets/css/mega-menu/mega-menu.css'
    )
);
	wp_enqueue_style(
    'promotions-archive-hero-css',
    get_template_directory_uri()
    . '/assets/css/pages/promotions/archive-hero.css',
    [],
    filemtime(
        get_template_directory()
        . '/assets/css/pages/promotions/archive-hero.css'
    )
);
	wp_enqueue_style(
    'promotions-archive-list-css',
    get_template_directory_uri()
    . '/assets/css/pages/promotions/archive-list.css',
    [],
    filemtime(
        get_template_directory()
        . '/assets/css/pages/promotions/archive-list.css'
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
	wp_enqueue_script(
    'hero-js',
    get_template_directory_uri() . '/assets/js/pages/front-page/hero.js',
    [],
    filemtime(
        get_template_directory() . '/assets/js/pages/front-page/hero.js'
    ),
    true
);
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