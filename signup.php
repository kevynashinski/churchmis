<?php
    require_once 'includes/config.php';
//    include_once 'includes/session.php';

    $message = "";

    if (isset($_POST['submit'])) {

        $id_number = $_POST[ID_NUMBER];
        $surname = $_POST[SURNAME];
        $other_name = $_POST[OTHER_NAME];
        $phone_number = $_POST[PHONE_NUMBER];
        $gender = $_POST[GENDER];
        $username = $_POST[EMAIL];
        $password = $_POST[PASSWORD];

        if ($password != $_POST['pass']) {
            $message = "<div class='alert btn-danger'>Passwords don't match </div>";
        } else {
            //validate if the fields are there
            $result = db_operations::getUserByUsername($username);
            if ($result != null) {
                $row = $result->fetch();

                if ($row[USERNAME] == $username) {
                    $message = "<div class='alert btn-danger'><i class='glyphicon glyphicon-warning-sign'></i> Email Address Already Exists</div>";
                } else {
                    if (db_operations::registerUser($id_number, $surname, $other_name, $phone_number, $gender, $username, $password)) {
                        header('Location: signup.php?inserted');
                    } else {
                        header('Location: signup.php?failure');
                    }
                }
            }
        }
    }

    if (isset($_GET['inserted'])) {
        $message = "<div class='alert alert-info'><strong>Successfully Registered!!!.</strong> <a href='index.php'><u>Home</u></a> </div>";
    } else if (isset($_GET['failure'])) {
        $message = "<div class='alert btn-danger'><i class='glyphicon glyphicon-warning-sign'></i>Failed to Save the Details. Try again </div>";
    }
?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, following, chatting, liking">
    <title>MyGalaxy | Social for all</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="images/favicon.png">
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
            <a class="navbar-right" href="index.php"><img src="images/logo.png" alt="Logo"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <!--                <li class="active"><a href="">Hi -->
                <?php //echo $_SESSION['username'] ?><!--</a></li>-->
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Welcome to MyGalaxy</h1>
            <h2 style="text-align:center;">Are you feeling bored? want to have some fun with your friends online?<br>
                then definately you are in the right place</h2>
            <h3 style="text-align:center">Sign Up Below</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="signup">

                    <?php echo $message; ?>

                    <form role="form" method="post">

                        <div class="form-group">
                            <input type="number" placeholder="ID Number" name="id_number" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="SurName" name="surname" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="Other Name(s)" name="other_name" class="form-control"
                                   required>
                        </div>

                        <div class="form-group">
                            <input type="text" placeholder="Phone Number" name="phone_number" class="form-control"
                                   required>
                        </div>

                        <div class="form-group">
                            <select name="gender" class="form-control" title="Gender" required="required">
                                <option value="" class="dob">Gender</option>
                                <option value="Male" class="dob">Male</option>
                                <option value="Female" class="dob">Female</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="email" placeholder="Email Address" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Confirm Password" name="pass" class="form-control"
                                   required>
                        </div>

                        <div align="right">
                            <button type="reset" class="btn btn-danger btn-lg">
                                <span class="glyphicon glyphicon-erase"></span>
                                Reset
                            </button>

                            <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                <span class="glyphicon glyphicon-plus"></span>
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/myScript.js"></script>
