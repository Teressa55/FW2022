<?php

/**
 * Template Name: General overview
 *
 * @package Bravada WordPress theme
 */

get_header();

global $wpdb;

$registered = $wpdb->get_results("SELECT COUNT(DISTINCT user_id) as max_id FROM FW_users")[0]->max_id;
$week_invited = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;
$single_invited = $wpdb->get_results("SELECT COUNT(DISTINCT id) as max_id FROM FW_single")[0]->max_id;

function createBar($name,$code)
{
  global $wpdb;

  $week_total = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;
  $ind = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_single")[0]->count;
  $max_id = $week_total + $ind;
  //$max_id = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;
  $yes = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 1")[0]->count;
  $no = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 0")[0]->count;
  $undec = $max_id-$yes-$no;
  ?>
  <span style="margin-left: 5%; font-size: 1.5em;"><?php echo ("$name (Total: $max_id/$yes Yes/$no No/$undec No Decision or Unregistered)") ?></span><br>
  <div class="progress">
    <div class="dec_yes" style="width: <?php echo 100*($yes/$max_id); ?>%"><?php echo $yes ?></div>
    <div class="dec_no" style="width: <?php echo 100*($no/$max_id); ?>%"><?php echo $no ?></div>
    <div class="dec_undec" style="width: <?php echo 100*($undec/$max_id); ?>%"><?php echo $undec ?></div>
  </div>
  <?php
}

function createBarWeek($name,$code)
{
  global $wpdb;

  $max_id = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;
  $yes = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 1")[0]->count;
  $no = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 0")[0]->count;
  $undec = $max_id-$yes-$no;
  ?>
  <span style="margin-left: 5%; font-size: 1.5em;"><?php echo ("$name (Total: $max_id/$yes Yes/$no No/$undec No Decision)") ?></span><br>
  <div class="progress">
    <div class="dec_yes" style="width: <?php echo 100*($yes/$max_id); ?>%"><?php echo $yes ?></div>
    <div class="dec_no" style="width: <?php echo 100*($no/$max_id); ?>%"><?php echo $no ?></div>
    <div class="dec_undec" style="width: <?php echo 100*($undec/$max_id); ?>%"><?php echo $undec ?></div>
  </div>
  <?php
}

function createBar2($name,$code,$singlecode)
{
  global $wpdb;

  $week_total = $wpdb->get_results("SELECT MAX(id) as max_id FROM FW_email")[0]->max_id;
  $singleyes = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_single WHERE $singlecode = 1")[0]->count;
  $max_id = $week_total + $singleyes;
  $yes = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 1")[0]->count;
  $no = $wpdb->get_results("SELECT COUNT(*) as count FROM FW_users WHERE meta_key = '$code' AND meta_value = 0")[0]->count;
  $undec = $max_id-$yes-$no-$singleyes;
  ?>
  <span style="margin-left: 5%; font-size: 1.5em;"><?php echo ("$name (Total: $max_id/$yes Yes/$singleyes Individual Tickets/$no No/$undec No Decision)") ?></span><br>
  <div class="progress">
    <div class="dec_yes" style="width: <?php echo 100*($yes/$max_id); ?>%"><?php echo $yes ?></div>
    <div class="dec_ind" style="width: <?php echo 100*($singleyes/$max_id); ?>%"><?php echo $singleyes ?></div>
    <div class="dec_no" style="width: <?php echo 100*($no/$max_id); ?>%"><?php echo $no ?></div>
    <div class="dec_undec" style="width: <?php echo 100*($undec/$max_id); ?>%"><?php echo $undec ?></div>
  </div>
  <?php
}
?>

<!-- CONTENT -->
<div id="event_wrapper">
  <span style="margin-left: 5%; font-size: 1.5em;">Total week tickets emails sent: <?php echo $week_invited ?></span><br>
  <span style="margin-left: 5%; font-size: 1.5em;">Total individual tickets emails sent: <?php echo $single_invited ?></span><br>
  <span style="margin-left: 5%; font-size: 1.5em;">Total registered: <?php echo $registered ?></span><br>
  <?php
  createBar("Vegan/Vegetarian","user_diet");
  createBar("Drinks alcohol","user_alcohol");
  createBar2("Pubcrawl","dec_pubcrawl","pubcrawl");
  //createBar("Pubcrawl","dec_pubcrawl");
  createBarWeek("Daytrip","dec_daytrip");
  createBar2("Cinema","dec_cinema","cinema");
  createBar2("Sports","dec_sports","sports");
  createBar2("Boat Party","dec_boat","boat");
  createBar2("Velvet Dinner","dec_dinner","dinner");
  /*createBar("Cinema","dec_cinema");
  createBar("Sports","dec_sports");
  createBar("Boat Party","dec_boat");
  createBar("Velvet Dinner","dec_dinner");*/
  createBar("Orientation Day","dec_orientation");
  createBar("Beanies","dec_beanies");

  echo("<br><br><span style='margin-left: 5%; font-size: 1.5em;'>Week ticket emails sent but not registered:</span><br>");
  $emails = $wpdb->get_results("SELECT email FROM FW_email");
  $cnt = 1;
  foreach($emails as $em) {
    $email = $em->email;
    $check = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$email'")[0]->user_id;
    if (empty($check)) {
      echo("<span style='margin-left: 5%;'>$cnt: $email<br></span>");
      $cnt++;
    }
  }
  ?>
</div>

<?php get_footer();
