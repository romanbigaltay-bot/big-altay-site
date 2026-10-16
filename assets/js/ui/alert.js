/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Alert
 * ============================================================================
 */

(() => {
    'use strict';
    const SELECTORS = {
        alert: '[data-alert]',
        close: '[data-alert-close]',
    };

    const CLASSES = {
        hidden: 'is-hidden',
        closing: 'is-closing',
    };

    const TRANSITION_DURATION = 300;

    /**
     * =========================================================================
     * Helpers
     * =========================================================================
     */

    function isElement(element) {
        return element instanceof Element;
    }

    function getAlert(target) {
        if (!target) {
            return null;
        }

        if (typeof target === 'string') {
            return document.querySelector(target);
        }

        if (isElement(target)) {
            if (target.matches(SELECTORS.alert)) {
                return target;
            }

            return target.closest(SELECTORS.alert);
        }

        return null;
    }



    function getTransitionTimer(alert) {
        return alert.__badsAlertTimer || null;
    }

    function clearTransitionTimer(alert) {
        const timer = getTransitionTimer(alert);
		
        if (!timer) {
            return;
        }

        clearTimeout(timer);
        alert.__badsAlertTimer = null;
    }
	
    function setTimer(alert, callback) {
        clearTransitionTimer(alert);

        alert.__badsAlertTimer = setTimeout(() => {
            alert.__badsAlertTimer = null;
            callback();
        }, TRANSITION_DURATION);

    }

    function show(alert) {
        clearTransitionTimer(alert);
        alert.hidden = false;
		
        alert.classList.remove(
            CLASSES.hidden,
            CLASSES.closing
        );
		
        alert.setAttribute(
            'aria-hidden',
            'false'
        );

        requestAnimationFrame(() => {
            alert.classList.remove(
                CLASSES.hidden
            );
        });
    }

    function hideImmediately(alert) {
        clearTransitionTimer(alert);
		
        alert.classList.add(
            CLASSES.hidden
        );
		
        alert.hidden = true;

        alert.setAttribute(
            'aria-hidden',
            'true'
        );
    }

    /**
     * =========================================================================
     * Public API
     * =========================================================================
     */

    function open(target) {
        const alert = getAlert(target);
		
        if (!alert) {
            return;
        }
		
        show(alert);
    }

    function close(target) {
		
        const alert = getAlert(target);
		
        if (!alert) {
            return;
        }

        if (
            alert.classList.contains(
                CLASSES.closing
            )
        ) {
            return;
        }

        clearTransitionTimer(alert);
		
        alert.classList.add(
            CLASSES.closing
        );

        alert.setAttribute(
            'aria-hidden',
            'true'
        );
		
        setTimer(alert, () => {
            hideImmediately(alert);
            alert.classList.remove(
                CLASSES.closing
            );
        });
    }

    function toggle(target) {
        const alert = getAlert(target);

        if (!alert) {
            return;
        }
		
        if (
            alert.hidden ||
            alert.classList.contains(
                CLASSES.hidden
            )
        ) {
            open(alert);

        } else {
            close(alert);
        }
    }

    /**
     * =========================================================================
     * Initialization
     * =========================================================================
     */


    function hydrate(alert) {
        if (!alert.matches(SELECTORS.alert)) {
            return;
        }

        if (
            alert.dataset.badsAlertReady === 'true'
        ) {
            return;
        }

        alert.dataset.badsAlertReady = 'true';

        if (alert.hidden) {
            alert.classList.add(
                CLASSES.hidden
            );

            alert.setAttribute(
                'aria-hidden',
                'true'
            );
			
            return;
        }
		
        alert.classList.remove(
            CLASSES.hidden,
            CLASSES.closing
        );

        alert.hidden = false;

        alert.setAttribute(
            'aria-hidden',
            'false'
        );
    }

    function init(context = document) {
		
        const root = isElement(context)
            ? context
            : document;
		
        root
            .querySelectorAll(
                SELECTORS.alert
            )
		
            .forEach(hydrate);
    }

    /**
     * =========================================================================
     * Events
     * =========================================================================
     */

    document.addEventListener(
        'click',
        (event) => {

            const closeButton = event.target.closest(
                SELECTORS.close
            );

            if (!closeButton) {
                return;
            }

            const alert = closeButton.closest(
                SELECTORS.alert
            );

            if (!alert) {
                return;
            }

            close(alert);
        }
    );

    /**
     * =========================================================================
     * Keyboard
     * =========================================================================
     */

    document.addEventListener(
        'keydown',
        (event) => {

            if (event.key !== 'Escape') {
                return;
            }

            const alert = document.querySelector(
                `${SELECTORS.alert}:not([hidden])`
            );

            if (alert) {
                close(alert);
            }
        }
    );

    /**
     * =========================================================================
     * Start
     * =========================================================================
     */


    if (
        document.readyState === 'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            () => init()
        );

    } else {
		
        init();
    }

    /**
     * =========================================================================
     * BADS Global API
     * =========================================================================
     */

    window.BADS = window.BADS || {};

    window.BADS.alert = {
        init,
        hydrate,
        open,
        close,
        toggle,
    };
})();