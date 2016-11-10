<?php
    /**
     * Created by PhpStorm.
     * User: lenik
     * Date: 2/16/2016
     * Time: 3:29 PM
     */
    include_once 'includes/config.php';
include_once 'includes/session.php';
?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>ChurchMIS</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <!--    <link rel="shortcut icon" href="images/favicon.png">-->


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
            <!--            <a class="navbar-right" href="index.php"><img src="images/logo.png" alt="Logo"></a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="dashboard.php">Hi, <?php echo $_SESSION['username'] ?></a></li>
                <li class="active"><a href="admin.php">Admin</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Welcome to ChurchMIS</h1>
            <h3 style="text-align:center">Users</h3>
        </div>
    </div>

</div>

<br>

<div class="container">
    <div class="dataView">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>ID NUMBER</th>
                <th>SURNAME</th>
                <th>OTHER NAME</th>
                <th>GENDER</th>
                <th>EMAIL ADDRESS</th>
                <th>REGISTERED DATE</th>
                <th>PRIVILEGE</th>
            </tr>
            </thead>
            <tbody class="searchable">
            <?php

            $sql = "SELECT * FROM users";

                //get the view page number selected

                    $records_per_page = 100;
                    $newquery = db_operations::paging($sql, $records_per_page);
            db_operations::getUsers($newquery);

            ?>
            <tr>
                <td colspan="9" align="center">
                    <div class="pagination-wrap">
                        <?php db_operations::paginglink($sql, $records_per_page); ?>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
