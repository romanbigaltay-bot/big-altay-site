<?
$imageReview = get_sub_field('main_reviews-photo');
$sizeReview = 'medium';
?>

<div class="reviews-card <? (array_key_exists('class', $args)) ? print $args['class'] : print '' ?>">
    <div class="reviews-card__image">
        <img src="<?= wp_get_attachment_image_url($imageReview, $sizeReview); ?>"
             alt="<?php the_sub_field('main_reviews-title'); ?>"
             class="reviews-card__img" loading="lazy">
    </div>
    <div class="reviews-card__body">
        <div class="reviews-card__title"><?php the_sub_field('main_reviews-title'); ?></div>
        <div class="reviews-card__description">
            <?php the_sub_field('main_reviews-text'); ?>
        </div>
    </div>
</div>