<?
$imageNumber = get_field('number_promo');
$sizeNumber = 'large';
?>

<div class="offer">
    <div class="offer__image">
        <a href="<?php the_permalink(); ?>" class="offer__link">
            <img src="<?= wp_get_attachment_image_url($imageNumber, $sizeNumber); ?>"
                 class="offer__img" alt="<?php the_title(); ?>" loading="lazy">
        </a>
    </div>
    <div class="offer__body">
        <a href="<?php the_permalink(); ?>" class="offer__title"><?php the_title(); ?></a>
        <a href="<?php the_permalink(); ?>" class="offer__more">Подробнее</a>
    </div>
    <div class="offer__bottom">
        <div class="offer__price">от <? the_field('number_price'); ?><span>руб./сутки</span></div>
        <a href="#lead-form" class="offer__reserve">Оставить заявку</a>
    </div>
</div>