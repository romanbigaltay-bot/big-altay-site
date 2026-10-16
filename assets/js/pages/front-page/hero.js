document.addEventListener('DOMContentLoaded', () => {

    const slides = document.querySelectorAll('.hero-slide');
	const dots = document.querySelectorAll('.hero-slider__dot');

    if (!slides.length) {
        return;
    }

    let currentIndex = 0;
    let autoplayTimer;
	const heroSlider = document.querySelector('.hero-slider');
	const heroButton =
    document.querySelector(
        '.hero-slide__button'
    );
	const nextNavButton =
    document.querySelector(
        '.hero-slide__nav--next'
    );
	prepareTitles();
	
	document
    .querySelectorAll(
        '.hero-slide__image'
    )
    .forEach(image => {

        image.addEventListener(
            'dragstart',
            event => {
                event.preventDefault();
            }
        );

    });
	
	let isAnimating = false;
	
	function prepareTitles() {

		const titles =
			document.querySelectorAll(
				'.hero-slide__title'
			);

		titles.forEach(title => {

			const text =
				title.textContent;

			title.innerHTML = '';

			[...text].forEach(char => {

				const span =
					document.createElement(
						'span'
					);

				span.className =
					'hero-slide__title-char';

				span.textContent = char;

				title.appendChild(span);

			});

		});

	}
	
	function hideTitle(title, direction = 'next') {

			const chars =
				[...title.querySelectorAll(
					'.hero-slide__title-char'
				)];

			const sequence =
				direction === 'next'
					? chars.reverse()
					: chars;

			sequence.forEach(
				(char, index) => {

					setTimeout(() => {

						char.classList.add(
							'is-hidden'
						);

					}, index * 20);

				}
			);

		}
	
	function showTitle(title, direction = 'next') {

			const chars =
				[...title.querySelectorAll(
					'.hero-slide__title-char'
				)];

			chars.forEach(char => {

				char.classList.add(
					'is-hidden'
				);

			});

			const sequence =
				direction === 'next'
					? chars.reverse()
					: chars;

			sequence.forEach(
				(char, index) => {

					setTimeout(() => {

						char.classList.remove(
							'is-hidden'
						);

					}, index * 20);

				}
			);

		}

    function showSlide(index, direction = 'next') {

		if (
			isAnimating
			|| index === currentIndex
		) {
			return;
		}

		isAnimating = true;

		const currentSlide =
			slides[currentIndex];

		const nextSlide =
			slides[index];
		
		const currentImage =
			currentSlide.querySelector(
				'.hero-slide__image'
			);

		const nextImage =
			nextSlide.querySelector(
				'.hero-slide__image'
			);
		
		const currentTitle =
			currentSlide.querySelector(
				'.hero-slide__title'
			);

		const nextTitle =
			nextSlide.querySelector(
				'.hero-slide__title'
			);
		
		hideTitle(
			currentTitle,
			direction
		);
		
		const previousDot = dots[currentIndex];
		const nextDot = dots[index];

			setTimeout(() => {

				if (previousDot) {
					previousDot.classList.remove('is-active');
				}

			}, 250);

			setTimeout(() => {

				if (nextDot) {
					nextDot.classList.add('is-active');
				}

			}, 500);

		currentImage.classList.add(
			direction === 'next'
				? 'is-slide-out-left'
				: 'is-slide-out-right'
		);

		setTimeout(() => {

			slides.forEach(slide => {
				slide.classList.remove(
					'is-active'
				);
			});			

			nextImage.classList.add(
				direction === 'next'
					? 'is-slide-in-right'
					: 'is-slide-in-left'
			);
			
			nextSlide.classList.add(
				'is-active'
			);
			
			showTitle(
				nextTitle,
				direction
			);

			if (heroButton) {

				heroButton.href =
					nextSlide.dataset.link;

				heroButton.textContent =
					nextSlide.dataset.button;

			}

			requestAnimationFrame(() => {

				requestAnimationFrame(() => {

					nextImage.classList.remove(
						'is-slide-in-right',
						'is-slide-in-left'
					);

				});

			});

			currentImage.classList.remove(
				'is-slide-out-left',
				'is-slide-out-right'
			);

			currentIndex = index;

			setTimeout(() => {

				isAnimating = false;

			}, 1000);

		}, 500);
	}

    function nextSlide() {

    	let nextIndex = currentIndex + 1;

        if (nextIndex >= slides.length) {
            nextIndex = 0;
        }

        showSlide(
			nextIndex,
			'next'
		);
    }

    function prevSlide() {
		
		let prevIndex = currentIndex - 1;

        if (prevIndex < 0) {
            prevIndex = slides.length - 1;
        }

        showSlide(
			prevIndex,
			'prev'
		);
    }

    function startAutoplay() {

		autoplayTimer = setInterval(() => {

			animateArrow('next');

			setTimeout(() => {

				nextSlide();

			}, 500);

		}, 5000);

	}

    function resetAutoplay() {

        clearInterval(autoplayTimer);
        startAutoplay();
    }

    document.addEventListener('click', (event) => {

        const prevButton = event.target.closest('.hero-slide__nav--prev');
        const nextButton = event.target.closest('.hero-slide__nav--next');

        if (!prevButton && !nextButton) {
            return;
        }

        if (prevButton) {

			animateArrow('prev');
			prevSlide();

		}

		if (nextButton) {

			animateArrow('next');
			nextSlide();

		}

        resetAutoplay();
    });
	
	document.addEventListener('click', (event) => {

    const dot = event.target.closest('.hero-slider__dot');

    if (!dot) {
        return;
    }

    showSlide(Number(dot.dataset.slide));

    resetAutoplay();
});

    startAutoplay();
	
	function animateArrow(direction = 'next') {

		const button =
			document.querySelector(
				direction === 'next'
					? '.hero-slide__nav--next'
					: '.hero-slide__nav--prev'
			);

		if (!button) {
			return;
		}

		button.classList.add(
			'is-autoplay'
		);

		setTimeout(() => {

			button.classList.remove(
				'is-autoplay'
			);

		}, 1000);

	}
	
	if (heroSlider) {

    heroSlider.addEventListener('mouseenter', () => {
        clearInterval(autoplayTimer);
    });

    heroSlider.addEventListener('mouseleave', () => {

    clearInterval(autoplayTimer);

    startAutoplay();
});
		
	if (heroSlider) {

		let startX = 0;
		let currentX = 0;
		let isDragging = false;

		const SWIPE_THRESHOLD = 50;

		heroSlider.addEventListener('pointerdown', (event) => {

			if (
				!event.target.closest(
					'.hero-slide__image'
				)
			) {
				return;
			}

			startX = event.clientX;
			currentX = event.clientX;
			isDragging = true;

		});

		heroSlider.addEventListener('pointermove', (event) => {

			if (!isDragging) {
				return;
			}

			currentX = event.clientX;

		});

		heroSlider.addEventListener('pointerup', () => {

			if (!isDragging) {
				return;
			}

			const deltaX = currentX - startX;

			if (Math.abs(deltaX) > SWIPE_THRESHOLD) {

				if (deltaX > 0) {

					animateArrow('prev');
					prevSlide();

				} else {

					animateArrow('next');
					nextSlide();

				}

				resetAutoplay();
			}

			isDragging = false;

		});

		heroSlider.addEventListener('pointercancel', () => {
			isDragging = false;
		});

	}	

}
	
	const subscribeButton =
    document.querySelector(
        '.hero-news-widget__subscribe'
    );

const subscribePopup =
    document.querySelector(
        '#news-subscribe-popup'
    );

if (
    subscribeButton
    && subscribePopup
) {

    subscribeButton.addEventListener(
        'click',
        () => {

            subscribePopup.classList.add(
                'is-active'
            );

        }
    );

    subscribePopup
        .querySelector(
            '.news-subscribe-popup__close'
        )
        .addEventListener(
            'click',
            () => {

                subscribePopup.classList.remove(
                    'is-active'
                );

            }
        );

    subscribePopup
        .querySelector(
            '.news-subscribe-popup__overlay'
        )
        .addEventListener(
            'click',
            () => {

                subscribePopup.classList.remove(
                    'is-active'
                );

            }
        );
}

});

