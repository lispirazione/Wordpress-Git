/*
 * Estilos en ADMIN backend
 */
add_action('admin_head', 'my_custom_css');

function my_custom_css() {
  echo '<style>

.vc_admin_label,
#order_data > div.order_data_column_container > div:nth-child(3) { display:none !important;}

  </style>';
}
