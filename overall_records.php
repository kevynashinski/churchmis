<?php
/**
 * Created by PhpStorm.
 * User: lenik
 * Date: 2/16/2016
 * Time: 3:29 PM
 */
include_once 'includes/config.php';
//include_once 'includes/header.php';
    include_once 'includes/session.php';
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
                <!--                <li class="active"><a href="">Hi -->
                <?php //echo $_SESSION['username']?><!--</a></li>-->
                <li><a href='dashboard.php'>DashBoard</a></li>
                <li><a href="mpesa.php">Mpesa Transactions</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Welcome to ChurchMis</h1>
        </div>
    </div>

</div>

<div class="container" align="right">
    <label>Records per Page: </label>
    <select id="recordPerPage" name="viewNumber" class="viewNumberDropDown" onchange="sortViewPage()" title="">
        <option class="dob">Select One</option>
        <option class="dob" value="10">10</option>
        <option class="dob" value="20">20</option>
        <option class="dob" value="50">50</option>
    </select>
</div>

<div class="container">
    <div class="input-group">
        <span class="input-group-addon">Search</span>
        <input id="filter" type="text" class="search" placeholder="Type the name here...">
</div>
    </div>

<br>

<div class="container">
    <div class="dataView">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>PHONE NUMBER</th>
                <th>PURPOSE</th>
                <th>CASH (Ksh.)</th>
                <th>CHEQUE (Ksh.)</th>
                <th>FOREX</th>
                <th>PAYMENT DATE</th>
            </tr>
            </thead>
            <tbody class="searchable">
            <?php

            $sql = "SELECT d.id,d.full_name,d.phone_number,p.purpose,p.cash,p.cheque,p.forex,p.payment_date FROM details d,payments p WHERE p.id=d.id";

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

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
<script src="js/jquery-2.2.0.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        (function ($) {

            $('#filter').keyup(function () {

                var rex = new RegExp($(this).val(), 'i');
                $('.searchable tr').hide();
                $('.searchable tr').filter(function () {
                    return rex.test($(this).text());
                }).show();
            })

        }(jQuery));

    });

    function sortViewPage() {
        //just post the value passed
        var selectedValue = $("#recordPerPage").val();
        if (selectedValue != "") {
            self.location = "?page_view=" + selectedValue;
        }

    }
</script>
