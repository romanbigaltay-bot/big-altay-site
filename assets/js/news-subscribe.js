/**
 * Big Altay Design System (BADS)
 * News Subscription Handler (Bitrix24 AJAX)
 * 
 * @package BADS
 */

document.addEventListener('DOMContentLoaded', () => {
    const subscribeForms = document.querySelectorAll('[data-news-subscribe-form]');

    subscribeForms.forEach((form) => {
        const emailInput = form.querySelector('input[name="email"]');
        const nameInput = form.querySelector('input[name="name"]');
        const privacyCheckbox = form.querySelector('input[type="checkbox"]');
        const submitBtn = form.querySelector('[type="submit"], button.bads-btn');
        const feedbackEl = form.querySelector('[data-subscribe-feedback]');
        const successBox = form.closest('.bads-modal__content, .bads-modal__dialog, .bads-modal__body, .bads-hero__sidebar, body')?.querySelector('[data-subscribe-success]');

        if (!form || !emailInput) return;

        if (successBox) {
            successBox.hidden = true;
            successBox.style.display = 'none';
        }

        const emailWrapper = emailInput.closest('.bads-input__field, .bads-input') || emailInput;
        const checkboxWrapper = privacyCheckbox?.closest('.bads-checkbox') || privacyCheckbox;

        function checkValidity() {
            const emailVal = emailInput.value.trim();
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
            const privacyValid = privacyCheckbox ? privacyCheckbox.checked : true;

            return {
                isValid: emailValid && privacyValid,
                emailValid,
                privacyValid,
            };
        }

        function clearEmailErrors() {
            if (emailWrapper) {
                emailWrapper.classList.remove('bads-input__field--error', 'bads-input--error', 'bads-shake');
            }
            emailInput.classList.remove('is-invalid', 'error', 'bads-shake');
        }

        function clearCheckboxErrors() {
            if (checkboxWrapper) {
                checkboxWrapper.classList.remove('bads-checkbox--error', 'bads-shake');
            }
            if (privacyCheckbox) {
                privacyCheckbox.classList.remove('is-invalid', 'error', 'bads-shake');
            }
        }

        function updateButtonState() {
            const status = checkValidity();
            if (submitBtn) {
                if (status.isValid) {
                    submitBtn.classList.remove('is-disabled');
                    submitBtn.removeAttribute('aria-disabled');
                    submitBtn.setAttribute('aria-disabled', 'false');
                } else {
                    submitBtn.classList.add('is-disabled');
                    submitBtn.setAttribute('aria-disabled', 'true');
                }
            }
        }

        function highlightErrors() {
            const status = checkValidity();
            if (status.isValid) return;

            // 1. Индикация ошибки поля Email
            if (!status.emailValid) {
                if (emailWrapper) {
                    emailWrapper.classList.remove('bads-shake');
                    void emailWrapper.offsetWidth;
                    emailWrapper.classList.add('bads-input__field--error', 'bads-input--error', 'bads-shake');
                    setTimeout(() => emailWrapper.classList.remove('bads-shake'), 450);
                }
                emailInput.classList.remove('bads-shake');
                void emailInput.offsetWidth;
                emailInput.classList.add('is-invalid', 'error', 'bads-shake');
                setTimeout(() => emailInput.classList.remove('bads-shake'), 450);
                emailInput.focus();
            }

            // 2. Индикация ошибки чекбокса согласия
            if (!status.privacyValid && checkboxWrapper) {
                checkboxWrapper.classList.remove('bads-shake');
                void checkboxWrapper.offsetWidth;
                checkboxWrapper.classList.add('bads-checkbox--error', 'bads-shake');
                setTimeout(() => checkboxWrapper.classList.remove('bads-shake'), 450);
            }
        }

        emailInput.addEventListener('input', () => {
            const emailVal = emailInput.value.trim();
            const emailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal);
            if (emailValid) {
                clearEmailErrors();
            }
            updateButtonState();
        });

        if (privacyCheckbox) {
            privacyCheckbox.addEventListener('change', () => {
                if (privacyCheckbox.checked) {
                    clearCheckboxErrors();
                }
                updateButtonState();
            });
        }

        if (nameInput) {
            nameInput.addEventListener('input', updateButtonState);
        }

        // Клик по кнопке отправки (включая неактивное состояние)
        if (submitBtn) {
            submitBtn.addEventListener('click', (e) => {
                const status = checkValidity();
                if (!status.isValid) {
                    e.preventDefault();
                    e.stopPropagation();
                    highlightErrors();
                }
            });
        }

        // Очистка ошибок при закрытии модального окна
        const modal = form.closest('[data-modal]');
        if (modal) {
            modal.querySelectorAll('[data-modal-close]').forEach((closeBtn) => {
                closeBtn.addEventListener('click', () => {
                    clearEmailErrors();
                    clearCheckboxErrors();
                });
            });
        }

        // Инициализация состояния кнопки
        updateButtonState();

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const status = checkValidity();
            if (!status.isValid) {
                highlightErrors();
                return;
            }

            const initialBtnText = submitBtn ? submitBtn.innerHTML : 'Подписаться на новости';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.remove('is-disabled');
                submitBtn.innerHTML = 'Отправка...';
            }
            if (feedbackEl) {
                feedbackEl.hidden = true;
                feedbackEl.textContent = '';
            }

            const formData = new FormData();
            formData.append('action', 'send_b24_news_subscriber');
            formData.append('email', emailInput.value.trim());
            if (nameInput) {
                formData.append('name', nameInput.value.trim());
            }

            try {
                const response = await fetch('/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.json();

                if (result.success) {
                    form.reset();
                    clearEmailErrors();
                    clearCheckboxErrors();
                    if (successBox) {
                        form.hidden = true;
                        form.style.display = 'none';
                        successBox.hidden = false;
                        successBox.style.display = 'flex';
                    } else if (feedbackEl) {
                        feedbackEl.textContent = result.data?.message || 'Вы успешно подписаны на наши новости';
                        feedbackEl.className = 'bads-alert bads-alert--success bads-alert--sm';
                        feedbackEl.hidden = false;
                    }
                } else {
                    throw new Error(result.data || 'Не удалось оформить подписку');
                }
            } catch (err) {
                console.error('[BADS News Subscribe Error]', err);
                if (feedbackEl) {
                    feedbackEl.textContent = err.message || 'Произошла ошибка. Попробуйте еще раз позже.';
                    feedbackEl.className = 'bads-alert bads-alert--danger bads-alert--sm';
                    feedbackEl.hidden = false;
                }
            } finally {
                if (submitBtn && (!successBox || successBox.hidden)) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = initialBtnText;
                    updateButtonState();
                }
            }
        });
    });
});
