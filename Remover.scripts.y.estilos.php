/***********************************************************************************************************/
//**** REMOVER SCRIPTS Y ESTILOS ******//
/***********************************************************************************************************/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);













function mi_remove_scripts_userpro() {
    if ( !is_page( array(1653, 1655, 1654, 1656 ) ))  {
    wp_deregister_script( 'userpro_swf','userpro_spinners','userpro_lightview', 'userpro_min','jquery-ui-datepicker' );
  }
}
add_action( 'wp_print_scripts', 'mi_remove_scripts_userpro' );


function my_deregister_styles_userpro() {
    if ( !is_page( array(1653, 1655, 1654, 1656 ) ))  {
	wp_deregister_style( 'userpro_jquery_ui_style', 'userpro_skin_custom','userpro_min','custom_font', 'userpro_lightview','userpro_skin_min' );
    }
}
add_action( 'wp_print_styles', 'my_deregister_styles_userpro' );