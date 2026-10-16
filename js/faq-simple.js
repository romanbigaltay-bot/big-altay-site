(function() {
    tinymce.PluginManager.add('faq_simple', function(editor, url) {
        editor.addButton('faq_simple', {
            text: 'FAQ',
            icon: false,
            tooltip: 'Добавить вопрос FAQ',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Добавить вопрос FAQ',
                    body: [
                        {
                            type: 'textbox',
                            name: 'question',
                            label: 'Вопрос',
                            value: ''
                        },
                        {
                            type: 'textbox',
                            name: 'answer',
                            label: 'Ответ',
                            multiline: true,
                            minHeight: 120,
                            value: ''
                        },
                        {
                            type: 'checkbox',
                            name: 'expanded',
                            label: 'Развернут по умолчанию',
                            checked: false
                        }
                    ],
                    onsubmit: function(e) {
                        var question = e.data.question.trim();
                        var answer = e.data.answer.trim();
                        var expanded = e.data.expanded;

                        if (!question) question = 'Ваш вопрос?';
                        if (!answer) answer = 'Ваш ответ...';

                        var faqHTML;
                        if (expanded) {
                            faqHTML =
                                '<div class="wp-faq-item wp-faq-item-expanded" data-mce-style="border: 1px dashed #ccc; margin: 10px 0; padding: 15px; background: #f9f9f9; border-radius: 4px;">' +
                                '<div class="wp-faq-question" data-mce-style="font-weight: bold; margin-bottom: 10px; color: #333;">' + question + '</div>' +
                                '<div class="wp-faq-answer" data-mce-style="color: #555;">' + answer + '</div>' +
                                '</div>';
                        } else {
                            faqHTML =
                                '<div class="wp-faq-item" data-mce-style="border: 1px dashed #ccc; margin: 10px 0; padding: 15px; background: #f9f9f9; border-radius: 4px;">' +
                                '<div class="wp-faq-question" data-mce-style="font-weight: bold; margin-bottom: 10px; color: #333;">' + question + '</div>' +
                                '<div class="wp-faq-answer" data-mce-style="color: #555;">' + answer + '</div>' +
                                '</div>';
                        }

                        editor.insertContent(faqHTML);
                    }
                });
            }
        });
    });
})();