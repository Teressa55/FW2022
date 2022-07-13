<?php

/**
* Template Name: Send Email
*
* @package Bravada WordPress theme
*/

global $wpdb;

// Initialize the session
if (!session_id()) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
/*if (!isset($_SESSION["user_loggedin"]) || !$_SESSION["user_loggedin"] === true) {
  header("location: ../login/");
  exit;
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
</head>

<body <?php body_class();
cryout_schema_microdata('body'); ?>>
<?php do_action('wp_body_open'); ?>
<?php cryout_body_hook(); ?>
<div id="site-wrapper"></div>
<div id="main_content">
  <div class="wrapper_customform">
    <?php
    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $max_id = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;

      //for ($x = 49; $x <= 89; $x++) {
      for ($x = 80; $x <= 85; $x++) {
        $data = $wpdb->get_results("SELECT * FROM FW_single WHERE id = $x")[0];
        $student_name = $data->name;
        $email = $data->email;
        $code = $data->code;

        date_default_timezone_set('Europe/Berlin');
        setlocale(LC_TIME, "de_DE.utf8");
        $to = $email;
        $subject = "Fresher's Week – Registration";
        $body = 'Ahoj ' . $student_name . '!<br>

        [CZ] Vítejte na FRESHERS WEEK 2021. Dostlai jste tento email, protože jste měli dost odhavy  koupit si týdenní lístek a přidat se k nám na 6 neuveřitelných dnů zábavy a párty.

        Ale než začneme, musíme Vás poprosit, aby jste se zaregistrovali na naší webové stránce fw3lf.com, pomocí tohoto kódu.

        [EN] Welcome to FRESHERS WEEK 2021! If you’re getting this email it means you were brave enough to purchase a week ticket and join us on 6 incredible days of partying.

        <p style="color: red; font-size: 1.3em">PŘIHLAŠ SE NA PUBCRAWL DO ZÍTRA 26.9. 17:00</p>

        <p style="color: red; font-size: 1.3em">IF YOU BOUGHT A PUBCRAWL TICKET SIGN UP UNTIL TOMORROW 26.9. 17:00 PRAGUE TIME</p>

        But before we start, we ask you to please register on our website fw3lf.com, using the following code.

        Pomocí kódu se můžete přihlásit na jakoukoliv akci na našem webu

        With the following code you can sign up to any event on our website:

        Skenujte pomocí mobilu | Scan with your phone:

        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https%3A%2F%2Fwww.fw3lf.com/?code=' . $code . '&choe=UTF-8" title="FW" />

        A nebo přes odkaz | Or register using this link: <a href="https://fw3lf.com/?code=' . $code . '">' . $code . '</a>

        Your

        <span style="color: #666">FRESHERS WEEK</span>

        Team

        <hr>

        Kontakt:
        E-Mail: freshersweek.lf3@gmail.com';

        wp_mail( $to, $subject, $body);

        echo ("Email sent to: " . $student_name . " with email: " . $email . " and code: " . $code . "<br>");
      }

      // Define variables and initialize with empty values
      /*$email = $_POST['email'];
      $student_name = $_POST['student_name'];
      $code = $_POST['code'];
      $success = True;
      if ($success) {
      date_default_timezone_set('Europe/Berlin');
      setlocale(LC_TIME, "de_DE.utf8");
      $to = $email;
      $subject = "Fresher's Week – Registration";
      $body = 'Ahoj ' . $student_name . '!<br>

      [CZ] Vítejte na FRESHERS WEEK 2021. Dostlai jste tento email, protože jste měli dost odhavy  koupit si týdenní lístek a přidat se k nám na 6 neuveřitelných dnů zábavy a párty.

      Ale než začneme, musíme Vás poprosit, aby jste se zaregistrovali na naší webové stránce fw3lf.com, pomocí tohoto kódu.

      [EN] Welcome to FRESHERS WEEK 2021! If you’re getting this email it means you were brave enough to purchase a week ticket and join us on 6 incredible days of partying.

      But before we start, we ask you to please register on our website fw3lf.com, using the following code.

      Pomocí kódu se můžete přihlásit na jakoukoliv akci na našem webu

      With the following code you can sign up to any event on our website:

      Skenujte pomocí mobilu | Scan with your phone:
      <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=https%3A%2F%2Fwww.fw3lf.com/?code=' . $code . '&choe=UTF-8" title="FW" />
      A nebo přes odkaz | Or register using this link: <a href="https://fw3lf.com/?code=' . $code . '">' . $code . '</a>

      Your

      <span style="color: #666">FRESHERS WEEK</span>

      Team

      <hr>

      Kontakt:
      E-Mail: freshersweek.lf3@gmail.com';

      wp_mail( $to, $subject, $body);
    }*/
  }
  ?>
  <!-- Page Content -->
  <h2>Send email</h2>
  <form method="post" class="info_questions">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="student_name" class="form-control" value="<?php echo $student_name; ?>">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
    </div>
    <div class="form-group">
      <label>Code</label>
      <input type="text" name="code" class="form-control" value="<?php echo $code; ?>">
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Send information">
    </div>
  </form>
</div>
</div>
<?php get_footer();
