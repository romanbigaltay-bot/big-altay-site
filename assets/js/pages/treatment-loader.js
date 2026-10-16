document.addEventListener('DOMContentLoaded', () => {

    /**
     * =========================================================================
     * Initialize every Treatment Workspace
     * =========================================================================
     */

    document
        .querySelectorAll('[data-treatment-workspace]')
        .forEach(initWorkspace);

    /**
     * =========================================================================
     * Workspace
     * =========================================================================
     */

    function initWorkspace(workspace) {

        const content = workspace.querySelector(
            '[data-treatment-content]'
        );

        if (!content) {
            return;
        }

        const cache = new Map();

        /**
         * =====================================================================
         * Load Treatment
         * =====================================================================
         */

        async function load(postId, button = null, scroll = true) {

            if (!postId) {
                return;
            }

            setActive(button);

            fadeOut();

            /**
             * ================================================================
             * Cache
             * ================================================================
             */

            if (cache.has(postId)) {

                content.innerHTML = cache.get(postId);

                afterContentLoaded(button, scroll);

                return;

            }

            try {

                const formData = new FormData();

                formData.append(
                    'action',
                    'load_treatment_direction'
                );

                formData.append(
                    'post_id',
                    postId
                );

                const response = await fetch(
                    badsTreatment.ajaxUrl,
                    {
                        method: 'POST',
                        body: formData,
                    }
                );

                const result = await response.json();

                if (!result.success) {

                    fadeIn();

                    return;

                }

                cache.set(
                    postId,
                    result.data.html
                );

                content.innerHTML = result.data.html;

                afterContentLoaded(button, scroll);

            } catch (error) {

                console.error(error);

                fadeIn();

            }

        }

        /**
         * =====================================================================
         * After Content Loaded
         * =====================================================================
         */

        function afterContentLoaded(button, scroll) {

			window.BADS?.initTabs?.(content);

			updateCurrentTitle(button);

			closeAccordion();

			if (scroll) {

				scrollToWorkspace();

			}

			fadeIn();

		}
		
        /**
         * =====================================================================
         * Active Button
         * =====================================================================
         */

        function setActive(activeButton) {

            workspace
                .querySelectorAll('[data-treatment-button]')
                .forEach(button => {

                    const active = button === activeButton;

                    button.classList.toggle(
                        'is-active',
                        active
                    );

                    button.setAttribute(
                        'aria-selected',
                        active
                    );

                });

        }

        /**
         * =====================================================================
         * Update Mobile Title
         * =====================================================================
         */

        function updateCurrentTitle(button) {

            if (!button) {
                return;
            }

            const current = workspace.querySelector(
                '[data-treatment-current]'
            );

            if (!current) {
                return;
            }

            const text = button.querySelector('.bads-btn__text');

            current.textContent = text
                ? text.textContent.trim()
                : button.textContent.trim();

        }

        /**
         * =====================================================================
         * Close Mobile Accordion
         * =====================================================================
         */

        function closeAccordion() {

            const accordion = workspace.querySelector(
                '.bads-accordion'
            );

            if (!accordion) {
                return;
            }

            window.BADS?.accordion?.close(
                accordion
            );

        }
		
		/**
		* =====================================================================
		* Scroll To Workspace
		* =====================================================================
		*/

		function scrollToWorkspace() {

				const section = workspace.closest('#treatment');

				if (!section) {
					return;
				}

				const offset = 100;

				const top =
					section.getBoundingClientRect().top +
					window.pageYOffset -
					offset;

				window.scrollTo({
					top,
					behavior: 'smooth',
				});

		}

        /**
         * =====================================================================
         * Fade
         * =====================================================================
         */

        function fadeOut() {

            content.style.opacity = '.35';

        }

        function fadeIn() {

            requestAnimationFrame(() => {

                content.style.opacity = '1';

            });

        }

        /**
         * =====================================================================
         * Initial Load
         * =====================================================================
         */

        const firstButton = workspace.querySelector(
            '[data-treatment-button]'
        );

        if (firstButton) {

            load(
				firstButton.dataset.treatmentId,
				firstButton,
				false
			);

        }

        /**
         * =====================================================================
         * Click
         * =====================================================================
         */

        workspace.addEventListener(
            'click',
            event => {

                const button = event.target.closest(
                    '[data-treatment-button]'
                );

                if (!button) {
                    return;
                }

                event.preventDefault();

                load(
                    button.dataset.treatmentId,
                    button
                );

            }
        );

    }

});