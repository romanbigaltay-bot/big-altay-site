<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Design System Assets
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

function bads_enqueue_design_system() {

    $styles = [

    /*
    |--------------------------------------------------------------------------
    | Foundation
    |--------------------------------------------------------------------------
    */
		
		'foundation/breakpoints',
    'foundation/colors',
		'foundation/layers',
		'foundation/layout',
		'foundation/motion',
		'foundation/radius',
		'foundation/shadow',
		'foundation/sizes',
    'foundation/spacing',
    'foundation/typography',        

    /*
    |--------------------------------------------------------------------------
    | Utilities
    |--------------------------------------------------------------------------
    */

    'utilities/display',
    'utilities/flex',
    'utilities/grid',
    'utilities/spacing',
    'utilities/text',
    'utilities/visibility',
		
		/*
		|--------------------------------------------------------------------------
		| Styles
		|--------------------------------------------------------------------------
		*/

		'styles/content',
		'styles/card',

    /*
    |--------------------------------------------------------------------------
    | UI
    |--------------------------------------------------------------------------
    */
		
		'ui/icon',
		'ui/media',
		'ui/stars',
		'ui/list',
    'ui/button',
    'ui/badge',
		'ui/chip',
    'ui/divider',        
    'ui/title',
		'ui/subtitle',
		'ui/input',
		'ui/textarea',
		'ui/checkbox',
		'ui/radio',
		'ui/range',
		'ui/alert',
		'ui/modal',
		'ui/accordion',
		'ui/accordion-group',
		'ui/tabs',
		'ui/tabs-group',
		'ui/pagination',
		'ui/breadcrumbs',
		

    /*
		|--------------------------------------------------------------------------
		| Layouts
		|--------------------------------------------------------------------------
		*/

		'layouts/section',
		'layouts/container',
		'layouts/split',
		'layouts/stack',
		'layouts/cluster',
		'layouts/frame',
		'layouts/overlap',
		'layouts/pull',
		'layouts/grid',
		'layouts/gallery',
		'layouts/sidebar',
		'layouts/field',
		
		/*
		|--------------------------------------------------------------------------
		| Components
		|--------------------------------------------------------------------------
		*/

		'components/main-menu/main-menu',
		'components/anchor-nav/anchor-nav',
		'components/messenger-button/messenger-button',
		'components/slider/slider',
		'components/reactions/reactions',
		'components/meta-bar/meta-bar',
		'components/showcase-card/showcase-card',
		
		/* 
		|--------------------------------------------------------------------------
		| Treatment
		|--------------------------------------------------------------------------
		*/ 
		
		'pages/sanatorium/sanatorium',


    ];
	
	$scripts = [

		/*
		|--------------------------------------------------------------------------
		| UI
		|--------------------------------------------------------------------------
		*/

		'ui/accordion',
		'ui/alert',
		'ui/tabs',
		'ui/modal',
		
		/*
		|--------------------------------------------------------------------------
		| Blocks & Components
		|--------------------------------------------------------------------------
		*/

		'blocks/hero',
		'components/main-menu',
		'components/slider',
		
		
		/* 
		|--------------------------------------------------------------------------
		| Treatment-loader
		|--------------------------------------------------------------------------
		*/ 
		
		'pages/treatment-loader',
		'sanatoriums-filter',
		'news-interactions',

];

    foreach ($styles as $style) {

        $file = get_template_directory() . "/assets/css/{$style}.css";

        if (!file_exists($file)) {
            continue;
        }

        wp_enqueue_style(
            'bads-' . str_replace('/', '-', $style),
            get_template_directory_uri() . "/assets/css/{$style}.css",
            [],
            filemtime($file)
        );

    }
	
	foreach ($scripts as $script) {

		$file = get_template_directory() . "/assets/js/{$script}.js";

		if (!file_exists($file)) {
			continue;
		}

		wp_enqueue_script(
			'bads-' . str_replace('/', '-', $script),
			get_template_directory_uri() . "/assets/js/{$script}.js",
			[],
			filemtime($file),
			true
		);
		
		if ($script === 'pages/treatment-loader') {

		wp_localize_script(
			'bads-pages-treatment-loader',
			'badsTreatment',
			[
				'ajaxUrl' => admin_url('admin-ajax.php'),
			]
		);

	}

		if ($script === 'news-interactions') {

		wp_localize_script(
			'bads-news-interactions',
			'badsNewsInteractions',
			[
				'ajaxUrl' => admin_url('admin-ajax.php'),
				'nonce'   => wp_create_nonce('bads_news_interactions_nonce'),
			]
		);

	}

	}

}

add_action('wp_enqueue_scripts', 'bads_enqueue_design_system');