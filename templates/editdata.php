<?php

/**
 * Template Name: Add Info
 *
 * @package Bravada WordPress theme
 */

global $wpdb;

// Initialize the session
if (!session_id()) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["user_loggedin"]) || !$_SESSION["user_loggedin"] === true) {
  header("location: ../login/");
  exit;
}

$user_id = $_SESSION["user_id"];
$email = $_SESSION["user_email"];

$database_email = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_email'")[0]->meta_value;
if ($database_email != $email) {
  header("location: ../logout/");
  exit;
} else {
  $database_data_check = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_basic_data'")[0]->meta_value;
  if ($database_data_check) {
    header("location: ../mainpage/");
    exit;
  }
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
    <link rel="icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon-150x150.png" sizes="32x32" />
    <link rel="icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://fw3lf.com/wp-content/uploads/2021/09/icon.png" />
    <meta name="msapplication-TileImage" content="https://fw3lf.com/wp-content/uploads/2021/09/icon.png" />
  </head>

  <body <?php body_class();
        cryout_schema_microdata('body'); ?>>
    <?php do_action('wp_body_open'); ?>
    <?php cryout_body_hook(); ?>
    <div id="site-wrapper"></div>
    <div id="main_content">
      <div class="wrapper_customform">
        <?php

        $single = $_SESSION["user_single"];

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Define variables and initialize with empty values
          $user_diet = $user_alcohol = "";
          $diet_err = $alcohol_err = "";

          // Validate diet
          if (trim($_POST["student_diet"]) === null) {
            $diet_err = "Select diet.";
          } else {
            $user_diet = trim($_POST["student_diet"]);
          }

          // Validate alcohol
          if (trim($_POST["student_alcohol"])  === null) {
            $diet_err = "Select an option.";
          } else {
            $user_alcohol = trim($_POST["student_alcohol"]);
          }

          $pubcrawl = isset($_POST["pubcrawl"]) ? 1 : 0;
          $daytrip = isset($_POST["daytrip"]) ? 1 : 0;
          $cinema = isset($_POST["cinema"]) ? 1 : 0;
          $sports = isset($_POST["sports"]) ? 1 : 0;
          $boat = isset($_POST["boat"]) ? 1 : 0;
          $dinner = isset($_POST["dinner"]) ? 1 : 0;
          $orientation = isset($_POST["orientation"]) ? 1 : 0;
          $beanies = isset($_POST["beanies"]) ? 1 : 0;

          // Check input errors before inserting in database
          if (empty($diet_err) && empty($alcohol_err)) {

            // Set database entries
            $user_id = $_SESSION["user_id"];
            if ($single) {
              $success = $wpdb->query("INSERT INTO FW_users (user_id, meta_key, meta_value)
          VALUES
          ($user_id, 'user_diet', '$user_diet'),
          ($user_id, 'user_alcohol', '$user_alcohol')");
            } else {
              $success = $wpdb->query("INSERT INTO FW_users (user_id, meta_key, meta_value)
          VALUES
          ($user_id, 'user_diet', '$user_diet'),
          ($user_id, 'user_alcohol', '$user_alcohol'),
          ($user_id, 'dec_pubcrawl', '$pubcrawl'),
          ($user_id, 'dec_daytrip', '$daytrip'),
          ($user_id, 'dec_cinema', '$cinema'),
          ($user_id, 'dec_sports', '$sports'),
          ($user_id, 'dec_boat', '$boat'),
          ($user_id, 'dec_dinner', '$dinner'),
          ($user_id, 'dec_orientation', '$orientation'),
          ($user_id, 'dec_beanies', '$beanies')");
            }

            if ($success) {
              $wpdb->query("UPDATE FW_users SET meta_value = 1 WHERE user_id = $user_id AND meta_key = 'user_basic_data'");
              $_SESSION["user_basic_data"] = 1;
              header("location: ../mainpage/");
              exit;
            } else {
              echo "Something has gone wrong. Please contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../'>Back</a>";
            }
          }
        }
        ?>
        <!-- Page Content -->
        <h2>Add Information</h2>
        <p>Please fill in the form.</p>
        <form method="post" class="info_questions">
          <div class="form-group">
            <label>1. Jsi vegetarián/vegan? Are you vegetarian/vegan?</label><br>
            <input type="radio" id="student_diet_yes" name="student_diet" value="1" required>
            <label for="student_diet_yes">Ano/Yes</label><br>
            <input type="radio" id="student_diet_no" name="student_diet" value="0">
            <label for="student_diet_no">Ne/No</label><br>
          </div>
          <div class="form-group">
            <label>2. Piješ alkohol? Do you drink alcohol?</label><br>
            <input type="radio" id="student_alcohol_yes" name="student_alcohol" value="1" required>
            <label for="student_alcohol_yes">Ano/Yes</label><br>
            <input type="radio" id="student_alcohol_no" name="student_alcohol" value="0">
            <label for="student_alcohol_no">Ne/No</label><br>
          </div>
          <?php
          if (!$single) {
          ?>
            <div class="form-group">
              <label>3. Na kterou z akcí půjdeš (nezávazně)? Which events do you plan on joining? (It's just a survey)</label><br>
              <input type="checkbox" id="pubcrawl" name="pubcrawl">
              <label for="pubcrawl">27.09. Pubcrawl</label><br>
              <input type="checkbox" id="daytrip" name="daytrip">
              <label for="daytrip">28.09. Day trip</label><br>
              <input type="checkbox" id="cinema" name="cinema">
              <label for="cinema">28.09. Cinema Night</label><br>
              <input type="checkbox" id="sports" name="sports">
              <label for="sports">30.09. Sports Day</label><br>
              <input type="checkbox" id="boat" name="boat">
              <label for="boat">01.10. Boat Party</label><br>
              <input type="checkbox" id="dinner" name="dinner">
              <label for="dinner">02.10. Velvet Dinner</label><br>
              <input type="checkbox" id="orientation" name="orientation">
              <label for="orientation">03.10. Orientation Day</label><br>
              <input type="checkbox" id="beanies" name="beanies">
              <label for="beanies">03.10. Beanies</label><br>
            </div>
          <?php } ?>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Send information">
          </div>
        </form>
      </div>
    </div>
  <?php get_footer();
}
