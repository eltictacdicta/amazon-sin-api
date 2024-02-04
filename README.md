# Amazon sin API

Plugin para WordPress que permite crear una caja de producto de Amazon con enlace de afiliado.

## Descripción

Este plugin permite a los usuarios insertar un bloque de producto de Amazon en sus publicaciones y páginas de WordPress. Los usuarios pueden especificar el título del producto, una imagen, el ASIN del producto y el número de columnas en las que se mostrarán los productos.

## Instalación

1. Descarga el archivo ZIP del plugin.
2. Ve a la sección de plugins de tu panel de administración de WordPress.
3. Haz clic en "Añadir nuevo" y luego en "Subir plugin".
4. Selecciona el archivo ZIP que has descargado y haz clic en "Instalar ahora".
5. Una vez instalado, haz clic en "Activar plugin".

## Uso

Para usar el plugin, simplemente inserta el shortcode `[amazon_sin_api]` en tus publicaciones o páginas. Puedes especificar los siguientes atributos:

- `titulo`: El título del producto.
- `imagen`: La URL de la imagen del producto.
- `asin`: El ASIN del producto en Amazon.
- `columnas`: El número de columnas en las que se mostrarán los productos.

Por ejemplo:

```php
[amazon_sin_api titulo="Producto de ejemplo" imagen="https://example.com/imagen.jpg" asin="B00EXAMPLE" columnas="2"]