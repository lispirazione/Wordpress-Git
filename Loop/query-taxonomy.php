<?php
/**
Template Name: Archivo Videos
 */
get_header(); 
global $post;

if ( is_page(134) ) {
    $idTerm = 59;
} 


?>
<style type="text/css">
.embed-container {
    padding-bottom: 55%;
    margin: 15px auto;
}
</style>
<div id="wrapper">



    
<main id="primary" class="content-area">
        
    <article id="wrap-textos">
        <h2 class="titulo-entrada"><?php the_title(); ?></h2>   
         
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$args = array(
  'posts_per_page' => 5,
  'post_type' => 'post-video',
 'tax_query' => array(
        array(
            'taxonomy' => 'archivo-videos',
            'terms' => array( $idTerm ),
        )),
  'paged' => $paged,
  'order' => 'ASC',
  
);
// The Query
query_posts($args);
    
    if ( have_posts() ) : if(function_exists('wp_paginate')) {wp_paginate();}  while ( have_posts() ) : the_post();

?>

       
        <div class="wrapPost100">
            <h1 class="titleMemorias"><?php the_title(); ?></h1>
           
        </div> 

 <div class="wrapPost100">
         <div class="embed-container"><?php the_field('cf_video_youtube'); ?></div>
 </div>
        <div class="wrapPost100">
            <div class='BoxCm'>Compartir:</div>
            <?php echo do_shortcode('[easy-social-share buttons="twitter,facebook" counters=0 template="grey-blocks-retina" text="mensaje"]') ?>
             <div class="cleargrey"></div>
        </div>
        
    <div class="clear"></div> 
    <?php endwhile;?>
  
        
    <?php else: ?>
        Lo sentimos, no se han encontrado entradas.
    <?php endif; ?>
<?php
wp_reset_query();
?> 
    </article>


        <?php get_sidebar(); ?>

            
</main><!-- #primary -->
</div><!-- #wrapper -->


<?php get_footer(); ?>