CKEDITOR.plugins.add('notice', {
    icons: 'notice',
    init: function (editor) {
        editor.addCommand('insertTimestamp', {
            exec: function (editor) {
                editor.insertHtml('<div class="color-notice red rtl"></div>');
            }
        });

        editor.ui.addButton('Timestamp', {
            label: 'Insert Timestamp',
            command: 'insertTimestamp',
            toolbar: 'insert'
        });
    }
});

