<?php

/**
 Crear una variable global, tomar los datos de una funcion, luego migrarla a otra funcion para reutilizar.

*/

 $notas;  /* Se crea una variable cualquiera, esta es tipo global aunque no tenga datos, va fuera de la funcion */



function alguna_funcion_x () {
                        
     /* Se llama la variable global */
     global   $notas;

     /* Se recogen los datos */
     $GLOBALS['notas'] =   $this->get_pdf_order_note( $order_id );

}


/*  Ahora se puede utilizar la variable global en otra funcion */
function alguna_funcion_b () {
                        
    global   $notas;
    $content = str_replace(	'[[notas]]', 			$notas, 		$content );
				
}
