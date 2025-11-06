<?php

/* Snippet genera que la pagina parezca caida mostrando error 404 en front */

add_action('template_redirect', 'bloquear_sitio_a_publico');

function bloquear_sitio_a_publico() {
    /**
     * Comprueba si el usuario NO ha iniciado sesión
     * Y si la página que intenta ver NO es la de login o admin.
     */
    if ( !is_user_logged_in() && !is_admin() && !is_login_page() ) {

        // Si no cumple, forzamos un error 404
        global $wp_query;
        $wp_query->set_404();
        status_header(404);

        // Intentamos mostrar la plantilla 404 del tema
        get_template_part('404'); 

        // Detenemos la ejecución para no cargar nada más
        exit();
    }
}

// Pequeña función de ayuda para is_login_page()
if ( !function_exists('is_login_page') ) {
    function is_login_page() {
        return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
    }
}
