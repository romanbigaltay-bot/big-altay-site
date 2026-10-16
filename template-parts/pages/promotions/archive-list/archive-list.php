<?php
/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Template part: Archive List (Promotions)
 * Path: template-parts/pages/promotions/archive-list/archive-list.php
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$promotions = new WP_Query([
    'post_type'      => 'promotion',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

if (!$promotions->have_posts()) {
    return;
}
?>

<section class="bads-section bads-section--md" id="promotions-list">
    <div class="bads-container">

        <!-- Section Title with Divider -->
        <div style="margin-bottom: var(--space-3xl);">
            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'level'           => 'h2',
                    'size'            => 'h2',
                    'title'           => 'Актуальные акции',
                    'divider'         => true,
                    'divider_variant' => 'primary',
                    'divider_width'   => '90px',
                ]
            );
            ?>
        </div>

        <!-- Promotions Rows -->
        <div class="bads-stack bads-promotions-list">
            <?php
            $counter = 0;

            while ($promotions->have_posts()) :
                $promotions->the_post();
                $counter++;
                $is_reversed = ($counter % 2 === 0);

                $max_discount      = get_field('promotion_max_discount');
                $period            = get_field('promotion_period');
                $applies_to        = get_field('promotion_applies_to');
                $short_description = get_field('promotion_short_description');

                $benefits_list = [];
                if ($applies_to) {
                    $lines = preg_split('/\r\n|\r|\n/', trim($applies_to));
                    foreach ($lines as $line) {
                        $line = trim($line);
                        if (!empty($line)) {
                            $benefits_list[] = $line;
                        }
                    }
                }
            ?>

                <article class="bads-showcase-card bads-promotions-row <?= $is_reversed ? 'bads-showcase-card--reverse bads-promotions-row--reverse' : ''; ?>">

                    <!-- Media Image -->
                    <div class="bads-showcase-card__media bads-promotions-row__image">
                        <a href="<?php the_permalink(); ?>" class="bads-showcase-card__media-link bads-promotions-row__image-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail(
                                    'large',
                                    [
                                        'class'   => 'bads-showcase-card__img bads-promotions-row__img',
                                        'loading' => 'lazy',
                                    ]
                                ); ?>
                            <?php else : ?>
                                <img
                                    src="<?= esc_url(get_template_directory_uri() . '/assets/images/placeholders/image.svg'); ?>"
                                    alt="<?= esc_attr(get_the_title()); ?>"
                                    class="bads-showcase-card__img bads-promotions-row__img"
                                >
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- Glass Card Content -->
                    <div class="bads-card bads-card--glass bads-card--padding-xl bads-showcase-card__content bads-promotions-row__card">

                        <div class="bads-stack bads-stack--sm bads-stack--fill">
                            <a href="<?php the_permalink(); ?>" class="bads-showcase-card__card-link bads-promotions-row__card-link">
                                <?php
                                get_template_part(
                                    'template-parts/ui/title',
                                    null,
                                    [
                                        'title' => get_the_title(),
                                        'level' => 'h3',
                                        'size'  => 'h4',
                                        'class' => 'bads-showcase-card__title bads-promotions-row__title',
                                    ]
                                );
                                ?>
                            </a>

                        <?php if ($max_discount) : ?>
                            <div class="bads-showcase-card__discount bads-promotions-row__discount">
                                Скидка <?= esc_html($max_discount); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($period) : ?>
                            <div class="bads-showcase-card__period bads-promotions-row__period">
                                <?= esc_html($period); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($benefits_list)) : ?>
                            <div>
                                <?php
                                get_template_part(
                                    'template-parts/ui/list',
                                    null,
                                    [
                                        'items'   => $benefits_list,
                                        'variant' => 'check',
                                    ]
                                );
                                ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($short_description) : ?>
                            <p class="bads-text-body bads-showcase-card__description bads-promotions-row__description">
                                <?= esc_html($short_description); ?>
                            </p>
                        <?php endif; ?>

                        <div class="bads-split bads-split--gap-md">
                            <?php
                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'    => 'Применить акцию',
                                    'url'     => '#promotions-form',
                                    'variant' => 'primary',
                                    'size'    => 'md',
                                ]
                            );

                            get_template_part(
                                'template-parts/ui/button',
                                null,
                                [
                                    'text'          => 'Подробнее',
                                    'url'           => get_permalink(),
                                    'variant'       => 'link',
                                    'size'          => 'md',
                                    'icon'          => 'navigation/arrow-right',
                                    'icon_position' => 'right',
                                ]
                            );
                            ?>
                        </div>

                    </div>

                </article>

            <?php endwhile; ?>
        </div>

    </div>
</section>

<?php wp_reset_postdata(); ?>

