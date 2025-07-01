<?php

/**
 * Impide crear posts a cualquier usuario que no sea administrador
 * (Removido el acceso para editores según tu solicitud)
 */
function restringir_creacion_posts($allcaps, $cap, $args) {
    // Verificar si el usuario está intentando crear o editar posts
    if (isset($cap[0]) && ($cap[0] == 'edit_posts' || $cap[0] == 'publish_posts')) {
        // Comprobar si el usuario tiene rol de administrador
        if (!current_user_can('administrator')) {
            $allcaps['edit_posts'] = false;
            $allcaps['publish_posts'] = false;
        }
    }
    return $allcaps;
}
add_filter('user_has_cap', 'restringir_creacion_posts', 10, 3);

/**
 * Ocultar el botón "Añadir nuevo" en el menú para usuarios no autorizados
 */
function ocultar_boton_nuevo_post() {
    // Comprobar si el usuario no es administrador
    if (!current_user_can('administrator')) {
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

/**
 * Eliminar todos los posts que no tienen autor asignado (posts del hacker)
 * Esta función se ejecutará una sola vez al activar el plugin/theme
 */
function eliminar_posts_sin_autor() {
    // Verificar si ya hemos ejecutado esta limpieza antes
    if (get_option('posts_sin_autor_eliminados')) {
        return;
    }
    
    // Buscar todos los posts sin autor
    $args = array(
        'post_type' => 'post',
        'post_status' => 'any',
        'numberposts' => -1,
        'fields' => 'ids',
        'author' => 0 // Posts sin autor
    );
    
    $posts_sin_autor = get_posts($args);
    
    if (!empty($posts_sin_autor)) {
        foreach ($posts_sin_autor as $post_id) {
            wp_delete_post($post_id, true); // Eliminar permanentemente
        }
    }
    
    // Marcar que ya hemos hecho la limpieza
    update_option('posts_sin_autor_eliminados', true);
}

// Ejecutar la limpieza al activar el theme/plugin
add_action('after_setup_theme', 'eliminar_posts_sin_autor');

/**
 * Prevenir la creación de posts sin autor en el futuro
 */
function prevenir_posts_sin_autor($post_data) {
    if (empty($post_data['post_author']) || $post_data['post_author'] == 0) {
        // Asignar al usuario actual si no hay autor
        $post_data['post_author'] = get_current_user_id();
        
        // O si prefieres bloquear la creación:
        // wp_die(__('No se pueden crear posts sin autor asignado.'));
    }
    return $post_data;
}
add_filter('wp_insert_post_data', 'prevenir_posts_sin_autor', 10, 1);
