<?php

/**
 * Template Name: Pubcrawl Overview
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
    <div id="main_content">
        <div class="wrapper_customform">
            <?php
            /*function currMin($group_nrs)
            {
                $min = 20;
                $currmin = 1;
                for ($x = 1; $x <= count($group_nrs); $x++) {
                    if (count($group_nrs[$x]) < $min) {
                        $min = count($group_nrs[$x]);
                        $currmin = $x;
                    }
                }
                return $currmin;
            }

            $max_id = $wpdb->get_results("SELECT MAX(group_id) as max_id FROM FW_pubcrawl")[0]->max_id;
            $groups = array();
            $group_nr = array();
            $current_group = 1;
            $codes_used = array();
            for ($x = 1; $x <= $max_id; $x++) {
                $codes = $wpdb->get_results("SELECT code FROM FW_pubcrawl WHERE group_id = $x");
                foreach ($codes as $code) {
                    if ($code->code == "b577ae65")
                        echo("test" . $current_group . " " . $group_nr[$current_group]);
                    $stud_id = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code->code'")[0]->user_id;
                    $stud_name = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_name'")[0]->meta_value;
                    $stud_email = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $stud_id AND meta_key = 'user_email'")[0]->meta_value;
                    $group_nr[$current_group]++;
                    $groups[$current_group][$group_nr[$current_group]] = $code->code;
                    array_push($codes_used, $code->code);
                    //echo("Name: " . $stud_name . " Email: " . $stud_email . " Group: " . $current_group . "<br>");
                }
                $current_group++;
                if ($current_group > 17)
                    $current_group = 1;
            }
            $user_ids = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = 1 AND meta_key = 'dec_pubcrawl'");
            foreach ($user_ids as $userid) {
                $id = $userid->user_id;
                $code = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $id AND meta_key = 'user_code'")[0]->meta_value;
                if (!in_array($code, $codes_used)) {
                    $mingroup = currMin($groups);
                    $group_nr[$mingroup]++;
                    $groups[$mingroup][$group_nr[$mingroup]] = $code;
                    array_push($codes_used, $code);
                }
            }
            $user_ids = $wpdb->get_results("SELECT code FROM FW_single WHERE pubcrawl = 1");
            foreach ($user_ids as $code) {
                $cd = $code->code;
                if (!in_array($cd, $codes_used)) {
                    $mingroup = currMin($groups);
                    $group_nr[$mingroup]++;
                    $groups[$mingroup][$group_nr[$mingroup]] = $cd;
                    array_push($codes_used, $cd);
                }
            }
            $cnt = 1;
            foreach ($groups as $group) {
                foreach ($group as $cd) {
                    $wpdb->query("INSERT INTO FW_pubcrawl_groups (group_id, code) VALUES ($cnt, '$cd')");
                }
                $cnt++;
            }*/
            $max_id = $wpdb->get_results("SELECT MAX(group_id) as max_id FROM FW_pubcrawl_groups")[0]->max_id;
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
            }
            ?>
        </div>
    </div>
    <?php get_footer();
