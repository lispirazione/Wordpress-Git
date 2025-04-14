<?php


// Mata el editor de temas/plugins para todos
define('DISALLOW_FILE_EDIT', true);

// Evitar que usuarios no-administradores editen temas/plugins
add_action('admin_init', 'bloquear_editor_archivos');
function bloquear_editor_archivos() {
    if (!current_user_can('administrator')) {
        define('DISALLOW_FILE_EDIT', true); // Desactiva el editor de temas/plugins
        remove_submenu_page('themes.php', 'theme-editor.php');
        remove_submenu_page('plugins.php', 'plugin-editor.php');
    }
}