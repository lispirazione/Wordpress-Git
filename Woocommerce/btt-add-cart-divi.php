<?php
/**
 * Botón Añadir al carrito AJAX para Divi
 */
function custom_divi_add_to_cart_button() {
    // Solo en páginas de WooCommerce
    if (!function_exists('is_woocommerce')) return;
    
    // CSS necesario
    echo '
    <style>
        .divi-custom-atc-container {
            margin: 15px 0;
            text-align: center;
        }
        
        .divi-custom-atc-btn {
            background: #000;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            display: inline-block;
            position: relative;
        }
        
        .divi-custom-atc-btn:hover {
            background: #333;
        }
        
        .divi-custom-atc-btn.loading {
            padding-left: 40px;
            opacity: 0.8;
        }
        
        .divi-custom-atc-loader {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: 2px solid rgba(255,255,255,0.3);
            border-top: 2px solid #fff;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: diviSpin 0.8s linear infinite;
            display: none;
        }
        
        .divi-custom-atc-btn.loading .divi-custom-atc-loader {
            display: block;
        }
        
        .divi-custom-atc-message {
            color: #4CAF50;
            font-size: 13px;
            margin-top: 5px;
            font-weight: bold;
            display: none;
        }
        
        @keyframes diviSpin {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }
    </style>';
    
    // JavaScript para AJAX
    echo '
    <script>
    jQuery(document).ready(function($) {
        $("body").on("click", ".divi-custom-atc-btn", function(e) {
            e.preventDefault();
            var $btn = $(this);
            var product_id = $btn.data("product_id");
            
            // Mostrar loader
            $btn.addClass("loading");
            
            $.ajax({
                type: "POST",
                url: wc_add_to_cart_params.ajax_url,
                data: {
                    action: "woocommerce_add_to_cart",
                    product_id: product_id,
                    quantity: 1
                },
                success: function(response) {
                    $btn.removeClass("loading");
                    
                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                        return;
                    }
                    
                    // Mostrar mensaje
                    $btn.siblings(".divi-custom-atc-message").fadeIn().delay(2000).fadeOut();
                    
                    // Actualizar mini-carrito
                    $(document.body).trigger("added_to_cart", [response.fragments, response.cart_hash]);
                },
                error: function() {
                    $btn.removeClass("loading");
                    alert("Error al añadir al carrito");
                }
            });
        });
    });
    </script>';
}
add_action('wp_footer', 'custom_divi_add_to_cart_button');

/**
 * Añade el botón después de cada producto en Divi
 */
function add_custom_button_to_divi_products() {
    global $product;
    
    echo '
    <div class="divi-custom-atc-container">
        <button class="divi-custom-atc-btn" data-product_id="' . $product->get_id() . '">
            <span class="divi-custom-atc-loader"></span>
            Añadir al carrito
        </button>
        <div class="divi-custom-atc-message">
            ✔️ Añadido al carrito
        </div>
    </div>';
}
add_action('woocommerce_after_shop_loop_item', 'add_custom_button_to_divi_products', 15);
