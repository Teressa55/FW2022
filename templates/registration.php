<?php

/**
 * Template Name: Registration
 *
 * @package Bravada WordPress theme
 */
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
      global $wpdb;
      // Processing form data when form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //if (true) {
        $code = $_POST['code'];
        $code_check = $wpdb->get_results("SELECT code,used FROM FW_codes WHERE code = '$code'");
        if (empty($code_check)) {
      ?>
          The code you have entered is wrong. Please check it once again. <a href="../">Back</a><br>
          If you have problems with signing up please contact us <a href="mailto: freshersweek.lf3@gmail.com">here</a>.
          <?php
        } else {
          $used = $code_check[0]->used;
          //TODO Check Code
          if (!$used) {
            $code_email = $wpdb->get_results("SELECT email FROM FW_single WHERE code = '$code'")[0]->email;
            if (empty($code_email)) {
              $code_email = $wpdb->get_results("SELECT email FROM FW_email WHERE code = '$code'")[0]->email;
            }
            //Code right and not used -> Display Registration or Main page
            if (!empty(trim(($_POST["student_name"])))) {

              // Define variables and initialize with empty values
              $user_name = $email = $password = $confirm_password = "";
              $name_err = $email_err = $password_err = $confirm_password_err = "";

              // Validate username
              if (empty(trim($_POST["student_name"]))) {
                $name_err = "Please enter your name.";
              } else {
                $user_name = trim($_POST["student_name"]);
              }

              // Validate Email // TODO:
              if (empty(trim($_POST["email"]))) {
                $email_err = "Please enter a valid email address.";
              } else {
                $database_email = trim($_POST["email"]);
                $meta_id = $wpdb->get_results("SELECT meta_id FROM WP_users WHERE meta_value = '$database_email'")[0]->meta_id;
                if ($meta_id > 0) {
                  $email_err = "This email has already been registered. <a href='../login/'>Login</a>";
                }
                if ($code_email != $database_email) {
                  $email_err = "Please check your email address.";
          ?>
                  The code you have entered is wrong. Please check it once again. <a href="../">Back</a><br>
                  If you have problems with signing up please contact us <a href="mailto: freshersweek.lf3@gmail.com">here</a>.
            <?php
                } else {
                  $email = $database_email;
                }
              }

              // Validate password
              if (empty(trim($_POST["password"]))) {
                $password_err = "Enter Password.";
              } elseif (strlen(trim($_POST["password"])) < 6) {
                $password_err = "Password has to be at least 6 char. long.";
              } else {
                $password = trim($_POST["password"]);
              }

              // Validate confirm password
              if (empty(trim($_POST["confirm_password"]))) {
                $confirm_password_err = "Please confirm password.";
              } else {
                $confirm_password = trim($_POST["confirm_password"]);
                if (empty($password_err) && ($password != $confirm_password)) {
                  $confirm_password_err = "Passwords don't match.";
                }
              }

              // Check input errors before inserting in database
              if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

                // Set database entries
                $database_name = trim($_POST["student_name"]);
                $database_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

                $max_id = $wpdb->get_results("SELECT MAX(user_id) as max_id FROM FW_users")[0]->max_id;
                if (empty($max_id)) {
                  $max_id = 1;
                } else {
                  $max_id++;
                }
                $success = $wpdb->query("INSERT INTO FW_users (user_id, meta_key, meta_value)
              VALUES
              ($max_id, 'user_name', '$database_name'),
              ($max_id, 'user_email', '$database_email'),
              ($max_id, 'user_password', '$database_password'),
              ($max_id, 'user_code', '$code'),
              ($max_id, 'user_basic_data', 0),
              ($max_id, 'user_time', CONVERT_TZ(now(),'+00:00','+01:00'))");

                if ($success) {
                  $wpdb->query("UPDATE FW_codes SET used = 1 WHERE code = '$code'");
                  //$subject = 'New Registration FW';
                  //$body = 'There is a new registration. ' . $database_name . ". Email: " . $database_email;
                  //wp_mail('maximilian.oberhoff@gmail.com', $subject, $body);
                  // Redirect to login page
                  header("location: ../login/");
                  exit;
                } else {
                  echo "Something has gone wrong. Please contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../'>Back</a>";
                }
              }
            }
            ?>
            <!-- Page Content -->
            <h2>Fresher's Week Registration</h2>
            <p>Please fill in the form.</p>
            <form method="post">
              <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="student_name" class="form-control" value="<?php echo $user_name; ?>" autocomplete=name>
                <span class="help-block"><?php echo $name_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $database_email; ?>" autocomplete=email>
                <span class="help-block"><?php echo $email_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" autocomplete=new-password>
                <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Verify Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
              </div>
              <input type="hidden" name="code" id="code" value="<?php echo $code; ?>">
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
                <input type="reset" class="btn btn-default" value="Reset information">
              </div>
              <p id="login">Already registered? <a href="../login/">Login</a>.</p>
            </form>
          <?php
          } else {
            //Code Used
          ?>
            The code you have entered has been used. <a href="../">Back</a><br>
            If you have problems with signing up please contact us <a href="mailto: freshersweek.lf3@gmail.com">here</a>.
        <?php
          }
        }
      } else {
        ?>
        If you have problems with signing up please contact us <a href="mailto: freshersweek.lf3@gmail.com">here</a>.<br>
        <a href="../">Back</a>
      <?php
      }
      ?>
    </div>
  </div>
  <?php get_footer();
