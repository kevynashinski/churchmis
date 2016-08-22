<?php
/**
 * Created by PhpStorm.
 * User: lenik
 * Date: 2/19/2016
 * Time: 9:07 PM
 */

?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content= "width=device-width, initial-scale=1">
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
<!--                <li class="active"><a href="">Hi --><?php //echo $_SESSION['username'] ?><!--</a></li>-->
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
                <div class="signup">

                    <p class="psize">A registration link has been sent to your Email Address.</p>
<br>
                    <p class="pSize">Check your mail, Click the link to complete your registration</p>

                    <a href="index.php" class="btn btn-info">Back</a>
                </div>
        </div>
    </div>
</div>

</body>
</html>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="js/myScript.js"></script>