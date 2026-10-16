/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Components / Main Menu (Mobile Drawer Trigger & Accessibility)
 * ============================================================================
 * 
 * Управление открытием/закрытием выдвижной панели мобильного меню.
 * Аккордеоны подменю внутри мобильного меню обслуживаются штатным UI/accordion.js.
 */

(function () {
    'use strict';

    function getDrawer() {
        return document.querySelector('.js-bads-drawer');
    }

    /**
     * Ensures drawer is a direct child of <body> so no sticky header,
     * transform or containment hierarchy can ever clip or constrain it.
     */
    function ensureDrawerInBody() {
        const drawer = getDrawer();
        if (drawer && drawer.parentNode !== document.body) {
            document.body.appendChild(drawer);
        }
    }

    function openDrawer() {
        const drawer = getDrawer();
        if (!drawer) return;

        ensureDrawerInBody();
        drawer.classList.add('is-open');
        drawer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('bads-drawer-open');
        const closeBtn = drawer.querySelector('.js-bads-drawer-close');
        if (closeBtn) {
            closeBtn.focus();
        }
    }

    function closeDrawer() {
        const drawer = getDrawer();
        if (!drawer) return;
        drawer.classList.remove('is-open');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('bads-drawer-open');
    }

    // Direct event delegation on document - never fails regardless of load timing
    document.addEventListener('click', function (e) {
        const hamburger = e.target.closest('.js-bads-hamburger');
        if (hamburger) {
            e.preventDefault();
            e.stopPropagation();
            openDrawer();
            return;
        }

        const closeTrigger = e.target.closest('.js-bads-drawer-close, .js-bads-drawer-backdrop');
        if (closeTrigger) {
            e.preventDefault();
            e.stopPropagation();
            closeDrawer();
            return;
        }

        // Close drawer when clicking any modal/fancybox trigger or internal hash link inside the drawer
        const modalOrHashTrigger = e.target.closest('.js-bads-drawer [data-modal-trigger], .js-bads-drawer [data-fancybox], .js-bads-drawer a[href^="#"]');
        if (modalOrHashTrigger) {
            closeDrawer();
            // Do not preventDefault or stopPropagation so Modal or smooth scroll handler can proceed
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const drawer = getDrawer();
            if (drawer && drawer.classList.contains('is-open')) {
                closeDrawer();
            }
        }
    });

    /**
     * ========================================================================
     * Sticky Header & Layout Coordination Orchestrator
     * ========================================================================
     * 1. Dynamically syncs --bads-sticky-top and --bads-header-height
     *    with admin bar & sticky header height to prevent header/sidebar collision.
     * 2. Smoothly docks window to scrollY = 0 when user returns near the top,
     *    ensuring breadcrumbs & top sections are never clipped.
     * 3. Prevents layout jumping and CLS with synchronized threshold physics.
     */
    function initStickyHeader() {
        const header = document.querySelector('.bads-header');
        if (!header) return;

        const stickyThreshold = 80;
        const releaseThreshold = 35;
        let ticking = false;
        let lastScrollY = window.pageYOffset || document.documentElement.scrollTop;
        let scrollDirection = 'down';
        let topDockTimeout = null;
        let isAutoDocking = false;

        function updateMetrics() {
            const adminBar = document.getElementById('wpadminbar');
            const hasFixedAdminBar = adminBar && window.getComputedStyle(adminBar).position === 'fixed';
            const adminBarHeight = hasFixedAdminBar 
                ? adminBar.offsetHeight 
                : (document.body.classList.contains('admin-bar') ? 32 : 0);

            const isSticky = header.classList.contains('is-sticky');
            const currentHeight = header.offsetHeight;

            // When sticky, logo is 60px and total header is ~72-76px
            const stickyHeaderHeight = isSticky 
                ? currentHeight 
                : Math.max(Math.round(currentHeight * 0.72), 72);

            // Clean 28px breathing clearance between header bottom (+ drop shadow) and sticky sidebar
            const stickyTop = adminBarHeight + stickyHeaderHeight + 28;

            document.documentElement.style.setProperty('--bads-sticky-top', stickyTop + 'px');
            document.documentElement.style.setProperty('--bads-header-height', currentHeight + 'px');
            document.documentElement.style.setProperty('--bads-sticky-header-height', stickyHeaderHeight + 'px');
        }

        function checkTopDock(scrollY) {
            if (topDockTimeout) {
                clearTimeout(topDockTimeout);
                topDockTimeout = null;
            }

            // Only consider auto-docking if scrolling UP and within the near-top landing zone (1px to 45px)
            if (scrollDirection === 'up' && scrollY > 0 && scrollY <= 45 && !isAutoDocking) {
                topDockTimeout = setTimeout(function () {
                    const currentY = window.pageYOffset || document.documentElement.scrollTop;
                    if (currentY > 0 && currentY <= 45) {
                        isAutoDocking = true;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        setTimeout(function () {
                            isAutoDocking = false;
                            updateMetrics();
                        }, 400);
                    }
                }, 100);
            }
        }

        function updateSticky() {
            const scrollY = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollY < lastScrollY) {
                scrollDirection = 'up';
            } else if (scrollY > lastScrollY) {
                scrollDirection = 'down';
            }
            lastScrollY = scrollY;

            if (scrollY > stickyThreshold) {
                if (!header.classList.contains('is-sticky')) {
                    header.classList.add('is-sticky');
                    updateMetrics();
                }
            } else if (scrollY < releaseThreshold) {
                if (header.classList.contains('is-sticky')) {
                    header.classList.remove('is-sticky');
                    updateMetrics();
                }
            }

            checkTopDock(scrollY);
            ticking = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(updateSticky);
                ticking = true;
            }
        }, { passive: true });

        window.addEventListener('resize', function () {
            updateMetrics();
        }, { passive: true });

        // Ensure metrics are updated after all webfonts & images settle
        window.addEventListener('load', function () {
            updateMetrics();
        });

        // Initial check on page load
        updateMetrics();
        updateSticky();
    }

    function init() {
        ensureDrawerInBody();
        initStickyHeader();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

