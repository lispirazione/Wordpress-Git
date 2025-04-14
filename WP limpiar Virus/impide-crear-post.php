<?php

/**
 * Impide crear posts a cualquier usuario que no sea administrador o editor
 */
function restringir_creacion_posts($allcaps, $cap, $args) {
    // Verificar si el usuario está intentando crear un post
    if (isset($cap[0]) && $cap[0] == 'edit_posts') {
        // Comprobar si el usuario tiene rol de administrador o editor
        if (!current_user_can('administrator') && !current_user_can('editor')) {
            $allcaps['edit_posts'] = false;
        }
    }
    return $allcaps;
}
add_filter('user_has_cap', 'restringir_creacion_posts', 10, 3);

/**
 * Ocultar el botón "Añadir nuevo" en el menú para usuarios no autorizados
 */
function ocultar_boton_nuevo_post() {
    // Comprobar si el usuario no es administrador ni editor
    if (!current_user_can('administrator') && !current_user_can('editor')) {
        echo '<style>
            #wp-admin-bar-new-post,
            a.page-title-action,
            .wrap .page-title-action {
                display: none !important;
            }
        </style>';
    }
}
add_action('admin_head', 'ocultar_boton_nuevo_post');
