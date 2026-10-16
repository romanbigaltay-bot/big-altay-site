//-- b24-form.js
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.lead-form-main');
    forms.forEach(function(form) {
        if (!form) return;

        const formId = form.dataset.formId;
        const buttonText = form.dataset.buttonText || 'Отправить заявку';
        const successTarget = form.dataset.successTarget;
        const successUrl = form.dataset.successUrl;
        
        const checkbox = form.querySelector('[type="checkbox"]');
        const submitBtn = form.querySelector('.lead-form-main__btn');
        const message = form.querySelector('.lead-form-main__message');
        const nameInput = form.querySelector('[name="name"]');
        const phoneInput = form.querySelector('[name="phone"]');
        const emailInput = form.querySelector('[name="email"]');
        const commentInput = form.querySelector('[name="comment"], [name="message"], [name="custom_comment"]');
        const directionInput = form.querySelector('[name="direction"], select[name="direction"]');
        const channelInput = form.querySelector('[name="channel"]');
        const channelSelect = form.querySelector('[data-channel-select], select[name="channel_type"], .lead-form-channel__select');
        const channelTabs = form.querySelectorAll('.lead-form-channel__tab, [data-channel-tab]');
        const channelPanels = form.querySelectorAll('.lead-form-channel__panel, [data-channel-panel]');

        if (!checkbox || !submitBtn) {
            return;
        }

        let currentChannel = channelSelect ? channelSelect.value : (channelInput ? channelInput.value : 'phone');

        function setChannel(targetChannel) {
            if (!targetChannel) return;
            currentChannel = targetChannel;

            if (channelInput) {
                channelInput.value = targetChannel;
            }
            if (channelSelect && channelSelect.value !== targetChannel) {
                channelSelect.value = targetChannel;
            }

            if (channelTabs.length > 0) {
                channelTabs.forEach(function(t) {
                    const tabCh = t.dataset.channelTab || t.dataset.channel;
                    if (tabCh === targetChannel) {
                        t.classList.add('lead-form-channel__tab--active', 'bads-tabs__tab--active', 'active');
                    } else {
                        t.classList.remove('lead-form-channel__tab--active', 'bads-tabs__tab--active', 'active');
                    }
                });
            }

            if (channelPanels.length > 0) {
                channelPanels.forEach(function(panel) {
                    const panelChannel = panel.dataset.channelPanel || panel.dataset.channel;
                    if (panelChannel === targetChannel) {
                        panel.classList.add('lead-form-channel__panel--active');
                        panel.removeAttribute('hidden');
                        const inputInPanel = panel.querySelector('input');
                        if (inputInPanel) {
                            inputInPanel.focus();
                        }
                    } else {
                        panel.classList.remove('lead-form-channel__panel--active');
                        panel.setAttribute('hidden', 'hidden');
                    }
                });
            }

            validateForm();
        }

        // Обработка выпадающего списка выбора канала связи (и скрытого инпута от accordion)
        const channelHiddenOrSelect = form.querySelectorAll('[name="channel_type"], [name="channel"]');
        channelHiddenOrSelect.forEach(function(inp) {
            inp.addEventListener('change', function() {
                setChannel(this.value);
            });
            inp.addEventListener('input', function() {
                setChannel(this.value);
            });
        });
        if (channelSelect) {
            channelSelect.addEventListener('change', function() {
                setChannel(this.value);
            });
        }

        // Обработка табов каналов связи (для обратной совместимости)
        if (channelTabs.length > 0) {
            channelTabs.forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetChannel = this.dataset.channelTab || this.dataset.channel;
                    setChannel(targetChannel);
                });
            });
        }

        function checkValidation() {
            // Для мессенджера MAX отправка веб-формы не требуется
            if (currentChannel === 'max' || currentChannel === 'chat') {
                return {
                    nameValid: true,
                    contactValid: false,
                    checkboxValid: true,
                    isValid: false,
                    isMax: true
                };
            }

            // Проверка имени (если поле есть и оно required)
            let nameValid = true;
            if (nameInput && nameInput.hasAttribute('required')) {
                nameValid = nameInput.value.trim().length >= 2;
            }

            // Проверка контакта в зависимости от активного канала
            let contactValid = false;
            if (currentChannel === 'email') {
                const emailVal = emailInput ? emailInput.value.trim() : '';
                contactValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
            } else {
                // По умолчанию канал phone
                if (phoneInput) {
                    contactValid = phoneInput.value.replace(/\D/g, '').length >= 11;
                } else if (emailInput) {
                    contactValid = emailInput.value.trim().length > 3;
                } else {
                    contactValid = true;
                }
            }

            const checkboxValid = checkbox ? checkbox.checked : true;

            return {
                nameValid,
                contactValid,
                checkboxValid,
                isValid: Boolean(nameValid && contactValid && checkboxValid),
                isMax: false
            };
        }

        function clearErrors() {
            if (nameInput) {
                const nameField = nameInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                if (nameField) {
                    nameField.classList.remove('bads-input__field--error', 'bads-input--error', 'bads-shake');
                }
                nameInput.classList.remove('is-invalid', 'error', 'bads-shake');
            }
            if (phoneInput) {
                const phoneField = phoneInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                if (phoneField) {
                    phoneField.classList.remove('bads-input__field--error', 'bads-input--error', 'bads-shake');
                }
                phoneInput.classList.remove('is-invalid', 'error', 'bads-shake');
            }
            if (emailInput) {
                const emailField = emailInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                if (emailField) {
                    emailField.classList.remove('bads-input__field--error', 'bads-input--error', 'bads-shake');
                }
                emailInput.classList.remove('is-invalid', 'error', 'bads-shake');
            }
            if (checkbox) {
                const checkboxWrapper = checkbox.closest('.bads-checkbox, .lead-form-main__privacy');
                if (checkboxWrapper) {
                    checkboxWrapper.classList.remove('bads-checkbox--error', 'bads-shake');
                }
            }
        }

        function highlightErrors() {
            const status = checkValidation();
            if (status.isValid || status.isMax) return;

            // 1. Подсветка поля Имени (если обязательное)
            if (!status.nameValid && nameInput) {
                const nameField = nameInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                if (nameField) {
                    nameField.classList.remove('bads-shake');
                    void nameField.offsetWidth;
                    nameField.classList.add('bads-input__field--error', 'bads-input--error', 'bads-shake');
                    setTimeout(() => nameField.classList.remove('bads-shake'), 450);
                }
                nameInput.classList.remove('bads-shake');
                void nameInput.offsetWidth;
                nameInput.classList.add('is-invalid', 'error', 'bads-shake');
                setTimeout(() => nameInput.classList.remove('bads-shake'), 450);
                nameInput.focus();
            }

            // 2. Подсветка поля контакта (Телефон / Почта)
            if (!status.contactValid) {
                let targetInput = (currentChannel === 'email') ? emailInput : phoneInput;
                if (targetInput) {
                    const field = targetInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                    if (field) {
                        field.classList.remove('bads-shake');
                        void field.offsetWidth;
                        field.classList.add('bads-input__field--error', 'bads-input--error', 'bads-shake');
                        setTimeout(() => field.classList.remove('bads-shake'), 450);
                    }
                    targetInput.classList.remove('bads-shake');
                    void targetInput.offsetWidth;
                    targetInput.classList.add('is-invalid', 'error', 'bads-shake');
                    setTimeout(() => targetInput.classList.remove('bads-shake'), 450);
                    if (status.nameValid) {
                        targetInput.focus();
                    }
                }
            }

            // 3. Подсветка чекбокса согласия
            if (!status.checkboxValid && checkbox) {
                const checkboxWrapper = checkbox.closest('.bads-checkbox, .lead-form-main__privacy');
                if (checkboxWrapper) {
                    checkboxWrapper.classList.remove('bads-shake');
                    void checkboxWrapper.offsetWidth;
                    checkboxWrapper.classList.add('bads-checkbox--error', 'bads-shake');
                    setTimeout(() => checkboxWrapper.classList.remove('bads-shake'), 450);
                }
            }
        }

        function validateForm() {
            const status = checkValidation();

            if (status.isMax) {
                submitBtn.disabled = true;
                submitBtn.setAttribute('aria-disabled', 'true');
                submitBtn.classList.add('is-disabled');
                submitBtn.classList.remove('active');
                return;
            }

            // Если поле имени стало валидным — убираем красную подсветку
            if (status.nameValid && nameInput) {
                const nameField = nameInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                if (nameField) nameField.classList.remove('bads-input__field--error', 'bads-input--error');
                nameInput.classList.remove('is-invalid', 'error');
            }

            // Если поле стало валидным — убираем красную подсветку
            if (status.contactValid) {
                if (phoneInput) {
                    const phoneField = phoneInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                    if (phoneField) phoneField.classList.remove('bads-input__field--error', 'bads-input--error');
                    phoneInput.classList.remove('is-invalid', 'error');
                }
                if (emailInput) {
                    const emailField = emailInput.closest('.bads-input__field, .bads-input, .lead-form-main__field');
                    if (emailField) emailField.classList.remove('bads-input__field--error', 'bads-input--error');
                    emailInput.classList.remove('is-invalid', 'error');
                }
            }

            if (status.checkboxValid && checkbox) {
                const checkboxWrapper = checkbox.closest('.bads-checkbox, .lead-form-main__privacy');
                if (checkboxWrapper) checkboxWrapper.classList.remove('bads-checkbox--error');
            }

            if (status.isValid) {
                submitBtn.disabled = false;
                submitBtn.removeAttribute('aria-disabled');
                submitBtn.classList.remove('is-disabled');
                submitBtn.classList.add('active');
            } else {
                // Не ставим native disabled, чтобы клик по кнопке работал и показывал ошибку
                submitBtn.disabled = false;
                submitBtn.setAttribute('aria-disabled', 'true');
                submitBtn.classList.add('is-disabled');
                submitBtn.classList.remove('active');
            }
        }

        // Обработка клика по кнопке отправки
        submitBtn.addEventListener('click', function(e) {
            const status = checkValidation();
            if (!status.isValid) {
                e.preventDefault();
                e.stopPropagation();
                highlightErrors();
            }
        });

        checkbox.addEventListener('change', validateForm);

        if (nameInput) {
            nameInput.addEventListener('input', validateForm);
        }

        if (emailInput) {
            emailInput.addEventListener('input', validateForm);
        }

        if (commentInput) {
            commentInput.addEventListener('input', validateForm);
        }

        if (phoneInput) {
            phoneInput.addEventListener('input', function () {
                let value = this.value.replace(/\D/g, '');
                if (value.startsWith('8')) {
                    value = '7' + value.slice(1);
                }

                if (!value.startsWith('7')) {
                    value = '7' + value;
                }

                value = value.substring(0, 11);
                let formatted = '+7';

                if (value.length > 1) {
                    formatted += ' (' + value.substring(1, 4);
                }

                if (value.length >= 5) {
                    formatted += ') ' + value.substring(4, 7);
                }

                if (value.length >= 8) {
                    formatted += '-' + value.substring(7, 9);
                }

                if (value.length >= 10) {
                    formatted += '-' + value.substring(9, 11);
                }

                this.value = formatted;
                const field = this.closest('.bads-input__field, .bads-input');
                if (field) {
                    field.classList.remove('bads-shake');
                }
                validateForm();
            });

            phoneInput.addEventListener('focus', function () {
                const input = this;
                setTimeout(() => {
                    if (!input.value.trim()) {
                        input.value = '+7 ';
                        input.setSelectionRange(
                            input.value.length,
                            input.value.length
                        );
                    }
                }, 0);
            });

            phoneInput.addEventListener('click', function () {
                if (this.value === '+7 ') {
                    this.setSelectionRange(
                        this.value.length,
                        this.value.length
                    );
                }
            });

            phoneInput.addEventListener('blur', function () {
                if (this.value === '+7 ') {
                    this.value = '';
                }
            });
        }

        function getUTM() {
            const params = new URLSearchParams(window.location.search);
            const currentUtm = {
                source: params.get('utm_source') || '',
                medium: params.get('utm_medium') || '',
                campaign: params.get('utm_campaign') || '',
                content: params.get('utm_content') || '',
                term: params.get('utm_term') || ''
            };

            const hasUtm = currentUtm.source || currentUtm.medium || currentUtm.campaign || currentUtm.content || currentUtm.term;

            if (hasUtm) {
                try {
                    sessionStorage.setItem('bigaltay_utm', JSON.stringify(currentUtm));
                    localStorage.setItem('bigaltay_utm_last', JSON.stringify(currentUtm));
                } catch(e) {}
                return currentUtm;
            }

            // Restore from session or localStorage if absent in current URL
            try {
                const sessionSaved = sessionStorage.getItem('bigaltay_utm') || localStorage.getItem('bigaltay_utm_last');
                if (sessionSaved) {
                    const parsed = JSON.parse(sessionSaved);
                    if (parsed && typeof parsed === 'object') {
                        return {
                            source: parsed.source || '',
                            medium: parsed.medium || '',
                            campaign: parsed.campaign || '',
                            content: parsed.content || '',
                            term: parsed.term || ''
                        };
                    }
                }
            } catch(e) {}

            return currentUtm;
        }

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            submitBtn.disabled = true;
            const btnTextSpan = submitBtn.querySelector('.bads-btn__text');
            if (btnTextSpan) {
                btnTextSpan.textContent = 'Отправка...';
            } else {
                submitBtn.innerText = 'Отправка...';
            }
            if (message) message.innerHTML = '';

            const utmData = getUTM();
            const pageUrl = form.dataset.page || window.location.href;
            const pageTitle = form.dataset.pageTitle || document.title || '';
            const pagePath = window.location.pathname || '';
            const formTitle = form.dataset.formTitle || form.closest('.lead-form-compact, .lead-form-main, .bads-section, section')?.querySelector('h1, h2, h3, .bads-title')?.textContent?.trim() || '';

            const formData = new FormData();
            formData.append('action', 'send_b24_lead');
            formData.append('name', nameInput ? nameInput.value : '');
            formData.append('phone', phoneInput ? phoneInput.value : '');
            formData.append('email', emailInput ? emailInput.value : '');
            formData.append('channel', currentChannel);
            formData.append('comment', commentInput ? commentInput.value : '');

            // Дополнительные поля booking-формы (только если присутствуют в форме)
            const dateInput = form.querySelector('[name="date"]');
            const personsInput = form.querySelector('[name="persons"]');
            const durationInput = form.querySelector('[name="duration_days"], [name="duration"]');

            formData.append('direction', directionInput ? directionInput.value : '');
            formData.append('date', dateInput ? dateInput.value : '');
            formData.append('duration', durationInput ? durationInput.value : '');
            formData.append('persons', personsInput ? personsInput.value : '');

            // Детальная информация об источнике и странице
            formData.append('page', pageUrl);
            formData.append('page_title', pageTitle);
            formData.append('page_path', pagePath);
            formData.append('form_id', formId || '');
            formData.append('form_title', formTitle);
            formData.append('referrer', document.referrer || '');

            // UTM метки (как объект и раздельно)
            formData.append('utm', JSON.stringify(utmData));
            formData.append('utm_source', utmData.source || '');
            formData.append('utm_medium', utmData.medium || '');
            formData.append('utm_campaign', utmData.campaign || '');
            formData.append('utm_content', utmData.content || '');
            formData.append('utm_term', utmData.term || '');

            try {
                const response = await fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    if (currentChannel === 'max') {
                        // Если выбран чат MAX, перенаправляем в бот MAX
                        const maxLinkEl = form.querySelector('.bads-booking-bar__max-link, a[data-max-link]');
                        const maxUrl = (maxLinkEl && maxLinkEl.getAttribute('href')) || 'https://max.ru/id2203004205_bot';
                        window.open(maxUrl, '_blank');
                    }

                    let finalSuccessUrl = successUrl;
                    // Клиентский фоллбэк: для любых страниц туров (/tours/...) перенаправляем на /thank-you/tours/,
                    // даже если страница отдана из статического HTML-кэша или в разметке был общий URL
                    const currentPath = window.location.pathname || '';
                    if (currentPath.indexOf('/tours') !== -1) {
                        if (!finalSuccessUrl || finalSuccessUrl === '/thank-you/' || finalSuccessUrl === '/thank-you' || finalSuccessUrl === '/thank-you/main/' || finalSuccessUrl === '/thank-you/main') {
                            finalSuccessUrl = '/thank-you/tours/';
                        }
                    }

                    if (finalSuccessUrl) {
                        window.location.href = finalSuccessUrl;
                    } else if (successTarget) {
                        const targetEl = document.getElementById(successTarget);
                        if (targetEl) {
                            targetEl.classList.add('lead-form-success');
                        }
                    }
                } else {
                    throw new Error(result.data);
                }

            } catch (error) {
                console.error(error);
                if (message) {
                    message.innerHTML = 'Ошибка отправки. Попробуйте позже.';
                }
            } finally {
                const btnTextSpan = submitBtn.querySelector('.bads-btn__text');
                if (btnTextSpan) {
                    btnTextSpan.textContent = buttonText;
                } else {
                    submitBtn.innerText = buttonText;
                }
                validateForm();
            }
        });

        // Слушатель бегунка длительности отдыха (3-90 дней)
        const durationRange = form.querySelector('#hero-duration-range, [name="duration"]');
        const durationDisplay = form.querySelector('#hero-duration-range-display, #hero-duration-val');
        const durationUnit = form.querySelector('#hero-duration-range-unit');
        const durationAccordion = form.querySelector('.bads-accordion--duration-select');

        function getDaysWord(number) {
            const num = Math.abs(parseInt(number, 10)) % 100;
            const num1 = num % 10;
            if (num > 10 && num < 20) return 'дней';
            if (num1 > 1 && num1 < 5) return 'дня';
            if (num1 === 1) return 'день';
            return 'дней';
        }

        function updateRangeProgress(rangeInput) {
            if (!rangeInput) return;
            const min = parseFloat(rangeInput.min) || 3;
            const max = parseFloat(rangeInput.max) || 90;
            const val = parseFloat(rangeInput.value) || 14;
            const percent = ((val - min) / (max - min)) * 100;
            rangeInput.style.setProperty('--range-percent', percent + '%');
        }

        if (durationRange) {
            updateRangeProgress(durationRange);

            durationRange.addEventListener('input', function () {
                const val = parseInt(this.value, 10);
                const word = getDaysWord(val);
                const formattedText = val + ' ' + word;

                updateRangeProgress(this);

                if (durationDisplay) {
                    durationDisplay.textContent = val;
                }
                if (durationUnit) {
                    durationUnit.textContent = word;
                }
                if (durationAccordion) {
                    const triggerValue = durationAccordion.querySelector('.bads-accordion__trigger-value, .bads-accordion__trigger-title');
                    if (triggerValue) {
                        triggerValue.textContent = formattedText;
                    }
                    const hiddenInput = durationAccordion.querySelector('input[type="hidden"]');
                    if (hiddenInput) {
                        hiddenInput.value = formattedText;
                    }
                }
            });
        }

        // Открытие календаря по клику на весь input
        const bookingDateInput = form.querySelector('input[type="date"]');
        if (bookingDateInput) {
            bookingDateInput.addEventListener('click', function () {
                if (typeof bookingDateInput.showPicker === 'function') {
                    bookingDateInput.showPicker();
                }
            });
        }

        // Инициализация статуса кнопки при загрузке
        validateForm();
    });

    // ==========================================================
    // Date Stepper Interactivity (Radio Presets -> Step 1 (Year/Month) -> Step 2 (Day))
    // ==========================================================
    let stepperYear = 2026;
    let stepperMonthNum = 8;
    let stepperMonthName = 'Август';

    const monthNamesGenitive = [
        '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
        'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
    ];

    function renderDaysGrid(stepperEl, year, monthNum) {
        const daysContainer = stepperEl.querySelector('[data-days-container]');
        if (!daysContainer) return;

        daysContainer.innerHTML = '';

        // Всего дней в месяце
        const totalDays = new Date(year, monthNum, 0).getDate();
        // День недели 1-го числа (0 = Вс, 1 = Пн, ...)
        const firstDayIdx = new Date(year, monthNum - 1, 1).getDay();
        const startOffset = firstDayIdx === 0 ? 6 : firstDayIdx - 1; // 0 = Пн ... 6 = Вс

        // Пустые ячейки для смещения начала месяца
        for (let i = 0; i < startOffset; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'bads-date-day-empty';
            daysContainer.appendChild(emptyCell);
        }

        // Дни месяца
        for (let d = 1; d <= totalDays; d++) {
            const dayBtn = document.createElement('button');
            dayBtn.type = 'button';
            dayBtn.className = 'bads-date-day-btn';
            dayBtn.dataset.day = d;
            dayBtn.textContent = d;
            daysContainer.appendChild(dayBtn);
        }
    }

    function showDateStep(stepper, stepName) {
        const optionsView = stepper.querySelector('[data-date-options]');
        const step1 = stepper.querySelector('[data-step="1"]');
        const step2 = stepper.querySelector('[data-step="2"]');

        const allViews = [optionsView, step1, step2].filter(Boolean);
        allViews.forEach(v => {
            v.hidden = true;
            v.classList.remove('bads-date-stepper__view--active');
        });

        if (stepName === 'options') {
            if (optionsView) {
                optionsView.hidden = false;
                optionsView.classList.add('bads-date-stepper__view--active');
            }
        } else if (stepName === '1') {
            if (step1) {
                step1.hidden = false;
                step1.classList.add('bads-date-stepper__view--active');
            }
        } else if (stepName === '2') {
            if (step2) {
                step2.hidden = false;
                step2.classList.add('bads-date-stepper__view--active');
                const backMonthSpan = step2.querySelector('.bads-date-step__back-month-year');
                if (backMonthSpan) backMonthSpan.textContent = `${stepperMonthName} ${stepperYear}`;
            }
        }
    }

    // Обработка кликов/изменений в календаре
    function handleDateOptionSelect(stepper, val) {
        const accordion = stepper.closest('.bads-accordion');

        if (val === 'custom') {
            // Переключаем окошко на выбор года и месяца
            showDateStep(stepper, '1');
        } else {
            if (!accordion) return;

            // Запись в скрытое поле формы
            const hiddenInput = accordion.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.value = val;
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }

            // Обновление значения в шапке аккордеона
            const triggerValue = accordion.querySelector('.bads-accordion__trigger-value, .bads-accordion__trigger-title');
            if (triggerValue) {
                triggerValue.textContent = val;
            }

            // Закрытие аккордеона
            accordion.classList.remove('bads-accordion--open');
            const trigger = accordion.querySelector('.bads-accordion__trigger');
            const content = accordion.querySelector('.bads-accordion__content');
            if (trigger) trigger.setAttribute('aria-expanded', 'false');
            if (content) {
                content.setAttribute('aria-hidden', 'true');
                content.style.maxHeight = '';
            }
        }
    }

    document.addEventListener('change', function (e) {
        const stepper = e.target.closest('[data-bads-date-stepper]');
        if (!stepper) return;

        // 1. Выбор радио-варианта (В ближайшее время / Максимальная выгода / Конкретная дата)
        if (e.target.matches('input[name="date_option_choice"]')) {
            handleDateOptionSelect(stepper, e.target.value);
        }
    });

    document.addEventListener('click', function (e) {
        const stepper = e.target.closest('[data-bads-date-stepper]');
        if (!stepper) return;

        // 1.1 Клик по радио-лейблу "Конкретная дата" или другим опциям даты
        const dateRadioOption = e.target.closest('.bads-date-radio-option');
        if (dateRadioOption && !e.target.matches('input[type="radio"]')) {
            const radioInput = dateRadioOption.querySelector('input[name="date_option_choice"]');
            if (radioInput) {
                radioInput.checked = true;
                handleDateOptionSelect(stepper, radioInput.value);
                return;
            }
        }

        // 2. Шаг 1: Выбор года
        const yearChip = e.target.closest('.bads-date-chip--year');
        if (yearChip) {
            stepperYear = parseInt(yearChip.dataset.year, 10) || 2026;
            stepper.querySelectorAll('.bads-date-chip--year').forEach(c => c.classList.remove('bads-date-chip--selected'));
            yearChip.classList.add('bads-date-chip--selected');
            return;
        }

        // 3. Шаг 1: Выбор месяца -> Сразу переход на выбор числа (Шаг 2)
        const monthChip = e.target.closest('.bads-date-chip--month');
        if (monthChip) {
            stepperMonthNum = parseInt(monthChip.dataset.monthNum, 10) || 1;
            stepperMonthName = monthChip.dataset.monthName || 'Месяц';

            // Генерируем дни выбранного месяца и года
            renderDaysGrid(stepper, stepperYear, stepperMonthNum);

            // Переход на Шаг 2 (Выбор числа)
            showDateStep(stepper, '2');
            return;
        }

        // 4. Шаг 2: Выбор конкретного числа
        const dayBtn = e.target.closest('.bads-date-day-btn');
        if (dayBtn) {
            const day = parseInt(dayBtn.dataset.day, 10);
            const accordion = stepper.closest('.bads-accordion');
            if (!accordion) return;

            const pad = (n) => (n < 10 ? '0' + n : n);
            const formattedDate = `${pad(day)}.${pad(stepperMonthNum)}.${stepperYear}`;

            // Запись в скрытое поле формы
            const hiddenInput = accordion.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.value = formattedDate;
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }

            // Обновление текста на триггере
            const triggerValue = accordion.querySelector('.bads-accordion__trigger-value, .bads-accordion__trigger-title');
            if (triggerValue) {
                triggerValue.textContent = formattedDate;
            }

            // Закрытие аккордеона
            accordion.classList.remove('bads-accordion--open');
            const trigger = accordion.querySelector('.bads-accordion__trigger');
            const content = accordion.querySelector('.bads-accordion__content');
            if (trigger) trigger.setAttribute('aria-expanded', 'false');
            if (content) {
                content.setAttribute('aria-hidden', 'true');
                content.style.maxHeight = '';
            }
            return;
        }

        // 5. Кнопка «Назад»
        const backBtn = e.target.closest('.bads-date-step__back');
        if (backBtn) {
            const backTo = backBtn.dataset.backTo;
            showDateStep(stepper, backTo);
            return;
        }
    });

    // Custom Date Input inside BADS Select
    document.addEventListener('change', function (e) {
        if (e.target.matches('.bads-select-date-custom__input')) {
            const dateVal = e.target.value;
            if (!dateVal) return;
            const accordion = e.target.closest('.bads-accordion');
            if (!accordion) return;

            const parts = dateVal.split('-');
            const formatted = parts.length === 3 ? `${parts[2]}.${parts[1]}.${parts[0]}` : dateVal;

            const hiddenInput = accordion.querySelector('input[type="hidden"]');
            if (hiddenInput) {
                hiddenInput.value = formatted;
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }

            const triggerValue = accordion.querySelector('.bads-accordion__trigger-value, .bads-accordion__trigger-title');
            if (triggerValue) {
                triggerValue.textContent = formatted;
            }

            accordion.classList.remove('bads-accordion--open');
            const trigger = accordion.querySelector('.bads-accordion__trigger');
            const content = accordion.querySelector('.bads-accordion__content');
            if (trigger) trigger.setAttribute('aria-expanded', 'false');
            if (content) {
                content.setAttribute('aria-hidden', 'true');
                content.style.maxHeight = '';
            }
        }
    });
    document.addEventListener('click', function (e) {
        const option = e.target.closest('.bads-select-option');
        if (option) {
            const accordion = option.closest('.bads-accordion');
            if (!accordion) return;

            const val = option.dataset.value || option.textContent.trim();
            const label = option.dataset.label || option.textContent.trim();

            // 1. Update hidden input
            const hiddenInput = accordion.querySelector('input[type="hidden"]') ||
                                (accordion.dataset.targetInput ? document.querySelector(accordion.dataset.targetInput) : null);
            if (hiddenInput) {
                hiddenInput.value = val;
                hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
            }

            // 2. Update trigger display text
            const triggerTitle = accordion.querySelector('.bads-accordion__trigger-title, .bads-accordion__trigger-value');
            if (triggerTitle) {
                triggerTitle.textContent = label;
            }

            // 3. Update active state
            accordion.querySelectorAll('.bads-select-option').forEach(function(opt) {
                opt.classList.remove('bads-select-option--active');
            });
            option.classList.add('bads-select-option--active');

            // 4. Close accordion
            accordion.classList.remove('bads-accordion--open');
            const trigger = accordion.querySelector('.bads-accordion__trigger');
            const content = accordion.querySelector('.bads-accordion__content');
            if (trigger) trigger.setAttribute('aria-expanded', 'false');
            if (content) {
                content.setAttribute('aria-hidden', 'true');
                content.style.maxHeight = '';
            }
            return;
        }

        // Radio button selection inside bads-accordion (Floating Accordion / Variant G)
        const radioItem = e.target.closest('.bads-direction-radio-item, .bads-radio');
        if (radioItem && !e.target.closest('[data-bads-date-stepper]')) {
            const accordion = radioItem.closest('.bads-accordion--select, .bads-accordion--dropdown');
            if (accordion) {
                const radioInput = radioItem.querySelector('input[type="radio"]');
                if (radioInput) {
                    if (e.target !== radioInput) {
                        radioInput.checked = true;
                    }
                    const val = radioInput.value;
                    const radioText = radioItem.querySelector('.bads-radio__text');
                    const label = radioText ? radioText.textContent.trim() : val;

                    // 1. Update hidden input for form submission
                    const hiddenInput = accordion.querySelector('input[type="hidden"]') ||
                                        (accordion.dataset.targetInput ? document.querySelector(accordion.dataset.targetInput) : null);
                    if (hiddenInput) {
                        hiddenInput.value = val;
                        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
                        hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
                    }

                    // 2. Update trigger display text
                    const triggerTitle = accordion.querySelector('.bads-accordion__trigger-title, .bads-accordion__trigger-value');
                    if (triggerTitle) {
                        triggerTitle.textContent = label;
                    }

                    // 3. Close floating accordion
                    setTimeout(function () {
                        accordion.classList.remove('bads-accordion--open');
                        const trigger = accordion.querySelector('.bads-accordion__trigger');
                        const content = accordion.querySelector('.bads-accordion__content');
                        if (trigger) trigger.setAttribute('aria-expanded', 'false');
                        if (content) {
                            content.setAttribute('aria-hidden', 'true');
                            content.style.maxHeight = '';
                        }
                    }, 120);
                }
            }
        }

        // Outside click to close open dropdown accordions
        const openSelects = document.querySelectorAll('.bads-accordion--select.bads-accordion--open, .bads-accordion--dropdown.bads-accordion--open');
        openSelects.forEach(function (acc) {
            if (!acc.contains(e.target)) {
                acc.classList.remove('bads-accordion--open');
                const trigger = acc.querySelector('.bads-accordion__trigger');
                const content = acc.querySelector('.bads-accordion__content');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
                if (content) {
                    content.setAttribute('aria-hidden', 'true');
                    content.style.maxHeight = '';
                }
            }
        });
    });
});
