<?php
/**
 * ============================================================================
 * Big Altay
 * Sanatorium Card
 * ============================================================================
 */

if (!defined('ABSPATH')) {
    exit;
}

$sanatorium = $args['sanatorium'] ?? null;

if (!$sanatorium instanceof WP_Post) {
    return;
}

/*
|--------------------------------------------------------------------------
| ACF
|--------------------------------------------------------------------------
*/

$image   = get_field('sanatorium_promo', $sanatorium->ID);
$type    = get_field('sanatorium_type', $sanatorium->ID);
$stars   = get_field('sanatorium_stars', $sanatorium->ID);
$price   = get_field('sanatorium_price', $sanatorium->ID);
$filters = get_field('sanatorium_filter-treatment', $sanatorium->ID);

/*
|--------------------------------------------------------------------------
| Image URL
|--------------------------------------------------------------------------
*/

$image_url = '';

if (is_array($image)) {
    $image_url = $image['url'] ?? '';
} elseif (is_numeric($image)) {
    $image_url = wp_get_attachment_image_url(
        (int) $image,
        'large'
    );
} elseif (is_string($image)) {
    $image_url = $image;
}

/*
|--------------------------------------------------------------------------
| Description
|--------------------------------------------------------------------------
*/

$description = wp_trim_words(
    wp_strip_all_tags($sanatorium->post_content),
    28,
    '…'
);

/*
|--------------------------------------------------------------------------
| Stars
|--------------------------------------------------------------------------
*/

$stars_count = (int) $stars;

if ($stars_count < 1) {
    $stars_count = 0;
}

if ($stars_count > 5) {
    $stars_count = 5;
}

/*
|--------------------------------------------------------------------------
| Treatment badges
|--------------------------------------------------------------------------
|
| Показываем первые три профиля лечения.
|
*/

$treatment_labels = [];

if (is_array($filters)) {
    $treatment_labels = array_values(
        array_filter(
            array_map(
                static function ($item) {

                    if (is_array($item)) {
                        return $item['label'] ?? $item['value'] ?? '';
                    }

                    return (string) $item;
                },
                $filters
            )
        )
    );
}

$treatment_labels = array_slice(
    $treatment_labels,
    0,
    3
);

/*
|--------------------------------------------------------------------------
| URL
|--------------------------------------------------------------------------
*/

$permalink = get_permalink($sanatorium->ID);

$all_treatments = [];
if (is_array($filters)) {
    foreach ($filters as $item) {
        $all_treatments[] = is_array($item) ? ($item['label'] ?? $item['value'] ?? '') : (string)$item;
    }
}

$clean_price = (int) preg_replace('/[^0-9]/', '', (string)$price);
$infra = get_field('sanatorium_infra', $sanatorium->ID);
$all_infra = [];
if (is_array($infra)) {
    foreach ($infra as $item) {
        $all_infra[] = is_array($item) ? ($item['label'] ?? $item['value'] ?? '') : (string)$item;
    }
}
$location = (string) get_field('sanatorium_location', $sanatorium->ID);
$food = (string) get_field('sanatorium_food', $sanatorium->ID);
?>

<article
    class="bads-sanatorium-card"
    data-sanatorium-url="<?= esc_url($permalink); ?>"
    data-price="<?= esc_attr($clean_price); ?>"
    data-stars="<?= esc_attr($stars_count); ?>"
    data-treatments="<?= esc_attr(implode('|', array_filter($all_treatments))); ?>"
    data-infra="<?= esc_attr(implode('|', array_filter($all_infra))); ?>"
    data-location="<?= esc_attr($location); ?>"
    data-food="<?= esc_attr($food); ?>"
    tabindex="0"
    role="link"
    aria-label="<?= esc_attr('Подробнее о ' . get_the_title($sanatorium)); ?>"
