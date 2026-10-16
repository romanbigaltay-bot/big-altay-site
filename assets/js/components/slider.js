/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Components / Slider (Vanilla JS, 2026 Standards)
 * ============================================================================
 */

(function () {
    'use strict';

    class BadsSlider {
        constructor(element) {
            if (!element || element.dataset.badsSliderInitialized) {
                return;
            }

            this.slider = element;
            this.viewport = element.querySelector('.bads-slider__viewport');
            this.track = element.querySelector('.bads-slider__track');
            this.slides = Array.from(element.querySelectorAll('.bads-slider__slide'));

            if (!this.track || this.slides.length <= 1) {
                // If 0 or 1 slide, hide arrows and dots if present
                const controls = element.querySelector('.bads-slider__controls');
                if (controls) {
                    controls.style.display = 'none';
                }
                return;
            }

            // Controls can be inside slider or in an external container referenced by data-controls-target
            let controlsContainer = element;
            if (element.dataset.controlsTarget) {
                const target = document.querySelector(element.dataset.controlsTarget);
                if (target) {
                    controlsContainer = target;
                }
            }

            this.prevBtn = controlsContainer.querySelector('[data-slider-prev]');
            this.nextBtn = controlsContainer.querySelector('[data-slider-next]');
            this.dots = Array.from(controlsContainer.querySelectorAll('[data-slide-to]'));
            this.counterCurrent = controlsContainer.querySelector('.bads-slider__counter-current');

            // Options from dataset
            this.isLoop = element.dataset.loop !== 'false';
            this.isAutoplay = element.dataset.autoplay === 'true';
            this.autoplaySpeed = parseInt(element.dataset.autoplaySpeed, 10) || 5000;

            this.currentIndex = 0;
            this.realIndex = 0;
            this.totalSlides = this.slides.length;
            this.autoplayTimer = null;
            this.isTransitioning = false;

            // Setup cloned slides for true seamless infinite loop without fast rewind
            if (this.isLoop && this.totalSlides > 1) {
                const firstClone = this.slides[0].cloneNode(true);
                const lastClone = this.slides[this.totalSlides - 1].cloneNode(true);
                firstClone.classList.add('bads-slider__slide--clone');
                lastClone.classList.add('bads-slider__slide--clone');
                firstClone.setAttribute('aria-hidden', 'true');
                lastClone.setAttribute('aria-hidden', 'true');

                this.track.appendChild(firstClone);
                this.track.insertBefore(lastClone, this.track.firstElementChild);

                this.allSlides = Array.from(this.track.querySelectorAll('.bads-slider__slide'));
                // Track starts at offset 1 (the original first slide)
                this.currentIndex = 1;
                this.realIndex = 0;
            } else {
                this.allSlides = this.slides;
                this.currentIndex = 0;
                this.realIndex = 0;
            }

            // Touch / Pointer drag state
            this.isDragging = false;
            this.startX = 0;
            this.currentX = 0;
            this.diffX = 0;
            this.dragThreshold = 45;

            this.init();
        }

        init() {
            this.slider.dataset.badsSliderInitialized = 'true';

            // Track transition end listener for loop wrap
            this.track.addEventListener('transitionend', (e) => {
                if (e.target !== this.track || e.propertyName !== 'transform') return;
                this.isTransitioning = false;
                if (!this.isLoop || this.totalSlides <= 1) return;

                if (this.currentIndex === 0) {
                    // Jump from clone of last slide to real last slide without animation
                    this.track.style.transition = 'none';
                    this.currentIndex = this.totalSlides;
                    this.track.style.transform = `translateX(-${this.currentIndex * 100}%)`;
                    // Synchronize active classes on slides
                    this.allSlides.forEach((slide, i) => {
                        slide.classList.toggle('is-active', i === this.currentIndex);
                    });
                    // Force reflow
                    void this.track.offsetHeight;
                    this.track.style.transition = '';
                } else if (this.currentIndex === this.totalSlides + 1) {
                    // Jump from clone of first slide to real first slide without animation
                    this.track.style.transition = 'none';
                    this.currentIndex = 1;
                    this.track.style.transform = `translateX(-${this.currentIndex * 100}%)`;
                    // Synchronize active classes on slides
                    this.allSlides.forEach((slide, i) => {
                        slide.classList.toggle('is-active', i === this.currentIndex);
                    });
                    // Force reflow
                    void this.track.offsetHeight;
                    this.track.style.transition = '';
                }
            });

            // Events
            if (this.prevBtn) {
                this.prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.prev();
                });
            }

            if (this.nextBtn) {
                this.nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.next();
                });
            }

            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.goToReal(index);
                });
            });

            // Keyboard navigation
            this.slider.setAttribute('tabindex', '0');
            this.slider.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    this.prev();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    this.next();
                }
            });

            // Pointer / Swipe support
            this.bindPointerEvents();

            // Card click delegation for cards with data-card-link or clickable slides
            this.bindCardClickEvents();

            // Autoplay support - pause ONLY when hovered directly over slider
            if (this.isAutoplay) {
                this.startAutoplay();
                this.slider.addEventListener('mouseenter', () => this.stopAutoplay());
                this.slider.addEventListener('mouseleave', () => this.startAutoplay());
                this.slider.addEventListener('focusin', () => this.stopAutoplay());
                this.slider.addEventListener('focusout', () => this.startAutoplay());
            }

            // Sync initial state instantly without transition
            this.track.style.transition = 'none';
            this.updateState();
            void this.track.offsetHeight;
            this.track.style.transition = '';
        }

        bindPointerEvents() {
            const viewport = this.viewport || this.track;
            let wasDragged = false;

            viewport.addEventListener('pointerdown', (e) => {
                // If user clicks a button or form link, do not initiate dragging
                if (e.target.closest('button, .bads-btn, a[href^="#"], input, select, textarea')) {
                    return;
                }

                this.isDragging = true;
                wasDragged = false;
                this.startX = e.clientX;
                this.currentX = e.clientX;
                this.diffX = 0;
                this.track.classList.add('is-dragging');

                if (viewport.setPointerCapture) {
                    try {
                        viewport.setPointerCapture(e.pointerId);
                    } catch (err) {}
                }
            });

            viewport.addEventListener('pointermove', (e) => {
                if (!this.isDragging) return;

                this.currentX = e.clientX;
                this.diffX = this.currentX - this.startX;

                if (Math.abs(this.diffX) > 6) {
                    wasDragged = true;
                }

                // Restrict overscroll when !isLoop on bounds
                if (!this.isLoop) {
                    if ((this.currentIndex === 0 && this.diffX > 0) ||
                        (this.currentIndex === this.totalSlides - 1 && this.diffX < 0)) {
                        this.diffX = this.diffX * 0.3; // Resistance
                    }
                }

                const baseTranslatePercent = -this.currentIndex * 100;
                const trackWidth = this.viewport.offsetWidth || 1;
                const dragPercent = (this.diffX / trackWidth) * 100;

                this.track.style.transform = `translateX(${baseTranslatePercent + dragPercent}%)`;
            });

            const onPointerEnd = (e) => {
                if (!this.isDragging) return;
                this.isDragging = false;
                this.track.classList.remove('is-dragging');

                if (viewport.releasePointerCapture && e.pointerId) {
                    try {
                        viewport.releasePointerCapture(e.pointerId);
                    } catch (err) {}
                }

                const dragDistance = this.diffX;
                const hadDragMovement = wasDragged || Math.abs(dragDistance) > 10;

                if (Math.abs(dragDistance) > this.dragThreshold) {
                    if (dragDistance > 0) {
                        this.prev();
                    } else {
                        this.next();
                    }
                } else {
                    // Snap back
                    this.goToTrack(this.currentIndex);
                }

                // Prevent click bubbling only if drag movement was meaningful
                if (hadDragMovement) {
                    const preventClick = (clickEvent) => {
                        clickEvent.preventDefault();
                        clickEvent.stopPropagation();
                        viewport.removeEventListener('click', preventClick, true);
                    };
                    viewport.addEventListener('click', preventClick, true);
                }

                this.diffX = 0;
            };

            viewport.addEventListener('pointerup', onPointerEnd);
            viewport.addEventListener('pointercancel', onPointerEnd);
        }

        bindCardClickEvents() {
            const viewport = this.viewport || this.track;

            viewport.addEventListener('click', (e) => {
                // If this was an active drag, ignore
                if (this.diffX !== 0 || this.isDragging) return;

                // 1. Check if user clicked an explicit button or link leading to lead form or action
                const clickedActionButton = e.target.closest('a[href^="#"], button, .bads-btn, input, textarea');
                if (clickedActionButton) {
                    // Let default browser navigation to #lead-form work normally
                    return;
                }

                // 2. Check if clicked an explicit anchor link
                const clickedLink = e.target.closest('a[href]');
                if (clickedLink && clickedLink.href) {
                    window.location.href = clickedLink.href;
                    return;
                }

                // 3. Otherwise, check if user clicked inside a card with data-card-link or a slide
                const cardWithLink = e.target.closest('[data-card-link]');
                if (cardWithLink && cardWithLink.dataset.cardLink) {
                    const targetUrl = cardWithLink.dataset.cardLink;
                    if (targetUrl) {
                        window.location.href = targetUrl;
                    }
                }
            });
        }

        goToReal(realIndex) {
            if (this.isTransitioning) return;
            if (realIndex < 0) realIndex = 0;
            if (realIndex >= this.totalSlides) realIndex = this.totalSlides - 1;

            const targetTrackIndex = (this.isLoop && this.totalSlides > 1) ? realIndex + 1 : realIndex;
            this.goToTrack(targetTrackIndex);
        }

        goToTrack(trackIndex) {
            if (this.isTransitioning) return;
            this.isTransitioning = true;
            this.currentIndex = trackIndex;

            if (this.isLoop && this.totalSlides > 1) {
                if (this.currentIndex === 0) {
                    this.realIndex = this.totalSlides - 1;
                } else if (this.currentIndex === this.totalSlides + 1) {
                    this.realIndex = 0;
                } else {
                    this.realIndex = this.currentIndex - 1;
                }
            } else {
                this.realIndex = this.currentIndex;
            }

            this.updateState();
        }

        next() {
            if (this.isTransitioning) return;
            if (this.isLoop && this.totalSlides > 1) {
                this.goToTrack(this.currentIndex + 1);
            } else {
                if (this.currentIndex < this.totalSlides - 1) {
                    this.goToTrack(this.currentIndex + 1);
                }
            }
        }

        prev() {
            if (this.isTransitioning) return;
            if (this.isLoop && this.totalSlides > 1) {
                this.goToTrack(this.currentIndex - 1);
            } else {
                if (this.currentIndex > 0) {
                    this.goToTrack(this.currentIndex - 1);
                }
            }
        }

        updateState() {
            // Apply track transform
            this.track.style.transform = `translateX(-${this.currentIndex * 100}%)`;

            // Update active slides
            this.allSlides.forEach((slide, i) => {
                const isActive = (i === this.currentIndex);
                slide.classList.toggle('is-active', isActive);
                slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
            });

            // Update pagination dots according to realIndex
            if (this.dots.length) {
                this.dots.forEach((dot, i) => {
                    const isActive = (i === this.realIndex);
                    dot.classList.toggle('is-active', isActive);
                    dot.setAttribute('aria-selected', isActive ? 'true' : 'false');
                });
            }

            // Update counter if present
            if (this.counterCurrent) {
                this.counterCurrent.textContent = String(this.realIndex + 1).padStart(2, '0');
            }

            // Update arrow disabled states when !isLoop
            if (!this.isLoop) {
                if (this.prevBtn) {
                    this.prevBtn.disabled = (this.currentIndex === 0);
                }
                if (this.nextBtn) {
                    this.nextBtn.disabled = (this.currentIndex === this.totalSlides - 1);
                }
            }
        }

        startAutoplay() {
            this.stopAutoplay();
            this.autoplayTimer = setInterval(() => {
                this.next();
            }, this.autoplaySpeed);
        }

        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        }
    }

    function initSliders() {
        const sliders = document.querySelectorAll('[data-bads-slider]');
        sliders.forEach((el) => {
            new BadsSlider(el);
        });
    }

    // Export globally for AJAX/dynamic usage
    window.BadsSlider = BadsSlider;
    window.badsInitSliders = initSliders;

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSliders);
    } else {
        initSliders();
    }
})();
