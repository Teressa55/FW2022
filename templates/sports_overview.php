<?php

/**
 * Template Name: Sports Overview
 *
 * @package Bravada WordPress theme
 */

global $wpdb;

// Initialize the session
if (!session_id()) {
    session_start();
}

get_header();

?>
<div id="main_content">
    <div class="wrapper_customform" style="font-size: 1.3em;">
        <h2>18:00 - 19:00</h2>
        <?php
        $ids_1 = $wpdb->get_results("SELECT DISTINCT(group_id) FROM `FW_sports` WHERE timeslot = 0 AND group_id != 0");
        $count = 1;
        $totalcount = 0;
        foreach ($ids_1 as $id) {
            echo ("<span style='color: red'>Boat #$count:</span><br>");
            $groupid = $id->group_id;
            $codes = $wpdb->get_results("SELECT code FROM FW_sports WHERE group_id = $groupid");
            $cnt = 1;
            foreach ($codes as $code) {
                $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
                $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
                echo ("$cnt: $stud_name<br>");
                $cnt++;
                $totalcount++;
            }
            $count++;
        }
        echo ("<span style='color: red'>Random Boats:</span><br>");
        $codes = $wpdb->get_results("SELECT code FROM FW_sports WHERE timeslot = 0 AND group_id = 0");
        $cnt = 1;
        foreach ($codes as $code) {
            $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
            $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
            echo ("$cnt: $stud_name<br>");
            $cnt++;
            $totalcount++;
        }
        echo("<h2>Total people: $totalcount</h2><br><br>");
        ?>
        <h2>19:00 - 20:00</h2>
        <?php
        $ids_1 = $wpdb->get_results("SELECT DISTINCT(group_id) FROM `FW_sports` WHERE timeslot = 1 AND group_id != 0");
        $count = 1;
        $totalcount = 0;
        foreach ($ids_1 as $id) {
            echo ("<span style='color: red'>Boat #$count:</span><br>");
            $groupid = $id->group_id;
            $codes = $wpdb->get_results("SELECT code FROM FW_sports WHERE group_id = $groupid");
            $cnt = 1;
            foreach ($codes as $code) {
                $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
                $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
                echo ("$cnt: $stud_name<br>");
                $cnt++;
                $totalcount++;
            }
            $count++;
        }
        echo ("<span style='color: red'>Random Boats:</span><br>");
        $codes = $wpdb->get_results("SELECT code FROM FW_sports WHERE timeslot = 1 AND group_id = 0");
        $cnt = 1;
        foreach ($codes as $code) {
            $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
            $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
            echo ("$cnt: $stud_name<br>");
            $cnt++;
            $totalcount++;
        }
        echo("<h2>Total people: $totalcount</h2><br><br>");
        ?>
        <?php

        /*$max_id = $wpdb->get_results("SELECT MAX(group_id) as max_id FROM FW_pubcrawl_groups")[0]->max_id;
            for ($x = 1; $x <= $max_id; $x++) {
                echo("<u>Group $x</u><br>");
                $codes = $wpdb->get_results("SELECT code FROM FW_pubcrawl_groups WHERE group_id = $x");
                $cnt = 1;
                foreach($codes as $code) {
                    $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
                    $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
                    if (empty($stud_name)) {
                        $stud_name = $wpdb->get_results("SELECT name FROM FW_single WHERE code = '$code->code'")[0]->name;
                    }
                    echo("$cnt: $stud_name<br>");
                    $cnt++;
                }
            }*/
        ?>
    </div>
</div>
<?php get_footer();
