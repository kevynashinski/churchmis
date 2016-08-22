<?php
/**
 * Created by PhpStorm.
 * User: lenik
 * Date: 2/16/2016
 * Time: 3:29 PM
 */
include_once 'includes/config.php';
?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>MyGalaxy | Social for all</title>
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
            <ul class="nav navbar-nav">
                <!--                <li class="active"><a href="">Hi -->
                <?php //echo $_SESSION['username']?><!--</a></li>-->
                <li><a href='dashboard.php'>DashBoard</a></li>
                <li><a href="logout.php">Logout</a></li>
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
            <h3 style="text-align:center">Enter Record</h3>
        </div>
    </div>

</div>

<div class="container" align="right">
    <label>Records per Page: </label>
    <select id="recordPerPage" name="viewNumber" class="viewNumberDropDown" onchange="sortViewPage()">
        <option class="dob">Select One</option>
        <option class="dob" value="10">10</option>
        <option class="dob" value="20">20</option>
        <option class="dob" value="50">50</option>
    </select>
</div>

<div class="container">
    <div class="dataView">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>PHONE NUMBER</th>
                <th>PURPOSE</th>
                <th>CASH (Ksh.)</th>
                <th>CHEQUE (Ksh.)</th>
                <th>FOREX</th>
                <th>PAYMENT DATE</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sql = "SELECT p.id,p.firstname,p.lastname,p.gender,p.phone_number,p.payment_date,p.receipt_status,a.purpose,a.cash,a.cheque,a.forex FROM payments p,amount a WHERE a.id=p.id";


            //get the view page number selected
            if (isset($_GET['page_view'])) {
                $records_per_page = $_GET['page_view'];
                $newquery = db_operations::paging($sql, $records_per_page);
                db_operations::getAllUserData($newquery);
            } else {
                $records_per_page = 100;
                $newquery = db_operations::paging($sql, $records_per_page);
                db_operations::getAllUserData($newquery);
            }
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
