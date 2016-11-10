<?php
/**
 * Created by PhpStorm.
 * User: sydney
 * Date: 9/20/16
 * Time: 10:22 AM
 */

include_once 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST['submit'])) {
        $event_name = $_REQUEST[EVENT_NAME];
        $venue = $_REQUEST[VENUE];
        $start_date = $_REQUEST[EVENT_START_DATE];
        $end_date = $_REQUEST[EVENT_END_DATE];

        if (db_operations::addEvent($event_name, $venue, $start_date, $end_date)) {
            echo "Event Added Successfully!";
        }

    } else {
        echo 'Missing Post Param';
    }
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
                <!--                <li class="active"><a href="">Hi-->
                <!--                        --><?php //echo $_SESSION['username']?><!--</a></li>-->

                <?php
                session_start();
                if (isset($_SESSION[USERNAME])) {
                    echo
                    '<li><a href="dashboard.php">DashBoard</a></li>
<li><a href="mpesa.php">Mpesa Transactions</a></li>
                <li><a href="news.php">News</a> </li>
                                <li><a href="logout.php">Logout</a></li>
';
                } else {
                    echo '
                    <li><a href="login.php">Login</a></li>
                    <li><a href="news.php">News</a></li>';
                }
                ?>

                <li class="active"><a href="events.php">Events</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>

</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h1 style="text-align:center; font-size:4em;">Upcoming Events</h1>
        </div>
    </div>

    <div class="container">
        <div class="dataView">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>EVENT NAME</th>
                    <th>VENUE</th>
                    <th>EVENT START DATE</th>
                    <th>EVENT END DATE</th>
                </tr>
                </thead>
                <tbody class="searchable">
                <?php

                $sql = "SELECT * FROM events";

                //get the view page number selected

                $records_per_page = 100;
                $newquery = db_operations::paging($sql, $records_per_page);
                db_operations::getAllEvents($newquery);

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

    <?php
    //    session_start();
    if (isset($_SESSION[USERNAME])) {
        echo
        '    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">
            <h5 style="text-align:center; font-size:4em;">Add an Events</h5>
        </div>
    </div>
    
    <div class="container">
        <div class="signup">
                    <form role="form" method="post">

                        <div class="form-group">
                            <input id="full_name" type="text" placeholder="Enter Event Name" name="event_name"
                                   class="form-control" list="fullNameList" required>
                        </div>

                        <div class="form-group">
                            <input id="phoneNumber" type="text" placeholder="Enter Venue" name="venue"
                                   class="form-control" required>
                        </div>
                          
                          <div class="form-group">
                            <input id="date" type="date" placeholder="Select Start Date" name="start_date"
                                   class="form-control" required>
                        </div>
                        
                          <div class="form-group">
                            <input id="date" type="date" placeholder="Select End Date" name="end_date"
                                   class="form-control" required>
                        </div>

                        <br>

                        <button type="submit" name="submit" class="btn btn-success btn-lg">
                            <span class="glyphicon-plus"></span>
                            Save Event</button>
                    </form>
</div>
</div>
    ';
    }

    ?>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>-->
    <script src="js/jquery-2.2.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
