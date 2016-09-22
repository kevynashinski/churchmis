<?php
/**
 * Created by PhpStorm.
 * User: kevyn-yilmaz
 * Date: 8/22/16
 * Time: 11:46 AM
 */

include_once 'includes/config.php';
//include_once 'includes/session.php';
?>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>ChurchMIS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="shortcut icon" href="images/favicon.png">

    <script type="application/javascript">



    </script>

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
            <ul class="nav navbar-nav"></ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Contacts</h1>
            <h2 style="text-align:center;">You can easily reach us via: </h2>
        </div>
    </div>

</div>

<div class="container">
    <div class="dataView">
        <h2>Email: support@church.info</h2>
        <h2>Phone: +254716 567234</h2>
        <h2>Mobile: +254723 334678</h2>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
