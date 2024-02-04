wp.blocks.registerBlockType('amazon-sin-api/shortcode', {
    title: 'Amazon sin API',
    icon: 'admin-links',
    category: 'common',
    attributes: {
        titulo: {type: 'string'},
        imagen: {type: 'string'},
        asin: {type: 'string'},
        columnas: {type: 'number', default: 3},
    },
    edit: function(props) {
        return wp.element.createElement(
            'div',
            {},
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                placeholder: 'Título',
                value: props.attributes.titulo,
                onChange: function(value) {
                    props.setAttributes({titulo: value});
                }
            }),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                placeholder: 'Imagen',
                value: props.attributes.imagen,
                onChange: function(value) {
                    props.setAttributes({imagen: value});
                }
            }),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                placeholder: 'ASIN',
                value: props.attributes.asin,
                onChange: function(value) {
                    props.setAttributes({asin: value});
                }
            }),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                placeholder: 'Columnas',
                value: props.attributes.columnas,
                onChange: function(value) {
                    props.setAttributes({columnas: value});
                }
            })
        );
    },
    save: function(props) {
        return '[amazon_sin_api titulo="' + props.attributes.titulo + '" imagen="' + props.attributes.imagen + '" asin="' + props.attributes.asin + '" columnas="' + props.attributes.columnas + '"]';
    }
});