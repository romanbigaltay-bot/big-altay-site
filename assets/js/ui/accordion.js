/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * UI / Accordion
 * ============================================================================
 */

(() => {

    'use strict';


    /**
     * =========================================================================
     * Constants
     * =========================================================================
     */

    const FILTERS_SELECTOR =
        '.bads-sidebar--filters';

    const ACCORDION_SELECTOR =
        '.bads-accordion';

    const AUTO_CLOSE_DELAY =
        10000;


    /**
     * =========================================================================
     * Accordion
     * =========================================================================
     */

    class BadsAccordion {

        constructor(root) {

            this.root = root;

            this.trigger =
                root.querySelector(
                    '.bads-accordion__trigger'
                );

            this.content =
                root.querySelector(
                    '.bads-accordion__content'
                );

            if (!this.trigger || !this.content) {
                return;
            }

            this.disabled =
                root.classList.contains(
                    'bads-accordion--disabled'
                );

            this.isOpen =
                root.classList.contains(
                    'bads-accordion--open'
                );

            this.onResize =
                this.handleResize.bind(this);

            this.bind();

            this.sync();

        }


        /**
         * =====================================================================
         * Events
         * =====================================================================
         */

        bind() {

            if (this.disabled) {
                return;
            }

            this.trigger.addEventListener(
                'click',
                () => this.toggle()
            );

            window.addEventListener(
                'resize',
                this.onResize
            );

        }


        /**
         * =====================================================================
         * Destroy
         * =====================================================================
         */

        destroy() {

            window.removeEventListener(
                'resize',
                this.onResize
            );

            this.root.removeAttribute(
                'data-bads-ready'
            );

            delete this.root.badsAccordion;

        }


        /**
         * =====================================================================
         * Resize
         * =====================================================================
         */

        handleResize() {

            if (!this.isOpen) {
                return;
            }

            this.setHeight();

        }


        /**
         * =====================================================================
         * Toggle
         * =====================================================================
         */

        toggle() {

            this.isOpen
                ? this.close()
                : this.open();

        }


        /**
         * =====================================================================
         * Open
         * =====================================================================
         */

        open() {

            if (
                this.isOpen ||
                this.disabled
            ) {
                return;
            }

            this.isOpen = true;

            this.root.classList.add(
                'bads-accordion--open'
            );

            this.trigger.setAttribute(
                'aria-expanded',
                'true'
            );

            this.content.setAttribute(
                'aria-hidden',
                'false'
            );

            this.setHeight();

        }


        /**
         * =====================================================================
         * Close
         * =====================================================================
         */

        close() {

            if (!this.isOpen) {
                return;
            }

            this.isOpen = false;

            this.root.classList.remove(
                'bads-accordion--open'
            );

            this.trigger.setAttribute(
                'aria-expanded',
                'false'
            );

            this.content.setAttribute(
                'aria-hidden',
                'true'
            );

            const isFloating = this.root.classList.contains('bads-accordion--select') || 
                               this.root.classList.contains('bads-accordion--dropdown');

            if (isFloating) {
                this.content.style.maxHeight = '';
            } else {
                this.content.style.maxHeight = '0px';
            }

        }


        /**
         * =====================================================================
         * Height
         * =====================================================================
         */

        setHeight() {

            const isFloating = this.root.classList.contains('bads-accordion--select') || 
                               this.root.classList.contains('bads-accordion--dropdown');

            if (isFloating) {
                this.content.style.maxHeight = '';
                return;
            }

            this.content.style.maxHeight =
                this.content.scrollHeight + 'px';

        }


        /**
         * =====================================================================
         * Initial State
         * =====================================================================
         */

        sync() {

            this.trigger.setAttribute(
                'aria-expanded',
                this.isOpen
                    ? 'true'
                    : 'false'
            );

            this.content.setAttribute(
                'aria-hidden',
                this.isOpen
                    ? 'false'
                    : 'true'
            );

            const isFloating = this.root.classList.contains('bads-accordion--select') || 
                               this.root.classList.contains('bads-accordion--dropdown');

            if (this.isOpen) {

                this.setHeight();

            } else {

                if (isFloating) {
                    this.content.style.maxHeight = '';
                } else {
                    this.content.style.maxHeight = '0px';
                }

            }

        }

    }


    /**
 * =========================================================================
 * Filter Accordion Group
 * =========================================================================
 */

class BadsFilterAccordionGroup {

    constructor(root) {

        this.root = root;

        /*
         * Hover отслеживаем только по реальному sidebar.
         *
         * Важно:
         * root = весь grid:
         *
         *   sidebar | content
         *
         * Поэтому события на root ошибочно считали
         * правую часть частью sidebar.
         */
        this.hoverTarget =
            root.querySelector(
                '.bads-sidebar__aside--sticky'
            ) || root;

        this.accordions = [];

        this.closeTimer = null;

        this.isHovered = false;

        this.onMouseEnter =
            this.handleMouseEnter.bind(this);

        this.onMouseMove =
            this.handleMouseMove.bind(this);

        this.onMouseLeave =
            this.handleMouseLeave.bind(this);

        this.init();

    }


    /**
     * =====================================================================
     * Init
     * =====================================================================
     */

    init() {

        this.collectAccordions();

        if (!this.accordions.length) {
            return;
        }

        this.bind();

        this.scheduleAutoClose();

    }


    /**
     * =====================================================================
     * Collect Accordions
     * =====================================================================
     */

    collectAccordions() {

        this.accordions =
            Array.from(
                this.root.querySelectorAll(
                    ACCORDION_SELECTOR
                )
            )
            .map(
                root =>
                    root.badsAccordion
            )
            .filter(Boolean);

    }


    /**
     * =====================================================================
     * Events
     * =====================================================================
     */

    bind() {

        /*
         * Слушаем только sidebar, а не весь grid.
         */
        this.hoverTarget.addEventListener(
            'mouseenter',
            this.onMouseEnter
        );

        this.hoverTarget.addEventListener(
            'mousemove',
            this.onMouseMove
        );

        this.hoverTarget.addEventListener(
            'mouseleave',
            this.onMouseLeave
        );

        this.accordions.forEach(
            accordion => {

                accordion.root.addEventListener(
                    'bads:accordion:open',
                    () => {

                        this.handleOpen(
                            accordion
                        );

                    }
                );

                accordion.root.addEventListener(
                    'bads:accordion:close',
                    () => {

                        this.scheduleAutoClose();

                    }
                );

            }
        );

    }


    /**
     * =====================================================================
     * Mouse Enter
     * =====================================================================
     */

    handleMouseEnter() {

        this.isHovered = true;

        this.clearAutoClose();

    }


    /**
     * =====================================================================
     * Mouse Move
     * =====================================================================
     */

    handleMouseMove() {

        this.isHovered = true;

        this.clearAutoClose();

    }


    /**
     * =====================================================================
     * Mouse Leave
     * =====================================================================
     */

    handleMouseLeave() {

        this.isHovered = false;

        this.scheduleAutoClose();

    }


    /**
     * =====================================================================
     * Handle Open
     * =====================================================================
     */

    handleOpen(activeAccordion) {

        /*
         * Одновременно открыт только один
         * фильтр-accordion.
         */
        this.accordions.forEach(
            accordion => {

                if (
                    accordion !== activeAccordion &&
                    accordion.isOpen
                ) {

                    accordion.close();

                }

            }
        );

        /*
         * Пока пользователь взаимодействует
         * с sidebar, автозакрытие не нужно.
         */
        this.clearAutoClose();

    }


    /**
     * =====================================================================
     * Schedule Auto Close
     * =====================================================================
     */

    scheduleAutoClose() {

        this.clearAutoClose();

        /*
         * Если курсор всё ещё находится
         * внутри sidebar — ничего не делаем.
         */
        if (this.isHovered) {
            return;
        }

        this.closeTimer =
            window.setTimeout(
                () => {

                    this.closeAll();

                },
                AUTO_CLOSE_DELAY
            );

    }


    /**
     * =====================================================================
     * Clear Auto Close
     * =====================================================================
     */

    clearAutoClose() {

        if (this.closeTimer === null) {
            return;
        }

        window.clearTimeout(
            this.closeTimer
        );

        this.closeTimer = null;

    }


    /**
     * =====================================================================
     * Close All
     * =====================================================================
     */

    closeAll() {

        this.clearAutoClose();

        this.accordions.forEach(
            accordion => {

                if (accordion.isOpen) {

                    accordion.close();

                }

            }
        );

    }


    /**
     * =====================================================================
     * Destroy
     * =====================================================================
     */

    destroy() {

        this.clearAutoClose();

        /*
         * Удаляем события именно с hoverTarget,
         * поскольку они были установлены не на root.
         */
        this.hoverTarget.removeEventListener(
            'mouseenter',
            this.onMouseEnter
        );

        this.hoverTarget.removeEventListener(
            'mousemove',
            this.onMouseMove
        );

        this.hoverTarget.removeEventListener(
            'mouseleave',
            this.onMouseLeave
        );

        this.root.removeAttribute(
            'data-bads-filter-accordion-ready'
        );

        delete this.root.badsFilterAccordion;

    }

}


    /**
     * =========================================================================
     * Accordion Events
     * =========================================================================
     *
     * Добавляем собственные события поверх существующего API.
     * Это позволяет группам реагировать на open / close,
     * не связывая сам BadsAccordion с конкретным типом страницы.
     * =========================================================================
     */

    const originalOpen =
        BadsAccordion.prototype.open;

    BadsAccordion.prototype.open =
        function () {

            const wasOpen =
                this.isOpen;

            originalOpen.call(this);

            if (!wasOpen && this.isOpen) {

                this.root.dispatchEvent(
                    new CustomEvent(
                        'bads:accordion:open',
                        {
                            bubbles: false,
                        }
                    )
                );

            }

        };


    const originalClose =
        BadsAccordion.prototype.close;

    BadsAccordion.prototype.close =
        function () {

            const wasOpen =
                this.isOpen;

            originalClose.call(this);

            if (wasOpen && !this.isOpen) {

                this.root.dispatchEvent(
                    new CustomEvent(
                        'bads:accordion:close',
                        {
                            bubbles: false,
                        }
                    )
                );

            }

        };


    /**
     * =========================================================================
     * Init Accordions
     * =========================================================================
     */

    function initAccordion(context = document) {

        context
            .querySelectorAll(
                ACCORDION_SELECTOR
            )
            .forEach(root => {

                if (root.dataset.badsReady) {
                    return;
                }

                root.dataset.badsReady =
                    'true';

                root.badsAccordion =
                    new BadsAccordion(root);

            });

    }


    /**
     * =========================================================================
     * Init Filter Groups
     * =========================================================================
     */

    function initFilterAccordionGroups(
        context = document
    ) {

        context
            .querySelectorAll(
                FILTERS_SELECTOR
            )
            .forEach(root => {

                if (
                    root.dataset
                        .badsFilterAccordionReady
                ) {
                    return;
                }

                root.dataset
                    .badsFilterAccordionReady =
                    'true';

                root.badsFilterAccordion =
                    new BadsFilterAccordionGroup(
                        root
                    );

            });

    }


    /**
     * =========================================================================
     * Public API
     * =========================================================================
     */

    window.BADS =
        window.BADS || {};


    window.BADS.accordion = {

        init(context = document) {

            initAccordion(context);

            /*
             * Filter groups инициализируются после
             * самих accordion, поскольку группа получает
             * экземпляры через root.badsAccordion.
             */

            initFilterAccordionGroups(context);

        },


        open(root) {

            root?.badsAccordion?.open();

        },


        close(root) {

            root?.badsAccordion?.close();

        },


        toggle(root) {

            root?.badsAccordion?.toggle();

        },


        destroy(root) {

            root?.badsAccordion?.destroy();

        },


        closeAll(context = document) {

            context
                .querySelectorAll(
                    ACCORDION_SELECTOR
                )
                .forEach(root => {

                    root.badsAccordion?.close();

                });

        },

    };


    /**
     * =========================================================================
     * DOM Ready
     * =========================================================================
     */

    if (
        document.readyState ===
        'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            () => {

                window.BADS.accordion.init();

            }
        );

    } else {

        window.BADS.accordion.init();

    }

})();