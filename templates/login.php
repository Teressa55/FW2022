<?php

/**
 * Template Name: Login
 *
 * @package Bravada WordPress theme
 */


global $wpdb;
// Initialize the session
if (!session_id()) {
    session_start();
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
</head>

<body <?php body_class();
        cryout_schema_microdata('body'); ?>>
    <?php do_action('wp_body_open'); ?>
    <?php cryout_body_hook(); ?>
    <div id="site-wrapper"></div>
    <?php

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true) {
        header("location: ../mainpage/");
        exit;
        /*
        <script type="text/javascript">
        window.location.href = '../mainpage/';//
        </script>*/
    }

    // Define variables and initialize with empty values
    $email = $password = "";
    $email_err = $password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if username is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter a valid email.";
        } else {
            $email = trim($_POST["email"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a valid password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($email_err) && empty($password_err)) {
            
            $user_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$email'")[0]->user_id;

            if (empty($user_id)) {
                // Display an error message if email doesn't exist
                $email_err = "Please enter a valid email.";
            } else {
                $hashed_password = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_password'")[0]->meta_value;
                if (password_verify($password, $hashed_password)) {

                    $user_code = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_code'")[0]->meta_value;
                    $user_basic_data = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_basic_data'")[0]->meta_value;

                    $single_code_email = $wpdb->get_results("SELECT email FROM FW_single WHERE code = '$user_code'")[0]->email;

                    if (!empty($single_code_email)) {
                        $single = true;
                    } else {
                        $single = false;
                    }

                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["user_loggedin"] = true;
                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["user_email"] = $email;
                    $_SESSION["user_code"] = $user_code;
                    $_SESSION["user_basic_data"] = $user_basic_data;
                    $_SESSION["user_single"] = $single;

                    // Redirect user to welcome page
                    header("Location: ../mainpage/");
                    exit();
                    //exit;
                } else {
                    // Display an error message if password is not valid
                    $password_err = "Invalid password.";
                }
            }
        }
    }
    ?>
    <!-- Page Content -->
    <div class="wrapper_customform">
        <h2>Login</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" autocomplete="email">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" autocomplete="current-password">
                <span class="help-block"><?php echo $password_err; ?></span><br>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p id="login">Register new account? <a href="../">Register</a>.</p>
        </form>
    </div>
    <?php get_footer();
