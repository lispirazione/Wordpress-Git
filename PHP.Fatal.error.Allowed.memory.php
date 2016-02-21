
http://bit.ly/UqU166

Solucionar el "PHP Fatal error: Allowed memory size of 8388608 bytes exhausted (tried..."

Este error se produce cuando un script PHP excede el límite de memoria definido por defecto, que son 8 MB. Se soluciona de una forma muy sencilla.

Para cambiar el tamaño máximo del límite de memoria para un script en concreto es suficiente con añadir la siguiente línea al comienzo del script:

<?php

ini_set("memory_limit","128M");
define("WP_MEMORY_LIMIT","128M");
?>

Con la línea anterior cambiaríamos el límite a 20 MB de memoria. Si no fuera suficiente, puedes ir aumentando el número de megas hasta que el script funcione.

Se puede conseguir que este cambio sea permanente para todos los scripts PHP que se ejecuten en el servidor añadiendo la siguiente línea al archivo php.ini del servidor:

memory_limit = 20 MB.

Yo he necesitado cambiar los límites de memoria simplemente para trabajar con imágenes (crear las miniaturas, etc.).