>

    <?php if ($image_url !== '') : ?>

        <div class="bads-sanatorium-card__media">

            <img
                src="<?= esc_url($image_url); ?>"
                alt="<?= esc_attr(get_the_title($sanatorium)); ?>"
                loading="lazy"
                decoding="async"
            >

        </div>

    <?php endif; ?>


    <div class="bads-sanatorium-card__content">

        <div class="bads-stack bads-stack--md bads-stack--fill">

            <?php if ($type !== '' || $stars_count > 0) : ?>

                <div class="bads-sanatorium-card__meta">

                    <?php if ($type !== '') : ?>

                        <span class="bads-sanatorium-card__type">
                            <?= esc_html($type); ?>
                        </span>

                    <?php endif; ?>


                    <?php if ($stars_count > 0) : ?>

                        <span
                            class="bads-sanatorium-card__stars"
                            aria-label="<?= esc_attr($stars_count . ' звезд'); ?>"
                        >
                            <?= str_repeat('★', $stars_count); ?>
                        </span>

                    <?php endif; ?>

                </div>

            <?php endif; ?>


            <?php
            get_template_part(
                'template-parts/ui/title',
                null,
                [
                    'title' => get_the_title($sanatorium),
                    'level' => 'h3',
                    'size'  => 'h4',
                ]
            );
            ?>


            <?php if (!empty($treatment_labels)) : ?>

                <div class="bads-sanatorium-card__badges">

                    <div class="bads-sanatorium-card__badges-track">

                        <div class="bads-sanatorium-card__badges-group">

                            <?php foreach ($treatment_labels as $label) : ?>

                                <?php
                                get_template_part(
                                    'template-parts/ui/badge',
                                    null,
                                    [
                                        'text'    => $label,
                                        'variant' => 'primary',
                                    ]
                                );
                                ?>

                            <?php endforeach; ?>

                        </div>


                        <div
                            class="bads-sanatorium-card__badges-group"
                            aria-hidden="true"
                        >

                            <?php foreach ($treatment_labels as $label) : ?>

                                <?php
                                get_template_part(
                                    'template-parts/ui/badge',
                                    null,
                                    [
                                        'text'    => $label,
                                        'variant' => 'primary',
                                    ]
                                );
                                ?>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

            <?php endif; ?>


            <?php if ($description !== '') : ?>

                <div class="bads-content">

                    <p>
                        <?= esc_html($description); ?>
                    </p>

                </div>

            <?php endif; ?>


            <?php if ($price !== '') : ?>

				<div class="bads-sanatorium-card__price">

					<span class="bads-sanatorium-card__price-value">
						От <?= esc_html($price); ?>₽ 
					</span>

					<span class="bads-sanatorium-card__price-note">
						сутки / за человека
					</span>

				</div>

			<?php endif; ?>


            <div class="bads-cluster bads-cluster--sm bads-sanatorium-card__actions">

                <?php
                get_template_part(
                    'template-parts/ui/button',
                    null,
                    [
                        'text'    => 'Оставить заявку',
                        'type'    => 'button',
                        'variant' => 'primary',
                        'size'    => 'sm',
                        'attrs'   => [
                            'data-sanatorium-id' => $sanatorium->ID,
                        ],
                    ]
                );
                ?>


                <?php
                get_template_part(
                    'template-parts/ui/button',
                    null,
                    [
                        'text'    => 'Подробнее',
                        'url'     => $permalink,
                        'variant' => 'link',
                        'size'    => 'sm',
						'icon' => 'navigation/arrow-right',
						'icon_position' => 'right',
                    ]
                );
                ?>

            </div>

        </div>

    </div>

</article>


<style>

.bads-sanatorium-card {

    position: relative;

    display: flex;
    flex-direction: column;

    gap: var(--space-lg);

    min-width: 0;

}


/*
|--------------------------------------------------------------------------
| Media
|--------------------------------------------------------------------------
*/

.bads-sanatorium-card__media {

    position: relative;

    overflow: hidden;

    aspect-ratio: 475 / 300;

    border-radius: var(--radius-xl);

}

.bads-sanatorium-card__media img {

    display: block;

    width: 100%;
    height: 100%;

    object-fit: cover;

}


/*
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
*/

.bads-sanatorium-card__content {

    padding:
        0
        var(--space-md)
		var(--space-md);

}
	
	.bads-sanatorium-card__price {

    display: flex;
    align-items: baseline;
    gap: var(--space-sm);

}

.bads-sanatorium-card__price-value {

    font-size: var(--font-size-h4);
    font-weight: 700;
    line-height: 1.2;

}

.bads-sanatorium-card__price-note {

    color: var(--color-text-secondary);

    font-size: var(--font-size-small);
    line-height: 1.3;

}


/*
|--------------------------------------------------------------------------
| Meta
|--------------------------------------------------------------------------
|
| Тип и звёзды идут последовательно слева направо.
|
*/

.bads-sanatorium-card__meta {

    display: flex;
    align-items: center;
    justify-content: flex-start;

    gap: var(--space-sm);

    width: 100%;

    margin-bottom: calc(var(--space-md) * -0.5);

}


.bads-sanatorium-card__type {

    color: var(--color-text-secondary);

    font-size: var(--font-size-small);
    line-height: 1.3;

}


.bads-sanatorium-card__stars {

    flex-shrink: 0;

    color: var(--color-warning);

    font-size: var(--font-size-small);
    line-height: 1;

    white-space: nowrap;

}


