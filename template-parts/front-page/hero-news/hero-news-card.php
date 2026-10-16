<?php

$imageNewsPreview = get_field('news_promo');

?>

<article class="hero-news-card">

    <a
        href="<?php the_permalink(); ?>"
        class="hero-news-card__image-link"
    >

        <?php if ($imageNewsPreview) : ?>

            <img
                src="<?= wp_get_attachment_image_url($imageNewsPreview, 'medium'); ?>"
                alt="<?= esc_attr(get_the_title()); ?>"
                class="hero-news-card__image"
                loading="lazy"
            >

        <?php endif; ?>

    </a>

    <div class="hero-news-card__content">

        <a
            href="<?php the_permalink(); ?>"
            class="hero-news-card__title"
        >
            <?php the_title(); ?>
        </a>      

    </div>

</article>