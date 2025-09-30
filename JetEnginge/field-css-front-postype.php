<?php

add_action('wp_head', function () {
    // Solo ejecuta el código en las páginas de tipo 'portfolio'
    if (is_singular('portfolio')) {
        // Obtiene el ID de la publicación actual
        $post_id = get_the_ID();

        // Obtiene el valor del campo personalizado de JetEngine
        $color_value = get_post_meta($post_id, 'jet_color_background', true);

        // Verifica si el campo de color tiene un valor
        if (!empty($color_value)) {
            // Imprime el estilo CSS en el head
            echo "<style>
                .wp-singular.portfolio-template, #e-footer {
                    background: {$color_value} !important;
                }
            </style>";
        }
    }
});
