<?php

/**
* Template Name: Frontpage
*
* @package Bravada WordPress theme
*/

// Initialize the session
if (!session_id()) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true) {
  header("location: ../mainpage/");
  exit;
}

/*for ($x = 0; $x < 100; $x++) {
$rnd = substr(md5(rand() * time()), 0, 8);
$success = $wpdb->query("INSERT INTO FW_codes
(code, used)
VALUES
('$rnd', 0)");
}*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <?php cryout_meta_hook(); ?>
  <meta charset="<?php bloginfo('charset'); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
  <?php endif; ?>
  <?php
  cryout_header_hook();
  wp_head();
  ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link rel="icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon-150x150.png" sizes="32x32"/>
  <link rel="icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon.png" sizes="192x192"/>
  <link rel="apple-touch-icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon.png"/>
  <meta name="msapplication-TileImage" content="https://fw3lf.com/wp-content/uploads/2021/09/icon.png"/>
</head>

<body <?php body_class();
cryout_schema_microdata('body'); ?>>
<?php do_action('wp_body_open'); ?>
<?php cryout_body_hook(); ?>
<div id="site-wrapper"></div>

<div id="frontpage-main-image">
  <div id="frontpage-login-content">
    <div class="code-content">
      <?php
      global $wpdb;

      if (isset($_GET['code'])) {
        $code = $_GET['code'];
      }
      ?>
      <form action="./registration" method="post" enctype="multipart/form-data">
        <div class="form-group <?php echo (!empty($code_err)) ? 'has-error' : ''; ?>">
          <input type="text" name="code" class="form-control" <?php if (isset($code)) echo ('value="' . $code . '"');
          else echo ('placeholder="Enter your Code"'); ?> required>
          <span class="help-block"><?php echo $code_err; ?></span>
        </div>
        <div class="form-group">
          <input type="submit" class="sub-btn" value="Go!">
        </div><br>
        <p id="login">Already registered? <a href="./login/">Login</a>.</p>
      </form>
      <?php

      //<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https%3A%2F%2Fwww.fw3lf.com/?code=fefj3ij&choe=UTF-8" title="FW" />
      //<img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https%3A%2F%2Fwww.fw3lf.com/?code=fef3cvv&choe=UTF-8" title="FW" />
      ?>
    </div>
  </div>
</div>

<?php get_footer();
