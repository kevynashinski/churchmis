<?php

include_once 'includes/config.php';
include_once 'includes/session.php';

// set variables to empty
$email_log = $pass_log = "";
$email_logErr = $pass_logErr = $error = "";
//fetching user info from the database
$sql_result_query = db_operations::getUserByUsername($_SESSION[USERNAME]);

if (!$sql_result_query > 0) {
    $error = "<br>\"Your profile couldn't be loaded. Please try again\"<br>";
}


//changing password
$success = $mismatch = $mismatches = $error = $shortpass = "";
if (isset($_POST['change_pass'])) {

    $pass = $_REQUEST['pass'];
    $newpass = $_REQUEST['newpass'];
    $newpass2 = $_REQUEST['newpass2'];

//		$sql_result = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
//		$sql_result_query = mysqli_query($connect,$sql_result);

    if (db_operations::verifyPassword($_SESSION[USERNAME], $pass)) {
        if (strlen($newpass) > 6) {
            if ($newpass == $newpass2) {
                if (db_operations::updatePassword($_SESSION[USERNAME], $newpass)) {
                    $success = "<div class='alert alert-info'>You have successfully changed your password </div>";
                } else {
                    $error = "<br>Failed to Update your password<br>";
                }
            } else {
                $mismatch = "<div class='alert alert-info'> Your new password do not match.</div>";
            }
        } else {
            $shortpass = "<div class='alert alert-info'>New password must be longer than 6 characters</div>";
        }
    } else {
        $error = "<div>Incorrect Current Password</div>";
    }
}


?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>ChurchMIS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--	<link rel="shortcut icon" href="images/favicon.png">-->
</head>
<body class="bgmain">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--			<a class="navbar-right" href="index.php"><img src="images/logo.png" alt="Logo"></a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span>
                        Hi, <?php echo $_SESSION[USERNAME]; ?></a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="logout.php">Let me out</a></li>
                <li class="active"><a href="changepassword.php">Change Password <span
                            class="glyphicon glyphicon-cog"></span></a></li>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h3 style="text-align:center">Change your password below</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="signup">
                    <?php echo $error; ?>
                    <form role="form" method="post">
                        <?php echo $success; ?>
                        <?php echo $mismatch; ?>
                        <?php echo $mismatches; ?>
                        <?php echo $error; ?>
                        <?php echo $shortpass; ?>
                        <div class="form-group">
                            <input type="password" placeholder="Current Password" name="pass" class="form-control">
                            <?php echo $email_logErr; ?>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="New Password" name="newpass" class="form-control">
                            <?php echo $email_logErr; ?>
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Confirm Password" name="newpass2" class="form-control">
                            <?php echo $pass_logErr; ?>
                        </div>
                        <a href="dashboard.php" class="btn btn-danger ">Cancel</a>
                        <button type="submit" name="change_pass" class="btn btn-success ">Change</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
