<?php

/**
 * Template Name: Boats
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

if ($single) {
    header("location: ../mainpage/");
    exit;
}

$database_email = $wpdb->get_results("SELECT meta_value FROM FW_users WHERE user_id = $user_id AND meta_key = 'user_email'")[0]->meta_value;
if ($database_email != $email) {
    header("location: ../logout/");
    exit;
} else {

    get_header();
?>
    <div id="main_content">
        <div class="wrapper_customform">
            <?php
            // Check if user code exists
            $user_timeslot_exists = $wpdb->get_results("SELECT timeslot FROM FW_sports WHERE code = '$user_code'")[0]->timeslot;
            if (isset($user_timeslot_exists)) {
            ?>
                <h2>Sports Day – Pedal Boats</h2>
                <span style="font-size:1.5em">📍 Slovanský Ostrov Rental Boats<br>
                    🛥 You have been added to a boat. Your timeslot is at <?php echo ($user_timeslot_exists ? "19:00" : "18:00"); ?>.<br>
                    <img src="https://fw3lf.com/wp-content/uploads/2021/09/Background.jpg" class="sports_image"><br>
                    If you have any questions you can contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../mainpage/'>Back</a></span>
            <?php
            } else {
                // Processing form data when form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (trim($_POST["rand67"]) != "" || trim($_POST["rand78"]) != "") {
                        if (trim($_POST["rand67"]) != "") {
                            $success = $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    (0,0, '$user_code')");
                        } else if (trim($_POST["rand78"]) != "") {
                            $success = $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    (1,0, '$user_code')");
                        }
                        if ($success) {
                            header("location: ../mainpage/");
                            exit;
                        }
                    } else {

                        // Define variables and initialize with empty values
                        $code_1 = $code_2 = $code_3 = "";
                        $code_err = "";

                        // Validate code 1
                        if (trim($_POST["code_1"]) != "") {
                            $code_1 = $_POST["code_1"];
                            if ($code_1 == $user_code) {
                                $code_err = "The code has to be different than your own 😉";
                            } else {
                                $code_1_exists = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code_1'")[0]->user_id;
                                if (isset($code_1_exists)) {
                                    $code_1_used = $wpdb->get_results("SELECT group_id FROM FW_sports WHERE code = '$code_1'")[0]->group_id;
                                    if ($code_1_used) {
                                        $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                    }
                                    $code_1_single = $wpdb->get_results("SELECT email FROM FW_single WHERE code = '$code_1'")[0]->email;
                                    if (isset($code_1_single)) {
                                        $code_err = "Only people with week tickets can sign up/be signed up to the pedal boats.";
                                    }
                                } else {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                }
                            }
                        }

                        // Validate code 2
                        if (trim($_POST["code_2"]) != "") {
                            $code_2 = $_POST["code_2"];
                            if ($code_2 == $user_code) {
                                $code_err = "The code has to be different than your own 😉.";
                            } else {
                                $code_2_exists = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code_2'")[0]->user_id;
                                if (isset($code_2_exists)) {
                                    $code_2_used = $wpdb->get_results("SELECT group_id FROM FW_sports WHERE code = '$code_2'")[0]->group_id;
                                    if ($code_2_used) {
                                        $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                    }
                                    $code_2_single = $wpdb->get_results("SELECT email FROM FW_single WHERE code = '$code_2'")[0]->email;
                                    if (isset($code_2_single)) {
                                        $code_err = "Only people with week tickets can sign up/be signed up to the pedal boats.";
                                    }
                                } else {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                }
                            }
                        }

                        // Validate code 3
                        if (trim($_POST["code_3"]) != "") {
                            $code_3 = $_POST["code_3"];
                            if ($code_3 == $user_code) {
                                $code_err = "The code has to be different than your own 😉";
                            } else {
                                $code_3_exists = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code_3'")[0]->user_id;
                                if (isset($code_3_exists)) {
                                    $code_3_used = $wpdb->get_results("SELECT group_id FROM FW_sports WHERE code = '$code_3'")[0]->group_id;
                                    if ($code_3_used) {
                                        $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                    }
                                    $code_3_single = $wpdb->get_results("SELECT email FROM FW_single WHERE code = '$code_3'")[0]->email;
                                    if (isset($code_3_single)) {
                                        $code_err = "Only people with week tickets can sign up/be signed up to the pedal boats.";
                                    }
                                } else {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                                }
                            }
                        }

                        if ($code_1 == "" && $code_2 == "" && $code_3 == "") {
                            $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
                        }

                        // Check input errors before inserting in database
                        if (empty($code_err)) {

                            $timeslot = $_POST["timeslot"];

                            // Set database entries
                            $max_id = $wpdb->get_results("SELECT MAX(group_id) as max_id FROM FW_sports")[0]->max_id;
                            if (empty($max_id)) {
                                $max_id = 1;
                            } else {
                                $max_id++;
                            }

                            $success = $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    ($timeslot,$max_id, '$user_code')");

                            if ($code_1 != "") {
                                $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    ($timeslot,$max_id, '$code_1')");
                            }
                            if ($code_2 != "") {
                                $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    ($timeslot,$max_id, '$code_2')");
                            }
                            if ($code_3 != "") {
                                $wpdb->query("INSERT INTO FW_sports (timeslot,group_id, code)
                                    VALUES
                                    ($timeslot,$max_id, '$code_3')");
                            }

                            if ($success) {
                                header("location: ../mainpage/");
                                exit;
                            } else {
                                echo "Something has gone wrong. Please contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../'>Back</a>";
                            }
                        }
                    }
                }
            ?>
                <!-- Page Content -->
                <h2>Sports Day – Pedal Boats (Sign up now!)</h2>
                <img src="https://fw3lf.com/wp-content/uploads/2021/09/Background.jpg" class="sports_image"><br>
                🇨🇿 📍 Slovanský Ostrov - Půjčovna lodiček<br>
                ⏰ 2 časové intervaly, 18h–19h a 19h–20h!<br>
                ℹ️ Jedna loď má 4 místa. Můžete si vybrat 3 své přátele nebo si vytvořit nové přátele výběrem náhodné lodi!<br>
                <hr class="hr_style_1">
                🇬🇧 📍 Slovanský Ostrov Rental Boats<br>
                ⏰ 30.09. 2 time slots, 6-7pm and 7-8pm!<br>
                ℹ️ One boat has 4 spaces. You can add up to 3 of your friends or make new friends by choosing a random boat!
                <!--<div class="twocolumns">
                    <div class="firstcolumn">
                        <h3>🕕 6pm - 7pm sign up</h3>
                        <div class="forms_boats">
                            <form method="post" class="info_questions">
                                <input type="hidden" id="rand67" name="rand67" value="1">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="🛥 Random boat 6pm - 7pm">
                                </div>
                            </form>
                            <hr class="hr_style_1">
                            Or sign up as a group:
                            <form method="post" class="info_questions">
                                <div class="form-group">
                                    <label>Your code:</label>
                                    <input type="text" name="code_0" class="form-control" value="<?php echo $user_code; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Code 1:</label>
                                    <input type="text" name="code_1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code 2:</label>
                                    <input type="text" name="code_2" class="form-control">
                                </div>
                                <div class="form-group has-error">
                                    <label>Code 3:</label>
                                    <input type="text" name="code_3" class="form-control"><br>
                                    <span class="help-block"><?php echo $code_err; ?></span>
                                </div>
                                <input type="hidden" id="timeslot" name="timeslot" value="0">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="🛥 Sign up">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h3>🕖 7pm - 8pm sign up</h3>
                        <div class="forms_boats">
                            <form method="post" class="info_questions">
                                <input type="hidden" id="rand78" name="rand78" value="1">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="🛥 Random boat 7pm - 8pm">
                                </div>
                            </form>
                            <hr class="hr_style_1">
                            Or sign up as a group:
                            <form method="post" class="info_questions">
                                <div class="form-group">
                                    <label>Your code:</label>
                                    <input type="text" name="code_0" class="form-control" value="<?php echo $user_code; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Code 1:</label>
                                    <input type="text" name="code_1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Code 2:</label>
                                    <input type="text" name="code_2" class="form-control">
                                </div>
                                <div class="form-group has-error">
                                    <label>Code 3:</label>
                                    <input type="text" name="code_3" class="form-control"><br>
                                    <span class="help-block"><?php echo $code_err; ?></span>
                                </div>
                                <input type="hidden" id="timeslot" name="timeslot" value="1">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="🛥 Sign up">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                Should you have any questions please contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.-->
            <?php
            }
            ?>
        </div>
    </div>
<?php get_footer();
}
