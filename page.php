<?php
/**
 * The template for displaying all single pages (Default Page Template)
 *
 * Базовый системный шаблон WordPress для любых стандартных страниц сайта
 * (включая служебные страницы, текстовые документы и страницы с дефолтным шаблоном).
 *
 * @package BADS
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="bads-page bads-page--default">
    <!-- Breadcrumbs & Page Header Section -->
    <section class="bads-section bads-section--sm u-bg-surface-subtle">
        <div class="bads-container bads-container--lg">
            <div class="bads-stack bads-stack--sm">
                <?php
                if (function_exists('get_template_part')) {
                    get_template_part('template-parts/ui/breadcrumbs', null, [
                        'items' => [
                            ['label' => 'Главная', 'url' => '/'],
                            ['label' => get_the_title(), 'current' => true],
                        ],
                    ]);
                }
                ?>
                
            </div>
        </div>
    </section>

    <!-- Page Body Content Section -->
    <section class="bads-section bads-section--lg">
        <div class="bads-container bads-container--xl">
        
                <article class="bads-content bads-content--article">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            the_content();
                        endwhile;
                    else :
                        echo '<p class="u-text-muted">Контент страницы находится в процессе наполнения.</p>';
                    endif;
                    ?>
                </article>
                       
        </div>
    </section>
</main>

<?php
get_footer();