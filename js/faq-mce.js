(function() {
    tinymce.PluginManager.add('faq_mce', function(editor, url) {

        editor.addButton('faq_mce', {
            text: 'FAQ',
            icon: false,
            tooltip: 'Добавить FAQ блок',
            onclick: function() {
                var faqHTML =
                    '<div class="mce-faq-block" contenteditable="false">' +
                    '<div class="faq-container">' +
                    '<div class="faq-item">' +
                    '<div class="faq-question">' +
                    '<h3>Ваш вопрос 1</h3>' +
                    '<span class="faq-icon">' +
                    '<span class="faq-plus">+</span>' +
                    '<span class="faq-minus">−</span>' +
                    '</span>' +
                    '</div>' +
                    '<div class="faq-answer">' +
                    '<div class="faq-content"><p>Ответ на вопрос 1</p></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="faq-item">' +
                    '<div class="faq-question">' +
                    '<h3>Ваш вопрос 2</h3>' +
                    '<span class="faq-icon">' +
                    '<span class="faq-plus">+</span>' +
                    '<span class="faq-minus">−</span>' +
                    '</span>' +
                    '</div>' +
                    '<div class="faq-answer">' +
                    '<div class="faq-content"><p>Ответ на вопрос 2</p></div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                editor.insertContent(faqHTML);
            }
        });

        editor.on('click', function(e) {
            var target = e.target;

            var question = null;
            if (target.classList && target.classList.contains('faq-question')) {
                question = target;
            } else if (target.closest && target.closest('.faq-question')) {
                question = target.closest('.faq-question');
            }

            if (question) {
                e.preventDefault();
                e.stopPropagation();

                var answer = question.nextElementSibling;
                if (answer && answer.classList.contains('faq-answer')) {
                    var isActive = question.classList.contains('active');

                    if (isActive) {
                        question.classList.remove('active');
                        answer.style.display = 'none';
                    } else {
                        question.classList.add('active');
                        answer.style.display = 'block';
                    }
                }
            }
        });

        editor.on('keydown', function(e) {
            if (e.keyCode === 13) {
                var node = editor.selection.getNode();

                if (node.classList && node.classList.contains('faq-question')) {
                    e.preventDefault();
                    var answer = node.nextElementSibling;
                    if (answer && answer.classList.contains('faq-answer')) {
                        editor.selection.select(answer);
                        editor.selection.collapse(true);
                    }
                }

                if (node.classList && node.classList.contains('faq-content')) {
                    var content = node.innerHTML.trim();
                    if (content === '' || content === '<p><br data-mce-bogus="1"></p>') {
                        e.preventDefault();
                        var question = node.closest('.faq-item').querySelector('.faq-question');
                        if (question) {
                            editor.selection.select(question.querySelector('h3'));
                            editor.selection.collapse(false);
                        }
                    }
                }
            }

            if (e.keyCode === 8) {
                var node = editor.selection.getNode();

                if (node.classList && node.classList.contains('faq-content')) {
                    var content = node.innerHTML.trim();
                    if (content === '' || content === '<p><br data-mce-bogus="1"></p>') {
                        e.preventDefault();

                        var faqItem = node.closest('.faq-item');
                        if (faqItem) {
                            editor.dom.remove(faqItem);
                        }
                    }
                }

                if (node.classList && node.classList.contains('faq-question')) {
                    var h3 = node.querySelector('h3');
                    if (h3 && h3.innerHTML.trim() === '') {
                        e.preventDefault();

                        var faqItem = node.closest('.faq-item');
                        if (faqItem) {
                            editor.dom.remove(faqItem);
                        }
                    }
                }
            }
        });

    });
})();