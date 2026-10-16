<?php

$query = new WP_Query([
    'post_type'      => 'news',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
]);

if (!$query->have_posts()) {
    return;
}
?>

<div class="hero-news-widget">

    <h2 class="hero-news-widget__title">
        📰 Наши новости
    </h2>

    <div class="hero-news-widget__list">

        <?php while ($query->have_posts()) : $query->the_post(); ?>

            <?php
            get_template_part(
                'template-parts/front-page/hero-news/hero-news-card'
            );
            ?>

        <?php endwhile; ?>

    </div>

    <a
        href="/news/"
        class="hero-news-widget__more btn"
    >
        Смотреть ещё
    </a>

    <button
        type="button"
        class="hero-news-widget__subscribe btn"
    >
        Подписка на новости
    </button>

</div>

<?php wp_reset_postdata(); ?>