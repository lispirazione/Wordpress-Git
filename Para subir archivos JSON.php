<?php

/* SNIPET - PERMITE SUBIDA DE ARCHIVOS JSON EN MEDIA */

function permitir_json_upload($mimes) {
    $mimes['json'] = 'application/json';
    return $mimes;
}
add_filter('upload_mimes', 'permitir_json_upload');
