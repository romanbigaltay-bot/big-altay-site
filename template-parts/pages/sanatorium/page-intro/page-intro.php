<?php

/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Sanatorium / Page Intro
 * ============================================================================
 */


/*
|--------------------------------------------------------------------------
| Data
|--------------------------------------------------------------------------
*/

$post_type = get_post_type();


/*
|--------------------------------------------------------------------------
| Banner
|--------------------------------------------------------------------------
*/

$banner = get_field('sanatorium_promo');


if (!$banner) {

    $banner = [
        'url' => get_template_directory_uri() . '/assets/images/placeholders/sanatorium-banner.jpg',
        'alt' => get_the_title(),
    ];

}


/*
|--------------------------------------------------------------------------
| Stars
|--------------------------------------------------------------------------
*/

$stars = (int) get_field('sanatorium_stars');

/*
|--------------------------------------------------------------------------
| Type
|--------------------------------------------------------------------------
*/

$type = get_field('sanatorium_type');

/*
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
*/

$title_name = get_the_title();

$title_full = trim(implode(' ', array_filter([
    $type,
    $title_name,
])));

/*
|--------------------------------------------------------------------------
| Breadcrumbs
|--------------------------------------------------------------------------
*/

$breadcrumbs = [

    [
        'label' => 'Главная',
        'url'   => home_url('/'),
    ],

];


switch ($post_type) {


    case 'sanatorium':

        $breadcrumbs[] = [

            'label' => 'Санатории Белокурихи',
            'url'   => home_url('/sanatorium/'),

        ];

        break;


    case 'rest-belokurikha':

        $breadcrumbs[] = [

            'label' => 'Отдых в Белокурихе',
            'url'   => home_url('/rest-belokurikha/'),

        ];

        break;


    case 'rest-altai-mountains':

        $breadcrumbs[] = [

            'label' => 'Отдых в Горном Алтае',
            'url'   => home_url('/rest-altai-mountains/'),

        ];

        break;


}


$breadcrumbs[] = [

    'label'   => get_the_title(),
    'current' => true,

];

?>


<style>

/*
|--------------------------------------------------------------------------
| Experimental overlap layout
|--------------------------------------------------------------------------
|
| Временно локальный тест.
| После подтверждения переносим в:
| assets/css/layouts/overlap.css
|
*/

.bads-page-intro-overlap {
    position: relative;
}

.bads-page-intro-overlap__back {
    position: relative;
}

.bads-page-intro-overlap__front {
    position: relative;
    z-index: 2;
    margin-top: -80px;
    margin-left: 48px;
}


.bads-page-intro-overlap__front > .bads-card {
    width: fit-content;
    max-width: 1296px;
}	
	
/* .bads-page-intro__type {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: var(--color-text-secondary, #6b7280);
} */
	
	.bads-page-intro__header {

    display: flex;

    align-items: center;

    gap: 32px;

}



.bads-page-intro__meta {

    display: flex;

    flex-direction: column;

    align-items: center;

    flex-shrink: 0;

    gap: 8px;

}



.bads-page-intro__type {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: #6b7280;
    text-align: center;
}
	
/*
.bads-page-intro__title {
    margin: 0;
    line-height: 1.1;
}

.bads-page-intro__title-type {
    position: absolute;
    width: 1px;
    height: 1px;
    overflow: hidden;
    clip: rect(0 0 0 0);
    white-space: nowrap;
}

.bads-page-intro__title-name {
    display: block;
} */
	
	/* ==========================================================================
   TEMP
   Page Intro Title
   ========================================================================== */

.bads-page-intro__header .bads-title {
    flex: 1;
}

.bads-page-intro__header .bads-title__heading {
    font-size: clamp(42px, 3vw, 56px);
    line-height: 1.05;
    white-space: nowrap;
}

@media (max-width: 992px) {

    .bads-page-intro__header .bads-title__heading {
        white-space: normal;
        font-size: clamp(34px, 5vw, 46px);
    }

}

@media (max-width: 768px) {

    .bads-page-intro__header .bads-title__heading {
        font-size: 32px;
    }

}



@media (max-width: 992px) {

    .bads-page-intro-overlap__front {

        margin-left: 24px;

        margin-right: 24px;

    }

    .bads-page-intro-overlap__front > .bads-card {

        width: auto;

        max-width: none;

    }

    .bads-page-intro__header {

        gap: 24px;

    }

}



@media (max-width: 768px) {

    .bads-page-intro-overlap__front {
        margin: -48px 16px 0;
    }

    .bads-page-intro-overlap__front > .bads-card {
        width: 100%;
    }

    .bads-page-intro__header {
        flex-direction: column;
        align-items: center;
        gap: 20px;
        text-align: center;
    }

    .bads-page-intro__meta {
        align-items: center;
    }

    .bads-page-intro__header .bads-title {
        align-items: center;
        text-align: center;
    }

    .bads-page-intro__header .bads-title__heading {
        white-space: normal;
        text-align: center;
    }

}

</style>


<section class="bads-section">
    <div class="bads-container">
        <div class="bads-page-intro-overlap">

            <!-- ======================================================
                 Banner
            ======================================================= -->

            <div class="bads-page-intro-overlap__back">
                <?php
                get_template_part(
                    'template-parts/ui/media',
                    null,
                    [

                        'image'    => $banner,
                        'height' => 'banner',
                        'fit'      => 'cover',
                        'rounded'  => true,
                        'loading'  => 'eager',
                        'decoding' => 'sync',

                    ]
                );
                ?>

            </div>

            <!-- ======================================================
                 Intro Card
            ======================================================= -->

            <div class="bads-page-intro-overlap__front">
                <div class="bads-card bads-card--glass bads-card--padding-xl">
                    <div class="bads-stack bads-stack--lg">
                        <?php
                        get_template_part(
                            'template-parts/ui/breadcrumbs',
                            null,
                            [
                                'items' => $breadcrumbs,
                            ]
                        );
                        ?>
						
                        <div class="bads-page-intro__header">

							<div class="bads-page-intro__meta">

								<?php if ($stars > 0) : ?>

									<?php
									get_template_part(
										'template-parts/ui/stars',
										null,
										[
											'value' => $stars,
											'size'  => 'md',
										]
									);
									?>

								<?php endif; ?>

								<?php if (!empty($type)) : ?>

									<div class="bads-page-intro__type">

										<?= esc_html(mb_strtoupper($type)); ?>

									</div>

								<?php endif; ?>

							</div>

							<?php
								get_template_part(
									'template-parts/ui/title',
									null,
									[
										'seo_prefix' => $type,
										'title'  => $title_name,
										'level'  => 'h1',
									]
								);
							?>

						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>