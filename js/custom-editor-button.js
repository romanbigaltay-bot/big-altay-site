// Кастомная кнопка для выделения текста в TinyMCE
(function() {
    tinymce.PluginManager.add('customhighlight', function(editor, url) {
        // Добавляем кнопку в панель
        editor.addButton('customhighlight', {
            // Текст на кнопке (можно поменять на любой)
            text: '🌟 Выделить',
            // Или используйте иконку:
            // icon: 'icon dashicons-star-filled',
            tooltip: 'Выделить текст специальным стилем',

            // Действие при клике
            onclick: function() {
                // Получаем выделенный текст
                var selectedText = editor.selection.getContent({
                    format: 'html'
                });

                if (selectedText) {
                    // Если текст выделен - оборачиваем его
                    // Меняйте тег и класс под свои нужды:
                    // <mark>, <span>, <div>, <strong> и т.д.
                    var wrappedText = '<span class="custom-highlight" data-highlight="true">' + selectedText + '</span>';

                    // Вставляем обратно в редактор
                    editor.selection.setContent(wrappedText);
                } else {
                    // Если ничего не выделено - вставляем шаблон
                    editor.insertContent('<span class="custom-highlight" data-highlight="true">введите текст здесь</span>');

                    // Фокусируемся на вставленном тексте для быстрого редактирования
                    setTimeout(function() {
                        editor.focus();
                    }, 100);
                }
            }
        });

        // Дополнительно: добавляем пункт в контекстное меню (по правой кнопке)
        editor.addMenuItem('customhighlight', {
            text: 'Выделить текст',
            context: 'format',
            onclick: function() {
                var selectedText = editor.selection.getContent();
                if (selectedText) {
                    editor.selection.setContent('<span class="custom-highlight">' + selectedText + '</span>');
                }
            }
        });
    });
})();