/*
|--------------------------------------------------------------------------
| Treatment badges / Marquee
|--------------------------------------------------------------------------
*/

.bads-sanatorium-card__badges {

    position: relative;

    overflow: hidden;

    width: 100%;

    cursor: grab;

    touch-action: pan-y;

    -webkit-mask-image:
        linear-gradient(
            to right,
            transparent 0,
            #000 7%,
            #000 93%,
            transparent 100%
        );

    mask-image:
        linear-gradient(
            to right,
            transparent 0,
            #000 7%,
            #000 93%,
            transparent 100%
        );

}


.bads-sanatorium-card__badges.is-dragging {

    cursor: grabbing;

    user-select: none;

}


.bads-sanatorium-card__badges-track {

    display: flex;
    align-items: center;

    width: max-content;

    transform: translate3d(0, 0, 0);

    will-change: transform;

}


.bads-sanatorium-card__badges-group {

    display: flex;
    align-items: center;

    gap: var(--space-sm);

    flex-shrink: 0;

    padding-right: var(--space-sm);

}


/*
|--------------------------------------------------------------------------
| Marquee animation
|--------------------------------------------------------------------------
*/

@keyframes bads-sanatorium-badges-marquee {

    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-50%);
    }

}


/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/

.bads-sanatorium-card__actions {

    opacity: 0;

    transform: translateY(8px);

    pointer-events: none;

    transition:
        opacity .2s ease,
        transform .2s ease;

}


.bads-sanatorium-card:hover .bads-sanatorium-card__actions,
.bads-sanatorium-card:focus-within .bads-sanatorium-card__actions {

    opacity: 1;

    transform: none;

    pointer-events: auto;

}


/*
|--------------------------------------------------------------------------
| Mobile
|--------------------------------------------------------------------------
*/

@media (max-width: 768px) {

    .bads-sanatorium-card__actions {

        opacity: 1;

        transform: none;

        pointer-events: auto;

    }

}

</style>

