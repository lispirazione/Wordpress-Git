Enable Featured Images


#Añade soporte para nuevos thumbnails personalizados
add_theme_support('post-thumbnails');
	
#Define tamaños personalizados
if ( function_exists( 'add_image_size' ) ) {  
    add_image_size('bloggearte-banner', 875, 209, true);  
    add_image_size('thumb_expo',90,44,true);
    add_image_size('thumb_expo_post',377,200,true);
}  


#Añade los tamaños personalizados en el editor del post
add_filter('image_size_names_choose', 'excite_image_sizes');  
function excite_image_sizes($sizes) {  
    $addsizes = array(  
        "bloggearte-banner" => __( "Banner"),
        "thumb_expo" => __("ThumbExpos"),
        "thumb_expo_post" => __("Thumbnail post expo"), 
    );  
    $newsizes = array_merge($sizes, $addsizes);  
    return $newsizes;  
}


Usar los nuevos tamaños en nuestro tema visual 
<?php the_post_thumbnail('cuadrada_peque'); ?>