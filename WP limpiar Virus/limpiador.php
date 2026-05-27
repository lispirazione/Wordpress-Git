<?php
// Desactivar el almacenamiento en caché para ver siempre los resultados más recientes.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Archivos .htaccess</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 20px auto; padding: 15px; background-color: #f9f9f9; }
        .container { background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 25px; }
        h1 { color: #d9534f; }
        button { background-color: #d9534f; color: white; padding: 12px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s; }
        button:hover { background-color: #c9302c; }
        .results { margin-top: 25px; border-top: 1px solid #eee; padding-top: 20px; }
        .success { color: #5cb85c; }
        .error { color: #d9534f; }
        .path { font-family: "Courier New", Courier, monospace; background-color: #f0f0f0; padding: 2px 5px; border-radius: 3px; }
        .warning { background-color: #fcf8e3; border: 1px solid #faebcc; color: #8a6d3b; padding: 15px; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h1><span style="font-size: 2em;">🗑️</span> Eliminador de .htaccess</h1>
    <p>Este script buscará y eliminará todos los archivos <span class="path">.htaccess</span> dentro del directorio donde se encuentra y en todos sus subdirectorios.</p>
    <p><strong>ADVERTENCIA:</strong> Esta acción es irreversible. Asegúrate de tener una copia de seguridad.</p>

    <form method="post">
        <button type="submit" name="iniciar_borrado">Hacer clic para ELIMINAR todos los .htaccess</button>
    </form>

    <?php
    // El código PHP se ejecuta solo si se ha enviado el formulario (al hacer clic en el botón)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciar_borrado'])) {
        echo '<div class="results">';
        echo '<h2>Resultados del Proceso:</h2>';

        $archivosEliminados = [];
        $errores = [];

        try {
            // Obtener el directorio actual donde se encuentra el script
            $directorioRaiz = __DIR__;

            // Crear un iterador recursivo para recorrer todos los directorios y archivos
            $iterador = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directorioRaiz, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            // Recorrer cada elemento
            foreach ($iterador as $archivo) {
                // Si el nombre del archivo es exactamente ".htaccess"
                if ($archivo->getFilename() === '.htaccess') {
                    $rutaCompleta = $archivo->getRealPath();
                    // Intentar borrar el archivo
                    if (unlink($rutaCompleta)) {
                        $archivosEliminados[] = htmlspecialchars($rutaCompleta);
                    } else {
                        $errores[] = "No se pudo eliminar: " . htmlspecialchars($rutaCompleta);
                    }
                }
            }

            // Mostrar los resultados
            if (!empty($archivosEliminados)) {
                echo '<h4>Archivos .htaccess eliminados exitosamente:</h4>';
                echo '<ul>';
                foreach ($archivosEliminados as $ruta) {
                    echo '<li class="success">Eliminado: <span class="path">' . $ruta . '</span></li>';
                }
                echo '</ul>';
            } else {
                echo '<p>✅ No se encontraron archivos .htaccess para eliminar.</p>';
            }

            if (!empty($errores)) {
                echo '<h4>Ocurrieron errores:</h4>';
                echo '<ul>';
                foreach ($errores as $error) {
                    echo '<li class="error">' . $error . '</li>';
                }
                echo '</ul>';
            }

        } catch (Exception $e) {
            echo '<p class="error"><strong>Error Crítico:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
        }

        echo '</div>';
    }
    ?>

    <div class="warning">
        <strong>¡MUY IMPORTANTE!</strong> Por razones de seguridad, elimina este script (`limpiador.php`) de tu servidor inmediatamente después de usarlo.
    </div>
</div>

</body>
</html>
