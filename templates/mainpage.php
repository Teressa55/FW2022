<?php

/**
 * Template Name: Mainpage
 *
 * @package Bravada WordPress theme
 */

// Initialize the session
if (!session_id()) {
  session_start();
}

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["user_loggedin"]) || !$_SESSION["user_loggedin"] === true) {
  header("location: ../login/");
  exit;
}

if (!$_SESSION["user_basic_data"]) {
  header("location: ../add-info/");
  exit;
}

$user_code = $_SESSION["user_code"];
$single = $_SESSION["user_single"];

if ($single) {
  $pubcrawl = $wpdb->get_results("SELECT pubcrawl FROM FW_single WHERE code = '$user_code'")[0]->pubcrawl;
} else {
  $pubcrawl = 1;
}

get_header(); ?>

<!-- CONTENT -->
<div id="event_wrapper">
  <div id="events_top">
    <div id="events_top_center">
      <div id="events_top_title">EVENTS – Register!</div>
    </div>
  </div>
  <div id="event_content">
    <div class="event_row">
      <?php
      if ($pubcrawl) {
      ?>
        <a href="./pubcrawl" class="event_link">
          <div class="event_obj" id="pubcrawl" style="background-image: url('https://fw3lf.com/wp-content/uploads/2021/09/pubcrawl.jpg')">
            <div class="event_inf">
              <div class="event_title">Pubcrawl</div>
              <div class="event_wholedate">27.09.</div>
            </div>
          </div>
        </a>
      <?php
      }
      ?>
      <a href="./sports-day" class="event_link">
        <div class="event_obj" id="pubcrawl" style="background-image: url('https://fw3lf.com/wp-content/uploads/2021/09/sports.jpg')">
          <div class="event_inf">
            <div class="event_title">Sports Day</div>
            <div class="event_wholedate">30.09.</div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<?php get_footer();
