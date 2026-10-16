<?php
// Получаем ID поста из переданных аргументов
$post_id = get_the_ID(); // Если используется setup_postdata, то get_the_ID() вернет текущий пост

// Получаем данные поста по его ID
$post = get_post($post_id);

// Получаем изображение для превью
$imageOfferPreview = get_field('sanatorium_promo', $post_id);
$sizeOfferPreview = 'large';
?>

<div class="offer <?php echo (array_key_exists('class', $args)) ? esc_attr($args['class']) : ''; ?>">
    <div class="offer__image">
        <?php if (get_field('bejdzhik_s_akcziej', $post_id)) { ?>
            <div class="badge-sale">
                <a href="<?php echo get_permalink($post_id); ?>?tab=sale#"><?php echo get_field('bejdzhik_s_akcziej', $post_id); ?></a>
            </div>
        <?php } ?>

        <a href="<?php echo get_permalink($post_id); ?>" class="offer__link">
            <img src="<?php echo wp_get_attachment_image_url($imageOfferPreview, $sizeOfferPreview); ?>" class="offer__img"
                 alt="<?php echo get_the_title($post_id); ?>" loading="lazy">
            <span class="offer__stars">
                <?php
                $stars = get_field_object('sanatorium_stars', $post_id);
                if ($stars && isset($stars['value'])) {
                    for ($i = 1; $i <= $stars['value']; $i++) { ?>
                        <span class="offer__star">
                            <picture>
                                <source srcset="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                        type="image/webp">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/offers/star.svg"
                                     alt="Рейтинг">
                            </picture>
                        </span>
                    <?php }
                } ?>
            </span>
        </a>
    </div>
    <div class="offer__body">
        <a href="<?php echo get_permalink($post_id); ?>" class="offer__title"><?php echo get_the_title($post_id); ?></a>
    </div>
    <div class="offer__bottom">
        <div class="offer__price">
            <?php
            $price = get_field('sanatorium_price', $post_id);
            if ($price) { ?>
                от <?php echo $price; ?><span>руб./сутки</span>
            <?php } else { ?>
                -<span>руб./сутки</span>
            <?php } ?>
        </div>
        <a href="#lead-form" class="offer__reserve">Оставить заявку</a>
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