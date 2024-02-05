wp.blocks.registerBlockType('amazon-sin-api/amazon-sin-api-block', {
    title: 'Amazon sin API',
    icon: 'smiley',
    category: 'common',
    attributes: {
        titulo1: {type: 'string'},
        imagen1: {type: 'string'},
        asin1: {type: 'string'},
        titulo2: {type: 'string'},
        imagen2: {type: 'string'},
        asin2: {type: 'string'},
        titulo3: {type: 'string'},
        imagen3: {type: 'string'},
        asin3: {type: 'string'},
    },
    edit: function(props) {
        return wp.element.createElement(
            'div',
            {},
            wp.element.createElement('h3', {}, 'Título 1'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.titulo1,
                onChange: function(value) {
                    props.setAttributes({titulo1: value});
                }
            }),
            wp.element.createElement('h3', {}, 'Imagen 1'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.imagen1,
                onChange: function(value) {
                    props.setAttributes({imagen1: value});
                }
            }),
            wp.element.createElement('h3', {}, 'ASIN 1'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.asin1,
                onChange: function(value) {
                    props.setAttributes({asin1: value});
                }
            }),
            wp.element.createElement('h3', {}, 'Título 2'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.titulo2,
                onChange: function(value) {
                    props.setAttributes({titulo2: value});
                }
            }),
            wp.element.createElement('h3', {}, 'Imagen 2'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.imagen2,
                onChange: function(value) {
                    props.setAttributes({imagen2: value});
                }
            }),
            wp.element.createElement('h3', {}, 'ASIN 2'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.asin2,
                onChange: function(value) {
                    props.setAttributes({asin2: value});
                }
            }),
            wp.element.createElement('h3', {}, 'Título 3'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.titulo3,
                onChange: function(value) {
                    props.setAttributes({titulo3: value});
                }
            }),
            wp.element.createElement('h3', {}, 'Imagen 3'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.imagen3,
                onChange: function(value) {
                    props.setAttributes({imagen3: value});
                }
            }),
            wp.element.createElement('h3', {}, 'ASIN 3'),
            wp.element.createElement(wp.editor.RichText, {
                tagName: 'input',
                value: props.attributes.asin3,
                onChange: function(value) {
                    props.setAttributes({asin3: value});
                }
            })
        );
    },
    save: function(props) {
        return '[amazon_sin_api titulo1="' + props.attributes.titulo1 + '" imagen1="' + props.attributes.imagen1 + '" asin1="' + props.attributes.asin1 + '" titulo2="' + props.attributes.titulo2 + '" imagen2="' + props.attributes.imagen2 + '" asin2="' + props.attributes.asin2 + '" titulo3="' + props.attributes.titulo3 + '" imagen3="' + props.attributes.imagen3 + '" asin3="' + props.attributes.asin3 + '"]';
    }
});