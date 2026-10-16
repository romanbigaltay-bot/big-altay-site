<?php
$imageTours = get_field('tours_promo');
$sizeTours = 'large';
?>

<div class="excursions-item">
    <div class="excursions-item__image">
        <a href="<? the_permalink(); ?>" class="excursions-item__link">
            <img src="<?= wp_get_attachment_image_url($imageTours, $sizeTours); ?>" alt="<?= the_title(); ?>"
                 class="excursions-item__img" loading="lazy">
        </a>
    </div>
    <div class="excursions-item__body">
        <a href="<? the_permalink(); ?>" class="excursions-item__title"><?= the_title(); ?></a>
        <div class="excursions-item__description"><?= the_excerpt(); ?></div>
        <a href="<? the_permalink(); ?>" class="excursions-item__more">Подробнее</a>
    </div>
</div>