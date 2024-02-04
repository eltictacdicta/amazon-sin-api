<?php
/*
Plugin Name: Amazon sin API
Description: Plugin para crear una caja de producto de Amazon con enlace de afiliado.
Version: 1.0
Author: Javier Trujillo (misterdigital)
*/



function amazon_sin_api_enqueue_styles() {
    // Registra una hoja de estilo vacía
    wp_register_style('amazon_sin_api_styles', false);
    wp_enqueue_style('amazon_sin_api_styles');

    // CSS personalizado
    $custom_css = "
        .amazon-product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }
        @media (max-width: 600px) {
            .amazon-product-grid {
                grid-template-columns: 1fr !important;
            }
        }
    ";

    wp_add_inline_style('amazon_sin_api_styles', $custom_css);
}
add_action('wp_enqueue_scripts', 'amazon_sin_api_enqueue_styles');


function amazon_sin_api_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'titulo1' => '', 'imagen1' => '', 'asin1' => '',
            'titulo2' => '', 'imagen2' => '', 'asin2' => '',
            'titulo3' => '', 'imagen3' => '', 'asin3' => '',
        ), 
        $atts, 
        'amazon'
    );

    $affiliate_code = get_option('amazon_sin_api_affiliate_code');

    ob_start();
    ?>
    <div class="amazon-product-grid">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <?php if (!empty($atts["titulo$i"]) && !empty($atts["imagen$i"]) && !empty($atts["asin$i"])) : ?>
                <?php
                // Construye el enlace a Amazon usando el ASIN y el código de afiliado.
                $enlace = "https://www.amazon.es/dp/" . $atts["asin$i"] . "?&tag=" . $affiliate_code;
                ?>
                <div style="display: flex; flex-direction: column; align-items: center; border: 1px solid #ccc; padding: 20px; margin-bottom: 15px;">
                    <img src="<?php echo esc_url($atts["imagen$i"]); ?>" alt="<?php echo esc_attr($atts["titulo$i"]); ?>" style="width: 100%; height: auto;">
                    <p style="font-size: 18px; font-weight: bold; margin: 10px 0;"><?php echo esc_html($atts["titulo$i"]); ?></p>
                    <a href="<?php echo esc_url($enlace); ?>" rel="nofollow" style="background-color: #ff9900; color: white; padding: 10px 20px; text-decoration: none; font-weight: bold;">Ver en Amazon</a>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
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