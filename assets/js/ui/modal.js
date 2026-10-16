/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Modal
 * ============================================================================
 */

(() => {
    'use strict';

    const SELECTORS = {
        modal: '[data-modal]',
        trigger: '[data-modal-trigger]',
        close: '[data-modal-close]',
        dialog: '.bads-modal__dialog',
    };

    const CLASSES = {
        visible: 'is-visible',
    };

    let activeModal = null;
    let lastFocusedElement = null;

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    function getModal(target) {

        if (!target) {
            return null;
        }

        if (typeof target === 'string') {
            return document.querySelector(target);
        }

        if (target instanceof Element) {
            if (target.matches(SELECTORS.modal)) {
                return target;
            }
            return target.closest(SELECTORS.modal);
        }
        return null;
    }

    function getFocusableElements(modal) {
        return [
            ...modal.querySelectorAll(
                'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'
            )
        ];
    }

    function lockScroll() {
        document.documentElement.classList.add('bads-modal-open');
        document.body.classList.add('bads-modal-open');
    }

    function unlockScroll() {
        document.documentElement.classList.remove('bads-modal-open');
        document.body.classList.remove('bads-modal-open');
    }

    /*
    |--------------------------------------------------------------------------
    | Open
    |--------------------------------------------------------------------------
    */

    function open(target) {

        const modal = getModal(target);

        if (!modal) {
            return;
        }

        lastFocusedElement = document.activeElement;

        activeModal = modal;

        modal.hidden = false;

        modal.setAttribute('aria-hidden', 'false');

        lockScroll();

        requestAnimationFrame(() => {

            modal.classList.add(CLASSES.visible);

            const focusable = getFocusableElements(modal);

            if (focusable.length) {
                focusable[0].focus();
            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Close
    |--------------------------------------------------------------------------
    */

    function close(target = activeModal) {
        const modal = getModal(target);

        if (!modal) {
            return;
        }

        modal.classList.remove(CLASSES.visible);
        modal.setAttribute('aria-hidden', 'true');
        unlockScroll();
        activeModal = null;

        setTimeout(() => {
            modal.hidden = true;
        }, 250);

        if (lastFocusedElement) {
            lastFocusedElement.focus();
            lastFocusedElement = null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Focus Trap
    |--------------------------------------------------------------------------
    */

    function trapFocus(event) {
		
        if (!activeModal) {
            return;
        }

        if (event.key !== 'Tab') {
            return;
        }

        const focusable = getFocusableElements(activeModal);

        if (!focusable.length) {
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        }

        if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest(SELECTORS.trigger);

        if (trigger) {
            const target = trigger.dataset.modalTarget;
			
            if (target) {
                open(target);
            }

            return;
        }


        const closeButton = event.target.closest(SELECTORS.close);
		
        if (closeButton) {
            close(closeButton);
        }		
    });

    document.addEventListener('keydown', (event) => {

        if (!activeModal) {
            return;
        }

        if (event.key === 'Escape') {
            close();
            return;
        }

        trapFocus(event);
    });

    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    window.BADS = window.BADS || {};

    window.BADS.modal = {
        open,
        close,
    };

})();