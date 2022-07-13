<?php

/**
 * Template Name: Sports
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
$user_code = $_SESSION["user_code"];
$single = $_SESSION["user_single"];


$database_email = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_email'")[0]->meta_value;
if ($database_email != $email) {
    header("location: ../logout/");
    exit;
} else {

    get_header();
?>
    <div id="event_wrapper">
        <div id="events_top">
            <div id="events_top_center">
                <div id="events_top_title">Sports Day 30.09.</div>
            </div>
        </div>
        <div id="event_content">
            <div class="event_row">
                <a href="./pedal-boats" class="event_link">
                    <div class="event_obj" id="pubcrawl" style="background-image: url('https://fw3lf.com/wp-content/uploads/2021/09/Background.jpg')">
                        <div class="event_inf">
                            <div class="event_title">PEDAL BOATS</div>
                        </div>
                    </div>
                </a>
                <div class="sports_info" style="font-size: 1.5em;">
                    ⏰ 30.09. starting at 10:30!<br>
                    📍 Riegrovy sady - Sokol Vinohrady<br>
                    🛥 Pedal Boats on Vltava from 18:00!
                </div>
            </div>
        </div>
    </div>
<?php get_footer();
}
