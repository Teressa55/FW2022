<?php

/**
 * Template Name: Pubcrawl
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
    $pubcrawl = $wpdb->get_results("SELECT pubcrawl FROM FW_single WHERE code = '$user_code'")[0]->pubcrawl;
    if (!$pubcrawl) {
        header("location: ../mainpage/");
        exit;
    }
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
            $user_code_exists = $wpdb->get_results("SELECT group_id FROM FW_pubcrawl WHERE code = '$user_code'")[0]->group_id;
            if (isset($user_code_exists)) {
            ?>
                You have been added to a group. If you have any questions you can contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../mainpage/'>Back</a>
            <?php
            } else {
                // Processing form data when form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Define variables and initialize with empty values
                    $code_1 = $code_2 = $code_3 = "";
                    $code_err = "";

                    $nr_friends = 0;

                    // Validate code 1
                    if (trim($_POST["code_1"]) != "") {
                        $code_1 = $_POST["code_1"];
                        if ($code_1 == $user_code) {
                            $code_err = "The code has to be different than your own 😉";
                        } else {
                            $code_1_exists = $wpdb->get_results("SELECT user_id FROM FW_users WHERE meta_value = '$code_1'")[0]->user_id;
                            if (isset($code_1_exists)) {
                                $code_1_used = $wpdb->get_results("SELECT group_id FROM FW_pubcrawl WHERE code = '$code_1'")[0]->group_id;
                                if ($code_1_used) {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
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
                                $code_2_used = $wpdb->get_results("SELECT group_id FROM FW_pubcrawl WHERE code = '$code_2'")[0]->group_id;
                                if ($code_2_used) {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
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
                                $code_3_used = $wpdb->get_results("SELECT group_id FROM FW_pubcrawl WHERE code = '$code_3'")[0]->group_id;
                                if ($code_3_used) {
                                    $code_err = "Please check the codes and make sure your friend has registered and is not in another group already.";
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

                        // Set database entries
                        $max_id = $wpdb->get_results("SELECT MAX(group_id) as max_id FROM FW_pubcrawl")[0]->max_id;
                        if (empty($max_id)) {
                            $max_id = 1;
                        } else {
                            $max_id++;
                        }

                        $success = $wpdb->query("INSERT INTO FW_pubcrawl (group_id, code)
                                    VALUES
                                    ($max_id, '$user_code')");

                        if ($code_1 != "") {
                            $wpdb->query("INSERT INTO FW_pubcrawl (group_id, code)
                                    VALUES
                                    ($max_id, '$code_1')");
                        }
                        if ($code_2 != "") {
                            $wpdb->query("INSERT INTO FW_pubcrawl (group_id, code)
                                    VALUES
                                    ($max_id, '$code_2')");
                        }
                        if ($code_3 != "") {
                            $wpdb->query("INSERT INTO FW_pubcrawl (group_id, code)
                                    VALUES
                                    ($max_id, '$code_3')");
                        }

                        if ($success) {
                            header("location: ../mainpage/");
                            exit;
                        } else {
                            echo "Something has gone wrong. Please contact us <a href='mailto: freshersweek.lf3@gmail.com'>here</a>.<br><a href='../'>Back</a>";
                        }
                    }
                }
            ?>
                <!-- Page Content -->
                <h2>Pubcrawl</h2>
                📍Kampa Park, in front of the Kampa Museum!<br>
                ⏰ 16:45 in Kampa, don’t be late! Last group leaves at 17:20!
                <?php /*
                    Abyste byli ve stejné skupině, přidejte kódy maximálně tři svých kamarádů.<br>To be in the same group add up to 3 of your friend's codes here.
                    <form method="post" class="info_questions">
                        <div class="form-group">
                            <label>Your code:</label>
                            <input type="text" name="code_0" class="form-control" value="<?php echo $user_code; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Code 1:</label>
                            <input type="text" name="code_1" class="form-control" value="<?php echo $code_1; ?>">
                        </div>
                        <div class="form-group">
                            <label>Code 2:</label>
                            <input type="text" name="code_2" class="form-control" value="<?php echo $code_2; ?>">
                        </div>
                        <div class="form-group has-error">
                            <label>Code 3:</label>
                            <input type="text" name="code_3" class="form-control" value="<?php echo $code_3; ?>"><br>
                            <span class="help-block"><?php echo $code_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Send information">
                        </div>
                    </form>*/
                ?>
            <?php
            }
            ?>
        </div>
    </div>
<?php get_footer();
}
