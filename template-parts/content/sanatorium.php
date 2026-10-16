<?php
$imageOfferPreview = get_field('sanatorium_promo');
$sizeOfferPreview = 'large';
?>

<div class="offer <? (array_key_exists('class', $args)) ? print $args['class'] : print '' ?>">
    <div class="offer__image">
        <?php if(get_field('bejdzhik_s_akcziej')) { ?>
            <div class="badge-sale">
                <a href="<?php the_permalink(); ?>?tab=sale#"><?php echo get_field('bejdzhik_s_akcziej');?></a>
            </div>
        <?php } ?>

        <a href="<? the_permalink(); ?>" class="offer__link">
            <img src="<?= wp_get_attachment_image_url($imageOfferPreview, $sizeOfferPreview); ?>" class="offer__img"
                 alt="<?= the_title(); ?>" loading="lazy">
            <span class="offer__stars">
            <? $stars = get_field_object('sanatorium_stars'); ?>
                <? for ($i = 1; $i <= $stars['value']; $i++) { ?>
                    <span class="offer__star">
                    <picture>
                        <source srcset="<?= get_template_directory_uri(); ?>/img/offers/star.svg"
                                type="image/webp">
                            <img src="<?= get_template_directory_uri(); ?>/img/offers/star.svg"
                                 alt="Рейтинг">
                    </picture>
                </span>
                <? } ?>
            </span>
        </a>
    </div>
    <div class="offer__body">
        <a href="<? the_permalink(); ?>" class="offer__title"><?= the_title(); ?></a>
        <div class="offer__description"><?= the_excerpt(); ?></div>
        <a href="<? the_permalink(); ?>" class="offer__more">Подробнее</a>
    </div>
    <div class="offer__bottom">
        <div class="offer__price">
        <?
        if (get_field('sanatorium_price')) { ?>
            от <?php the_field('sanatorium_price'); ?><span>руб./сутки</span>
        <? } else { ?>
            -<span>руб./сутки</span>
        <? } ?>
        </div>
        <a style="cursor:pointer" data-fancybox data-src="#same-page" class="offer__reserve">Оставить заявку</a>
    </div>
</div>

<style>
    .badge-sale {
        background: #E6353F;
        position: absolute;
        left: 20px;
        top: 20px;
        z-index: 3;
        color: #fff;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all .3s ease 0s;
    }
    .badge-sale:hover {
        background: #0CA4E4;
    }
    .badge-sale a {
        color: #fff;
    }
    .offer__image {
        position: relative;
    }
</style>