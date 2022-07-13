<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <?php wp_head() ?>    
  </head>
  <body>
    <header>
<?php if(is_user_logged_in()) {
echo "You are logged in as " . wp_get_current_user()->display_name;
echo "<br>";
echo "<a href='" . wp_logout_url(home_url()) . "'>Log Out</a>";
} else {
    wp_login_form(array(
        'form_id'        => 'loginform',
        'label_username' => __( 'Email Address' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in'   => __( 'Log In' ),
        'id_username'    => 'user_login',
        'id_password'    => 'user_pass',
        'id_remember'    => 'rememberme',
        'id_submit'      => 'wp-submit',
        'remember'       => false,
        'value_username' => false,
        // Set 'value_remember' to true to default the "Remember me" checkbox to checked.
        'value_remember' => false,
       ) );
}
?>
<hr>
</header>
  