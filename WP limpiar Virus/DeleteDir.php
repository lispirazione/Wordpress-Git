<?php

// https://www.wpfixit.com/remove-htaccess-wordpress-infection/
// find . -name ".htaccess" -exec rm -rf {} \;

Tomar posesion "digital305"
chown -R digital305 _Borrar

//  Add the new user to the sudo group
usermod -aG wheel digital305


// LIMPIADOR DE ARCHIVOS DENTRO DE CARPETAS, NO BORRA HTACCESS

$files = glob('images/*'); //obtenemos todos los nombres de los ficheros
foreach($files as $file){
    if(is_file($file))
    unlink($file); //elimino el fichero
}


// Eliminar todos los archivos en un directorio que coincidan con un patrón
$dir = 'temp/';
array_map('unlink', glob("{$dir}*.tmp"));






$nombre_fichero = 'configQDO/Jump/.htaccess';

if (file_exists($nombre_fichero)) {
    echo "El fichero $nombre_fichero existe";
	
} else {
    echo "El fichero $nombre_fichero no existe";
}




function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir);
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir. "configQDO/" .$object) && !is_link($dir."/".$object))
           rrmdir($dir.  "configQDO/" .$object);
         else
           unlink($dir.  "configQDO/" .$object); 
       } 
     }
     rmdir($dir); 
   } 
}




if(file_exists('configQDO')){
    unlink('configQDO');
}else{
    echo 'file not found';
}

if(file_exists("public_html/configQDO")){
    unlink(pdf);
}
