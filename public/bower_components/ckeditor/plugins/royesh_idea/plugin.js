CKEDITOR.plugins.add('royesh_idea', {
    icon: 'notice',
    init: function (editor) {
        editor.addCommand('insertSection', {
            exec: function (editor) {
                editor.insertHtml('<div class="_section_zippy"><h2 class="h-clear ia-title active"></h2><div class="zippy-wrap"><div class="zippy-overflow"><div class="ia-body"></div></div></div></div>');
            }
        });

        editor.ui.addButton('Timestamp', {
            label: 'اضافه کردن عنوان ',
            command: 'insertSection',
            toolbar: 'insert',
            icon: this.path + 'icon/notice.png'
        });
    }
});

