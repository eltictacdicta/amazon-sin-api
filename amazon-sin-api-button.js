(function() {
    tinymce.create('tinymce.plugins.amazon_sin_api_button', {
        init: function(editor, url) {
            editor.addButton('amazon_sin_api_button', {
                text: 'Amazon sin API',
                icon: false,
                onclick: function() {
                    editor.windowManager.open({
                        title: 'Insertar producto de Amazon',
                        body: [
                            {type: 'textbox', name: 'titulo', label: 'Título'},
                            {type: 'textbox', name: 'imagen', label: 'Imagen'},
                            {type: 'textbox', name: 'asin', label: 'ASIN'},
                            {type: 'listbox', name: 'columnas', label: 'Columnas', values: [
                                {text: '1', value: '1'},
                                {text: '2', value: '2'},
                                {text: '3', value: '3'}
                            ]}
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[amazon_sin_api titulo="' + e.data.titulo + '" imagen="' + e.data.imagen + '" asin="' + e.data.asin + '" columnas="' + e.data.columnas + '"]');
                        }
                    });
                }
            });
        },
        createControl: function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('amazon_sin_api_button', tinymce.plugins.amazon_sin_api_button);
})();