<?php

// https://www.wpfixit.com/remove-htaccess-wordpress-infection/


/* BORRA TODOS LOS ARCHIVOS HTACCESS */

find . -name ".htaccess" -exec rm -rf {} \;


/* BORRA TODOS LOS ARCHIVOS PHP DE LA CARPETA UPLOADS */
find public_html/wp-content/uploads/ -name "*.php" -exec rm -f {} \;
