<?php
/*
Plugin Name: Amazon sin API
Description: Plugin para crear una caja de producto de Amazon con enlace de afiliado.
Version: 1.0
Author: Javier Trujillo (misterdigital)
*/

function amazon_sin_api_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'titulo' => 'Producto sin título',
            'imagen' => '',
            'asin' => '',
            'columnas' => 1,
        ), 
        $atts, 
        'amazon'
    );

    $affiliate_code = get_option('amazon_sin_api_affiliate_code');

    // Construye el enlace a Amazon usando el ASIN y el código de afiliado.
    $enlace = "https://www.amazon.es/dp/" . $atts['asin'] . "?&tag=" . $affiliate_code;

    // Calcula el ancho de cada producto en función del número de columnas.
    $ancho = floor(100 / $atts['columnas']) . '%';

    ob_start();
    ?>
    <div style="display: flex; flex-direction: column; align-items: center; border: 1px solid #ccc; padding: 20px; width: <?php echo $ancho; ?>;">
        <img src="<?php echo esc_url($atts['imagen']); ?>" alt="<?php echo esc_attr($atts['titulo']); ?>" style="width: 100%; height: auto;">
        <p style="font-size: 18px; font-weight: bold; margin: 10px 0;"><?php echo esc_html($atts['titulo']); ?></p>
        <a href="<?php echo esc_url($enlace); ?>" style="background-color: #ff9900; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold;">Ver en Amazon</a>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('amazon_sin_api', 'amazon_sin_api_shortcode');

function amazon_sin_api_menu() {
    add_options_page(
        'Amazon sin API',
        'Amazon sin API',
        'manage_options',
        'amazon-sin-api',
        'amazon_sin_api_options_page'
    );
}

add_action('admin_menu', 'amazon_sin_api_menu');

function amazon_sin_api_options_page() {
    ?>
    <div class="wrap">
        <h1>Amazon sin API</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('amazon_sin_api_options');
            do_settings_sections('amazon_sin_api');
            submit_button('Guardar cambios');
            ?>
        </form>
    </div>
    <?php
}

function amazon_sin_api_settings() {
    register_setting('amazon_sin_api_options', 'amazon_sin_api_affiliate_code');

    add_settings_section(
        'amazon_sin_api_section',
        'Configuración de Amazon sin API',
        '',
        'amazon_sin_api'
    );

    add_settings_field(
        'amazon_sin_api_affiliate_code',
        'Código de afiliado',
        'amazon_sin_api_affiliate_code_display',
        'amazon_sin_api',
        'amazon_sin_api_section'
    );
}

add_action('admin_init', 'amazon_sin_api_settings');

function amazon_sin_api_affiliate_code_display() {
    $affiliate_code = get_option('amazon_sin_api_affiliate_code');
    ?>
    <input type="text" name="amazon_sin_api_affiliate_code" value="<?php echo esc_attr($affiliate_code); ?>">
    <?php
}


function amazon_sin_api_enqueue_block_editor_assets() {
    if (has_block_editor()) {
        wp_enqueue_script(
            'amazon-sin-api-block',
            plugins_url('amazon-sin-api-block.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-editor'),
            true
        );
    }
}

add_action('enqueue_block_editor_assets', 'amazon_sin_api_enqueue_block_editor_assets');




function amazon_sin_api_add_tinymce_plugin($plugin_array) {
    $plugin_array['amazon_sin_api_button'] = plugins_url('amazon-sin-api-button.js', __FILE__);
    return $plugin_array;
}

function amazon_sin_api_register_button($buttons) {
    array_push($buttons, 'amazon_sin_api_button');
    return $buttons;
}

function amazon_sin_api_add_button() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    if (get_user_option('rich_editing') == 'true' && !use_block_editor_for_post_type('post')) {
        add_filter('mce_external_plugins', 'amazon_sin_api_add_tinymce_plugin');
        add_filter('mce_buttons', 'amazon_sin_api_register_button');
    }
}

add_action('init', 'amazon_sin_api_add_button');


?>