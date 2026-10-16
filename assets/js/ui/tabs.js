/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Tabs
 * ============================================================================
 */

window.BADS = window.BADS || {};

/**
 * ============================================================================
 * Tabs
 * ============================================================================
 */

window.BADS.initTabs = function (root = document) {

    const tabGroups = root.querySelectorAll('.bads-tabs');

    if (!tabGroups.length) {
        return;
    }

    tabGroups.forEach((tabs) => {

        /*
        |--------------------------------------------------------------------------
        | Prevent double initialization
        |--------------------------------------------------------------------------
        */

        if (tabs.dataset.badsTabsInitialized === 'true') {
            return;
        }

        tabs.dataset.badsTabsInitialized = 'true';

        const buttons = tabs.querySelectorAll('.bads-tabs__tab');
        const panels  = tabs.querySelectorAll('.bads-tabs__panel');

        if (!buttons.length || !panels.length) {
            return;
        }

        /**
         * ----------------------------------------------------------------------
         * Activate
         * ----------------------------------------------------------------------
         */

        const activateTab = (button) => {

            const target = button.getAttribute('aria-controls');

            /*
            |--------------------------------------------------------------------------
            | Tabs
            |--------------------------------------------------------------------------
            */

            buttons.forEach((tab) => {

                const active = tab === button;

                tab.classList.toggle(
                    'bads-tabs__tab--active',
                    active
                );

                tab.setAttribute(
                    'aria-selected',
                    active ? 'true' : 'false'
                );

                tab.setAttribute(
                    'tabindex',
                    active ? '0' : '-1'
                );

            });

            /*
            |--------------------------------------------------------------------------
            | Panels
            |--------------------------------------------------------------------------
            */

            panels.forEach((panel) => {

                const active = panel.id === target;

                panel.classList.toggle(
                    'bads-tabs__panel--active',
                    active
                );

                panel.hidden = !active;

                panel.setAttribute(
                    'aria-hidden',
                    active ? 'false' : 'true'
                );

            });

        };

        /*
        |--------------------------------------------------------------------------
        | Click
        |--------------------------------------------------------------------------
        */

        buttons.forEach((button) => {

            button.addEventListener('click', () => {

                activateTab(button);

            });

        });

        /*
        |--------------------------------------------------------------------------
        | Keyboard Navigation
        |--------------------------------------------------------------------------
        */

        buttons.forEach((button, index) => {

            button.addEventListener('keydown', (event) => {

                let nextIndex;

                switch (event.key) {

                    case 'ArrowRight':

                        nextIndex =
                            index + 1 < buttons.length
                                ? index + 1
                                : 0;

                        break;

                    case 'ArrowLeft':

                        nextIndex =
                            index - 1 >= 0
                                ? index - 1
                                : buttons.length - 1;

                        break;

                    case 'Home':

                        nextIndex = 0;

                        break;

                    case 'End':

                        nextIndex = buttons.length - 1;

                        break;

                    default:

                        return;

                }

                event.preventDefault();

                const nextTab = buttons[nextIndex];

                nextTab.focus();

                activateTab(nextTab);

            });

        });

        /*
        |--------------------------------------------------------------------------
        | Initial State
        |--------------------------------------------------------------------------
        */

        const active =
            tabs.querySelector('.bads-tabs__tab--active')
            || buttons[0];

        activateTab(active);

    });

};

/**
 * ============================================================================
 * Auto Init
 * ============================================================================
 */

document.addEventListener('DOMContentLoaded', () => {

    window.BADS.initTabs();

});