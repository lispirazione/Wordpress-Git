<?php
$mysqli = new mysqli("localhost", "music_local", "P0rT41.", "portal");

/* comprobar la conexión */
if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}

/* comprobar si el servidor sigue vivo */
if ($mysqli->ping()) {
    printf ("¡La conexión está bien!\n");
} else {
    printf ("Error: %s\n", $mysqli->error);
}

/* cerrar la conexión */
$mysqli->close();