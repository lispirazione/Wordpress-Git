<?php

/**
 * Agrega un campo personalizado para URL de redirección en productos WooCommerce
 */
function agregar_campo_url_redireccion_producto() {
    woocommerce_wp_text_input( array(
        'id'          => '_url_redireccion_personalizada',
        'label'       => __('URL de Redirección', 'woocommerce'),
        'placeholder' => 'https://ejemplo.com',
        'desc_tip'    => 'true',
        'description' => __('El comprador será redirigido a esta URL después de la compra.', 'woocommerce'),
    ) );
}
add_action('woocommerce_product_options_general_product_data', 'agregar_campo_url_redireccion_producto');

/**
 * Guarda el valor del campo personalizado
 */
function guardar_campo_url_redireccion_producto($post_id) {
    $product = wc_get_product($post_id);
    $url_redireccion = isset($_POST['_url_redireccion_personalizada']) ? esc_url_raw($_POST['_url_redireccion_personalizada']) : '';
    $product->update_meta_data('_url_redireccion_personalizada', $url_redireccion);
    $product->save();
}
add_action('woocommerce_process_product_meta', 'guardar_campo_url_redireccion_producto');

/**
 * Redirecciona a la URL personalizada después de la compra (página de gracias)
 */
function redireccion_despues_de_compra($order_id) {
    $order = wc_get_order($order_id);
    $items = $order->get_items();
    
    foreach ($items as $item) {
        $product_id = $item->get_product_id();
        $url_redireccion = get_post_meta($product_id, '_url_redireccion_personalizada', true);
        
        if (!empty($url_redireccion)) {
            // Agregar JavaScript para redirección después de 3 segundos
            wc_enqueue_js("
                setTimeout(function() {
                    window.location.href = '" . esc_url($url_redireccion) . "';
                }, 3000);
            ");
            break; // Solo usamos la primera URL encontrada
        }
    }
}
add_action('woocommerce_thankyou', 'redireccion_despues_de_compra');
