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
                            {type: 'textbox', name: 'titulo1', label: 'Título 1'},
                            {type: 'textbox', name: 'imagen1', label: 'Imagen 1'},
                            {type: 'textbox', name: 'asin1', label: 'ASIN 1'},
                            {type: 'textbox', name: 'titulo2', label: 'Título 2'},
                            {type: 'textbox', name: 'imagen2', label: 'Imagen 2'},
                            {type: 'textbox', name: 'asin2', label: 'ASIN 2'},
                            {type: 'textbox', name: 'titulo3', label: 'Título 3'},
                            {type: 'textbox', name: 'imagen3', label: 'Imagen 3'},
                            {type: 'textbox', name: 'asin3', label: 'ASIN 3'}
                        ],
                        onsubmit: function(e) {
                            editor.insertContent('[amazon_sin_api titulo1="' + e.data.titulo1 + '" imagen1="' + e.data.imagen1 + '" asin1="' + e.data.asin1 + '" titulo2="' + e.data.titulo2 + '" imagen2="' + e.data.imagen2 + '" asin2="' + e.data.asin2 + '" titulo3="' + e.data.titulo3 + '" imagen3="' + e.data.imagen3 + '" asin3="' + e.data.asin3 + '"]');
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