<script>
document.addEventListener('DOMContentLoaded', () => {

    document
        .querySelectorAll('.bads-sanatorium-card')
        .forEach((card) => {

            const viewport = card.querySelector(
                '.bads-sanatorium-card__badges'
            );

            const track = card.querySelector(
                '.bads-sanatorium-card__badges-track'
            );

            if (!viewport || !track) {
                return;
            }

            const groups = track.querySelectorAll(
                '.bads-sanatorium-card__badges-group'
            );

            if (groups.length < 2) {
                return;
            }

            let groupWidth = 0;

            let position = 0;

            let animationFrame = null;

            let lastTime = null;

            let isCardHovered = false;

            let isRowHovered = false;

            let isDragging = false;

            let pointerId = null;

            let dragStartX = 0;

            let dragStartPosition = 0;

            const speed = 30;
		
			let wasDragged = false;

			const interactiveSelector = [
				'a',
				'button',
				'input',
				'select',
				'textarea',
				'[role="button"]',
				'.bads-sanatorium-card__badges'
			].join(', ');


			/**
			 * ============================================================================
			 * Card click
			 * ============================================================================
			 *
			 * Вся карточка ведёт на страницу санатория.
			 *
			 * Интерактивные элементы внутри карточки не перехватываются:
			 * - кнопки;
			 * - ссылки;
			 * - бегущая строка;
			 * - формы и другие интерактивные элементы.
			 *
			 */

			card.addEventListener('click', (event) => {

				if (wasDragged) {
					wasDragged = false;
					return;
				}

				/*
				 * Если кликнули по самостоятельному интерактивному элементу,
				 * карточка ничего дополнительно не делает.
				 */
				if (event.target.closest(interactiveSelector)) {
					return;
				}

				const url = card.dataset.sanatoriumUrl;

				if (!url) {
					return;
				}

				window.location.href = url;

			});


		/**
		 * ============================================================================
		 * Keyboard accessibility
		 * ============================================================================
		 */

		card.addEventListener('keydown', (event) => {

			if (
				event.key !== 'Enter' &&
				event.key !== ' '
			) {
				return;
			}

			/*
			 * Не вмешиваемся в поведение клавиатуры внутри интерактивных элементов.
			 */
			if (event.target.closest(interactiveSelector)) {
				return;
			}

			event.preventDefault();

			const url = card.dataset.sanatoriumUrl;

			if (!url) {
				return;
			}

			window.location.href = url;

		});


            /**
             * ================================================================
             * Measure
             * ================================================================
             */

            const measure = () => {

                groupWidth = groups[0].getBoundingClientRect().width;

                position = normalizePosition(position);

                applyPosition();

            };


            /**
             * ================================================================
             * Normalize position
             * ================================================================
             *
             * Удерживаем движение в пределах одной копии строки.
             *
             */

            const normalizePosition = (value) => {

                if (!groupWidth) {
                    return 0;
                }

                while (value <= -groupWidth) {
                    value += groupWidth;
                }

                while (value > 0) {
                    value -= groupWidth;
                }

                return value;

            };


            /**
             * ================================================================
             * Apply position
             * ================================================================
             */

            const applyPosition = () => {

                position = normalizePosition(position);

                track.style.transform =
                    `translate3d(${position}px, 0, 0)`;

            };


            /**
             * ================================================================
             * Animation
             * ================================================================
             */

            const animate = (time) => {

                animationFrame = requestAnimationFrame(animate);

                if (!isCardHovered || isRowHovered || isDragging) {
                    lastTime = time;
                    return;
                }

                if (lastTime === null) {
                    lastTime = time;
                    return;
                }

                const delta = time - lastTime;

                lastTime = time;

                position -= (
                    speed * delta / 1000
                );

                applyPosition();

            };


            /**
             * ================================================================
             * Start animation loop
             * ================================================================
             */

            const startAnimation = () => {

                if (animationFrame !== null) {
                    return;
                }

                lastTime = null;

                animationFrame = requestAnimationFrame(animate);

            };


            /**
             * ================================================================
             * Stop animation loop
             * ================================================================
             */

            const stopAnimation = () => {

                if (animationFrame === null) {
                    return;
                }

                cancelAnimationFrame(animationFrame);

                animationFrame = null;

                lastTime = null;

            };


            /**
             * ================================================================
             * Card hover
             * ================================================================
             */

            card.addEventListener('mouseenter', () => {

                isCardHovered = true;

                startAnimation();

            });


            card.addEventListener('mouseleave', () => {

                isCardHovered = false;

                stopAnimation();

            });


            /**
             * ================================================================
             * Row hover
             * ================================================================
             *
             * Наведение непосредственно на строку останавливает
             * автоматическое движение.
             *
             */

            viewport.addEventListener('mouseenter', () => {

                isRowHovered = true;

            });


            viewport.addEventListener('mouseleave', () => {

                isRowHovered = false;

                if (isCardHovered && !isDragging) {
                    startAnimation();
                }

            });


            /**
             * ================================================================
             * Pointer down
             * ================================================================
             */

            viewport.addEventListener(
				'pointerdown',
				(event) => {

					wasDragged = false;

					isDragging = true;

					pointerId = event.pointerId;

					dragStartX = event.clientX;

					dragStartPosition = position;

					viewport.classList.add('is-dragging');

					viewport.setPointerCapture(pointerId);

					stopAnimation();

					event.preventDefault();

				}
			);


            /**
             * ================================================================
             * Pointer move
             * ================================================================
             */

            viewport.addEventListener(
                'pointermove',
                (event) => {

                    if (!isDragging) {
                        return;
                    }

                    if (event.pointerId !== pointerId) {
                        return;
                    }

                    const deltaX =
						event.clientX - dragStartX;

					if (Math.abs(deltaX) > 5) {
						wasDragged = true;
					}

					position =
						dragStartPosition + deltaX;

					applyPosition();

                }
            );


            /**
             * ================================================================
             * Finish drag
             * ================================================================
             */

            const finishDrag = (event) => {

                if (!isDragging) {
                    return;
                }

                if (
                    event &&
                    pointerId !== null &&
                    event.pointerId !== pointerId
                ) {
                    return;
                }

                isDragging = false;

                viewport.classList.remove('is-dragging');

                if (
                    pointerId !== null &&
                    viewport.hasPointerCapture(pointerId)
                ) {
                    viewport.releasePointerCapture(pointerId);
                }

                pointerId = null;

                normalizePosition(position);

                if (isCardHovered) {
                    startAnimation();
                }

            };


            viewport.addEventListener(
                'pointerup',
                finishDrag
            );


            viewport.addEventListener(
                'pointercancel',
                finishDrag
            );


            viewport.addEventListener(
                'lostpointercapture',
                () => {

                    if (!isDragging) {
                        return;
                    }

                    isDragging = false;

                    viewport.classList.remove('is-dragging');

                    pointerId = null;

                    if (isCardHovered) {
                        startAnimation();
                    }

                }
            );


            /**
             * ================================================================
             * Resize
             * ================================================================
             */

            window.addEventListener(
                'resize',
                measure
            );


            /**
             * ================================================================
             * Initial state
             * ================================================================
             */

            measure();

        });

});
</script>