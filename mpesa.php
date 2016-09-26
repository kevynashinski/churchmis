<?php
/**
 * Created by PhpStorm.
 * User: sydney
 * Date: 9/20/16
 * Time: 7:54 AM
 */

include_once 'includes/config.php';
include_once 'includes/session.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_REQUEST[MPESA_CODE]) && isset($_REQUEST[FULL_NAME]) && isset($_REQUEST[AMOUNT]) && isset($_REQUEST[FULL_NAME]) && isset($_REQUEST[DATE]) && isset($_REQUEST[TIME])) {
        $mpesaCode = $_REQUEST[MPESA_CODE];
        $fullName = $_REQUEST[FULL_NAME];
        $phoneNumber = $_REQUEST[PHONE_NUMBER];
        $amount = $_REQUEST[AMOUNT];
        $date = $_REQUEST[DATE];
        $time = $_REQUEST[TIME];

        if (db_operations::saveMpesaTransaction($mpesaCode, $fullName, $phoneNumber, $amount, $date, $time)) {
            echo 0;
        } else {
            echo 1;
        }
    } else {
        echo 'Missing Post Param';
    }

} else {
//    echo 'Post only';
}
?>

<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="classwork, follwoing, chatting, liking">
    <title>ChurchMis</title>
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
                <li class="active"><a href="">Hi <?php echo $_SESSION[USERNAME] ?></a></li>
                <li><a href='dashboard.php'>DashBoard</a></li>
                <li><a href="overall_records.php">Records</a></li>
                <li><a href="events.php">Manage Events</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">ChurchMis Mpesa Statements</h1>
        </div>
    </div>

    <div class="container">
        <div class="dataView">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>MPESA CODE</th>
                    <th>FULL NAME</th>
                    <th>AMOUNT (Ksh.)</th>
                    <th>DATE</th>
                    <th>TIME</th>
                </tr>
                </thead>
                <tbody class="searchable">
                <?php

                $sql = "SELECT * FROM mpesa";

                //get the view page number selected

                $records_per_page = 100;
                $newquery = db_operations::paging($sql, $records_per_page);
                db_operations::getMpesaTransactions($newquery);

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
