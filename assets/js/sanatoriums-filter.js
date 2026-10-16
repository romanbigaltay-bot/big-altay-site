/**
 * ============================================================================
 * Big Altay Design System (BADS)
 * Interactive Sanatorium Filter Controller
 * ============================================================================
 */

(() => {
    'use strict';

    function initSanatoriumFilters() {
        const sidebar = document.querySelector('.bads-sidebar--filters');
        if (!sidebar) return;

        const cards = Array.from(document.querySelectorAll('.bads-sanatorium-card'));
        if (!cards.length) return;

        const priceSlider = document.getElementById('bads-filter-price');
        const priceDisplay = document.getElementById('price-slider-display') || document.getElementById('bads-filter-price-display');

        const starCheckboxes = Array.from(document.querySelectorAll('.bads-filter-star'));
        const treatmentCheckboxes = Array.from(document.querySelectorAll('.bads-filter-treatment'));
        const infraCheckboxes = Array.from(document.querySelectorAll('.bads-filter-infra'));
        const locationRadios = Array.from(document.querySelectorAll('input[name="filter_loc"]'));
        const foodRadios = Array.from(document.querySelectorAll('input[name="filter_food"]'));

        function updateAccordionValue(slotId, text) {
            const wrapper = document.querySelector(`[data-filter-trigger="${slotId}"]`);
            if (!wrapper) return;
            const valEl = wrapper.querySelector('.bads-accordion__trigger-value');
            if (valEl) {
                valEl.textContent = text;
            }
        }

        function applyFilters() {
            const maxPrice = priceSlider ? parseInt(priceSlider.value, 10) : Infinity;

            const selectedStars = starCheckboxes
                .filter(cb => cb.checked)
                .map(cb => parseInt(cb.value, 10));

            const selectedTreatments = treatmentCheckboxes
                .filter(cb => cb.checked)
                .map(cb => cb.value.trim().toLowerCase());

            const selectedInfra = infraCheckboxes
                .filter(cb => cb.checked)
                .map(cb => cb.value.trim().toLowerCase());

            const selectedLocation = locationRadios.find(r => r.checked)?.value || 'all';
            const selectedFood = foodRadios.find(r => r.checked)?.value || 'all';

            // Update Accordion trigger value labels
            if (priceSlider) {
                const formatted = maxPrice.toLocaleString('ru-RU');
                updateAccordionValue('price', `до ${formatted} ₽`);
                if (priceDisplay) {
                    priceDisplay.textContent = formatted;
                }
            }

            if (starCheckboxes.length) {
                if (selectedStars.length === starCheckboxes.length) {
                    updateAccordionValue('stars', 'Все категории');
                } else if (selectedStars.length === 0) {
                    updateAccordionValue('stars', 'Не выбрано');
                } else {
                    updateAccordionValue('stars', selectedStars.map(s => `${s}★`).join(', '));
                }
            }

            if (treatmentCheckboxes.length) {
                if (selectedTreatments.length === 0) {
                    updateAccordionValue('treatments', 'Все профили');
                } else {
                    updateAccordionValue('treatments', `Выбрано: ${selectedTreatments.length}`);
                }
            }

            if (infraCheckboxes.length) {
                if (selectedInfra.length === 0) {
                    updateAccordionValue('infra', 'Любая');
                } else {
                    updateAccordionValue('infra', `Выбрано: ${selectedInfra.length}`);
                }
            }

            if (locationRadios.length) {
                const checkedRadio = locationRadios.find(r => r.checked);
                const labelText = checkedRadio ? (checkedRadio.closest('label')?.querySelector('.bads-radio__text')?.textContent || checkedRadio.value) : 'Все';
                updateAccordionValue('location', labelText);
            }

            if (foodRadios.length) {
                const checkedRadio = foodRadios.find(r => r.checked);
                const labelText = checkedRadio ? (checkedRadio.closest('label')?.querySelector('.bads-radio__text')?.textContent || checkedRadio.value) : 'Любой';
                updateAccordionValue('food', labelText);
            }

            let visibleCount = 0;

            cards.forEach(card => {
                const price = parseInt(card.dataset.price || '0', 10);
                const stars = parseInt(card.dataset.stars || '0', 10);
                const treatmentsStr = (card.dataset.treatments || '').toLowerCase();
                const infraStr = (card.dataset.infra || '').toLowerCase();
                const locationStr = (card.dataset.location || '').toLowerCase();
                const foodStr = (card.dataset.food || '').toLowerCase();

                let match = true;

                // Price match
                if (price > 0 && price > maxPrice) {
                    match = false;
                }

                // Stars match
                if (match && selectedStars.length > 0 && stars > 0) {
                    if (!selectedStars.includes(stars)) {
                        match = false;
                    }
                }

                // Treatments match (if selected, sanatorium must contain at least one selected treatment)
                if (match && selectedTreatments.length > 0) {
                    const hasTreatment = selectedTreatments.some(t => treatmentsStr.includes(t));
                    if (!hasTreatment) {
                        match = false;
                    }
                }

                // Infra match
                if (match && selectedInfra.length > 0) {
                    const hasInfra = selectedInfra.some(i => infraStr.includes(i));
                    if (!hasInfra) {
                        match = false;
                    }
                }

                // Location match
                if (match && selectedLocation !== 'all') {
                    if (!locationStr.includes(selectedLocation.toLowerCase())) {
                        match = false;
                    }
                }

                // Food match
                if (match && selectedFood !== 'all') {
                    if (!foodStr.includes(selectedFood.toLowerCase())) {
                        match = false;
                    }
                }

                if (match) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    card.style.opacity = '0';
                }
            });

            // Handle empty state
            const gridContainer = cards[0]?.parentElement;
            let emptyEl = document.getElementById('bads-sanatoriums-empty');

            if (visibleCount === 0) {
                if (!emptyEl && gridContainer) {
                    emptyEl = document.createElement('div');
                    emptyEl.id = 'bads-sanatoriums-empty';
                    emptyEl.className = 'bads-card bads-card--glass bads-card--padding-lg';
                    emptyEl.style.gridColumn = '1 / -1';
                    emptyEl.style.textAlign = 'center';
                    emptyEl.style.padding = 'var(--space-2xl) var(--space-lg)';
                    emptyEl.innerHTML = `
                        <div class="bads-stack bads-stack--sm" style="align-items: center;">
                            <h4 style="font-size: var(--font-size-h4); margin: 0;">По заданным критериям санатории не найдены</h4>
                            <p style="color: var(--color-text-secondary); margin: 0;">Попробуйте увеличить бюджет или смягчить параметры фильтров</p>
                            <button type="button" id="bads-reset-filters-btn" class="bads-button bads-button--secondary bads-button--sm" style="margin-top: 12px; cursor: pointer;">Сбросить фильтры</button>
                        </div>
                    `;
                    gridContainer.appendChild(emptyEl);

                    const resetBtn = document.getElementById('bads-reset-filters-btn');
                    if (resetBtn) {
                        resetBtn.addEventListener('click', () => {
                            if (priceSlider) priceSlider.value = priceSlider.max;
                            starCheckboxes.forEach(cb => cb.checked = true);
                            treatmentCheckboxes.forEach(cb => cb.checked = false);
                            infraCheckboxes.forEach(cb => cb.checked = false);
                            if (locationRadios[0]) locationRadios[0].checked = true;
                            if (foodRadios[0]) foodRadios[0].checked = true;
                            applyFilters();
                        });
                    }
                } else if (emptyEl) {
                    emptyEl.style.display = '';
                }
            } else if (emptyEl) {
                emptyEl.style.display = 'none';
            }
        }

        // Attach event listeners
        if (priceSlider) {
            priceSlider.addEventListener('input', applyFilters);
        }

        [...starCheckboxes, ...treatmentCheckboxes, ...infraCheckboxes].forEach(cb => {
            cb.addEventListener('change', applyFilters);
        });

        [...locationRadios, ...foodRadios].forEach(radio => {
            radio.addEventListener('change', applyFilters);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSanatoriumFilters);
    } else {
        initSanatoriumFilters();
    }

    window.BADS = window.BADS || {};
    window.BADS.sanatoriumFilters = {
        init: initSanatoriumFilters
    };
})();