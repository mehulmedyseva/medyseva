<?php
session_start();
error_reporting(1);

$db_config_path = '../application/config/database.php';

if (!isset($_SESSION["license_code"])) {
    $_SESSION["error"] = "Invalid purchase code!";
    header("Location: index.php");
    exit();
}

if (isset($_POST["btn_admin"])) {

    $_SESSION["db_host"] = $_POST['db_host'];
    $_SESSION["db_name"] = $_POST['db_name'];
    $_SESSION["db_user"] = $_POST['db_user'];
    $_SESSION["db_password"] = $_POST['db_password'];


    /* Database Credentials */
    defined("DB_HOST") ? null : define("DB_HOST", $_SESSION["db_host"]);
    defined("DB_USER") ? null : define("DB_USER", $_SESSION["db_user"]);
    defined("DB_PASS") ? null : define("DB_PASS", $_SESSION["db_password"]);
    defined("DB_NAME") ? null : define("DB_NAME", $_SESSION["db_name"]);

    /* Connect */
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $connection->query("SET CHARACTER SET utf8");
    $connection->query("SET NAMES utf8");

    /* check connection */
    if (mysqli_connect_errno()) {
        $error = 0;
    } else {
        
        mysqli_query($connection, "UPDATE settings SET version = '1.3' WHERE id = 1;");
        mysqli_query($connection, "UPDATE `settings` SET `theme` = '2' WHERE `settings`.`id` = 1;");
        
        mysqli_query($connection, "ALTER TABLE `evisit_settings` ADD `invitation_link` TEXT NULL DEFAULT NULL AFTER `zoom_meeting_password`;");

        mysqli_query($connection, "ALTER TABLE `settings` ADD `theme` INT NULL DEFAULT '1' AFTER `trial_days`;");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Invitation link', 'invitation-link', 'Invitation link');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Advise', 'advise', 'Advise'), (NULL, 'admin', 'Diagnosis', 'diagnosis', 'Diagnosis');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Profile page', 'profile-page', 'Profile page');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Sunday', 'Sunday', 'Sunday'), (NULL, 'admin', 'Monday', 'Monday', 'Monday'), (NULL, 'admin', 'Tuesday', 'Tuesday', 'Tuesday'), (NULL, 'admin', 'Wednesday', 'Wednesday', 'Wednesday'), (NULL, 'admin', 'Thursday', 'Thursday', 'Thursday'), (NULL, 'admin', 'Friday', 'Friday', 'Friday'), (NULL, 'admin', 'Saturday', 'Saturday', 'Saturday');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'We have send a verification code in your email.', 'send-verification-code', 'We have send a verification code in your email.'), (NULL, 'front', 'Verify Code', 'verify-code', 'Verify Code'), (NULL, 'front', 'Still don\'t received the code?', 'dont-received-code', 'Still don\'t received the code?'), (NULL, 'front', 'Resend', 'Resend', 'Resend');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Sending', 'sending', 'Sending');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Payment - Upgrade Plan', 'payment-upgrade-plan', 'Payment - Upgrade Plan'), (NULL, 'front', 'Pay Now', 'pay-now', 'Pay Now');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Payment Details ', 'payment-details', 'Payment Details '), (NULL, 'front', 'Name on card', 'name-card', 'Name on card'), (NULL, 'front', 'Card Number', 'card-number', 'Card Number'), (NULL, 'front', 'Expiration month', 'expiration-month', 'Expiration month'), (NULL, 'front', 'Expiration year', 'expiration-year', 'Expiration year');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Item', 'item', 'Item'), (NULL, 'admin', 'Price', 'price', 'Price'), (NULL, 'admin', 'Total', 'total', 'Total');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Sub Total', 'sub-total', 'Sub Total'), (NULL, 'admin', 'Print', 'print', 'Print');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Invoice', 'invoice', 'Invoice'), (NULL, 'admin', 'Transaction', 'transaction', 'Transaction');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Payments', 'payments', 'Payments'), (NULL, 'admin', 'Invoices', 'invoices', 'Invoices');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Transactions', 'transactions', 'Transactions');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'user', 'Before start live consultation please make sure you have started the meeting manually from your zoom app', 'zoom-start-info', 'Before start live consultation please make sure you have started the meeting manually from your zoom app');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Created', 'created', 'Created'), (NULL, 'admin', 'Not Created', 'not-created', 'Not Created');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Prescription is not created yet', 'prescription-not-created-yet', 'Prescription is not created yet');");

        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'front', 'Open', 'open', 'Open');");


        mysqli_query($connection, "INSERT INTO `lang_values` (`id`, `type`, `label`, `keyword`, `english`) VALUES (NULL, 'admin', 'Appearance', 'appearance', 'Appearance'), (NULL, 'admin', 'Set Theme', 'set-theme', 'Set Theme');");

        



        // import database table
        
        $query = '';
          $sqlScript = file('sql/assign_time.sql');
          foreach ($sqlScript as $line) {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
              continue;
            }
              
            $query = $query . $line;
            if ($endWith == ';') {
              mysqli_query($connection, $query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
              $query= '';   
            }
        }


      /* close connection */
      mysqli_close($connection);

      $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://" . $_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
      $redir = str_replace('updates/v1.3/', '', $redir);
      header("refresh:5;url=" . $redir);
      $success = 1;
    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doxe &bull; Update Installer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/libs/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-md-offset-2">

                <div class="row">
                    <div class="col-sm-12 logo-cnt">
                        <p>
                           <img src="assets/img/logo.png" alt="">
                       </p>
                       <h1>Welcome to the update installer</h1>
                   </div>
               </div>

               <div class="row">
                <div class="col-sm-12">

                    <div class="install-box">

                        <div class="steps">
                            <div class="step-progress">
                                <div class="step-progress-line" data-now-value="100" data-number-of-steps="3" style="width: 100%;"></div>
                            </div>
                            <div class="step" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-arrow-circle-right"></i></div>
                                <p>Start</p>
                            </div>
                            <div class="step active" style="width: 50%">
                                <div class="step-icon"><i class="fa fa-database"></i></div>
                                <p>Database</p>
                            </div>
                        </div>

                        <div class="messages">
                            <?php if (isset($message)) { ?>
                            <div class="alert alert-danger">
                                <strong><?php echo htmlspecialchars($message); ?></strong>
                            </div>
                            <?php } ?>
                            <?php if (isset($success)) { ?>
                            <div class="alert alert-success">
                                <strong>Completing Updates ... <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Please wait 5 second </strong>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="step-contents">
                            <div class="tab-1">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <div class="tab-content">
                                        <div class="tab_1">
                                            <h1 class="step-title">Database</h1>
                                            <div class="form-group">
                                                <label for="email">Host</label>
                                                <input type="text" class="form-control form-input" name="db_host" placeholder="Host"
                                                value="<?php echo isset($_SESSION["db_host"]) ? $_SESSION["db_host"] : 'localhost'; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Database Name</label>
                                                <input type="text" class="form-control form-input" name="db_name" placeholder="Database Name" value="<?php echo @$_SESSION["db_name"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Username</label>
                                                <input type="text" class="form-control form-input" name="db_user" placeholder="Username" value="<?php echo @$_SESSION["db_user"]; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Password</label>
                                                <input type="password" class="form-control form-input" name="db_password" placeholder="Password" value="<?php echo @$_SESSION["db_password"]; ?>">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="buttons">
                                        <a href="index.php" class="btn btn-success btn-custom pull-left">Prev</a>
                                        <button type="submit" name="btn_admin" class="btn btn-success btn-custom pull-right">Finish</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

<?php

unset($_SESSION["error"]);
unset($_SESSION["success"]);

?>

</body>
</html>

